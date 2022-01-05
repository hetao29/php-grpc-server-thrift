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
	$root = GRpcClient::$serviceDir."/".str_replace("\\","/",$class).".php";
	if(is_file($root)){
		require_once($root);
	}
});
spl_autoload_register(function($class){
	$root = GRpcClient::$defDir."/".str_replace("\\","/",$class).".php";
	if(is_file($root)){
		require_once($root);
	}
});
final class GRpcClient{

	private static $_instance = NULL;

	//thrift service Dir
	public static $serviceDir="";

	//thrift Definition Dir
	public static $defDir="";
	public function __call($namespace, $service){
	}

	/**
	 * protocol = binary [ json | compact ]
	 */
	public static function getService($host, $port, $namespace, $service, $protocol_name="", array $headers=array()){
		if (isset(self::$_instance[$host][$port][$namespace][$service])) {
			return self::$_instance[$host][$port][$namespace][$service];
		}
		$loader = new Thrift\ClassLoader\ThriftClassLoader();
		$loader->registerDefinition($namespace,ROOT_PROTO_GENERATED);
		$loader->register();
		$socket = new Thrift\Transport\THttpClient($host,$port,"$namespace/$service");
		if(!empty($headers)){
			$socket->addHeaders($headers);
		}
		if(in_array($protocol_name,['binary','json','compact'])){
			$socket->addHeaders(['thrift-protocol'=>$protocol_name]);
		}
		$transport = new Thrift\Transport\TBufferedTransport($socket,1024,1024);
		if($protocol_name=="json"){
			$protocol = new Thrift\Protocol\TJSONProtocol($transport);
		}elseif($protocol_name=="compact"){
			$protocol = new Thrift\Protocol\TCompactProtocol($transport);
		}else{
			$protocol = new Thrift\Protocol\TBinaryProtocol($transport,true,true);
		}
		$namespace_covert = str_replace(".","\\",$namespace);
		$client_name = $namespace_covert."\\".$service."Client";
		return self::$_instance[$host][$port][$namespace][$service] = new $client_name($protocol);
	}
}
