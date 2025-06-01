<?php
include 'login.php';
if (isset($_SESSION['usuario']) == true){
	session_unset();
	session_destroy();

	header("Location: index.php");
	exit();
}
?>