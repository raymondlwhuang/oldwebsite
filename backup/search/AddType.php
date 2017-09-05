<?php
require_once '../config.php';
	if(isset($_REQUEST['Type'])) $Type = mysql_real_escape_string($_REQUEST['Type']); else $Type = '';
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$vRes = mysql_query("SELECT * FROM `sp_payment_type` where (user_id=$user_id or user_id=0) and Type = '$Type' limit 1");
	if (mysql_num_rows($vRes) == 0 && $Type != ''){
			mysql_query("INSERT INTO sp_payment_type(user_id,Type) VALUES($user_id, '$Type')");
	}	
	$getsp_payment_type=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $user_id or user_id = 0)");
	echo mysql_error(); 
	$sOption = '';
	while($option = mysql_fetch_array($getsp_payment_type)) {
		if($option['Type'] == "$Type") $sOption .= "<option value='$option[id]' selected>$option[Type]</option>";
		else $sOption .= "<option value='$option[id]'>$option[Type]</option>";
	}
	mysql_close($link);
	echo $sOption;	
?>