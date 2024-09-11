package log_tail

import (
	"github.com/hpcloud/tail"
)

var tailObj *tail.Tail

func Init(path string) error {
	cfg := tail.Config{
		ReOpen: true,
		Follow: true,
		Location: &tail.SeekInfo{
			Offset: 0,
			Whence: 2,
		},
		MustExist: false,
		Poll:      true,
	}
	t, err := tail.TailFile(path, cfg)
	if err != nil {
		return err
	}
	tailObj = t
	return nil
}

func Read() chan *tail.Line {
	return tailObj.Lines
}
