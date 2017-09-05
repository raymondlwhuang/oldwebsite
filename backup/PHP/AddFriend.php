<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
include("../inc/GlobalVar.inc.php");

$is_active = 1;
//$allow_viewer_upload = 0;
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
mysql_query("DELETE FROM view_permission WHERE is_active = -2 and user_id=$GV_id");
mysql_query("update view_permission set is_active = 9 where user_id=$GV_id and is_active = -1");
$ViewerList1 = mysql_query("SELECT * FROM view_permission WHERE  owner_email = '$GV_email_address' and is_active=9");
while($nt1=mysql_fetch_array($ViewerList1)){
	$viewer_id=$nt1['id'];
	$owner_email1=$nt1['viewer_email'];
	$viewer_email1=$nt1['owner_email'];	
	$ViewerList2 = mysql_query("SELECT * FROM view_permission WHERE  owner_email = '$owner_email1' and viewer_email='$viewer_email1' and is_active>=0");
	while($nt2=mysql_fetch_array($ViewerList2)){
		$viewer_id2=$nt2['id'];
		$is_active2=$nt2['is_active'];
		mysql_query("update view_permission set is_active = 1 where id=$viewer_id");
		if($is_active2==9) mysql_query("update view_permission set is_active = 1 where id=$viewer_id2");
	}
}
if(isset($_POST['Delete_x']))
{
	$delete_viewer_id = mysql_real_escape_string($_REQUEST['delete_viewer_id']);
	mysql_query("DELETE from `view_permission` where user_id=$GV_id and viewer_id = $delete_viewer_id");
	mysql_close();
	echo "
        <script type=\"text/javascript\">
			window.open('AddFriend.php',target='_top');
        </script>";
	exit();		
}
elseif(isset($_POST['Save_x']))
{

	$viewer_email =  mysql_real_escape_string($_POST['viewer_email']);
	$first_name =  mysql_real_escape_string($_POST['first_name']);
	$last_name =  mysql_real_escape_string($_POST['last_name']);
	if(!filter_var((String) $viewer_email, FILTER_VALIDATE_EMAIL)) {
		$ErrorMessage = "** Invalide e-mail address! Please try again. **";
	}
	else if($GV_email_address == $viewer_email) {
		$viewer_email = $GV_email_address;
		$ErrorMessage = "**You don't have to set up for yourself! **";
	}
	else {
		$SaveCheck2 = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' AND viewer_email = '$viewer_email' and viewer_group = '' LIMIT 1";
		$result2 = mysql_query($SaveCheck2);
		if (mysql_num_rows($result2) > 0){
				$ErrorMessage = "**Duplicated Record. Please try again! **";
		}
		ELSE {
			$SaveCheck4 = "SELECT * FROM user WHERE email_address = '$viewer_email' LIMIT 1";
			$result4 = mysql_query($SaveCheck4);
			if (mysql_num_rows($result4) == 0){
				mysql_query("INSERT INTO user(email_address,first_name,last_name) VALUES('$viewer_email','$first_name','$last_name')");
				echo mysql_error(); 
				$SaveCheck3 = "SELECT * FROM user WHERE email_address = '$viewer_email' LIMIT 1";
				$result3 = mysql_query($SaveCheck3);
				while($pathresult = mysql_fetch_array($result3)) {
					$owner_path = $pathresult['first_name'].$pathresult['id'];
					$viewer_id= $pathresult['id'];
					mysql_query("UPDATE user SET owner_path='$owner_path' WHERE 1 ORDER BY id DESC LIMIT 1");
					echo mysql_error(); 
				}				
			}
			else {
				while($pathresult = mysql_fetch_array($result4)) {
					$viewer_id= $pathresult['id'];
				}				
			
			}
			mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,is_active,viewer_id,viewer_email,first_name,last_name) VALUES($GV_id,'$GV_email_address', '$GV_owner_path',9,$viewer_id,'$viewer_email','$first_name','$last_name')");
			mysql_close();
			echo "
				<script type=\"text/javascript\">
					window.open('AddFriend.php',target='_top');
				</script>";
			exit();
		}
	}
}
$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
$ViewerList=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Add Friend</title>
</head>
<body style="color:darkblue;">
<center>
<input type="image" src="../images/home.png" name="Home" value="Home" width="60" onClick="window.open('index.php',target='_top');">
<?php
if(mysql_num_rows($ViewerList) != 0) {
	echo "<input type=\"image\" src=\"../images/nextStep.png\" height=\"60px\" onClick=\"window.open('SetGroup.php',target='_top');\">";
}
?>
<br/>

<font color=red id="ErrorMessage"><b><?php if (isset($ErrorMessage)) { echo $ErrorMessage; } ?> </b></font>
<form name="FriendDel" method="Post">
<input type="hidden" name="delete_viewer_id" id="delete_viewer_id" value="">

<table>
	<tr>
    <td align="center" colspan="2" style="font-size:18px;font-weight:bold;">FRIEND(S) SET UP<br/><font color="red">(Please add friend and submit from below)</font></td>
	</tr>
	<tr>
    <td align="center" colspan="2" style="font-size:8px;">&nbsp;</td>
	</tr>
	<tr>
    <td align="right">
	First Name:
	</td>
    <td align="right">
	<input type="text" name="first_name" id="first_name" size="40"  value="">
	</td>
	</tr>
	<tr>
    <td align="right">
	Last Name:
	</td>
    <td align="right">
	<input type="text" name="last_name" id="last_name" size="40"  value="">
	</td>
	</tr>
	<tr>
    <td align="right">
	Friend's Email:
	</td>
    <td align="right" id="addemail">
	<input type="text" name="viewer_email" id="viewer_email" size="40"  value="">
	</td>
	<tr>
    <td align="right">
	</td>
    <td align="center">
	<input type='image' src='../images/submit.jpg' name="Save" value="Submit" width="100"  onClick="return formCheck(document.getElementById('viewer_email').value);">
	</td>
	</tr>
</table>    
<!--<input type ="button" name="Upload" value="Upload Photos/Videos"  disabled="disabled" > -->
<table border="1" width="370">
	<tr>
		<th colspan="3" align="center">Friend List(<?php echo mysql_num_rows($ViewerList) ?>)
		</th>
	</tr>
	<tr>
		<th width="40">
		</th>
		<th align='left' width="50">
		
		</th>	
		<th align='left'>
		</th>	
	</tr>	
<?php	
while($nt=mysql_fetch_array($ViewerList)){
	$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$nt[viewer_email]' limit 1"); /* get his/her friend infor */
	while($row = mysql_fetch_array($PictureResult)) {
		$profile_picture=$row['profile_picture'];
	}
echo "
<tr>
    <td align='left'>
	<input type='image' src='../images/delete.png' name='Delete' value='$nt[viewer_id]' onClick=\"document.getElementById('delete_viewer_id').value=this.value\">
	</td>
    <td align='left'>
	<img src=\"$profile_picture\" width='50px' /> 
	</td>
    <td align='left'>
	$nt[first_name]	$nt[last_name]
	</td></tr>";
}
?>
</table>
</form>
</center>
</body>
</html>
<script language="JavaScript">
function formCheck(email)	  
{
	if (document.FriendDel.first_name.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Please enter your friend's first name";
	   document.FriendDel.first_name.focus();
	   return false;
	}
	else if (document.FriendDel.viewer_email.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!Please try again.";
	   document.FriendDel.viewer_email.focus();
	   return false;
	}
	else {
		var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (!re.test(email)){
			document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!Please try again.";
			document.FriendDel.viewer_email.focus();
			return re.test(email);			
		}
	}
	return true;
}
</script>	

	