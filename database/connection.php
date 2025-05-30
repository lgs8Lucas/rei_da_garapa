<?php
// Dados do db
$dsn = "mysql:dbname=rei_da_garapa";
$dbuser = "root";
$dbpass = "";

try {
    // Verifica os parâmetros
    $pdo = new PDO($dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
    // Excessão do PDO caso um dos parâmetros for falso
    echo "Falha ao conectar a base de dados!";
}

?>