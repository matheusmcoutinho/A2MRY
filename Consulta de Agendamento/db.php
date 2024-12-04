<?php
// Dados do banco de dados
$servername = "127.0.0.1"; // Servidor
$username = "root";        // Usuário
$password = "";            // Senha
$dbname = "a2mry";         // Nome do banco de dados
$port = 2908;              // Porta do MySQL

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
