<?php
include 'conexao.php';
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
<style>
</style>
<nav id="sidebar" class="sidebar js-sidebar " >
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="painelManager.php">
				<h4>
				<span style="color: #0361ED;">Smart</span>
				<span style="color: #ffae00;">Tasks</span>
    			</h4>
        </a>
				<ul class="sidebar-nav">
					<li class="sidebar-header active">
						Menu
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="painelManager.php">
							<i class="align-middle" data-feather="activity"></i><span class="align-middle">Dados Analíticos</span>
						</a>
					</li>
					<li class="sidebar-item" id="add-projt">
						<a class="sidebar-link" href="cadastro_projeto.php">
							<i class="align-middle" data-feather="plus-circle"></i><span class="align-middle">Adicionar Projeto</span>
						</a>
					</li>
					<li class="sidebar-item" id="cons-projt">
						<a class="sidebar-link toggle" href="listar_projeto.php">
							<i class="align-middle" data-feather="search"></i><span class="align-middle">Consultar Projeto</span>
						</a>
					</li>

					<li class="sidebar-item" id="add-tarefa">
						<a class="sidebar-link" href="cadastro_tarefa.php">
							<i class="align-middle" data-feather="plus-circle"></i><span class="align-middle">Adicionar Tarefa</span>
						</a>
					</li>
					<li class="sidebar-item" id="cons-tarefa">
						<a class="sidebar-link" href="listar_tarefa.php">
							<i class="align-middle" data-feather="search"></i><span class="align-middle">Consultar Tarefa</span>
						</a>
					</li>
					<li class="sidebar-item" id="estima-tarefa">
						<a class="sidebar-link" href="calc&projeto.php">
							<i class="align-middle" data-feather="search"></i><span class="align-middle">Estimativa</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="status_tarefa.php">
							<i class="align-middle" data-feather="check-circle"></i><span class="align-middle">Status Tarefa</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="sair.php">
							<i class="align-middle" data-feather="book"></i><span class="align-middle">Sair</span>
						</a>
					</li>
				
			</div>
		</nav>
