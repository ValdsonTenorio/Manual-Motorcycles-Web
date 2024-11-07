<?php
require_once '../config/db.php';

class Motor
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $oil, $transmission, $battery)
    {
        $sql = "INSERT INTO parts (name,oil,transmission,battery ) VALUES (:name, :oil, :transmission,:battery)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':oil', $oil);
        $stmt->bindParam(':transmission', $transmission);
        $stmt->bindParam(':battery', $battery);
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

    public function update($id, $name, $oil, $transmission, $battery)
    {
        $sql = "UPDATE parts SET name = :name, oil = :oil, transmission = :transmission, battery = :battery WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':oil', $oil);
        $stmt->bindParam(':transmission', $transmission);
        $stmt->bindParam(':battery', $battery);
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