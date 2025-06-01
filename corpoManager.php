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
                                $sql_tarefa = "SELECT COUNT(*) AS total_tarefas, u.id_usuario, p.fk_gestor
                                               FROM projetos p
                                               INNER JOIN tarefas t ON p.id_projeto = t.id_projt
                                               INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                               WHERE u.id_usuario = '$id_usuario_sessao'";    
                                $busca_tarefa = mysqli_query($conexao, $sql_tarefa);
                                while ($dados = mysqli_fetch_array($busca_tarefa)) {
                                    $qtd_tarefas = $dados['total_tarefas'];
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
                                <?php
                                $sql_prioridade = "SELECT COUNT(*) AS prioridade_alta, u.id_usuario, p.fk_gestor
                                                   FROM projetos p
                                                   INNER JOIN tarefas t ON p.id_projeto = t.id_projt
                                                   INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                                   WHERE u.id_usuario = '$id_usuario_sessao' AND t.prioridade = 'Alta'";
                                $busca_prioridade = mysqli_query($conexao, $sql_prioridade);
                                while ($dados = mysqli_fetch_array($busca_prioridade)) {
                                    $prioridade_alta = $dados['prioridade_alta'];
                                }
                                ?>
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
                                $sql = "SELECT COUNT(*) as total_projetos, u.id_usuario, p.fk_gestor
                                        FROM projetos p
                                        INNER JOIN usuarios u ON p.fk_gestor = u.id_usuario
                                        WHERE u.id_usuario = $id_usuario_sessao";
                                $busca = mysqli_query($conexao, $sql);
                                while ($dados = mysqli_fetch_array($busca)) {
                                    $total_projeto = $dados['total_projetos'];
                                }
                                ?>
                                <h1 class="mt-1 mb-3"><?php echo $total_projeto ?></h1>
                                <div class="mb-0">
                                    <span class="text"> <i class="mdi mdi-arrow-bottom-right">Projetos do gestor</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Contratos</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $sql_contrato = "SELECT COUNT(*) AS contrato, u.id_usuario, p.fk_gestor
                                                 FROM projetos p
                                                 INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                                 WHERE u.id_usuario = '$id_usuario_sessao' AND contrato <> '' AND contrato IS NOT NULL";
                                $busca_contrato = mysqli_query($conexao, $sql_contrato);
                                while ($dados = mysqli_fetch_array($busca_contrato)) {
                                    $contrato = $dados['contrato'];
                                }
                                ?>
                                <h1 class="mt-1 mb-3"><?php echo $contrato ?></h1>
                                <div class="mb-0">
                                    <span class="text"> <i class="mdi mdi-arrow-bottom-right">Contagem total</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gráfico Pie Pessoas -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tarefas por Status</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie-pessoas"></canvas>
                                </div>
                            </div>
                            <?php
                            $sql_nao_iniciado = "SELECT COUNT(*) AS total_nao_iniciado
                                                 FROM tarefas t
                                                 INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                                 INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                                 WHERE fk_statustarefa = '1' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_nao_iniciado = mysqli_query($conexao, $sql_nao_iniciado);
                            while ($dados = mysqli_fetch_array($busca_nao_iniciado)) {
                                $total_nao_iniciado = $dados['total_nao_iniciado'];
                            }
                            $sql_em_progresso = "SELECT COUNT(*) AS total_em_progresso
                                                 FROM tarefas t
                                                 INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                                 INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                                 WHERE fk_statustarefa = '2' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_em_progresso = mysqli_query($conexao, $sql_em_progresso);
                            while ($dados = mysqli_fetch_array($busca_em_progresso)) {
                                $total_em_progresso = $dados['total_em_progresso'];
                            }
                            $sql_aguardando = "SELECT COUNT(*) AS total_aguardando
                                               FROM tarefas t
                                               INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                               INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                               WHERE fk_statustarefa = '3' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_aguardando = mysqli_query($conexao, $sql_aguardando);
                            while ($dados = mysqli_fetch_array($busca_aguardando)) {
                                $total_aguardando = $dados['total_aguardando'];
                            }
                            $sql_concluido = "SELECT COUNT(*) AS total_concluido
                                              FROM tarefas t
                                              INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                              INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                              WHERE fk_statustarefa = '4' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_concluido = mysqli_query($conexao, $sql_concluido);
                            while ($dados = mysqli_fetch_array($busca_concluido)) {
                                $total_concluido = $dados['total_concluido'];
                            }
                            ?>
                            <table class="table mb-0">
											<tbody>
												<tr>
													<td>Não iniciado</td>
													<td class="text-end"><?php echo $total_nao_iniciado ?></td>
												</tr>
												<tr>
													<td>Em progresso</td>
													<td class="text-end"><?php echo $total_em_progresso ?></td>
												</tr>
												<tr>
													<td>Aguardando</td>
													<td class="text-end"><?php echo $total_aguardando ?></td>
												</tr>
												<tr>
													<td>Concluído</td>
													<td class="text-end"><?php echo $total_concluido ?></td>
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


            <!-- Gráfico Pie Tarefas -->
            <div class="col-md-6 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tarefas por Prioridade</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie-tarefas"></canvas>
                                </div>
                            </div>
                            <?php
                            $sql_baixa = "SELECT COUNT(*) AS total_baixa
                                          FROM tarefas t
                                          INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                          INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                          WHERE prioridade = 'Baixa' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_baixa = mysqli_query($conexao, $sql_baixa);
                            while ($dados = mysqli_fetch_array($busca_baixa)) {
                                $total_baixa = $dados['total_baixa'];
                            }
                            $sql_media = "SELECT COUNT(*) AS total_media
                                          FROM tarefas t
                                          INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                          INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                          WHERE prioridade = 'Média' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_media = mysqli_query($conexao, $sql_media);
                            while ($dados = mysqli_fetch_array($busca_media)) {
                                $total_media = $dados['total_media'];
                            }
                            $sql_alta = "SELECT COUNT(*) AS total_alta
                                         FROM tarefas t
                                         INNER JOIN projetos p ON p.id_projeto = t.id_projt
                                         INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                                         WHERE prioridade = 'Alta' AND p.fk_gestor = '$id_usuario_sessao'";
                            $busca_alta = mysqli_query($conexao, $sql_alta);
                            while ($dados = mysqli_fetch_array($busca_alta)) {
                                $total_alta = $dados['total_alta'];
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

									<h5 class="card-title mb-0">Últimos projetos</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										
										<tr>
											<th>Projeto</th>
											<th class="d-none d-xl-table-cell">Data de início</th>
											<th class="d-none d-xl-table-cell">Data de entrega</th>
											<th class="d-none d-md-table-cell">Gestor</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										include 'conexao.php';
										$sql = "SELECT p.*, u.id_usuario, p.fk_gestor, u.nome_usuario AS gestor 
										FROM projetos p
										INNER JOIN usuarios u ON p.fk_gestor = u.id_usuario
										WHERE u.id_usuario = $id_usuario_sessao
										ORDER BY titulo";

										$busca = mysqli_query($conexao, $sql);
										while($dados = mysqli_fetch_array($busca)){
											$id_projeto = $dados['id_projeto'];
											$projeto = $dados['titulo'];
											$gestor = $dados['gestor'];
										

										$sql_datain ="SELECT DATE_FORMAT(datain, '%d/%m/%Y') AS data_formatada_in 
										FROM projetos
										WHERE id_projeto = '$id_projeto'
										";
										$busca_datain = mysqli_query($conexao, $sql_datain);
										while($dados = mysqli_fetch_array($busca_datain)){
											$datain = $dados['data_formatada_in'];
										}

										$sql_dataout ="SELECT DATE_FORMAT(dataout, '%d/%m/%Y') AS data_formatada_out 
										FROM projetos
										WHERE id_projeto = '$id_projeto'
										";
										$busca_dataout = mysqli_query($conexao, $sql_dataout);
										while($dados = mysqli_fetch_array($busca_dataout)){
											$dataout = $dados['data_formatada_out'];
										}
										?>
										<tr>
											<td><?php echo $projeto?></td>
											<td class="d-none d-xl-table-cell"><?php echo $datain?></td>
											<td class="d-none d-xl-table-cell"><?php echo $dataout?></td>
											<td class="d-none d-md-table-cell"><?php echo $gestor?></td>
										</tr>
										</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
</main>
</body>
</html>
