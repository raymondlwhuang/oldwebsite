<?php
require_once '../config.php';
if(isset($_REQUEST['item_frequency_id'])) $item_frequency_id = (int)mysql_real_escape_string($_REQUEST['item_frequency_id']); else $item_frequency_id = 0;
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$delete = (int)mysql_real_escape_string($_REQUEST['delete']);
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);	
include("../PHP/endec.php");
$e = new endec(); 
$zero = $e->new_encode("0");
	if($delete ==1) mysql_query("DELETE from `item_frequency` where user_id=$user_id and id = $item_frequency_id limit 1");
	else {
		$amount = (float)mysql_real_escape_string($_REQUEST['amount']);
		$newamount = $e->new_encode("$amount");
		mysql_query("UPDATE `item_frequency` set amount = '$newamount' where user_id=$user_id and id = $item_frequency_id limit 1");
	}
	echo mysql_error();
	$getitem_frequency=mysql_query("SELECT * FROM `item_frequency` where user_id = $user_id");
	echo mysql_error(); 	
	$sOption = '';
	while($option = mysql_fetch_array($getitem_frequency)) {
		$get_desc=mysql_query("SELECT * FROM `sp_frequency` where id = $option[frequency_id] limit 1");
		echo mysql_error(); 	
		while($descResult = mysql_fetch_array($get_desc)) {
			$description = $descResult['frequency'];
		}
		$get_spender=mysql_query("SELECT * FROM `spender` where user_id = $user_id and id = $option[spender_id] limit 1");
		echo mysql_error(); 	
		while($spenderResult = mysql_fetch_array($get_spender)) {
			$name = $spenderResult['name'];
		}	
		$get_category=mysql_query("SELECT * FROM `spending_category` where (user_id = $user_id or user_id = 0) and id= $option[category_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($categoryResult = mysql_fetch_array($get_category)) {
			$category = $categoryResult['category'];
		}		
		$get_category_item=mysql_query("SELECT * FROM `category_item` where (user_id = $user_id or user_id = 0) and id= $option[item_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($itemResult = mysql_fetch_array($get_category_item)) {
			$category_item = $itemResult['category_item'];
		}		
		$get_bank=mysql_query("SELECT * FROM `sp_bank` where user_id = $user_id and id= $option[bank_id] limit 1");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($bankResult = mysql_fetch_array($get_bank)) {
			$bank = $bankResult['bank'];
		}
		$amount = $e->new_decode("$option[amount]");
//		$disp = "\$$amount will recorded $description for spender-$name at $option[start_date].";
		$disp = "$name($category=>$category_item) \$$amount will recorded $description starting at $$option[start_date]=>$bank.";

//		$disp = "Automatic $description recording for $name starting at $option[start_date], Amount inserted will be \$$amount";
		$sOption .= "<option value='$option[id]'>$disp</option>";
	}
	mysql_close($link);
	echo $sOption;
?>