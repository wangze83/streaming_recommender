import mysql.connector
import pandas as pd
import requests
import json
from itertools import islice
import csv
import re
import nltk
from nltk.tokenize import word_tokenize, sent_tokenize
from nltk.corpus import stopwords
nltk.download("punkt")
nltk.download("stopwords")

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

def extract_keywords(movie_description):
    # 分句
    sentences = sent_tokenize(movie_description)

    # 分词和移除停用词
    stop_words = set(stopwords.words("english"))
    keywords = []

    for sentence in sentences:
        words = word_tokenize(sentence)
        words = [word.lower() for word in words if word.isalnum() and (word.lower() not in stop_words)]
        keywords.extend(words)

    return keywords

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

def getMovieInfos():
    session, cookie = login()
    csv_file_path = './dataset_out/out_movie_Infos.csv'

    with open(csv_file_path, "w", encoding="utf-8", newline='') as out_movie_Infos:
        csv_writer = csv.writer(out_movie_Infos)
        csv_writer.writerow(["movie_ID", "movie_title", "movie_desc", "genres", "keywords", "cast", "director"])

        sql_query = "select ID, post_title, post_content from wp_posts where post_type='movies' and post_status='publish'"
        results = run_mysql_query(sql_query)
        if results:
            for info in results:
                movie_ID = info[0]
                movie_title = info[1]
                movie_desc = filter_html_tags(info[2].replace(",", ""))
                keywords = extract_keywords(movie_desc)

                payload = {
                    "id": movie_ID,
                    "action": "cast_action",
                }
                response = session.post(login_url, data=payload, cookies=cookie)
                cast = []
                if response.text:
                    cast = response.text


                payload = {
                    "id": movie_ID,
                    "action": "director_action",
                }
                director = []
                response = session.post(login_url, data=payload, cookies=cookie)
                if response.text:
                    director = response.text

                payload = {
                    "id": movie_ID,
                    "action": "genres_action",
                }
                response = session.post(login_url, data=payload, cookies=cookie)
                genres = []
                if response.text:
                    parsed_data = json.loads(response.text)
                    for r in parsed_data:
                        genres.append(r["name"])
                csv_writer.writerow([movie_ID, movie_title, movie_desc, json.dumps(genres), keywords, cast, director])

        else:
            print("Query failed.")



getMovieInfos()