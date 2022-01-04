namespace php Test.HelloThrift
namespace go Test.HelloThrift

struct Request{
1:i32 number=10,
2:i64 bigNumber,
3:double decimals,
4:string name="thrifty"
}
struct Request2{
1:i32 number=10,
2:i64 bigNumber,
3:double decimals,
4:string name="thrifty"
}
struct Response{
1:i32 number=10,
2:i64 bigNumber,
3:double decimals,
4:string name="thrifty"
}

service HelloService {
	string sayHello(1:string username),
	Response sayHelloRequest(1:Request req, 2:Request2 req1)
}
