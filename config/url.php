<?php 

// Define a URL base do sistema de forma dinâmica, combinando protocolo, servidor e diretório atual.


// Essa variável é utilizada para construir links consistentes em toda a aplicação.

$pasta_do_projeto = "projeto-web-uniruy-atualizado"; 

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/" . $pasta_do_projeto . "/";
