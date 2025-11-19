<?php
include_once("templates/header.php");
require_once("config/database.php");
require_once("models/Produto.php");

$produtoModel = new Produto($conn);
$produtosCarrinho = [];
$totalCarrinho = 0;

if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    foreach($_SESSION['carrinho'] as $id => $qtd) {
        $item = $produtoModel->buscarPorId($id);
        if($item) {
            $item['qtd_comprada'] = $qtd;
            $item['subtotal'] = $item['preco_promo'] * $qtd;
            $totalCarrinho += $item['subtotal'];
            $produtosCarrinho[] = $item;
        }
    }
}
?>

<div class="container py-5" style="min-height: 60vh;">
    <h2 class="mb-4 fw-bold text-uppercase"><i class="bi bi-cart3 me-2"></i>Carrinho</h2>

    <?php if (empty($produtosCarrinho)): ?>
        <div class="alert alert-secondary text-center p-5 rounded-4">
            <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
            <h4>Seu carrinho está vazio!</h4>
            <a href="<?= $BASE_URL ?>produtos.php" class="btn btn-warning fw-bold px-4 rounded-pill mt-3">Ir às Compras</a>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="table-responsive shadow-sm ">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Qtd</th>
                                <th>Subtotal</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtosCarrinho as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $BASE_URL . htmlspecialchars($item['imagem']); ?>" class="img-fluid rounded border p-1 me-3" style="width: 60px;">
                                            <span class="fw-bold small"><?= htmlspecialchars($item['nome']); ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center small">R$ <?= number_format($item['preco_promo'], 2, ',', '.'); ?></td>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $item['qtd_comprada']; ?></span></td>
                                    <td class="text-center fw-bold text-success">R$ <?= number_format($item['subtotal'], 2, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <a href="<?= $BASE_URL ?>process/cart_process.php?acao=remover_carrinho&id=<?= $item['id']; ?>" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white text-dark">
                    <div class="card-header bg-warning fw-bold text-center py-3">RESUMO</div>
                    <div class="card-body p-4">
                        
                        <!-- API DE FRETE -->
                        <div class="mb-4 p-3 bg-light rounded-3 border border-dashed">
                            <label class="form-label fw-bold small text-muted"><i class="bi bi-truck"></i> FRETE (ViaCEP)</label>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" id="cepInput" class="form-control" placeholder="00000-000" maxlength="9">
                                <button class="btn btn-dark" onclick="ApiService.consultarFrete('cepInput', 'resultadoFrete')">OK</button>
                            </div>
                            <div id="resultadoFrete" class="small fw-bold"></div>
                        </div>

                        <div class="d-flex justify-content-between fs-4 fw-bold mb-4">
                            <span>Total:</span>
                            <span class="text-success">R$ <?= number_format($totalCarrinho, 2, ',', '.'); ?></span>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="<?= $BASE_URL ?>process/cart_process.php?acao=finalizar_pedido" class="btn btn-success btn-lg fw-bold shadow-sm">
                                <i class="bi bi-check-lg me-2"></i>FINALIZAR
                            </a>
                            <a href="<?= $BASE_URL ?>produtos.php" class="btn btn-outline-secondary btn-sm">Continuar Comprando</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include_once("templates/footer.php"); ?>