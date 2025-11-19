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

    // 1. Validações
    if(!isset($_SESSION['user_id'])) {
        $_SESSION['msg'] = "Faça login para finalizar a compra!";
        $_SESSION['type'] = "error";
        header("Location: ../login.php");
        exit;
    }

    if(empty($_SESSION['carrinho'])) {
        $_SESSION['msg'] = "Carrinho vazio.";
        $_SESSION['type'] = "error";
        header("Location: ../produtos.php");
        exit;
    }

    // 2. Registra no Banco
    $pedidoModel = new Pedido($conn);
    $idUsuario = $_SESSION['user_id'];
    $carrinho = $_SESSION['carrinho'];

    $idNovoPedido = $pedidoModel->registrarPedido($idUsuario, $carrinho);

    if($idNovoPedido) {
        // 3. Sucesso: Limpa o carrinho
        $_SESSION['carrinho'] = []; 
        
        // 4. Redireciona para a TELA DE PAGAMENTO (sucesso.php)
        header("Location: ../sucesso.php?id=" . $idNovoPedido);
        exit;
        
    } else {
        $_SESSION['msg'] = "Erro ao processar pedido.";
        $_SESSION['type'] = "error";
        header("Location: ../carrinho.php");
        exit;
    }
} else {
    header("Location: ../produtos.php");
    exit;
}