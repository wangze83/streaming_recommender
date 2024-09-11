import os
from flask import Flask, request, jsonify
from sklearn.preprocessing import LabelEncoder
import numpy as np
import pandas as pd
import re
import tensorflow as tf
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
from tensorflow.keras.models import load_model
from sklearn.model_selection import train_test_split
import nltk
from nltk.corpus import stopwords
from nltk.stem import SnowballStemmer # 提取词干

file_path = "stopwords.txt"

if os.path.exists(file_path):
    stop_words = set()
    with open(file_path, "r") as file:
        for line in file:
            stop_words.add(line.strip())
else:
    nltk.download("stopwords") # 下载停用词
    # 保存停用词列表到本地
    stop_words = set(stopwords.words("english"))
    with open(file_path, "w") as file:
        for word in stop_words:
            file.write(word + "\n")

# 1. 读取数据集
dataset = pd.read_csv("training.1600000.processed.noemoticon.csv", engine="python", header=None, encoding='ISO-8859-1')
dataset.columns = ['sentiment', 'id', 'date', 'query', 'user_id', 'text']
df = dataset.drop(['id', 'date', 'query', 'user_id'], axis=1)

MAX_SEQ_LENGTH = 30  # 与模型训练时的序列长度相匹配
tokenizer = Tokenizer()
stemmer = SnowballStemmer('english')
text_cleaning_re = '@\S+|https?:\S+|http?:\S|[^A-Za-z0-9]+'
def preprocessing(text, stem=False):
    text = re.sub(text_cleaning_re, ' ', str(text).lower()).strip()
    tokens = []
    for token in text.split():
        if token not in stop_words:
            if stem:
                tokens.append(stemmer.stem(token)) # 提取词干
            else:
                tokens.append(token) # 直接保存单词
    return ' '.join(tokens)
df.text = df.text.apply(lambda x : preprocessing(x))
train_dataset, test_dataset = train_test_split(df, test_size = 0.2, random_state = 666, shuffle=True)
train_dataset.to_csv("train_dataset.csv", index=False)
