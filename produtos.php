<?php
include_once("templates/header.php");
require_once("config/database.php");
require_once("models/Produto.php");

// Instancia o Model 
$produtoModel = new Produto($conn);

// Recupera filtros da URL
$categoriaFiltro = filter_input(INPUT_GET, 'categoria');
$termoPesquisa = filter_input(INPUT_GET, 'search'); // Vindo do form do header

$produtos = [];

// Lógica de Busca
if ($termoPesquisa) {
    // Como simplificamos o Model e não criamos método de busca lá, 
    // fazemos a query direta aqui para não complicar
    $sql = "SELECT * FROM produtos WHERE nome LIKE :termo";
    $stmt = $conn->prepare($sql);
    $termo = "%$termoPesquisa%";
    $stmt->bindParam(":termo", $termo);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($categoriaFiltro) {
    $produtos = $produtoModel->buscarPorCategoria($categoriaFiltro);
} else {
    $produtos = $produtoModel->listarTodos();
}
?>

<!-- LISTAGEM DE PRODUTOS -->
<div class="container py-5">

    <!-- Cabeçalho com Filtros -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel me-2"></i>Filtrar por Categoria
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="<?= $BASE_URL ?>produtos.php?categoria=Video Games">Video
                            Games</a></li>
                    <li><a class="dropdown-item" href="<?= $BASE_URL ?>produtos.php?categoria=Monitores">Monitores</a>
                    </li>
                    <li><a class="dropdown-item" href="<?= $BASE_URL ?>produtos.php?categoria=Celulares">Celulares</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= $BASE_URL ?>produtos.php">Ver Todos</a></li>
                </ul>
            </div>

            <?php if ($categoriaFiltro): ?>
                <span class="badge bg-secondary p-2">
                    Categoria: <?= htmlspecialchars($categoriaFiltro) ?>
                    <a href="<?= $BASE_URL ?>produtos.php" class="text-white ms-2 text-decoration-none">&times;</a>
                </span>
            <?php endif; ?>

            <?php if ($termoPesquisa): ?>
                <span class="badge bg-warning text-dark p-2">
                    Busca: "<?= htmlspecialchars($termoPesquisa) ?>"
                    <a href="<?= $BASE_URL ?>produtos.php" class="text-black ms-2 text-decoration-none">&times;</a>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Grid de Produtos -->
    <div class="row">
        <?php if (empty($produtos)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <h4>Nenhum produto encontrado :(</h4>
                    <p>Tente buscar por outra categoria ou termo.</p>
                    <a href="<?= $BASE_URL ?>produtos.php" class="btn btn-dark mt-2">Ver todos os produtos</a>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($produtos as $produto): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 light-bg-color border-0 shadow-sm">

                        <!-- Imagem -->
                        <div class="text-center p-3 rounded-top"
                            style="height: 220px; display: flex; align-items: center; justify-content: center;">
                            <img src="<?= $BASE_URL . htmlspecialchars($produto['imagem']); ?>" class="img-fluid"
                                style="max-height: 100%; max-width: 100%;" alt="<?= htmlspecialchars($produto['nome']); ?>">
                        </div>

                        <div class="card-body d-flex flex-column text-dark">
                            <!-- Titulo -->
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($produto['nome']); ?></h5>

                            <!-- Descrição  -->
                            <p class="card-text text-muted small flex-grow-1">
                                <?= htmlspecialchars($produto['descricao']); ?>
                            </p>

                            <!-- Preços -->
                            <div class="mt-3">
                                <small class="text-decoration-line-through text-danger">
                                    De: R$ <?= number_format($produto['preco_normal'], 2, ',', '.'); ?>
                                </small>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="h4 mb-0 fw-bold text-success">
                                        R$ <?= number_format($produto['preco_promo'], 2, ',', '.'); ?>
                                    </span>
                                    <?php
                                    // Cálculo simples de desconto
                                    $desc = 100 - ($produto['preco_promo'] * 100 / $produto['preco_normal']);
                                    ?>
                                    <span class="badge bg-danger">-<?= round($desc) ?>%</span>
                                </div>
                                <p class="small text-muted mb-3">à vista no PIX</p>
                            </div>

                            <!-- Botão Comprar -->
                            <form action="<?= $BASE_URL ?>controllers/CarrinhoController.php" method="POST" class="mt-auto">
                                <input type="hidden" name="acao" value="adicionar_carrinho">
                                <input type="hidden" name="product_id" value="<?= $produto['id']; ?>">

                                <button type="submit" class="btn btn-dark w-100 py-2">
                                    <i class="bi bi-cart-plus me-2"></i>Comprar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once("templates/footer.php"); ?>