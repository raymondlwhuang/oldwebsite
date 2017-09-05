<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
include("endec.php");
include("../inc/GlobalVar.inc.php");
$e = new endec(); 
$zero = $e->new_encode("0");
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
	$amount =  (float)mysql_real_escape_string($_POST['amount']);
	if($amount != 0)
	{
//		$e = new endec();  
		$expenses = $e->new_encode("$amount");
		$category_id = (int)mysql_real_escape_string($_POST['category_id']);
		$item_id = (int)mysql_real_escape_string($_POST['item_id']);
		if(isset($_POST['comment_id']))	$comment_id =  (int)mysql_real_escape_string($_POST['comment_id']); else $comment_id = 0;
		$spender_id = (int)mysql_real_escape_string($_POST['spender_id']);
		mysql_query("INSERT INTO spending(user_id,category_id,item_id,sp_comment_id,expenses,spender_id,date) VALUES($GV_id,$category_id,$item_id,$comment_id,'$expenses',$spender_id,NOW())");
		echo mysql_error(); 
		$GetDisplay = "SELECT * FROM spending order by id DESC LIMIT 1";
		include("../txt/MySpending.txt");
		
		$inTwoMonths = 60 * 60 * 24 * 60 + time();
		setcookie( "searchID2", $searchID, $inTwoMonths, "", "", false, true );
		$_SESSION["searchID2"] = $searchID;
		Header("Location: {$_SERVER['REQUEST_URI']}");
		 die;
    } 
}
$vRes = mysql_query("SELECT * FROM `spender` where user_id=$GV_id limit 1");
if (mysql_num_rows($vRes) == 0){
	mysql_query("INSERT INTO spender(user_id,name) VALUES($GV_id,'Me')");
	$SaveCheck = "SELECT * FROM spender WHERE user_id = $GV_id LIMIT 1";
	$result = mysql_query($SaveCheck);
	while($Row=mysql_fetch_array($result)){
		$spender_id = $Row['id'];
		mysql_query("INSERT INTO sp_bank(user_id,spender_id,bank) VALUES($GV_id,$spender_id,'Cash On Hand')");
		echo mysql_error(); 
	}	
}
$todate = date('Y-m-d')."000000";
$replaceStr = array("-", ":", " ");
$todate = str_replace($replaceStr,"",$todate);
$fmdate = substr($todate,0,6)."01000000";
$daysdiff = date('d') + 1;
$queryMonth="SELECT * FROM spending where user_id=$GV_id and category_id <> 1 and date between $fmdate and $todate order by date desc";  // query string stored in a variable
$RangResult=mysql_query($queryMonth);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$SpenderResult=mysql_query("SELECT * FROM `spender` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option = mysql_fetch_array($SpenderResult)) {
	$optionSpender["$option[id]"] = $option['name'];
}
$TypeResult=mysql_query("SELECT * FROM `sp_payment_type` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option6 = mysql_fetch_array($TypeResult)) {
	$optionType["$option6[id]"] = $option6['Type'];
}

