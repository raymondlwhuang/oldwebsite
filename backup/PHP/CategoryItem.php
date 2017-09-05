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
	$category_id =  (int)mysql_real_escape_string($_POST['category_id']);
	$category_item =  mysql_real_escape_string($_POST['category_item']);
	$SaveCheck = "SELECT * FROM category_item WHERE category_id = '$category_id' and category_item = '$category_item' LIMIT 1";
	$result2 = mysql_query($SaveCheck);
	if (mysql_num_rows($result2) > 0){
			$ErrorMessage = "** Duplication record **";
	}
	ELSE {
		mysql_query("INSERT INTO category_item(category_id,category_item) VALUES($category_id,'$category_item')");
		$GetDisplay = "SELECT * FROM category_item WHERE category_id = '$category_id' and category_item = '$category_item' LIMIT 1";
		$result3 = mysql_query($GetDisplay) or die(mysql_error());
		while($row = mysql_fetch_array($result3))
		{
		 $category_item=$row['category_item'];
		}
		unset($_POST['Save_x']);
		Header("Location: {$_SERVER['REQUEST_URI']}");
    }
}
$query="SELECT * FROM category_item where 1 order by category_id, category_item";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$GetCategory="SELECT * FROM spending_category where 1 order by category";  // query string stored in a variable
$CategoryResult=mysql_query($GetCategory);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($Category=mysql_fetch_array($CategoryResult)){
	$Category_Desc[$Category['id']] = $Category['category'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Adding category_item of My spending</title>
<style type="text/css"> 
input.wide {display:block; width: 100%} 
</style>
 <script type="text/javascript">
function ForceNumericInput(field,DotIncl) {
	if (DotIncl == true) {var regExpr = /^[0-9]*([\.]?)[0-9]*$/;} else var regExpr = /^[0-9]*$/;
	if (!regExpr.test(field.value)) {field.value = field.value.substr(0,field.value.length-1);}
}
 </script> 
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
		</tr>
		<tr>
			<td align="right">
			<select name="category_id" id="category_id" class="reqd"  style="font-size:40px;border-color:#ff0000;border-width: 7px;">
			<?php foreach ($Category_Desc as $category_id => $category){
				echo "<option value='$category_id'>$category</option>";
			}
			?>
			</select>
			</td>
		    <td align="left"><input type="text" name="category_item" class="wide" size="30" maxlength="30" style="font-size:40px;border-color:#ff0000 #0000ff;border-style:ridge;"  value=""></td>
			</tr>
	</table>
	<input type="image" src="../images/save.jpg" name="Save" value="Save" onclick="return confirm('Are you sure you want to add this item?')">
	<input type="image" src="../images/cancel.jpg" name="Cancel" value="Cancel" onClick="this.form.reset();">
	<input type="image" src="../images/back.png" name="back" value="Back" onclick="window.open( 'spcategory.php', '_top');return false;"><br/>
</form>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>
<table width="100%">
	<tr>
		<th style="border-style: solid;border-width: 3px;font-size:40px;">
		Category
		</th>		
		<th style="border-style: solid;border-width: 3px;font-size:40px;">
		Category Item
		</th>		
	</tr>
<?php	
while($nt=mysql_fetch_array($result)){
$Description = $Category_Desc[$nt['category_id']];
echo "
<tr>
    <td style='border-style: solid;border-width: 3px;border-color:#0000ff;border-style:ridge;text-align:right;'>
	$Description
	</td>
    <td style='border-style: solid;border-width: 3px;border-color:#0000ff;border-style:ridge;text-align:right;'>
	$nt[category_item]
	</td>
</tr>
";
}
?>
</table>
</body>
</html>
	