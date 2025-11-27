<?php 
// config/url.php

// No Docker, a aplicação roda na raiz, então deixamos vazio ou "/"
$nome_da_pasta = ""; 

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$BASE_URL = $protocol . $_SERVER['SERVER_NAME'] . "/";

// Se rodar em porta diferente de 80 (ex: localhost:8080), precisa ajustar, 
// mas na produção AWS será porta 80 padrão.
?>