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
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' or viewer_email = '$GV_email_address'");
while($option = mysql_fetch_array($FriendResult)) {
	if($option['owner_email'] != "$GV_email_address") $cur_email = $option['owner_email'];
	else $cur_email = $option['viewer_email'];
	$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$cur_email'");
	while($Picture = mysql_fetch_array($PictureResult)) {
		$profile_picture = $Picture['profile_picture'];
		$name = $Picture['first_name']." ".$Picture['last_name'];
	}
	
	if(!isset($optionEmail)) {
		$optionEmail[] = $cur_email;
		$optionPicture[] = $profile_picture;
		$optionName[] = $name;
	}
	else {
		$duplicated = false;
		foreach($optionEmail as $id=>$email) {
			if($email==$cur_email) $duplicated = true;
		}
		if($duplicated == false){
			$optionEmail[] = $cur_email;
			$optionPicture[] = $profile_picture;
			$optionName[] = $name;
		}
	}
}
if(isset($_POST['Delete_x']))
{
	$delete_id = (int)mysql_real_escape_string($_REQUEST['delete_id']);
	mysql_query("DELETE from `view_permission` where id = $delete_id limit 1");
	mysql_close();
	Header("Location: AddPermission.php");
	die;
	
}
elseif(isset($_POST['Save_x']))
{
	if(isset($_POST['is_active']))	$is_active =  (int)mysql_real_escape_string($_POST['is_active']);
	else $is_active = 1;
//	if(isset($_POST['allow_viewer_upload']))	$allow_viewer_upload =  (int)mysql_real_escape_string($_POST['allow_viewer_upload']);
//	else $allow_viewer_upload = 0;
	$viewer_group =  mysql_real_escape_string($_POST['viewer_group']);
	$viewer_email =  mysql_real_escape_string($_POST['viewer_email']);
	$username =  mysql_real_escape_string($_POST['name']);
	if(!filter_var((String) $viewer_email, FILTER_VALIDATE_EMAIL)) {
		$ErrorMessage = "** Invalide e-mail address! Please try again. **";
	}
	else if($GV_email_address == $viewer_email) {
		$viewer_email = $GV_email_address;
		$ErrorMessage = "**You don't have to set up for yourself! **";
	}
	else {
		$SaveCheck2 = "SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' AND viewer_email = '$viewer_email' and viewer_group = '$viewer_group' LIMIT 1";
		$result2 = mysql_query($SaveCheck2);
		if (mysql_num_rows($result2) > 0){
				$ErrorMessage = "**Duplicated Record. Please try again! **";
		}
		ELSE {
			mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,viewer_group,is_active,viewer_email,name) VALUES($GV_id,'$GV_email_address', '$GV_owner_path', '$viewer_group', $is_active,'$viewer_email','$username')");
			$SaveCheck4 = "SELECT * FROM user WHERE email_address = '$viewer_email' LIMIT 1";
			$result4 = mysql_query($SaveCheck4);
			if (mysql_num_rows($result4) == 0){
				mysql_query("INSERT INTO user(email_address,first_name,username) VALUES('$viewer_email','$username','$username')");
						$todaydate = date("l, F j, Y, g:i a");
						$to = $viewer_email;
						$websit = $_SERVER['HTTP_HOST'];
			//			$to = "raymondlwhuang@gmail.com,raymondlwhuang@yahoo.com";
						$cc = "";
						$subject = "Invitation";
						$headers = "From: $GV_email_address\r\n";
						$headers .= "Reply-To: $GV_email_address\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$bodyText = '<html><body>';
						$bodyText .= "<h1>Your friend invite you to join this site<br/>";
						$bodyText .= "Sent at: $todaydate</h1><br/>";
						$bodyText .= "<br/><a href='$websit' >Click here to join</a><br/>";
						$bodyText .= '</body></html>';
						if (preg_match("/bcc:/i", $viewer_email . " " . $bodyText) == 0 &&          /* check for injected 'bcc' field */
							preg_match("/Content-Type:/i", $viewer_email . " " . $bodyText) == 0 && /* check for injected 'content-type' field */
							preg_match("/cc:/i", $viewer_email . " " . $bodyText) == 0 &&           /* check for injected 'cc' field */
							preg_match("/to:/i", $viewer_email . " " . $bodyText) == 0) {           /* check for injected 'to' field */
							// Format the body of the email
							$sent = @mail($to, $subject, $bodyText, $headers) ;
						} else  {
							$message = "We encountered an error sending your mail<br/>";
						}
			}			
			mysql_close();
			Header("Location: AddPermission.php");
			die;
		}
	}
}
$query="SELECT * FROM view_permission where owner_email = '$GV_email_address'";  // query string stored in a variable
$ViewerList=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Add Friend</title>
<style type="text/css" media="screen">
div.menu1 {
	margin-bottom: 10px;
}

ul {
	display: none;
	list-style-type: none;
	margin-top: 5px;
}

