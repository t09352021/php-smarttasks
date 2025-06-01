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

    
    $sql_user = "SELECT nivel_usuario FROM usuarios WHERE email_usuario = '$usuario' and status = 'Ativo'";
    $buscar_user = mysqli_query($conexao, $sql_user);
    $array = mysqli_fetch_array($buscar_user);
    $nivel = $array['nivel_usuario'];
    ?>

    <style>
        .img-cover {
            object-fit: cover;
            object-position: center;
        }
    </style>
    <script src="https://kit.fontawesome.com/362ff39427.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Empresas</title>
    
</head>
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
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5>Consulta de Empresa</h5>
                  </div> 
                    <div class="card-body">
                        <div class="mb-3 table-responsive">
                        <h3>Lista de Empresas</h3>
                        <br/>
                        <table class="table" id="tb-pesquisar">
                          <thead>
                            <tr>
                              <th scope="col">Empresa</th>
                              <th scope="col">Ação</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                            
                                <?php
                                    include 'conexao.php';
                                    $sql = "SELECT * from empresas ORDER BY empresa ASC";
                                    $busca = mysqli_query($conexao,$sql);

                                    while($array = mysqli_fetch_array($busca)){
                                        $id_empresa = $array['id_empresa'];
                                        $empresa = $array['empresa'];
                                        
                                ?>

                            <tr>
                                <td><?php echo $empresa ?></td>                                              
                                <td>
        <?php
          if($nivel == 1){

            ?>
        <a  href="editar_empresa.php?id=<?php echo $id_empresa?>" role="button"><i class="far fa-edit"></i>&nbsp;</a>
        <a  href="deletar_empresa.php?id=<?php echo $id_empresa?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')" role="button"><i class="far fa-trash-alt"></i>&nbsp;</a></td>

        <?php } ?>

        <?php } ?>
    </tr> 
    
    </tbody>
</table>
</form>                                
 </div>                         
    
    </div>
</div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function(){
      $('#tb-pesquisar').DataTable({
        	"language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
  });
  </script>
      </body>
</html>