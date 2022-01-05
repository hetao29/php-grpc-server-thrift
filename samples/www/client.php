<?php
define("ROOT",						dirname(__FILE__)."/../");
define("ROOT_LIBS",					ROOT."/libs");
define("ROOT_SERVICE",				ROOT."/service");
define("ROOT_PROTO_GENERATED",		ROOT."/thrift_out/");

require_once(ROOT_LIBS."/vendor/autoload.php");

GRpcClient::$serviceDir=ROOT_SERVICE;
GRpcClient::$defDir=ROOT_PROTO_GENERATED;
try{
	//curl -d '[1,"sayHello",1,0,{"1":{"str":" World!fjow "}}]' -v http://127.0.0.1:50011//Test.HelloThrift/HelloService -H "thrift-protocol:json"
	$service = GRpcClient::getService("127.0.0.1","50011",$namespace="Test.HelloThrift", "HelloService","json",['aa-cus-x'=>'b']);
	$r = $service->sayHello(" World!fjow ");
	var_dump($r);
	$service = GRpcClient::getService("127.0.0.1","50011",$namespace="Test.HelloThrift", "HelloService");
	$r = $service->sayHello(" World! ");

	$req = new Test\HelloThrift\Request();
	$req2 = new Test\HelloThrift\Request2();
	$r = $service->sayHelloRequest($req, $req2);
	print_r($r);
} catch (\Exception $e) {
    print 'TException:'.$e->getMessage().PHP_EOL;
}
