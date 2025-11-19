<?php
include_once("templates/header.php");
require_once("config/database.php");

// 1. Validação do ID
$idPedido = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Se não tiver ID ou usuário não logado, redireciona via JS (pois o header já foi enviado)
if (!$idPedido || !isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

// 2. Busca dados do pedido
$stmt = $conn->prepare("SELECT valor_total, id_usuario FROM pedidos WHERE id = :id");
$stmt->bindParam(":id", $idPedido);
$stmt->execute();
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Segurança extra (garante que o pedido é do usuário logado)
if (!$pedido || $pedido['id_usuario'] != $_SESSION['user_id']) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

$valorTotal = floatval($pedido['valor_total']);
?>

<div class="container py-5 text-center">
    
    <div class="mb-5">
        <h1 class="fw-bold text-success text-uppercase">Pedido Realizado!</h1>
        <p class="text-white">Número do pedido: #<?= str_pad($idPedido, 4, '0', STR_PAD_LEFT) ?></p>
    </div>

    <!-- CARTÃO DE PAGAMENTO -->
    <div class="card-pix-container">
        
        <div class="card-pix-header">
            <i class="bi bi-qr-code"></i> Pagamento via PIX
        </div>
        
        <div class="card-pix-body">
            <p class="text-muted fw-bold">Valor Total:</p>
            
            <div class="pix-valor">
                R$ <?= number_format($valorTotal, 2, ',', '.') ?>
            </div>
            
            <!-- Imagem do QR Code (API) -->
            <div class="qr-code-wrapper">
                <img src="https://quickchart.io/qr?text=Pagamento_ByteShop_Pedido_<?= $idPedido ?>&size=250&margin=2&dark=000000&light=ffffff" 
                     alt="QR Code Pix" 
                     class="img-fluid"
                     style="width: 250px; height: 250px;">
            </div>

            <p class="small mt-3 text-muted">
                Abra o app do seu banco e escaneie.
            </p>

            <!-- Botão de Ação -->
            <a href="meus_pedidos.php" class="btn-pagar">
                <i class="bi bi-check-lg"></i> JÁ FIZ O PAGAMENTO
            </a>
            
            <a href="index.php" class="link-voltar">Voltar para a loja</a>
        </div>

    </div>
</div>

<?php include_once("templates/footer.php"); ?>