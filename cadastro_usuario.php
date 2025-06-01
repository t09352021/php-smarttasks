<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
        include 'header.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Listagem de usuarios</title>
</head>
<body>
<?php
  include 'conexao.php';
  session_start();

  $usuario = $_SESSION['usuario'];

  if(!isset($usuario)){
    header('Location: index.php');
  }

  $sql = "SELECT nivel_usuario FROM usuarios WHERE email_usuario = '$usuario' and STATUS = 'Ativo'";
  $buscar = mysqli_query($conexao, $sql);
  $array = mysqli_fetch_array($buscar);
  $nivel =(isset( $array['nivel_usuario']));
?>
<body>
<div class="wrapper">
  <?php 
      include 'menu.php';

  ?>
  <div class="main">
    <?php 
      include 'topo.php'; 
    ?>

      <main class="content">
        <div class="container-fluid p-0">
          <h1 class="h3 mb-3"></h1>
            <div class="col-8">
              <div class="card">
                <div class="card-header">
                <a  type="button"  href='painel.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>
                  <h5>Adicionar Usuário</h5>
                    <p class="card-description">
                        preencha todos os campos.
                    </p>
                    
                  </div> 
                    <div class="card-body">
                        <div class="mb-3" id="form_cad_usuario">
                        <table class="table" id="tb-pesquisar">
    
                        <h4>Cadastro de Usuário</h4>
                        <form action="_inserir_usuario.php" method="post" >
                        <div class="form-group">
                            <div class="form-group">
                                <label>Nome do Usuário</label>
                                <input type="text" class="form-control" name="nomeusuario" autocomplete="off" placeholder="Nome Completo" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="emailusuario" id="emailusuario" autocomplete="off" placeholder="Seu E-mail" required>
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" id="txtSenha" class="form-control" name="senhausuario" autocomplete="off" placeholder="Digite a Senha" required>
                            </div>
                            <div class="form-group">
                                <label>Confirmar Senha</label>
                                <input type="password" class="form-control" name="senhausuario2" autocomplete="off" placeholder="Confirme a Senha" required oninput="validaSenha(this)">
                                <small>As senhas devem ser iguais.</small>
                            </div>
                            <div class="form-group">
                                <label>Nível de Acesso</label>
                                <select name="nivelusuario" class="form-control">
                                    <option value="1">Administrador</option>
                                    <option value="2"> Gerente</option>
                                    <option value="3">Funcionário</option>
                                </select>
                            </div>
                            <div style="color:red"id="resultado"></div>
                            <div style="text-align:right">
                                <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function validaSenha (input){ 
	if (input.value != document.getElementById('txtSenha').value){
    input.setCustomValidity('Repita a senha corretamente');
  } else {
    input.setCustomValidity('');
  } 
}
</script>

<script>
    $(document).ready(function() {
        $('#form_cad_usuario').on('submit', function(e) {
            e.preventDefault();
            var email = $('#emailusuario').val();

            $.ajax({
                type: 'POST',
                url: '_verificar_email.php',
                data: { email: email },
                success: function(response) {
                    if (response === 'existe') {
                        $('#resultado').html('O e-mail já está cadastrado.');
                    } else {
                        // Remover o manipulador de evento submit para permitir a submissão normal
                        $('#form_cad_usuario').off('submit').submit();
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