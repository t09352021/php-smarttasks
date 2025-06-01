<?php
include 'painelStandard.php';
$id_usuario_sessao = $array['id_usuario'];
?>
<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Usuários</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<?php	include 'conexao.php';
													$sql_usuario = "SELECT COUNT(id_usuario) AS total_usuarios_ativo 
													FROM usuarios
													WHERE status = 'Ativo'";	

													$busca_usuario = mysqli_query($conexao, $sql_usuario);
													while($dados = mysqli_fetch_array($busca_usuario)){
														$total_usuarios_ativo = $dados['total_usuarios_ativo'];	
													}
													
													$sql_usuario = "SELECT COUNT(id_usuario) AS total_usuarios 
													FROM usuarios";	

													$busca_usuario = mysqli_query($conexao, $sql_usuario);
													while($dados = mysqli_fetch_array($busca_usuario)){
														$total_usuarios = $dados['total_usuarios'];	
													}
													
													$sql_admin = "SELECT COUNT(*) AS contagem_admin
													FROM usuarios
													WHERE nivel_usuario = 1";

													$busca_admin = mysqli_query($conexao, $sql_admin);
													while($dados = mysqli_fetch_array($busca_admin)){
														$contagem_admin = $dados['contagem_admin'];	
													}	
													
													$sql_excluido = "SELECT COUNT(*) AS contagem_excluido
													FROM usuarios 
													WHERE status = 'excluido'";

													$busca_excluido = mysqli_query($conexao, $sql_excluido);
													while($dados = mysqli_fetch_array($busca_excluido)){
														$contagem_excluido = $dados['contagem_excluido'];	
													}	


													$sql_inativo = "SELECT COUNT(*) AS contagem_inativo
													FROM usuarios
													WHERE status = 'Inativo'";	
													
													$busca_inativo = mysqli_query($conexao, $sql_inativo);
													while($dados = mysqli_fetch_array($busca_inativo)){
														$contagem_inativo = $dados['contagem_inativo'];
													}	
												?>													
												<h1 class="mt-1 mb-3"><?php echo $total_usuarios_ativo ?></h1>
												<div class="mb-0">
													<span class="text"> <i class="mdi mdi-arrow-bottom-right"> usuários com status ativo</i></span>
													<span class="text-muted"></span>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Usuários </h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												
												<h1 class="mt-1 mb-3"><?php echo $total_usuarios ?></h1>
												<div class="mb-0">
													<span class="text"> <i class="mdi mdi-arrow-bottom-right">total de usuários cadastrados</i></span>
													<span class="text-muted"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Usuários</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
													<h1 class="mt-1 mb-3"><?php echo $contagem_admin ?></h1>
												<div class="mb-0">
													<span class="text"> <i class="mdi mdi-arrow-bottom-right">usuários administradores</i></span>
													<span class="text-muted"></span>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Usuários</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $contagem_inativo ?></h1>
												<div class="mb-0">
													<span class="text"> <i class="mdi mdi-arrow-bottom-right">usuários com status inativo</i></span>
													<span class="text-muted"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Visão usuários</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart chart-xs">
												<canvas id="chartjs-dashboard-pie-tarefas"></canvas>
											</div>
										</div>
									<?php	
										include 'conexao.php';
										$sql_adm = "SELECT COUNT(*) AS total_adm
        										FROM usuarios
       									 		WHERE nivel_usuario = '1'";
										$busca_adm = mysqli_query($conexao, $sql_adm);

										while($dados = mysqli_fetch_array($busca_adm)){
											$total_adm =$dados['total_adm'];
										}
										$sql_gest = "SELECT COUNT(*) AS total_gest
        										FROM usuarios
       									 		WHERE nivel_usuario = '2'";
										$busca_gest = mysqli_query($conexao, $sql_gest);

										while($dados = mysqli_fetch_array($busca_gest)){
											$total_gest =$dados['total_gest'];
										}
										$sql_func= "SELECT COUNT(*) AS total_func
        										FROM usuarios
       									 		WHERE nivel_usuario = '3'";
										$busca_func = mysqli_query($conexao, $sql_func);

										while($dados = mysqli_fetch_array($busca_func)){
											$total_func =$dados['total_func'];
										}

										$sql_empresas= "SELECT COUNT(*) AS total_empresas
        										FROM empresas";
										$busca_empresas = mysqli_query($conexao, $sql_empresas);

										while($dados = mysqli_fetch_array($busca_empresas)){
											$total_empresas =$dados['total_empresas'];
										}

										?>							
										<table class="table mb-0">
											<tbody>
												<tr>
													<td>Administradores</td>
													<td class="text-end"><?php echo $total_adm?></td>
												</tr>
												<tr>
													<td>Gestores</td>
													<td class="text-end"><?php echo $total_gest?></td>
												</tr>
												<tr>
													<td>Funcionários</td>
													<td class="text-end"><?php echo $total_func?></td>
												</tr>
												<tr>
													<td>Empresas</td>
													<td class="text-end"><?php echo $total_empresas?></td>
												</tr>
											
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
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
					</div>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-9 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Últimos usuários adicionados</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Nome</th>
											<th class="d-none d-xl-table-cell">Data criação</th>
											<th class="d-none d-xl-table-cell">Interrompido</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Nível usuário</th>
										</tr>
									</thead>
									<tbody>
										<?php
										include 'conexao.php';

										$sql_usuario2 = "SELECT * FROM usuarios ORDER BY created DESC ";
										$busca_usuario2 = mysqli_query($conexao, $sql_usuario2);
										
										while($dados = mysqli_fetch_array($busca_usuario2)){
											$id_usuario = $dados['id_usuario'];
											$nome_usuario = $dados['nome_usuario'];
											$data_criacao = $dados['created'];
											$data_interrupcao = $dados['interrupted'];
											$status = $dados['status'];
											$nivel = $dados['nivel_usuario'];

										
										?>
										<tr>
											<td><?php echo $nome_usuario?></td>
											<td class="d-none d-xl-table-cell"><?php echo $data_criacao?></td>
											<td class="d-none d-xl-table-cell"><?php echo $data_interrupcao?></td>
											<td><span class="badge" id="badge"><?php echo $status?></span></td>
											<td class="d-none d-md-table-cell"><?php echo $nivel?></td>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</div>
						</div>

				</div>
			</main>
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Função para alterar dinamicamente a classe do badge com base no status
    $('td span.badge').each(function() {
        var status = $(this).text().trim(); // Obtém o status do texto dentro do badge
        if (status === 'Ativo') {
            $(this).addClass('bg-success');
        } else if (status === 'Inativo') {
            $(this).addClass('bg-danger');
        }
    });
});
</script>

