import time
import random
import requests
import mysql.connector


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


def getUsers():
    sql_query = "SELECT user_login FROM wp_users"
    results = run_mysql_query(sql_query)
    return results

def getMovieIds():
    sql_query = "select ID from wp_posts where post_type='movies' and post_status='publish'"
    results = run_mysql_query(sql_query)
    return results

def logout(cookie):
    url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
    payload = {
        "action": "dooplay_logout",
    }

    # 发送 POST 请求，带上 Cookie
    response = requests.post(url, data=payload, cookies=cookie)

    # 检查操作是否成功
    if response.status_code == 200:
        print("logout success")
    else:
        print("logout failed")

def rating(cookie):
    # 设置目标 URL 和 POST 请求的参数
    url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
    results = getMovieIds()
    random_movie_ids = random.sample(results, 300)
    for movie_id in random_movie_ids:
        payload = {
            "action": "starstruck_action",
            "nonce": "6c38cffc1f",
            "score": random.randint(1, 10),
            "id": movie_id[0],
            "type": "post"
        }

        # 发送 POST 请求，带上 Cookie
        response = requests.post(url, data=payload, cookies=cookie)

        # 检查操作是否成功
        if 'Thanks for your vote!' in response.text:
            print("电影评分成功！", movie_id[0], payload, response.text)
        else:
            print("电影评分失败。", payload)

def login():
    # 设置登录信息和目标 URL
    login_url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"
    results = getUsers()
    for username in results:
        if username[0] == 'WangZe':
            pwd = '#hiME$VtsgtVWHbUPk'
        else:
            pwd = '123456'
        payload = {
            "log": username[0],
            "pwd": pwd,
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
                rating(cookie)
            else:
                print("登录失败，请检查用户名和密码。", payload)
        logout(cookie)
        time.sleep(2)


login()
print("Done")
