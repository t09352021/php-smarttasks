<?php
// Conexão com o banco de dados (substitua pelos seus detalhes de conexão)
$host = "localhost";
$usuario = "rootd";
$senha = "";
$banco = "smarttasksdb";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebe o termo de busca do cliente
$termoBusca = strtolower($_GET['termo']);

// Realiza a consulta no banco de dados
$sql = "SELECT email_usuario FROM usuarios WHERE email_usuario LIKE ('%$termoBusca%') AND((nivel_usuario = '2') || (nivel_usuario = '3'))";
$result = $conn->query($sql);

// Processa os resultados e retorna um array JSON
$resultados = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row['email_usuario'];
    }
}

echo json_encode($resultados);

$conn->close();
?>
