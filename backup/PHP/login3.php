<?php
require_once 'config2.php';
if($_SESSION['username'])
{
	if ($_SESSION["page"] == "HER") header("Location: HERecorder.php");
	elseif ($_SESSION["page"] == "HELP") header("Location: ResultDisp.php");
	else header("Location: index.php");
	exit;
}

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
include("geoip.inc");
include("geoipcity.inc");
include("geoipregionvars.php");
include("../config.php");
if ( isset( $_GET["signout"] ) ) {
	setcookie('member_name', '', time() - 96 * 3600, '/');
	setcookie('user_name', '', time() - 96 * 3600, '/');
	setcookie('member_pass', '', time() - 96 * 3600, '/');

	unset($_COOKIE['member_name']);
	unset($_COOKIE['user_name']);
	unset($_COOKIE['member_pass']);
	unset( $_SESSION["username"] );
	unset( $_SESSION["private"] );
  
  session_write_close();
  login();
} elseif(isSet($_POST['submit_x']))
{
$do_login = true;

include_once 'do_login.php';
} 
/*
elseif ( isset( $_POST["submit_x"] ) ) {
  login();
} */
elseif ( isset( $_POST["UserSetup_x"] ) ) {
  UserSetup();
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
	$query="SELECT * FROM user where email_address = '$email_address' and password = '$password' and is_active > 0 LIMIT 1;";  // query string stored in a variable
	$result=mysql_query($query);
	  if (@mysql_num_rows($result) != 0){
		while($row = mysql_fetch_array($result))
		{
		 $_SESSION["first_name"] =ucfirst(strtolower($row['first_name']));
		 $_SESSION["last_name"] = ucfirst(strtolower($row['last_name']));
		 $_SESSION["id"] = $row['id'];
		 $_SESSION["owner_path"] = $row['owner_path'];
		 $_SESSION["name"] = ucfirst(strtolower($row['first_name']))." ".ucfirst(strtolower($row['last_name']));
		 $_SESSION["profile_picture"] = $row['profile_picture'];
		 $_SESSION["admin"] = $row['is_super_admin'];
		 $_SESSION["discoverable"] = $row['discoverable'];
		}	  
		  $_SESSION["username"] = $username;
		  $_SESSION["email_address"] = $email_address;
		  $_SESSION["private"] = "yes";
		  $_SESSION["MsgBox"] = "no";
		  mysql_query("UPDATE user SET is_active=3 WHERE email_address = '$email_address' LIMIT 1");
		  echo mysql_error();
  		  mysql_query("UPDATE view_permission SET is_active = 1 WHERE owner_email = '$email_address' and is_active > 1  and is_active < 9 order by owner_email");
		  echo mysql_error();	
		  session_write_close();
		  header( "Location: login.php" );
		} else {
		  displayLoginForm( "Sorry, that email/password don't match. Please try again." );
		}
  }
}
function UserSetup() {
	$email_address = $_POST['username'];
	$query = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
			$todaydate = date("l, F j, Y, g:i a");
			$email = "raymondlwhuang@yahoo.com";
			$sendinfo = $email_address.':::'.date('Y-m-d');
			$userEmail = newencode($sendinfo);
//			$userEmail = newencode($email_address);
			$to = "$email_address";
			$cc = "$email";
			$headers = "From: raymondlwhuang@yahoo.com\r\n";
			$headers .= "Reply-To: raymondlwhuang@yahoo.com\r\n";
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
		See you back on www.raymondlwhuang.com!<br/><br/><br/>
		- Raymond ";
	}
	else {
			$subject = "Account Setup Notification";
			$message .= "<h1>User Setup Notification,</h1>";
			$message .= "<br/><br/>Please Click here to <a href='http://raymondlwhuang.com/PHP/UserSetup.php?UserSetup=$userEmail' > Set up your account</a><br/>
		Hope this helps.<br/><br/><br/>
		See you back on www.raymondlwhuang.com!<br/><br/><br/>
		- Raymond ";	
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
					displayLoginForm("Please check your mail and <br/>See you back on www.raymondlwhuang.com!");
				} else {
					displayLoginForm("We encountered an error sending your mail");
				}
			} else  {
				displayLoginForm("We encountered an error sending your mail");
			}

}

function displayPage() {
  header( "Location: index.php" );
}

function displayLoginForm( $notices="" ) {
  displayPageHeader();
//    if ( $notices ) echo '<b><font color="red" id="ErrorMessage" size="4">'."$notices".'</font></b>' 
if ( $notices ) 
echo <<<_END
<script language="JavaScript">
	document.getElementById("ErrorMessage").innerHTML = "$notices";
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
	  <td align="center" colspan="2"><font face="GILLS SANS MT" color="141654">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail:</font>
		<input type="text" name="username" id="username" size="30" maxlength="30" value=""  onChange="document.ValidateUser.password.value = ''"/>
	  </td>
	</tr>
	<tr>
	  <td align="center" colspan="2"><font face="GILLS SANS MT" color="141654">password:</font>
	  <input type="password" name="password" id="password"  size="30" maxlength="15" value="" AUTOCOMPLETE=OFF onfocus="this.value = ''"/>
	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="center">
         <div style="clear: both;">
			<input type="checkbox" name="autologin" value="1">Remember Me<br/>
			<input type="image" src="../images/login.jpg" name="submit" value="submit" alt="Login" width="50%" onClick="return validEMail(document.getElementById('username').value);return formCheck()">
         </div>
	  </td>
  	  <td>
	  </td>

	</tr>
	<tr>
	  <td align="left">
         <div style="clear: both;">
		 <font face="GILLS SANS MT" color="141654" ><b>New User/First Time? </b></br></font>
		 <font face="GILLS SANS MT" color="141654" ><b>Reset/Forget your password? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font>
         </div>
	  </td>
	  <td valign="top">
		 <input type="image" src="../images/ClickHere.png" name="UserSetup" value="Click Here" width="150" onClick="return validEMail(document.getElementById('username').value);">
	  </td>
	  <td>
	  </td>
	</tr>	
	<tr>
	  <td colspan="2" align="center"><font face="GILLS SANS MT" color="141654" ><b>
	password is case sensitive.<br> 
	Need help? Please send e-mail to:<br> <a href="mailto:raymondlwhuang@yahoo.com">raymondlwhuang@yahoo.com.</a></font></td>
	</tr>	
	</tbody></table>
	</form>
	
	
</div>
</div>
</body>
</html>
<?php
}

function displayPageHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script language="JavaScript">
function formCheck( )	  
{
		if (document.ValidateUser.username.value == "") 
		{  
		   document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
		   return false;
		}
		if (document.ValidateUser.password.value == "") 
		{  
           document.getElementById("ErrorMessage").innerHTML = "Password required!!";
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
		document.getElementById("ErrorMessage").innerHTML = "Please provide your valid email address!";
	}

	return re.test(email);			
}	
function yourOS() {
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("win") != -1) {
        return "Windows";
    } else if (ua.indexOf("mac") != -1) {
        return "Macintosh";
    } else if (ua.indexOf("linux") != -1) {
        return "Linux";
    } else if (ua.indexOf("x11") != -1) {
        return "Unix";
    } else {
        return "Computers";
    }
}

</script>
<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
<title>User Login</title>

<style type="text/css">
html, body {
	background-image: url('http://www.todaysluckywinner.com/images/mainbg.jpg');
 }
#wrapper {
	width: 976px;
	margin: 0px auto;
	height:976px;
	position: relative;
	background-image: url('../images/background.png');
}
 #mydiv {
	position:fixed;
	top:150px;
	width:380px;
	height:420px;
	background-color: #FFFFFF;
	text-align: left;
	left: 50%;
	margin-left: -190px;	
	border-style:solid outset;
	border-width:7px;
	background-color:#8FC4FF;
}
</style>

  </head>
<body>
<div id="wrapper">
<video src="http://localhost/myhelp/videos/movie.mp4" width="111" height="81" autoplay=true autobuffer loop></video>
<iframe src="advertise.php" width="30%" height="200px" frameborder=0 SCROLLING=no allowTransparency="false"  style="z-index:3;background-color:#FFFFFF;float:right;margin-top:230px;">
  <p>Your browser does not support iframes.</p>
</iframe>
<video src="http://localhost/myhelp/videos/movie.mp4" width="111" height="81" autoplay=true autobuffer loop style="float:right;"></video>
<div id="mydiv">
<?php 
$gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
$ip = getIpAddr();
$rsGeoData = geoip_record_by_addr($gi, $ip);
geoip_close($gi);	
$city = $rsGeoData->city;
$region = $rsGeoData->region;
$country = $rsGeoData->country_name;
$postal_code = $rsGeoData->postal_code;
$latitude = $rsGeoData->latitude;
$longitude = $rsGeoData->longitude;
$OSList = array 
(
// Match user agent string with operating systems
'Windows 3.11' => 'Win16',
'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
'Windows 98' => '(Windows 98)|(Win98)',
'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
'Windows Server 2003' => '(Windows NT 5.2)',
'Windows Vista' => '(Windows NT 6.0)',
'Windows 7' => '(Windows NT 7.0)',
'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
'Windows ME' => 'Windows ME',
'Open BSD' => 'OpenBSD',
'Sun OS' => 'SunOS',
'Linux' => '(Linux)|(X11)',
'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
'QNX' => 'QNX', 
'BeOS' => 'BeOS',
'OS/2' => 'OS/2',
'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
);
// Loop through the array of user agents and matching operating systems
foreach($OSList as $CurrOS=>$Match)
{
// Find a match
//echo $_SERVER['HTTP_USER_AGENT'];
	if (preg_match("/$Match/", $_SERVER['HTTP_USER_AGENT']))
	{
		// We found the correct match
		break;
	}
}
		$SaveCheck = "SELECT * FROM visitor WHERE ip = '$ip' LIMIT 1";
		$result2 = mysql_query($SaveCheck);
		if (mysql_num_rows($result2) > 0){
			$SaveCheck3 = "SELECT * FROM visitor WHERE ip = '$ip' and DATEDIFF(minute,NOW(),visitdate) > 30 LIMIT 1";
			$result3 = mysql_query($SaveCheck3);
			if (mysql_num_rows($result3) > 0){
				mysql_query("UPDATE visitor SET visitcount=visitcount + 1 WHERE ip = '$ip' LIMIT 1");
				echo mysql_error();
			}
		}
		ELSE {
				mysql_query("INSERT INTO visitor(visitcount,ip,city,region,country,postal_code,os,visitdate) VALUES(1,'$ip','$city','$region','$country','$postal_code','$CurrOS',NOW())");
				echo mysql_error();
			}

?>
<center>
<b><font color="red" id="ErrorMessage" size="4"></font></b>	</center>
<?php
}
?>
