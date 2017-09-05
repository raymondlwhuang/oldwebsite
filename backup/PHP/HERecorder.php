<?php
session_start();
if(!isset($_SESSION['private']) || $_SESSION['private'] != "yes")
{
	$_SESSION["page"] = "HER";
echo <<<_END
<script type="text/javascript">
window.open('index.php',target='_top');
</script>
_END;
		
exit();
}
if(!isset($_SESSION["pin"]))
{
echo <<<_END
<script type="text/javascript">
window.open('getPin.php',target='_top');
</script>
_END;
		
exit();
	
}
else $GV_pin = $_SESSION["pin"];
include("../config.php");
include("endec.php");
include("../inc/GlobalVar.inc.php");
include("../inc/CurrentDateTime.inc.php");
$e = new endec(); 
$zero = $e->new_encode("0");
$month_array = array ();
$month_array[1] = "January";
$month_array[2] = "February";
$month_array[3] = "March";
$month_array[4] = "April";
$month_array[5] = "May";
$month_array[6] = "June";
$month_array[7] = "July";
$month_array[8] = "August";
$month_array[9] = "September";
$month_array[10] = "October";
$month_array[11] = "November";
$month_array[12] = "December";
$month = date('m');
$year = date('Y');
if($month == 12){
	$month = 1;
	$year = $year + 1; 
}
else {
	$month = $month + 1;
}
if(isset($_POST['Delete_x']))
{
	$reminder_id = $_REQUEST['reminder_id'];
	mysql_query("DELETE from `sp_reminder` where id=$reminder_id");
	echo "
        <script type=\"text/javascript\">
			window.open('HERecorder.php',target='_top');
        </script>";
	exit();	
}
$reset_date = $year.str_pad($month, 2, "0", STR_PAD_LEFT)."01";
$vRes = mysql_query("SELECT * FROM `spender` where user_id=$GV_id limit 1");
if (mysql_num_rows($vRes) == 0){
	mysql_query("INSERT INTO spender(user_id,name) VALUES($GV_id,'Me')");
	$SaveCheck = "SELECT * FROM spender WHERE user_id = $GV_id LIMIT 1";
	$result = mysql_query($SaveCheck);
	while($Row=mysql_fetch_array($result)){
		$spender_id = $Row['id'];
		mysql_query("INSERT INTO sp_bank(user_id,spender_id,bank,pay_now) VALUES($GV_id,$spender_id,'Cash On Hand(Me)',1)");
		echo mysql_error(); 
	}
	mysql_query("INSERT INTO sp_monthly(user_id,monthly_income,monthly_expenese,reset_date) VALUES($GV_id,'$zero','$zero',$reset_date)");
}
$insertCheck = mysql_query("SELECT * FROM `sp_monthly` where user_id=$GV_id order by id desc limit 1");
	while($Row1=mysql_fetch_array($insertCheck)){
		$resetyear=substr($Row1['reset_date'],0,4);
		$resetmonth=substr($Row1['reset_date'],5,2);
		$resetday=substr($Row1['reset_date'],8,2);
		$currdate2 =  date("YmdHis"); 
		$newdate = strtotime ( "+5 hours" , strtotime ( $currdate2 ) ) ;
		$curryear = date("Y",$newdate);
		$currmonth = str_pad(date("m",$newdate), 2, "0", STR_PAD_LEFT);
		$currday = str_pad(date("d",$newdate), 2, "0", STR_PAD_LEFT);
		$reset_date2=gregoriantojd($resetmonth, $resetday, $resetyear);   
		$curr_date2=gregoriantojd($currmonth, $currday, $curryear);   
		$daysdiff2 = $curr_date2 - $reset_date2;
		if($daysdiff2 >=0) mysql_query("INSERT INTO sp_monthly(user_id,monthly_income,monthly_expenese,reset_date) VALUES($GV_id,'$zero','$zero',$reset_date)");
	}

$todate = substr($now,0,10)."00000000";
$replaceStr = array("-", ":", " ");
$todate = str_replace($replaceStr,"",$todate);
$fmdate = substr($todate,0,6)."01000000";
$daysdiff = date('d') + 1;
$queryMonth="SELECT * FROM spending where user_id=$GV_id and date between $fmdate and $todate order by date desc,id desc";  // query string stored in a variable
$RangResult=mysql_query($queryMonth);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$SpenderResult=mysql_query("SELECT * FROM `spender` where user_id = $GV_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option = mysql_fetch_array($SpenderResult)) {
	$optionSpender["$option[id]"] = $option['name'];
}
$TypeResult=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option6 = mysql_fetch_array($TypeResult)) {
	$optionType["$option6[id]"] = $option6['Type'];
}

