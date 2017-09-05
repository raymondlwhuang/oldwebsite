<?php
session_start();
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
    $_GET = _stripslashes_rcurs($_GET);////
    $_POST = _stripslashes_rcurs($_POST);
}
$todate = date('Y-m-d')."000000";
$replaceStr = array("-", ":", " ");
$todate = str_replace($replaceStr,"",$todate);
$fmdate = substr($todate,0,6)."01000000";
$FmDate = date('m')."/"."01/".date('Y');
$ToDate = date('m/d/Y');
$daysdiff = date('d') + 1;
include("../config.php");

if(isset($_POST['Delete_x']))
{	
	$searchID3 =  (int)$_POST['searchID'];
	mysql_query("DELETE FROM spending WHERE id = $searchID3");
	 Header("Location: {$_SERVER['REQUEST_URI']}");
	 die;
	
}
ELSEIF(isset($_POST['Previous_x']))
{
	$searchID3 =  (int)$_POST['searchID'];	
	$GetDisplay = "SELECT * FROM spending WHERE id < $searchID3 ORDER BY id DESC LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM spending WHERE id = $searchID3";	
	}
	 include("../txt/MySpending.txt");
}
ELSEIF(isset($_POST['Next_x']))
{
	$searchID3 =  (int)$_POST['searchID'];
	$GetDisplay = "SELECT * FROM spending WHERE id > $searchID3 ORDER BY id LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM spending WHERE id = $searchID3";
	}					
	 include("../txt/MySpending.txt");
}
ELSEIF(isset($_POST['First_x']))
{
	$GetDisplay = "SELECT * FROM spending ORDER BY id ASC LIMIT 1";
	include("../txt/MySpending.txt");
}
ELSEIF(isset($_POST['Last_x']))
{
	$GetDisplay = "SELECT * FROM spending ORDER BY id DESC LIMIT 1";
	include("../txt/MySpending.txt");
} 
ELSEIF(isset($_POST['Save_x']))
{
	$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
	$detail = mysql_real_escape_string($_POST['detail']);
	$whospend =  mysql_real_escape_string($_POST['whospend']);
	$amount =  mysql_real_escape_string($_POST['amount']);
	$code =  mysql_real_escape_string($_POST['code']);
	mysql_query("UPDATE spending SET detail='$detail', whospend='$whospend', 	amount='$amount', code='$code' WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM spending	where id = $searchID3 ORDER BY id LIMIT 1";
	include("../txt/MySpending.txt");	
	unset($_POST['Save']);
	 Header("Location: {$_SERVER['REQUEST_URI']}");
	 die;
	
}
ELSEIF(isset($_POST['submit_x']))
{
	$fmdate = $_POST['FmDate'];
	$todate = $_POST['ToDate'];
	$replaceStr = array("/", ":", " ");
	$fmdate = str_replace($replaceStr,"",$fmdate);
	$fmmonth = substr($fmdate,0,2);
	$fmday = substr($fmdate,2,2);
	$fmyear = substr($fmdate,4,4);
	$fmdate=(float)(substr($fmdate,4,4).substr($fmdate,0,2).substr($fmdate,2,2)."000000");
	$todate = str_replace($replaceStr,"",$todate);
	$tomonth = substr($todate,0,2);
	$today = substr($todate,2,2);
	$toyear = substr($todate,4,4);
	$todate=(float)(substr($todate,4,4).substr($todate,0,2).substr($todate,2,2)."000000");
	$start_date=gregoriantojd($fmmonth, $fmday, $fmyear);   
    $end_date=gregoriantojd($tomonth, $today, $toyear);   
	$daysdiff = $end_date - $start_date + 1;
	$query="SELECT * FROM spending where date between $fmdate and $todate order by date desc";  // query string stored in a variable
	$RangResult=mysql_query($query);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
}
else 
{
	if(isset($_SESSION["searchID2"]))
	{	
		$searchID3 =  (int)$_SESSION["searchID2"];	
		$GetDisplay = "SELECT * FROM spending WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		unset ($_SESSION['searchID2'], $searchID2);
 
	}
	else if(isset($_GET['searchID']))
	{	
		$searchID3 =  (int)$_GET['searchID'];	
		$GetDisplay = "SELECT * FROM spending WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		include("../txt/MySpending.txt");	
		unset($_GET);
		unset($_POST);
	}
	else{
		$GetDisplay = "SELECT *	FROM spending WHERE 1 ORDER BY id desc LIMIT 1";
		include("../txt/MySpending.txt");
		$query="SELECT * FROM spending where date between $fmdate and $todate order by date desc";  // query string stored in a variable
		$RangResult=mysql_query($query);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		}
}
$result = @mysql_query($GetDisplay);
if (@mysql_num_rows($result) == 0){
	$GetDisplay = "SELECT * FROM spending WHERE 1 ORDER BY id DESC LIMIT 1";
}					
include("../txt/MySpending.txt");

$queryResult="SELECT code,COUNT(*) AS codeCount,SUM(amount) AS Total,MAX(amount) AS Maximum FROM spending where  date between $fmdate and $todate and code !='09.Money to Elaine' group by code order by Total desc";
$totalResult=mysql_query($queryResult);          // query executed 
$queryElaine="SELECT sum(amount) as Total,code FROM spending where whospend != 'M' group by code";  // query string stored in a variable
$totalElaine=mysql_query($queryElaine);          // query executed 
$GetDesc="SELECT * FROM spendcode where 1 order by description";  // query string stored in a variable
$Desc=mysql_query($GetDesc);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<title>Track of Household Expenses</title>
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
  font-size: 60px;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  width: 450px;
}
/* The table of the Calendar */
#dpCalendar table {
  border: 1px solid black;
  background-color: #eeeeee;
  color: black;
  font-size: 60px;
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
<script type="text/javascript">
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}
</script>
</head>
<body style="font-size:30px;">
<?php
$monthlyResult="SELECT * FROM spending where code != '09.Money to Elaine' order by date";  // query string stored in a variable
$getMonthlyResult=mysql_query($monthlyResult);          // query executed 
$monthorg = '';
$yearorg = '';
$month = '1';
$monthlyTotal = 0;
$replaceStr = array("-", ":", " ");
$i = 0;
echo date('l jS \of F Y');
echo '<select name="Monthly" id="Monthly" style="font-size:60px;border-color:#0000ff #0000ff;border-style: solid;border-width: 3px;color:red">';
while($nt=mysql_fetch_array($getMonthlyResult)){
$date = strtotime($nt['date']);
$month = date('F',$date);
$year = date('Y',$date);
if($monthorg != $month) {
	if ($monthorg != '') {
		echo "<option value='$monthorg $yearorg'"." >".' $'.$monthlyTotal.'-'.$monthorg .' '.$yearorg. "</option>";
		$i++;
	}
	$monthlyTotal = $nt['amount'];
	$monthorg = $month;
	$yearorg = $year;
}
else $monthlyTotal = $monthlyTotal + $nt['amount'];
}
echo "<option value='$monthorg $yearorg'"." selected>".' $'.$monthlyTotal.'-'.$monthorg .' '.$yearorg. "</option>";
echo "</select>";
?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<table width="100%">
	<tr>
    <th>
	<p style="font-size:60px;text-align:left;">Spender</p>
	</th>
	<th>
	<p style="font-size:60px">Amount</p>
	</th>
	<th>
	<p style="font-size:60px">Description</p>
	</th>
	</tr>
	<tr>
    <td align="left">
	<select name="whospend" id="whospend" style="font-size:60px;border-color:#0000ff;border-style:ridge;border-width: 7px;" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>>
	   <option value="M" <?php if((isset($whospend) && htmlspecialchars($whospend) == "M") || !isset($whospend)) echo "selected"; ?>>Me</option>
	   <option value="I" <?php if(isset($whospend) && htmlspecialchars($whospend) == "I") echo "selected"; ?>>Elaine</option>
	 </select>	
	</td>
    <td align="right"><input type="text" name="amount" id="amount" size="5" maxlength="5"  <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?> style="border-color:#0000ff;border-style:ridge;font-size:60px;border-width: 7px;" onkeyup="ForceNumericInput(this,false);" style="border: 1px solid #38c;"  value="<?php if (isset($amount)){ echo htmlspecialchars($amount); } else ''; ?>"></td>
    <td align="right">
	<select name="code" id="code" class="reqd" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?> style="border-color:#0000ff;border-style:ridge; border-width: 7px;font-size:60px;">
	<?php while($DescDisp=mysql_fetch_array($Desc)){
		echo "<option value='$DescDisp[description]'";
		if(isset($code) && htmlspecialchars($code) == $DescDisp['description']) echo "selected";
		echo ">$DescDisp[description]</option>";
	}
	?>	
	 </select>		
	</td>	
   </tr>  
  <tr>
    <td colspan="3" align="left"><input type="text" name="detail"  class="wide" maxlength="200"  <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?> style="border-color:#0000ff;border-style:ridge;font-size:60px;"  value="<?php if (isset($detail)){ echo htmlspecialchars($detail); } else ''; ?>"></td>
  </tr>
