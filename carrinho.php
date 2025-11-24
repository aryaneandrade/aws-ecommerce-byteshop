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
            <!-- ESQUERDA: PRODUTOS -->
            <div class="col-lg-7 mb-4">
                <div class="table-responsive shadow-sm">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Produto</th>
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
                                            <img src="<?= $BASE_URL . htmlspecialchars($item['imagem']); ?>" class="img-fluid rounded border p-1 me-3" style="width: 50px;">
                                            <span class="fw-bold small text-dark"><?= $item['nome'] ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold"><?= $item['qtd_comprada'] ?></td>
                                    <td class="text-center text-success fw-bold">R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                                    <td class="text-center">
                                        <a href="controllers/CarrinhoController.php?acao=remover_carrinho&id=<?= $item['id'] ?>" class="text-danger"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- DIREITA: ENDEREÇO E TOTAL (FORMULÁRIO) -->
            <div class="col-lg-5">
                
                <!-- FORMULÁRIO QUE ENVIA TUDO PARA O PROCESSAMENTO -->
                <form action="controllers/CarrinhoController.php" method="POST">
                    <input type="hidden" name="acao" value="finalizar_pedido">

                    <div class="card border-0 shadow-sm rounded-4 bg-white text-dark">
                        <div class="card-header bg-warning fw-bold text-center py-3">ENTREGA & PAGAMENTO</div>
                        <div class="card-body p-4">
                            
                            <!-- API VIA CEP -->
                            <label class="form-label fw-bold small"><i class="bi bi-geo-alt"></i> ENDEREÇO DE ENTREGA</label>
                            
                            <div class="input-group mb-2">
                                <input type="text" id="cepInput" name="cep" class="form-control" placeholder="Digite seu CEP" maxlength="9" required>
                                <button class="btn btn-dark" type="button" onclick="ApiService.consultarFrete()">Buscar</button>
                            </div>
                            
                            <div id="msgFrete"></div>

                            <!-- CAMPOS DE ENDEREÇO (Preenchidos pela API + Número manual) -->
                            <div class="row g-2 mt-2">
                                <div class="col-8">
                                    <input type="text" id="rua" name="rua" class="form-control form-control-sm bg-light" placeholder="Rua" readonly required>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="numero" name="numero" class="form-control form-control-sm" placeholder="Nº" required>
                                </div>
                                <div class="col-5">
                                    <input type="text" id="bairro" name="bairro" class="form-control form-control-sm bg-light" placeholder="Bairro" readonly required>
                                </div>
                                <div class="col-5">
                                    <input type="text" id="cidade" name="cidade" class="form-control form-control-sm bg-light" placeholder="Cidade" readonly required>
                                </div>
                                <div class="col-2">
                                    <input type="text" id="estado" name="estado" class="form-control form-control-sm bg-light" placeholder="UF" readonly required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between fs-4 fw-bold mb-4">
                                <span>Total:</span>
                                <span class="text-success">R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                                    <i class="bi bi-check-lg me-2"></i>FINALIZAR COMPRA
                                </button>
                                <a href="produtos.php" class="btn btn-outline-secondary btn-sm">Continuar Comprando</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include_once("templates/footer.php"); ?>