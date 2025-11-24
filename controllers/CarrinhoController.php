<?php
session_start();
require_once("../config/url.php");
require_once("../config/database.php");

// Inicializa carrinho
if(!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$acao = filter_input(INPUT_POST, 'acao') ?? filter_input(INPUT_GET, 'acao');

// --- ADICIONAR ---
if ($acao == 'adicionar_carrinho') {
    $product_id = filter_input(INPUT_POST, 'product_id');
    if(isset($_SESSION['carrinho'][$product_id])) {
        $_SESSION['carrinho'][$product_id] += 1;
    } else {
        $_SESSION['carrinho'][$product_id] = 1;
    }
    header("Location: ../carrinho.php");
    exit;

// --- REMOVER ---
} elseif ($acao == 'remover_carrinho') {
    $id = filter_input(INPUT_GET, 'id');
    if(isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
    header("Location: ../carrinho.php");
    exit;

// --- FINALIZAR E IR PARA PAGAMENTO ---
} elseif ($acao == 'finalizar_pedido') {
    
    require_once("../models/Pedido.php");

    // Validações de Login e Carrinho
    if(!isset($_SESSION['user_id'])) {
        $_SESSION['msg'] = "Faça login para finalizar!";
        $_SESSION['type'] = "error";
        header("Location: ../login.php");
        exit;
    }

    // CAPTURA O ENDEREÇO DO POST
    $endereco = [
        'cep'    => filter_input(INPUT_POST, 'cep'),
        'rua'    => filter_input(INPUT_POST, 'rua'),
        'numero' => filter_input(INPUT_POST, 'numero'),
        'bairro' => filter_input(INPUT_POST, 'bairro'),
        'cidade' => filter_input(INPUT_POST, 'cidade'),
        'estado' => filter_input(INPUT_POST, 'estado')
    ];

    // Validação simples de endereço
    if(empty($endereco['cep']) || empty($endereco['numero']) || empty($endereco['rua'])) {
        $_SESSION['msg'] = "Por favor, preencha o endereço e o número da casa.";
        $_SESSION['type'] = "error";
        header("Location: ../carrinho.php");
        exit;
    }

    $pedidoModel = new Pedido($conn);
    
    // Passa o endereço para o método
    $idNovoPedido = $pedidoModel->registrarPedido($_SESSION['user_id'], $_SESSION['carrinho'], $endereco);

    if($idNovoPedido) {
        $_SESSION['carrinho'] = [];
        header("Location: ../sucesso.php?id=" . $idNovoPedido);
        exit;
    } else {
        $_SESSION['msg'] = "Erro ao processar pedido.";
        $_SESSION['type'] = "error";
        header("Location: ../carrinho.php");
        exit;
    }
}
