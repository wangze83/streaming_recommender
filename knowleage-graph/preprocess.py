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

def load_txt(file_path):
    with open(file_path, "r", encoding="utf-8") as file:
        custom_words = set(word.strip() for word in file)
    return custom_words

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

def getMovieTitles():
    sql_query = "select ID, YEAR(post_modified) AS year, post_title from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
        # 将结果转换为 Pandas DataFrame
        df = pd.DataFrame(results, columns=["ID", "Year", "post_title"])

        # 保存为 CSV 文件
        df.to_csv("./dataset/movie_titles.csv", index=False, header=False)
    else:
        print("Query failed.")

def load_custom_stopwords(file_path):
    with open(file_path, "r", encoding="utf-8") as file:
        custom_stopwords = set(word.strip().lower() for word in file)
    return custom_stopwords


def extract_keywords(movie_description):
    # 分句
    sentences = sent_tokenize(movie_description)
    custom_stopwords = load_custom_stopwords("./dataset/stopword.txt")

    # 分词和移除停用词
    stop_words = set(stopwords.words("english"))
    keywords = []

    for sentence in sentences:
        words = word_tokenize(sentence)
        words = [word.lower() for word in words if word.isalnum() and (word.lower() not in stop_words) and (word.lower() not in custom_stopwords)]
        keywords.extend(words)

    return keywords

def getMovieKeywords():
    keyword_not_related_words = load_txt('./dataset/keyword_not_related_words.txt')
    out_keyword = open("./dataset_out/out_keyword.csv", "w", encoding="utf-8")
    out_keyword.write("title,keyword\n")

    sql_query = "select post_title, post_content from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
            for info in results:
                title = info[0]
                title = "\"" + title + "\""
                desc = info[1]
                kws = extract_keywords(desc)
                if kws:
                    for kw in kws:
                        if len(kw) < 2:
                             continue
                        if kw in keyword_not_related_words:
                            continue
                        keyword = "\"" + kw + "\""
                        print(f"{title},{keyword}")
                        out_keyword.write(f"{title},{keyword}\n")
    else:
        print("Query failed.")

def getMovieGenres():

    out_genre = open("./dataset_out/out_genre.csv", "w", encoding="utf-8")
    out_genre.write("title,genre\n")

    login_url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
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

    sql_query = "select ID, post_title from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
        for item in results:
            payload = {
                "id": item[0],
                "action": "genres_action",
            }
            title = "\"" + item[1] + "\""
            response = session.post(login_url, data=payload, cookies=cookie)
            if response.text:
                parsed_data = json.loads(response.text)
                if parsed_data:
                    for r in parsed_data:
                        genre = r["name"]
                        genre = "\"" + genre + "\""
                        out_genre.write(f"{title},{genre}\n")
                else:
                    print(f"=======movie: {title} =========id: {item[0]} doesn't have genre")

    else:
        print("Query failed.")

def getMovies():
    out_movies = open("./dataset_out/out_movies.csv", "w", encoding="utf-8")
    out_movies.write("title\n")

    sql_query = "select post_title from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
        for item in results:
            title = "\"" + item[0] + "\""
            print(title)
            out_movies.write(f"{title}\n")
    else:
        print("Query failed.")

def getDirector():
    out_director = open("./dataset_out/out_director.csv", "w", encoding="utf-8")
    out_director.write("title,director\n")

    login_url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
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

    sql_query = "select ID, post_title from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
        for item in results:
            payload = {
                "id": item[0],
                "action": "director_action",
            }
            title = "\"" + item[1] + "\""
            response = session.post(login_url, data=payload, cookies=cookie)
            if response.text:
                parsed_data = json.loads(response.text)
                if parsed_data:
                    if parsed_data:
                        for r in parsed_data:
                            director = r
                            if director == "":
                                continue
                            director = "\"" + director + "\""
                            out_director.write(f"{title},{director}\n")
                    else:
                        print(f"=======movie: {title} =========id: {item[0]} doesn't have director")

    else:
        print("Query failed.")

def getCast():
    cast_not_related = load_txt('./dataset/cast_not_related.txt')
    out_cast = open("./dataset_out/out_cast.csv", "w", encoding="utf-8")
    out_cast.write("title,cast\n")

    login_url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
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

    sql_query = "select ID, post_title from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
        for item in results:
            payload = {
                "id": item[0],
                "action": "cast_action",
            }
            title = "\"" + item[1] + "\""
            response = session.post(login_url, data=payload, cookies=cookie)
            if response.text:
                parsed_data = json.loads(response.text)
                if parsed_data:
                    if parsed_data:
                        for r in parsed_data:
                            cast = r
                            if cast in cast_not_related:
                                continue
                            if cast == "":
                                continue
                            cast = "\"" + cast.replace('"', '') + "\""
                            out_cast.write(f"{title},{cast}\n")
                    else:
                        print(f"=======movie: {title} =========id: {item[0]} doesn't have cast")

    else:
        print("Query failed.")

def getGrade():
    out_grade = open("./dataset_out/out_grade.csv", "w", encoding="utf-8")
    out_grade.write("user_id,title,grade\n")

    login_url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
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

    sql_query = "select ID,post_title from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    if results:
        for item in results:
            payload = {
                "id": item[0],
                "action": "rating_action",
            }
            title = "\"" + item[1] + "\""
            response = session.post(login_url, data=payload, cookies=cookie)
            if response.text:
                parsed_data = json.loads(response.text)
                if parsed_data["users"]:
                    for userid,value in parsed_data["users"].items():
                        print(f"userid: {userid}, Value: {value[0]}")
                        out_grade.write(f"{userid},{title},{value[0]}\n")

    else:
        print("Query failed.")


# getMovieTitles()
# getMovieKeywords()
# getMovieGenres()
# getMovies()
# getDirector()
# getCast()
getGrade()