$BankResult=mysql_query("SELECT * FROM `sp_bank` where user_id = $GV_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option7 = mysql_fetch_array($BankResult)) {
	$optionBank["$option7[id]"] = $option7['bank'];
	if($option7['balance'] == '') $balance = 0; else $balance = $e->new_decode("$option7[balance]");
	$optionBalance["$option7[id]"] = $balance;
}
$CategoryResult=mysql_query("SELECT * FROM `spending_category` where user_id = $GV_id or user_id = 0 order by category");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option1 = mysql_fetch_array($CategoryResult)) {
	$optionCategory["$option1[id]"] = $option1['category'];
}
foreach($optionCategory as $category_id2=>$category) {
	$querySpending=mysql_query("SELECT * from spending where user_id=$GV_id and category_id=$category_id2 and date between $fmdate and $todate order by category_id,item_id");
	echo mysql_error();
	$categoryTotal["$category_id2"] = 0;
	while($TotalResult = mysql_fetch_array($querySpending)) {
		if($category_id2 == 1) $income = $e->new_decode("$TotalResult[expenses]");
		else $expenses2 = $e->new_decode("$TotalResult[expenses]");
		$item_id = $TotalResult['item_id'];
		if($category_id2 == 1) $categoryTotal["$category_id2"] += $income;
		else $categoryTotal["$category_id2"] += $expenses2;
		if(!isset($itemTotal["$category_id2"]["$item_id"])) $itemTotal["$category_id2"]["$item_id"] = 0;
		if($category_id2 == 1) $itemTotal["$category_id2"]["$item_id"] += $income;
		else $itemTotal["$category_id2"]["$item_id"] += $expenses2;
		$spender_id2 = $TotalResult['spender_id'];
		if(!isset($SpenderTotal["$spender_id2"])) $SpenderTotal["$spender_id2"] = 0;
		if($category_id2 == 1) {
			if(!isset($SpenderIncome["$spender_id2"])) $SpenderIncome["$spender_id2"] = 0;
			$SpenderIncome["$spender_id2"] += $income;
		}
		else $SpenderTotal["$spender_id2"] += $expenses2;
	}  
}
$ItemResult=mysql_query("SELECT * FROM `category_item` where category_id = 7 and (user_id = $GV_id or user_id = 0) order by category_id,id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option2 = mysql_fetch_array($ItemResult)) {
	$optionItem["$option2[id]"] = $option2['category_item'];
}
$CommentResult=mysql_query("SELECT * FROM `sp_comment` where category_id = 7 and item_id = 1 order by item_id");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option3 = mysql_fetch_array($CommentResult)) {
	$optionComment["$option3[id]"] = $option3['comment'];
}
$frequencyResult=mysql_query("SELECT * FROM `sp_frequency` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option8 = mysql_fetch_array($frequencyResult)) {
	$optionfrequency["$option8[id]"] = $option8['frequency'];
}
$getitem_frequency=mysql_query("SELECT * FROM `item_frequency` where user_id = $GV_id");
echo mysql_error(); 	
while($option9 = mysql_fetch_array($getitem_frequency)) {
	$frequency_id9 = $option9['frequency_id'];
	$spender_id9 = $option9['spender_id'];
	$id9 = $option9['id'];
	$amount9 = $e->new_decode("$option9[amount]");
	$date9 = substr($option9['start_date'],0,10);
	$category_id9 = $option9['category_id'];
	$bank_id9 = $option9['bank_id'];
	$get_category_item=mysql_query("SELECT * FROM `category_item` where (user_id = $GV_id or user_id = 0) and id= $option9[item_id] limit 1");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($itemResult9 = mysql_fetch_array($get_category_item)) {
		$category_item9 = $itemResult9['category_item'];
	}		
	$disp9 = "$optionSpender[$spender_id9]($optionCategory[$category_id9]=>$category_item9) \$$amount9 will recorded $optionfrequency[$frequency_id9] starting at $date9=>$optionBank[$bank_id9].";
	$optionPayFrq["$id9"] = $disp9;
}
$monthlyResult="SELECT * FROM sp_monthly where user_id = $GV_id order by reset_date";  // query string stored in a variable
$getMonthlyResult=mysql_query($monthlyResult);          // query executed 
echo mysql_error();  
$Income = '';
$Expenese = '';
while($monthly=mysql_fetch_array($getMonthlyResult)){
	$month = substr($monthly['reset_date'],5,2);
	$year = substr($monthly['reset_date'],0,4);
	if($month == 1){
		$month = 12;
		$year = $year - 1; 
	}
	else {
	 $month = $month - 1;
	}
	$year_month = $year.str_pad($month, 2, "0", STR_PAD_LEFT);
	$spender_id4 = $monthly['id'];
	$monthly_income = $e->new_decode("$monthly[monthly_income]");
	$monthly_expenese = $e->new_decode("$monthly[monthly_expenese]");
	$Income = "<option value='$year_month'>$month_array[$month]=>\$$monthly_income</option>$Income";
	$Expenese = "<option value='$year_month'>$month_array[$month]=>\$$monthly_expenese</option>$Expenese";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Household Expenses Recorder</title>
<style type="text/css"> 
input.wide {display:block; width: 99%} 
 #AddDialog {
	position:relative;
	left:10px;
	top:20px;
	width:550px;
	height:350px;
	left: 50%;
	margin-left: -275px;	
	background-color: #FFFFFF;
	border-style:solid outset;
	border-width:3px;
	z-index:999;
	display:none;
}

/**************************************************************************************
  htmlDatePicker CSS file
  
  Feel Free to change the fonts, sizes, borders, and colours of any of these elements
***************************************************************************************/
/* The containing DIV element for the Calendar */
#dpCalendar {
  display: none;          /* Important, do not change */
  position: absolute;        /* Important, do not change */
  background-color: #eeeeee;
  color: black;
  font-size: 35px;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  width: 350px;
}
/* The table of the Calendar */
#dpCalendar table {
  border: 1px solid black;
  background-color: #eeeeee;
  color: black;
  font-size: 35px;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  width: 100%;
}
/* The Next/Previous buttons */
#dpCalendar .cellButton {
  background-color: #ddddff;
  color: black;
}
/* The Month/Year title cell */
#dpCalendar .cellMonth {
  background-color: #ddddff;
  color: black;
  text-align: center;
}
/* Any regular day of the month cell */
#dpCalendar .cellDay {
  background-color: #ddddff;
  color: black;
  text-align: center;
}
/* The day of the month cell that is selected */
#dpCalendar .cellSelected {
  border: 1px solid red;
  background-color: #ffdddd;
  color: black;
  text-align: center;
}
/* The day of the month cell that is Today */
#dpCalendar .cellToday {
  background-color: #ddffdd;
  color: black;
  text-align: center;
}
/* Any cell in a month that is unused (ie: Not a Day in that month) */
#dpCalendar .unused {
  background-color: transparent;
  color: black;
}
/* The cancel button */
#dpCalendar .cellCancel {
  background-color: #cccccc;
  color: black;
  border: 1px solid black;
  text-align: center;
}
/* The clickable text inside the calendar */
#dpCalendar a {
  text-decoration: none;
  background-color: transparent;
  color: blue;
}  
</style>
</head>
<body style="font-size:25px;">
<div id="AddDialog">
	<table width="100%">
	<tr>
	<td align="center" id="dialog_text" style="font-size:25px;">Name</td>
	<td align="right" valign="top"><input type="image" name="close" src="../images/close_icon.png" width="39" onclick="SetVisibleDiv('block'); AddInfor(0);"></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="text" name="input_text" id="input_text" value="" size="32" maxlength="30" style="font-size:25px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;"></td>
	</tr>	
	<tr id="adjustment">
	<td colspan="2" align="center"><font id="adj_title">Balance Ajustment</font><input type="text" name="input_amount" id="input_amount"  value="0" size="32" maxlength="15" style="font-size:25px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;"></td>
	</tr>	
	<tr>
	<td align="center" id="insert"><input type="image" name="insert" src="../images/submit.jpg" onclick="SetVisibleDiv('block'); AddInfor(1);"></td>
	</tr>
	</table>
