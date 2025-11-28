<?php
include_once("templates/header.php");
?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-uppercase text-warning mb-0">
                <i class="bi bi-graph-up-arrow me-2"></i> Dashboard BI
            </h2>
            <p class="text-white-50 small mb-0">
                Google Looker Studio integrado ao AWS RDS (MySQL)
            </p>
        </div>
        <div>
            <!-- Botão para atualizar a página e forçar recarregamento -->
            <a href="dashboard.php" class="btn btn-dark border-secondary btn-sm me-2">
                <i class="bi bi-arrow-clockwise"></i> Atualizar
            </a>
            <a href="index.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>

    <!-- ÁREA DO IFRAME -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="height: 80vh; background-color: #252525;">

        <!-- 
             IMPORTANTE: 
             Substitua a URL abaixo ('src') pela URL de Incorporação 
             que você copiou do seu Google Looker Studio novo.
        -->
        <iframe width="600" height="450"
            src="https://lookerstudio.google.com/embed/reporting/fb754fb5-bca2-4cc2-b71d-097e49d180b9/page/6q8gF"
            frameborder="0" style="border:0" allowfullscreen
            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
        </iframe>
    </div>

    <div class="alert alert-dark mt-3 d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle-fill me-3 fs-4 text-warning"></i>
        <div>
            <strong>Nota Técnica:</strong> Este painel consome dados diretamente do banco de dados
            <span class="badge bg-secondary">AWS RDS MySQL</span>.
            As atualizações podem levar alguns instantes para refletir no Google Looker Studio devido ao cache da
            ferramenta.
        </div>
    </div>
</div>

<?php include_once("templates/footer.php"); ?>