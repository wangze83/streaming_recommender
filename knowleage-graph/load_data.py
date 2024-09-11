import pandas as pd
from neo4j import GraphDatabase

# 连接数据库驱动
uri = "bolt://localhost:7687"
driver = GraphDatabase.driver(uri, auth=("neo4j", "password"))

def load_data():
    with driver.session() as session:
        # 清空数据库
        session.run("""MATCH ()-[r]->() DELETE r""")
        session.run("""MATCH (n) DETACH DELETE n""")

        # --------------从文件中读取数据,存入 neo4j 数据库中------------
        # 加载电影
        print("Loading movies ...")
        session.run("""
            LOAD CSV WITH HEADERS FROM "file:///out_movies.csv" AS csv
            CREATE (:Movie {title: csv.title})
        """)

        # 加载评分
        print("Loading gradings ... ")
        session.run("""
            LOAD CSV WITH HEADERS FROM "file:///out_grade.csv" AS csv
            MERGE(m:Movie {title: csv.title})
            MERGE(u:User {id: toInteger(csv.user_id)})
            CREATE (u)-[:RATED {grading: toInteger(csv.grade)}]->(m)
        """)

        # 加载电影类型
        print("Loading genre ...")
        session.run("""
            LOAD CSV WITH HEADERS FROM "file:///out_genre.csv" AS csv
            MERGE (m:Movie {title: csv.title})
            MERGE (g:Genre {genre: csv.genre})
            CREATE (m)-[:HAS_GENRE]->(g)
        """)

        # # 加载关键词
        # print("Loading keywords ...")
        # session.run("""
        #     LOAD CSV WITH HEADERS FROM "file:///out_keyword.csv" AS csv
        #     MERGE(m:Movie {name: csv.title})
        #     MERGE(k:Keyword {name: csv.keyword})
        #     CREATE (m)-[:HAS_KEYWORD]->(k)
        # """)

        print("Loading director ...")
        session.run("""
            LOAD CSV WITH HEADERS FROM "file:///out_director.csv" AS csv
            MERGE(m:Movie {title: csv.title})
            MERGE(p:Director {name: csv.director})
            CREATE (m)-[:HAS_DIRECTOR]->(p)
        """)

        print("Loading cast ...")
        session.run("""
            LOAD CSV WITH HEADERS FROM "file:///out_cast.csv" AS csv
            MERGE(m:Movie {title: csv.title})
            MERGE(p:Cast {name: csv.cast})
            CREATE (m)-[:HAS_CAST]->(p)
        """)
        # -------------------读取文件完毕-------------------------

load_data()