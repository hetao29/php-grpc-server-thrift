<?php
define("ROOT",						dirname(__FILE__)."/../");
define("ROOT_LIBS",					ROOT."/libs");
define("ROOT_SERVICE",				ROOT."/service");
define("ROOT_PROTO_GENERATED",		ROOT."/thrift_out/");

require_once(ROOT_LIBS."/vendor/autoload.php");

GRpcClient::$serviceDir=ROOT_SERVICE;
GRpcClient::$defDir=ROOT_PROTO_GENERATED;
try{
	$service = GRpcClient::getService("127.0.0.1","50011",$namespace="Test.HelloThrift", "HelloService");
	$r = $service->sayHello(" World! ");
	var_dump($r);
	$service = GRpcClient::getService("127.0.0.1","50011",$namespace="Test.HelloThrift", "HelloService");
	$r = $service->sayHello(" World! ");
	var_dump($r);
} catch (\Exception $e) {
    print 'TException:'.$e->getMessage().PHP_EOL;
}