$BankResult=mysql_query("SELECT * FROM `sp_bank` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option7 = mysql_fetch_array($BankResult)) {
	$optionBank["$option7[id]"] = $option7['bank'];
	if($option7['balance'] == '') $balance = 0; else $balance = $e->new_decode("$option7[balance]");
	$optionBalance["$option7[id]"] = $balance;
}
$frequencyResult=mysql_query("SELECT * FROM `sp_frequency` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option8 = mysql_fetch_array($frequencyResult)) {
	$optionfrequency["$option8[id]"] = $option8['frequency'];
}
$CategoryResult=mysql_query("SELECT * FROM `spending_category` where user_id = $GV_id or user_id = 0 order by category");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option1 = mysql_fetch_array($CategoryResult)) {
	$optionCategory["$option1[id]"] = $option1['category'];
}
foreach($optionCategory as $category_id=>$category) {
	$querySpending=mysql_query("SELECT * from spending where user_id=$GV_id and category_id <> 1 and category_id=$category_id and date between $fmdate and $todate order by category_id,item_id");
	echo mysql_error();
	$categoryTotal["$category_id"] = 0;
	while($TotalResult = mysql_fetch_array($querySpending)) {
		$expenses = $e->new_decode($TotalResult['expenses']);
		$item_id = $TotalResult['item_id'];
		$categoryTotal["$category_id"] += $expenses;
		if(!isset($itemTotal["$category_id"]["$item_id"])) $itemTotal["$category_id"]["$item_id"] = 0;
		$itemTotal["$category_id"]["$item_id"] += $expenses;
		$spender_id = $TotalResult['spender_id'];
		if(!isset($SpenderTotal["$spender_id"])) $SpenderTotal["$spender_id"] = 0;
		$SpenderTotal["$spender_id"] += $expenses;
	}  
}
$queryResult="SELECT * from spending where user_id=$GV_id and date between $fmdate and $todate order by category_id,item_id";
$totalResult=mysql_query($queryResult);  

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Household Expenses Recorder</title>
<style type="text/css"> 
input.wide {display:block; width: 99%} 
 #AddDialog {
	position:relative;
	left:10px;
	top:250px;
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

</style>
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
<script src="../scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}
var CallID = 0;
function setamount(number) {
	document.getElementById('amount').value = document.getElementById('amount').value + '' + number;
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
function SetDialog(text,infor_id) {
	document.getElementById('AddDialog').style.display='block';
	document.getElementById('dialog_text').innerHTML = text;
	CallID = infor_id;
	if(CallID == 7) document.getElementById('adjustment').style.display='block';
	else  document.getElementById('adjustment').style.display='none';
}
function AddInfor(id) {
	document.getElementById('main').disabled = false;
	document.getElementById('AddDialog').style.display='none';
	var text = document.getElementById('input_text').value;
	var category_id = document.getElementById('category_id').value;
	var item_id = document.getElementById('item_id').value;
	var adjustment = document.getElementById('input_amount').value;
	var id = '#spender_id';
	
	if(id != 0) {
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
			id = '#payment_type';
			url = '../search/AddType.php?user_id=<?php echo $GV_id; ?>&Type='+text;
		}
		else if(CallID == 6) {
			id = '#frequency';
			url = '../search/AddFrequency.php?user_id=<?php echo $GV_id; ?>&frequency='+text;
		}
		else if(CallID == 7) {
			id = '#bank_id';
			url = "../search/AddBank.php?user_id=<?php echo $GV_id; ?>&bank="+text+"&adjustment="+adjustment;
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
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});			
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
function DispDate(id) {
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
		document.getElementById('start_date').value = (mydate.getMonth() + 1)+"/"+mydate.getDate()+"/"+mydate.getFullYear();
	}
} 
function Save() {
 var user_id = "<?php echo $GV_id; ?>";
 var category_id = document.getElementById('category_id').value;
 var item_id = document.getElementById('item_id').value;
 var comment_id = document.getElementById('comment_id').value;
 var amount = document.getElementById('amount').value;
 var spender_id = document.getElementById('spender_id').value;
 var payment_type = document.getElementById('payment_type').value;
 var frequency = document.getElementById('frequency').value;
 var start_date = document.getElementById('start_date').value;
 var query_month = document.getElementById('query_month').value;
// SendRequest ("HERDisp.php?user_id="+user_id+"&category_id="+category_id+"&item_id="+item_id+"&comment_id="+comment_id+"&amount="+amount+"&spender_id="+spender_id+"&payment_type="+payment_type+"&frequency="+frequency+"&start_date="+start_date,'Result');
 window.open("test.php?user_id="+user_id+"&category_id="+category_id+"&item_id="+item_id+"&comment_id="+comment_id+"&amount="+amount+"&spender_id="+spender_id+"&payment_type="+payment_type+"&frequency="+frequency+"&start_date="+start_date+"&query_month="+query_month,'Result');
}
 </script>
 
</head>
<body style="font-size:30px;">

