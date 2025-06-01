<?php
include 'conexao.php';
include 'script/password.php';
include 'erro.php';

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senhauser = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

$sql = "SELECT id_usuario, email_usuario, senha_usuario, nivel_usuario,status FROM usuarios WHERE email_usuario = '$usuario'";
$buscar = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($buscar);


if($total > 0) {
    
    $array = mysqli_fetch_array($buscar);
    $id_usuario = $array['id_usuario'];
    $senha = $array['senha_usuario'];
    $nivel = $array['nivel_usuario'];
    $status= $array['status'];
    $senhacodificada = sha1($senhauser);

    if($status == "Inativo" || $nivel == 0){
        // Exibir mensagem de aguardando permissionamento
        header('Location: erro.php?erro=aguardando_permissionamento');
        exit;
    }else{
        if($senhacodificada == $senha) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header('Location: painelStandard.php');
            exit; // Encerra a execução após redirecionamento
        } else {
            // Senha incorreta
            header('Location: erro.php?erro=senha');
            exit;
        }
    }
}else {
    // Email não cadastrado ou senha incorreta
    header('Location: erro.php?erro=email');
    exit;
}




?>