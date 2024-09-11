import nltk
from nltk.tokenize import word_tokenize, sent_tokenize
from nltk.corpus import stopwords

nltk.download("punkt")
nltk.download("stopwords")

def extract_keywords(movie_description):
    # 分句
    sentences = sent_tokenize(movie_description)

    # 分词和移除停用词
    stop_words = set(stopwords.words("english"))
    keywords = []

    for sentence in sentences:
        words = word_tokenize(sentence)
        words = [word.lower() for word in words if word.isalnum() and word.lower() not in stop_words]
        keywords.extend(words)

    return keywords

movie_description = "A doctor&#8217;s wife is arrested for educating impoverished women about birth control."

keywords = extract_keywords(movie_description)
print(keywords)
