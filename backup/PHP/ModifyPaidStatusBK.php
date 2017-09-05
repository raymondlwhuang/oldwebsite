<?php
require_once '../config.php';
$GV_pin = mysql_real_escape_string($_REQUEST['pin']);
$paid = (int)mysql_real_escape_string($_REQUEST['paid']);
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$type_id = (int)mysql_real_escape_string($_REQUEST['type_id']);
include("endec.php");
$e = new endec(); 
$zero = $e->new_encode("0");
if($paid==1) {
	$refer_date = mysql_real_escape_string($_REQUEST['paid_date']);
	$fmyear=substr($refer_date,6,4);
	$fmmonth=substr($refer_date,0,2);
	$fmday=substr($refer_date,3,2);
	$paid_date = $fmyear."-".$fmmonth."-".$fmday;		
	mysql_query("update spending set paid = 1,paid_date='$paid_date' where user_id=$user_id and paid = 3 and type_id = $type_id");
}
else {
	$id = (int)mysql_real_escape_string($_REQUEST['id']);
	mysql_query("update spending set paid = $paid where id=$id order by id limit 1");
}
$todate = date('Ymd')."000000";
$newdate = strtotime ( "-3 month" , strtotime ( $todate ) ) ;
$fmdate = date ( 'Ymd' , $newdate )."000000";
$queryResult=mysql_query("SELECT * FROM spending where user_id=$user_id and  date between $fmdate and $todate and paid !=1  and type_id = $type_id order by date desc");
?>
<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;" id="Result">
	<tr>
    <th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Date</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Amount</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Bank</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Paid Status</p>
	</th>
	</tr>
<?php
$paid_amount = 0;
while($nt=mysql_fetch_array($queryResult)){
$amount = $e->new_decode("$nt[expenses]");
if($nt['paid'] == 3) $paid_amount = $paid_amount + $amount;
echo "
<tr>
    <td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>";
	echo substr($nt['date'],-5);
echo "	
	</td>
	<td align='right'  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
	$amount
	</td>
	<td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
	$nt[bank_id]
	</td>
	<td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>";
	if($nt['paid'] == 3) {
		echo "
		<input type='checkbox' name='$nt[id]' id='$nt[id]' value='$amount' checked='checked' onChange='Action(this.name,this.value,this.checked);' />
		";
	}
	else {
		echo "
		<input type='checkbox' name='$nt[id]' id='$nt[id]' value='$amount' onChange='Action(this.name,this.value,this.checked);' />
		";
	}
	echo "
	</td>
	</tr>";	
}
?>
</table>
<script type="text/javascript">
total = <?php echo $paid_amount; ?>;
document.getElementById('total').innerHTML = "$"+total;
</script>
