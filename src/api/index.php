<?php
require_once '../config/db.php';
require_once '../controller/Motor.php';
require_once '../controller/Part.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$motor_controller = new MotorController($pdo);

$router->add('GET', '/motor', [$motor_controller, 'list']);
$router->add('GET', '/motor/{id}', [$motor_controller, 'getById']);
$router->add('POST', '/motor', [$motor_controller, 'create']);
$router->add('DELETE', '/motor/{id}', [$motor_controller, 'delete']);
$router->add('PUT', '/motor/{id}', [$motor_controller, 'update']);

$part_controller = new PartController($pdo);

$router->add('GET', '/part', [$part_controller, 'list']);
$router->add('GET', '/part/{id}', [$part_controller, 'getById']);
$router->add('POST', '/part', [$part_controller, 'create']);
$router->add('DELETE', '/part/{id}', [$part_controller, 'delete']);
$router->add('PUT', '/part/{id}', [$part_controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);