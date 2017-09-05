<?php
require_once '../config.php';
IF(isset($_REQUEST['category_id']))
{
	$category_id = (int)mysql_real_escape_string($_REQUEST['category_id']);
	$vRes = mysql_query("SELECT * FROM `category_item` where category_id = $category_id ORDER BY category_id");
	$sOption = '';
	if ($vRes) {
		while($option = mysql_fetch_array($vRes)) {
			$sOption .= "<option value='$option[id]'>$option[category_item]</option>";
		}
	}
	mysql_close($link);
	echo $sOption;
}
?>