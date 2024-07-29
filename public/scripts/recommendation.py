import sys, os
import mysql.connector
from dotenv import load_dotenv

load_dotenv()

def getAllUsers(data):
    conn = mysql.connector.connect(
        host=os.getenv("database.default.hostname"),
        user=os.getenv("database.default.username"),
        password=os.getenv("database.default.password"),
        database=os.getenv("database.default.database")
    )
    
    query = """
    SELECT * FROM users
    """
    cursor = conn.cursor()
    cursor.execute(query)
    
    result = cursor.fetchone()

    conn.close()
    
    return result

if __name__ == "__main__":
    print(os.getenv("database.default.username"))
    # print(getAllUsers())