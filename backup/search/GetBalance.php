<?php
require_once '../config.php';
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
include("../PHP/endec.php");
$e = new endec(); 
$encodebalance = $e->new_encode("0");
	if(isset($_REQUEST['bank_id'])) $id = (int)mysql_real_escape_string($_REQUEST['bank_id']); else $id = 0;
	if($id == 0) echo "0.00";
	else {
		$vRes = mysql_query("SELECT * FROM `sp_bank` where id = $id order by id desc limit 1");
		while($option1 = mysql_fetch_array($vRes)) {
			$balance = "$".$e->new_decode("$option1[balance]");
		}	
		mysql_close($link);
		echo $balance;
	}	
?>