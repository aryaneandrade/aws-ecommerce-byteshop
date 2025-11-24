<?php

require_once("../config/database.php");
require_once("../config/url.php");
require_once("../models/Mensagem.php");
require_once("../models/Usuario.php");

session_start();

$message = new Mensagem($BASE_URL);
$usuarioModel = new Usuario($conn);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// --- CADASTRO ---
if($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirm = filter_input(INPUT_POST, "confirmpassword");

    if($name && $email && $password) {
        if($password === $confirm) {
            if($usuarioModel->cadastrar($name, $lastname, $email, $password)) {
                // Redireciona para login.php (que está na raiz)
                $message->setMessage("Cadastro realizado! Faça login.", "success", "login.php");
            } else {
                $message->setMessage("E-mail já cadastrado.", "error", "back");
            }
        } else {
            $message->setMessage("As senhas não batem.", "error", "back");
        }
    } else {
        $message->setMessage("Preencha todos os campos.", "error", "back");
    }

// --- LOGIN ---
} else if($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    if($usuarioModel->logar($email, $password)) {
        // Redireciona para index.php (que está na raiz)
        $message->setMessage("Bem-vindo!", "success", "index.php");
    } else {
        $message->setMessage("Usuário ou senha incorretos.", "error", "back");
    }
} else {
    $message->setMessage("Informações inválidas.", "error", "index.php");
}