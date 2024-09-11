import requests
import json
import time
import csv

# 请求的URL
url = 'http://127.0.0.1:8080/sr-admin/admin-ajax.php'

# 请求头部信息
headers = {
    'Accept': 'application/json, text/javascript, */*; q=0.01',
    'Accept-Encoding': 'gzip, deflate, br',
    'Accept-Language': 'en,zh-CN;q=0.9,zh;q=0.8',
    'Connection': 'keep-alive',
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    'Cookie': 'thewzsr_ef301f25d1b8e2bca70fafc1316f1a92=WangZe%7C1699363953%7CW5D6qmaw7rW7cIQ8wrZjY0Y9qT9uwI52W6MtZlkFIP8%7C8de2af327ba32047c6a1ccf0b79fdec9a65d1d83b3262473715d7e006e1161c8; starstruck_ef301f25d1b8e2bca70fafc1316f1a92=0fabb9e95c726f495fae8452e5b42cc8; thewzsr_test_cookie=WP%20Cookie%20check; wp_lang=en_US; thewzsr_logged_in_ef301f25d1b8e2bca70fafc1316f1a92=WangZe%7C1699363953%7CW5D6qmaw7rW7cIQ8wrZjY0Y9qT9uwI52W6MtZlkFIP8%7Cb79f28f5da7afcba41fdddf6651b8b598ae3a3e2ec9158e2ff565d25cb88d1f2; wp-settings-1=mfold%3Do%26libraryContent%3Dbrowse; wp-settings-time-1=1699191153',
    'Host': '127.0.0.1:8080',
    'Origin': 'http://127.0.0.1:8080',
    'Referer': 'http://127.0.0.1:8080/sr-admin/admin.php?page=dbmvs',
    'Sec-Fetch-Dest': 'empty',
    'Sec-Fetch-Mode': 'cors',
    'Sec-Fetch-Site': 'same-origin',
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',
    'X-Requested-With': 'XMLHttpRequest',
    'sec-ch-ua': '"Chromium";v="118", "Google Chrome";v="118", "Not=A?Brand";v="99"',
    'sec-ch-ua-mobile': '?0',
    'sec-ch-ua-platform': 'macOS',
}

def download(result):
    # 将JSON响应解析为Python字典
    data = json.loads(result)

    # 提取电影信息
    if "results" in data:
        results = data["results"]
        # 限制结果数量为2
        max_results = 2
        count = 0

        if results is not None:
            for movie in results:
                if movie["im"] == "" or movie["im"] == "http://127.0.0.1:8080/wp-content/themes/dooplay/inc/core/dbmvs/assets/no_img_185.png":
                    print(movie["im"] + "----： im empty continue")
                    continue

                if movie["dt"] == "No date":
                    print(movie["dt"] + "----： dt empty continue")
                    continue

                data = {
                    "ptype": "movie",
                    "ptmdb": movie["id"],
                    "action": "dbmovies_insert_tmdb"
                }

                print("now exec movie:" + movie["ti"])

                # 发送POST请求
                response = requests.post(url,headers=headers, data=data)

                # 检查响应是否成功
                if response.status_code == 200:
                    # 响应成功，你可以继续处理下载电影的操作
                    print("电影下载成功！")
                    print(response.text)
                else:
                    # 请求失败
                    print("电影下载失败。")
                    print(response)

                count += 1
                if count >= max_results:
                    break
                time.sleep(4)

def search(data):
    # 发送POST请求
    response = requests.post(url, headers=headers, data=data)

    # 检查响应
    if response.status_code == 200:
        download(response.text)
    else:
        print(f"请求失败，状态码：{response.status_code}")
        print(response.text)
        exit(1)
    time.sleep(2)



# 读取 out_movies.csv 文件
with open('out_movies.csv', 'r', encoding='utf-8') as csvfile:
    reader = csv.reader(csvfile)
    movies = [row[0] for row in reader]


for movie in movies:
    # 构建数据格式
    data = {
        'searchterm': movie,  # 将电影名称连接成一个以换行符分隔的字符串
        'searchpage': '1',
        'searchtype': 'movie',
        'action': 'dbmovies_app_search',
    }
    search(data)

print("=========Done=======")
