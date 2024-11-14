<?php
require_once '../config/db.php';

class Motor
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($nome, $mark, $cylinder,$ano)
    {
        $sql = "INSERT INTO motors (nome,mark,cylinder,ano) VALUES (:nome, :mark, :cylinder,:ano)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':mark', $mark);
        $stmt->bindParam(':cylinder', $cylinder);
        $stmt->bindParam(':ano', $ano);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT * FROM motors";
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

    public function update($id, $nome, $mark, $cylinder,$ano)
    {
        $sql = "UPDATE motors SET nome = :nome, mark = :mark, cylinder = :cylinder, ano = :ano WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':mark', $mark);
        $stmt->bindParam(':cylinder', $cylinder);
        $stmt->bindParam(':ano', $ano);
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