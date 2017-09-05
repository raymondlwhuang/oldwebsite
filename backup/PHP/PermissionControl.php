<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}

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
include("../inc/GlobalVar.inc.php");
$is_active = 1;
$allow_viewer_upload = 0;
if(isset($_POST['Delete']))
{	
	$searchID3 =  (int)$_POST['searchID'];
	$GetDelet = "SELECT * FROM view_permission WHERE id = $searchID3 ORDER BY id LIMIT 1";
	$Delet_result = mysql_query($GetDelet);
	echo mysql_error();
	while($row2 = mysql_fetch_array($Delet_result))
	{	
		mysql_query("DELETE FROM viewer_group WHERE owner_path = '$row2[owner_path]' and viewer_group = '$row2[viewer_group]'");
		echo mysql_error();
	}					
	mysql_query("DELETE FROM view_permission WHERE id = $searchID3");
    Header("Location: {$_SERVER['REQUEST_URI']}");
	die;
}
ELSEIF(isset($_POST['Previous']))
{
	$searchID3 =  (int)$_POST['searchID'];	
	$GetDisplay = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and id < $searchID3 ORDER BY id DESC LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and id = $searchID3";	
	}
	 include("../inc/PermissionControl.inc.php");
}
ELSEIF(isset($_POST['Next']))
{
	$searchID3 =  (int)$_POST['searchID'];
	$GetDisplay = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and id > $searchID3 ORDER BY id LIMIT 1";
	$result = mysql_query($GetDisplay);
	if (mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and id = $searchID3";
	}					
	 include("../inc/PermissionControl.inc.php");
}
ELSEIF(isset($_POST['First']))
{
	$GetDisplay = "SELECT * FROM view_permission where owner_email = '$GV_email_address' ORDER BY id ASC LIMIT 1";
	include("../inc/PermissionControl.inc.php");
}
ELSEIF(isset($_POST['Last']))
{
	$GetDisplay = "SELECT * FROM view_permission where owner_email = '$GV_email_address' ORDER BY id DESC LIMIT 1";
	include("../inc/PermissionControl.inc.php");
} 
ELSEIF(isset($_POST['Save']))
{
	$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
	$viewer_group =  mysql_real_escape_string($_POST['viewer_group']);
	$viewer_email =  mysql_real_escape_string($_POST['viewer_email']);
	$is_active =  (int)mysql_real_escape_string($_POST['is_active']);
	$allow_viewer_upload =  (int)mysql_real_escape_string($_POST['allow_viewer_upload']);
	$SaveCheck3 = "SELECT * FROM viewer_group WHERE owner_path = '$GV_owner_path' AND viewer_group = '$viewer_group' LIMIT 1";
	$result3 = mysql_query($SaveCheck3);
	if (mysql_num_rows($result3) > 0){
		mysql_query("UPDATE viewer_group SET allow_viewer_upload=$allow_viewer_upload WHERE owner_path = '$GV_owner_path' AND viewer_group = '$viewer_group'");
	}
	else {
		mysql_query("INSERT INTO viewer_group(owner_path,viewer_group,allow_viewer_upload) VALUES('$GV_owner_path', '$viewer_group', $allow_viewer_upload)");
	}	
	mysql_query("UPDATE view_permission SET is_active='$is_active',viewer_group = '$viewer_group', viewer_email='$viewer_email' WHERE id = $searchID3");
	$GetDisplay = "SELECT * FROM view_permission where id = $searchID3 ORDER BY id LIMIT 1";
	include("../inc/PermissionControl.inc.php");	
	$_SESSION['searchID2'] = $searchID;
	 Header("Location: {$_SERVER['REQUEST_URI']}");
	 die;
}
else 
{
	if(isset($_SESSION["searchID2"]))
	{	
		$searchID3 =  (int)$_SESSION["searchID2"];	
		$GetDisplay = "SELECT * FROM view_permission WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		unset ($_SESSION['searchID2'], $searchID2);
	}
	else if(isset($_GET['searchID']))
	{	
		$searchID3 =  (int)$_GET['searchID'];	
//		$allow_viewer_upload = (int)$_GET['allow_viewer_upload'];	
		$GetDisplay = "SELECT * FROM view_permission WHERE id = $searchID3";
		$result = mysql_query($GetDisplay);
		include("../inc/PermissionControl.inc.php");	
		unset($_GET);
		unset($_POST);
	}
	else{
		$GetDisplay = "SELECT *	FROM view_permission WHERE owner_email = '$GV_email_address' ORDER BY id desc LIMIT 1";
		$result=mysql_query($GetDisplay);          // query executed 
	}
	echo mysql_error();              // if any error is there that will be printed to the screen 
	include("../inc/PermissionControl.inc.php");	
}
	$viewer_group = '';
	if (@mysql_num_rows($result) == 0){
		$GetDisplay = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' ORDER BY id DESC LIMIT 1";
	}					
	include("../inc/PermissionControl.inc.php");
	$Group="SELECT allow_viewer_upload FROM viewer_group where owner_path = '$GV_owner_path' and viewer_group = '$viewer_group'";  // query string stored in a variable
	$allowed=mysql_query($Group);          // query executed 
	while($nt2=mysql_fetch_array($allowed)){
		$allow_viewer_upload = $nt2['allow_viewer_upload'];
	}
	$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' order by viewer_group";  // query string stored in a variable
	$ViewerList=mysql_query($query);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<title>My view_permission Reporter</title>
