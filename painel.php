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

<body>
	<div class="wrapper">
		<?php include 'menu.php'; ?>

		<div class="main">
            <?php 
                include 'topo.php'; 
            ?>

			<?php include 'corpo.php'; ?>

			<footer class="footer">
				<?php include 'footer.php' ?>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
	
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Administradores", "Gestores", "Funcionários"],
					datasets: [{
						data: [<?php echo $total_adm?>, <?php echo $total_gest?>, <?php echo $total_func?>],
						backgroundColor: [
							'#029daf',
							'#ffc27f',
							'#75a480'
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
</body>

</html>