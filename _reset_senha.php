<?php

include 'conexao.php';

$id = $_GET['id'];


?>

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

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta charset="utf-8"/>
        <title>Reset de senha</title>
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
                        <a  type="button"  href='reset_senha.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>              
                        <h5>Reset de senha</h5>    
                    </div>   
                        <div class="card-body">
                        <form style="margin-top : 20px;" action="_atualizar_senha.php" method="post">
                        <div class="mb-3">
                        <?php
                            $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
                            $busca = mysqli_query($conexao, $sql);

                            while($array = mysqli_fetch_array($busca)){
                                $id_usuario = $array['id_usuario'];
                                $nomeusuario = $array['nome_usuario'];
                                $mail = $array['email_usuario'];
                                $nivel = $array['nivel_usuario'];                            
                            ?>

            

                            <div class="form-group">
                                <label>Usuário</label>
                                <div class="form-group">
                                <label>Nome do Usuário</label>
                                <input type="text" class="form-control" name="nomeusuario" value="<?php echo $nomeusuario ?>" autocomplete="off" placeholder="Nome Completo" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="emailusuario" value="<?php echo $mail?>" autocomplete="off" placeholder="Seu E-mail" required>
                            </div>
                            <div class="form-group">
                                <label>Nova Senha</label>
                                <input type="text" class="form-control" name="novasenha">
                            </div>
                            <div class="form-group">                
                                <input type="text" class="form-control" name="id" value="<?php echo $id_usuario ?>" style="display:none">
                            </div>
                            
                            <div style="text-align : right;">
                                <button id="botao" type="submit" class="btn btn-primary">Atualizar</button>        
                            </div>
                            <?php } ?>    
                    </form>
            </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>