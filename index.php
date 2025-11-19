<?php
include_once("templates/header.php");
?>

<!-- BOTTOM NAVBAR (MENU INFERIOR) -->
<nav class="navbar navbar-expand-lg light-bg-color" id="bottom-navbar-container">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <!-- AQUI ESTAVA O ERRO: Voltei para 'me-auto' (Alinha na Esquerda) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#categorias">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="<?= $BASE_URL ?>produtos.php">Produtos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ANIMAÇÃO BLACK FRIDAY -->
<div class="overflow-hidden text-white py-2" id="animacao-bg">
    <div class="animacao">
        <h1 class="m-0">BLACK FRIDAY 2025 NO AR — OFERTAS IMPERDÍVEIS NA BYTE SHOP COM FRETE GRATIS PARA TODO O BRASIL!</h1>
    </div>
</div>

<!-- BANNERS -->
<div class="container" id="banners-container">
    <div class="carousel slide" id="slider" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <!-- Banner 1 (Monitores) -->
            <div class="carousel-item active">
                <!-- Mantendo o nome do arquivo original -->
                <img src="assets/img/banner-monitor.jpg" class="d-block w-100 img-fluid" alt="Banner 1">
                <div class="carousel-caption primary-bg-color ">
                    <h5>Monitores de Alta Performance</h5>
                    <p>Experiência visual imersiva para trabalho e games com tecnologia de ponta</p>
                </div>
            </div>
            
            <!-- Banner 2 (Games) -->
            <div class="carousel-item">
                <!-- Mantendo o nome do arquivo original -->
                <img src="assets/img/banner-ps5.jpg" class="d-block w-100 img-fluid" alt="Banner 2">
                <div class="carousel-caption primary-bg-color">
                    <h5>PlayStation 5: Nova Geração</h5>
                    <p>Gráficos impressionantes, velocidade extrema e jogabilidade sem limites</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- CATEGORIAS -->
<div class="container-fluid" id="categorias">
    <h2>CATEGORIAS</h2>

    <div class="container">
        <div class="row justify-content-around">

            <div class="col-12 dark-bg-color" id="categoria-1">
                <a href="<?= $BASE_URL ?>produtos.php?categoria=Monitores">
                    <h2>Monitores</h2>
                    <!-- Imagem original -->
                    <img src="assets/img/categoria-monitor.png" alt="Monitor">
                </a>
            </div>

            <div class="col-12 secondary-bg-color" id="categoria-2">
                <a href="<?= $BASE_URL ?>produtos.php?categoria=Celulares">
                    <h2>Celulares</h2>
                    <!-- Imagem original -->
                    <img src="assets/img/categoria-celular.png" alt="Celular">
                </a>
            </div>

            <div class="col-12 light-bg-color" id="categoria-3">
                <a href="<?= $BASE_URL ?>produtos.php?categoria=Video Games">
                    <h2>Video Games</h2>
                    <!-- Imagem original -->
                    <img src="assets/img/categoria-videogame.png" alt="Video Game">
                </a>
            </div>
        </div>
    </div>
</div>

<?php
include_once("templates/footer.php");
?>