import os
from mysql.connector import pooling
import pandas as pd
from flask import Flask, jsonify
from dotenv import load_dotenv
from sklearn.neighbors import NearestNeighbors

load_dotenv()

app = Flask(__name__)

# konfigurasi database
db_host = os.getenv("DB_HOST")
db_port = os.getenv("DB_PORT")
db_name = os.getenv("DB_NAME")
db_user = os.getenv("DB_USER")
db_pass = os.getenv("DB_PASS")

# fungsi untuk mengambil data ulasan pengguna di database
def fetch_reviews(query, params=None):
    connection_pooling = pooling.MySQLConnectionPool(
        pool_name="test_pool",
        pool_size=5,
        pool_reset_session=True,
        host=db_host,
        port=db_port,
        database=db_name,
        user=db_user,
        password=db_pass,
        charset="utf8mb4",
        collation="utf8mb4_unicode_ci",
    )
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

        # Hitung rata-rata rating jika ada duplikat (banyak ulasan untuk menu yang sama)
        df = df.groupby(['user_id', 'menu_id'], as_index=False).agg({'rating': 'mean'})
        return df

    except Exception as e:
        print(f"Error: {e}")
        conn.rollback()
    finally:
        cursor.close()
        conn.close()


def recommend(ratings_matrix, user_id=None, top_n: int = 20):
    if user_id is None or user_id not in ratings_matrix.index:
        popular_menus = (
            ratings_matrix.mean(axis=0).sort_values(ascending=False).head(top_n)
        )
        return [(menu_id, score) for menu_id, score in popular_menus.items()]

    model = NearestNeighbors(metric="cosine", algorithm="brute")
    model.fit(ratings_matrix)

    user_idx = ratings_matrix.index.get_loc(user_id)
    distances, indices = model.kneighbors(
        [ratings_matrix.iloc[user_idx]], n_neighbors=top_n + 1
    )
    similar_users = indices.flatten()[1:]  

    recommendations = {}
    for sim_user_idx in similar_users:
        sim_user_id = ratings_matrix.index[sim_user_idx]
        for menu_id in ratings_matrix.columns:
            if (
                ratings_matrix.at[user_id, menu_id] == 0
                and ratings_matrix.at[sim_user_id, menu_id] > 0
            ):
                if menu_id not in recommendations:
                    recommendations[menu_id] = 0
                recommendations[menu_id] += (
                    1 - distances[0, similar_users.tolist().index(sim_user_idx)]
                ) * ratings_matrix.at[sim_user_id, menu_id]

    recommended_menus = sorted(
        recommendations.items(), key=lambda x: x[1], reverse=True
    )
    recommended_menus = [
        (menu_id, score) for menu_id, score in recommended_menus[:top_n]
    ]
    return recommended_menus

@app.route("/api/recommendation/<user_id>")
def get_recommendation(user_id):
    query = "SELECT user_id, menu_id, rating FROM reviews"
    reviews = fetch_reviews(query)

    if 'user_id' not in reviews.columns or 'menu_id' not in reviews.columns or 'rating' not in reviews.columns:
        return jsonify({"error": "Missing columns in data"}), 500

    # Pivot table untuk membentuk ratings_matrix
    ratings_matrix = reviews.pivot(
        index="user_id", columns="menu_id", values="rating"
    ).fillna(0)

    try:
        recommended_menus = recommend(ratings_matrix, user_id)
    except Exception as e:
        print(f"Recommendation error: {e}")
        recommended_menus = recommend(ratings_matrix)

    menu_ids = [item[0] for item in recommended_menus]
    return jsonify(menu_ids)


