<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
        include 'header.php';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<?php
  include 'conexao.php';
  session_start();

  $usuario = $_SESSION['usuario'];

  if(!isset($usuario)){
    header('Location: login.php');
  }

  $sql = "SELECT nivel_usuario FROM usuarios WHERE email_usuario = '$usuario' and status = 'Ativo'";
  $buscar = mysqli_query($conexao, $sql);
  $array = mysqli_fetch_array($buscar);
  $nivel = $array['nivel_usuario'];
?>



<div class="wrapper">
  <?php 
      include 'menuManager.php';

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
                  <h5>Consulta de Projeto</h5>
                  </div> 
                    <div class="card-body">
                        <div class="mb-3 table-responsive">
                        <table class="table" id="tb-pesquisar">
                        <thead>
                        <tr>
                          <th scope="col">Código</th>
                          <th scope="col">Projeto</th>
                          <th scope="col">Descrição</th>
                          <th scope="col">Gestor</th>
                          <th scope="col">Ação</th>
                        </tr>
                        </thead>
                        <tbody>                                   
                           <?php
                             include 'conexao.php';

                             $usuario = $_SESSION['usuario'];

                             $sql_gestor = "SELECT id_usuario, nome_usuario, email_usuario 
                             FROM usuarios
                             WHERE email_usuario = '$usuario' ";


                             $busca_gestor = mysqli_query($conexao,$sql_gestor);
                             while($array = mysqli_fetch_array($busca_gestor)){
                               $nome_gestor = $array['nome_usuario'];
                               $id_gestor = $array['id_usuario'];
                               $email_gestor  = $array['email_usuario'];
                              }

                              $sql = "SELECT p.*, u.nome_usuario AS gestor
                              FROM projetos p 
                              INNER JOIN usuarios u ON p.fk_gestor = u.id_usuario
                              WHERE p.fk_gestor = '$id_gestor' AND u.nome_usuario = '$nome_gestor' 
                              ORDER BY p.titulo ASC";

                              $busca = mysqli_query($conexao,$sql);
                              while($array = mysqli_fetch_array($busca)){
                                $id_projeto = $array['id_projeto'];
                                $codigo = $array['codigo'];
                                $titulo = $array['titulo'];
                                $descricao = $array['descricao_projeto']; 
                                $gestor = $array['gestor'];      
                            ?>
                            <tr>
                              <td><?php echo $codigo ?></td>
                              <td><?php echo $titulo ?></td>
                              <td><?php echo $descricao ?></td>
                              <td><?php echo $gestor ?></td>                                                       
                              <td>
      <?php
          if($nivel == 2){

            ?>
        <a href="editar_projeto.php?id=<?php echo $id_projeto?>" role="button"><i class="bi bi-pencil-square"></i>&nbsp;</a>
        <a href="deletar_projeto.php?id=<?php echo $id_projeto?>" onclick="return confirm('Tem certeza que deseja deletar este registro ?')" role="button"><i class="far fa-trash-alt"></i>&nbsp;</a></td>

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
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
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