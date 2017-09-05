<?php
require_once '../config.php';
IF(isset($_REQUEST['spender_id']))
{
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$spender_id = (int)mysql_real_escape_string($_REQUEST['spender_id']);
	mysql_query("DELETE FROM sp_bank where user_id = $user_id and spender_id = $spender_id");
	mysql_query("DELETE FROM spender where user_id = $user_id and id = $spender_id");
	$getSpender=mysql_query("SELECT * FROM `spender` where user_id=$user_id");
	echo mysql_error(); 
	$sOption = '';
	while($option = mysql_fetch_array($getSpender)) {
		$sOption .= "<option value='$option[id]'>$option[name]</option>";
	}
	mysql_close($link);
	echo $sOption;
}
?>