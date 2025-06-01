<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>SmartTask - Cadastro</title>
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
    <link rel="stylesheet" href="styles/cadastro.css">
    
    

</head>
<style>
  .eye-icon{
        position: absolute;
        top: 65%;
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
              <li class="scroll-to-section"><a href="#">Serviço</a></li>
              <li class="scroll-to-section"><a href="login.php">Login</a></li> 
              <li class="scroll-to-section"><div class="main-red-button"><a href="index.php">Voltar</a></div></li> 
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <div class="conteudo">
    <div class="registration form">
    <div style="color:red"id="resultado"></div>
    <div style="text-align:right">
</div>
    <h4>Cadastro de Usuário</h4><br>
    <form action="_inserir_usuario_externo.php" method="post" id="form_cad_usuarioext" >
    
        <div class="form-group">
            <label>Nome do Usuário</label>
            <input type="text" class="form-control" name="nomeusuario" autocomplete="off" placeholder="Nome Completo" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="emailusuario" id="emailusuario" autocomplete="off" placeholder="Seu E-mail" required>
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
        
        <div style="text-align:right">
            <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
        </div>

    </div>
    </form>
</div>
    </div>

    <script src="js/script.js"></script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function validaSenha (input){ 
	if (input.value != document.getElementById('txtSenha').value) {
    input.setCustomValidity('Repita a senha corretamente');
  } else {
    input.setCustomValidity('');
  }
} 
</script>
<script>
        $(document).ready(function() {
            $('#form_cad_usuarioext').on('submit', function(e) {
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
                        $('#form_cad_usuarioext')[0].submit();
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