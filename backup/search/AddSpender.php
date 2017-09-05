<?php
require_once '../config.php';
IF(isset($_REQUEST['name']))
{
	$name = mysql_real_escape_string($_REQUEST['name']);
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$vRes = mysql_query("SELECT * FROM `spender` where user_id=$user_id and name = '$name' limit 1");
	if (mysql_num_rows($vRes) == 0 && $name != ''){
		mysql_query("INSERT INTO spender(user_id,name) VALUES($user_id, '$name')");
		$result = mysql_query("SELECT * FROM spender WHERE user_id = $user_id and name = '$name' LIMIT 1");
		while($Row=mysql_fetch_array($result)){
			$spender_id = $Row['id'];
			mysql_query("INSERT INTO sp_bank(user_id,spender_id,bank,pay_now) VALUES($user_id,$spender_id,'Cash On Hand($name)',1)");
			echo mysql_error(); 
		}				
	}	
	$getSpender=mysql_query("SELECT * FROM `spender` where user_id=$user_id");
	echo mysql_error(); 
	$sOption = '';
	while($option = mysql_fetch_array($getSpender)) {
		if($option['name'] == "$name") $sOption .= "<option value='$option[id]' selected>$option[name]</option>";
		else $sOption .= "<option value='$option[id]'>$option[name]</option>";
	}
	mysql_close($link);
	echo $sOption;	
}
?>