</div>
<div id="main">
	<table width="100%" style="font-size:25px;">
		<tr>
			<td colspan="5">
			<input type="image" src="../images/home.png" name="Home" value="Home" width="80" onClick="window.open('index.php',target='_top');">
			<input type="image" src="../images/account.png" name="account" value="account" width="80" onClick="window.open('CreditPayOff.php',target='_top');">
			<input type="image" src="../images/pin.jpg" name="pid" value="pid" width="80" onClick="window.open('getPin.php',target='_top');">
			<input type="image" src="../images/save.jpg" name="Save" value="Save" width="80" onclick="answer=confirm('Are you sure you want to save?');if(answer) Action('Save');">
			<input type="image" src="../images/reminder.gif" name="Reminder" value="Reminder" width="80"  onClick="window.open('reminder.php',target='_top');">
			</td>
			<td colspan="2"><input type="image" src="../images/chat.png" name="start_chat" value="Chat" id="Chat" width="40" onClick="chat();">
				<div style='display:inline-block'>
				<font style="font-size:16px;color:blue;" id="Available"><div style='display:inline-block'><font style="font-size:8px;color:green;">0 Friend Online</font>
				<font id="AvailMsg"></font></div>
				</font><font style="font-size:20px;color:red;font-weight:bold;"><?php if(isset($message)) echo $message ?></font>
				</div>			
			    <input type="image" src="../images/logout.png" name="Cancel" value="Cancel" width="80" onClick="window.open('signout.php',target='_top');" style="float:right;"></td>
		</tr>
		<tr>
			<td colspan="7">
			<input type="image" src="../images/subtract.png" name="subtract" value="-" width="5%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/dot.png" name="dot" value="." width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/0.png" name="0" value="0" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/1.png" name="1" value="1" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/2.png" name="2" value="2" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/3.png" name="3" value="3" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/4.png" name="4" value="4" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/5.png" name="5" value="5" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/6.png" name="6" value="6" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/7.png" name="7" value="7" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/8.png" name="8" value="8" width="8%" onClick="setamount(this.value);">
			<input type="image" src="../images/9.png" name="9" value="9" width="8%" onClick="setamount(this.value);">
			</td>
		</tr>
		<tr>
			<td colspan="7" align="center">
				<div id="reminder_list">
				<form name="ReminderDel" method="Post">
				<input type="hidden" name="reminder_id" id="reminder_id" value="">
				<?php
				$queryResult3=mysql_query("SELECT * FROM sp_reminder where user_id=$GV_id and  activated <= NOW()");
				if(mysql_num_rows($queryResult3)!=0) {
				echo "<table  width=\"100%\" style=\"border-style: solid;border-color:#0000ff;border-width: 3px;\">
				<tr>
				<th colspan='4' style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:center;'><font color=\"red\"><b>Reminder: It's time to make payment for the following items</b></font></th>
				</tr>";
				}
				while($typeResult3 = mysql_fetch_array($queryResult3)) {
					$reminder_id=$typeResult3['id'];
					echo "<tr>
					    <td align='left'>
						<input type='image' src='../images/delete.png' name='Delete' value='$reminder_id' onClick=\"assign_value($reminder_id);\">
						</td>";

					$CategoryResult1=mysql_query("SELECT * FROM `spending_category` where id = $typeResult3[category_id] limit 1");          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					while($CategoryRow = mysql_fetch_array($CategoryResult1)) {
						echo "<td style='font-size:20px;border-style: solid;border-width: 3px;text-align:right;'>$CategoryRow[category]=>";
					}
					$ItemResult1=mysql_query("SELECT * FROM `category_item` where id = $typeResult3[item_id] limit 1");          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					while($ItemRow = mysql_fetch_array($ItemResult1)) {
						echo "$ItemRow[category_item] ";
					}	
					$TypeResult4=mysql_query("SELECT * FROM `sp_payment_type` where id = $typeResult3[type_id] limit 1");          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					while($TypeRow = mysql_fetch_array($TypeResult4)) {
						echo "with <font color=\"red\"><b>$TypeRow[Type]</b></font> ";
					}
					$BankResult1=mysql_query("SELECT * FROM `sp_bank` where id = $typeResult3[bank_id] limit 1");          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					while($BankRow = mysql_fetch_array($BankResult1)) {
						echo "pay from <font color=\"red\"><b>$BankRow[bank]</b></font>&nbsp;";
					}
					$BankResult2=mysql_query("SELECT * FROM `sp_bank` where id = $typeResult3[to_bank_id] limit 1");          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					while($BankRow = mysql_fetch_array($BankResult2)) {
						echo " to <font color=\"red\"><b>$BankRow[bank]</b></font> ";
					}
					$amount=$e->new_decode("$typeResult3[amount]");
					echo "with amount:</td><td width='80'><input type='text' class='reminder_amount' id='amt$reminder_id' value='$amount' readonly=\"readonly\" style='width:80px;font-size:25px;border-color:red;border-style: solid;border-width: 3px;text-align:center;color:red;font-weight:bold;'></td>";
					echo "<td style='border-style: solid;border-width: 3px;text-align:center;'>
					<input type='image' src='../images/paynow.png' height='30' name='$reminder_id' id='$reminder_id' onclick=\"make_payment($reminder_id,'amt$reminder_id');return false;\"></td></tr>";
				}
				if(mysql_num_rows($queryResult3)!=0) echo "</table>";
				$todate1 = date('Ymd')."000000";
				$newdate1 = strtotime ( "-1 month" , strtotime ( $todate1 ) ) ;
				$fmdate1 = date ( 'Ymd' , $newdate1 )."000000";
				$queryResult1=mysql_query("SELECT * FROM spending where user_id=$GV_id and  date <= $fmdate1 and paid <> 1 group by type_id");
				$Reminder='';
				while($typeResult1 = mysql_fetch_array($queryResult1)) {
					$queryResult2=mysql_query("SELECT * FROM sp_payment_type where (user_id=$GV_id or user_id=0) and id= $typeResult1[type_id] limit 1");
					while($typeResult2 = mysql_fetch_array($queryResult2)) {
						$Reminder.="It's time to pay the overdue amount on your $typeResult2[Type] <br/>";
					}
				}
				if($Reminder!='') {
					echo "<font color=\"red\"><b>$Reminder</b></font>";
				}
				?>				
				</form>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="7" align="center"><font color="red"><b id="ErrorMessage"><input type="image" src="../images/loader.gif" /><input type="image" src="../images/ajax-loader.gif" /><input type="image" src="../images/loader.gif" /></b></font></td>
		</tr>
		<tr>
			<td align="right" width="150">Spender</td>
			<td width="60"><input type="image" src="../images/delete.jpg" name="DeleteSpender" value="Delete Spender" width="55px" onclick="if(document.getElementById('spender_id').value) {RemoveSpender();}" style="position:relative;top:5px;"></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddSpender" value="Add Spender" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Spender Name',1);">	</td>
			<td align="left">
			<select name="spender_id" id="spender_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(6);">
			<?php
				foreach($optionSpender as $spender_id3=>$name) {
					echo "<option value='$spender_id3'>$name</option>";
				}
			?>
			</select>
			</td>
			<td align="right">Category</td>
			<td width="60"><input type="image" src="../images/add.png" name="AddCategory" value="Add Category" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Category',2);">	</td>
			<td align="left">
			<select name="category_id" id="category_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(3);">
			<?php
				foreach ($optionCategory as $category_id3 => $category2) {
					echo "<option value='$category_id3'"; if($category_id3==7) echo "selected"; echo ">$category2</option>";
				}
			?>
			</select>
			</td>		
		</tr>
		<tr id="item_comment">
			<td align="right">Description</td>
			<td width="60"></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddItem" value="Add Item" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Description',3);">	</td>
			<td align="left">
			<select name="item_id" id="item_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(6);">
			<?php
				foreach ($optionItem as $item_id2 => $category_item2) {
					echo "<option value='$item_id2'"; if($item_id2==7) echo "selected"; echo ">$category_item2</option>";
				}
			?>
			</select>
			</td>
			<td align="right" colspan="2">Comment</td>
			<td align="left">
			<input type="text" name="comment_id" id="comment_id" value="" style="font-size:25px;width:245px;border-color:#5050FF;border-width: 3px;">
			</td>			
		</tr>
		<tr>
			<td align="right">Payment Type</td>
			<td width="60"></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddType" value="Add Type" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Payment Type',5);">	</td>
			<td align="left">
			<select name="type_id" id="type_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(7);">
			<?php
				foreach($optionType as $id=>$type) {
					echo "<option value='$id'>$type</option>";
				}
			?>
			</select>	
			</td>			
			<td align="right">Amount: $</td>
			<td width="60"><input type="image" src="../images/backward.jpg" name="backward" value="delet backward" width="50px"  onClick="document.getElementById('amount').value=document.getElementById('amount').value.substr(0,document.getElementById('amount').value.length-1);">	</td>
			<td align="left">
			<input type="text" name="amount" id="amount" maxlength="10" onkeyup="ForceNumericInput(this,true);" style="font-size:25px;width:245px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">How to Pay?</td>
			<td width="60"><!--<input type="image" src="../images/add.png" name="AddRecorder" value="Add Recorder" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Frequency of Recording',6);">-->	</td>
			<td align="left">
			<select name="frequency_id" id="frequency_id" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="DispDate();">
			<?php
				foreach($optionfrequency as $id=>$frequency) {
					echo "<option value='$id'>$frequency</option>";
				}
			?>
			</select>
			</td>
			<td align="right">
				<font  id="Date_label" style="display:none;">Starting Date</font>
			</td>
			<td align="right">
				<input type="image" src="../images/calendar.jpg" name="calender" id="calender" width="50px" style="display:none;" value="calender" onClick="GetDate(document.getElementById('start_date'));">
			</td>
			<td align="left">
			<input type="text" name="start_date" id="start_date" maxlength="10" style="font-size:25px;width:240px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;display:none;">
			</td>
		</tr>
	</table>
	<div id="Result">
	<table width="100%" style="font-size:25px;">
		<tr id="bank_balance">
			<td align="right" width="210" colspan="2"><font id="bank_desc">Will Pay From</font></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddBank" value="Add Bank" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Bank',7);">	</td>
			<td align="left">
			<select name="bank_id" id="bank_id" style="font-size:25px;width:200px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(5);">
			<?php
				foreach($optionBank as $id=>$bank) {
					echo "<option value='$id'>$bank</option>";
				}
			?>
			</select>
			<font id="balance" style="font-size:25px;width:50px;border-color:#5050FF;border-width: 3px;"></font>
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
			<select name="to_bank" id="to_bank" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;display:none;">
			<?php
				foreach($optionBank as $id=>$bank) {
					echo "<option value='$id'>$bank</option>";
				}
			?>
			</select>			
			</td>		
		</tr>		
		<tr>
			<td align="right" width="150">Information</td>
			<td width="60"><input type="image" src="../images/delete.jpg" name="DeleteAutoRec" value="Delete Auto Recording" width="55px" onclick="if(document.getElementById('item_frequency_id').value) {RemovePayFrq();}" style="position:relative;top:5px;"></td>
			<td width="60"><input type="image" src="../images/modify.png" name="AddAutoRec" value="Modify Auto Recording" width="50px"  onclick="if(document.getElementById('item_frequency_id').value) {SetVisibleDiv('none');	var field1 = document.getElementById('item_frequency_id');var index1 = field1.selectedIndex; var infor = field1.options[index1].text;SetDialog(infor,8);}">	</td>
			<td align="left" colspan="4">
			<select name="item_frequency_id" id="item_frequency_id" class="wide" style="font-size:20px;border-color:#5050FF;border-width: 3px;">
			<?php
				if(isset($optionPayFrq)) {
					foreach($optionPayFrq as $id=>$disp) {
						echo "<option value='$id'>$disp</option>";
					}
				}
			?>
			</select>
			</td>
		</tr>
	</table>
	<font style='font-size:25px;'>Income:</font>
	<select name='MonthlyIncome' id='MonthlyIncome' style='font-size:25px;border-color:#5050FF;border-style: solid;border-width: 3px;' onChange="document.getElementById('MonthlyExpenese').value = this.value;Action('Disp');">
	<?php echo $Income ?>
	</select>
	<font style='font-size:25px;'>Expenese:</font>
	<select name='MonthlyExpenese' id='MonthlyExpenese' style='font-size:25px;border-color:#5050FF;border-style: solid;border-width: 3px;' onChange="document.getElementById('MonthlyIncome').value = this.value;Action('Disp');">
	<?php echo $Expenese ?>
	</select>
	<font style='font-size:25px;'>Year:</font>
	<select name='Yearly' id='Yearly' style='font-size:25px;border-color:#5050FF;border-style: solid;border-width: 3px;' onChange="Action('yearly');">
	<?php
	$year = date('Y');	
	for($i=2011;$i<2111;$i++) {
		if($i==$year) echo "<option value='$i' selected='selected'>$i</option>";
		else echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
		<table width="100%"  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
			<tr>
			<th style="font-size:25px;color:red;border-style: none;border-color:#0000ff;border-width: 3px;text-align:left;">
			<?php echo date('l jS \of F Y') ?>
			</th>	
			<th colspan="2" style="font-size:25px;color:red;border-style: none;border-color:#0000ff;border-width: 3px;text-align:left;" id="infor_title">
			Monthly Expenses information
			</th>	
			</tr>		
			<tr>
			<th style="font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;">
			Category
			</th>	
			<th style="font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;">
			Detail
			</th>
			<th style="font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;">
			Total
			</th>	
			</tr>
			<?php	
			foreach($categoryTotal as $category_id4=>$total){
				if($total >0 && $category_id4 != 1) {
				echo"
				<tr>
				<td style='font-size:25px;border-style: solid;border-color:#5050FF;border-width: 3px;text-align:center;'>
				$optionCategory[$category_id4]
				</td>
				<td>
					<table width='100%' border='1'>";
					$Item_list = $itemTotal["$category_id4"];
					foreach($Item_list as $item_id3=>$Subtotal){
						$ItemResult4=mysql_query("SELECT * FROM `category_item` where category_id = $category_id4 and id = $item_id3 and (user_id = $GV_id or user_id = 0) limit 1");          // query executed 
						echo mysql_error();              // if any error is there that will be printed to the screen 
						while($option4 = mysql_fetch_array($ItemResult4)) {
							$category_item3 = $option4['category_item'];
						}	
					echo "
					<tr>	
					<td  style='font-size:25px;border-color:#5050FF;border-width: 3px;color:blue;'>
					$category_item3
					</td>
					<td  style='font-size:25px;border-color:#5050FF;border-width: 3px;color:blue;text-align:right;'>
					$Subtotal
					</td>
					</tr>";
						}
					echo "
					</table>
				</td>
				<td style='font-size:25px;border-style: solid;border-color:#5050FF;border-width: 3px;text-align:center;'>
				$total
				</td>
				</tr>";
				}
			}	
			?>
		</table>	
		<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
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
			Amt
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Type
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Who
			</th>
			<th style='font-size:25px;border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
			Com.
			</th>
			</tr>
			<?php
			//$e = new endec();  
			while($nt=mysql_fetch_array($RangResult)){
				$type=substr($optionType[$nt['type_id']],0,4);
				$bankname=substr($optionBank[$nt['bank_id']],0,4);
				$expenses3 = $e->new_decode("$nt[expenses]");
				$category3 = $optionCategory[$nt['category_id']];
				$ItemResult5=mysql_query("SELECT * FROM `category_item` where category_id = $nt[category_id] and id = $nt[item_id] and (user_id = $GV_id or user_id = 0) limit 1");          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				while($option5 = mysql_fetch_array($ItemResult5)) {
					$category_item4 = $option5['category_item'];
				}	
				
			//	$category_item4 = $optionItem[$nt['item_id']];
				$queryComment = mysql_query("SELECT * FROM `sp_comment` where id = $nt[comment_id] limit 1");
				echo mysql_error(); 
				$comment = '';
				while($GetComment = mysql_fetch_array($queryComment)) {
				$comment = $GetComment['comment'];
				}	
				$querySpender = mysql_query("SELECT * FROM `spender` where id = $nt[spender_id] limit 1");
				echo mysql_error(); 
				while($GetSpender = mysql_fetch_array($querySpender)) {
				$name = $GetSpender['name'];
				}	
			echo "
			<tr>
				<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>";
				echo @substr($nt[date],-5);
			echo "	
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$category3
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$category_item4
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$expenses3
				</td>
				<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$type
				</td>
				<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$bankname
				</td>
				<td  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$name
				</td>
				<td align='right'  style='font-size:25px;border-style: solid;border-width: 3px;text-align:right;'>
				$comment
				</td>
			</tr>
			";
			}
			?>
		</table>
	</div>
</div>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>	
</body>
</html>
<script src="../scripts/jquery.js"></script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript">
var user_id = "<?php echo $GV_id; ?>";
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}
var CallID = 0;
function setamount(number) {
	document.getElementById('amount').value = document.getElementById('amount').value + '' + number;
	var allTags = document.getElementsByClassName("reminder_amount");

	for (var i=0; i<allTags.length; i++) {
		document.getElementsByClassName("reminder_amount")[i].value = document.getElementById('amount').value; 
	}	
}
function RemoveSpender() {
	var select_field = document.getElementById('spender_id');
	var select_index = select_field.selectedIndex;
	var text = select_field.options[select_index].text;
	var value = document.getElementById('spender_id').value;
	var ans=confirm('You will lose information for ' + text.toUpperCase() + ' and might lead to incorect data!\nAre you sure you want to remove ' + text.toUpperCase() + ' from the spender list?');
	var url = '../search/RemoveSpender.php?user_id=<?php echo $GV_id; ?>&spender_id='+value;
	if(ans) {
		$(document).ready(function() {
		   $("#spender_id").load(url);
		   $.ajaxSetup({ cache: false });
		});		
	} 
}
function RemovePayFrq() {
	var field1 = document.getElementById('item_frequency_id');
	var index1 = field1.selectedIndex; 
	var infor = field1.options[index1].text;
	var item_frequency_id = document.getElementById('item_frequency_id').value;
	var ans=confirm( 'You are going to remove this record:'+infor+'\nFrom the system. Are you sure want to do this?');
	url = "../search/ModifyFrequency.php?user_id=<?php echo $GV_id; ?>&item_frequency_id="+item_frequency_id+"&delete=1&pin=<?php echo $GV_pin; ?>";
	if(ans) {	
		$(document).ready(function() {
		   $('#item_frequency_id').load(url);
		   $.ajaxSetup({ cache: false });
		});
	}	
}
function SetDialog(text,infor_id) {
	document.getElementById('AddDialog').style.display='block';
	document.getElementById('dialog_text').innerHTML = text;
	CallID = infor_id;
	if(CallID == 7 || CallID == 8) {
		if(CallID == 7) 
		{ 
			var field1 = document.getElementById('bank_id');
			var index1 = field1.selectedIndex; 
			var infor = field1.options[index1].text;			
			document.getElementById('input_text').style.display='block';
			document.getElementById('adj_title').innerHTML='Balance Ajustment';
			document.getElementById('input_text').value =infor;
			document.getElementById('input_amount').value =parseFloat(document.getElementById('balance').innerHTML.substring(3));
		}
		if(CallID == 8) 
		{
			document.getElementById('input_text').style.display='none';
			document.getElementById('adj_title').innerHTML='Change Amount to';
		}
		document.getElementById('adjustment').style.display='block';
	}
	else  {
		document.getElementById('input_text').style.display='block';
		document.getElementById('adjustment').style.display='none';
	}
}
function AddInfor(action_id) {
	document.getElementById('main').disabled = false;
	document.getElementById('AddDialog').style.display='none';
	var text = document.getElementById('input_text').value;
	var category_id = document.getElementById('category_id').value;
	var item_id = document.getElementById('item_id').value;
	var spender_id = document.getElementById('spender_id').value;
	var adjustment = document.getElementById('input_amount').value;
	var item_frequency_id = document.getElementById('item_frequency_id').value;
	var id = '#spender_id';
	
	if(action_id != 0) {
		text = encodeURIComponent(text);
		if(CallID == 1) {
		id = '#spender_id';
		url = '../search/AddSpender.php?user_id=<?php echo $GV_id; ?>&name='+text;
		}
		else if(CallID == 2) {
		id = '#category_id';
		url = '../search/AddCategory.php?user_id=<?php echo $GV_id; ?>&category='+text;
		}
		else if(CallID == 3) {
			id = '#item_id';
			url = '../search/AddItem.php?user_id=<?php echo $GV_id; ?>&category_id='+category_id+'&category_item='+text;
		}
		else if(CallID == 4) {
			id = '#comment_id';
			url = '../search/AddComment.php?comment='+text+'&category_id='+category_id+'&item_id='+item_id;
		}
		else if(CallID == 5) {
			id = '#type_id';
			url = '../search/AddType.php?user_id=<?php echo $GV_id; ?>&Type='+text;
		}
		else if(CallID == 6) {
			id = '#frequency_id';
			url = '../search/AddFrequency.php?user_id=<?php echo $GV_id; ?>&frequency='+text;
		}
		else if(CallID == 7) {
			id = '#bank_id';
			url = "../search/AddBank.php?user_id=<?php echo $GV_id; ?>&spender_id="+spender_id+"&bank="+text+"&adjustment="+adjustment+'&pin=<?php echo $GV_pin; ?>';
		}
		else if(CallID == 8) {
			id = '#item_frequency_id';
			url = "../search/ModifyFrequency.php?user_id=<?php echo $GV_id; ?>&item_frequency_id="+item_frequency_id+"&amount="+adjustment+"&delete=0&pin=<?php echo $GV_pin; ?>";
		}		
		$(document).ready(function() {
		   $(id).load(url);
		   $.ajaxSetup({ cache: false });
		});			
	}
}
function SetDisp(AffectID) {
	var category_id = document.getElementById('category_id').value;
	var item_id = document.getElementById('item_id').value;
	var spender_id = document.getElementById('spender_id').value;
	var bank_id = document.getElementById('bank_id').value;
	var type_id = document.getElementById('type_id').value;
	if(category_id == 1) {
		if(item_id == 77){
			document.getElementById('bank_desc').innerHTML='From';
			document.getElementById('to_bank_label').style.display='block';
			document.getElementById('to_bank').style.display='block';
		}
		else {
			document.getElementById('bank_desc').innerHTML='TO';
			document.getElementById('to_bank_label').style.display='none';
			document.getElementById('to_bank').style.display='none';
		}	
	}
	else {
		document.getElementById('bank_desc').innerHTML='Will Pay From';
		document.getElementById('to_bank_label').style.display='none';
		document.getElementById('to_bank').style.display='none';
	}

	
	if(AffectID == 3) {
		id = '#item_comment';
		url = '../search/ItemComment.php?user_id=<?php echo $GV_id; ?>&category_id='+category_id+'&item_id='+item_id;
	}
	else if(AffectID == 4) {
		id = '#comment_id';
		url = '../search/AddComment.php?category_id='+category_id+'&item_id='+item_id;
	}
	else if(AffectID == 5) {
		id = '#balance';
		url = '../search/GetBalance.php?pin=<?php echo $GV_pin; ?>&bank_id='+bank_id;
	}
	else if(AffectID == 6) {
		id = '#bank_balance';
		url = '../search/GetBank.php?user_id=<?php echo $GV_id; ?>&pin=<?php echo $GV_pin; ?>&category_id='+category_id+'&item_id='+item_id+'&bank_id='+bank_id+'&spender_id='+spender_id;
	}
	else if(AffectID == 7) {
		id = '#bank_balance';
		url = '../search/GetBank.php?user_id=<?php echo $GV_id; ?>&pin=<?php echo $GV_pin; ?>&category_id='+category_id+'&item_id='+item_id+'&type_id='+type_id+'&bank_id='+bank_id+'&spender_id='+spender_id;
	}
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});			
}
function SetRminder() {
	var reminder = document.getElementById("reminder").value;
	var spender_id = document.getElementById("spender_id").value;
	var category_id = document.getElementById("category_id").value;
	var item_id = document.getElementById("item_id").value;
	var frequency_id = document.getElementById("frequency_id").value;
	var amount = document.getElementById("amount").value;
	var type_id = document.getElementById("type_id").value;
	var bank_id = document.getElementById("bank_id").value;
	if(document.getElementById("to_bank").style.display=="none") var to_bank = 0;
	else var to_bank = document.getElementById("to_bank").value;
	var pin="<?php echo $GV_pin; ?>";

	if(reminder!=1) {
		var answer = confirm("Are you sure?")
		if(answer) {
			$.ajax({ 
			   type: "POST", 
			   url: "SetReminder.php",
			   data: "pin="+pin+"&user_id="+user_id+"&spender_id="+spender_id+"&category_id="+category_id+"&item_id="+item_id+"&frequency_id="+frequency_id+"&amount="+amount+"&type_id="+type_id+"&bank_id="+bank_id+"&to_bank="+to_bank+"&reminder="+reminder, 
			   success: function(msg){ 
				 alert(msg ); //Anything you want 
			   }, 
				error:function (xhr, ajaxOptions, thrownError){ 
							alert(xhr.status + " " + thrownError); 
				}     	   
			 }); 
		 }
	 }
}
function SetVisibleDiv(disp) {
document.getElementById("main").style.display = disp;
}
function EnDisableDiv() {
 toggleDisabled(document.getElementById("main"));
}
function toggleDisabled(el) {
	 try {
	 el.disabled = !el.disabled;
	 }
	 catch(E){
	 }
	 if (el.childNodes && el.childNodes.length > 0) {
		 for (var x = 0; x < el.childNodes.length; x++) {
		 toggleDisabled(el.childNodes[x]);
		 }
	 }
 }
