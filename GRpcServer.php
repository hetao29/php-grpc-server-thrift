<?php
/*{{{LICENSE
+-----------------------------------------------------------------------+
|                             Php Grpc Server                           |
+-----------------------------------------------------------------------+
| This program is free software; you can redistribute it and/or modify  |
| it under the terms of the GNU General Public License as published by  |
| the Free Software Foundation. You should have received a copy of the  |
| GNU General Public License along with this program.  If not, see      |
| http://www.gnu.org/licenses/.                                         |
| Copyright (C) 2008-2009. All Rights Reserved.                         |
+-----------------------------------------------------------------------+
| Supports: https://github.com/hetao29/php-grpc-server-thrift           |
+-----------------------------------------------------------------------+
}}}*/
/**
 * @package GRpcServer
 */
spl_autoload_register(function($class){
	$root = GRpcServer::$serviceDir."/".str_replace("\\","/",$class).".php";
	if(is_file($root)){
		require_once($root);
	}
});
spl_autoload_register(function($class){
	$root = GRpcServer::$defDir."/".str_replace("\\","/",$class).".php";
	if(is_file($root)){
		require_once($root);
	}
});
final class GRpcServer{

	//thrift service Dir
	public static $serviceDir="";

	//thrift Definition Dir
	public static $defDir="";

	/**
	 * main method!
	 *
	 * @return false | binary str
	 */
	public static function run(){
		//URI formst : /$namespace/$service
		$uri = $_SERVER['REQUEST_URI'] ?? "";
		$protocol_name = $_SERVER['HTTP_THRIFT_PROTOCOL'] ?? "";
		$part = preg_split('/[\/]/',$uri,-1,PREG_SPLIT_NO_EMPTY);
		if(count($part)<2){
			return false;
		}
		$namespace= str_replace(".","\\",$part[0]);
		$service = $part[1];
		$loader = new Thrift\ClassLoader\ThriftClassLoader();
		$loader->registerDefinition($namespace,ROOT_PROTO_GENERATED);
		$loader->register();
		header('Content-Type','application/x-thrift');
		$processor_name = $namespace."\\".$service."Processor";
		$handler_name = $namespace."\\".$service."Handler";
		if(!class_exists($processor_name)){
			return false;
		}
		if(!class_exists($handler_name)){
			return false;
		}
		$transport = new Thrift\Transport\TBufferedTransport(new Thrift\Transport\TPhpStream(Thrift\Transport\TPhpStream::MODE_R | Thrift\Transport\TPhpStream::MODE_W));
		if($protocol_name == "json"){
			$protocol = new Thrift\Protocol\TJSONProtocol($transport);
		}elseif($protocol_name =="compact"){
			$protocol = new Thrift\Protocol\TCompactProtocol($transport);
		}else{
			$protocol = new Thrift\Protocol\TBinaryProtocol($transport,true,true);
		}
		$handler = new $handler_name();
		$processor = new $processor_name($handler);
		$transport->open();
		$processor->process($protocol,$protocol);
		$transport->close();
		return true;
	}
}
