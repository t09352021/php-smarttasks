<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle js-sidebar-toggle">
    	<i class="hamburger align-self-center"></i>
    </a>
	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
		<?php 
			include 'conexao.php';
			include 'painelStandard.php';
		?>
		<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
        	<?php echo $email_usuario .'<br>'. $user?><span class="text-dark"></span>
        </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-Profile.html"><i class="align-middle me-1" data-feather="user"></i> Perfil</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="sair.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>