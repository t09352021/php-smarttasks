<?php

include 'conexao.php';

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao_projeto'];
$id_gestor = $_POST['id_gestor'];
$contrato = $_POST['contrato'];
$anexo = $_POST['anexo'];
$datain = $_POST['datain'];
$dataout = $_POST['dataout'];
    
if(($contrato =="") && ($anexo == "")){
    $sql = "UPDATE projetos SET titulo = '$titulo', descricao_projeto = '$descricao', fk_gestor = '$id_gestor', datain = '$datain', dataout = '$dataout' WHERE id_projeto = '$id'";

    $atualizar = mysqli_query($conexao, $sql);
}else if($contrato ==""){
    $sql = "UPDATE projetos SET titulo = '$titulo', descricao_projeto = '$descricao', fk_gestor = '$id_gestor', anexo = '$anexo', datain = '$datain', dataout = '$dataout' WHERE id_projeto = '$id'";

    $atualizar = mysqli_query($conexao, $sql); 
}else if($anexo ==""){
    $sql = "UPDATE projetos SET titulo = '$titulo', descricao_projeto = '$descricao', fk_gestor = '$id_gestor', contrato= '$contrato', datain = '$datain', dataout = '$dataout' WHERE id_projeto = '$id'";

    $atualizar = mysqli_query($conexao, $sql); 
}
else{
    $sql = "UPDATE projetos SET titulo = '$titulo', descricao_projeto = '$descricao', fk_gestor = '$id_gestor', contrato='$contrato', anexo = '$anexo', datain = '$datain', dataout = '$dataout' WHERE id_projeto = '$id'";

    $atualizar = mysqli_query($conexao, $sql);
}
 

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="container" style="width:400px;">
<center>
<h3>Atualizado com sucesso</h3>
<div style="margin-top:10px">
<a href="listar_projeto.php" class="btn btn-sm btn-warning" style="color:#fff">Voltar</a>
</div>
</center>
</div>