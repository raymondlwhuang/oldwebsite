<?php
session_start();
include("config.php");
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
if(isset($_GET['SearchDesc']))
{	
	$SearchDesc =  $_GET['SearchDesc'];	
	$GetDisplay = "SELECT * FROM spendcode WHERE description = '$SearchDesc' LIMIT 1";
	$result = mysql_query($GetDisplay);
	include("txt/ModifyDesc.txt");
	unset($_GET);
	unset($_POST);
}
if(isset($_POST['Delete_x']))
{	
	$searchID3 =  (int)$_POST['searchID'];
	$description =  $_POST['description'];
	mysql_query("DELETE FROM spendcode WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM spendcode where id < $searchID3 ORDER BY id DESC LIMIT 1";
	include("txt/ModifyDesc.txt");
	unset($_POST['Delete']);
	Header("Location: {$_SERVER['REQUEST_URI']}");
	die;
}
ELSEIF(isset($_POST['Previous_x']))
{
	$searchID3 =  (int)$_POST['searchID'];	
	$description =  $_POST['description'];
	$GetDisplay = "SELECT * FROM spendcode WHERE description < '$description' ORDER BY description DESC LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM spendcode WHERE description = '$description'";	
	}
	 include("txt/ModifyDesc.txt");
}
ELSEIF(isset($_POST['Next_x']))
{
	$searchID3 =  (int)$_POST['searchID'];
	$description =  $_POST['description'];
	$GetDisplay = "SELECT * FROM spendcode WHERE description > '$description' ORDER BY description ASC LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM spendcode WHERE description = '$description'";
	}					
	 include("txt/ModifyDesc.txt");
}
ELSEIF(isset($_POST['First_x']))
{
	$GetDisplay = "SELECT * FROM spendcode ORDER BY description ASC LIMIT 1";
	include("txt/ModifyDesc.txt");
}
ELSEIF(isset($_POST['Last_x']))
{
	$GetDisplay = "SELECT * FROM spendcode ORDER BY description DESC LIMIT 1";
	include("txt/ModifyDesc.txt");
} 
ELSEIF(isset($_POST['Save_x']))
{
	$description =  mysql_real_escape_string($_POST['description']);
	$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
	$description =  $_POST['description'];
	mysql_query("UPDATE spendcode SET description='$description' WHERE description = '$description'");
	$GetDisplay = "SELECT * FROM spendcode	where description = '$description' ORDER BY description LIMIT 1";
	include("txt/ModifyDesc.txt");
	unset($_POST['Save_x']);
	Header("Location: {$_SERVER['REQUEST_URI']}");
	die;
}
$query="SELECT * FROM spendcode where 1 order by description";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Modify/Viewing My Description</title>
<style type="text/css"> 
input.wide {display:block; width: 100%} 
</style>
</head>
<body style="font-size:60px;">
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
	<table width="100%">
		<tr>
		<th>
		<p style="font-size:60px; text-align:left">Description</p>
		</th>
		</tr>
		<tr>
		<td align="left"><input type="text" name="description"  class="wide" maxlength="200" style="font-size:60px;border-color:#ff0000 #0000ff;border-style:ridge;"  value="<?php if (isset($description)){ echo htmlspecialchars($description); } else ''; ?>">
		</td>
		</tr>
	</table>
	<input type="image" src="images/save.jpg" name="Save" value="Save"  width="190px" onclick="return confirm('Are you sure you want to save?')">
	<input type="image" src="images/cancel.jpg" name="Cancel" value="Cancel"  width="190px" onclick="this.form.reset();"> 
	<input type="image" src="images/delete.jpg" name="Delete" value="Delete" width="190px" onclick="return confirm('Are you sure you want to delete?')">
	<input type="image" src="images/add.png" name="Add" value="Add" width="190px"  onclick="window.open( 'NewDesc.php', '_top');return false;"><br/>
	<input type="image" src="images/first.jpg" name="First" value="First"> 
	<input type="image" src="images/previous.jpg" name="Previous" value="Previous"> 
	<input type="image" src="images/next.png" name="Next" value="Next"> 
	<input type="image" src="images/last.jpg" name="Last" value="Last">
	<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
</form>
	<p text-align="right" >
	<font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font>
	</p>
<table style="border-style: solid;border-width: 3px;" width="100%">
	<tr>
	<th style='border-style: solid;border-width: 3px;text-align:right;background-color:#DEDEDE;'>
	<p style="text-align:center;">Description</p>
	</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($result)){
echo "
<tr>
    <td style='border-style: solid;border-width: 3px;text-align:left;'>
	<a href='ModifyDesc.php?SearchDesc=$nt[description]'>$nt[description]</a>
	</td>
</tr>
";
}
?>
</table>
</body>
</html>
	