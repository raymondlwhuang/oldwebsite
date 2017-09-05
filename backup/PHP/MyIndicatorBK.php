<?php
session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
IF(isset($_GET['Indicator']))
{
	$activate = $_GET['Indicator'];
	$now = date('Y-m-d H:i:s');
	$b = time () - 1800; 
	$exipred = date('Y-m-d H:i:s',$b);
	mysql_query("UPDATE user SET last_activity='$now',is_active=$activate WHERE email_address = '$GV_email_address'");
	mysql_query("UPDATE user SET is_active= 1 WHERE last_activity < '$exipred'");
	echo mysql_error();
}


