
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
            
            <form style="margin-top : 20px;" id="formtarefa2" action="_atualizar_tarefa.php" method="post">
            <div class="card-header" style="margin-top:40px;background:#586F7C;color:#fff">
            <a  type="button"  href='listar_tarefa.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>   
                <?php
                $sql = "SELECT t.id_tarefa, p.titulo, t.tarefa, t.descricao_tarefa, t.prioridade, t.responsavel, t.responsavel2, t.datain, t.dataout
                FROM tarefas t
                INNER JOIN projetos p ON p.id_projeto = t.id_projt 
                WHERE id_tarefa = '$id'";
                
                $busca = mysqli_query($conexao, $sql);

                while($array = mysqli_fetch_array($busca)){
                    $id_tarefa = $array['id_tarefa'];
                    $projeto = $array['titulo'];
                    $tarefa = $array['tarefa'];
                    $descricao = $array['descricao_tarefa'];
                    $prioridade = $array['prioridade'];
                    $responsavel = $array['responsavel'];
                    $responsavel2 = $array['responsavel2'];
                    $datain = $array['datain'];
                    $dataout = $array['dataout'];
                                
                ?>

            <div class="card-body">
                <div class="form-group " >
                    
                    <label>Tarefa</label>
                    <input type="text" class="form-control" name="tarefa" id="tarefa" value="<?php echo $tarefa ?>">
                    
                </div> 
                <div class="form-group " >
                    
                    <label>Projeto</label>
                    <input type="text" class="form-control" name="projeto" id="projeto" value="<?php echo $projeto ?> " readonly>
                    
                </div>
                <div class="form-group " >
                    
                    <label>Prioridade</label>
                    <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="prioridade" id="prioridade">
                        <option selected><?php echo $prioridade?></option>
                        <option>Baixa</option>
                        <option>Média</option>
                        <option>Alta</option>
                        </select>
                    
                </div>


                <div class="mb-3">
                    <label>Responsáveis</label>
                    <input type="text" class="form-control" name="campoBusca" id="campoBusca" value="<?php echo $responsavel ?>">
                    <input type="text" class="form-control" name="campoBusca2" id="campoBusca2" value="<?php echo $responsavel2 ?>">
                                          
                </div>
                <div class="form-group">
                    <label>Descrição</label>   
                    <input type="text" class="form-control" name="descricao_tarefa" id="descricao_tarefa" value="<?php echo $descricao ?>">
                </div>  
                <div class="form-group">
                    <label>Data Inicial</label>
                    <input type="date" class="form-control" name="datain" id="datain"  value="<?php echo $datain ?>">
                </div>   
                <div class="form-group">
                    <label>Data de Entrega</label>
                    <input type="date" class="form-control" name="dataout" id="dataout"  value="<?php echo $dataout ?>">
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $id_tarefa?>" style="display:none">
                </div>                
                <div style="text-align : right;">
                    <button id="botao" type="submit" class="btn btn-sm" >Atualizar</button>        
                </div>
                <?php } ?>   
            </div> 
        </form>
    </div>
        <script src="js/app.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var email1 = document.getElementById('campoBusca');
            var email2 = document.getElementById('campoBusca2');
            var form = document.getElementById('formtarefa2');

            form.addEventListener('submit', function (event) {
                var selectedEmail1 = email1.value.trim();
                var selectedEmail2 = email2.value.trim();

                if (selectedEmail1 === selectedEmail2) {
                    alert('Os campos de e-mail não podem ter o mesmo valor.');
                    event.preventDefault(); // Impede o envio do formulário
                }
            });
        });
    </script>
        <script>
         $(document).ready(function() {
            $("#campoBusca").on("input", function() {
                var termoBusca = $(this).val().toLowerCase();

                // Realiza uma chamada AJAX usando jQuery
                $.ajax({
                    url: "busca_email.php",
                    method: "GET",
                    data: { termo: termoBusca },
                    dataType: "json",
                    success: function(resultados) {
                        // Atualiza o valor do campo com os resultados
                        $("#campoBusca").autocomplete({
                            source: resultados
                        });
                    }
                });
            });
        });
    </script>
<script>
         $(document).ready(function() {
            $("#campoBusca2").on("input", function() {
                var termoBusca = $(this).val().toLowerCase();

                // Realiza uma chamada AJAX usando jQuery
                $.ajax({
                    url: "busca_emailsec.php",
                    method: "GET",
                    data: { termo: termoBusca },
                    dataType: "json",
                    success: function(resultados) {
                        // Atualiza o valor do campo com os resultados
                        $("#campoBusca2").autocomplete({
                            source: resultados
                        });
                    }
                });
            });
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#formtarefa2").submit(function(event){
            var dataInicial = new Date($("#datain").val());
            var dataFinal = new Date($("#dataout").val());

            if (dataFinal < dataInicial) {
                alert("A data de conclusão não pode ser menor que a data de início.");
                event.preventDefault();
            }
        });
    });
</script>
    </body>

</html>