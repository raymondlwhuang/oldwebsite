<?php
require_once '../config.php';
	if(isset($_REQUEST['category'])) $category = mysql_real_escape_string($_REQUEST['category']); else $category = '';
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$vRes = mysql_query("SELECT * FROM `spending_category` where (user_id=$user_id or user_id=0) and category = '$category' limit 1");
	if (mysql_num_rows($vRes) == 0 && $category != ''){
			mysql_query("INSERT INTO spending_category(user_id,category) VALUES($user_id, '$category')");
	}	
	$getspending_category=mysql_query("SELECT * FROM `spending_category` where (user_id = $user_id or user_id = 0)");
	echo mysql_error(); 
	$sOption = '';
	while($option = mysql_fetch_array($getspending_category)) {
		if($option['category'] == "$category") $sOption .= "<option value='$option[id]' selected>$option[category]</option>";
		else $sOption .= "<option value='$option[id]'>$option[category]</option>";
	}
	mysql_close($link);
	echo $sOption;	
?>