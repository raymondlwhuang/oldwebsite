<?php
include("../config.php");
IF(isset($_POST['submit']))
{
	$fmdate = (float)($_POST['fmyear'].$_POST['fmmonth'].$_POST['fmday']."000000");
	$todate = (float)($_POST['toyear'].$_POST['tomonth'].$_POST['today']."000000");
$query="SELECT date, UNIX_TIMESTAMP(date) AS ut_date FROM spending where date between $fmdate and $todate";  // query string stored in a variable
$rt=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
echo '<table border=1>
	<tr>
    <th>
	<p>Date</p>
	</th>';
while($nt=mysql_fetch_array($rt)){
echo "
<tr>
    <td>
	$nt[date]
	</td>
</tr>
	";
}
}
/*
$fmdate = "2011-08-18";
$todate = "2011-08-22";
$fmdate = strtotime( $fmdate );
$fmdate = date( 'Y-m-d H:i:s', $fmdate );
$replaceStr = array("-", ":", " ");
$todate = strtotime( $todate );
$todate = date( 'Y-m-d H:i:s', $todate );
$fmdate1 = (float)str_replace($replaceStr,"",$fmdate);
$todate1 = (float)str_replace($replaceStr,"",$todate);

$query="SELECT date, UNIX_TIMESTAMP(date) AS ut_date FROM spending where date between $fmdate1 and $todate1";  // query string stored in a variable
$rt=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
*/
?>    		   

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
</head>
<body>

