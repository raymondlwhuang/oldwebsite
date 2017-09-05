<?php
require_once '../config.php';
	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$category_id = (int)mysql_real_escape_string($_REQUEST['category_id']);
	$item_id = (int)mysql_real_escape_string($_REQUEST['item_id']);

	$getcategory_item=mysql_query("SELECT * FROM `category_item` where (user_id = $user_id or user_id = 0) and category_id = $category_id");
	echo mysql_error(); 	
	$sOption = '';
	while($option = mysql_fetch_array($getcategory_item)) {
		$sOption .= "<option value='$option[id]'>$option[category_item]</option>";
	}
	

	$getComment=mysql_query("SELECT * FROM `sp_comment` where category_id = $category_id and item_id=$item_id");
	echo mysql_error();
	$sOption1 = '<option value="0"></option>';
	while($option1 = mysql_fetch_array($getComment)) {
		$sOption1 .= "<option value='$option1[id]'>$option1[comment]</option>";
	}
	mysql_close($link);
?>
<td align="right">Description</td>
<td width="60"></td>
<td width="60"><input type="image" src="../images/add.png" name="AddItem" value="Add Item" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Description',3);return false;">	</td>
<td align="left">
<select name="item_id" id="item_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(4);">
<?php echo $sOption; ?>
</select>
</td>
<td align="right">Comment</td>
<td width="60"><input type="image" src="../images/add.png" name="AddComment" value="Add Comment" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Comment',4);return false;">	</td>
<td align="left">
<select name="comment_id" id="comment_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onFocus="SetDisp(4);" onclick="SetDisp(4);">
<option value='0' selected></option>"
<?php echo $sOption1 ?>
</select>
</td>