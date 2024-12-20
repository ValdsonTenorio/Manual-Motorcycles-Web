<?php
require_once '../model/Part.php';

class PartController
{
    private $part;

    private static $INSTANCE;

    public static function getInstance(){
        if(!isset(self::$INSTANCE)){
            self::$INSTANCE = new PartController();
        }
        return self::$INSTANCE;
    }
    
    public function __construct()
    {
        $this->part = new Part(Database::getInstance());
    }

    public function list()
    {
        $part = $this->part->list();
        echo json_encode($part);
    }
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->tipo) && isset($data->price) && isset($data->descricao) && isset($data->id_motors)) {
            try {
                $this->part->create($data->tipo, $data->price, $data->descricao, $data->id_motors);

                http_response_code(201);
                echo json_encode(["message" => "Peça Cadastrada Com Sucesso"]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao cadastrar peça"]);
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
                $part = $this->part->getById($id);
                if ($part) {
                    echo json_encode($part);
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

    
    public function getByMotoId($id)
    {
        if (isset($id)) {
            try {
                $part = $this->part->getByMotoId($id);
                if ($part) {
                    echo json_encode($part);
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
        if (isset($data->id) && ($data->tipo) && isset($data->price) && isset($data->descricao) && isset($data->id_motors)) {
            try {
                $count = $this->part->update($data->id, $data->tipo, $data->price, $data->descricao, $data->id_motors);
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
                $count = $this->part->delete($data->id);

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