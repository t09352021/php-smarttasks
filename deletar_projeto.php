<?php

include 'conexao.php';

$id = $_GET['id'];

$sql_projetos = "DELETE FROM projetos WHERE id_projeto = '$id'";

$deletar_projetos = mysqli_query($conexao, $sql_projetos);
 

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="container" style="width:400px;">
<center>
<h3>Deletado com sucesso</h3>
<div style="margin-top:10px">
<a href="listar_projeto.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</div>
</center>
</div>