<?php
require_once '../config/db.php';

class Part
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    
    public function create($tipo, $price, $descricao, $id_motors)
    {
        $sql = "INSERT INTO parts (tipo,price,descricao,id_motors ) VALUES (:tipo, :price, :descricao,:id_motors)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id_motors', $id_motors);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT * FROM parts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM parts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id,$tipo, $price, $descricao, $id_motors)
    {
        $sql = "UPDATE parts SET tipo = :tipo, price = :price, descricao = :descricao, id_motors = :id_motors WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id_motors', $id_motors);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM parts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}