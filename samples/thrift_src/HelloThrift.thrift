namespace php Test.HelloThrift

service HelloService {
	string sayHello(1:string username)
}
