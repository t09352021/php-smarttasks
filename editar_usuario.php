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
        <title>Formulário de edição</title>
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
                        <a  type="button"  href='listar_usuario.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>              
                        <h5>Atualizar usuário</h5>
                    </div>
                    <div class="card-body">
                    <form style="margin-top : 20px;" action="_atualizar_usuario.php" method="post" id="form_edit_cad">
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
                            <input type="email" class="form-control" name="emailusuario" id="emailusuario" value="<?php echo $mail?>" autocomplete="off" placeholder="Seu E-mail" required>
                        </div>
                        <div class="form-group" value="<?php echo $nivel?>">
                            <label>Nível de Acesso</label>
                            <select name="nivelusuario" class="form-control">
                                <option value="1">Administrador</option>
                                <option value="2"> Gerente</option>
                                <option value="3">Funcionário</option>
                            </select>
                        
                            <input type="text" class="form-control" name="id" value="<?php echo $id_usuario ?>" style="display:none">
                        </div>
                        <div style="color:red"id="resultado"></div>
                        <div style="text-align : right;">
                            <button class="btn btn-primary me-2" id="botao" type="submit" >Atualizar</button>        
                        </div>
                        <?php } ?>    
                </form>
            </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#form_edit_cad').on('submit', function(e) {
                e.preventDefault();
                var email = $('#emailusuario').val();

                $.ajax({
                    type: 'POST',
                    url: '_verificar_email.php',
                    data: { email: email },
                    success: function(response) {
                        if (response === 'existe') {
                            $('#resultado').html('O e-mail já está cadastrado.');
                        }else if (response === 'nao_existe') {
                        // Agora você pode enviar o formulário real
                        $('#form_edit_cad')[0].submit();
                    } else {
                        $('#resultado').html('Ocorreu um erro. Tente novamente');
                    }
                    },
                    error: function() {
                        $('#resultado').html('Erro na solicitação.');
                    }
                });
            });
        });
    </script>
    </body>
</html>