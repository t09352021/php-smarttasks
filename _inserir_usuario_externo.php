<?php

include 'conexao.php';
include 'script/password.php';


$nomeusuario = $_POST['nomeusuario'];
$mail = $_POST['emailusuario'];
$senhausuario = $_POST['senhausuario'];
//$nivelusuario = $_POST['nivelusuario'];
$status = 'Inativo';
date_default_timezone_set('America/Sao_Paulo');
$data_atual = date("Y-m-d H:i:s");

$sql = "INSERT into usuarios (nome_usuario, email_usuario, senha_usuario, status, created) values ('$nomeusuario', '$mail', sha1('$senhausuario'), '$status', '$data_atual')";
$inserir = mysqli_query($conexao, $sql);

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container" style="width : 500px; margin-top: 20px">
<center><h4>Usuário Adicionado com sucesso, esperando aprovação.</h4></center>
<div style="padding-top:20px">
<center><a href="cadastro_usuario_externo.php" role="button" class="btn btn-sm btn-warning">Voltar</a></center>
</div>
</div>