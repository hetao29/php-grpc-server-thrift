<?php
namespace Test\HelloThrift;

/**
 * Autogenerated by Thrift Compiler (0.15.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

interface HelloServiceIf
{
    /**
     * @param string $username
     * @return string
     */
    public function sayHello($username);
    /**
     * @param \Test\HelloThrift\Request $req
     * @param \Test\HelloThrift\Request2 $req1
     * @return \Test\HelloThrift\Response
     */
    public function sayHelloRequest(\Test\HelloThrift\Request $req, \Test\HelloThrift\Request2 $req1);
}
