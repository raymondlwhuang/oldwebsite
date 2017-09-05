<?php
require_once '../config.php';
	if(isset($_REQUEST['comment']))	$comment = trim(mysql_real_escape_string($_REQUEST['comment'])); else $comment = '';
	$category_id = (int)mysql_real_escape_string($_REQUEST['category_id']);
	$item_id = (int)mysql_real_escape_string($_REQUEST['item_id']);
	$vRes = mysql_query("SELECT * FROM `sp_comment` where category_id=$category_id and item_id=$item_id and comment = '$comment' limit 1");
	if (mysql_num_rows($vRes) == 0 && $comment != ''){
			mysql_query("INSERT INTO sp_comment(category_id,item_id,comment) VALUES($category_id,$item_id,'$comment')");
	}	
	$getComment=mysql_query("SELECT * FROM `sp_comment` where category_id = $category_id and item_id=$item_id");
	echo mysql_error();
	IF($comment == '') $sOption = '<option value="0" selected></option>';
	ELSE $sOption = '<option value="0"></option>';
	while($option = mysql_fetch_array($getComment)) {
		if($option['category_id'] == $category_id && $option['item_id']==$item_id && $comment != '') $sOption .= "<option value='$option[id]' selected>$option[comment]</option>";
		else $sOption .= "<option value='$option[id]'>$option[comment]</option>";
	}
	mysql_close($link);
	echo $sOption;	
?>