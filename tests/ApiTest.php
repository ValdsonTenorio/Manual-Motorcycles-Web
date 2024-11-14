<?php

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetMotorById()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/motor';
        $_GET['id'] = 1;

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"id":1', $output);
    }


}
