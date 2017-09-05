<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
if(isset($_POST['Save_x']))
{
	$category_id =  (int)mysql_real_escape_string($_POST['category_id']);
	$item_id =  (int)mysql_real_escape_string($_POST['item_id']);
	$frequency =  (int)mysql_real_escape_string($_POST['frequency']);
	$amount =  floatval(mysql_real_escape_string($_POST['amount']));
	$start_date = mysql_real_escape_string($_POST['start_date']);
	$fmmonth = substr($start_date,0,2);
	$fmday = substr($start_date,3,2);
	$fmyear = substr($start_date,6,4);
	$start_date=$fmyear.$fmmonth.$fmday."000000";
	
//	echo "$category_id $item_id $frequency $amount $start_date ";
	$SaveCheck1 = "SELECT * FROM item_frequency WHERE user_id = $GV_id and item_id = $item_id LIMIT 1";
	$result1 = mysql_query($SaveCheck1);
	if (mysql_num_rows($result1) > 0){
			$ErrorMessage = "** Duplication record **";
	}
	ELSE {
		mysql_query("INSERT INTO item_frequency(user_id,item_id,frequency,amount,start_date) VALUES($GV_id,$item_id,$frequency,$amount,$start_date)");
		Header("Location: {$_SERVER['REQUEST_URI']}");
		die;
    }	
}
$query="SELECT * FROM item_frequency where user_id = $GV_id order by user_id, item_id";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$GetCategory="SELECT * FROM spending_category where 1 order by category";  // query string stored in a variable
$CategoryResult=mysql_query($GetCategory);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$frequency[0] = "None";
$frequency[1] = "Daily";
$frequency[2] = "Weekly";
$frequency[3] = "Bi-Weekly";
$frequency[4] = "Monthly";
$frequency[5] = "Quarterly";
$frequency[6] = "Semi-Annually";
$frequency[7] = "Yearly";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Adding item_frequency of My spending</title>
<style type="text/css"> 
input.wide {display:block; width: 100%} 
</style>
 <script type="text/javascript">
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}
function FieldCtrl(Ctrl) {
	if(Ctrl == 0){ 
	document.getElementById('start_date').disabled=true; 
	document.getElementById('calender').disabled=true;
	document.getElementById('amount').disabled=true;
	document.getElementById('save').disabled=true;
	} 
	else { 
	document.getElementById('start_date').disabled=false;
	document.getElementById('calender').disabled=false;
	document.getElementById('amount').disabled=false;
	document.getElementById('save').disabled=false;
	}
}
 </script> 
   <script language="JavaScript" type="text/javascript">
  
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
  <style type="text/css">
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
  font-size: 40px;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  width: 450px;
}
/* The table of the Calendar */
#dpCalendar table {
  border: 1px solid black;
  background-color: #eeeeee;
  color: black;
  font-size: 40px;
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
input.wide {display:block; width: 99%} 
</style>
<script type="text/javascript" src="../scripts/ajaxload.js"></script>
</head>
<body style="font-size:40px;">
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
	<table width="100%">
		<tr>
		<th>
		<p style="font-size:40px;">Category</p>
		</th>		
		<th>
		<p style="font-size:40px;">Category Item</p>
		</th>		
		<th>
		<p style="font-size:40px;">Frequency</p>
		</th>		
		<th>
		<p style="font-size:40px;">Amount</p>
		</th>		
		</tr>
		<tr>
			<td align="right">
			<select name="category_id" id="category_id" class="reqd"  style="font-size:40px;border-color:#ff0000;border-width: 7px;" onChange="SendRequest ('../search/CategoryItem.php?category_id='+this.value,'item_id');">
			<?php while($Category=mysql_fetch_array($CategoryResult)){
					$CategoryResult3=mysql_query("SELECT * FROM category_item where category_id = $Category[id] order by id limit 1");          // query executed 
					echo mysql_error();
					while($Category2=mysql_fetch_array($CategoryResult3)){
					echo "<option value='$Category[id]'>$Category[category]</option>";
					}
			}
			?>
			</select>
			</td>
			<td align="right">
			<select name="item_id" id="item_id" class="reqd"  style="font-size:40px;border-color:#ff0000;border-width: 7px;">
				<option value='1'>Lunch at work</option>
				<option value='2'>Dining Out</option>
				<option value='3'>Drink</option>
				<option value='4'>Snack</option>
				<option value='14'>Other</option>
			</select>
			</td>
			<td align="right">
			<select name="frequency" id="frequency" class="reqd"  style="font-size:40px;border-color:#ff0000;border-width: 7px;" onchange="FieldCtrl(this.value)">
				<option value='0'>None</option>
				<option value='1'>Daily</option>
				<option value='2'>Weekly</option>
				<option value='3'>Bi-Weekly</option>
				<option value='4'>Monthly</option>
				<option value='5'>Quarterly</option>
				<option value='6'>Semi-Annually</option>
				<option value='7'>Yealy</option>
			</select>
			</td>
		    <td align="left"><input type="text" name="amount" id="amount" size="8" maxlength="8" style="font-size:40px;border-color:#ff0000;border-width: 7px;border-style:ridge;"  value="0" onkeyup="ForceNumericInput(this,true);" disabled="disabled"></td>
			</tr>
			<tr>
			<td colspan="3" align="right" style="font-size:40px;border-color:#ff0000;border-width: 7px;">Starting Date:
			  <input type="text" size="10" name="start_date" id="start_date"  value="" style="font-size:40px;border-color:#ff0000;border-width: 7px;" onClick="GetDate(document.getElementById('start_date'));return false;" disabled="disabled">
			</td>
			<td align="left">			
			  <input type="image" src="../images/calendar.jpg" name="Select" id="calender" width="100px" value="Select" onClick="GetDate(document.getElementById('start_date'));return false;" disabled="disabled">
			</td>
			</tr>
	</table>
	<input type="image" src="../images/save.jpg" name="Save" id="save" value="Save" disabled="disabled">
	<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel" onClick="this.form.reset();">
	<input type="image" src="../images/back.png" name="back" value="Back" onclick="window.open( 'spcategory.php', '_top');return false;"><br/>
