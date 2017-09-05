<?php
include_once 'sethash.php';
if(isSet($Pid))
{
	if(isSet($_COOKIE[$Pid]))
	{
		parse_str($_COOKIE[$Pid]);
		$_SESSION["pin"] =newdecode($pin);
		session_write_close();
		header("Location: HERecorder.php");
		exit;
		
	}
}
?>