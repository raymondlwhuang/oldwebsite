<?php
session_start();
include("../config.php");
if(@$_SESSION['private'] != "yes")
{
	$_SESSION["page"] = "HER";
	header('Location: login.php');
	exit();
}
if(!isset($_SESSION['pin']))
{
	header("Location: getPin.php");
	exit;
}
else $GV_pin = $_SESSION['pin'];
include("endec.php");
include("../inc/GlobalVar.inc.php");
include("../inc/CurrentDateTime.inc.php");
$e = new endec(); 
$zero = $e->new_encode("0");

$todate = date('Ymd')."000000";
$newdate = strtotime ( "-3 month" , strtotime ( $todate ) ) ;
$fmdate = date ( 'Ymd' , $newdate )."000000";
$queryResult=mysql_query("SELECT * FROM spending where user_id=$GV_id and  date between $fmdate and $todate and paid !=1  and type_id = 2 order by date desc");
echo mysql_error();              // if any error is there that will be printed to the screen 
$TypeResult=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option6 = mysql_fetch_array($TypeResult)) {
	$optionType["$option6[id]"] = $option6['Type'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Credit Card Pay Off</title>
<style type="text/css"> 
input.wide {display:block; width: 99%} 
</style> 
<script src="../scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
var total=0;
function Action(this_id,amount,add) {
	var paid = 0;
	if(amount !=0) {
		if(add) {
		  total = total + parseFloat(amount);
		  paid = 3;
		}
		else {
		  total = total - parseFloat(amount);
		}
	}
	document.getElementById('total').innerHTML = "$"+total;
	var user_id = "<?php echo $GV_id; ?>";
	var type_id = document.getElementById('type_id').value;
	var url ="ModifyPaidStatus.php?pin=<?php echo $GV_pin; ?>&user_id="+user_id+"&id="+this_id+"&amount="+amount+"&paid="+paid+"&type_id="+type_id;
	$(document).ready(function() {
	   $('#Result').load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function Action_Final() {
	var user_id = "<?php echo $GV_id; ?>";
	var paid_date = encodeURIComponent(document.getElementById('paid_date').value);
	var infor = document.getElementById('paid_date').value;
	var type_id = document.getElementById('type_id').value;
	var url ="ModifyPaidStatus.php?pin=<?php echo $GV_pin; ?>&user_id="+user_id+"&paid=1&paid_date="+paid_date+"&type_id="+type_id;
	var ans=confirm( 'Are you sure want to paid at '+infor+'?');
	if(ans) {
		$(document).ready(function() {
		   $('#Result').load(url);
		   $.ajaxSetup({ cache: false });
		});	
	}	
}
function DispDate(id) {
	var mydate= new Date();
	document.getElementById('paid_date').value = ("0" + (mydate.getMonth() + 1)).slice(-2)+"/"+("0" + mydate.getDate()).slice(-2)+"/"+mydate.getFullYear();
}
</script>
</head>
<body style="font-size:60px;">
<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
			<td valign="bottom" style='font-size:40px;border-style: solid;border-width: 3px;text-align:center;'>
				<font  id="Date_label">Total </font><b><font  id="total" color="red">$0</font></b>
				<select name="type_id" id="type_id" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="Action(0,0,false);">
				<?php
					foreach($optionType as $id=>$type) {
						if($id == 2) echo "<option value='$id' selected>$type</option>";
						else echo "<option value='$id'>$type</option>";
					}
				?>
				</select>
				 will paid </font>
			</td>
	</tr>
	<tr>
			<td valign="bottom" style='font-size:40px;border-style: solid;border-width: 3px;text-align:center;'>
				at: <input type="text" name="paid_date" id="paid_date" maxlength="10" size="10" style='font-size:40px;border-style: solid;border-color:#ff0000;border-width: 3px;text-align:right;'>
				<input type="image" src="../images/calendar.jpg" name="calender" id="calender" width="60" value="calender" onClick="GetDate(document.getElementById('paid_date'));" style='position:relative;top:10px;'>
				<input type="image" src="../images/click-here.gif" name="Save" value="Save" width="60" onclick="Action_Final();" style='position:relative;top:10px;'>
				<b><font color="red" style='position:relative;top:-10px;'><=Confirm</font></b>
			</td>
	</tr>
</table>
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
window.onload=DispDate;
total = <?php echo $paid_amount; ?>;
document.getElementById('total').innerHTML = "$"+total;
</script>
</body>
</html>
	