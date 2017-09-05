<?php
@session_start();
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
if(!isset( $_COOKIE["greeting"] )) setcookie( "greeting", "Welcome back", time() + 60 * 60 * 24 * 365, "", "", false, true ); 
if(isset($_REQUEST['login']) && $_REQUEST['login']=="failed") $ErrorMessage="Password not match! Please try again.";
$ip = getIpAddr();
include_once("sethash.php");
include("../config.php");
if(isSet($_REQUEST['submit']))
{
	$do_login = true;
	include_once 'do_login.php';
}
elseif ( isset( $_REQUEST["UserSetup"] ) ) {
  UserSetup();
}

function UserSetup() {
	$email_address = strtolower($_REQUEST['username']);
	$query = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
	
	
			$todaydate = date("l, F j, Y, g:i a");
			$email = "raymondlwhuang@yahoo.com";
			$sendinfo = $email_address.':::'.date('Y-m-d');
			$userEmail = newencode($sendinfo);
			$to = "$email_address";
			$cc = "$email";
			$headers = "From: no-reply@raymondlwhuang.com\r\n";
			$headers .= "Reply-To: no-reply@raymondlwhuang.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers = "CC: $cc\nX-Sender-IP: $ip\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';	
	$result = mysql_query($query);
	$password = '';
	if (@mysql_num_rows($result) != 0 ){
		while($row = mysql_fetch_array($result)){ 
			$first_name=ucfirst(strtolower($row['first_name']));
			$last_name = ucfirst(strtolower($row['last_name'])); 
			$password = $row['password'];
		}
	}
	mysql_close();
	if($password != ''){
			$subject = "Password reset required";

			$message .= "<h1>Hi $first_name $last_name,</h1>";
			$message .= "<br/><br/>You require a password reset to this email address: $email_address <br/>
			Click here to <a href='http://raymondlwhuang.com/PHP/UserSetup.php?UserSetup=$userEmail' > Reset your password</a><br/>
		If you forgot the password for one of these usernames, just re-type in all information for this e-mail address,<br/>
		Hope this helps.<br/><br/><br/>
		See you back on www.raymondlwhuang.com!<br/><br/><br/>";
	}
	else {
			$subject = "Account Setup Notification";
			$message .= "<h1>User Setup Notification,</h1>";
			$message .= "<br/><br/>Please Click here to <a href='http://raymondlwhuang.com/PHP/UserSetup.php?UserSetup=$userEmail' > Set up your account</a><br/>
		Hope this helps.<br/><br/><br/>
		See you back on www.raymondlwhuang.com!<br/><br/><br/>";	
	}
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
					$ErrorMessage="Please check your mail and <br/>See you back on www.raymondlwhuang.com!";
				} else {
					$ErrorMessage="We encountered an error sending your mail";
				}
			} else  {
				$ErrorMessage="We encountered an error sending your mail";
			}

}
?>
<script language="JavaScript">
function formCheck( )	  
{
	if (document.ValidateUser.username.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
	   return false;
	}
	var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (!re.test(document.getElementById("username").value)){
		document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
		return false;
	}
	if (document.ValidateUser.password.value == "") 
	{  
	   document.getElementById("ErrorMessage").innerHTML = "Password required!!";
	   document.getElementById("autologin").style.display="inline-block";
	   document.getElementById("password").focus();
	   return false;
	}
}

function validEMail(email) {
	var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (!re.test(email)){
		document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
		document.getElementById("autologin").style.display="none";
	}

	return re.test(email);			
}	
</script>

<title>User Login</title>

<style type="text/css">
	.pointer { cursor: pointer }
</style>
<form name="ValidateUser" method="Post">
	<div style="display:inline-block;">
		<div id="mydiv"><b><font color="red" id="ErrorMessage" size="4"><?php if(isset($ErrorMessage)) echo $ErrorMessage; ?></font></b><br/>
			Email: <input type="text" name="username" id="username" size="20" maxlength="30" value=""  onChange="document.ValidateUser.password.value = ''"/>
			<div style="display:inline-block;" id="autologin">
			Password:<input type="password" name="password" id="password"  size="10" maxlength="15" value="" AUTOCOMPLETE=OFF onfocus="this.value = ''"/>
			<input type="checkbox" name="autologin" value="1">Keep me loged in
			</div>
		</div>
	</div>
	<div class="pointer" style="display:inline-block;" onClick="return validEMail(document.getElementById('username').value);document.ValidateUser.submit();">
		<input type="submit" class="pointer"  name="submit" value="Log In" onClick="return formCheck()" style="background-color:#174250;color:white;font-weight:bold;height:38px;vertical-align:top;">
<!--		<input type="image" src="../images/login.jpg" name="submit" value="submit" alt="Login" width="100" onClick="return formCheck()">-->
		<button type="submit" name="UserSetup" class="pointer" style="background-color:#174250;color:white;font-weight:bold;">
			New User<br />
			Reset/Forget password
		</button>
	</div>
</form>
<hr/>