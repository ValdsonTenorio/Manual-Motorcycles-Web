<?php

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    protected function setUp(): void
    {
        $_GET = [];
        $_POST = [];
        $_SERVER['REQUEST_METHOD'] = '';
        $_SERVER['REQUEST_URI'] = '';
    }

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

    public function testListAllMotors()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/motor';

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('motors', $output);
    }

    public function testCreateMotor()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/motor';
        $_POST = ['name' => 'Motor Test', 'power' => '100hp'];

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"status":"success"', $output);
    }

    public function testDeleteMotor()
    {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/motor';
        $_GET['id'] = 2;

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"status":"deleted"', $output);
    }

    public function testUpdateMotor()
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/motor';
        $_POST = ['id' => 3, 'name' => 'Updated Motor'];

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"status":"updated"', $output);
    }

    public function testGetPartByMotorId()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/part/motor';
        $_GET['id'] = 1;

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('parts', $output);
    }

    public function testCreatePart()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/part';
        $_POST = ['name' => 'Part Test', 'motor_id' => 1];

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"status":"success"', $output);
    }

    public function testDeletePart()
    {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/part';
        $_GET['id'] = 2;

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"status":"deleted"', $output);
    }

    public function testUpdatePart()
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/part';
        $_POST = ['id' => 3, 'name' => 'Updated Part'];

        ob_start();
        Router::getInstance()->process();
        $output = ob_get_clean();

        $this->assertStringContainsString('"status":"updated"', $output);
    }
}
