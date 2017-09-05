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
$BankResult=mysql_query("SELECT * FROM `sp_bank` where user_id = $GV_id");          // query executed 
$bank_id = 0;
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option7 = mysql_fetch_array($BankResult)) {
	if($bank_id == 0) $bank_id = $option7['id'];
	$optionBank["$option7[id]"] = $option7['bank'];
	if($option7['balance'] == '') $balance = 0; else $balance = $e->new_decode("$option7[balance]");
	$optionBalance["$option7[id]"] = $balance;
}
$todate = date('Ymd')."000000";
$newdate = strtotime ( "-3 month" , strtotime ( $todate ) ) ;
$fmdate = date ( 'Ymd' , $newdate )."000000";
$queryResult=mysql_query("SELECT * FROM spending where user_id=$GV_id and  date between $fmdate and $todate and bank_id = $bank_id and paid <> 4 and paid <> 1 order by paid desc,type_id, date desc,id");
echo mysql_error();              // if any error is there that will be printed to the screen 
$CategoryResult=mysql_query("SELECT * FROM `spending_category` where user_id = $GV_id or user_id = 0 order by category");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option1 = mysql_fetch_array($CategoryResult)) {
	$optionCategory["$option1[id]"] = $option1['category'];
}
$TypeResult=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $GV_id or user_id = 0)");          // query executed 
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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Credit Card Pay Off</title>
<style type="text/css"> 
input.wide {display:block; width: 99%} 

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

<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript">
var total=0;
function Action(this_id,amount,add) {
	for( i = 0; i < document.myform.paid_status.length; i++ ) {
	 if( document.myform.paid_status[i].checked == true )
	 var paid_status = document.myform.paid_status[i].value;
	}
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
	if(this_id==0) action = "display"; else  action = "update";
	var bank_id = document.getElementById('bank_id').value;
	var url ="ModifyPaidStatus.php?pin=<?php echo $GV_pin; ?>&user_id="+user_id+"&id="+this_id+"&amount="+amount+"&paid="+paid+"&bank_id="+bank_id+"&action="+action+"&paid_status="+paid_status;
	$(document).ready(function() {
	   $("#Result").load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function Action_Final() {
	for( i = 0; i < document.myform.paid_status.length; i++ ) {
	 if( document.myform.paid_status[i].checked == true )
	 var paid_status = document.myform.paid_status[i].value;
	}
	var paid_date = encodeURIComponent(document.getElementById('paid_date').value);
	var infor = document.getElementById('paid_date').value;
	var bank_id = document.getElementById('bank_id').value;
	var url ="ModifyPaidStatus.php?pin=<?php echo $GV_pin; ?>&user_id="+user_id+"&paid=1&paid_date="+paid_date+"&bank_id="+bank_id+"&paid_status="+paid_status;
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
<center>
<?php include("../PHP/Header.php"); ?>
</center>
<div id='BlankMsg' style="display:none;"></div>
<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
		<td valign="bottom" style='font-size:40px;border-style: solid;border-width: 3px;text-align:center;'>
			<font  id="Date_label">Total </font><b><font  id="total" color="red">$0</font></b> will paid from
			<select name="bank_id" id="bank_id" style="font-size:30px;width:300px;border-color:#5050FF;border-width: 3px;" onChange="Action(0,0,false);">
			<?php
				foreach($optionBank as $id=>$bank) {
					echo "<option value='$id'>$bank</option>";
				}
			?>
			</select>
			</font>
		</td>
	</tr>
	<tr>
			<td valign="bottom" style='font-size:40px;border-style: solid;border-width: 3px;text-align:center;'>
				at date: <input type="text" name="paid_date" id="paid_date" maxlength="10" size="10" style='font-size:40px;border-style: solid;border-color:#ff0000;border-width: 3px;text-align:right;'>
				<input type="image" src="../images/calendar.jpg" name="calender" id="calender" width="60" value="calender" onClick="GetDate(document.getElementById('paid_date'));" style='position:relative;top:10px;'>
				<input type="image" src="../images/click-here.gif" name="Save" value="Save" width="60" onclick="Action_Final();" style='position:relative;top:10px;'>
				<b><font color="red" style='position:relative;top:-10px;'><=Confirm</font></b>
			</td>
	</tr>
</table>
<table name="mytable" width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;" id="Result">
	<tr>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Spender</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Type</p>
	</th>
    <th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Date</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Description</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Amount</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Balance</p>
	</th>
	<th style='font-size:15px;width:100px;border-color:#5050FF;border-style: solid;border-width: 3px;text-align:left;'>
	<form name="myform">
	<input type="radio" name="paid_status" value="All" onClick="Action(0,0,false);">All<br/>
	<input type="radio" name="paid_status" value="Unpaid" checked="checked"  onClick="Action(0,0,false);">Unpaid<br/>
	<input type="radio" name="paid_status" value="Paid" onClick="Action(0,0,false);">Paid<br/>
	<input type="radio" name="paid_status" value="Future" onClick="Action(0,0,false);">Paid Future
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
echo"</td>
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
	else {
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
</table>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>	
<script type="text/javascript">
DispDate();
total = <?php echo $paid_amount; ?>;
document.getElementById('total').innerHTML = "$"+total;
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
</script>
</body>
</html>
	