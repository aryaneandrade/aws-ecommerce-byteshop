<?php
include_once("templates/header.php");
require_once("config/database.php");
require_once("models/Pedido.php");

// Segurança: Verifica se está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pedidoModel = new Pedido($conn);
$pedidos = $pedidoModel->listarPorUsuario($_SESSION['user_id']);
?>

<div class="container py-5" style="min-height: 70vh;">
    <h2 class="mb-4 fw-bold text-uppercase"><i class="bi bi-clock-history me-2"></i>Meus Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-dark text-center p-5 rounded-4">
            <i class="bi bi-bag-x fs-1 d-block mb-3 text-secondary"></i>
            <h4>Nenhum pedido encontrado.</h4>
            <p class="text-muted">Você ainda não realizou nenhuma compra conosco.</p>
            <a href="produtos.php" class="btn btn-warning mt-3 rounded-pill px-4 fw-bold">Ir para a Loja</a>
        </div>
    <?php else: ?>
        
        <div class="table-responsive shadow-lg">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="text-center text-uppercase small text-warning">
                    <tr>
                        <th scope="col"># ID</th>
                        <th scope="col">Data</th>
                        <th scope="col" class="text-start w-50">Itens Comprados</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <!-- ID DO PEDIDO (CORRIGIDO PARA BRANCO) -->
                            <td class="fw-bold text-white">
                                #<?= str_pad($pedido['id'], 4, '0', STR_PAD_LEFT) ?>
                            </td>
                            
                            <!-- DATA -->
                            <td>
                                <span class="d-block fw-bold"><?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></span>
                                <small class="text-white-50"><?= date('H:i', strtotime($pedido['data_pedido'])) ?></small>
                            </td>
                            
                            <!-- LISTA DE ITENS -->
                            <td class="text-start">
                                <span class="small text-light fst-italic">
                                    <?= $pedido['resumo_itens'] ?>
                                </span>
                            </td>
                            
                            <!-- VALOR TOTAL -->
                            <td class="fw-bold text-success">
                                R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i> APROVADO
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>
</div>

<?php include_once("templates/footer.php"); ?>