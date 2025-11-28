<?php
include_once("templates/header.php");
?>

<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-uppercase text-warning mb-0">
                <i class="bi bi-graph-up-arrow me-2"></i> Dashboard
            </h2>
            <p class="text-muted small mb-0">Acompanhamento de vendas em tempo real</p>
        </div>
        <a href="index.php" class="btn btn-outline-light btn-sm">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <!-- IFRAME DENTRO DE UM CARD -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="height: 75vh; background-color: #252525;">
        <iframe 
            src="https://lookerstudio.google.com/embed/reporting/fb754fb5-bca2-4cc2-b71d-097e49d180b9/page/6q8gF" 
            style="width: 100%; height: 100%; border:0;" 
            allowfullscreen 
            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
        </iframe>
    </div>
</div>

<?php include_once("templates/footer.php"); ?>