import sys
import mysql.connector
import pandas as pd
import numpy as np
from sklearn.neighbors import NearestNeighbors

# konfigurasi koneksi MySQL
config = {
    'user': 'foodies',
    'password': 'foodies13245768',
    'host': '127.0.0.1',
    'database': 'foodie_fiend_test',
    'charset': 'utf8mb4',
    'collation':'utf8mb4_unicode_ci',
}

# fungsi untuk mengambil data ulasan di database
def fetch_reviews():
    connection = mysql.connector.connect(**config)
    # query = "SELECT menu_id FROM reviews GROUP BY menu_id HAVING AVG(rating) = 4"
    query = "SELECT user_id, menu_id, rating FROM reviews"
    reviews = pd.read_sql(query, connection)
    connection.close()
    return reviews

# menampung data ulasan
reviews = fetch_reviews()

# membuat matriks rating
ratings_matrix = reviews.pivot(index='user_id', columns='menu_id', values='rating').fillna(0)

# membuat model NearestNeighbors dengan cosine similarity (metode untuk menhitung jarak)
model = NearestNeighbors(metric='cosine', algorithm='brute')
model.fit(ratings_matrix)

def recommend(ratings_matrix, model, user_id=None, top_n:int=20):
    if user_id is None or user_id not in ratings_matrix.index:
        # Mengembalikan rekomendasi default berdasarkan rating rata-rata tertinggi
        popular_menus = ratings_matrix.mean(axis=0).sort_values(ascending=False).head(top_n)
        return [(menu_id, score) for menu_id, score in popular_menus.items()]

    user_idx = ratings_matrix.index.get_loc(user_id)
    distances, indices = model.kneighbors([ratings_matrix.iloc[user_idx]], n_neighbors=top_n+1)
    similar_users = indices.flatten()[1:] # melewatkan pengguna itu sendiri

    recommendations = {}
    for sim_user_idx in similar_users:
        sim_user_id = ratings_matrix.index[sim_user_idx]
        for menu_id in ratings_matrix.columns:
            if ratings_matrix.at[user_id, menu_id] == 0 and ratings_matrix.at[sim_user_id, menu_id] > 0:
                if menu_id not in recommendations:
                    recommendations[menu_id] = 0
                recommendations[menu_id] += (1 - distances[0, similar_users.tolist().index(sim_user_idx)]) * ratings_matrix.at[sim_user_id, menu_id]

    # mengurutkan rekomendasi berdasarkan skor tertinggi
    recommended_menus = sorted(recommendations.items(),key=lambda x: x[1], reverse=True)
    recommended_menus = [menu_id for menu_id, score in recommended_menus[:top_n]]

    return recommended_menus

# mendapatkan rekomendasi
try:
    user_id = sys.argv[1]
    recommended_menus = recommend(ratings_matrix, model, user_id)
except:
    recommended_menus = recommend(ratings_matrix, model)    
finally:
    uuid_data = [item[0] for item in recommended_menus]
    print(uuid_data)