</form>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>
<table width="100%">
	<tr>
		<th style="border-style: solid;border-width: 3px;">
		Category
		</th>		
		<th style="border-style: solid;border-width: 3px;">
		Category Item
		</th>		
		<th style="border-style: solid;border-width: 3px;">
		Frequency
		</th>		
		<th style="border-style: solid;border-width: 3px;">
		Amount
		</th>
		<th style="border-style: solid;border-width: 3px;">
		Start Date
		</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($result)){
$queryItem=mysql_query("SELECT * FROM category_item where id = $nt[item_id] limit 1");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($ItemResult=mysql_fetch_array($queryItem)){
$category_item = $ItemResult['category_item'];
$category_id = $ItemResult['category_id'];
}
$queryCategory=mysql_query("SELECT * FROM spending_category where id = $category_id limit 1");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($CategoryResult2=mysql_fetch_array($queryCategory)){
$category = $CategoryResult2['category'];
}
$sq = $nt['frequency'];
echo "
<tr>
    <td style='border-style: solid;border-width: 3px;border-color:#ff0000;'>
	$category
	</td>
    <td style='border-style: solid;border-width: 3px;border-color:#ff0000;'>
	$category_item
	</td>
    <td style='border-style: solid;border-width: 3px;border-color:#ff0000;'>
	$frequency[$sq]
	</td>
    <td style='border-style: solid;border-width: 3px;border-color:#ff0000;'>
	$nt[amount]
	</td>
    <td style='border-style: solid;border-width: 3px;border-color:#ff0000;'>
	$nt[start_date]
	</td>
</tr>
";
}
?>
</table>
</body>
</html>
	