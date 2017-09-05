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

include("../config.php");
$ToDate = date('m/d/Y');
$todate = date('Ymd');
$fmdate = strtotime ( '-7 day' , strtotime ( $todate ) ) ;
$FmDate = date ( 'm/d/Y' , $fmdate );
$fmdate = date ( 'Ymd' , $fmdate );
$todate = "$todate"."000000";
$fmdate = "$fmdate"."000000";;
$GetDisplay="SELECT * FROM kidsreward where date between $fmdate and $todate order by rewardid";  // query string stored in a variable
$result=mysql_query($GetDisplay);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$CarlyAmt = 0;
$CarlySignature = 0;
$JessicaAmt = 0;
$JessicaSignature = 0;
$CarlyTotal = 0;
$JessicaTotal = 0;
$GetTotal="SELECT * FROM kidsreward where 1";  // query string stored in a variable
$resultTotal=mysql_query($GetTotal);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row=mysql_fetch_array($resultTotal)){
	if ($row['rewardid'] == '1') {
	$CarlyAmt += $row['amount'];
	$CarlySignature += $row['signature'];
	$CarlyTotal = $CarlyAmt + $CarlySignature * 2;
	}
	ELSE {
	$JessicaAmt += $row['amount'];
	$JessicaSignature += $row['signature'];
	$JessicaTotal = $JessicaAmt + $JessicaSignature * 2;
	}
}
if(isset($_POST['Delete_x']))
{	
	$searchID3 =  (int)$_POST['searchID'];
	mysql_query("DELETE FROM kidsreward WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM kidsreward where id < $searchID3 ORDER BY id DESC LIMIT 1";
	include("../inc/KidsReward.inc.php");
	unset($_POST['Delete']);
	 Header("Location: {$_SERVER['REQUEST_URI']}");
	 die;
	
}
ELSEIF(isset($_POST['Previous_x']))
{
	$searchID3 =  (int)$_POST['searchID'];	
	$GetDisplay = "SELECT * FROM kidsreward WHERE id < $searchID3 ORDER BY id DESC LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM kidsreward WHERE id = $searchID3";	
	}
	 include("../inc/KidsReward.inc.php");
}
ELSEIF(isset($_POST['Next_x']))
{
	$searchID3 =  (int)$_POST['searchID'];
	$GetDisplay = "SELECT * FROM kidsreward WHERE id > $searchID3 ORDER BY id LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM kidsreward WHERE id = $searchID3";
	}					
	 include("../inc/KidsReward.inc.php");
}
ELSEIF(isset($_POST['First_x']))
{
	$GetDisplay = "SELECT * FROM kidsreward ORDER BY id ASC LIMIT 1";
	include("../inc/KidsReward.inc.php");
}
ELSEIF(isset($_POST['Last_x']))
{
	$GetDisplay = "SELECT * FROM kidsreward ORDER BY id DESC LIMIT 1";
	include("../inc/KidsReward.inc.php");
} 
ELSEIF(isset($_POST['Save_x']))
{
	$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
	$description = mysql_real_escape_string($_POST['description']);
	$rewardid =  mysql_real_escape_string($_POST['rewardid']);
	$amount =  mysql_real_escape_string($_POST['amount']);
	$signature =  mysql_real_escape_string($_POST['signature']);
	mysql_query("UPDATE kidsreward SET description='$description', rewardid='$rewardid', 	amount='$amount', signature='$signature' WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM kidsreward	where id = $searchID3 ORDER BY id LIMIT 1";
	include("../inc/KidsReward.inc.php");	
	unset($_POST['Save']);
	 Header("Location: {$_SERVER['REQUEST_URI']}");
	 die;
	
}
ELSEIF(isset($_POST['submit_x']))
{
	$fmdate = ($_POST['FmDate']);
	$todate = $_POST['ToDate'];
	list($fmmonth, $fmday, $fmyear) = explode("/", $fmdate);
	$fmdate =  $fmyear.$fmmonth.$fmday.'000000'; 
	list($tomonth, $today, $toyear) = explode("/", $todate);
	$todate =  $toyear.$tomonth.$today.'000000'; 
	$start_date=gregoriantojd($fmmonth, $fmday, $fmyear);   
    $end_date=gregoriantojd($tomonth, $today, $toyear);   
	$daysdiff = $end_date - $start_date + 1;
	$GetDisplay="SELECT * FROM kidsreward where date between $fmdate and $todate order by date desc";  // query string stored in a variable
	$result=mysql_query($GetDisplay);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
//	include("../inc/KidsReward.inc.php");

}
ELSEIF(isset($_POST['sendmail_x']))
{
			$todaydate = date("l, F j, Y, g:i a");
			$email = "raymondlwhuang@yahoo.com";
			$to = "carly.huang@hotmail.com,jessicaanddarly@yahoo.ca";
//			$to = "raymondlwhuang@gmail.com,raymondlwhuang@yahoo.com";
			$cc = "";
			$subject = "Your reward";
			$headers = "From: raymondlwhuang@yahoo.com\r\n";
			$headers .= "Reply-To: raymondlwhuang@yahoo.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers = "CC: $cc\nX-Sender-IP: $ip\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';
			$message .= "<h1>Hello Carly and Jessica,</h1>";
			$message .= "<br/><br/>Here is your reward I got this week <br/>
		Hope you getting more reward continuously.<br/><br/><br/>";
			$message .= '
			<table style="border-style: solid;border-color:#0000ff;border-width: 3px;" width="100%">
			<tr>
				<th  style="border-style: solid;border-color:#0000ff;border-width: 3px;">
				<p>Reward To</p>
				</th>
				<th  style="border-style: solid;border-color:#0000ff;border-width: 3px;">
				<p>Date</p>
				</th>
				<th  style="border-style: solid;border-color:#0000ff;border-width: 3px;">
				<p>Amount</p>
				</th>
				<th  style="border-style: solid;border-color:#0000ff;border-width: 3px;">
				<p>Signature</p>
				</th>
				<th  style="border-style: solid;border-color:#0000ff;border-width: 3px;">
				<p>Description</p>
				</th>	
				</tr>';
				mysql_data_seek($result,0);
				while($nt=mysql_fetch_array($result)){
				$message .= '
				<tr>
					<td  style="border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;">';
					if ($nt['rewardid'] == '1') {
					$message .= "Carly"; 
					}
					ELSE {
					$message .= "Jessica";	
					}
				$message .= "
				</td>
					<td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>";
					$message .= substr($nt['date'],-5);
				$message .= "	
					</td>
					<td align='right'  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					$nt[amount]
					</td>
					<td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					$nt[signature]
					</td>
					<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					<font color = blue>$nt[description]&nbsp;</font>
					</td>
				</tr>
				";
				}
				$message .= "
				<tr>
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;' colspan='2'>
					Carly Total Now
				</td>	
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					$CarlyAmt
				</td>	
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					$CarlySignature
				</td>
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>\$$CarlyTotal
				</td>
				</tr>
				<tr>	
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;' colspan='2'>
					Jessica Total Now
				</td>	
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					$JessicaAmt
				</td>	
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
					$JessicaSignature
				</td>	
				<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>\$$JessicaTotal
				</td>
				</tr>
				</table><br/><br/><br/>
				Daddy";		
				$message .= '</body></html>';
			if (preg_match("/bcc:/i", $email . " " . $message) == 0 &&          /* check for injected 'bcc' field */
				preg_match("/Content-Type:/i", $email . " " . $message) == 0 && /* check for injected 'content-type' field */
				preg_match("/cc:/i", $email . " " . $message) == 0 &&           /* check for injected 'cc' field */
				preg_match("/to:/i", $email . " " . $message) == 0) {           /* check for injected 'to' field */
				// Format the body of the email
				$message = "Email: $email\n" . $message . "\n\nSent from: $ip ($todaydate)\n";
				$sent = mail($to, $subject, $message, $headers) ;
				if($sent) {
					echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "Your mail was sent successfully.<br>Thanks for your comment"</script>';
				} else {
					echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "We encountered an error sending your mail"</script>';
				}
			} else  {
				echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "We encountered an error sending your mail"</script>';
			}
echo <<<_END
<script type="text/javascript">
window.open( 'KidsReward.php', '_top');
</script>
_END;

}
else 
{
	if(isset($_SESSION["searchID2"]))
	{	
		$searchID3 =  (int)$_SESSION["searchID2"];	
		$GetDisplay = "SELECT * FROM kidsreward WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		include("../inc/KidsReward.inc.php");
		unset ($_SESSION['searchID2'], $searchID2);
 
	}
	else if(isset($_GET['searchID']))
	{	
		$searchID3 =  (int)$_GET['searchID'];	
		$GetDisplay = "SELECT * FROM kidsreward WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		include("../inc/KidsReward.inc.php");	
		unset($_GET);
		unset($_POST);
	}
	else{
		$GetDisplay = "SELECT *	FROM kidsreward WHERE 1 ORDER BY id desc LIMIT 1";
		include("../inc/KidsReward.inc.php");
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style type="text/css">
input.wide {display:block; width: 99%} 
</style>

<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<title>My kidsreward Reporter</title>
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
echo date('l jS \of F Y');
?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<table width="100%">
	<tr>
    <th>
	<p style="text-align:left;font-size:50px;">Reward To</p>
	</th>
	<th>
	<p style="text-align:left;font-size:50px;" >Date</p>
	</th>
	<th>
	<p style="text-align:left;font-size:50px;" >Amount</p>
	</th>
	<th>
	<p style="text-align:left;font-size:50px;" >Signature</p>
	</th>
	</tr>
	<tr>
    <td align="left">
	<select name="rewardid" id="rewardid" style="border-color:#0000ff;border-style:ridge;font-size:60px;border-width: 7px;">
	   <option value="1" <?php if((isset($rewardid) && htmlspecialchars($rewardid) == "1") || !isset($rewardid)) echo "selected"; ?>>Carly</option>
	   <option value="2" <?php if(isset($rewardid) && htmlspecialchars($rewardid) == "2") echo "selected"; ?>>Jessica</option>
	 </select>	
	</td>
    <td>
	<input type="text" name="date" id="date"  size="10" style="border-color:#0000ff;border-style:ridge;font-size:60px;border-width: 7px;"  value="<?php if (isset($date)){ echo htmlspecialchars($date); } else ''; ?>" readonly="readonly">
	</td>
    <td>
	<input type="text" name="amount" id="amount" size="5" maxlength="5"  style="border-color:#0000ff;border-style:ridge;font-size:60px;border-width: 7px;text-align:right;" onkeyup="ForceNumericInput(this,true);"  value="<?php if (isset($amount)){ echo htmlspecialchars($amount); } else ''; ?>">
	</td>
    <td>
	<input type="text" name="signature" id="signature" size="5" maxlength="5"  style="border-color:#0000ff;border-style:ridge;font-size:60px;border-width: 7px;text-align:right;" onkeyup="ForceNumericInput(this,false);"  value="<?php if (isset($signature)){ echo htmlspecialchars($signature); } else ''; ?>">
	</td>	
   </tr>  
  <tr>
    <td colspan="4" align="left"><input type="text" name="description"  class="wide" maxlength="200" style="border-color:#0000ff;border-style:ridge;font-size:60px;border-width: 7px;"  value="<?php if (isset($description)){ echo htmlspecialchars($description); } else ''; ?>"></td>
  </tr>
</table>    
<input type="image" src="../images/save.jpg" name="Save" value="Save"  width="190px" onclick="return confirm('Are you sure you want to save?')">
<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel"  width="190px" onclick="this.form.reset();"> 
<input type="image" src="../images/delete.jpg" name="Delete" value="Delete" width="190px" onclick="return confirm('Are you sure you want to delete?')">
<input type="image" src="../images/add.png" name="Add" value="Add" width="190px"  onclick="window.open( '../PHP/AddReward.php', '_top');return false;"><br/>
<input type="image" src="../images/first.jpg" name="First" value="First"> 
<input type="image" src="../images/previous.jpg" name="Previous" value="Previous"> 
<input type="image" src="../images/next.png" name="Next" value="Next"> 
<input type="image" src="../images/last.jpg" name="Last" value="Last"> 
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
</form>

<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
  From: <input type="text" size="10" name="FmDate" id="FmDate" 
  value="<?php if (isset($_POST['FmDate'])){ echo $_POST['FmDate']; }   else echo $FmDate; ?>" style="font-size:60px;border-color:#0000ff #0000ff;border-width: 3px;">
  <input type="image" src="../images/calendar.jpg" name="Select" width="100px" value="Select" onClick="GetDate(document.getElementById('FmDate'));return false;">
  <input type="image" src="../images/sendmail.png" name="sendmail" value="Send Emailsubmit" height="100px"> <br/>
  &nbsp;&nbsp;&nbsp;&nbsp;To: <input type="text" size="10" name="ToDate" id="ToDate" value="<?php if (isset($_POST['ToDate'])){ echo $_POST['ToDate']; } else  echo $ToDate; ?>" style="font-size:60px;border-color:#0000ff #0000ff;border-width: 3px;">
  <input type="image" src="../images/calendar.jpg" name="Select2" width="100px" value="Select2" onClick="GetDate(document.getElementById('ToDate'));return false;">
  <input type="image" src="../images/submit.jpg" name="submit" value="submit" height="100px"> <br/>
</form>
<table   style='border-style: solid;border-color:#0000ff;border-width: 3px;' width="100%">
	<tr>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Reward To</p>
	</th>
    <th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Date</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Amount</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Signature</p>
	</th>
	<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<p>Description</p>
	</th>	
	</tr>
<?php
mysql_data_seek($result,0);
while($nt=mysql_fetch_array($result)){
echo "
<tr>
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	<a href='../PHP/KidsReward.php?searchID=$nt[id]'>";
	if (@$nt[rewardid] == '1') {
	echo "Carly"; 
	}
	ELSE {
	ECHO 'Jessica';	
	}
echo "
</a></td>
    <td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>";
	echo @substr($nt[date],-5);
echo "	
	</td>
	<td align='right'  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	<a href='../PHP/KidsReward.php?searchID=$nt[id]'>$nt[amount]</a>
	</td>
	<td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	<a href='../PHP/KidsReward.php?searchID=$nt[id]'>$nt[signature]</a>
	</td>
	<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	<font color = blue>$nt[description]&nbsp;</font>
	</td>
</tr>
";
}
echo "
<tr>
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;' colspan='2'>
	Carly Total Now
</td>	
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	$CarlyAmt
</td>	
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	$CarlySignature
</td>
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
\$$CarlyTotal
</td>
</tr>
<tr>	
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;' colspan='2'>
	Jessica Total Now
</td>	
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	$JessicaAmt
</td>	
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	$JessicaSignature
</td>	
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
\$$JessicaTotal  
</td>
</tr>";
?>
</table>


</body>
</html>