<?php 
// config/url.php

$nome_da_pasta = ""; 

// Verifica se é HTTPS real OU se é HTTPS vindo do Load Balancer da AWS
if (
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
) {
    $protocol = "https://";
} else {
    $protocol = "http://";
}

$BASE_URL = $protocol . $_SERVER['SERVER_NAME'] . "/";
?>