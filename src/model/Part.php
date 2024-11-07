<?php
require_once '../config/db.php';

class Motor
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    
    public function create($type, $price, $description, $id_motors)
    {
        $sql = "INSERT INTO parts (type,price,description,id_motors ) VALUES (:type, :price, :description,:id_motors)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_motors', $id_motors);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT id, name FROM parts";
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

    public function update($id,$type, $price, $description, $id_motors)
    {
        $sql = "UPDATE parts SET type = :type, price = :price, description = :description, id_motors = :id_motors WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
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