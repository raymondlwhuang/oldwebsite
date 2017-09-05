<?php
require_once '../config.php';
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
$paid = (int)mysql_real_escape_string($_REQUEST['paid']);
$user_id = (int)$_REQUEST['user_id'];
$bank_id = (int)$_REQUEST['bank_id'];
if(isset($_REQUEST['action'])) $action = mysql_real_escape_string($_REQUEST['action']);
if(isset($_REQUEST['paid_status'])) $paid_status = mysql_real_escape_string($_REQUEST['paid_status']);
include("endec.php");
$e = new endec(); 
$zero = $e->new_encode("0");
	if($paid==1) {
		$BankResult=mysql_query("SELECT * FROM `sp_bank` where id=$bank_id");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($OnHand = mysql_fetch_array($BankResult)) {
			if($OnHand['balance'] == '') $CashOnHand = 0;
			else $CashOnHand = $e->new_decode("$OnHand[balance]");
		}	
		$GetBalance=mysql_query("SELECT * FROM `spending` where  user_id=$user_id and bank_id = $bank_id and paid = 3");          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($OnHandResult = mysql_fetch_array($GetBalance)) {
			$expenses = $e->new_decode("$OnHandResult[expenses]");
			$CashOnHand = $CashOnHand - $expenses;
		}
		$balance = $e->new_encode("$CashOnHand");	
		mysql_query("update sp_bank set balance = '$balance' where id=$bank_id limit 1");		
		echo mysql_error();  
		$refer_date = mysql_real_escape_string($_REQUEST['paid_date']);
		$fmyear=substr($refer_date,6,4);
		$fmmonth=substr($refer_date,0,2);
		$fmday=substr($refer_date,3,2);
		$paid_date = $fmyear."-".$fmmonth."-".$fmday;		
		mysql_query("update spending set paid = 1,paid_date='$paid_date' where user_id=$user_id and bank_id = $bank_id and paid = 3");
	}
	else {
		if($action=='update'){
			$id = (int)mysql_real_escape_string($_REQUEST['id']);
			mysql_query("update spending set paid = $paid where id=$id order by id limit 1");
		}
	}
$todate = date('Ymd')."000000";
$newdate = strtotime ( "-3 month" , strtotime ( $todate ) ) ;
$fmdate = date ( 'Ymd' , $newdate )."000000";
if($paid_status=="Paid") $queryResult=mysql_query("SELECT * FROM spending where user_id=$user_id and  date between $fmdate and $todate and bank_id = $bank_id and paid = 1 order by paid desc, type_id,date desc,id");
elseif($paid_status=="Unpaid") $queryResult=mysql_query("SELECT * FROM spending where user_id=$user_id and  date between $fmdate and $todate and bank_id = $bank_id and paid <> 1 and paid <> 4 order by paid desc, type_id,date desc,id");
elseif($paid_status=="Future") $queryResult=mysql_query("SELECT * FROM spending where user_id=$user_id and bank_id = $bank_id and paid = 4 order by paid desc, type_id,date desc,id");
else $queryResult=mysql_query("SELECT * FROM spending where user_id=$user_id and  date >= $fmdate and bank_id = $bank_id order by paid desc, type_id,date desc,id");
$CategoryResult=mysql_query("SELECT * FROM `spending_category` where user_id = $user_id or user_id = 0 order by category");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option1 = mysql_fetch_array($CategoryResult)) {
	$optionCategory["$option1[id]"] = $option1['category'];
}
$TypeResult=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $user_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option6 = mysql_fetch_array($TypeResult)) {
	$optionType["$option6[id]"] = $option6['Type'];
}
$BalanceResult=mysql_query("SELECT * FROM `sp_bank` where id=$bank_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($Balance = mysql_fetch_array($BalanceResult)) {
	$curr_balance = $e->new_decode("$Balance[balance]");
}
?>
	<tr>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Spender</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Description</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Type</p>
	</th>
    <th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Date</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Amount</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Balance</p>
	</th>
	<th style='font-size:15px;width:100px;border-color:#5050FF;border-style: solid;border-width: 3px;text-align:left;'>
	<form name="myform">
	<input type="radio" name="paid_status" value="All" <?php if($paid_status=="All") echo "checked='checked'"; ?> onClick="Action(0,0,false);">All<br/>
	<input type="radio" name="paid_status" value="Unpaid" <?php if($paid_status=="Unpaid") echo "checked='checked'"; ?> onClick="Action(0,0,false);">Unpaid<br/>
	<input type="radio" name="paid_status" value="Paid" <?php if($paid_status=="Paid") echo "checked='checked'"; ?> onClick="Action(0,0,false);">Paid<br/>
	<input type="radio" name="paid_status" value="Future" <?php if($paid_status=="Future") echo "checked='checked'"; ?> onClick="Action(0,0,false);">Paid Future
	</form>
	</th>
	</tr>
<?php
$paid_amount = 0;
while($nt=mysql_fetch_array($queryResult)){
$amount = $e->new_decode("$nt[expenses]");
$category_id = $nt['category_id'];
$item_id = $nt['item_id'];
$type_id = $nt['type_id'];
$bank_id2 = $nt['bank_id'];
$querySpender = mysql_query("SELECT * FROM `spender` where id = $nt[spender_id] limit 1");
echo mysql_error(); 
while($GetSpender = mysql_fetch_array($querySpender)) {
$name = $GetSpender['name'];
}
$ItemResult=mysql_query("SELECT * FROM `category_item` where id = $item_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option2 = mysql_fetch_array($ItemResult)) {
	$category_item = $option2['category_item'];
}					
$Description = "$optionCategory[$category_id]=>$category_item";
if($nt['paid'] == 3) $paid_amount = $paid_amount + $amount;
echo "
<tr>
	<td  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>
	$name";
echo "</td>	
	<td  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>
	$Description
	</td>
	<td  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>
	$optionType[$type_id]
	</td>
    <td  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>";
	echo substr($nt['date'],-5);
echo"	</td>
	<td align='right'  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>
	$amount
	</td>
	<td  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>";
	if($nt['paid'] == 1) echo $curr_balance; else echo "";
echo "	
	</td>
	
	<td  style='font-size:30px;border-style: solid;border-width: 3px;text-align:right;'>";
	if($nt['paid'] == 3) {
		echo "
		<input type='checkbox' name='$nt[id]' id='$nt[id]' value='$amount' checked='checked' onChange='Action(this.name,this.value,this.checked);' />
		";
	}
	elseif($nt['paid'] == 0) {
		echo "
		<input type='checkbox' name='$nt[id]' id='$nt[id]' value='$amount' onChange='Action(this.name,this.value,this.checked);' />
		";
	}
	elseif ($nt['paid'] == 1 ||$nt['paid'] == 4){
		echo "
		<input type='checkbox' name='$nt[id]' id='$nt[id]' value='$amount' checked='checked' disabled='disabled' />
		";
	}	
	echo "
	</td>
	</tr>";
	if($nt['paid'] == 1) $curr_balance = $curr_balance - $amount;
}
?>
<script type="text/javascript">
total = <?php echo $paid_amount; ?>;
document.getElementById('total').innerHTML = "$"+total;
</script>