</table>    
<input type="image" src="../images/save.jpg" name="Save" value="Save"  width="190px" onclick="return confirm('Are you sure you want to save?')" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>>
<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel"  width="190px" onclick="this.form.reset();" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>> 
<input type="image" src="../images/delete.jpg" name="Delete" value="Delete" width="190px" onclick="return confirm('Are you sure you want to delete?')" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>>
<input type="image" src="../images/add.png" name="Add" value="Add" width="190px"  onclick="window.open( '../PHP/AddSpending.php', '_top');return false;"><br/>
<input type="image" src="../images/first.jpg" name="First" value="First" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>> 
<input type="image" src="../images/previous.jpg" name="Previous" value="Previous" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>> 
<input type="image" src="../images/next.png" name="Next" value="Next" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>> 
<input type="image" src="../images/last.jpg" name="Last" value="Last" <?php if (mysql_num_rows($result) == 0) echo 'disabled="disabled"'; ?>> 
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
</form>
<table width="100%"  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<tr>
	<th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Description
	</th>	
    <th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Count
	</th>
	<th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Bigest
	</th>
	<th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Total
	</th>
	<th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Description
	</th>	
    <th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Count
	</th>
	<th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Bigest
	</th>
	<th style="font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;">
	Total
	</th>
	</tr>
