<?php
$host = 'localhost'; // ou o endereço do servidor
$db = 'urna_eletronica'; // nome do banco de dados
$user = 'root'; // usuário do MySQL
$pass = ''; // senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
