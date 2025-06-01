<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    // cabeçalho comum
    include 'header.php';
    
    // conexão com o banco de dados
    include 'conexao.php';
    // Inicia a sessão
    session_start();

    // Verifica se o usuário está logado
    $usuario = $_SESSION['usuario'];
    if (!isset($usuario)) {
        header('Location: login.php'); // Redireciona para a página de login se não estiver logado
    }

    // Consulta o nível do usuário logado
    $sql = "SELECT nivel_usuario FROM usuarios WHERE email_usuario = '$usuario' and status = 'Ativo'";
    $buscar = mysqli_query($conexao, $sql);
    $array = mysqli_fetch_array($buscar);
    $nivel = $array['nivel_usuario'];
    ?>

    <!-- Estilos CSS e bibliotecas necessárias -->
    <style>
        .img-cover {
            object-fit: cover;
            object-position: center;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
</head>
<body>

<div class="wrapper">
    <?php
    // Inclui o menu específico para funcionários
    include 'menuEmployee.php';
    ?>
    <div class="main">
        <?php
        // Inclui o topo da página
        include 'topo.php';
        ?>

        <main class="content">
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3"></h1>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Consulta de Projeto</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <table class="table" id="tb-pesquisar">
                                    <thead>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Projeto</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Gestor</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Consulta os projetos relacionados ao usuário logado
                                    $sql_gestor = "SELECT p.*, u.nome_usuario AS gestor
                                                   FROM projetos p
                                                   INNER JOIN tarefas t ON t.id_projt = p.id_projeto
                                                   INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                                   WHERE t.responsavel = '$usuario' OR t.responsavel2 = '$usuario'";

                                    $busca_gestor = mysqli_query($conexao, $sql_gestor);
                                    while ($array = mysqli_fetch_array($busca_gestor)) {
                                        $id_projeto = $array['id_projeto'];
                                        $codigo = $array['codigo'];
                                        $titulo = $array['titulo'];
                                        $descricao = $array['descricao_projeto'];
                                        $gestor = $array['gestor'];
                                        ?>
                                        <tr>
                                            <td><?php echo $codigo ?></td>
                                            <td><?php echo $titulo ?></td>
                                            <td><?php echo $descricao ?></td>
                                            <td><?php echo $gestor ?></td>
                                            <td>
                                                <?php
                                                // Verifica o nível do usuário para exibir a ação correspondente
                                                if ($nivel == 3) {
                                                    ?>
                                                    <a href="editar_projeto_employee.php?id=<?php echo $id_projeto ?>"
                                                       role="button"><i class="bi bi-pencil-square"></i>&nbsp;</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Bibliotecas JavaScript necessárias -->
<!-- jQuery antes do jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Popper.js antes do Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!--DataTables JS -->
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function () {
        // Inicializa o plugin DataTable para a tabela de pesquisa
        $('#tb-pesquisar').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });
</script>

</body>
</html>