<?php	
$ToElaine=0;
$GrandElaine = 0;
while($Elaine=mysql_fetch_array($totalElaine)){
if($Elaine['code'] == '09.Money to Elaine') $ToElaine = $Elaine['Total'];
else $GrandElaine = $GrandElaine + $Elaine['Total'];
}
$MoneyLeft = $ToElaine - $GrandElaine;
$i=0;
$GrandTotal = 0;
while($Total=mysql_fetch_array($totalResult)){
$GrandTotal = $GrandTotal + $Total['Total'];
echo fmod($i, 2) ? '' : '<tr>';
echo "
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	$Total[code]
	</td>
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<font color = red><b>$Total[codeCount]</b></font>
	</td>	
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<font color = red><b>\$$Total[Maximum]</b></font>
	</td>	
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<font color = red><b>\$$Total[Total]</b></font>
	</td>";
$i++;
echo fmod($i, 2) ? '' : '</tr>';
}
echo '</table>';
$GrandTotal = $GrandTotal;
echo "Total Spend in <font color = red><b>$daysdiff</b></font> days is ".'<font color = red><b>$'."$GrandTotal</b></font><br/>";
echo "Elaine's unused Money <font color = red><b>$"."$MoneyLeft</b></font>";
?>

<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
  From: <input type="text" size="10" name="FmDate" id="FmDate" 
  value="<?php if (isset($_POST['FmDate'])){ echo $_POST['FmDate']; }   else echo $FmDate; ?>" style="font-size:60px;border-color:#0000ff #0000ff;border-width: 3px;">
  <input type="image" src="../images/calendar.jpg" name="Select" width="100px" value="Select" onClick="GetDate(document.getElementById('FmDate'));return false;"> <br/>
  &nbsp;&nbsp;&nbsp;&nbsp;To: <input type="text" size="10" name="ToDate" id="ToDate" value="<?php if (isset($_POST['ToDate'])){ echo $_POST['ToDate']; } else  echo $ToDate; ?>" style="font-size:60px;border-color:#0000ff #0000ff;border-width: 3px;">
  <input type="image" src="../images/calendar.jpg" name="Select2" width="100px" value="Select2" onClick="GetDate(document.getElementById('ToDate'));return false;">
  <input type="image" src="../images/submit.jpg" name="submit" value="submit" height="100px"> <br/>
</form>
<table   style='border-style: solid;border-color:#0000ff;border-width: 3px;' width="100%">
	<tr>
    <th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Date</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Amt</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Description</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Who</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Detail</p>
	</th>	
	</tr>
<?php	
while($nt=mysql_fetch_array($RangResult)){
echo "
<tr>
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>";
	echo @substr($nt[date],-5);
echo "	
	</td>
	<td align='right'  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	$nt[amount]
	</td>
	<td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	<a href='../PHP/MySpending.php?searchID=$nt[id]'>$nt[code]</a>
	</td>
	<td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	";
	if (@$nt[whospend] == 'M') echo "ME"; 
	ELSE ECHO 'ELAINE';	
echo "	
	</td>
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
<font color = blue>$nt[detail]</font>
</td>
</tr>
";
}
?>
</table>


</body>
</html>