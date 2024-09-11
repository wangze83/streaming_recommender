package conf

type Cfg struct {
	KafkaCfg `ini:"kafka"`
	TailCfg  `ini:"tail"`
}

type KafkaCfg struct {
	Addr  string `ini:"addr"`
	Topic string `ini:"topic"`
}

type TailCfg struct {
	Filename string `ini:"filename"`
}
