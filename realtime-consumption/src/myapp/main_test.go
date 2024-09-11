package main

import (
	"gopkg.in/ini.v1"
	"myapp/conf"
	"myapp/kafka"
	"myapp/log_tail"
	"testing"
	"time"
)

func TestInitConfig(t *testing.T) {
	var cfg conf.Cfg
	err := ini.MapTo(&cfg, "./conf/config.ini")
	if err != nil {
		t.Errorf("InitConfig failed: %v", err)
	}
}

func TestInitKafka(t *testing.T) {
	var cfg conf.Cfg
	err := ini.MapTo(&cfg, "./conf/config.ini")
	if err != nil {
		t.Errorf("InitConfig failed: %v", err)
	}

	addr := []string{cfg.KafkaCfg.Addr}
	err = kafka.Init(addr)
	if err != nil {
		t.Errorf("InitKafka failed: %v", err)
	}
}

func TestInitLogTail(t *testing.T) {
	var cfg conf.Cfg
	err := ini.MapTo(&cfg, "./conf/config.ini")
	if err != nil {
		t.Errorf("InitConfig failed: %v", err)
	}

	err = log_tail.Init(cfg.TailCfg.Filename)
	if err != nil {
		t.Errorf("InitLogTail failed: %v", err)
	}
}

func TestRun(t *testing.T) {
	var cfg conf.Cfg
	err := ini.MapTo(&cfg, "./conf/config.ini")
	if err != nil {
		t.Errorf("InitConfig failed: %v", err)
	}

	err = kafka.Init([]string{cfg.KafkaCfg.Addr})
	if err != nil {
		t.Errorf("InitKafka failed: %v", err)
	}

	err = log_tail.Init(cfg.TailCfg.Filename)
	if err != nil {
		t.Errorf("InitLogTail failed: %v", err)
	}

	go run()
	go kafka.Consume()

	// Wait for a short time to allow the goroutines to start
	time.Sleep(2 * time.Second)

	// If no error occurred during initialization, consider the test passed
}
