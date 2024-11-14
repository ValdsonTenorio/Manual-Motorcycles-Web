<?php
require_once '../model/Motor.php';

class MotorController
{
    private $motor;

    private static $INSTANCE;

    public static function getInstance(){
        if(!isset(self::$INSTANCE)){
            self::$INSTANCE = new MotorController();
        }
        return self::$INSTANCE;
    }

    public function __construct()
    {
        $this->motor = new Motor(Database::getInstance());
    }

    public function list()
    {
        $motor = $this->motor->list();
        echo json_encode($motor);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nome) && isset($data->mark) && isset($data->cylinder) && isset($data->ano)) {
            try {
                $this->motor->create($data->nome, $data->mark, $data->cylinder, $data->ano);

                http_response_code(201);
                echo json_encode(["message" => "Moto Cadastrada Com Sucesso"]);
            } catch (\Throwable $th) {
                print_r($th);
                http_response_code(500);
                echo json_encode(["message" => "Erro ao cadastrar moto"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $motor = $this->motor->getById($id);
                if ($motor) {
                    echo json_encode($motor);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Cadastro não encontrado"]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar cadastro"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && ($data->nome) && isset($data->mark) && isset($data->cylinder) && isset($data->ano)) {
            try {
                $count = $this->motor->update($data->id, $data->nome, $data->mark, $data->cylinder, $data->ano);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Cadastro atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao cadastrar moto"]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar cadastro"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id)) {
            try {
                $count = $this->motor->delete($data->id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Cadastro deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar Cadastro"]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar Cadastro"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}