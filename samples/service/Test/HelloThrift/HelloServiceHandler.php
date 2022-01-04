<?php
namespace Test\HelloThrift;

class HelloServiceHandler implements HelloServiceIf {

    public function sayHello($username)
    {
        return "Hello ".$username.", how are u?";
    }
    public function sayHelloRequest(Request $req1,Request2 $req2):Response
    {
		$response = new Response();
		$response->name="xxx";
		return $response;
    }
}

