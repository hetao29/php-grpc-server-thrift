install:
	sudo apt install thrift-compiler
gen:
	thrift -r -out thrift_out/ --gen php:server thrift_src/HelloThrift.thrift
	#thrift -r -out thrift_out/ --gen go thrift_src/HelloThrift.thrift

