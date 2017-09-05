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
    $_GET = _stripslashes_rcurs($_GET);////
    $_POST = _stripslashes_rcurs($_POST);
}
function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    // Check if the IP is passed from a proxy.
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
$ip = getIpAddr();
include_once("sethash.php");
include("../config.php");
if ( isset( $_POST["submit_x"] ) ) {
  login();
} elseif ( isset( $_POST["forget_x"] ) ) {
  forget();
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
	$email_address = $username;
	$password = MD5($_POST["password"]);
	$query="SELECT * FROM user where email_address = '$email_address' and password = '$password';";  // query string stored in a variable
	$result=mysql_query($query);
	  if (@mysql_num_rows($result) != 0){
		  $_SESSION["username"] = $username;
		  $_SESSION["email_address"] = $email_address;
		  $_SESSION["private"] = "yes";
		  session_write_close();
		  header( "Location: login.php" );
		} else {
		  displayLoginForm( "Sorry, that email/password don't match. Please try again." );
		}
  }
}
function forget() {
	$email_address = $_POST['username'];
	$query = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
	$result = mysql_query($query);
	  if (@mysql_num_rows($result) != 0){
			while($row = mysql_fetch_array($result)){ 
				$first_name=ucfirst(strtolower($row['first_name']));
				$last_name = ucfirst(strtolower($row['last_name'])); 
			} 	
			mysql_close();
			$todaydate = date("l, F j, Y, g:i a");
			$email = "raymondlwhuang@yahoo.com";
			$userEmail = newencode($email_address);
			$to = "$email_address";
			$cc = "$email";
			$subject = "Password reset required";
			$headers = "From: raymondlwhuang@yahoo.com\r\n";
			$headers .= "Reply-To: raymondlwhuang@yahoo.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers = "CC: $cc\nX-Sender-IP: $ip\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';
			$message .= "<h1>Hi $first_name $last_name,</h1>";
			$message .= "<br/><br/>You require a password reset to this email address: $email_address <br/>
			Click here to <a href='http://raymondlwhuang.com/PHP/ResetPassword.php?ResetUser=$userEmail' > Reset your password</a><br/>
		If you forgot the password for one of these usernames, just re-type in all information for this e-mail address,<br/>
		Hope this helps.<br/><br/><br/>
		See you back on www.raymondlwhuang.com!<br/><br/><br/>
		- Raymond ";
		$message .= '</body></html>';
			if (preg_match("/bcc:/i", $email . " " . $message) == 0 &&          /* check for injected 'bcc' field */
				preg_match("/Content-Type:/i", $email . " " . $message) == 0 && /* check for injected 'content-type' field */
				preg_match("/cc:/i", $email . " " . $message) == 0 &&           /* check for injected 'cc' field */
				preg_match("/to:/i", $email . " " . $message) == 0) {           /* check for injected 'to' field */
				// Format the body of the email
				$message = "Email: $email\n" . $message . "\n\nSent from: $ip ($todaydate)\n";
				// Set the header, include the ip and set the reply-to field for convenience when replying to the email
		//		$headers = "CC: $cc\nX-Sender-IP: $ip\nFrom: $email\nReply-To: $email";
				// Send the email and check the result whether the function call was successful or not
				$sent = mail($to, $subject, $message, $headers) ;
				if($sent) {
					echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "Your mail was sent successfully.<br>Thanks for your comment"</script>';
				} else {
					echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "We encountered an error sending your mail"</script>';
				}
			} else  {
				echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "We encountered an error sending your mail"</script>';
			}
		  displayLoginForm( "An email had sent to you,Please follow  <br/>the instruction to reset your password." );
	  } else { ?>
			<script language="JavaScript">
				var answer = confirm("System can't clarify you. Did you misspell your email?\n\n\n       (OK for Yes, Cancel for No)")
				if (!answer){ 
					window.open( '../PHP/NewUser.php', '_top');
				}
			</script>
<?php
			displayLoginForm( "Please re-enter your correct email." );
			exit();
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
//    if ( $message ) echo '<b><font color="red" id="ErrorMessage" size="4">'."$message".'</font></b>' 
if ( $message ) 
echo <<<_END
<script language="JavaScript">
	document.getElementById("ErrorMessage").innerHTML = "$message";
</script>
_END;

?>
	<form name="ValidateUser" method="Post">
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
		<input type="text" name="username" id="username" size="30" maxlength="30" value=""  onChange="document.ValidateUser.password.value = ''"/>
	  </td>
	</tr>
	<tr>
	  <td><font face="GILLS SANS MT" color="141654">password:</font></td>  
	  <td>
	  <input type="password" name="password" id="password"  size="30" maxlength="15" value="" AUTOCOMPLETE=OFF onfocus="this.value = ''"/>
	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="center"><!--<input name="Submit" value="Submit" type="Submit">-->
		 <font face="GILLS SANS MT" color="141654" style="position:relative; top:-10px;"><b>Forget your password? </b></font>
		 <input type="image" src="../images/ClickHere.png" name="forget" value="Click Here" width="25%" onClick="return validEMail(document.getElementById('username').value);">
         <div style="clear: both;">
			<input type="image" src="../images/login.jpg" name="submit" value="submit" alt="Login" width="50%" onClick="return validEMail(document.getElementById('username').value);return formCheck()">
         </div>
	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="center"><font face="GILLS SANS MT" color="141654" style="position:relative; top:-30px;"><b>
	password is case sensitive.<br> 
	Need help? Please send e-mail to:<br> <a href="mailto:raymondlwhuang@yahoo.com">raymondlwhuang@yahoo.com.</a><br/>
	New user? Please <a href="NewUser.php">register here</a></b></font></td>
	</tr>	
	</tbody></table>
	</form>
	
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
html, body {
   height: 100%;
   margin: 0;
   padding: 0;
 }
 #mydiv {
	position:absolute;
	top: 50%;
	left: 50%;
	width:330px;
	height:420px;
	margin-top: -300px; /*set to a negative number 1/2 of your height*/
	margin-left: -140px; /*set to a negative number 1/2 of your width*/
	background-color: #FFFFFF;
}
img#bg {
   position:fixed;
   top:0;
   left:0;
   width:100%;
   height:100%;
 } 

</style>

  </head>
<body leftmargin="0" topmargin="0" onload="maxWindow()" marginheight="0" marginwidth="0" text="#000000" bgcolor="#FFFFFF">
<img src="../images/Desert.jpg" alt="background image" id="bg" />
 
<div id="mydiv">
<center>
<b><font color="red" id="ErrorMessage" size="4"></font></b>	
<?php
}
?>
