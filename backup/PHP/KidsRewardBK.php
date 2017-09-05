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
IF(isset($_POST['Save_x']))
{
	$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
	$rewardid =  mysql_real_escape_string($_POST['rewardid']);
	$amountNow =  mysql_real_escape_string($_POST['amountNow']);
	$signatureNow = mysql_real_escape_string($_POST['signatureNow']);
	mysql_query("UPDATE kidsreward SET signature='$signatureNow', amount='$amountNow' WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM kidsreward	where id = $searchID3";
	include("../inc/KidsReward.inc.php");	
	Header("Location: {$_SERVER['REQUEST_URI']}");
	die;
}
else 
{
	if(isset($_GET['searchID']))
	{	
		$searchID3 =  (int)$_GET['searchID'];	
		$GetDisplay = "SELECT * FROM kidsreward WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		include("../inc/KidsReward.inc.php");
		unset($_GET);
		unset($_POST);
	}
	else {
		$GetDisplay = "SELECT * FROM kidsreward WHERE 1  ORDER BY id LIMIT 1";
		$result = mysql_query($GetDisplay);
		include("../inc/KidsReward.inc.php");
	}
}
	$GetResult = "SELECT *	FROM kidsreward WHERE 1";
	$ShowResult = mysql_query($GetResult) or die(mysql_error());
	echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<title>My kidsreward Reporter</title>
<script type="text/javascript">
var orgAmt = <?php echo $amount; ?>;
var orgsignature = <?php echo $signature; ?>;
window.onload = SetAmount;
function SetAmount() {
document.getElementById("amountNow").value = document.getElementById("amount1").value * document.getElementById("amount2").value + orgAmt * 1.00;
document.getElementById("signatureNow").value = document.getElementById("signature1").value * 1 + orgsignature * 1.00;
}
</script>

</head>
<body style="font-size:40px;">
<form name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
<table width="100%" border="1">
	<tr>
    <th>
	Reward To
	</th>
	<th align="center">
	Amount
	</th>
	<th align="center">
	Signature
	</th>
	</tr>
	<tr>
    <td align="center">
	<select name="rewardid" id="rewardid" style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;" onChange="SetAmount();">
	   <option value="1" <?php if((isset($rewardid) && htmlspecialchars($rewardid) == "1") || !isset($rewardid)) echo "selected"; ?>>Carly</option>
	   <option value="2" <?php if(isset($rewardid) && htmlspecialchars($rewardid) == "2") echo "selected"; ?>>Jessica</option>
	 </select>	
	</td>
	<td  align="center">
	<input type="text" name="amountNow" id="amountNow" size="5" maxlength="5"  style="border-color:#0000ff;border-style:ridge;font-size:50px;border-width: 7px;">
	</td>
	<td align="center">
	 <input type="text" name="signatureNow" id="signatureNow" size="2" style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;">
	</td>
  </tr>
  <tr>
    <td style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;">Reward Now</td>
	<td>
	<select name="amount1" id="amount1" style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;" onChange="SetAmount();">
	   <option value="0" selected>0</option>
	   <option value="0.25">0.25</option>
	   <option value="0.5" >0.50</option>
	   <option value="0.75" >0.75</option>
	   <option value="1" >1</option>
	 </select>	
	<select name="amount2" id="amount2" style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;" onChange="SetAmount();">
	   <option value="1">1</option>
	   <option value="2">2</option>
	   <option value="3">3</option>
	   <option value="4">4</option>
	   <option value="5">5</option>
	   <option value="-1">-1</option>
	   <option value="-2">-2</option>
	   <option value="-3">-3</option>
	   <option value="-4">-4</option>
	   <option value="-5">-5</option>
	   <option value="6">6</option>
	   <option value="7">7</option>
	   <option value="8">8</option>
	   <option value="9">9</option>
	   <option value="10">10</option>
	   <option value="11">11</option>
	   <option value="12">12</option>
	   <option value="13">13</option>
	   <option value="14">14</option>
	   <option value="15">15</option>
	   <option value="16">16</option>
	   <option value="17">17</option>
	   <option value="18">18</option>
	   <option value="19">19</option>
	   <option value="20">20</option>
	   <option value="-6">-6</option>
	   <option value="-7">-7</option>
	   <option value="-8">-8</option>
	   <option value="-9">-9</option>
	   <option value="-10">-10</option>
	   <option value="-11">-11</option>
	   <option value="-12">-12</option>
	   <option value="-13">-13</option>
	   <option value="-14">-14</option>
	   <option value="-15">-15</option>
	   <option value="-16">-16</option>
	   <option value="-17">-17</option>
	   <option value="-18">-18</option>
	   <option value="-19">-19</option>
	   <option value="-20">-20</option>
	 </select>
	<input type="text" name="amount" id="amount" size="5" maxlength="5"  style="border-color:#0000ff;border-style:ridge;font-size:50px;border-width: 7px;" onkeyup="ForceNumericInput(this,false);" style="border: 1px solid #38c;"  value="<?php if (isset($amount)){ echo htmlspecialchars($amount); } else ''; ?>" onChange="SetAmount();">
	 </td>
	<td>
	<select name="signature1" id="signature1" style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;" onChange="SetAmount();">
	   <option value="0" selected>0</option>
	   <option value="1">1</option>
	   <option value="2">2</option>
	   <option value="3">3</option>
	   <option value="4">4</option>
	   <option value="5">5</option>
	   <option value="-1">-1</option>
	   <option value="-2">-2</option>
	   <option value="-3">-3</option>
	   <option value="-4">-4</option>
	   <option value="-5">-5</option>
	   <option value="6">6</option>
	   <option value="7">7</option>
	   <option value="8">8</option>
	   <option value="9">9</option>
	   <option value="10">10</option>
	   <option value="11">11</option>
	   <option value="12">12</option>
	   <option value="13">13</option>
	   <option value="14">14</option>
	   <option value="15">15</option>
	   <option value="16">16</option>
	   <option value="17">17</option>
	   <option value="18">18</option>
	   <option value="19">19</option>
	   <option value="20">20</option>
	   <option value="-6">-6</option>
	   <option value="-7">-7</option>
	   <option value="-8">-8</option>
	   <option value="-9">-9</option>
	   <option value="-10">-10</option>
	   <option value="-11">-11</option>
	   <option value="-12">-12</option>
	   <option value="-13">-13</option>
	   <option value="-14">-14</option>
	   <option value="-15">-15</option>
	   <option value="-16">-16</option>
	   <option value="-17">-17</option>
	   <option value="-18">-18</option>
	   <option value="-19">-19</option>
	   <option value="-20">-20</option>
	 </select>	
	 <input type="text" name="signature" id="signature" size="2" style="font-size:50px;border-color:#0000ff;border-style:ridge;border-width: 7px;"  value="<?php if (isset($signature)){ echo htmlspecialchars($signature); } else ''; ?>" onChange="SetAmount();">
	 </td>
  </tr>
</table>    
<input type="image" src="../images/save.jpg" name="Save" value="Save"  width="190px" onclick="return confirm('Are you sure you want to save?')">
<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel"  width="190px" onclick="this.form.reset();"> 
<input type="image" src="../images/add.png" name="Add" value="Add" width="190px"  onclick="window.open( '../PHP/Addkidsreward.php', '_top');return false;"><br/>
</form>
<table   style='border-style: solid;border-color:#0000ff;border-width: 3px;' width="100%">
	<tr>
		<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
		<p>Reward To</p>
		</th>
		<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
		<p>Amount</p>
		</th>
		<th  style='border-style: solid;border-color:#0000ff;border-width: 3px;'>
		<p>Signature</p>
		</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($ShowResult)){
echo "<tr><td  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>";
	if (@$nt[rewardid] == '1') echo "<a href='../PHP/KidsReward.php?searchID=$nt[id]'>Carly</a>"; 
	ELSE ECHO "<a href='../PHP/KidsReward.php?searchID=$nt[id]'>Jessica</a>";	
echo "
	</td>
	<td align='right'  style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
	$nt[amount]
	</td>
<td style='border-style: solid;border-color:#0000ff;border-width: 3px;text-align:right;'>
<font color = blue>$nt[signature]</font>
</td>
</tr>
";
}
?>
</table>
</body>
</html>