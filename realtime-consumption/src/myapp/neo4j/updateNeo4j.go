package neo4j

import (
	"github.com/neo4j/neo4j-go-driver/v4/neo4j"
)

var (
	neo4jURI      = "bolt://neo4j:7687"
	neo4jUsername = "neo4j"
	neo4jPassword = "password"
)

func UpdateNeo4j(data map[string]interface{}) error {
	driver, err := neo4j.NewDriver(neo4jURI, neo4j.BasicAuth(neo4jUsername, neo4jPassword, ""))
	if err != nil {
		return err
	}
	defer driver.Close()

	session, err := driver.Session(neo4j.AccessModeWrite)
	if err != nil {
		return err
	}
	defer session.Close()

	result, err := session.WriteTransaction(func(transaction neo4j.Transaction) (interface{}, error) {
		result, err := transaction.Run(
			`MERGE (m:Movie {title: $title})
			 MERGE (u:User {id: toInteger($user_id)})
			 CREATE (u)-[:RATED {grading: toInteger($grade)}]->(m)`,
			map[string]interface{}{
				"title":   data["title"],
				"user_id": data["user_id"],
				"grade":   data["grade"],
			},
		)
		if err != nil {
			return nil, err
		}
		return result, nil
	})

	if err != nil {
		return err
	}

	// Handle the result if needed
	_ = result
	return nil
}