function DispDate() {
	var id = document.getElementById('frequency_id').value;
	var mydate= new Date();
	if(id == 1) {
		document.getElementById('Date_label').style.display='none';
		document.getElementById('start_date').style.display='none';
		document.getElementById('calender').style.display='none';
		document.getElementById('start_date').value = '';
	}
	else {
		document.getElementById('Date_label').style.display='block';
		document.getElementById('start_date').style.display='block';
		document.getElementById('calender').style.display='block';
		document.getElementById('start_date').value = ("0" + (mydate.getMonth() + 1)).slice(-2)+"/"+("0" + mydate.getDate()).slice(-2)+"/"+mydate.getFullYear();
	}
} 


function BankingDetail() {
	var bank_id = document.getElementById('bank_id').value;
	window.open('BankingDetail.php?bank_id='+bank_id,target='_top');	
}




function Action(action) {
	if(document.getElementById('start_date').style.display=='block') {
		var date = Date.parse(document.getElementById('start_date').value);
		var theDate = new Date(date); 
		var today = new Date();
		var checkdate1 = (today.getMonth()+1)+"/"+today.getDate() +"/"+today.getFullYear();
		var checkdate2 = Date.parse(checkdate1);
		var checkdate = new Date(checkdate2);
		var difference = theDate - checkdate;
		var days = Math.round(difference/(1000*60*60*24));	
		if(days < 0) {
			alert("Starting date must not in the pass");
			return false;
		}
	}
	var amount = document.getElementById('amount').value;
	if(amount != 0 || action != 'Save') {
		 var category_id = document.getElementById('category_id').value;
		 var item_id = document.getElementById('item_id').value;
		 var comment_id = document.getElementById('comment_id').value;
		 var spender_id = document.getElementById('spender_id').value;
		 var type_id = document.getElementById('type_id').value;
		 var bank_id = document.getElementById('bank_id').value;
		 var to_bank = document.getElementById('to_bank').value;
		 var frequency_id = document.getElementById('frequency_id').value;
		 var start_date = encodeURIComponent(document.getElementById('start_date').value);
		 var year_month = document.getElementById('MonthlyExpenese').value;
		 var yearly = document.getElementById('Yearly').value;
		 if(action == 'Save' && bank_id == 0) document.getElementById('ErrorMessage').innerHTML = 'Please choice the Pay From option';
		 else {
		 document.getElementById('ErrorMessage').innerHTML = '';
		 if(action=='Account') var url ="CreditPayOff.php?pin=<?php echo $GV_pin; ?>&user_id="+user_id+"&category_id="+category_id+"&item_id="+item_id+"&comment_id="+comment_id+"&amount="+amount+"&spender_id="+spender_id+"&type_id="+type_id+"&frequency_id="+frequency_id+"&start_date="+start_date+"&bank_id="+bank_id+"&to_bank="+to_bank+"&year_month="+year_month+"&action="+action+"&yearly="+yearly;
		 else 
		 var url ="HERDisp.php?pin=<?php echo $GV_pin; ?>&user_id="+user_id+"&category_id="+category_id+"&item_id="+item_id+"&comment_id="+comment_id+"&amount="+amount+"&spender_id="+spender_id+"&type_id="+type_id+"&frequency_id="+frequency_id+"&start_date="+start_date+"&bank_id="+bank_id+"&to_bank="+to_bank+"&year_month="+year_month+"&action="+action+"&yearly="+yearly;
			$(document).ready(function() {
			   $("#Result").load(url);
			   $.ajaxSetup({ cache: false });
			});
			document.getElementById('amount').value = "";
			document.getElementById('type_id').value = "1";
		}
	}
	else document.getElementById('ErrorMessage').innerHTML = 'Please enter the amount!';
}
  
