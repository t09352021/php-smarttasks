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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    

</head>

<body>
    <div class="wrapper">
        <?php include 'menuEmployee.php'; ?>

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
                            <a  type="button"  href='painelEmployee.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>
                                <h5>Adicionar Tarefa</h5>
                                    <p class="card-description">
                                        preencha todos os campos.
                                    </p>
                            </div>                          
                            <div class="card-body">
                                <form name="formtarefa" id="formtarefa" action="_inserir_tarefa_employee.php" enctype='multipart/form-data' method='post' onsubmit="return validarFormulario()" >
                                    <div class="mb-3">
                                    <label>Projeto</label>
                                    
                                    <select class="form-select" aria-label="Default select example" name="projeto" id="projeto" required>
                                        
                                        <option selected>Selecione</option>
                                            <?php
                                            
                                            include 'conexao.php';
                                            $usuario = $_SESSION['usuario'];

                                            $sql = "SELECT * 
                                            FROM projetos 
                                            ORDER BY titulo ASC
                                            ";
                                            
                                            $busca = mysqli_query($conexao,$sql);
                                            while($array = mysqli_fetch_array($busca)) {
                                            
                                            $id_projeto= $array['id_projeto']; 
                                            $titulo_projeto= $array['titulo']; 
                                            $data_in_proj =$array['datain'];
                                            $data_out_proj =$array['dataout'];                      
                                        ?> 
                                            <option>                                            
                                            <?php echo $id_projeto .' - '. $titulo_projeto; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <input class="form-control" type="hidden" name="id_projeto" id="id_projeto" value="<?php echo isset($id_projeto) ? $id_projeto : ''; ?>">
                                        <input class="form-control" type="hidden" name="data_in_projeto" id="data_in_projeto" value="<?php echo isset($data_in_proj) ? $data_in_proj : ''; ?>">
                                        <input class="form-control" type="hidden" name="data_out_projeto" id="data_out_projeto" value="<?php echo isset($data_out_proj) ? $data_out_proj : ''; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <?php $codigo_tarefa = rand(1111,9999); ?>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" style="margin:2px">Título da Tarefa</label>
                                            <input class="form-control"  type="text" name="tarefa" required autocomplete="off">
                                            <input class="form-control" type="hidden" name="codtarefa" value="<?php echo $codigo_tarefa ?>">
                                            
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" name="prioridade" id="prioridade" required>
                                        <option selected>Prioridade</option>
                                        <option >Baixa</option>
                                        <option >Média</option>
                                        <option >Alta</option>                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3">
                                                        <label for="formFile" class="form-label" style="margin:2px">Atribuição de responsáveis</label>
                                            <input class="form-control"  type="text" name="campoBusca" id="campoBusca" placeholder="Responsável 1"required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control"  type="text" name="campoBusca2" id="campoBusca2" placeholder="Responsável 2 (opcional)" autocomplete="off">
                                        </div>
                                    </div>                                     
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1">Descrição da tarefa</label>
                                        <textarea class="form-control" name="descricao" rows="4" required autocomplete="off"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="exampleInputPassword2">Data de Inicio</label>
                                            <input type="date" class="form-control" name="datainicio" id="datainicio" required autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1">Data de Conclusão</label>
                                                <input type="date" class="form-control" name="dataconclusao" id="dataconclusao" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding:5px">
                                        <button type="submit" class="btn btn-primary me-2">Cadastrar</button>
                                        <button type="reset"  class="btn btn-light">Limpar</button>
                                    </div>
                                        
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>

            <footer class="footer">
                <?php include 'footer.php' ?>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script>   
    function validarFormulario() {
                // Obtém o valor selecionado no campo select
                var selecionado = document.getElementById('projeto').value;

                // Verifica se o valor é vazio 
                if ((selecionado === '') || selecionado === document.getElementById('projeto')[0].value) {
                    alert('Por favor, selecione um projeto.');
                    return false; // Impede o envio do formulário
                }

                // Se o valor não for vazio, permite o envio do formulário
                //validarData();
                

            }
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
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var email1 = document.getElementById('campoBusca');
            var email2 = document.getElementById('campoBusca2');
            var form = document.getElementById('formtarefa');

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
    $(document).ready(function(){
        $("#formtarefa").submit(function(event){
            var dataInicial = new Date($("#datainicio").val());
            var dataFinal = new Date($("#dataconclusao").val());
            var data_in_proj = new Date($("#data_in_projeto").val());
            var data_out_proj = new Date($("#data_out_projeto").val());

            if (dataFinal < dataInicial) {
                alert("A data de conclusão não pode ser menor que a data de início.");
                event.preventDefault();
            }
            if ((dataInicial < data_in_proj ) || (dataFinal > data_out_proj)) {
                alert("As datas de início e o fim de tarefas devem estar dentro do prazo de projeto.");
                event.preventDefault();
            }

        });
    });
</script>

</body>

</html>