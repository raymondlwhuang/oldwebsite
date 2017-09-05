<?php
	include_once 'sethash.php';
	$pin = newencode(trim($_POST['pin']));
	$RememberPin = $_POST['RememberPin'];
	$_SESSION["pin"] =newdecode($pin);
	session_write_close();
	if($RememberPin == 1)
	{
		setcookie ($Pid, 'pin='.$pin, time() + $cookie_time);
	}

	header("Location: HERecorder.php");
	exit;

?>
