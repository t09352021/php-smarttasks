<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/pt-br.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<?php
        include 'header.php';
    ?>
	
	<?php
	include 'conexao.php';
	if (session_status() == PHP_SESSION_NONE) {
		// Se a sessão não estiver iniciada, então inicie a sessão
		session_start();
	}

	$usuario = $_SESSION['usuario'];

	if(!isset($usuario)){
		header('Location: login.php');
	}

	$sql = "SELECT nivel_usuario FROM usuarios WHERE email_usuario = '$usuario' and status = 'Ativo'";
	$buscar = mysqli_query($conexao, $sql);
	$array = mysqli_fetch_array($buscar);
	$nivel = $array['nivel_usuario'];
	?>

<body>
	
	<div class="wrapper">
		<?php include 'menuManager.php';?>
		

		<div class="main">
            <?php 
                include 'topo.php'; 
            ?>

			<?php include 'corpoManager.php'; ?>

			<footer class="footer">
				<?php include 'footer.php' ?>
			</footer>
		
		</div>
	</div>


	<script src="js/app.js"></script>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dashboard-pie-pessoas"), {
			type: "pie",
			data: {
				labels: ["Não iniciado", "Em progresso", "Aguardando","Concluído"],
		
				datasets: [{
					data: [<?php echo $total_nao_iniciado ?>, <?php echo $total_em_progresso ?>, <?php echo $total_aguardando ?>, <?php echo $total_concluido ?>],
					backgroundColor: [
						'#f68b36',
						'#75a480',
						'#6ca6a3',
						'#bf496a'
					],
					borderWidth: 5
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				cutoutPercentage: 75
			}
		});
	}); 
</script>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dashboard-pie-tarefas"), {
			type: "pie",
			data: {
				labels: ["Alta", "Média", "Baixa"],
		
				datasets: [{
					data: [<?php echo $total_alta ?>, <?php echo $total_media ?>, <?php echo $total_baixa ?>],
					backgroundColor: [
						'#f68b36',
						'#75a480',
						'#6ca6a3'
					],
					borderWidth: 5
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				cutoutPercentage: 75
			}
		});
	}); 
</script>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("chartjs-dashboard-pie-pessoas"), {
			type: "pie",
			data: {
				labels: ["Não iniciado", "Em progresso", "Aguardando","Concluído"],
		
				datasets: [{
					data: [<?php echo $total_nao_iniciado ?>, <?php echo $total_em_progresso ?>, <?php echo $total_aguardando ?>, <?php echo $total_concluido ?>],
					backgroundColor: [
						'#f68b36',
						'#75a480',
						'#6ca6a3',
						'#bf496a'
					],
					borderWidth: 5
				}]
			},
			options: {
				responsive: !window.MSInputMethodContext,
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				cutoutPercentage: 75
			}
		});
	}); 
</script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
    var date = new Date();
    var localDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000); // Ajusta para o fuso horário local
    var defaultDate = localDate.toISOString().slice(0, 10); // Formata a data para YYYY-MM-DD

    document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: defaultDate,
        locale: {
            weekdays: {
                shorthand: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                longhand: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
            },
            months: {
                shorthand: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                longhand: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            },
            rangeSeparator: ' a ',
            weekAbbreviation: 'Sem',
            scrollTitle: 'Rolagem para aumentar',
            toggleTitle: 'Clique para alternar',
        }
    });
});
</script>

	
</body>
</html>