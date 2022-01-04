# php-grpc-server-thrift
The php grpc server framework with thrift and DO NOT use any 3rd libraries.

# Architecture

gRPC Client  => nginx => php-fpm => this framework => custom services

# Usage

1. install with composer

```bash
composer require "hetao29/php-grpc-server-thrift:1.0.0"
```

2. use in php file, like samples/www/index.php

```php
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
```

# Write App Services 

1. proto and genproto to php files

```bash
cd proto && make
```

2. write gRPC Server in services dir like helloworld

```php
<?php
namespace Test\HelloThrift;

class HelloServiceHandler implements HelloServiceIf {

    public function sayHello($username)
    {
        return "Hello ".$username.", how are u?";
    }
}


```

3. test

```bash
php www/client.php
```
