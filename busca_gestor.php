<?php
include 'conexao.php';

if (isset($_POST['nome_gestor'])) {
    $nome_gestor = $_POST['nome_gestor'];

    $sql = "SELECT id_usuario, nome_usuario FROM usuarios WHERE nome_usuario LIKE ? LIMIT 1";
    $stmt = $conexao->prepare($sql);
    $nome_gestor_like = "%" . $nome_gestor . "%";
    $stmt->bind_param('s', $nome_gestor_like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(null);
    }
}

$conexao->close();
?>
