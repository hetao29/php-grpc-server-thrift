<?php
namespace Test\HelloThrift;

class HelloServiceHandler implements HelloServiceIf {

    public function sayHello($username)
    {
        return "Hello ".$username.", how are u?";
    }
}

