<?php
require_once '../config.php';
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
if(isset($_REQUEST['bank'])) $bank = mysql_real_escape_string($_REQUEST['bank']); else $bank = '';
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$spender_id = (int)mysql_real_escape_string($_REQUEST['spender_id']);
if(isset($_REQUEST['adjustment'])) $balance = (float)mysql_real_escape_string($_REQUEST['adjustment']); else $balance = 0;
include("../PHP/endec.php");
$e = new endec(); 
$encodebalance = $e->new_encode("0");
	$vRes = mysql_query("SELECT * FROM `sp_bank` where user_id = $user_id and bank = '$bank' order by id desc limit 1");
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$adjustment = $e->new_encode("$balance");
	if (mysql_num_rows($vRes) == 0 && $bank != ''){
		$encodebalance = $e->new_encode("$balance");
		mysql_query("INSERT INTO sp_bank(user_id,spender_id,bank,balance) VALUES($user_id,$spender_id, '$bank','$encodebalance')");
	}
	else if(mysql_num_rows($vRes) != 0 && $bank != '') {
		while($option1 = mysql_fetch_array($vRes)) {
			$oldBalance = $e->new_decode("$option1[balance]");
			$newBalance = $balance + (float)$oldBalance;
			$encodebalance = $e->new_encode("$newBalance");
		}	
		mysql_query("update sp_bank set balance = '$encodebalance' where  user_id = $user_id and bank = '$bank' order by id desc limit 1");
	}
	$before_insert=mysql_query("SELECT * FROM `sp_bank` where user_id = $user_id and bank = '$bank' order by id desc limit 1");
	echo mysql_error(); 
	while($option2 = mysql_fetch_array($before_insert)) {
		$bank_id = $option2['id'];
	}	
	mysql_query("INSERT INTO sp_bank_detail(user_id,bank_id,ajust_amount,balance,description) VALUES($user_id,$bank_id,'$adjustment','$encodebalance','Adjustment')");
	$getsp_bank=mysql_query("SELECT * FROM `sp_bank` where user_id = $user_id");
	echo mysql_error(); 
	$sOption = '';
	$dispbalance = 0;
	while($option = mysql_fetch_array($getsp_bank)) {
		if($option['bank'] == "$bank") $sOption .= "<option value='$option[id]' selected>$option[bank]</option>";
		else $sOption .= "<option value='$option[id]'>$option[bank]</option>";
	}
	mysql_close($link);
	echo $sOption;	
?>