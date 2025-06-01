<?php
include 'conexao.php';

function verificarEmail($email, $conexao) {
    $email = mysqli_real_escape_string($conexao, $email);
    $sql = "SELECT email_usuario FROM usuarios WHERE email_usuario = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            return "existe";
        }else{
            return "nao_existe";
        }
    }
}

// Uso da função
$email = $_POST['email'] ?? '';
if ($email) {
    $resultado = verificarEmail($email, $conexao);
    echo $resultado;
}

// Fechando a conexão após uso
mysqli_close($conexao);
?>
