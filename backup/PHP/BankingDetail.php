<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	$_SESSION["page"] = "HER";
	header('Location: login.php');
	exit();
}
if(!isset($_SESSION["pin"]))
{
	header("Location: getPin.php");
	exit;
}
else $GV_pin = $_SESSION["pin"];
include("../config.php");
include("endec.php");
include("../inc/GlobalVar.inc.php");
include("../inc/CurrentDateTime.inc.php");
$e = new endec(); 
$zero = $e->new_encode("0");
$bank_id = (int)$_REQUEST['bank_id'];

$todate = substr($now,0,10)."00000000";
$replaceStr = array("-", ":", " ");
$todate = str_replace($replaceStr,"",$todate);
$fmdate = substr($todate,0,6)."01000000";
$daysdiff = date('d') + 1;
$queryMonth="SELECT * FROM spending where user_id=$GV_id and bank_id=$bank_id and date between $fmdate and $todate order by date desc,id desc";  // query string stored in a variable
$RangResult=mysql_query($queryMonth);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 

$BankResult=mysql_query("SELECT * FROM `sp_bank` where user_id = $GV_id and id=$bank_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option = mysql_fetch_array($BankResult)) {
	$BankName = $option['bank'];
	if($option['balance'] == '') $balance = 0; else $balance = $e->new_decode("$option[balance]");
}
$CategoryResult=mysql_query("SELECT * FROM `spending_category` where user_id = $GV_id or user_id = 0 order by category");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option1 = mysql_fetch_array($CategoryResult)) {
	$optionCategory["$option1[id]"] = $option1['category'];
}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Banking Detail</title>

</head>
<body style="font-size:25px;">
<div id="main">
	<table width="100%" style="font-size:25px;">
		<tr>
			<td>
			<input type="image" src="../images/home.png" name="Home" value="Home" width="80" onClick="window.open('index.php',target='_top');">
			</td>
			<td>
			</td>
			<td>
			<input type="image" src="../images/account.png" name="account" value="account" width="80" onClick="window.open('CreditPayOff.php',target='_top');">
			</td>
			<td>
			</td>
			<td>
			<input type="image" src="../images/pin.jpg" name="pid" value="pid" width="80" onClick="window.open('getPin.php',target='_top');">
			</td>
			<td>
			</td>
			<td>
			<input type="image" src="../images/HERecorder.jpg" name="Back" value="Back" width="80" onclick="window.open('HERecorder.php',target='_top');">
			</td>
			<td colspan="3" style="float:right;"><input type="image" src="../images/logout.png" name="Cancel" value="Cancel" width="80" onClick="window.open('signout.php',target='_top');"></td>
		</tr>
		<tr>
			<td colspan="7" align="center"><font color="red"><b id="ErrorMessage"></b></font></td>
		</tr>
	</table>
	<div id="Result">
		<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
			<tr>
			<th style='font-size:25px;color:red;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:center;' colspan="8">
			<?php echo strtoupper($BankName); ?>
			</th>
			</tr>		
			<tr>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Date
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Category
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Description
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Amount
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Spender
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Type
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Paid Status
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Balance
			</th>
			</tr>
			<?php
			//$e = new endec();  
			$NewBalance=$balance;
			while($nt=mysql_fetch_array($RangResult)){
				$expenses = $e->new_decode("$nt[expenses]");
				$category = $optionCategory[$nt['category_id']];
				if($nt['paid'] == 1) $PaidStatus = "Paid";
				elseif($nt['paid'] == 4) $PaidStatus = "Set Paid In later date";
				else $PaidStatus = "Unpaid";
				$ItemResult=mysql_query("SELECT * FROM `category_item` where category_id = $nt[category_id] and id = $nt[item_id] and (user_id = $GV_id or user_id = 0) limit 1");          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				while($option5 = mysql_fetch_array($ItemResult)) {
					$category_item = $option5['category_item'];
				}	
				
				$querySpender = mysql_query("SELECT * FROM `spender` where id = $nt[spender_id] limit 1");
				echo mysql_error(); 
				while($GetSpender = mysql_fetch_array($querySpender)) {
				$name = $GetSpender['name'];
				}	
				$queryPaymentType = mysql_query("SELECT * FROM `sp_payment_type` where id = $nt[type_id] limit 1");
				echo mysql_error(); 
				while($GetType = mysql_fetch_array($queryPaymentType)) {
				$type = $GetType['Type'];
				}				
			echo "
			<tr>
				<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>";
				echo @substr($nt[date],-5);
			echo "	
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$category
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$category_item
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$expenses
				</td>
				<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$name
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$type
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$PaidStatus
				</td>
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>";
				if($nt['paid']==1) echo $NewBalance;
				echo "
				</td>
			</tr>
			";
			if($nt['paid']==1) $NewBalance=$NewBalance-$expenses;

			}
			?>
		</table>
	</div>
</div>	
</body>
</html>
