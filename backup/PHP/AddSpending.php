<?php
session_start();
include("../config.php");
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
	if($_POST['amount'] != 0)
	{
		$detail =  mysql_real_escape_string($_POST['detail']);
		$whospend = mysql_real_escape_string($_POST['whospend']);
		$amount =  (int)mysql_real_escape_string($_POST['amount']);
		$code =  mysql_real_escape_string($_POST['code']);
		mysql_query("INSERT INTO spending(detail,whospend,amount,code,date) VALUES('$detail', '$whospend', '$amount','$code',NOW())");
		$GetDisplay = "SELECT * FROM spending order by id DESC LIMIT 1";
		include("../txt/MySpending.txt");
		$inTwoMonths = 60 * 60 * 24 * 60 + time();
		setcookie( "searchID2", $searchID, $inTwoMonths, "", "", false, true );
		$_SESSION["searchID2"] = $searchID;
		 Header("Location: AddSpending.php");
		 die;
    } 
}
$todate = date('Y-m-d')."000000";
$replaceStr = array("-", ":", " ");
$todate = str_replace($replaceStr,"",$todate);
$fmdate = substr($todate,0,6)."01000000";
$daysdiff = date('d') + 1;
$query="SELECT * FROM spending where date = $todate";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
//$queryResult="SELECT sum(amount) as Total,code FROM spending where  date = $todate group by code";  // query string stored in a variable
//$queryResult="SELECT code,COUNT(*) AS codeCount,SUM(amount) AS Total,MAX(amount) AS Maximum FROM spending where  date = $todate and code !='09.Money to Elaine' group by code";
$queryResult="SELECT code,COUNT(*) AS codeCount,SUM(amount) AS Total,MAX(amount) AS Maximum FROM spending where  date between $fmdate and $todate and code !='09.Money to Elaine' group by code order by Total desc";
$totalResult=mysql_query($queryResult);  
$queryElaine="SELECT sum(amount) as Total,code FROM spending where whospend != 'M' group by code";  // query string stored in a variable
$totalElaine=mysql_query($queryElaine);          // query executed 
$GetDesc="SELECT * FROM spendcode where 1 order by description";  // query string stored in a variable
$Desc=mysql_query($GetDesc);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$queryMonth="SELECT * FROM spending where date between $fmdate and $todate order by date desc";  // query string stored in a variable
$RangResult=mysql_query($queryMonth);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Household Expenses Recorder</title>
<script type="text/javascript">
function setamount(number) {
document.MyForm.amount.value = document.MyForm.amount.value + '' + number;
}
</script>
<style type="text/css"> 
input.wide {display:block; width: 99%} 
</style> 
</head>
<body style="font-size:60px;">
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
echo '<select name="Monthly" id="Monthly" style="font-size:60px;border-color:#ff0000;border-style: solid;border-width: 3px;color:red">';
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
	<p style="font-size:60px; text-align:right">Description</p>
	</th>
	</tr>
	<tr>
    <td align="left">
	<select name="whospend" id="whospend" style="font-size:60px;border-color:#ff0000;border-width: 7px;">
	<option value="M" <?php if(isset($whospend) && htmlspecialchars($whospend) == "M") echo "selected"; ?>>Me</option>
	<option value="I" <?php if(isset($whospend) && htmlspecialchars($whospend) == "I") echo "selected"; ?>>EL</option>
	</select>
	</td>
    <td align="right">
	<select name="code" id="code" class="reqd"  style="font-size:60px;border-color:#ff0000;border-width: 7px;">
	<?php while($DescDisp=mysql_fetch_array($Desc)){
		echo "<option value='$DescDisp[description]'";
		if(isset($description) && htmlspecialchars($description) == $DescDisp[description]) echo "selected";
		echo ">$DescDisp[description]</option>";
	}
	?>
	</select>
	</td>
	</tr>
	<tr>
    <td colspan="2" align="right">
	<font style="font-size:100px;text-align:left;">Amount: $</font>
	<input type="text" name="amount" id="amount" size="5" maxlength="5" style="font-size:100px;text-align:left;border-style: solid;border-color:#ff0000;border-width: 7px;">
	</td>
	</tr>
	<tr>
    <td colspan="2" align="left"><input type="text" name="detail" class="wide"  maxlength="200" style="font-size:60px;border-color:#ff0000 #0000ff;"  value="<?php if (isset($detail)){ echo htmlspecialchars($detail); } else ''; ?>">
	</td>
	</tr>
	</table>
	<input type="image" src="../images/save.jpg" name="Save" value="Save">
	<input type="image" src="../images/more.jpg" name="Cancel" value="Cancel" onClick="this.form.reset();window.open( 'MySpending.php', '_top');return false;">
	<input type="image" src="../images/description.jpg" name="AddDesc" style="position:relative;top:-50px;" value="Add Description" height="150" onClick="this.form.reset();window.open( 'NewDesc.php', '_top');return false;"><br/>
<!--	<input type="image" src="../images/more.jpg" name="more" value="more" onclick="window.open( '../PHP/MySpending.php', '_top');return false;"><br/> -->
    <input type="image" src="../images/0.png" name="0" value="0" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/1.png" name="1" value="1" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/2.png" name="2" value="2" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/3.png" name="3" value="3" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/4.png" name="4" value="4" width="18%" onClick="setamount(this.value);return false;"><br/>
	<input type="image" src="../images/5.png" name="5" value="5" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/6.png" name="6" value="6" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/7.png" name="7" value="7" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/8.png" name="8" value="8" width="18%" onClick="setamount(this.value);return false;">
	<input type="image" src="../images/9.png" name="9" value="9" width="18%" onClick="setamount(this.value);return false;">
	</form>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>
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
    <td  style='font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;'>
	$Total[code]
	</td>
    <td  style='font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<font color = red><b>$Total[codeCount]</b></font>
	</td>	
    <td  style='font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;'>
	<font color = red><b>\$$Total[Maximum]</b></font>
	</td>	
    <td  style='font-size:20px;border-style: solid;border-color:#0000ff;border-width: 3px;'>
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
<table width="100%" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
    <th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Date</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Amt</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Description</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Who</p>
	</th>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Detail</p>
	</th>
	</tr>
<?php
while($nt=mysql_fetch_array($RangResult)){
echo "
<tr>
    <td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>";
	echo @substr($nt[date],-5);
echo "	
	</td>
	<td align='right'  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
	$nt[amount]
	</td>
	<td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
	$nt[code]
	</td>
	<td  style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
	";
	if (@$nt[whospend] == 'M') echo "ME"; 
	ELSE ECHO 'EL';	
echo "	
	</td>
<td style='font-size:40px;border-style: solid;border-width: 3px;text-align:right;'>
<font color = blue>$nt[detail]</font>
</td>
</tr>
";
}
?>
</table>
</body>
</html>
	