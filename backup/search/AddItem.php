<?php
require_once '../config.php';
	if(isset($_REQUEST['category_item'])) $category_item = mysql_real_escape_string($_REQUEST['category_item']); else $category_item = '';
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$category_id = (int)mysql_real_escape_string($_REQUEST['category_id']);
	$vRes = mysql_query("SELECT * FROM `category_item` where (user_id=$user_id or user_id=0) and category_id = $category_id and category_item = '$category_item' limit 1");
	if (mysql_num_rows($vRes) == 0 && $category_item != ''){
			mysql_query("INSERT INTO category_item(user_id,category_id,category_item) VALUES($user_id, $category_id,'$category_item')");
	}
	$getcategory_item=mysql_query("SELECT * FROM `category_item` where (user_id = $user_id or user_id = 0) and category_id = $category_id");
	echo mysql_error(); 	
	$sOption = '';
	while($option = mysql_fetch_array($getcategory_item)) {
		if($option['category_id'] == $category_id && $option['category_item']=="$category_item") $sOption .= "<option value='$option[id]' selected>$option[category_item]</option>";
		else $sOption .= "<option value='$option[id]'>$option[category_item]</option>";
	}
	mysql_close($link);
	echo $sOption;

?>