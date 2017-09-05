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
		$signature =  mysql_real_escape_string($_POST['signature']);
		$rewardid = mysql_real_escape_string($_POST['rewardid']);
		$amount =  (int)mysql_real_escape_string($_POST['amount']);
		mysql_query("INSERT INTO kidsreward(signature,rewardid,amount) VALUES('$signature', '$rewardid', '$amount')");
		$GetDisplay = "SELECT * FROM kidsreward order by id DESC LIMIT 1";
		include("../inc/KidsReward.inc.php");
		$inTwoMonths = 60 * 60 * 24 * 60 + time();
		setcookie( "searchID2", $searchID, $inTwoMonths, "", "", false, true );
		$_SESSION["searchID2"] = $searchID;
		 Header("Location: {$_SERVER['REQUEST_URI']}");
		 die;
    } 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Adding signature of My kidsreward</title>
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
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<table width="100%">
	<tr>
    <th>
	<p style="font-size:60px;text-align:left;">Reware To</p>
	</th>
	<th>
	<p style="font-size:60px; text-align:right">Description</p>
	</th>
	</tr>
	<tr>
    <td align="left">
	<select name="rewardid" id="rewardid" style="font-size:60px;border-color:#ff0000;border-width: 7px;">
	<option value="1" selected>Carly</option>
	<option value="2" >Jessica</option>
	</select>
	</td>
	</tr>
	<tr>
    <td colspan="2" align="right">
	<font style="font-size:100px;text-align:left;">Amount: $</font>
	<select name="amount" id="amount" style="font-size:60px;border-color:#ff0000;border-width: 7px;">
	<option value="0" selected>0</option>
	<option value="0.25">0.25</option>
	<option value="0.5">0.5</option>
	<option value="0.75">0.75</option>
	<option value="1">1</option>
	</select>	
	</td>
	</tr>
	<tr>
    <td colspan="2" align="left">
	<select name="signature" id="signature" style="font-size:60px;border-color:#ff0000;border-width: 7px;">
	<option value="0" selected>0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
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
	<option value="17">16</option>
	<option value="18">16</option>
	<option value="19">16</option>
	<option value="20">16</option>
	</select>
	</td>
	</tr>
	</table>
	<input type="image" src="../images/save.jpg" name="Save" value="Save">
	<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel" onClick="this.form.reset();">
	<input type="image" src="../images/more.jpg" name="more" value="more" onclick="window.open( '../PHP/Mykidsreward.php', '_top');return false;"><br/>
	</form>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>

</html>
	