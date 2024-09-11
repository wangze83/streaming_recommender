from faker import Faker
import requests
import time

fake = Faker()

# 目标 URL
url = "http://127.0.0.1:8080/sr-admin/admin-ajax.php"

def register(form_data):
    # 发送 POST 请求
    response = requests.post(url, data=form_data)

    # 检查响应状态码
    if response.status_code == 200:
        print("注册成功")
    else:
        print("注册失败")

    time.sleep(2)

# 循环创建用户
for i in range(1, 181):  # 从1到180创建用户
    data = {
        "username": fake.user_name(),
        "email": fake.email(),
        "spassword": '123456',
        "firstname": fake.first_name(),
        "lastname": fake.last_name(),
        "action": 'dooplay_register'
    }
    print(data)
    register(data)