<input type="hidden" id="query_month" value="<?php echo date('m') ?>">
<?php
/*
$monthlyResult="SELECT * FROM sp_monthly where 1 order by reset_date desc";  // query string stored in a variable
$getMonthlyResult=mysql_query($monthlyResult);          // query executed 
echo mysql_error();  
echo date('l jS \of F Y');
while($monthly=mysql_fetch_array($getMonthlyResult)){
	//$date = strtotime($monthly['date']);
	//$month = date('F',$monthly['reset_date']);
	$month = date('m',$monthly['reset_date']);
	$year = date('Y',$date);
	if($month == 1){
		$month = 12;
		$year = $year - 1; 
	}
	else {
	 $month = $month - 1;
	} 
	$spender_id = $monthly['id'];
	$Income = "<option value='$month-$year'>\$".$monthly['month_income'].'-'.$month .'/'.$year. "</option>" .$Income;
	$Expenese = "<option value='$month-$year'>\$".$monthly['monthly_expenese'].'-'.$month .'/'.$year. "</option>" .$Expenese;
}
if(isset($Expenese)) {
echo "<select name='MonthlyIncome' id='MonthlyIncome' style='font-size:30px;border-color:#5050FF;border-style: solid;border-width: 3px;color:red'>$Income</select>";
echo "<select name='MonthlyExpenese' id='MonthlyExpenese' style='font-size:30px;border-color:#5050FF;border-style: solid;border-width: 3px;color:red'>$Expenese</select>";
}
echo "<br/>";
$queryCashOnHand="SELECT * FROM spender where user_id = $GV_id";  // query string stored in a variable
$getCashOnHand=mysql_query($queryCashOnHand);          // query executed 
echo mysql_error();  
while($CashOnHand=mysql_fetch_array($getCashOnHand)){
	$spender_id = $CashOnHand['id'];
	echo "Money On Hand(".$optionSpender["$spender_id"]."): ".$CashOnHand['amt_onhand']."<br/>";
}
*/
?>
<div id="AddDialog">
	<table width="100%">
	<tr>
	<td align="center" id="dialog_text" style="font-size:30px;">Name</td>
	<td align="right"><input type="image" name="close" src="../images/close_icon.png" width="39" onclick="SetVisibleDiv('block'); AddInfor(0);"></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="text" name="input_text" id="input_text" value="" size="15" maxlength="30" style="font-size:30px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;"></td>
	</tr>	
	<tr id="adjustment">
	<td colspan="2" align="center">Balance Ajustment<input type="text" name="input_amount" id="input_amount"  value="0" size="15" maxlength="15" style="font-size:30px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;"></td>
	</tr>	
	<tr>
	<td align="center" id="insert"><input type="image" name="insert" src="../images/submit.jpg" onclick="SetVisibleDiv('block'); AddInfor(1);"></td>
	</tr>
	</table>
