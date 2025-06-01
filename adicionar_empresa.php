<!DOCTYPE html>
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
    <style>
        .img-cover {
            object-fit: cover;
            object-position: center;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Empresa</title>
</head>
<body>
    <div class="wrapper">
        <?php include 'menu.php'; ?>

        <div class="main">
            <?php 
                include 'topo.php'; 
            ?>
            <main class="content">
                <div class="container-fluid p-0">
                    
                    <h1 class="h3 mb-3"></h1>

                    <div class="col-8">
                        <div class="card"><div class="card-header">
                            <a  type="button"  href='painel.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>
                                <h5>Cadastro de Empresa</h5>
                            </div>                          
                            <div class="card-body">
                                <form<form action="_inserir_Empresa.php" method="post">
                                    <div class="mb-3">
                                    <label>Empresa</label>
                                        <div class="form-group">
                                            <input autocomplete="off" type="text" class="form-control" placeholder="Digite o nome da empresa" name="empresa" required>    
                                        </div>
        <div style="text-align:right">
            <button class="btn btn-primary me-2" id="botao" type="submit">Cadastrar</button>
        </div>
        </form>    
    </div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>