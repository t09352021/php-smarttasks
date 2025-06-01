<!DOCTYPE html>
<html lang="pt-br">
    <head>
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
           
           
           $id = $_GET['id'];
        ?>
        <style>
        .img-cover {
            object-fit: cover;
            object-position: center;
        }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            #tamanhoContainer{
                width:500px;
            }
            #botao{
                background-color:#005eff;
                color:#fff;
                width:100%;
                height:50px;
            }
            
        </style>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <meta charset="utf-8"/>
</head>
<body>
    <div class="wrapper ">
        <?php include 'menuManager.php'; ?>

        <div class="main">
            <?php 
                include 'topo.php'; 
            ?>
        <div class="container" id="tamanhoContainer"  >
            <h4></h4>
            
            <form style="margin-top : 20px;" action="_atualizar_projeto.php" method="post" id="formconsproj">
            <div class="card-header" style="margin-top:40px;background:#586F7C;color:#fff">
            <a  type="button"  href='listar_projeto.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>   
                <?php
                $sql_usuario = "SELECT u.id_usuario, u.nome_usuario, p.fk_gestor AS id_gestor
                FROM usuarios u
                INNER JOIN projetos p ON u.id_usuario = p.fk_gestor
                WHERE u.email_usuario ='$usuario'";

                $busca_usuario = mysqli_query($conexao, $sql_usuario);
                while($array = mysqli_fetch_array($busca_usuario)){
                    $id_usuario = $array['id_usuario'];
                    $id_gestor = $array['id_gestor'];
                }

                $sql = "SELECT p.*, u.nome_usuario AS gestor
                FROM projetos p
                INNER JOIN usuarios u ON u.id_usuario ='$id_gestor'
                WHERE id_projeto = $id";

                $busca = mysqli_query($conexao, $sql);

                while($array = mysqli_fetch_array($busca)){
                    $id_projeto = $array['id_projeto'];
                    $titulo = $array['titulo'];
                    $descricao = $array['descricao_projeto'];
                    $nome_gestor = $array['gestor'];
                    $contrato = $array['contrato'];
                    $anexo = $array['anexo'];
                    $datain = $array['datain'];
                    $dataout = $array['dataout'];
                                
                ?>

            <div class="card-body">
                <div class="form-group " >
                    
                    <label>Projeto</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo ?>">
                    
                </div> 
                <div class="mb-3">
                    <label>Gestor</label>
                    <input type="text" class="form-control" name="nome_gestor" id="nome_gestor" value="<?php echo $nome_gestor ?>">
                    <input type="hidden" class="form-control" name="id_gestor" id="id_gestor" value="<?php echo $id_gestor ?>">
                                          
                </div>
                <div class="form-group">
                    <label>Descrição</label>   
                    <input type="text" class="form-control" name="descricao_projeto" id="descricao_projeto" value="<?php echo $descricao ?>">
                </div>
                <div class="form-group">
                    <?php
                        include 'conexao.php';
                            $sql = "SELECT * FROM projetos where id_projeto = '$id'";
                            $busca = mysqli_query($conexao,$sql);
                                while($dados = mysqli_fetch_array($busca)) {
                                    $id_contrato = $dados['id_projeto'];
                                    $contrato = $dados['contrato'];
                                    $anexo = $dados['anexo'];
                                                  
                    ?>             
                    <label>Contrato</label>     
                    <input type="file" class="form-control" name="contrato" id="formFile" value="<?php }echo $contrato ?>">
                </div class="form-group">
                <div class="form-group"> 
                    <label>Anexo</label>   
                    <input type="file" class="form-control" name="anexo" id="formFile" value="<?php echo $anexo?>">
                </div>    
                <div class="form-group">
                    <label>Data Inicial</label>
                    <input type="date" class="form-control" name="datain" id="datain" readonly value="<?php echo $datain ?>">
                </div>   
                <div class="form-group">
                    <label>Data de Entrega</label>
                    <input type="date" class="form-control" name="dataout" id="dataout"  value="<?php echo $dataout ?>">
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $id_projeto?>" style="display:none">
                </div>                
                <div style="text-align : right;">
                    <button id="botao" type="submit" class="btn btn-sm" >Atualizar</button>        
                </div>
                <?php } ?>   
            </div> 
        </form>
    </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#formconsproj").submit(function(event){
            var dataInicial = new Date($("#datain").val());
            var dataFinal = new Date($("#dataout").val());

            if (dataFinal < dataInicial) {
                alert("A data de conclusão não pode ser menor que a data de início.");
                event.preventDefault();
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function() {
            $('#nome_gestor').on('input', function() {
                var nome_gestor = $(this).val();

                if (nome_gestor.length >= 2) {
                    $.ajax({
                        url: 'busca_gestor.php',
                        method: 'POST',
                        data: { nome_gestor: nome_gestor },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response && response.id_usuario) {
                                $('#id_gestor').val(response.id_usuario);
                            } else {
                                $('#id_gestor').val('');
                            }
                        }
                    });
                } else {
                    $('#id_gestor').val('');
                }
            });
        });
    </script>
    </body>
</html>