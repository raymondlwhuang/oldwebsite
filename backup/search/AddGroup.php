<?php
require_once '../config.php';
IF(isset($_REQUEST['viewer_group']))
{
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$queryOwner = mysql_query("SELECT * FROM user WHERE id = $user_id limit 1"); /* get his/her friend infor */
	while($rowOwner = mysql_fetch_array($queryOwner)) {
		$owner_path = $rowOwner['owner_path'];
	}	
	$viewer_group = mysql_real_escape_string($_REQUEST['viewer_group']);
//	$owner_path = mysql_real_escape_string($_REQUEST['owner_path']);
	$vRes = mysql_query("SELECT * FROM `viewer_group` where user_id=$user_id and viewer_group = '$viewer_group' limit 1");
	if (mysql_num_rows($vRes) == 0 && $viewer_group != ''){
		mysql_query("INSERT INTO viewer_group(user_id,owner_path,viewer_group) VALUES($user_id,'$owner_path','$viewer_group')");
	}	
	$getSpender=mysql_query("SELECT * FROM `viewer_group` where user_id=$user_id");
	echo mysql_error(); 
	$sOption = '';
	while($option = mysql_fetch_array($getSpender)) {
		if($option['viewer_group'] == "$viewer_group") $sOption .= "<option value='$option[id]' selected>$option[viewer_group]</option>";
		else $sOption .= "<option value='$option[id]'>$option[viewer_group]</option>";
	}
	mysql_close($link);
	echo $sOption;	
}
?>