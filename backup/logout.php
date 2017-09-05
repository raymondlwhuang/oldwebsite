<?php
	session_start();
	 $_SESSION['private'] = "no";
	 $_SESSION['logname'] = "";
	 $_SESSION['password'] = "";
	unset($_SESSION);
	session_destroy();
	header('Location: login.php');
	exit();

?> 
