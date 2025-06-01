<?php

include 'conexao.php';

$empresa = $_POST['empresa'];

$sql = "INSERT into empresas (empresa) values ('$empresa')";
$inserir = mysqli_query($conexao, $sql);
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container" style="width : 500px; margin-top: 20px">
<center><h4>Empresa Adicionada com sucesso !</h4></center>
<div style="padding-top:20px">
<center><a href="adicionar_empresa.php" role="button" class="btn btn-sm btn-warning">Voltar</a></center>
</div>
</div>