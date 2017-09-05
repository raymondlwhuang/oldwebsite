<?php
require_once '../config.php';
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
include("../PHP/endec.php");
$e = new endec(); 
$encodebalance = $e->new_encode("0");

	$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
	$category_id = (int)mysql_real_escape_string($_REQUEST['category_id']);
	$item_id = (int)mysql_real_escape_string($_REQUEST['item_id']);
	if(isset($_REQUEST['type_id']))	$type_id = (int)mysql_real_escape_string($_REQUEST['type_id']);
	$bank_id = (int)mysql_real_escape_string($_REQUEST['bank_id']);
	$spender_id = (int)mysql_real_escape_string($_REQUEST['spender_id']);
	if(isset($type_id)) $getBank=mysql_query("SELECT * FROM `spending` where user_id=$user_id and spender_id=$spender_id and type_id=$type_id order by id desc limit 1");
	else $getBank=mysql_query("SELECT * FROM `spending` where user_id=$user_id and spender_id=$spender_id and category_id=$category_id and item_id=$item_id order by id desc limit 1");
	echo mysql_error();
	if (mysql_num_rows($getBank) == 0){
		$getBank=mysql_query("SELECT * FROM `spending` where user_id=$user_id and spender_id=$spender_id and type_id = 1 order by id desc limit 1");
		echo mysql_error();
	}
	while($Row = mysql_fetch_array($getBank)) {
		$bank_id = $Row['bank_id'];
		if(!isset($type_id)) $type_id = $Row['type_id'];
	}
	$vRes = mysql_query("SELECT * FROM `sp_bank` where id = $bank_id order by id limit 1");
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$balance = "$0.00";
	while($option1 = mysql_fetch_array($vRes)) {
		$balance = "$".$e->new_decode("$option1[balance]");
	}	
	$getsp_bank=mysql_query("SELECT * FROM `sp_bank` where user_id = $user_id");
	echo mysql_error(); 
	$sOption = '';
	$dispbalance = 0;
	while($option = mysql_fetch_array($getsp_bank)) {
		if($option['id'] == $bank_id) $sOption .= "<option value='$option[id]' selected>$option[bank]</option>";
		else $sOption .= "<option value='$option[id]'>$option[bank]</option>";
	}
	mysql_close($link);
		
?>
<td align="right" width="210" colspan="2"><font id="bank_desc">Will Pay From</font></td>
<td width="60"><input type="image" src="../images/add.png" name="AddBank" value="Add Bank" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Bank',7);">	</td>
<td align="left">
<select name="bank_id" id="bank_id" style="font-size:20px;width:200px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(5);">
<?php echo $sOption; ?>
</select>
<font id="balance" style="font-size:20px;width:50px;border-color:#5050FF;border-width: 3px;"><?php echo $balance; ?></font>
<select name="reminder" id="reminder" style="font-size:25px;border-color:#5050FF;border-width: 3px;" onChange="SetRminder();">
	<option value='1' selected>Never</option>
	<option value='2'>Daily</option>
	<option value='3'>Weekly</option>
	<option value='4'>Bi-Weekly</option>
	<option value='5'>Monthly</option>
	<option value='9'>Bi-Monthly</option>
	<option value='6'>Quarterly</option>
	<option value='7'>Semi-Annually</option>
	<option value='8'>Yearly</option>
</select>Rimind	

</td>
<td width="60"></td>
<td width="60"><font id="to_bank_label" style="display:none;">TO:</font></td>
<td align="left">
<select name="to_bank" id="to_bank" style="font-size:20px;width:250px;border-color:#5050FF;border-width: 3px;display:none;">
<?php echo $sOption; ?>
</select>			
</td>
<script type="text/javascript">
document.getElementById('type_id').value = "<?php echo $type_id; ?>";
</script>