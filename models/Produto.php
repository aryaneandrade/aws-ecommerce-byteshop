<?php

class Produto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarTodos() {
        $stmt = $this->conn->query("SELECT * FROM produtos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorCategoria($categoria) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE categoria = :categoria");
        $stmt->bindParam(":categoria", $categoria);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}