<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
Date Range From:<br/>
	<select name="fmmonth" id="fmmonth">
		<option value="01" <?php if(date("m") == "01"){ echo "selected"; } ?>>January</option>
		<option value="02" <?php if(date("m") == "02"){ echo "selected"; } ?>>February</option>
		<option value="03" <?php if(date("m") == "03"){ echo "selected"; } ?>>March</option>
		<option value="04" <?php if(date("m") == "04"){ echo "selected"; } ?>>April</option>
		<option value="05" <?php if(date("m") == "05"){ echo "selected"; } ?>>May</option>
		<option value="06" <?php if(date("m") == "06"){ echo "selected"; } ?>>June</option>
		<option value="07" <?php if(date("m") == "07"){ echo "selected"; } ?>>July</option>
		<option value="08" <?php if(date("m") == "08"){ echo "selected"; } ?>>August</option>
		<option value="09" <?php if(date("m") == "09"){ echo "selected"; } ?>>September</option>
		<option value="10" <?php if(date("m") == "10"){ echo "selected"; } ?>>October</option>
		<option value="11" <?php if(date("m") == "11"){ echo "selected"; } ?>>November</option>
		<option value="12" <?php if(date("m") == "12"){ echo "selected"; } ?>>December</option>
	</select>
	<select name="fmday" id="fmday">
		<option value="01" <?php if(date("d") == "01"){ echo "selected"; } ?>>01</option>
		<option value="02" <?php if(date("d") == "02"){ echo "selected"; } ?>>02</option>
		<option value="03" <?php if(date("d") == "03"){ echo "selected"; } ?>>03</option>
		<option value="04" <?php if(date("d") == "04"){ echo "selected"; } ?>>04</option>
		<option value="05" <?php if(date("d") == "05"){ echo "selected"; } ?>>05</option>
		<option value="06" <?php if(date("d") == "06"){ echo "selected"; } ?>>06</option>
		<option value="07" <?php if(date("d") == "07"){ echo "selected"; } ?>>07</option>
		<option value="08" <?php if(date("d") == "08"){ echo "selected"; } ?>>08</option>
		<option value="09" <?php if(date("d") == "09"){ echo "selected"; } ?>>09</option>
		<option value="10" <?php if(date("d") == "10"){ echo "selected"; } ?>>10</option>
		<option value="11" <?php if(date("d") == "11"){ echo "selected"; } ?>>11</option>
		<option value="12" <?php if(date("d") == "12"){ echo "selected"; } ?>>12</option>
		<option value="13" <?php if(date("d") == "13"){ echo "selected"; } ?>>13</option>
		<option value="14" <?php if(date("d") == "14"){ echo "selected"; } ?>>14</option>
		<option value="15" <?php if(date("d") == "15"){ echo "selected"; } ?>>15</option>
		<option value="16" <?php if(date("d") == "16"){ echo "selected"; } ?>>16</option>
		<option value="17" <?php if(date("d") == "17"){ echo "selected"; } ?>>17</option>
		<option value="18" <?php if(date("d") == "18"){ echo "selected"; } ?>>18</option>
		<option value="19" <?php if(date("d") == "19"){ echo "selected"; } ?>>19</option>
		<option value="20" <?php if(date("d") == "20"){ echo "selected"; } ?>>20</option>
		<option value="21" <?php if(date("d") == "21"){ echo "selected"; } ?>>21</option>
		<option value="22" <?php if(date("d") == "22"){ echo "selected"; } ?>>22</option>
		<option value="23" <?php if(date("d") == "23"){ echo "selected"; } ?>>23</option>
		<option value="24" <?php if(date("d") == "24"){ echo "selected"; } ?>>24</option>
		<option value="25" <?php if(date("d") == "25"){ echo "selected"; } ?>>25</option>
		<option value="26" <?php if(date("d") == "26"){ echo "selected"; } ?>>26</option>
		<option value="27" <?php if(date("d") == "27"){ echo "selected"; } ?>>27</option>
		<option value="28" <?php if(date("d") == "28"){ echo "selected"; } ?>>28</option>
		<option value="29" <?php if(date("d") == "29"){ echo "selected"; } ?>>29</option>
		<option value="30" <?php if(date("d") == "30"){ echo "selected"; } ?>>30</option>
		<option value="31" <?php if(date("d") == "31"){ echo "selected"; } ?>>31</option>
	</select>
	<select name="fmyear" id="fmyear">
	    <option value = "2011" <?php if(date("Y") == "2011"){ echo "selected"; } ?>>2011</option>
		<option value = "2012" <?php if(date("Y") == "2012"){ echo "selected"; } ?>>2012</option>
		<option value = "2013" <?php if(date("Y") == "2013"){ echo "selected"; } ?>>2013</option>
		<option value = "2014" <?php if(date("Y") == "2014"){ echo "selected"; } ?>>2014</option>
		<option value = "2015" <?php if(date("Y") == "2015"){ echo "selected"; } ?>>2015</option>
		<option value = "2016" <?php if(date("Y") == "2016"){ echo "selected"; } ?>>2016</option>
		<option value = "2017" <?php if(date("Y") == "2017"){ echo "selected"; } ?>>2017</option>
		<option value = "2018" <?php if(date("Y") == "2018"){ echo "selected"; } ?>>2018</option>
		<option value = "2019" <?php if(date("Y") == "2019"){ echo "selected"; } ?>>2019</option>
		<option value = "2020" <?php if(date("Y") == "2020"){ echo "selected"; } ?>>2020</option>
	</select>
