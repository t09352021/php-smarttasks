<?php

include 'conexao.php';



$titulo = $_POST['titulo_employee'];
$codigo = $_POST['codigo_employee'];
$id_gestor = $_POST['id_gestor_employee'];
$tp_projeto = $_POST['tipoprojeto_employee'];
$descricao = $_POST['descricao_projeto_employee'];
$datain = $_POST['datainicio'];
$dataout = $_POST['dataconclusao'];

$diretorio_destino = 'uploads/';

// Verifica se o diretório de destino existe, se não, cria
if (!is_dir($diretorio_destino)) {
    mkdir($diretorio_destino, 0755, true);
}

// Obtém informações sobre o arquivo enviado
$nome_arquivo = $_FILES['contrato']['name'];
$nome_arquivo2 = $_FILES['anexo']['name'];
$caminho_arquivo = $diretorio_destino . $nome_arquivo;
$caminho_arquivo2 = $diretorio_destino . $nome_arquivo2;

// Obtém a extensão do arquivo
$extensao_permitida = ['txt','docx','xlsx','csv','jpeg','png'];
$extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
$extensao_arquivo2 = strtolower(pathinfo($nome_arquivo2, PATHINFO_EXTENSION));

// Verifica se as extensões são permitidas
if($nome_arquivo == "" || $nome_arquivo2 == ""){
    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    }

    $sql = "INSERT into projetos (codigo, titulo, tipo_projeto, fk_gestor, descricao_projeto, contrato, anexo, datain, dataout) values ('$codigo', '$titulo', '$tp_projeto','$id_gestor', '$descricao', '$nome_arquivo', '$nome_arquivo2', '$datain', '$dataout')";


    if ($conexao->query($sql) === TRUE) {
        echo "Arquivos inseridos com sucesso.";
    } else {
        echo "Erro ao inserir arquivos no banco de dados: " . $conexao->error;
    }

    $conexao->close();
}
else{
    if (in_array($extensao_arquivo, $extensao_permitida) || in_array($extensao_arquivo2, $extensao_permitida)) {

        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conexao->connect_error);
        }
    
        $sql = "INSERT into projetos (codigo, titulo, tipo_projeto, fk_gestor, descricao_projeto, contrato, anexo, datain, dataout) values ('$codigo', '$titulo', '$tp_projeto','$id_gestor', '$descricao', '$nome_arquivo', '$nome_arquivo2', '$datain', '$dataout')";
    
    
        if ($conexao->query($sql) === TRUE) {
            "Arquivos inseridos com sucesso.";
        } else {
            "Erro ao inserir arquivos no banco de dados: " . $conexao->error;
        }
    
        $conexao->close();
        
        // Move os arquivos apenas se a operação no banco de dados for bem-sucedida
        if (move_uploaded_file($_FILES['contrato']['tmp_name'], $caminho_arquivo) && move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho_arquivo2)) {
            "Arquivos movidos com sucesso.";
        } else {
            "Erro ao mover os arquivos.";
        }
    
    } else {
        echo "Extensões de arquivo não permitidas.";
    }
}



?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container" style="width : 500px; margin-top: 20px">
<center><h4>Projeto adicionado com sucesso !</h4></center>
<div style="padding-top:20px">
<center><a href="cadastro_projeto_employee.php" role="button" class="btn btn-sm btn-warning">Voltar</a></center>
</div>
</div>