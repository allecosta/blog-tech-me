<?php 

$server = "localhost";
$dbname = "db_blogtechme";
$username = "###";
$password = "###";


$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// echo "Conectado com sucesso";