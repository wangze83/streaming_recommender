package kafka

import (
	"fmt"
	"github.com/IBM/sarama"
)

var (
	producer sarama.SyncProducer
	err      error
)

// Init 初始化 client
func Init(addr []string) error {
	config := sarama.NewConfig()
	config.Producer.RequiredAcks = sarama.WaitForAll
	config.Producer.Partitioner = sarama.NewHashPartitioner // 设置选择分区的策略为Hash
	config.Producer.Return.Successes = true                 // 成功交付的消息将在success channel返回

	// 生产者
	producer, err = sarama.NewSyncProducer(addr, config)
	if err != nil {
		return err
	}

	return nil
}

func SendMsg(topic, key, value string) error {

	// 构造一个消息
	msg := &sarama.ProducerMessage{}
	msg.Topic = topic                       // 指定主题Topic
	msg.Value = sarama.StringEncoder(value) // 消息内容
	msg.Key = sarama.StringEncoder(key)     // 设置key

	// 分区ID, 偏移量
	pid, offset, err := producer.SendMessage(msg)
	if err != nil {
		fmt.Println("send msg failed, err:", err)
		return err
	}
	fmt.Printf("pid:%v offset:%v\n", pid, offset)
	return nil
}
