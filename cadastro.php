<?php include_once("templates/header.php"); ?>

<div class="container">
    <div class="col-md-8 mx-auto" id="form-container">

        <h2 class="text-center fw-bold mb-4">CRIAR CONTA</h2>

        <form action="controllers/AuthController.php" method="POST">
            <input type="hidden" name="type" value="register">

            <div class="row g-3">
                <div class="col-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nome">
                        <label for="name">Digite seu nome</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Sobrenome" >
                        <label for="lastname">Digite seu Sobrenome</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mt-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                <label for="email">Digite seu Email</label>
            </div>

            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" >
                <label for="password">Digite seu Senha</label>
            </div>

            <div class="form-floating mt-3 mb-4">
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirmar Senha" >
                <label for="confirmpassword">Confirme sua Senha</label>
            </div>

            <input type="submit" class="btn btn-dark w-100 btn-lg" value="Cadastrar">
        </form>

        <p class="text-center mt-3">
            <a href="login.php" class="text-dark fw-bold">Já tenho conta</a>
        </p>

    </div>
</div>

<?php include_once("templates/footer.php"); ?>

