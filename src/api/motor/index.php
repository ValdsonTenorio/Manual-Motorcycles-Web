<?php
require_once '../../config/db.php';
require_once '../controllers/Motor.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new MotorController($pdo);

$router->add('GET', '/', [$controller, 'list']);
$router->add('GET', '/{id}', [$controller, 'getById']);
$router->add('POST', '/', [$controller, 'create']);
$router->add('DELETE', '/{id}', [$controller, 'delete']);
$router->add('PUT', '/{id}', [$controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);