<br/>To:<br/>
	<select name="tomonth" id="tomonth">
		<option value="01" <?php if(date("m") == "01"){ echo "selected"; } ?>>January</option>
		<option value="02" <?php if(date("m") == "02"){ echo "selected"; } ?>>February</option>
		<option value="03" <?php if(date("m") == "03"){ echo "selected"; } ?>>March</option>
		<option value="04" <?php if(date("m") == "04"){ echo "selected"; } ?>>April</option>
		<option value="05" <?php if(date("m") == "05"){ echo "selected"; } ?>>May</option>
		<option value="06" <?php if(date("m") == "06"){ echo "selected"; } ?>>June</option>
		<option value="07" <?php if(date("m") == "07"){ echo "selected"; } ?>>July</option>
		<option value="08" <?php if(date("m") == "08"){ echo "selected"; } ?>>August</option>
		<option value="09" <?php if(date("m") == "09"){ echo "selected"; } ?>>September</option>
		<option value="10" <?php if(date("m") == "10"){ echo "selected"; } ?>>October</option>
		<option value="11" <?php if(date("m") == "11"){ echo "selected"; } ?>>November</option>
		<option value="12" <?php if(date("m") == "12"){ echo "selected"; } ?>>December</option>
	</select>
	<select name="today" id="today">
		<option value="01" <?php if(date("d") == "01"){ echo "selected"; } ?>>01</option>
		<option value="02" <?php if(date("d") == "02"){ echo "selected"; } ?>>02</option>
		<option value="03" <?php if(date("d") == "03"){ echo "selected"; } ?>>03</option>
		<option value="04" <?php if(date("d") == "04"){ echo "selected"; } ?>>04</option>
		<option value="05" <?php if(date("d") == "05"){ echo "selected"; } ?>>05</option>
		<option value="06" <?php if(date("d") == "06"){ echo "selected"; } ?>>06</option>
		<option value="07" <?php if(date("d") == "07"){ echo "selected"; } ?>>07</option>
		<option value="08" <?php if(date("d") == "08"){ echo "selected"; } ?>>08</option>
		<option value="09" <?php if(date("d") == "09"){ echo "selected"; } ?>>09</option>
		<option value="10" <?php if(date("d") == "10"){ echo "selected"; } ?>>10</option>
		<option value="11" <?php if(date("d") == "11"){ echo "selected"; } ?>>11</option>
		<option value="12" <?php if(date("d") == "12"){ echo "selected"; } ?>>12</option>
		<option value="13" <?php if(date("d") == "13"){ echo "selected"; } ?>>13</option>
		<option value="14" <?php if(date("d") == "14"){ echo "selected"; } ?>>14</option>
		<option value="15" <?php if(date("d") == "15"){ echo "selected"; } ?>>15</option>
		<option value="16" <?php if(date("d") == "16"){ echo "selected"; } ?>>16</option>
		<option value="17" <?php if(date("d") == "17"){ echo "selected"; } ?>>17</option>
		<option value="18" <?php if(date("d") == "18"){ echo "selected"; } ?>>18</option>
		<option value="19" <?php if(date("d") == "19"){ echo "selected"; } ?>>19</option>
		<option value="20" <?php if(date("d") == "20"){ echo "selected"; } ?>>20</option>
		<option value="21" <?php if(date("d") == "21"){ echo "selected"; } ?>>21</option>
		<option value="22" <?php if(date("d") == "22"){ echo "selected"; } ?>>22</option>
		<option value="23" <?php if(date("d") == "23"){ echo "selected"; } ?>>23</option>
		<option value="24" <?php if(date("d") == "24"){ echo "selected"; } ?>>24</option>
		<option value="25" <?php if(date("d") == "25"){ echo "selected"; } ?>>25</option>
		<option value="26" <?php if(date("d") == "26"){ echo "selected"; } ?>>26</option>
		<option value="27" <?php if(date("d") == "27"){ echo "selected"; } ?>>27</option>
		<option value="28" <?php if(date("d") == "28"){ echo "selected"; } ?>>28</option>
		<option value="29" <?php if(date("d") == "29"){ echo "selected"; } ?>>29</option>
		<option value="30" <?php if(date("d") == "30"){ echo "selected"; } ?>>30</option>
		<option value="31" <?php if(date("d") == "31"){ echo "selected"; } ?>>31</option>
	</select>
	<select name="toyear" id="toyear">
	    <option value = "2011" <?php if(date("Y") == "2011"){ echo "selected"; } ?>>2011</option>
		<option value = "2012" <?php if(date("Y") == "2012"){ echo "selected"; } ?>>2012</option>
		<option value = "2013" <?php if(date("Y") == "2013"){ echo "selected"; } ?>>2013</option>
		<option value = "2014" <?php if(date("Y") == "2014"){ echo "selected"; } ?>>2014</option>
		<option value = "2015" <?php if(date("Y") == "2015"){ echo "selected"; } ?>>2015</option>
		<option value = "2016" <?php if(date("Y") == "2016"){ echo "selected"; } ?>>2016</option>
		<option value = "2017" <?php if(date("Y") == "2017"){ echo "selected"; } ?>>2017</option>
		<option value = "2018" <?php if(date("Y") == "2018"){ echo "selected"; } ?>>2018</option>
		<option value = "2019" <?php if(date("Y") == "2019"){ echo "selected"; } ?>>2019</option>
		<option value = "2020" <?php if(date("Y") == "2020"){ echo "selected"; } ?>>2020</option>
	</select>
	<br/>
	<input type="submit" name="submit" value="submit">
</form>
</body>
</html>		