</div>
<div id="main">
	<table width="100%" style="font-size:25px;">
		<tr>
			<td align="right" width="150">Spender</td>
			<td width="60"><input type="image" src="../images/delete.jpg" name="DeleteSpender" value="Delete Spender" width="55px" onclick="RemoveSpender();return false;" style="position:relative;top:5px;"></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddSpender" value="Add Spender" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Spender Name',1);return false;">	</td>
			<td align="left">
			<select name="spender_id" id="spender_id" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;">
			<?php
				foreach($optionSpender as $spender_id=>$name) {
					echo "<option value='$spender_id'>$name</option>";
				}
			?>
			</select>
			</td>
			<td align="right">Category</td>
			<td width="60"><input type="image" src="../images/add.png" name="AddCategory" value="Add Category" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Category',2);return false;">	</td>
			<td align="left">
			<select name="category_id" id="category_id" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(3);">
			<?php
				foreach ($optionCategory as $category_id => $category) {
					echo "<option value='$category_id'"; if($category_id==7) echo "selected"; echo ">$category</option>";
				}
			?>
			</select>
			</td>		
		</tr>
		<tr id="item_comment">
			<td align="right">Description</td>
			<td width="60"></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddItem" value="Add Item" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Description',3);return false;">	</td>
			<td align="left">
			<select name="item_id" id="item_id" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="SetDisp(4);">
			<?php
				foreach ($optionItem as $item_id => $category_item) {
					echo "<option value='$item_id'"; if($item_id==7) echo "selected"; echo ">$category_item</option>";
				}
			?>
			</select>
			</td>
			<td align="right">Comment</td>
			<td width="60"><input type="image" src="../images/add.png" name="AddComment" value="Add Comment" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Comment',4);return false;">	</td>
			<td align="left">
			<select name="comment_id" id="comment_id" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;" onFocus="SetDisp(4);" onclick="SetDisp(4);">
			<option value='0' selected></option>"
			<?php
				if(isset($optionComment)) {
					foreach ($optionComment as $comment_id => $comment) {
						echo "<option value='$comment_id'>$comment</option>";
					}
				}
			?>
			</select>
			</td>			
		</tr>
		<tr>
			<td align="right">Payment Type</td>
			<td width="60"></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddType" value="Add Type" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Payment Type',5);return false;">	</td>
			<td align="left">
			<select name="payment_type" id="payment_type" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;">
			<?php
				foreach($optionType as $id=>$type) {
					echo "<option value='$id'>$type</option>";
				}
			?>
			</select>	
			</td>			
			<td align="right" colspan="2">Amount: $</td>
			<td align="left">
			<input type="text" name="amount" id="amount" maxlength="10" style="font-size:30px;width:245px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">Auto Recording</td>
			<td width="60"><input type="image" src="../images/add.png" name="AddRecorder" value="Add Recorder" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Frequency of Recording',6);return false;">	</td>
			<td align="left">
			<select name="frequency" id="frequency" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="DispDate(this.value);">
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
				<input type="image" src="../images/calendar.jpg" name="calender" id="calender" width="50px" style="display:none;" value="calender" onClick="GetDate(document.getElementById('start_date'));return false;">
			</td>
			<td align="left">
			<input type="text" name="start_date" id="start_date" maxlength="10" style="font-size:30px;width:240px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;display:none;">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2"><font id="bank_desc">Will Pay From</font></td>
			<td width="60"><input type="image" src="../images/add.png" name="AddBank" value="Add Bank" width="50px"  onclick="SetVisibleDiv('none');SetDialog('Bank',7);return false;">	</td>
			<td align="left">
			<select name="bank_id" id="bank_id" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;">
			<?php
				foreach($optionBank as $id=>$bank) {
					echo "<option value='$id'>$bank(Balance: $optionBalance[$id])</option>";
				}
			?>
			</select>
			</td>
			<td width="60"></td>
			<td width="60"><font id="to_bank_label" style="display:none;">TO:</font></td>
			<td align="left">
			<select name="to_bank" id="to_bank" style="font-size:30px;width:250px;border-color:#5050FF;border-width: 3px;display:none;">
			<?php
				foreach($optionBank as $id=>$bank) {
					echo "<option value='$id'>$bank(Balance: $optionBalance[$id])</option>";
				}
			?>
			</select>			
			</td>		
		</tr>		
		<tr>
			<td colspan="7">
			<input type="image" src="../images/save.jpg" name="Save" value="Save" width="7%" onclick="Save();">
			<input type="image" src="../images/more.jpg" name="Cancel" value="Cancel" width="7%" onClick="this.form.reset();window.open( 'MySpending.php', '_top');return false;">
