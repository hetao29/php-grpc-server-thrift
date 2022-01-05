all:
	thrift -r -out thrift_out/ --gen php:server thrift_src/HelloThrift.thrift
	thrift -r -out thrift_out/ --gen dart thrift_src/HelloThrift.thrift
	thrift -r -out thrift_out/ --gen js:jquery thrift_src/HelloThrift.thrift
	#thrift -r -out thrift_out/ --gen go thrift_src/HelloThrift.thrift
install:
	#sudo apt install thrift-compiler
	#brew install thrift
