<?php

include 'conexao.php';

$status = '1';
$projeto= $_POST['projeto'];
$tarefa = $_POST["tarefa"];
$prioridade = $_POST["prioridade"];
$codtarefa = $_POST["codtarefa"];
$descricao = $_POST["descricao"];
$datainicio = $_POST["datainicio"];
$dataconclusao = $_POST["dataconclusao"];
$responsavel = $_POST['campoBusca'];
$responsavel2 = $_POST['campoBusca2'];

$partes = explode(' - ', $projeto);
$id_projeto = $partes[0];
$titulo_projeto_parte = $partes[1];

    $sql = "INSERT into tarefas (id_projt, fk_statustarefa, tarefa, prioridade, codtarefa, descricao_tarefa, datain, dataout, responsavel, responsavel2 ) VALUES ('$id_projeto','$status', '$tarefa', '$prioridade', '$codtarefa', '$descricao', '$datainicio', '$dataconclusao', '$responsavel','$responsavel2')";
    $inserir = mysqli_query($conexao, $sql);

   
?>  

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container" style="width : 500px; margin-top: 20px">
<center><h4>Tarefa adicionada com sucesso !</h4></center>
<div style="padding-top:20px">
<center><a href="cadastro_tarefa.php" role="button" class="btn btn-sm btn-warning">Voltar</a></center>