<!--			<input type="image" src="../images/description.jpg" name="AddDesc" width="7%" style="position:relative;top:-50px;" value="Add Description" onClick="this.form.reset();window.open( 'NewDesc.php', '_top');return false;"> -->
			<input type="image" src="../images/subtract.png" name="subtract" value="-" width="5%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/dot.png" name="dot" value="." width="2%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/0.png" name="0" value="0" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/1.png" name="1" value="1" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/2.png" name="2" value="2" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/3.png" name="3" value="3" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/4.png" name="4" value="4" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/5.png" name="5" value="5" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/6.png" name="6" value="6" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/7.png" name="7" value="7" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/8.png" name="8" value="8" width="7%" onClick="setamount(this.value);return false;">
			<input type="image" src="../images/9.png" name="9" value="9" width="7%" onClick="setamount(this.value);return false;">
			</td>
		</tr>
	</table>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>
	<div id="Result">
		<table width="100%"  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
			<tr>
			<th style="font-size:30px;border-style: solid;border-color:#0000ff;border-width: 3px;">
			Category
			</th>	
			<th style="font-size:30px;border-style: solid;border-color:#0000ff;border-width: 3px;">
			Detail
			</th>
			<th style="font-size:30px;border-style: solid;border-color:#0000ff;border-width: 3px;">
			Total
			</th>	
			</tr>
			<?php	
			foreach($categoryTotal as $category_id=>$total){
				if($total >0 && $category_id != 1) {
				echo"
				<tr>
				<td style='font-size:60px;border-style: solid;border-color:#5050FF;border-width: 3px;text-align:center;'>
				$optionCategory[$category_id]
				</td>
				<td>
					<table width='100%' border='1'>";
					$Item_list = $itemTotal["$category_id"];
					foreach($Item_list as $item_id=>$Subtotal){
						$ItemResult4=mysql_query("SELECT * FROM `category_item` where category_id = $category_id and id = $item_id and (user_id = $GV_id or user_id = 0) limit 1");          // query executed 
						echo mysql_error();              // if any error is there that will be printed to the screen 
						while($option4 = mysql_fetch_array($ItemResult4)) {
							$category_item = $option4['category_item'];
						}	
					echo "
					<tr>	
					<td  style='font-size:30px;border-color:#5050FF;border-width: 3px;color:blue;'>
					$category_item
					</td>
					<td  style='font-size:30px;border-color:#5050FF;border-width: 3px;color:blue;text-align:right;'>
					$Subtotal
					</td>
					</tr>";
						}
					echo "
					</table>
				</td>
				<td style='font-size:60px;border-style: solid;border-color:#5050FF;border-width: 3px;text-align:center;'>
				$total
				</td>
				</tr>";
				}
			}	
			?>
		</table>	
		<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
			<tr>
			<th style='border-style: solid;border-width: 3px;text-align:right;'>
			<p>Date</p>
			</th>
			<th style='border-style: solid;border-width: 3px;text-align:right;'>
			<p>Category</p>
			</th>
			<th style='border-style: solid;border-width: 3px;text-align:right;'>
			<p>Description</p>
			</th>
			<th style='border-style: solid;border-width: 3px;text-align:right;'>
			<p>Comment</p>
			</th>
			<th style='border-style: solid;border-width: 3px;text-align:right;'>
			<p>Amount</p>
			</th>
			<th style='border-style: solid;border-width: 3px;text-align:right;'>
			<p>Spender</p>
			</th>
			</tr>
			<?php
			//$e = new endec();  
			while($nt=mysql_fetch_array($RangResult)){
				if($nt['category_id'] != 0) {
				$expenses = $e->new_decode($nt['expenses']);
				$category = $optionCategory[$nt['category_id']];
				$ItemResult5=mysql_query("SELECT * FROM `category_item` where category_id = $nt[category_id] and id = $nt[item_id] and (user_id = $GV_id or user_id = 0) limit 1");          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				while($option5 = mysql_fetch_array($ItemResult5)) {
					$category_item = $option5['category_item'];
				}	
				
			//	$category_item = $optionItem[$nt['item_id']];
				$queryComment = mysql_query("SELECT * FROM `sp_comment` where id = $nt[sp_comment_id] limit 1");
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
				<td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>";
				echo @substr($nt[date],-5);
			echo "	
				</td>
				<td align='right'  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
				$category
				</td>
				<td align='right'  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
				$category_item
				</td>
				<td align='right'  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
				$comment
				</td>
				<td align='right'  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
				$expenses
				</td>
				<td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
				$name
				</td>
			</tr>
			";
			}
			}
			?>
		</table>
	</div>
</div>	
</body>
</html>
	