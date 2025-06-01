<!DOCTYPE html>
<html lang="pt-br">
    <head>        
        <meta http-equiv="Content-Language" content="pt-BR">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
           $id = intval($id);
        ?>
        <style>
        .img-cover {
            object-fit: cover;
            object-position: center;
        }

            #tamanhoContainer{
                width:500px;
            }
            #botao{
                background-color:#;
                color:#;
            }
            
        </style>        
        
        <meta charset="utf-8"/>
</head>
<body>
    <div class="wrapper ">
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
                            <a  type="button"  href='calc&projeto_employee.php'class="btn-close" aria-label="Close" style="position: relative; left: 98%; top:-10px; padding:10px"></a>
                                <h5>Estimativa de Projeto</h5>
                                    <p class="card-description">
                                        Cálculo de prazos para projeto.
                                    </p>
                            </div>                          
                            <div class="card-body">
            
            <form style="margin-top : 20px;" action="" method="POST" id="formcalcproj">
                <?php
                include 'conexao.php';
                
                
                 $sql_total_tarefas  = "SELECT COUNT(*) AS total_tarefas, t.id_projt, p.id_projeto, t.fk_statustarefa, s.id_statustarefa
                 FROM tarefas t
                 INNER JOIN projetos p ON t.id_projt = p.id_projeto
                 JOIN status_tarefas2 s ON t.fk_statustarefa = s.id_statustarefa
                 WHERE t.id_projt = '$id'";
                 $busca_total_tarefas  = mysqli_query($conexao, $sql_total_tarefas );
                
                while($dados = mysqli_fetch_array($busca_total_tarefas )){
                     $total_tarefas = $dados['total_tarefas'];

                 }

                $sql_naoconcluido = "SELECT COUNT(*) AS total_tarefas_nao_concluidas 
                FROM tarefas t
                JOIN status_tarefas2 s ON t.fk_statustarefa = s.id_statustarefa 
                WHERE t.id_projt = $id AND t.fk_statustarefa <> '4'";
                $busca_naoconcluido = mysqli_query($conexao, $sql_naoconcluido);
                
                while($dados = mysqli_fetch_array($busca_naoconcluido)){
                    $total_tarefas_nao_concluidas = $dados['total_tarefas_nao_concluidas'];

                }


                $sql = "SELECT *, u.nome_usuario AS gestor 
                FROM projetos p
                INNER JOIN usuarios u ON u.id_usuario = p.fk_gestor
                WHERE id_projeto = $id";
                $busca = mysqli_query($conexao, $sql);

                while($array = mysqli_fetch_array($busca)){
                    $id_projeto = $array['id_projeto'];
                    $titulo = $array['titulo'];
                    $descricao = $array['descricao_projeto'];
                    $gestor = $array['gestor'];
                    $contrato = $array['contrato'];
                    $anexo = $array['anexo'];
                    $datain = $array['datain'];
                    $dataout = $array['dataout'];
                                
                ?>

            <div class="card-body">
                <div class="form-group " >
                    <label>Projeto</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" readonly value="<?php echo $titulo ?>">
                    
                </div> 
                <div class="mb-3">
                    <label>Gestor</label>
                    <input type="text" class="form-control" name="gestor" id="gestor" value="<?php echo $gestor ?>" readonly>                                       
                </div>
                <div class="form-group">
                    <label>Descrição</label>   
                    <textarea type="text" class="form-control" name="descricao" id="descricao" readonly rows="3" ><?php echo $descricao ?></textarea>
                </div> 
                <div class="form-group">
                    <label>Total de tarefas do projeto</label>
                    <input type="text" class="form-control" name="total_tarefa" id="total_tarefa" value="<?php echo $total_tarefas ?>" readonly>
                </div>  
                <div class="form-group">
                    <label>Quantidade de tarefas a serem concluídas</label>
                    <input type="text" class="form-control" name="qnt_tarefa" id="qnt_tarefa" value="<?php echo $total_tarefas_nao_concluidas ?>" readonly>
                </div>              
                <div class="form-group" >
                    <label>Data Inicial</label>
                    <input type="date" class="form-control" name="datain" id="datain" readonly min="<?php echo date('Y-m-d'); ?>" value="<?php echo $datain ?>">
                </div>   
                <div class="form-group">
                    <label>Data de Entrega</label>
                    <input type="date" class="form-control" name="dataout" id="dataout" readonly min="<?php echo date('Y-m-d'); ?>" value="<?php echo $dataout ?>">
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $id_projeto?>" style="display:none">
                </div> 
                <div class="form-group">
                    <label>Duração do Projeto</label>
                    <input type="text" class="form-control" name="duracao" id="duracao" readonly>
                </div>    
                <div class="form-group" id="resultados2">
                    <label>Resultado</label>
                    <input type="text" class="form-control" name="resultado2" id="resultado2" readonly>
                </div>      
                <div style="text-align : right">
                    <button id="submit" type="submit" class="btn btn-primary">Calcular</button>        
                </div>
                <?php } ?>   
            </div> 
        </form>
            
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#formcalcproj").submit(function(event){
            var dataInicial = new Date($("#datain").val());
            var dataFinal = new Date($("#dataout").val());

            if (dataFinal < dataInicial) {
                alert("A data de conclusão não pode ser menor que a data de início.");
                event.preventDefault();
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    $('#formcalcproj').submit(function(e) {
        e.preventDefault(); 
        var dataInicial = $('#datain').val();
        var dataFinal = $('#dataout').val();

        if (dataInicial && dataFinal) {
            var dataInicialJS = new Date(dataInicial);
            var dataFinalJS = new Date(dataFinal);

            if (dataFinalJS >= dataInicialJS) {
                var intervaloDias = Math.floor((dataFinalJS - dataInicialJS) / (1000 * 60 * 60 * 24));
                $('#duracao').val(intervaloDias + ' dia(s)');
            } else {
                $('#duracao').val('A data final deve ser posterior à data inicial');
            }
        } else {
            $('#duracao').val('Preencha ambas as datas');
        }
    });
});
</script>
 <script>
