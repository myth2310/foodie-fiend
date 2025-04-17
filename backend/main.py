import os
from mysql.connector import pooling
import pandas as pd
from flask import Flask, jsonify
from dotenv import load_dotenv
from sklearn.neighbors import NearestNeighbors

load_dotenv()
app = Flask(__name__)

# Konfigurasi database
db_host = os.getenv("DB_HOST")
db_port = os.getenv("DB_PORT")
db_name = os.getenv("DB_NAME")
db_user = os.getenv("DB_USER")
db_pass = os.getenv("DB_PASS")

# Koneksi pool
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
def fetch_reviews(query, params=None):
    conn = connection_pooling.get_connection()
    cursor = conn.cursor(dictionary=True)
    try:
        cursor.execute(query, params)
        result = cursor.fetchall()
        df = pd.DataFrame(result)

        if df.empty:
            print("DataFrame is empty!")
        else:
            print("DataFrame columns:", df.columns)
            print("Sample data:\n", df.head())  

        df = df.groupby(['user_id', 'menu_id'], as_index=False).agg({'rating': 'mean'})
        return df
    except Exception as e:
        print(f"Error: {e}")
        conn.rollback()
        return pd.DataFrame()
    finally:
        cursor.close()
        conn.close()

# Ambil semua menu
def fetch_all_menu_ids():
    conn = connection_pooling.get_connection()
    cursor = conn.cursor()
    try:
        cursor.execute("SELECT id FROM menus")
        results = cursor.fetchall()
        print("Semua Menu ID:", results)  
        return set(row[0] for row in results)
    finally:
        cursor.close()
        conn.close()

# Fungsi rekomendasi
def recommend(ratings_matrix, user_id=None, top_n=20):
    menu_means = ratings_matrix.mean(axis=0)
    if user_id is None or user_id not in ratings_matrix.index or (ratings_matrix.loc[user_id] == 0).all():
        rated = menu_means[menu_means.notna()].sort_values(ascending=False)
        unrated = menu_means[menu_means.isna()]
        result = list(rated.items()) + [(menu_id, 0) for menu_id in unrated.index]
        return result[:top_n]

    else:
        user_ratings = ratings_matrix.loc[user_id]
        user_rated = user_ratings[user_ratings > 0].sort_values(ascending=False)
        unrated_by_user = user_ratings[user_ratings == 0]
        ratings_excl_user = ratings_matrix.drop(index=user_id)
        others_mean = ratings_excl_user.mean(axis=0)
        others_rated = others_mean[unrated_by_user.index]
        others_rated = others_rated[others_rated.notna()].sort_values(ascending=False)
        unrated_by_all = others_mean[others_mean.isna()].index
        result = list(user_rated.items()) + list(others_rated.items()) + [(menu_id, 0) for menu_id in unrated_by_all]
        return result[:top_n]

# Endpoint rekomendasi
@app.route("/api/recommendation/<user_id>")
def get_recommendation(user_id):
    query = "SELECT user_id, menu_id, rating FROM reviews"
    reviews = fetch_reviews(query)
    all_menu_ids = fetch_all_menu_ids()

    if reviews.empty:
        # Jika tidak ada review sama sekali, kembalikan menu random
        return jsonify(list(all_menu_ids))

    ratings_matrix = reviews.pivot(index="user_id", columns="menu_id", values="rating")
    average_ratings = ratings_matrix.mean(axis=0).to_dict()

    try:
        if user_id in ratings_matrix.index:
            # Ambil menu yang sudah direview user
            user_ratings = ratings_matrix.loc[user_id].dropna()
            rated_menus = user_ratings[user_ratings > 0].sort_values(ascending=False).to_dict()
            rated_menu_ids = set(rated_menus.keys())

            # Menu yang belum direview oleh user
            unrated_by_user = set(ratings_matrix.columns) - rated_menu_ids

            # Menu yang belum pernah dirating sama sekali
            all_rated_menus = set(ratings_matrix.columns)
            unrated_by_anyone = all_menu_ids - all_rated_menus

            # Rekomendasi dari user lain (collaborative filtering)
            recommended = recommend(ratings_matrix.fillna(0), user_id)
            recommended_filtered = [
                (menu_id, score) for menu_id, score in recommended
                if menu_id not in rated_menu_ids and menu_id not in unrated_by_anyone
            ]

            # Gabungkan semua hasil:
            final_result = []

            # 1. Menu yang direview user (urut dari rating tertinggi ke terendah)
            final_result += list(rated_menus.keys())

            # 2. Menu yang direkomendasikan dari user lain
            final_result += [menu_id for menu_id, _ in recommended_filtered]

            # 3. Menu yang belum pernah dirating sama sekali (acak)
            final_result += list(unrated_by_anyone)

            # Hilangkan duplikat sambil mempertahankan urutan
            seen = set()
            ordered_menu_ids = []
            for menu_id in final_result:
                if menu_id not in seen:
                    seen.add(menu_id)
                    ordered_menu_ids.append(menu_id)

            return jsonify(ordered_menu_ids)

        else:
            # User belum pernah review → menu dengan rata-rata rating tertinggi → lalu random
            all_rated_menus = set(ratings_matrix.columns)
            unrated_menu_ids = all_menu_ids - all_rated_menus

            rated_menu_scores = [(menu_id, score) for menu_id, score in average_ratings.items()]
            rated_menu_scores.sort(key=lambda x: x[1], reverse=True)
            rated_sorted = [menu_id for menu_id, _ in rated_menu_scores]

            return jsonify(rated_sorted + list(unrated_menu_ids))

    except Exception as e:
        print(f"Recommendation error: {e}")
        return jsonify([]), 500



if __name__ == "__main__":
    app.run(debug=True)