/**************************************************************************************
  htmlDatePicker v0.1
  
  Copyright (c) 2005, Jason Powell
  All Rights Reserved

  Redistribution and use in source and binary forms, with or without modification, are 
    permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of 
      conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list 
      of conditions and the following disclaimer in the documentation and/or other materials 
      provided with the distribution.
    * Neither the name of the product nor the names of its contributors may be used to 
      endorse or promote products derived from this software without specific prior 
      written permission.

  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
  OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF 
  MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL 
  THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, 
  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
  AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
  OF THE POSSIBILITY OF SUCH DAMAGE.
  
  -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

  
***************************************************************************************/
// User Changeable Vars
var HighlightToday  = true;    // use true or false to have the current day highlighted
var DisablePast    = false;    // use true or false to allow past dates to be selectable
// The month names in your native language can be substituted below
var MonthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

// Global Vars
var now = new Date();
var dest = null;
var ny = now.getFullYear(); // Today's Date
var nm = now.getMonth();
var nd = now.getDate();
var sy = 0; // currently Selected date
var sm = 0;
var sd = 0;
var y = now.getFullYear(); // Working Date
var m = now.getMonth();
var d = now.getDate();
var l = 0;
var t = 0;
var MonthLengths = new Array(31,28,31,30,31,30,31,31,30,31,30,31);

