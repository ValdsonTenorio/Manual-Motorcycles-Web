<?php
require_once '../config/db.php';
require_once '../controllers/Part.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new PartController($pdo);

$router->add('GET', '/parts', [$controller, 'list']);
$router->add('GET', '/parts/{id}', [$controller, 'getById']);
$router->add('POST', '/parts', [$controller, 'create']);
$router->add('DELETE', '/parts/{id}', [$controller, 'delete']);
$router->add('PUT', '/parts/{id}', [$controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);