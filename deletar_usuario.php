<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM `usuarios` WHERE id_usuario = $id";

$deletar = mysqli_query($conexao, $sql); 

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="container" style="width:400px;">
<center>
<h3>Excluído com sucesso</h3>
<div style="margin-top:10px">
<a href="aprovar_usuarios.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</div>
</center>
</div>