/*
  Function: GetDate(control)

  Arguments:
    control = ID of destination control
*/
function GetDate() {
  EnsureCalendarExists();
  DestroyCalendar();
  // One arguments is required, the rest are optional
  // First arguments must be the ID of the destination control
  if(arguments[0] == null || arguments[0] == "") {
    // arguments not defined, so display error and quit
    alert("ERROR: Destination control required in funciton call GetDate()");
    return;
  } else {
    // copy argument
    dest = arguments[0];
  }
  y = now.getFullYear();
  m = now.getMonth();
  d = now.getDate();
  sm = 0;
  sd = 0;
  sy = 0;
  var cdval = dest.value;
  if(/\d{1,2}.\d{1,2}.\d{4}/.test(dest.value)) {
    // element contains a date, so set the shown date
    var vParts = cdval.split("/"); // assume mm/dd/yyyy
    sm = vParts[0] - 1;
    sd = vParts[1];
    sy = vParts[2];
    m=sm;
    d=sd;
    y=sy;
  }
  
//  l = dest.offsetLeft; // + dest.offsetWidth;
//  t = dest.offsetTop - 125;   // Calendar is displayed 125 pixels above the destination element
//  if(t<0) { t=0; }      // or (somewhat) over top of it. ;)

  /* Calendar is displayed 125 pixels above the destination element
  or (somewhat) over top of it. ;)*/
  l = dest.offsetLeft + dest.offsetParent.offsetLeft;
  t = dest.offsetTop - 125;
  if(t < 0) t = 0; // >
  DrawCalendar();
}

