<?php

include 'conexao.php';
include 'script/password.php';

$id = $_POST['id'];
$nomeusuario = $_POST['nomeusuario'];
$mail = $_POST['emailusuario'];
$senhausuario = $_POST['novasenha'];

$sql = "UPDATE usuarios SET senha_usuario = sha1('$senhausuario') WHERE id_usuario = '$id'";

$atualizar = mysqli_query($conexao, $sql); 

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="container" style="width:400px;">
<center>
<h3>Atualizado com sucesso</h3>
<div style="margin-top:10px">
<a href="reset_senha.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</div>
</center>
</div>