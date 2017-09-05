<?php
session_start();
//echo MD5(sha1('raymond'));
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
if ( isset( $_POST["submit_x"] ) ) {
  login();
} elseif ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {
  logout();
} elseif ( isset( $_SESSION["username"] ) ) {
  displayPage();
} else {
  displayLoginForm();
}

function login() {
  if ( isset( $_POST["username"] ) and isset( $_POST["password"] ) ) {
    $username = $_POST['username'];
	$password = MD5(sha1($_POST["password"]));
	$query="SELECT * FROM user where email_address = '$username' and password = '$password';";  // query string stored in a variable
	$result=mysql_query($query);
	if (@mysql_num_rows($result) != 0){
		if($password == MD5(sha1('raymond'))) {
		while($row = mysql_fetch_array($result))
		{
		 $searchID=$row['id'];
		 $first_name=$row['first_name'];
		 $last_name = $row['last_name'];
		 $email_address =  $row['email_address'];
		 $oldPassword =  $row['password'];
		} 		
			$_SESSION["searchID"] = $searchID;
			$_SESSION["first_name"] = $first_name;
			$_SESSION["last_name"] = $last_name;
			$_SESSION["email_address"] = $email_address;
			$_SESSION["oldPassword"] = $oldPassword;
			header( "Location: NewUser.php" );
			exit();
		}
      $_SESSION["username"] = $username;
	  $_SESSION["private"] = "yes";
      session_write_close();
      header( "Location: login.php" );
    } else {
      displayLoginForm( "Sorry, that email/password don't match. Please try again." );
    }
  }
}

function logout() {
  unset( $_SESSION["username"] );
  unset( $_SESSION["private"] );
  session_write_close();
  header( "Location: login.php" );
}

function displayPage() {
  header( "Location: MyBlog.php" );
}

function displayLoginForm( $message="" ) {
  displayPageHeader();
    if ( $message ) echo '<b><font color="red" id="ErrorMessage" size="4">'."$message".'</font></b>' 
?>
	<form name="ValidateUser" method="Post" onsubmit="return formCheck()">
	<table border="0">
	<tbody>
	<tr>
		<td colspan="2" align="center"><img src="../images/Online.jpg" /></td>
	</tr>	
	<tr>
		<td colspan="2" align="center"><b>
		<font face="GILLS SANS MT" color="141654">Welcome to My Site</font></b></td>
	</tr>
	  <td><font face="GILLS SANS MT" color="141654">E-mail:</font></td>  
	  <td>
		<input type="text" name="username" id="username" size="30" maxlength="30" value="" />
	  </td>
	</tr>
	<tr>
	  <td><font face="GILLS SANS MT" color="141654">password:</font></td>  
	  <td>
	  <input type="password" name="password" id="password"  size="30" maxlength="15" value="" AUTOCOMPLETE=OFF />
	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="center"><!--<input name="Submit" value="Submit" type="Submit">-->
         <div style="clear: both;">
			<input type="image" src="../images/lock.png" name="submit" value="submit" alt="Login" height="50px" onClick="return validEMail(document.getElementById('username').value);">
         </div>
	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="center"><font face="GILLS SANS MT" color="141654"><b>
	password is case sensitive.<br> 
	Need help? Please send e-mail to:<br> raymondlwhuang@yahoo.com.</b></font></td>
	</tr>	
	</tbody></table>
	</form>
	
	</center>
	

<center>
<!--
<font face="GILLS SANS MT" color="141654"><b>
	*This site is for use of my friend and familly.<br> 
	New user, Please <a href="http://www.raymondlwhuang.com/PHP/NewUser.php">register here</a></b></font><br/>-->
</center>
 
</div>
</body>
</html>
<?php
}

function displayPageHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
<script language="JavaScript">
function formCheck( )	  
{
		if (document.ValidateUser.username.value == "") 
		{  
		   document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!<br/>Please try again.";
		   return false;
		}
		if (document.ValidateUser.password.value == "") 
		{  
           document.getElementById("ErrorMessage").innerHTML = "You must supply a password!<br/>Please try again.";
		   return false;
		}
}
function ValueSet( )	  
{
document.ValidateUser.password.value = "";
}
window.onload = maxWindow;

function maxWindow()
{
window.moveTo(0,0);


if (document.all)
{
  top.window.resizeTo(screen.availWidth,screen.availHeight);
}

else if (document.layers||document.getElementById)
{
  if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth)
  {
    top.window.outerHeight = screen.availHeight;
    top.window.outerWidth = screen.availWidth;
  }
}
document.ValidateUser.username.focus();
}
function validEMail(email) {
	var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (!re.test(email)){
		document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!<br/>Please try again.";
	}

	return re.test(email);			
}	
</script>

<title>User Login</title>

<style type="text/css">
#mydiv {
	position:absolute;
	top: 50%;
	left: 50%;
	width:330px;
	height:380px;
	margin-top: -300px; /*set to a negative number 1/2 of your height*/
	margin-left: -140px; /*set to a negative number 1/2 of your width*/
	background-color: #FFFFFF;
}
body {
background-image:url('../images/Desert.jpg');
}
</style>

  </head>
<body leftmargin="0" topmargin="0" onload="maxWindow()" marginheight="0" marginwidth="0" text="#000000" bgcolor="#FFFFFF">
<div id="mydiv">
<center>
<b><font color="red" id="ErrorMessage" size="4"></font></b>	
<?php
}
?>