/*
  function DestoryCalendar()
  
  Purpose: Destory any already drawn calendar so a new one can be drawn
*/
function DestroyCalendar() {
  var cal = document.getElementById("dpCalendar");
  if(cal != null) {
    cal.innerHTML = null;
    cal.style.display = "none";
  }
  return
}

function DrawCalendar() {
  DestroyCalendar();
  cal = document.getElementById("dpCalendar");
  cal.style.left = l + "px";
  cal.style.top = t + "px";
  
  var sCal = "<table><tr><td class=\"cellButton\"><a href=\"javascript: PrevMonth();\" title=\"Previous Month\">&lt;&lt;</a></td>"+
    "<td class=\"cellMonth\" width=\"80%\" colspan=\"5\">"+MonthNames[m]+" "+y+"</td>"+
    "<td class=\"cellButton\"><a href=\"javascript: NextMonth();\" title=\"Next Month\">&gt;&gt;</a></td></tr>"+
    "<tr><td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td></tr>";
  var wDay = 1;
  var wDate = new Date(y,m,wDay);
  if(isLeapYear(wDate)) {
    MonthLengths[1] = 29;
  } else {
    MonthLengths[1] = 28;
  }
  var dayclass = "";
  var isToday = false;
  for(var r=1; r<7; r++) {
    sCal = sCal + "<tr>";
    for(var c=0; c<7; c++) {
      var wDate = new Date(y,m,wDay);
      if(wDate.getDay() == c && wDay<=MonthLengths[m]) {
        if(wDate.getDate()==sd && wDate.getMonth()==sm && wDate.getFullYear()==sy) {
          dayclass = "cellSelected";
          isToday = true;  // only matters if the selected day IS today, otherwise ignored.
        } else if(wDate.getDate()==nd && wDate.getMonth()==nm && wDate.getFullYear()==ny && HighlightToday) {
          dayclass = "cellToday";
          isToday = true;
        } else {
          dayclass = "cellDay";
          isToday = false;
        }
        if(((now > wDate) && !DisablePast) || (now <= wDate) || isToday) { // >
          // user wants past dates selectable
          sCal = sCal + "<td class=\""+dayclass+"\"><a href=\"javascript: ReturnDay("+wDay+");\">"+wDay+"</a></td>";
        } else {
          // user wants past dates to be read only
          sCal = sCal + "<td class=\""+dayclass+"\">"+wDay+"</td>";
        }
        wDay++;
      } else {
        sCal = sCal + "<td class=\"unused\"></td>";
      }
    }
    sCal = sCal + "</tr>";
  }
  sCal = sCal + "<tr><td colspan=\"4\" class=\"unused\"></td><td colspan=\"3\" class=\"cellCancel\"><a href=\"javascript: DestroyCalendar();\">Cancel</a></td></tr></table>"
  cal.innerHTML = sCal; // works in FireFox, opera
  cal.style.display = "inline";
}

