<?php
	session_start();
	if (!isset($_SESSION['user']) || $_SESSION['user']->u_status != 1){
		header ("Location: index.html");
		exit;
	}
	echo '<pre>';
	print_r($_SESSION['user']);
	echo '</pre>';
	
		
?>