import mysql.connector
import pandas as pd
import requests
import json
from itertools import islice
import csv
import re

def run_mysql_query(sql_query):
    host = "localhost"
    user = "root"
    password = "123456"
    database = "streaming_recommender_db"
    try:
        # 建立数据库连接
        connection = mysql.connector.connect(
            host=host,
            user=user,
            password=password,
            database=database
        )

        # 创建游标对象
        cursor = connection.cursor()

        # 执行查询
        cursor.execute(sql_query)

        # 获取查询结果
        results = cursor.fetchall()

        # 关闭游标和数据库连接
        cursor.close()
        connection.close()

        return results
    except Exception as e:
        print(f"Error: {e}")
        return None

login_url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
def login():
    payload = {
        "log": 'WangZe',
        "pwd": '#hiME$VtsgtVWHbUPk',
        "rmb": "forever",
        "action": "dooplay_login",
        "red": "http://127.0.0.1:8080/account"
    }
    # 使用 Session 对象保持登录状态
    with requests.Session() as session:
        # 发送 POST 请求
        response = session.post(login_url, data=payload)
        print(response.text)

        # 检查登录是否成功
        if '"response":true,' in response.text:
            print("登录成功！", payload)
            cookie = response.cookies
        else:
            print("登录失败，请检查用户名和密码。", payload)

        return session, cookie

def filter_html_tags(text):
    cleaned_text = re.sub(r'<!--.*?-->', '', text)
    return cleaned_text

def getGrade():
    session, cookie = login()
    csv_file_path = './dataset_out/out_user_movie_rating.csv'

    with open(csv_file_path, "w", encoding="utf-8", newline='') as out_movie_Infos:
        csv_writer = csv.writer(out_movie_Infos)
        csv_writer.writerow(["userId", "movieId", "rating", "date", "original_title", "genres", "overview"])

        sql_query = "select ID,post_title,post_content from wp_posts where post_type='movies' and post_status='publish'"
        results = run_mysql_query(sql_query)
        if results:
            for item in results:
                movieId = item[0]
                original_title = item[1]
                overview = filter_html_tags(item[2].replace(",", ""))

                payload = {
                    "id": movieId,
                    "action": "genres_action",
                }
                response = session.post(login_url, data=payload, cookies=cookie)
                genres = []
                if response.text:
                    parsed_data = json.loads(response.text)
                    for r in parsed_data:
                        genres.append(r["name"])

                payload = {
                    "id": movieId,
                    "action": "rating_action",
                }
                response = session.post(login_url, data=payload, cookies=cookie)
                parsed_data = json.loads(response.text)
                if parsed_data["users"]:
                    for userid,value in parsed_data["users"].items():
                        rating = value[0]
                        userId = userid
                        date = value[2]

                        csv_writer.writerow([userId, movieId, rating, date, original_title, json.dumps(genres), overview])

        else:
            print("Query failed.")


def getMovies():
    csv_file_path = './dataset_out/out_simple_movie_infos.csv'

    with open(csv_file_path, "w", encoding="utf-8", newline='') as out_movie_Infos:
        csv_writer = csv.writer(out_movie_Infos)
        csv_writer.writerow(["movieId", "original_title"])
        sql_query = "select ID,post_title from wp_posts where post_type='movies' and post_status='publish'"
        results = run_mysql_query(sql_query)
        if results:
            for item in results:
                id = item[0]
                title = item[1]
                csv_writer.writerow([id, title])
        else:
            print("Query failed.")

# getGrade()
getMovies()