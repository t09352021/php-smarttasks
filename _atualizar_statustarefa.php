<?php

include 'conexao.php';

// Verifica se os dados foram recebidos via POST
if (isset($_POST['novo_status'], $_POST['id_tarefa'])) {
    $novoStatus = $_POST['novo_status'];
    $idTarefa = $_POST['id_tarefa'];

    // Prepara a consulta SQL com base no novo status recebido
    if ($novoStatus == "Concluído") {
        $sql = "UPDATE tarefas SET fk_statustarefa = 4 WHERE id_tarefa = '$idTarefa'";
    } else if ($novoStatus == "Aguardando") {
        $sql = "UPDATE tarefas SET fk_statustarefa = 3 WHERE id_tarefa = '$idTarefa'";
    } else if ($novoStatus == "Em progresso") {
        $sql = "UPDATE tarefas SET fk_statustarefa = 2 WHERE id_tarefa = '$idTarefa'";
    } else if ($novoStatus == "Não iniciado") {
        $sql = "UPDATE tarefas SET fk_statustarefa = 1 WHERE id_tarefa = '$idTarefa'";
    }

    // Executa a consulta SQL
    if (mysqli_query($conexao, $sql)) {
        echo 'Status atualizado com sucesso!';
    } else {
        echo 'Erro ao atualizar o status: ' . mysqli_error($conexao);
    }
} else {
    echo 'Requisição inválida';
}
?>
