<?php
include 'conexao.php';

$id = $_GET['id'];
$nivel = $_GET['nivel'];

if($nivel == 1){
    $update = "UPDATE usuarios SET STATUS = 'Ativo', nivel_usuario = 1 WHERE id_usuario = $id";
    $atualiza = mysqli_query($conexao, $update);
    echo "Administrador Aprovado";
}

if($nivel == 2){
    $update = "UPDATE usuarios SET STATUS = 'Ativo', nivel_usuario = 2 WHERE id_usuario = $id";
    $atualiza = mysqli_query($conexao, $update);
    echo "Gerente Aprovado";
}

if($nivel == 3){
    $update = "UPDATE usuarios SET STATUS = 'Ativo', nivel_usuario = 3 WHERE id_usuario = $id";
    $atualiza = mysqli_query($conexao, $update);
    echo "Funcionário Aprovado";
}

header("Location: aprovar_usuarios.php"); //redireciona para a página de aprovação



?>