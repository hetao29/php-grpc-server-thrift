namespace php Test.HelloThrift
namespace go Test.HelloThrift

service HelloService {
	string sayHello(1:string username)
}
