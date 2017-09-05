<?php
require_once '../config.php';
	if(isset($_REQUEST['frequency'])) $frequency = mysql_real_escape_string($_REQUEST['frequency']); else $frequency = '';
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$vRes = mysql_query("SELECT * FROM `sp_frequency` where (user_id=$user_id or user_id=0) and frequency = '$frequency' limit 1");
	if (mysql_num_rows($vRes) == 0 && $frequency != ''){
			mysql_query("INSERT INTO sp_frequency(user_id,frequency) VALUES($user_id, '$frequency')");
	}	
	$getsp_frequency=mysql_query("SELECT * FROM `sp_frequency` where (user_id = $user_id or user_id = 0)");
	echo mysql_error(); 
	$sOption = '';
	while($option = mysql_fetch_array($getsp_frequency)) {
		if($option['frequency'] == "$frequency") $sOption .= "<option value='$option[id]' selected>$option[frequency]</option>";
		else $sOption .= "<option value='$option[id]'>$option[frequency]</option>";
	}
	mysql_close($link);
	echo $sOption;	
?>