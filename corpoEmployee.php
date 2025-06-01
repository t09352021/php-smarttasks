<?php
include 'painelStandard.php';
$id_usuario_sessao = $array['id_usuario'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Tarefas</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="file-text"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    include 'conexao.php';
                                    $usuario = $_SESSION['usuario'];

                                    $sql_tarefa = "SELECT COUNT(*) AS total_tarefas
                                    FROM tarefas t	
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt										
                                    WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario')";

                                    $busca_tarefa = mysqli_query($conexao, $sql_tarefa);
                                    while ($dados = mysqli_fetch_array($busca_tarefa)) {
                                        $qtd_tarefas = $dados['total_tarefas'];
                                    }

                                    $sql_prioridade = "SELECT COUNT(*) AS prioridade_alta
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario') AND prioridade = 'Alta'";

                                    $busca_prioridade = mysqli_query($conexao, $sql_prioridade);
                                    while ($dados = mysqli_fetch_array($busca_prioridade)) {
                                        $prioridade_alta = $dados['prioridade_alta'];
                                    }

                                    $sql_tarefaNC = "SELECT COUNT(*) AS tarefa_nao_concluida
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario') AND fk_statustarefa = '1'";

                                    $busca_tarefaNC = mysqli_query($conexao, $sql_tarefaNC);
                                    while ($dados = mysqli_fetch_array($busca_tarefaNC)) {
                                        $tarefaNC = $dados['tarefa_nao_concluida'];
                                    }

                                    $sql_tarefaEP = "SELECT COUNT(*) AS tarefa_em_progresso
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario') AND fk_statustarefa = '2'";

                                    $busca_tarefaEP = mysqli_query($conexao, $sql_tarefaEP);
                                    while ($dados = mysqli_fetch_array($busca_tarefaEP)) {
                                        $tarefaEP = $dados['tarefa_em_progresso'];
                                    }

                                    $sql_tarefaAG = "SELECT COUNT(*) AS tarefa_aguardando
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario') AND fk_statustarefa = '3'";

                                    $busca_tarefaAG = mysqli_query($conexao, $sql_tarefaAG);
                                    while ($dados = mysqli_fetch_array($busca_tarefaAG)) {
                                        $tarefaAG = $dados['tarefa_aguardando'];
                                    }

                                    $sql_tarefaCC = "SELECT COUNT(*) AS tarefa_concluido
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario') AND fk_statustarefa = '4'";

                                    $busca_tarefaCC = mysqli_query($conexao, $sql_tarefaCC);
                                    while ($dados = mysqli_fetch_array($busca_tarefaCC)) {
                                        $tarefaCC = $dados['tarefa_concluido'];
                                    }

                                    $sql_projetos_por_responsavel = "SELECT COUNT(DISTINCT responsavel) + COUNT(DISTINCT responsavel2) AS total_responsaveis
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE t.responsavel = '$usuario' OR t.responsavel2 = '$usuario'
                                    GROUP BY t.responsavel";

                                    $busca_projetos_por_responsavel = mysqli_query($conexao, $sql_projetos_por_responsavel);
                                    while ($dados = mysqli_fetch_array($busca_projetos_por_responsavel)) {
                                        $qnt_responsaveis = $dados['total_responsaveis'];
                                    }
                                    ?>
                                <h1 class="mt-1 mb-3"><?php echo $qtd_tarefas ?></h1>
                                <div class="mb-0">
                                    <span class="text"> <i class="mdi mdi-arrow-bottom-right"> Contagem total</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Tarefas</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="alert-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?php echo $prioridade_alta ?></h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right">Prioridade alta</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Projetos</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $sql = "SELECT COUNT(DISTINCT id_projt) as total_projetos
                                    FROM tarefas t
                                    INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                    WHERE t.responsavel = '$usuario' OR t.responsavel2 = '$usuario'";

                                    $busca = mysqli_query($conexao, $sql);

                                    while ($dados = mysqli_fetch_array($busca)) {
                                        $total_projeto = $dados['total_projetos'];
                                    ?>
                                    <h1 class="mt-1 mb-3"><?php echo $total_projeto ?></h1>
                                    <?php } ?>
                                <div class="mb-0">
                                    <span class="text"> <i class="mdi mdi-arrow-bottom-right">Projetos que possuo tarefas</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Tarefas</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?php echo $tarefaNC ?></h1>
                                <div class="mb-0">
                                    <span class="text"> <i class="mdi mdi-arrow-bottom-right">Não iniciadas</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gráfico Pie tarefas por status -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tarefas por Status</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie-status"></canvas>
                                </div>
                            </div>
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Não iniciado</td>
                                        <td class="text-end"><?php echo $tarefaNC ?></td>
                                    </tr>
                                    <tr>
                                        <td>Em progresso</td>
                                        <td class="text-end"><?php echo $tarefaEP ?></td>
                                    </tr>
                                    <tr>
                                        <td>Aguardando</td>
                                        <td class="text-end"><?php echo $tarefaAG ?></td>
                                    </tr>
                                    <tr>
                                        <td>Concluído</td>
                                        <td class="text-end"><?php echo $tarefaCC ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Calendário -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                    <h5 class="card-title mb-0">Calendário</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
                                            
										</div>
                        </div>
                    </div>
                </div>
                
            </div>


            <!-- Gráfico Pie Tarefas por Prioridade -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tarefas por Prioridade</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie-prioridade"></canvas>
                                </div>
                            </div>
                            <?php
                                include 'conexao.php';
                                $usuario = $_SESSION['usuario'];

                                $sql_total_alta= "SELECT COUNT(id_tarefa) AS total_alta
                                    FROM tarefas 
                                    WHERE prioridade = 'Alta' AND (responsavel = '$usuario' OR responsavel2 = '$usuario')";

                                    $busca_total_alta = mysqli_query($conexao, $sql_total_alta);
                                    while ($dados = mysqli_fetch_array($busca_total_alta)) {
                                        $total_alta = $dados['total_alta'];
                                    }

                                    $sql_total_media= "SELECT COUNT(id_tarefa) AS total_media
                                    FROM tarefas 
                                    WHERE prioridade = 'Média' AND (responsavel = '$usuario' OR responsavel2 = '$usuario')";

                                    $busca_total_media = mysqli_query($conexao, $sql_total_media);
                                    while ($dados = mysqli_fetch_array($busca_total_media)) {
                                        $total_media = $dados['total_media'];
                                    }

                                    $sql_total_baixa= "SELECT COUNT(id_tarefa) AS total_baixa
                                    FROM tarefas 
                                    WHERE prioridade = 'Baixa' AND (responsavel = '$usuario' OR responsavel2 = '$usuario')";

                                    $busca_total_baixa= mysqli_query($conexao, $sql_total_baixa);
                                    while ($dados = mysqli_fetch_array($busca_total_baixa)) {
                                        $total_baixa = $dados['total_baixa'];
                                    }
                            ?>
                             <table class="table mb-0">
											<tbody>
												<tr>
													<td>Alta</td>
													<td class="text-end"><?php echo $total_alta ?></td>
												</tr>
												<tr>
													<td>Media</td>
													<td class="text-end"><?php echo $total_media ?></td>
												</tr>
												<tr>
													<td>Baixa</td>
													<td class="text-end"><?php echo $total_baixa ?></td>
												</tr>
												
											</tbody>
										</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
						<div class="col-12 col-lg-14 col-xxl-9 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Últimas tarefas</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										
										<tr>
											<th>Tarefa</th>
											<th class="d-none d-xl-table-cell">Data de início</th>
											<th class="d-none d-xl-table-cell">Data de entrega</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Responsável</th>
                                            <th class="d-none d-md-table-cell">Projeto</th>
										</tr>
									</thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT t.*, s.status_tarefa AS status_tarefa, u.nome_usuario AS responsavel_nome, 
                                            DATE_FORMAT(t.datain, '%d/%m/%Y') AS data_formatada_in, 
                                            DATE_FORMAT(t.dataout, '%d/%m/%Y') AS data_formatada_out,
                                            p.titulo AS titulo
                                            FROM tarefas t
                                            INNER JOIN usuarios u ON u.email_usuario = '$usuario'
                                            INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                            JOIN status_tarefas2 s ON t.fk_statustarefa = s.id_statustarefa
                                            WHERE (t.responsavel = '$usuario' OR t.responsavel2 = '$usuario')";

                                        $busca = mysqli_query($conexao, $sql);
                                        while ($dados = mysqli_fetch_array($busca)) {
                                            $tarefa = $dados['tarefa'];
                                            $status_tarefa = $dados['status_tarefa'];
                                            $responsavel = $dados['responsavel_nome'];
                                            $projeto = $dados['titulo'];
                                            $datain = $dados['data_formatada_in'];
                                            $dataout = $dados['data_formatada_out'];
                                        ?>
                                            <tr>
                                                <td><?php echo $tarefa ?></td>
                                                <td class="d-none d-xl-table-cell"><?php echo $datain ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo $dataout ?></td>
                                                <td><span class="badge bg-success"><?php echo $status_tarefa ?></span></td>
                                                <td class="d-none d-md-table-cell"><?php echo $responsavel ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo $projeto ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
								</table>
							</div>
</main>
<script>
        $(document).ready(function() {
            $('td span.badge').each(function() {
                var status = $(this).text().trim();
                if (status === 'Concluído') {
                    $(this).addClass('bg-success');
                } else if (status === 'Não iniciado') {
                    $(this).addClass('bg-danger');
                } else if (status === 'Aguardando') {
                    $(this).addClass('bg-warning text-dark');
                } else if (status === 'Em progresso') {
                    $(this).addClass('bg-info text-dark');
                }
            });
        });
    </script>
</body>
</html>
