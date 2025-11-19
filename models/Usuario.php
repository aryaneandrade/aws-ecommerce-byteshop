<?php

class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrar($nome, $sobrenome, $email, $senha) {
        // Verifica se já existe
        $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return false; // Usuário já existe
        }

        // Cria hash da senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $nomeCompleto = $nome . " " . $sobrenome;

        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(":nome", $nomeCompleto);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senhaHash);
        $stmt->execute();
        return true;
    }

    public function logar($email, $senha) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            // Verifica a senha criptografada
            if(password_verify($senha, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome'];
                return true;
            }
        }
        return false;
    }
}