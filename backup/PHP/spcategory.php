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
	$category =  mysql_real_escape_string($_POST['category']);

	$SaveCheck = "SELECT * FROM spending_category WHERE category = '$category' LIMIT 1";
	$result2 = mysql_query($SaveCheck);
	if (mysql_num_rows($result2) > 0){
			$ErrorMessage = "** Duplication record **";
	}
	ELSE {
		mysql_query("INSERT INTO spending_category(category) VALUES('$category')");
		$GetDisplay = "SELECT * FROM spending_category order by category LIMIT 1";
		$result = mysql_query($GetDisplay) or die(mysql_error());
		while($row = mysql_fetch_array($result))
		{
		 $category=$row['category'];
		}
		unset($_POST['Save_x']);
		Header("Location: {$_SERVER['REQUEST_URI']}");
    } 
}
$query="SELECT * FROM spending_category where 1 order by category";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Add Category of Household Expenses</title>
<style type="text/css"> 
input.wide {display:block; width: 100%} 
</style> 
</head>
<body style="font-size:60px;">
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
	<table width="100%">
		<tr>
		<th>
		<p style="font-size:60px; text-align:left">Category of Household Expenses</p>
		</th>
		</tr>
		<tr>
		<td align="left"><input type="text" name="category"  class="wide" maxlength="200" style="font-size:60px;border-color:#ff0000 #0000ff;border-style:ridge;"  value="">
		</td>
		</tr>
	</table>
	<input type="image" src="../images/save.jpg" name="Save" value="Save">
	<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel" onClick="this.form.reset();">
<!--	<input type="image" src="../images/more.jpg" name="more" value="more" onclick="window.open( 'ModifyCategory.php', '_top');return false;"> -->
	<input type="image" src="../images/back.png" name="back" value="Back" onclick="window.open( 'NewDesc.php', '_top');return false;"><br/>
</form>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>
<table width="100%" style="border-style: solid;border-width: 3px;">
	<tr>
	<th style='border-style: solid;border-width: 3px;text-align:right;'>
	<p>Category of Household Expenses</p>
	</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($result)){
echo "
<tr>
    <td style='border-style: solid;border-width: 3px;text-align:right;'>
	$nt[category]
	</td>
</tr>
";
}
?>
</table>
</body>
</html>
	