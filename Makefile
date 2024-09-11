.PHONY: dev release push publish

PROJECT_NAME := streaming_recommender
DEV_NAME = $(PROJECT_NAME)-$(USER)

all: dev

run:
	cd docker/dev && docker-compose -p "$(DEV_NAME)" down && docker-compose -p "$(DEV_NAME)" up --force-recreate

basic_image:
	cd docker/ && docker build -t streaming_recommender_image .

basic_flask_image:
	docker build -f docker/Dockerfile-Flask -t flask_image .

basic_golang_image:
	docker build -f docker/Dockerfile-golang -t basic_golang_image .

gomod:
	docker run --rm \
		-v $(PWD)/realtime-consumption/src/myapp:/go/src/myapp \
		-v /tmp/golang-mod:/go/pkg/mod \
		-w /go/src/myapp \
		-e GOPROXY=https://goproxy.cn \
		-i golang:1.19 \
		sh -c 'go mod tidy && go mod vendor -v && chmod -R 777 /go/src/myapp/vendor'