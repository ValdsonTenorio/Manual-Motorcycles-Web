<?php
require_once '../config/db.php';
require_once '../controller/Motor.php';
require_once '../controller/Part.php';
require_once '../Router.php';

$router = Router::getInstance();

$router->add('GET', '/motor', function () { 
    if(isset($_GET["id"])){
        MotorController::getInstance()->getById($_GET["id"]);
    } else {
        MotorController::getInstance()->list();
    }
});
$router->add('POST', '/motor', function () { MotorController::getInstance()->create();});
$router->add('DELETE', '/motor', function () { MotorController::getInstance()->delete();});
$router->add('PUT', '/motor', function () { MotorController::getInstance()->update();});

$router->add('GET', '/part', function () { 
    if(isset($_GET["id"])){
        PartController::getInstance()->getById($_GET["id"]);
    } else {
        PartController::getInstance()->list();
    }
});

$router->add('GET', '/part/motor', function () { 
    if(isset($_GET["id"])){
        PartController::getInstance()->getByMotoId($_GET["id"]);
    }else {
        echo json_encode([
            "msg" => "Parametro Id da moto não presente"
        ]);
    }
});


$router->add('POST', '/part', function () { PartController::getInstance()->create();});
$router->add('DELETE', '/part', function () { PartController::getInstance()->delete();});
$router->add('PUT', '/part', function () { PartController::getInstance()->update();});

Router::getInstance()->process();