<?php 

// Faz a conexão com o Banco de dados

// Variaveis 

$db_host= "localhost";
$db_name= "black_friday";
$db_user= "root";
$db_pass= "Admin@123";

// Faz a conexão com o banco utilizando PDO 
try{

    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    // Ativar modo de erros 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){   

     // Erro na conexão 
    $error = $e->getMessage();
    echo "Erro: ". $error;
}

?>