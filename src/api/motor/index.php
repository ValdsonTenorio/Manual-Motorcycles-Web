<?php
require_once '../config/db.php';
require_once '../controllers/Motor.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new MotorController($pdo);

$router->add('GET', '/motors', [$controller, 'list']);
$router->add('GET', '/motors/{id}', [$controller, 'getById']);
$router->add('POST', '/motors', [$controller, 'create']);
$router->add('DELETE', '/motors/{id}', [$controller, 'delete']);
$router->add('PUT', '/motors/{id}', [$controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);