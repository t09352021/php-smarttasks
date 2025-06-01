<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>SmartTask - login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link href="styles/bootstrap.min.css" rel="stylesheet">
    <link href="styles/boxicon.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style2.css">
    <link rel="stylesheet" href="styles/custom.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/login.css">
    
    

</head>
<style>
  .eye-icon{
        position: absolute;
        top: 54%;
        right: 40px;
        transform: translateY(-50%);
        font-size: 18px;
        color: #8b8b8b;
        cursor: pointer;
        padding: 5px;
    }
  </style>
<body>
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <a href="index.php" class="logo">
              <h4>Smart<span>Tasks</span></h4>
            </a>
            <ul class="nav">
              <li class="scroll-to-section"><a href="index.php" class="active">Inicio</a></li>
              <li class="scroll-to-section"><a href="about.php">Sobre nós</a></li>
              <li class="scroll-to-section"><a href="servico.php">Serviço</a></li>
              <li class="scroll-to-section"><a href="cadastro_usuario_externo.php">Cadastre-se</a></li> 
              <li class="scroll-to-section"><div class="main-red-button"><a href="index.php">Voltar</a></div></li> 
            </ul>        
          </nav>
        </div>
      </div>
    </div>
  </header>
<?php
    session_start();
    session_destroy();
    
?>
<div class="conteudo">
    <div class = "login form">
        <header>Login</header>

    <form action="autenticar.php" method="post" id="formlogin">
        <div class="form-group">
            <label >Email:</label>
            <input type="text" name="usuario" class="form-control" placeholder="Usuário" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label >Senha:</label>
            <div class="password-container">
            <input type="password" name="senha" class="form-control password" placeholder="Senha" autocomplete="off" required><i class='bx bx-hide eye-icon'></i>
        </div>
        <div style="text-align:right">
        <button type="submit" class="btn btn-sm btn-success">Entrar</button>
    </div>
    </form>

    <div style="margin-top:10px">
    <center>
            <small>Você não possui cadastro? <a href="cadastro_usuario_externo.php">Clique aqui</a></small>
    </center>
        </div>
    </div>
</div>


<script src="js/script.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</body>
</html>