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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</head>

<body>
    <div class="wrapper">
        <?php include 'menuManager.php'; ?>

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
                            <a  type="button"  href='painelManager.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>
                                <h5>Adicionar Projeto</h5>
                                    <p class="card-description">
                                        preencha todos os campos.
                                    </p>
                            </div>                          
                            <div class="card-body">
                                <form name="formprojeto" id="formprojeto" action="_inserir_projeto.php" enctype='multipart/form-data' method='post'onsubmit="return validarFormulario()" >
                                    <div class="mb-3">                                    
                                    </div>
                                    <div class="mb-3">
                                    <?php $codigo = rand(1111,9999); ?>
                                      <div class="mb-3">
                                          <label for="formFile" class="form-label">Título</label>
                                          <input class="form-control" type="text" name="titulo" required autocomplete="off">
                                          <input class="form-control" type="number" name="codigo" value="<?php echo $codigo ?>"
                                          style='display: none'>
                                            
                                      </div>
                                      <div class="mb-3">
                                          <label for="formFile" class="form-label">Tipo de Projeto</label>
                                          <input class="form-control" type="text" name="tipoprojeto" id="tipoprojeto" required autocomplete="off">
                                            
                                      </div>
                                      <div class="form-group">
                                        <div class="mb-3">
                                        <div class="form-group">
                                            <label>Gestor do Projeto</label><br>
                                            <?php
                                                
                                                  include 'conexao.php';
                                                  $sql = "SELECT * FROM usuarios where email_usuario = '$usuario'";
                                                  $busca = mysqli_query($conexao,$sql);
                                                  while($dados = mysqli_fetch_array($busca)) {
                                                    
                                                  $id_usuario = $dados['id_usuario'];
                                                  $nome_usuario = $dados['nome_usuario'];
                                                  $nivel = $dados['nivel_usuario'];
                                                  }
                                              ?> 
                                            <input type="text" class="form-control" name="gestor" id="gestor" value="<?php echo $nome_usuario?>">
                                            <input type="hidden" class="form-control" name="id_gestor" id="id_gestor" value="<?php echo $id_usuario?>"> 
                                                                               
                                        </div>
                                        <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Descrição do Projeto</label>
                                            <textarea class="form-control" name="descricao_projeto" id="descricao_projeto" rows="4"></textarea>
                                        </div>
                                    </div>                                     
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Contrato</label>
                                        <input class="form-control" type="file" name="contrato" id="formFile">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Anexos</label>
                                        <input class="form-control" type="file" name="anexo" id="formFile">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>


<script>
        $(document).ready(function() {
            $("#submit").on("click", function() {

                // Obtenha a extensão do arquivo
                var extensaoPermitida = ['.docx','.pdf','.jpeg','.png'];
                var arquivoInput = $("#contrato")[0];
                var extensaoArquivo = arquivoInput.value.split('.').pop().toLowerCase();

                if ($.inArray(extensaoArquivo, extensaoPermitida) === -1) {
                    alert("Extensão de arquivo não permitida. Por favor, escolha um arquivo com extensão: " + extensaoPermitida.join(', '));
                    arquivoInput.value = ''; // Limpa a seleção atual
                    $("#contrato").focus();
                    return false;
                }

                 // Se a extensão for permitida, continue com o envio do arquivo
                 var formData = new FormData($("#formprojeto")[0]);

                $.ajax({
                    type: "POST",
                    url: "_inserir_projeto.php",
                    data: formData,
                    processData: false,
                    contentType: true,
                    success: function(response) {
                        $("#mensagem").html(response);
                    }
                });
            });
        });
    </script>                                                  
<script>
        $(document).ready(function() {
            $("#submit").on("click", function() {

                // Obtenha a extensão do arquivo
                var extensaoPermitida = ['.txt','.xlsx', '.doc'];
                var arquivoInput = $("#anexo")[0];
                var extensaoArquivo = arquivoInput.value.split('.').pop().toLowerCase();

                if ($.inArray(extensaoArquivo, extensaoPermitida) === -1) {
                    alert("Extensão de arquivo não permitida. Por favor, escolha um arquivo com extensão: " + extensaoPermitida.join(', '));
                    arquivoInput.value = ''; // Limpa a seleção atual
                    $("#anexo").focus();
                    return false;
                }

                 // Se a extensão for permitida, continue com o envio do arquivo
                 var formData = new FormData($("#formprojeto")[0]);

                $.ajax({
                    type: "POST",
                    url: "_inserir_projeto.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#mensagem").html(response);
                    }
                });
            });
        });
    </script>   
<script>
function validarFormulario() {
            // Obtém o valor selecionado no campo select
            var selecionado = document.getElementById('gestor').value;

            // Verifica se o valor é vazio (ou qualquer outro critério que você preferir)
            if ((selecionado === '') || selecionado === document.getElementById('gestor')[0].value) {
                alert('Por favor, selecione um gestor.');
                return false; // Impede o envio do formulário
            }

            // Se o valor não for vazio, permite o envio do formulário
            //validarData();
            

        }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#formprojeto").submit(function(event){
            var dataInicial = new Date($("#datainicio").val());
            var dataFinal = new Date($("#dataconclusao").val());

            if (dataFinal < dataInicial) {
                alert("A data de conclusão não pode ser menor que a data de início.");
                event.preventDefault();
            }
        });
    });
</script>
</body>

</html>