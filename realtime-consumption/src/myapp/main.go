package main

import (
	"fmt"
	"gopkg.in/ini.v1"
	"myapp/conf"
	"myapp/kafka"
	"myapp/log_tail"
	"time"
)

const retryInterval = 10 * time.Second
const maxRetries = 3

var (
	cfg conf.Cfg
	err error
)

func main() {
	// 0. 初始化配置文件
	err = ini.MapTo(&cfg, "./conf/config.ini")
	if err != nil {
		fmt.Println("init config failed: ", err.Error())
		return
	}

	// 1. 初始化kafka连接
	var err error
	retries := 0
	for retries < maxRetries {
		time.Sleep(retryInterval)
		addr := []string{cfg.KafkaCfg.Addr}
		err = kafka.Init(addr)
		if err == nil {
			fmt.Println("init kafka success.")
			break
		}
		fmt.Println("init kafka failed: ", err.Error())

		retries++
	}

	// 2. 打开日志文件读取
	filename := cfg.TailCfg.Filename
	err = log_tail.Init(filename)
	if err != nil {
		fmt.Println("init tail failed: ", err.Error())
		return
	}
	fmt.Println("init tail success.")

	// 3. 执行
	go run()
	go kafka.Consume()
	select {}
}

func run() {
	topic := cfg.KafkaCfg.Topic
	key := "long"
	// 将日志发送到kafka
	for {
		select {
		case line := <-log_tail.Read():
			// 有日志写入kafka
			err = kafka.SendMsg(topic, key, line.Text)
			fmt.Println("kafka send msg: ", topic, key, line.Text)
			if err != nil {
				fmt.Println("kafka send failed: ", err.Error())
			}
		default:
			time.Sleep(time.Second)
		}
	}
}