function PrevMonth() {
  m--;
  if(m==-1) {
    m = 11;
    y--;
  }
  DrawCalendar();
}

function NextMonth() {
  m++;
  if(m==12) {
    m = 0;
    y++;
  }
  DrawCalendar();
}

function ReturnDay(day) {
  cDest = document.getElementById(dest);
  if((m+1) <10)  Month = 0+''+(m+1);  else  Month = (m+1)+'';
  if((day) <10)  Day = 0+''+(day);  else  Day = (day)+'';
  dest.value = Month+"/"+Day+"/"+y;
  DestroyCalendar();
}

function EnsureCalendarExists() {
  if(document.getElementById("dpCalendar") == null) {
    var eCalendar = document.createElement("div");
    eCalendar.setAttribute("id", "dpCalendar");
    document.body.appendChild(eCalendar);
  }
}
function assign_value(v) {
	document.getElementById('reminder_id').value=v;
	document.form.ReminderDel.submit();
}
function make_payment(reminder_id,amount_id) {
	var pin="<?php echo $GV_pin; ?>";
	var amount=document.getElementById(amount_id).value;
	var url = "MakePayment.php?user_id="+user_id+"&reminder_id="+reminder_id+"&pin="+pin+"&amount="+amount;
	var answer = confirm("$"+amount+" will inserted\nAre you sure the amount is correct?")
	focus_id = amount_id;
	if (answer){
		$(document).ready(function() {
		   $("#reminder_list").load(url);
		   $.ajaxSetup({ cache: false });
		});	
		Action('Disp');
	}
	else {
		document.getElementById(reminder_id).checked=false;
		document.getElementById(amount_id).focus();
		document.getElementById(amount_id).select();
		document.getElementById(amount_id).value='';
		document.getElementById('amount').value = '';
	}
}
function isLeapYear(dTest) {
  var y = dTest.getYear();
  var bReturn = false;
  
  if(y % 4 == 0) {
    if(y % 100 != 0) {
      bReturn = true;
    } else {
      if (y % 400 == 0) {
        bReturn = true;
      }
    }
  }
  
  return bReturn;
}  
document.getElementById('ErrorMessage').innerHTML = "";
</script>
