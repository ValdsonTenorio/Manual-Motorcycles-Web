<?php
require_once '../config/db.php';

class Motor
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $mark, $cylinder,$year)
    {
        $sql = "INSERT INTO motors (name,mark,cylinder,year ) VALUES (:name, :mark, :cylinder,:year)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mark', $mark);
        $stmt->bindParam(':cylinder', $cylinder);
        $stmt->bindParam(':year', $year);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT id, name FROM motors";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM motors WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $mark, $cylinder,$year)
    {
        $sql = "UPDATE motors SET name = :name, mark = :mark, cylinder = :cylinder, year = :year WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mark', $mark);
        $stmt->bindParam(':cylinder', $cylinder);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM motors WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}