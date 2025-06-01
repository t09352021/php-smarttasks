<?php
  include 'conexao.php';
  if (session_status() == PHP_SESSION_NONE) {
    // Se a sessão não estiver iniciada, então inicie a sessão
    session_start();
}
  $usuario = $_SESSION['usuario'];

  if(!isset($usuario)){
    header('Location: login.php');
  }

  $sql = "SELECT id_usuario, nome_usuario, email_usuario, nivel_usuario from usuarios where email_usuario = '$usuario' and status = 'Ativo'";
  $buscar = mysqli_query($conexao, $sql);
  $array = mysqli_fetch_array($buscar);
  $id_usuario = $array['id_usuario'];
  $nome_usuario = $array['nome_usuario'];
  $email_usuario = $array['email_usuario'];
  $nivel = $array['nivel_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/362ff39427.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Menu</title>
</head>
<body>
<!--<div class="container" style="width:500px; height:40px;text-align:center;color:white;background-color:green">-->
<?php
if($nivel == 1) {
  $user = "Administrador";
  $email_usuario;
  }
if($nivel == 2){
  $user = "Gerente";
  $email_usuario;
}
if($nivel == 3){
  $user = "Funcionário";
  $email_usuario;
}
?>
  <!--<h5>Usuário Logado: <?php echo $nome_usuario ?></h5>
</div>-->
<div class="container" style="margin-top:20px">  
<div class="container" style="text-align:center">
</div>
<!--Menu de opções-->
<div class="row">
  <?php
  if(!headers_sent()){
    if($nivel == 1){
		  header('Location: painel.php');
    } 
  } 
  ?>
  <?php
  if(!headers_sent()){
    if( $nivel == 2){
		  header('Location: painelManager.php');
    }
  }
  ?>

  <?php
  if(!headers_sent()){
      if($nivel == 3){
		  header('Location: painelEmployee.php');
      }
  }
  ?>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>