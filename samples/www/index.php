<?php
define("ROOT",						dirname(__FILE__)."/../");
define("ROOT_LIBS",					ROOT."/libs");
define("ROOT_SERVICE",				ROOT."/service");
define("ROOT_PROTO_GENERATED",		ROOT."/thrift_out/");

require_once(ROOT_LIBS."/vendor/autoload.php");

GRpcServer::$serviceDir=ROOT_SERVICE;
GRpcServer::$defDir=ROOT_PROTO_GENERATED;
if(($r=GRpcServer::run())!==false){
}