<script type="text/javascript" src="../scripts/passVarToPhp3.js"></script>
<style type="text/css">
.suggestions {
	background-color: #FF9;
	padding: 2px 6px;
	border: 1px solid #000;
}

.suggestions:hover {
	background-color: #69F;
}
#popups {
	display: none;
	padding: 5px;
	border: 1px #CC0 solid;
	clip: auto;
	overflow: hidden;	
}
#searchField.error {
	background-color: #FFC;
}
</style>
</head>
<body style="color:darkblue;">
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
<!--<input type="hidden" name="owner_email"  class="owner_email" value="<?php //if (isset($GV_email_address)){ echo htmlspecialchars($GV_email_address); } else ''; ?>"> -->
<table>
	<tr>
    <td align="right" colspan="2">Friend's Email:<input type="text" name="viewer_email" id="viewer_email" size="45"  value="<?php if (isset($viewer_email)){ echo htmlspecialchars($viewer_email); } else ''; ?>" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>>	</td>
	</tr>
	<tr>
    <td align="right" colspan="2">Group: <input type="text"  id="searchField" autocomplete="off" name="viewer_group" size="45" maxlength="30" id="viewer_group" value="<?php if (isset($viewer_group)){ echo htmlspecialchars($viewer_group); } else ''; ?>" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?> onKeyUp="this.value=this.value.trim();SendRequest('../search/ViewerGroup.php',this.value);"/></td>
	</tr>
	<tr>
    <td align="left">
	Permission?: <INPUT TYPE="checkbox" NAME="is_active" VALUE="1" <?php if (isset($is_active) && $is_active == 1){ echo 'checked'; } else echo ''; ?> readonly="readonly" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>>
	</td>
    <td align="left">
	Friend Uploadable?: <INPUT TYPE="checkbox" NAME="allow_viewer_upload" VALUE="1" <?php if (isset($allow_viewer_upload) && $allow_viewer_upload == 1){ echo 'checked'; } else echo ''; ?> readonly="readonly" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>>
	</td>
   </tr>  
</table>    
<input type ="submit" name="Save" value="Save" onclick="return confirm('Are you sure you want to save?')" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>>
<input type ="submit" name="Cancel" value="Cancel" onclick="this.form.reset();" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>>
<input type ="submit" name="Delete" value="Delete"  onclick="return confirm('Are you sure want to delete?');"  <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>> <!--disabled="disabled" -->
<input type ="submit" name="Add" value="Add" width="190px"  onclick="window.open( '../PHP/AddPermission.php', 'Permission');return false;"><br/>
<input type ="submit" name="First" value="First" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>> 
<input type ="submit" name="Previous" value="Previous" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>> 
<input type ="submit" name="Next" value="Next" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>> 
<input type ="submit" name="Last" value="Last" <?php if (mysql_num_rows($ViewerList) == 0) echo 'disabled="disabled"'; ?>> 
<!--<input type ="button" name="Upload" value="Upload Photos/Videos" onclick="window.open( '../PHP/MyBlogUpload.php', '_top');return false;" > -->
</form>
<table border="1">
	<tr>
		<th align='left'>
		Friend's Email
		</th>	
		<th align='left'>
		Group
		</th>	
		<th>
		Permission
		</th>
		<th>
		Friend Uploadable?
		</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($ViewerList)){
$Group="SELECT allow_viewer_upload FROM viewer_group where owner_path = '$GV_owner_path' and viewer_group = '$nt[viewer_group]'";  // query string stored in a variable
$allowed=mysql_query($Group);          // query executed 
while($nt2=mysql_fetch_array($allowed)){
	$allow_viewer_upload = $nt2['allow_viewer_upload'];
}
echo "
<tr>
    <td align='left'>
	<a href='../PHP/PermissionControl.php?searchID=$nt[id]'>$nt[viewer_email]</a>
	</td>
    <td align='left'>
	$nt[viewer_group]
	</td>
	<td align='center'>
	";
	if (@$nt[is_active] == '1') echo "Yes";
	ELSE echo "No";
echo "</td><td align='center'>";
	if ($allow_viewer_upload == '1') echo "Yes";
	ELSE echo "No";
echo "</td></tr>
";
}
?>
</table>
<script language="JavaScript">
window.open( "MyBlogUpload.php", "Upload");
document.getElementById("viewer_email").focus();
</script>
</body>
</html>