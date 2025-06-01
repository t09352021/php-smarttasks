<?php

include 'headerSmart.php';
$erro = $_GET['erro'];

if($erro == 'senha') {
    echo '<div style="margin-top:10px;"><center><br><span>Senha incorreta. Por favor, tente novamente.';
    echo '<div style="margin-top:10px"><center><span><a type="button" href="login.php"> Voltar</a></span></div></center></div></div>';
    
} elseif($erro == 'email') {
    echo '<div style="margin-top:10px;"><center><br><span>Email não cadastrado. Verifique seus dados e tente novamente.';
    echo '<div style="margin-top:10px"><center><span><a type="button" href="cadastro_usuario_externo.php"> Cadastrar usuário</a>';
    echo '<div style="margin-top:10px"><center><span><a type="button" href="login.php"> Voltar</a></span></div></center></div></div>';
} elseif($erro == 'aguardando_permissionamento') {
    echo '<div style="margin-top:10px;"><center><br><span>Sua conta está aguardando permissionamento. Por favor, aguarde a aprovação.';
    echo '<div style="margin-top:10px"><center><span><a type="button" href="login.php"> Voltar</a></span></div></center></div></div>';
} else {
    echo '<div style="margin-top:10px;"><center><br><span>Erro desconhecido.';
    echo '<div style="margin-top:10px"><center><span><a type="button" href="login.php"> Voltar</a></span></div></center></div></div>';
}
?>


