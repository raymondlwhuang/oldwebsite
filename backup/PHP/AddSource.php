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
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
if(isset($_POST['Save']))
{
	include("../config.php");
	$ShortDesc =  mysql_real_escape_string($_POST['ShortDesc']);
	$Source = mysql_real_escape_string($_POST['Source']);
	$Name =  mysql_real_escape_string($_POST['Name']);
	$Ext =  mysql_real_escape_string($_POST['Ext']);
	$SearchGroup =  mysql_real_escape_string($_POST['SearchGroup']);
	$SaveCheck = "SELECT * FROM main WHERE Name = '$Name' AND Ext = '$Ext' AND SearchGroup = '$SearchGroup' LIMIT 1";
	echo mysql_error(); 
	$result2 = mysql_query($SaveCheck);
	if (mysql_num_rows($result2) > 0){
			$ErrorMessage = "**Duplication record(Name: $Name, Ext: $Ext, Group: $SearchGroup)**";
	}
	ELSE {
			mysql_query("INSERT INTO main(ShortDesc,Source,Name,Ext,SearchGroup) VALUES('$ShortDesc', '$Source', '$Name','$Ext','$SearchGroup')");
			echo mysql_error(); 
			$GetDisplay = "SELECT * FROM main where Name = '$Name' AND Ext = '$Ext' AND SearchGroup = '$SearchGroup' LIMIT 1";
			echo mysql_error(); 
			include("RecordSet.php");
			if($Ext == "php") $file = "../PHP/".$Name.".".$Ext;
			ELSE IF ($Ext == "html" || $Ext == "htm") $file = "../HTML/".$Name.".".$Ext;
			ELSE IF ($Ext == "js") $file = "../scripts/".$Name.".".$Ext;
			if($Ext == "php" || $Ext == "html" || $Ext == "htm" || $Ext == "js") file_put_contents($file, $Source);
			$inTwoMonths = 60 * 60 * 24 * 60 + time();
			setcookie( "searchID2", $searchID, $inTwoMonths, "", "", false, true );
			mysql_close();
	} /* SaveCheck.RecordCount */	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<script type="text/javascript" src="../scripts/AddSource.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
</head>
<body>


<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<p text-align="right" ><font color=red><b><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></b></font></p><br>
<br>
<table>
  <tr>
    <td><p>Short Description:</p></td>
    <td colspan="4"><input type="text" name="ShortDesc" size="100" maxlength="100"  value="<?php if (isset($ShortDesc)){ echo htmlspecialchars($ShortDesc); } else ''; ?>" id="ShortDesc" class="reqd"></td>
  </tr>
	<tr>
    <td colspan="5">
	<textarea rows="36" cols="200" name="Source" class="reqd">
	<?php if (isset($Source)){ echo htmlspecialchars($Source); } else ''; ?>
	</textarea></td>
   </tr>
  <tr>
    <td align="right"><p>Name:</p></td>
    <td width="20"><input type="text" name="Name" size="15" maxlength="50" value="<?php if (isset($Name)){ echo htmlspecialchars($Name); } else ''; ?>" id="Name" class="reqd"></td>
    <td align="left" width="10"><p>Ext:</p></td>
    <td>
	<select name="Ext" id="Ext" class="reqd">
	   <option value="php" selected>php</option>
	   <option value="html">html</option>
	   <option value="htm">htm</option>
	   <option value="pdf">pdf</option>
	   <option value="js">js</option>
	   <option value="txt">txt</option>
	   <option value="link">link</option>
	 </select>	
	</td>
    <td>
	<select name="SearchGroup" id="SearchGroup" class="reqd">
	   <option value="" selected>ALL</option>
	   <option value="php">php</option>
	   <option value="phpmenu">php Menu</option>
	   <option value="html">html</option>
	   <option value="htm">htm</option>
	   <option value="pdf">pdf</option>
	   <option value="js">js</option>
	   <option value="txt">txt</option>
	   <option value="link">link</option>
	 </select>	
	</td>  </tr>
</table>
<input type="Submit" name="Save" value="Save">
<input type="button" name="Cancel" value="Cancel" onClick="window.open( 'ResultDisp.php', '_top');return false;">
</form>
</body>
</html>