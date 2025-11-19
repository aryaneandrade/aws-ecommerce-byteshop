<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("config/url.php");
require_once("models/Mensagem.php");

$message = new Mensagem($BASE_URL);
$mensagem = $message->getMessage();

// Conta itens do carrinho
$cartQty = 0;
if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $qtd) {
        $cartQty += $qtd;
    }
}

// Verifica se o usuário está logado
$nomeUsuario = $_SESSION['user_nome'] ?? null;
if ($nomeUsuario) {
    $nomeArray = explode(" ", $nomeUsuario);
    $primeiroNome = $nomeArray[0];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary py-3" data-bs-theme="dark" id="navbar">
            <div class="container">

                <!-- LOGO -->
                <a class="navbar-brand fw-bold fs-4" href="<?= $BASE_URL ?>index.php">ByteShop</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- BUSCA (Ocupa o espaço disponível com flex-grow-1) -->
                    <form class="d-flex mx-lg-4 my-2 my-lg-0 flex-grow-1" role="search"
                        action="<?= $BASE_URL ?>produtos.php" method="GET">
                        <div class="input-group">
                            <input class="form-control" type="search" name="search" placeholder="O que você procura?"
                                aria-label="Search">
                            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>

                    <!-- ÍCONES E USUÁRIO -->
                    <ul class="navbar-nav align-items-center mb-2 mb-lg-0 d-flex flex-row justify-content-between gap-3"
                        id="nav-icons-container">

                        <!-- LÓGICA LOGADO / DESLOGADO -->
                        <?php if ($nomeUsuario): ?>

                            <!-- ÁREA DO USUÁRIO (Tudo junto para não quebrar) -->
                            <li class="nav-item d-flex align-items-center">
                                <div
                                    class="d-flex align-items-center text-white text-nowrap gap-2 bg-dark px-3 py-2 rounded-pill border border-secondary">
                                    <i class="bi bi-person-circle text-warning"></i>
                                    <span class="small">Olá, <strong><?= htmlspecialchars($primeiroNome) ?></strong></span>
                                    <div class="vr text-secondary mx-1"></div>

                                    <a href="<?= $BASE_URL ?>meus_pedidos.php"
                                        class="text-warning text-decoration-none small me-3" title="Meus Pedidos">
                                        <i class="bi bi-bag-fill"></i> Pedidos
                                    </a>


                                    <a href="<?= $BASE_URL ?>logout.php" class="text-danger text-decoration-none fw-bold"
                                        title="Sair" style="font-size: 0.9rem;">
                                         <i class="bi bi-box-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </li>

                        <?php else: ?>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>login.php" class="nav-link text-nowrap">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>cadastro.php" class="nav-link text-nowrap">Cadastrar</a>
                            </li>
                        <?php endif; ?>

                        <!-- CARRINHO -->
                        <li class="nav-item position-relative ms-2">
                            <a href="<?= $BASE_URL ?>carrinho.php" class="nav-link text-white">
                                <i class="bi bi-cart3 fs-4"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 0.7rem;">
                                    <?= $cartQty ?>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- MENSAGEM FLUTUANTE -->
    <?php if (!empty($mensagem) && !empty($mensagem["msg"])): ?>
        <div class="alert alert-<?= $mensagem["type"] == 'success' ? 'success' : 'danger' ?> alert-dismissible fade show shadow container mt-3"
            role="alert">
            <?= $mensagem["msg"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php $message->clearMessage(); ?>
    <?php endif; ?>