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
include("../config.php");
if(isset($_COOKIE['searchID2']) or isset($_REQUEST['searchID2']))
{
	if(isset($_COOKIE['searchID2'])) {$searchID2=(int)$_COOKIE['searchID2'];}
	ELSEIF(isset($_REQUEST['searchID2'])){$searchID2=(int)$_REQUEST['searchID2'];}
	$GetDisplay = "SELECT *	FROM main WHERE id = $searchID2 ORDER BY id LIMIT 1";
	include("RecordSet.php");
	setcookie("searchID2","",time() + 3600);
 }
ELSEIF(isset($_POST['searchID']))
{
	$searchID2 = (int)$_POST['searchID'];
	$GetDisplay = "SELECT * FROM main WHERE id = $searchID2 ORDER BY id  LIMIT 1";
	include("RecordSet.php");
}
if(isset($_POST['Delete']))
{	
	$searchID3 =  (int)$_POST['searchID'];
	mysql_query("DELETE FROM main WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM main where id < $searchID3 ORDER BY id DESC LIMIT 1";
	include("RecordSet.php");
}
ELSEIF(isset($_POST['Previous']))
{
	$searchID3 =  (int)$_POST['searchID'];	
	$GetDisplay = "SELECT * FROM main WHERE id < $searchID3 ORDER BY id DESC LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM main WHERE id = $searchID3";	
	}
	include("RecordSet.php");
}
ELSEIF(isset($_POST['Next']))
{
	$searchID3 =  (int)$_POST['searchID'];
	$GetDisplay = "SELECT * FROM main WHERE id > $searchID3 ORDER BY id LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM main WHERE id = $searchID3";
	}					
	include("RecordSet.php");
}
ELSEIF(isset($_POST['First']))
{
	$GetDisplay = "SELECT * FROM main ORDER BY id ASC LIMIT 1";
	include("RecordSet.php");
}
ELSEIF(isset($_POST['Last']))
{
	$GetDisplay = "SELECT * FROM main ORDER BY id DESC LIMIT 1";
	include("RecordSet.php");
} 
ELSEIF(isset($_POST['Save']))
{
	$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
	$ShortDesc = mysql_real_escape_string($_POST['ShortDesc']);
	$Source =  mysql_real_escape_string($_POST['Source']);
	$Name =  mysql_real_escape_string($_POST['Name']);
	$Ext =  mysql_real_escape_string($_POST['Ext']);
	$SearchGroup =  mysql_real_escape_string($_POST['SearchGroup']);
	mysql_query("UPDATE main SET ShortDesc='$ShortDesc', Source='$Source', 	Name='$Name', Ext='$Ext', SearchGroup='$SearchGroup' WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM main	where id = $searchID3 ORDER BY id LIMIT 1";
	include("RecordSet.php");	
	if($Ext == "php") $file = "../PHP/".$Name.".".$Ext;
	ELSE IF ($Ext == "html" || $Ext == "htm") $file = "../HTML/".$Name.".".$Ext;
	ELSE IF ($Ext == "js") $file = "../scripts/".$Name.".".$Ext;
	if($Ext == "php" || $Ext == "html" || $Ext == "htm" || $Ext == "js") file_put_contents($file, $Source);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<script type="text/javascript">
function setnametorun() {
	var select_list_field = document.getElementById('Ext');
	var select_list_selected_index = select_list_field.selectedIndex;

	var text = select_list_field.options[select_list_selected_index].text;
	if(text == "php") var value = "../PHP/"+document.getElementById("Name").value+'.'+select_list_field.value;
	else var value = "../HTML/"+document.getElementById("Name").value+'.'+select_list_field.value;
	if(text == "php" || text == "html" || text == "pdf") window.open(value);
	else if(text == "link") window.open(document.getElementById("Source").innerHTML);
	else alert('Example Only Available for php or html files!');
}
</script>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<script type="text/javascript" src="../scripts/passVarToPhp.js"></script>

<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<title>My Resouce Center</title>
<style type="text/css">
textarea { width: 100%; margin: 0; padding: 1%; border: 1px solid #38c; }
</style>
</head>
<body>
<form name="DescSearch" method="POST">
<input type="hidden" name="searchID" id="searchID" />
<div align="left">
  <table border="0">
    <tr>
      <td><p>Short Description:</p></td>
      <td><input type="text"  id="searchField" autocomplete="off" name="ShortDesc" size="100"  maxlength="200" id="ShortDesc" style="border: 1px solid #38c;" onFocus = "clearChoice();" onKeyUp="SendRequest('SearchShortDesc.php',document.getElementById('SearchGroup').value);"/></td>
      <td><img id="loader" src="images/loader.gif" style="vertical-align: middle; display: none" />
	  <input type="hidden" name="Submit" id="searchDone" value="Search" style="background : #AFDCEC ; width : 5em ;color:#04B404;"></td>
    </tr>
    <tr>
    <td colspan="3" align="left"><div id="popups"> </div></td>
    </tr>
  </table>
  </div>
</form>

<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<table width="98%">
  <tr>
	<td colspan="8"><input type="hidden" name="searchID" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>" readonly="readonly"></td>
  </tr>
  <tr>
    <td><p>Short Description:</p></td>
    <td colspan="7"><input type="text" name="ShortDesc" size="100" maxlength="200" style="border: 1px solid #38c;"  value="<?php if (isset($ShortDesc)){ echo htmlspecialchars($ShortDesc); } else ''; ?>"></td>
  </tr>
	<tr>
    <td colspan="8">
	<div class="container">
    <label class="textareaContainer">
	<textarea name="Source" id="Source" rows="36"><?php if (isset($Source)){ echo trim(htmlspecialchars($Source)); } else ''; ?></textarea>
	</label>
	</div>
	</td>	
   </tr>
  <tr>
    <td align="right"><p>Name:</p></td>
    <td width="20"><input type="text" name="Name" id="Name" size="15" maxlength="50" style="border: 1px solid #38c;"  value="<?php if (isset($Name)){ echo htmlspecialchars($Name); } else ''; ?>"></td>
    <td align="left" width="10"><p>Ext:</p></td>
    <td align="left" width="20">
	<select name="Ext" id="Ext" class="reqd" >
	   <option value="php" <?php if(isset($Ext) && htmlspecialchars($Ext) == "php") echo "selected"; ?>>php</option>
	   <option value="html" <?php if(isset($Ext) && htmlspecialchars($Ext) == "html") echo "selected"; ?>>html</option>
	   <option value="htm" <?php if(isset($Ext) && htmlspecialchars($Ext) == "htm") echo "selected"; ?>>htm</option>
	   <option value="pdf" <?php if(isset($Ext) && htmlspecialchars($Ext) == "pdf") echo "selected"; ?>>pdf</option>
	   <option value="js" <?php if(isset($Ext) && htmlspecialchars($Ext) == "js") echo "selected"; ?>>js</option>
	   <option value="txt" <?php if(isset($Ext) && htmlspecialchars($Ext) == "txt") echo "selected"; ?>>txt</option>
	   <option value="link" <?php if(isset($Ext) && htmlspecialchars($Ext) == "link") echo "selected"; ?>>link</option>
	 </select>		
	</td>
	<td align="left" width="15"><p>Group:</p></td>
    <td>
	<select name="SearchGroup" id="SearchGroup" class="reqd" >
	   <option value="" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "") echo "selected"; ?>>ALL</option>
	   <option value="php" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "php") echo "selected"; ?>>php</option>
	   <option value="phpmenu" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "phpmenu") echo "selected"; ?>>php menu</option>
	   <option value="html" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "html") echo "selected"; ?>>html</option>
	   <option value="htm" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "htm") echo "selected"; ?>>htm</option>
	   <option value="pdf" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "pdf") echo "selected"; ?>>pdf</option>
	   <option value="js" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "js") echo "selected"; ?>>js</option>
	   <option value="txt" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "txt") echo "selected"; ?>>txt</option>
	   <option value="link" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "link") echo "selected"; ?>>link</option>
	 </select>		
	</td> 
	<td colspan="2" width="60%">
	</td>
	</tr>  
