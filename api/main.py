import os
import string
import json
from flask import Flask, request, jsonify
from sklearn.preprocessing import LabelEncoder
import numpy as np
import re
import tensorflow as tf
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
from tensorflow.keras.models import load_model
import random
import pandas as pd
from neo4j import GraphDatabase
import pickle
import tensorflow_recommenders as tfrs
app = Flask(__name__)


# 连接数据库驱动
uri = "bolt://neo4j:7687"
driver = GraphDatabase.driver(uri, auth=("neo4j", "password"))

# 参数设置
k = 20  # 考虑最相似的用户，也就是最邻近的邻居
moives_common = 3  # 考虑用户相似度，要有多少个电影公共看过
usesrs_common = 2  # 至少共通看过2个电影，说用户相似
threshold_sim = 0.8  # 用户相似度阈值

@app.route('/kg_recommendations', methods=['GET'])
def get_recommendations():
    userid = request.args.get('userid')
    limit = request.args.get('limit')

    # 进行查询, 用户u1对电影的评分, 降序排序
    with driver.session() as session:
        session.run(f"""
                    MATCH (u1:User {{ id:{userid} }})-[r:RATED]-(m:Movie)
                    RETURN m.title AS title,r.grading AS grade
                    ORDER BY grade DESC
                """)

        # 删除用户相似性关系
        session.run(f"""
                    MATCH (u1:User)-[s:SIMILARITY]-(u2:User)
                    DELETE s
                """)

        # 重新计算用户相似性
        # 通过电影连接两个用户, u1 --rated-- movie --rated-- u2
        # 计算u1,u2共同评论过的电影,然后根据两个人的评分来计算相似度
        # (用户1评分 * 用户2评分)的总和,除以他们分别的根号平方和
        res = session.run(f"""
                    MATCH (u1:User {{id : {userid}}})-[r1:RATED]-(m:Movie)-[r2:RATED]-(u2:User)
                    WITH
                        u1, u2,
                        COUNT(m) AS movies_common,
                        SUM(r1.grading * r2.grading)/(SQRT( SUM(r1.grading^2) ) * SQRT( SUM(r2.grading^2) )) as sim
                    WHERE movies_common >= {moives_common} AND sim > {threshold_sim}
                    MERGE (u1)-[s:SIMILARITY]-(u2)
                    SET s.sim = sim
                    RETURN u1.id AS user_id, u2.id AS similar_user, movies_common, sim
                """)

        # 条件语句拼装, 过滤类型
        q = session.run(f"""
                    MATCH (u1:User{{id : {userid}}})-[s:SIMILARITY]-(u2:User)
                    WITH u1,u2,s
                    ORDER BY s.sim DESC LIMIT {k}
                    MATCH (m:Movie)-[r:RATED]-(u2)
                    OPTIONAL MATCH (g:Genre)--(m)
                    WITH u1,u2,s,m,r, COLLECT(DISTINCT g.genre) AS gen
                    WITH
                        DISTINCT m.title AS title,
                        SUM(r.grading * s.sim)/SUM(s.sim) AS grade,
                        COUNT(u2) AS num,
                        gen
                    WHERE num >= {usesrs_common}
                    RETURN title,grade,num,gen
                    ORDER BY grade DESC, num DESC
                    LIMIT {limit}
                """)

        result_list = [dict(record) for record in q]

        # Return the JSON response
        return jsonify(result_list)


MAX_SEQ_LENGTH = 30  # 与模型训练时的序列长度相匹配
tokenizer = Tokenizer()
train_dataset = pd.read_csv("train_dataset.csv")
train_dataset = train_dataset.dropna(subset=['text'])
tokenizer.fit_on_texts(train_dataset.text)

# 加载模型
model = load_model("./models/LSTM_model.h5")

def predict_text(input_text):
    text_tokens = pad_sequences(tokenizer.texts_to_sequences([input_text]), maxlen=MAX_SEQ_LENGTH)

    score = model.predict([text_tokens])[0]
    label = 1 if score > 0.5 else 0
    return score, label

def remove_punctuation(text):
    translator = str.maketrans('', '', string.punctuation)
    text_without_punct = text.translate(translator)
    return text_without_punct

with open('config.json', 'r') as config_file:
    config = json.load(config_file)

min_text_length = config.get('min_text_length', 25)
bKeywords = config.get('bKeywords', [])
gKeywords = config.get('gKeywords', [])
score_range = config.get('score_range', [])
labels = config.get('labels', {})

@app.route('/lstm-predict', methods=['POST'])
def predict_sentiment():
    input_text = request.json['text']

    text = input_text

    if len(text) > min_text_length:
        score, label = predict_text(input_text)
    else:
        formatText = remove_punctuation(input_text).replace(" ", "").replace('’', '').lower()
        score = random.uniform(score_range[0], score_range[1])
        if any(keyword in formatText for keyword in bKeywords):
            label = labels['negative']
        elif any(keyword in formatText for keyword in gKeywords):
            label = labels['positive']
        else:
            score, label = predict_text(input_text)

    response = {
        "text": input_text,
        "sentiment": label,
        "probability": float(score)
    }

    return jsonify(response)

# 加载模型和相似度数据
with open('./pkl/movie_list.pkl', 'rb') as f:
    new_df = pickle.load(f)

with open('./pkl/similarity.pkl', 'rb') as f:
    similarity = pickle.load(f)

@app.route('/content_based_CF_recommendations', methods=['POST'])
def content_based_CF_recommendations():
    # 从请求中获取参数
    data = request.json
    movie = data.get('movie')

    # 检查是否存在符合条件的电影标题
    if movie not in new_df['movie_title'].values:
        return jsonify({'error': f"电影 '{movie}' 不存在于数据集中。"})

    # 获取电影的索引
    index = new_df[new_df['movie_title'] == movie].index[0]

    # 进行推荐
    distances = sorted(list(enumerate(similarity[index])), reverse=True, key=lambda x: x[1])

    # 返回推荐结果
    recommendations = []
    for i in distances[1:20]:
        recommendations.append(new_df.iloc[i[0]].movie_title)

    return jsonify({'recommendations': recommendations})



movies_df = pd.read_csv('./dataset_out/out_simple_movie_infos.csv')
movies = tf.data.Dataset.from_tensor_slices(dict(movies_df[['original_title']]))
movies = movies.map(lambda x: x["original_title"])
tfrs_model = tf.keras.models.load_model("./models/tfrs_model")
def predict_movie(user, top_n=20):
    # Create a model that takes in raw query features,
    index = tfrs.layers.factorized_top_k.BruteForce(tfrs_model.user_model)
    # recommends movies out of the entire movies dataset.
    index.index_from_dataset(
        tf.data.Dataset.zip((movies.batch(100), movies.batch(100).map(tfrs_model.movie_model)))
    )

    # Get recommendations.
    _, titles = index(tf.constant([str(user)]))

    recommendations = [title.decode("utf-8") for title in titles[0, :top_n].numpy()]
    return recommendations

@app.route('/tfrs_predict', methods=['POST'])
def tfrs_predict():
    data = request.get_json()

    # Call the predict_movie function
    user = data['user']
    top_n = data.get('top_n', 20)
    recommendations = predict_movie(user, top_n)

    return jsonify({'recommendations': recommendations})


#we define the route /
@app.route('/')
def welcome():
    # return a json
    return jsonify({'status': 'api working'})

if __name__ == '__main__':
    #define the localhost ip and the port that is going to be used
    # in some future article, we are going to use an env variable instead a hardcoded port
    app.run(host='0.0.0.0', port=os.getenv('PORT'))