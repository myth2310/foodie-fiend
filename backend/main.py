from flask import Flask, jsonify
from math import radians, cos, sin, asin, sqrt
from mysql.connector import pooling
import pandas as pd
import numpy as np
import os
from dotenv import load_dotenv
from sklearn.metrics.pairwise import cosine_similarity

load_dotenv()
app = Flask(__name__)

# Konfigurasi database
db_host = os.getenv("DB_HOST")
db_port = os.getenv("DB_PORT")
db_name = os.getenv("DB_NAME")
db_user = os.getenv("DB_USER")
db_pass = os.getenv("DB_PASS")

# Pool koneksi
connection_pooling = pooling.MySQLConnectionPool(
    pool_name="test_pool",
    pool_size=5,
    pool_reset_session=True,
    host=db_host,
    port=db_port,
    database=db_name,
    user=db_user,
    password=db_pass
)

# Ambil semua review
def fetch_reviews():
    conn = connection_pooling.get_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT user_id, menu_id, rating FROM reviews")
    result = cursor.fetchall()
    query = """
            SELECT user_id, menu_id, rating
            FROM reviews
        """
    df = pd.read_sql(query, conn)
    conn.close()
    return df

# Cek apakah user pernah order
def has_orders(user_id):
    conn = connection_pooling.get_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT COUNT(*) FROM orders WHERE user_id = %s", (user_id,))
        count = cursor.fetchone()[0]
        return count > 0
    finally:
        cursor.close()
        conn.close()

# Ambil lokasi user
def fetch_user_location(user_id):
    conn = connection_pooling.get_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        cursor.execute(f"SELECT lat, `long` FROM users WHERE id = '{user_id}'")
        return cursor.fetchone()
    finally:
        cursor.close()
        conn.close()

# Ambil semua ID menu
def fetch_all_menu_ids():
    conn = connection_pooling.get_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM menus")
        results = cursor.fetchall()
        return set(row[0] for row in results)
    finally:
        cursor.close()
        conn.close()

# Ambil semua data menu lengkap
def fetch_menus_with_order_and_rating():
    conn = connection_pooling.get_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        query = """
            SELECT 
                menus.id AS menu_id,
                menus.name,
                menus.store_id,
                users.lat,
                users.long,
                COALESCE(AVG(reviews.rating), 0) AS avg_rating,
                COUNT(orders.id) AS order_count
            FROM menus
            LEFT JOIN reviews ON menus.id = reviews.menu_id
            LEFT JOIN orders ON menus.id = orders.menu_id
            LEFT JOIN stores ON menus.store_id = stores.id
            LEFT JOIN users ON  stores.user_id = users.id
            GROUP BY menus.id
        """
        cursor.execute(query)
        return cursor.fetchall()
    finally:
        cursor.close()
        conn.close()

def calculate_distance(lat1, lon1, lat2, lon2):
    if None in [lat1, lon1, lat2, lon2]:
        return float('inf')
    R = 6371
    dlat = radians(lat2 - lat1)
    dlon = radians(lon2 - lon1)
    a = sin(dlat/2)**2 + cos(radians(lat1)) * cos(radians(lat2)) * sin(dlon/2)**2
    c = 2 * asin(sqrt(a))
    return R * c

# Collaborative filtering
def recommend(ratings_matrix, user_id=None, top_n=10, k_neighbors=3):
    if user_id not in ratings_matrix.index:
        return []

    matrix_filled = ratings_matrix.fillna(0)
    user_similarities = cosine_similarity(matrix_filled)
    user_sim_df = pd.DataFrame(user_similarities, index=matrix_filled.index, columns=matrix_filled.index)

    sim_scores = user_sim_df.loc[user_id].drop(user_id)
    top_k_users = sim_scores.sort_values(ascending=False).head(k_neighbors)

    unrated_items = ratings_matrix.loc[user_id][ratings_matrix.loc[user_id].isna()].index
    predicted_ratings = {}

    for item in unrated_items:
        numerator = 0
        denominator = 0
        for neighbor_id, similarity in top_k_users.items():
            neighbor_rating = ratings_matrix.loc[neighbor_id, item]
            if not np.isnan(neighbor_rating):
                numerator += similarity * neighbor_rating
                denominator += similarity
        if denominator > 0:
            predicted_ratings[item] = numerator / denominator

    recommended_items = sorted(predicted_ratings.items(), key=lambda x: x[1], reverse=True)[:top_n]
    return recommended_items

# API rekomendasi

