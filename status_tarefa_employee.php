<html lang="pt-br">
<head>
    <?php
        include 'header.php';
        if (session_status() == PHP_SESSION_NONE) {
			// Se a sessão não estiver iniciada, então inicie a sessão
			session_start();
		}

		$usuario = $_SESSION['usuario'];

		if(!isset($usuario)){
			header('Location: login.php');
		}
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Tarefa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<style>
    /* Remove o destaque azul do option em foco */
    select.task-status option:focus {
        background-color: inherit;
        outline: none;
    }
   
    </style>
<body>
<div class="wrapper">
        <?php include 'menuEmployee.php'; ?>

        <div class="main">
            <?php 
                include 'topo.php'; 
            ?>

<div  id="status">
                
<main class="content">
				<div class="container-fluid p-0">           
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Status Tarefas</h1>
					</div>
                    <div id="cardsContainer">
                    <?php 
                include 'conexao.php';
                $usuario = $_SESSION['usuario'];
                
                $sql_statustarefa = "SELECT t.* , p.titulo AS projeto, u.nome_usuario AS gestor, s.status_tarefa, s.id_statustarefa, t.fk_statustarefa
                FROM tarefas t
                JOIN status_tarefas2 s ON s.id_statustarefa = t.fk_statustarefa
                INNER JOIN projetos p ON t.id_projt = p.id_projeto
                INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                WHERE t.responsavel = '$usuario' OR t.responsavel2 = '$usuario'
                ORDER BY p.titulo ASC
                ";

                $busca_statustarefa = mysqli_query($conexao, $sql_statustarefa);
                $contador = 0;
                while ($dados = mysqli_fetch_array($busca_statustarefa)) {
                            $id_tarefa = $dados['id_tarefa'];
                            $codigo_tarefa = $dados['codtarefa'];
                            $nome_tarefa = $dados['tarefa'];
                            $descricao_tarefa = $dados['descricao_tarefa'];
                            $projeto = $dados['projeto']; 
                            $status = $dados['status_tarefa'];
                            $prioridade = $dados['prioridade'];
                            $id_status = $dados['id_statustarefa'];
                            $responsavel = $dados['responsavel'];
                            $responsavel2 = $dados['responsavel2'];
                            $gestor = $dados['gestor'];

         
                    // Início do card de tarefa
                    if ($contador % 4 == 0) { // Se o contador for múltiplo de 5, fecha a linha atual e abre uma nova
                        echo '</div><div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">';
                    }
                    echo '<div class="col-* col-md-* col-xl-*">';
                        echo '<div class="card mb-3">';
                            echo '<div class="card-header" id="card-header">';
                                echo '<h5 class="card-title mb-0">Projeto: ' . $projeto . '</h5>';
                        echo '</div>';
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Tarefa ' . $nome_tarefa . '</h5>';
                            echo '<p class="card-text">' . $descricao_tarefa . '</p>';                            
                            echo '<p class="card-title">Prioridade: <br>' . $prioridade . '</p>';
                            echo '<p class="card-title">1º Responsável: <br>' . $responsavel . '</p>';
                            echo '<p class="card-title">2º Responsável: <br>' . $responsavel2 . '</p>';
                            echo '<p class="card-title">Gestor: <br>' . $gestor . '</p>';
                    echo '</div>';
                            echo '<ul class="list-group list-group-flush">';
                            echo '<li class="list-group-item">Código: ' . $codigo_tarefa . '</li>';
                            echo '<li class="list-group-item">';
                            echo '<div class="dropdown">';
                            echo '<select class="form-select status_tarefa" aria-label="Default select example" name="status_tarefa" id="status_tarefa" data-id-tarefa="' . $id_tarefa . '" required>';
                            echo '<option>Não iniciado</option>';
                            echo '<option>Em progresso</option>';
                            echo '<option>Aguardando</option>';
                            echo '<option>Concluído</option>';
                            echo '</select>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $contador++;
                    
                }
            
            if($contador == 0){
                echo 'Nenhum card designado para este usuário';
            }                                       
               ?>
                

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Verifica se há um status salvo no armazenamento local ao carregar a página
        $('.status_tarefa').each(function () {
            var idTarefa = $(this).data('id-tarefa');
            var statusSalvo = localStorage.getItem('status_tarefa_' + idTarefa);
            if (statusSalvo) {
                $(this).val(statusSalvo); // Define o valor na dropdown se houver um status salvo
            }
        });

        $(document).on('change', '.status_tarefa', function(){
            // Captura o valor selecionado na dropdown
            var novoStatus = $(this).val();
            var idTarefa = $(this).data('id-tarefa');

            // Envia os dados para a página PHP via AJAX
            $.ajax({
                url: '_atualizar_statustarefa.php',
                type: 'POST',
                data: {id_tarefa: idTarefa, novo_status: novoStatus},
                success: function (response) {
                    alert('Status atualizado com sucesso!');
                    localStorage.setItem('status_tarefa_' + idTarefa, novoStatus);
                    location.reload();
                },
                error: function () {
                    console.error(xhr.responseText);
                    alert('Erro ao atualizar o status.');
                }
            });
        });
    });
</script>

</body>
</html>