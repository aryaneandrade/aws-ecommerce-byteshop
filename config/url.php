<?php 

// Define a URL base do sistema de forma dinâmica, combinando protocolo, servidor e diretório atual.


// Essa variável é utilizada para construir links consistentes em toda a aplicação.

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . '?') . '/';