ul > li > a:hover {background: #736F6E;}

div.menu1 > p {
	display: block;
	width: 320px;
	background: #FFFFFF;
	border: 2px outset;
	margin:0
 }
 
div.menu1 > p:hover  {  border: 2px inset;background: #FFFFFF; border-color: #736F6E;color:white  }

</style>
</head>
<body style="color:darkblue;">
<center>
<input type="image" src="../images/home.png" name="Home" value="Home" width="40" onClick="window.open('index.php',target='_top');"><br/>
<font color=red id="ErrorMessage"><b><?php if (isset($ErrorMessage)) { echo $ErrorMessage; } ?> </b></font>
<form name="DescSearch" method="Post">
<input type="hidden" name="owner_email"  value="<?php if (isset($GV_email_address)){ echo htmlspecialchars($GV_email_address); } else ''; ?>">
<input type="hidden" name="viewer_email" id="viewer_email" value="">
<input type="hidden" name="delete_id" id="delete_id" value="">

<table>
	<tr>
    <td align="center" colspan="4" style="font-size:18px;font-weight:bold;"><font color="blue">STEP 1:</font> FRIEND(S) AND GROUP(S) SET UP</td>
	</tr>
	<tr>
    <td align="center" colspan="4" style="font-size:8px;"><font color="blue">&nbsp;</font></td>
	</tr>
	<tr>
    <td align="right">Group: </td><td align="right"><input type="text"  id="searchField" name="viewer_group" size="13" maxlength="30" id="viewer_group" style="border: 1px solid #38c;"/></td>
    <td align="right"><INPUT TYPE="checkbox" NAME="is_active" VALUE="1" checked></td><td align="left">Can Chat to me</td>
	</tr>
	<tr>
    <td align="right" colspan="4">
	Name:<input type="text" name="name" id="name" size="40"  value="">
	</td>
	</tr>
	<tr>
    <td align="right" colspan="4" id="addemail">
	Friend's Email:<input type="text" name="email" id="email" size="40"  value="" onBlur="document.getElementById('viewer_email').value=this.value;">
	</td>
	</tr>
	<td colspan="4">Or Select Friend:
			<div class="menu1">
				<p><img src='../images/profile/default_profile.png'  height='50px' id="picked" />
				<img src='../images/down_arrow.jpg'  width='50px'/><span id="picked_owner" >
				Enter above or Choose here</span></p>
				<ul style="display: none;text-align:left;" id="menu1">
				<li><a href="" onClick="document.getElementById('addemail').style.display='block';clearfield('../images/profile/default_profile.png','Enter above or Choose here','');return false;"><img src='../images/profile/default_profile.png'  width='50px'/></a>Not in list! Will enter one</li>

	<?php
		if(isset($optionEmail)) {
			foreach ($optionEmail as $id => $friendemail) {
	echo <<<_END
	<li><a href="" onClick="document.getElementById('addemail').style.display='none';clearfield('$optionPicture[$id]','$optionName[$id]','$friendemail');document.getElementById('searchField').focus();return false;">
	<img src='$optionPicture[$id]'  width='50px'/></a>$optionName[$id]</li>
_END;

			}
		}
			?>	
				</ul>
			</div>			
			
			
	</td>
   </tr> 	
	<tr>
    <td align="center" colspan="4">
	<input type='image' src='../images/submit.jpg' name="Save" value="Submit" width="30%"  onClick="return formCheck(document.getElementById('viewer_email').value);">
	</td>
	</tr>
</table> 
<?php
foreach ($optionEmail as $id => $friendemail) {
	echo "<input type=\"image\" src=\"$optionPicture[$id]\" name=\"$optionName[$id]\" value=\"$friendemail\" width=\"50px\">$optionName[$id]";

}
?>   
<!--<input type ="button" name="Upload" value="Upload Photos/Videos"  disabled="disabled" > -->
<font id="Result">
<table border="1">
	<tr>
		<th>
		</th>
		<th align='left'>
		Friend's Name
		</th>	
		<th align='left'>
		Group
		</th>	
		<th>
		Can Chat With?
		</th>
	</tr>
<?php	
while($nt=mysql_fetch_array($ViewerList)){
echo "
<tr>
    <td align='left'>
	<input type='image' src='../images/delete.png' name='Delete' value='$nt[id]' onClick=\"document.getElementById('delete_id').value=this.value\">
	</td>
    <td align='left'>
	$nt[name]
	</td>
    <td align='left'>
	$nt[viewer_group]
	</td>
	<td align='center'>
	
	";
	if ($nt['is_active'] == '1') echo "Yes";
	ELSE echo "No";
echo "</td></tr>
";
}
?>
</table>
</form>

</font>
</center>
</body>
</html>
<script language="JavaScript">
var owner_path = "<?php echo $GV_owner_path; ?>";
function formCheck(email)	  
{
	document.DescSearch.viewer_group.value = document.DescSearch.viewer_group.value.trim();
	if(document.DescSearch.viewer_group.value.indexOf(" ") > 0 )
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Viewer Group must be single word";
	   return false;
	}	
	if (document.DescSearch.name.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Please enter your friend's name";
	   return false;
	}
	else if (document.DescSearch.viewer_email.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!Please try again.";
	   return false;
	}
	else {
		var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (!re.test(email)){
			document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!Please try again.";
		return re.test(email);			
		}
	}
	if (document.DescSearch.viewer_group.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Please fill in the viewer group";
	   return false;
	}
	return true;
}
window.onload = initAll;

function initAll() {
	var allLinks = document.getElementsByTagName("div");
	
	for (var i=0; i<allLinks.length; i++) {
		allLinks[i].onmouseover = function (){document.getElementById("menu1").style.display = "block";}
		allLinks[i].onmouseout =  function (){document.getElementById("menu1").style.display = "none";}
		allLinks[i].onclick =  function (){document.getElementById("menu1").style.display = "none";}
	}
}
function clearfield(picture,name,email) {
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = name;
	document.getElementById('viewer_email').value=email;
	if(email != '')	document.getElementById('name').value = name;
	else {
		document.getElementById('name').value = "";
		document.getElementById('searchField').focus();
	}
}

//window.open( "../PHP/MyBlogUpload.php", "Upload");

</script>	

	