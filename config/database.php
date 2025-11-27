<?php 
// config/database.php

$db_host = getenv('DB_HOST') ?: "localhost";
$db_name = getenv('DB_NAME') ?: "black_friday";
$db_user = getenv('DB_USER') ?: "root";
$db_pass = getenv('DB_PASS') ?: "";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {   
    // Em produção, evite exibir o erro detalhado do banco para o usuário
    echo "Erro de conexão com o banco de dados.";
    // error_log($e->getMessage()); // Logar o erro internamente
}
?>