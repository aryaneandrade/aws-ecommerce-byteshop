<?php include_once("templates/header.php");

?>

<div class="container">

    <div class="col-md-6 mx-auto" id="form-container">
        <h2 class="text-center mb-4">LOGIN</h2>

        <form action="controllers/AuthController.php" method="POST">
            <input type="hidden" name="type" value="login">

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email"
                    >
                <label for="email" class="form-label">Digite seu email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha"
                    >
                <label for="password" class="form-label">Digite sua senha</label>
            </div>
            <input type="submit" class="btn btn-dark w-100 btn-lg" value="Entrar">
        </form>
             <p class="text-center mt-3"><a href="cadastro.php" class="text-dark fw-bold">Criar Conta</a></p>
    </div>
</div>

<?php
include_once("templates/footer.php");
?>