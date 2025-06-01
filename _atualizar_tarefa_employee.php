<?php

include 'conexao.php';

$id = $_POST['id'];
$tarefa = $_POST['tarefa'];
$descricao = $_POST['descricao_tarefa'];
$responsavel = $_POST['campoBusca'];
$responsavel2 = $_POST['campoBusca2'];
$prioridade = $_POST['prioridade'];
$datain = $_POST['datain'];
$dataout = $_POST['dataout'];
    

    $sql = "UPDATE tarefas SET tarefa = '$tarefa', prioridade = '$prioridade', descricao_tarefa = '$descricao', responsavel = '$responsavel', responsavel2 ='$responsavel2', datain = '$datain', dataout = '$dataout' WHERE id_tarefa = '$id'";
    $atualizar = mysqli_query($conexao, $sql); 
    
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="container" style="width:400px;">
<center>
<h3>Atualizado com sucesso</h3>
<div style="margin-top:10px">
<a href="listar_tarefa_employee.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</div>
</center>
</div>