</table>    
<input type="submit" name="Save" value="Save" onclick="return confirm('Are you sure you want to save?')">
<input type="reset" name="Cancel" value="Cancel">
<input type="submit" name="Delete" value="Delete" onclick="return confirm('Are you sure you want to delete?')">
<input type="submit" name="Previous" value="Previous">
<input type="submit" name="Next" value="Next">
<input type="submit" name="First" value="First">
<input type="submit" name="Last" value="Last">
<input type="button" name="Add" value="Add"  onClick="window.open( 'AddSource.php', '_top');return false;">
<input type="button" name="Example" value="Example"  onClick="setnametorun();return false;">
</form>
<?php 
echo <<<_END
<form method='post' enctype='multipart/form-data'>
Select a File to Upload:
<input type='file' name='filename' size='70%' style="border: 1px solid #38c;"/>
<input type='submit' value='Upload' /></form>
_END;

if ($_FILES)
{
	$name = $_FILES['filename']['name'];
	$ext = substr($name,strpos($name,".") + 1);
	if ($ext == 'pdf') $n = "pdf/".$name;
	else if ($ext == 'txt') $n = "../txt/".$name;
	else if ($ext == 'zip') $n = "../zip/".$name;
	else if ($ext == 'sql') $n = "../sql/".$name;
	else if ($ext == 'php') $n = "../PHP/".$name;
	else if ($ext == 'js') $n = "../scripts/".$name;
	else if ($ext == 'html') $n = "../HTML/".$name;
	else if ($ext == 'htm') $n = "../HTML/".$name;
	else $n = "images/".$name;
	if(!move_uploaded_file($_FILES['filename']['tmp_name'], $n))
	echo  "$ext Upload failed!";
	else echo  "$ext Uploaded file '$name' as '$n':<br />";
}
else echo "No file has been uploaded";

?>
<iframe src="http://raymondlwhuang.host56.com/MyHelpFile.php" width="30%" height="30%" style="position : fixed ; bottom: 0em ; right: 1em ;">
  <p>Your browser does not support iframes.</p>
</iframe>
</body>