@app.route("/api/recommendation/<user_id>")
def get_recommendation(user_id):
    try:
        # Fetch review data dan menu
        reviews = fetch_reviews()
        all_menu_ids = fetch_all_menu_ids()

        print("\n=== DEBUG: All Menu IDs ===")
        print(all_menu_ids)

        # Buat ratings matrix dan rata-rata
        if reviews.empty:
            print("DEBUG: Review DataFrame is empty")
            ratings_matrix = pd.DataFrame()
            average_ratings = {}
        else:
            ratings_matrix = reviews.pivot(index="user_id", columns="menu_id", values="rating")
            average_ratings = ratings_matrix.mean(axis=0).to_dict()

        print("\n=== DEBUG: Ratings Matrix ===")
        print(ratings_matrix)

        print("\n=== DEBUG: Average Ratings ===")
        print(average_ratings)

        user_id = str(user_id)
        has_reviewed = user_id in ratings_matrix.index.astype(str)
        has_ordered = has_orders(user_id)

        print(f"\n=== DEBUG: User ID: {user_id} ===")
        print(f"Has Reviewed? {has_reviewed}")
        print(f"Has Ordered? {has_ordered}")

        # Case 1: User sudah review
        if has_reviewed:
            user_ratings = ratings_matrix.loc[user_id].dropna()
            print("\n=== DEBUG: User Ratings ===")
            print(user_ratings)

            rated_menus = user_ratings[user_ratings > 0].sort_values(ascending=False).to_dict()
            print("\n=== DEBUG: Rated Menus (sorted) ===")
            print(rated_menus)

            rated_menu_ids = set(rated_menus.keys())
            unrated_by_user = set(ratings_matrix.columns) - rated_menu_ids
            all_rated_menus = set(ratings_matrix.columns)
            unrated_by_anyone = all_menu_ids - all_rated_menus

            recommended = recommend(ratings_matrix, user_id)
            print("\n=== DEBUG: Recommended (raw) ===")
            print(recommended)

            recommended_filtered = [
                (menu_id, score) for menu_id, score in recommended
                if menu_id not in rated_menu_ids and menu_id not in unrated_by_anyone
            ]

            print("\n=== DEBUG: Recommended (filtered) ===")
            print(recommended_filtered)

            final_result = list(rated_menus.keys())
            final_result += [menu_id for menu_id, _ in recommended_filtered]
            final_result += list(unrated_by_anyone)

            # Hapus duplikat dengan urutan tetap
            seen = set()
            ordered_menu_ids = []
            for menu_id in final_result:
                if menu_id not in seen:
                    seen.add(menu_id)
                    ordered_menu_ids.append(menu_id)

            print("\n=== DEBUG: Final Ordered Menu IDs ===")
            print(ordered_menu_ids)

            return jsonify(ordered_menu_ids)

        # Case 2: Sudah order tapi belum review
        elif has_ordered:
            print("\n=== DEBUG: User has orders but no reviews ===")
            rated_menu_scores = [(menu_id, score) for menu_id, score in average_ratings.items()]
            rated_menu_scores.sort(key=lambda x: x[1], reverse=True)
            sorted_by_rating = [menu_id for menu_id, _ in rated_menu_scores]

            print("DEBUG: Sorted by average rating:")
            print(sorted_by_rating)

            return jsonify(sorted_by_rating)

        # Case 3: User baru, tidak order dan tidak review
        else:
            print("\n=== DEBUG: New user, no reviews or orders ===")
            user_location = fetch_user_location(user_id)
            print("DEBUG: User Location:", user_location)

            if not user_location or not user_location["lat"] or not user_location["long"]:
                print("DEBUG: User location not found or invalid.")
                return jsonify([])

            menus = fetch_menus_with_order_and_rating()
            print("\n=== DEBUG: Menus with rating/order/location ===")
            for menu in menus:
                print(menu)

            for menu in menus:
                if menu["lat"] is not None and menu["long"] is not None:
                    menu["distance"] = calculate_distance(
                        float(user_location["lat"]), float(user_location["long"]),
                        float(menu["lat"]), float(menu["long"])
                    )
                else:
                    menu["distance"] = float('inf')  # Menu tanpa lokasi akan diletakkan di akhir

            sorted_menus = sorted(
                menus,
                key=lambda x: (x["distance"], -x["avg_rating"], -x["order_count"])
            )

            print("\n=== DEBUG: Sorted Menus by Distance, Rating, Orders ===")
            for menu in sorted_menus:
                print(f"ID: {menu['menu_id']}, Distance: {menu['distance']:.2f} km, Rating: {menu['avg_rating']}, Orders: {menu['order_count']}")

            sorted_menu_ids = [menu["menu_id"] for menu in sorted_menus]
            return jsonify(sorted_menu_ids)

    except Exception as e:
        print(f"\nRecommendation error: {e}")
        return jsonify([]), 500


if __name__ == "__main__":
    app.run(debug=True)