$(document).ready(function() {

    //versao atual funcionando
    $('#formcalcproj').submit(function(event) {
        event.preventDefault();

        var totalTarefas = parseInt($('#total_tarefa').val()); // Total de tarefas do projeto
        var tarefasNRealizadas = parseInt($('#qnt_tarefa').val()); // Quantidade de tarefas realizadas
        var tarefasRealizadas = totalTarefas - tarefasNRealizadas; // Quantidade de tarefas realizadas
        var prazo = parseInt($('#duracao').val());
        var dataEntrada = new Date($('#datain').val());
        var dataSaida = new Date($('#dataout').val());
        var hoje = new Date();

        if (!isNaN(totalTarefas) && !isNaN(prazo) && totalTarefas >= 0 && prazo >= 0 && dataEntrada && dataSaida) {
            var tarefasPorDia = Math.ceil(totalTarefas / prazo);

            var marcos = {
                '25': Math.ceil(totalTarefas * 0.25),
                '50': Math.ceil(totalTarefas * 0.5),
                '75': Math.ceil(totalTarefas * 0.75),
                '100': totalTarefas
            };

            var dataMarco25 = new Date(dataEntrada);
            dataMarco25.setDate(dataEntrada.getDate() + Math.ceil(prazo * 0.25));
            var dataMarco50 = new Date(dataEntrada);
            dataMarco50.setDate(dataEntrada.getDate() + Math.ceil(prazo * 0.5));
            var dataMarco75 = new Date(dataEntrada);
            dataMarco75.setDate(dataEntrada.getDate() + Math.ceil(prazo * 0.75));
            var dataMarco100 = new Date(dataSaida -1);

           if(totalTarefas != 0){
            var mensagem = 'Progresso atual: ' + Math.ceil((tarefasRealizadas) / (totalTarefas) * 100) + '% (' + tarefasRealizadas + ' de ' + totalTarefas + ' tarefas)<br><br>';
            
            if(tarefasRealizadas != marcos['100']){
            var mensagem2 = 'Para alcançar o marco de: <br><br>';
            mensagem += mensagem2 + '25% do projeto, você deve completar no mínimo ' + marcos['25'] + ' tarefas até ' + dataMarco25.toLocaleDateString('pt-BR') + ';<br><br>';
            mensagem += '50% do projeto, você deve completar no mínimo ' + marcos['50'] + ' tarefas até ' + dataMarco50.toLocaleDateString('pt-BR') + ';<br><br>';
            mensagem += '75% do projeto, você deve completar no mínimo ' + marcos['75'] + ' tarefas até ' + dataMarco75.toLocaleDateString('pt-BR') + ';<br><br>';
            mensagem += '100% do projeto, você deve completar todas as ' + marcos['100'] + ' tarefas até ' + dataMarco100.toLocaleDateString('pt-BR') + ';<br><br>';
            }

            var mensagemAtraso = '';
            if (tarefasRealizadas < marcos['25'] && dataMarco25 < hoje) {
                mensagemAtraso += '<b>Marco 25% do projeto atrasado. A conclusão do projeto vai atrasar!<br>';                
            } else if (tarefasRealizadas < marcos['50'] && dataMarco50 < hoje) {
                mensagemAtraso += '<b>Marco 50% do projeto atrasado. A conclusão do projeto vai atrasar!<br>';
            } else if (tarefasRealizadas < marcos['75'] && dataMarco75 < hoje ) {
                mensagemAtraso += '<b> Marco 75% do projeto atrasado. A conclusão do projeto vai atrasar!<br>';
            } else if (tarefasRealizadas < marcos['100'] && dataMarco100 < hoje)  {
                mensagemAtraso += '<b>Marco 100% do projeto não concluído. Projeto atrasado!<br>';
            } else if (tarefasRealizadas < marcos['100'] && (hoje < dataMarco100 )   )  {
                mensagemAtraso += '<b>Atenção! Prazo final para conclusão do projeto. Complete todas as tarefas até ' + dataMarco100.toLocaleDateString('pt-BR');
            } else if (hoje < dataEntrada && tarefasRealizadas > 0 ){
                mensagemAtraso += '<b> Este projeto possui tarefas adiantadas. Projeto dentro do prazo!<br>';
            } else if (hoje < dataEntrada && totaltarefas == 0 ){
                mensagemAtraso += '<b> Este projeto ainda não possui tarefas!<br>';
            } else if (totalTarefas === 0 ){
                mensagemAtraso += '<b> Este projeto ainda não possui tarefas!<br>';
            } else {
                mensagemAtraso += '<br><br>Tarefas concluídas!';
            }

            $('#resultados2').html(mensagem + mensagemAtraso);
                
        } else {
            mensagem = 'Nenhuma tarefa cadastrada'
            $('#resultados2').html(mensagem);         
        }
    }else{
        $('#resultados2').html('Por favor, preencha os valores corretamente.');
        
    }
    });
});

</script>
</body>
</html>