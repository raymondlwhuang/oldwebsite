<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
  $pictures = "../pictures/wedding/";
  $videos = "../videos/wedding/";
 function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
     $platform = 'Unknown';
     $version= "";
 
    //First get the platform?
     if (preg_match('/linux/i', $u_agent)) {
         $platform = 'linux';
     }
     elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
         $platform = 'mac';
     }
     elseif (preg_match('/windows|win32/i', $u_agent)) {
         $platform = 'windows';
     }
     
    // Next get the name of the useragent yes seperately and for good reason
     if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
     $known = array('Version', $ub, 'other');
     $pattern = '#(?<browser>' . join('|', $known) .
     ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
     if (!preg_match_all($pattern, $u_agent, $matches)) {
         // we have no matching number just continue
     }
     
    // see how many we have
     $i = count($matches['browser']);
     if ($i != 1) {
         //we will have two since we are not using 'other' argument yet
         //see if version is before or after the name
         if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
             $version= $matches['version'][0];
         }
         else {
             $version= $matches['version'][1];
         }
     }
     else {
         $version= $matches['version'][0];
     }
     
    // check if we have a number
     if ($version==null || $version=="") {$version="?";}
     
    return array(
         'userAgent' => $u_agent,
         'name'      => $bname,
         'version'   => $version,
         'platform'  => $platform,
         'pattern'    => $pattern
     );
 } 

// now try it
 $ua=getBrowser();
 //$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
 $yourbrowser= "You are now using " . $ua['name'] . " and run on " .$ua['platform'];
 
include("../config.php");
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
if(isset($_COOKIE['searchID2']) or isset($_REQUEST['searchID2']))
{
	if(isset($_COOKIE['searchID2'])) {$searchID2=(int)$_COOKIE['searchID2'];}
	ELSEIF(isset($_REQUEST['searchID2'])){$searchID2=(int)$_REQUEST['searchID2'];}
	$GetDisplay = "SELECT *	FROM main WHERE id = $searchID2 ORDER BY id LIMIT 1";
	include("../RecordSet.php");
	setcookie("searchID2","",time() + 3600);
 }
ELSEIF(isset($_POST['searchID']))
{
	$searchID2 = (int)$_POST['searchID'];
	$GetDisplay = "SELECT * FROM main WHERE id = $searchID2 ORDER BY id  LIMIT 1";
	include("../RecordSet.php");
}
ELSEIF(isset($_POST['comments']))
{
		$todaydate = date("l, F j, Y, g:i a");
		$to = 'raymondlwhuang@yahoo.com';
		$cc = "raymondlwhuang@gmail.com";
        $subject = "Comments";
        $email = $_SESSION["email_address"];
        $message = $_REQUEST['message'];
        if (preg_match("/bcc:/i", $email . " " . $message) == 0 &&          /* check for injected 'bcc' field */
            preg_match("/Content-Type:/i", $email . " " . $message) == 0 && /* check for injected 'content-type' field */
            preg_match("/cc:/i", $email . " " . $message) == 0 &&           /* check for injected 'cc' field */
            preg_match("/to:/i", $email . " " . $message) == 0) {           /* check for injected 'to' field */
            // Format the body of the email
            $message = "Email: $email\n" . $message . "\n\nSent from: $ip ($todaydate)\n";
            // Set the header, include the ip and set the reply-to field for convenience when replying to the email
            $headers = "CC: $cc\nX-Sender-IP: $ip\nFrom: $email\nReply-To: $email";
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
	 Header("Location: {$_SERVER['REQUEST_URI']}");
	 die;
}
ELSEIF(isset($_POST['setID']))
{
	if ($_POST['UseID'] != ''){
	  $pictures = "../$_POST[UseID]/";
	  $videos = "../$_POST[UseID]/";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My Blog</title>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<style type="text/css" media="screen">
.pictures{
background-image:url('../pictures/M1060003');
background-repeat:no-repeat;
background-size: 330px 295px;
background-position:center; 
vertical-align: top;
}
.information{
 /* background:url(../images/map.png) no-repeat; */
 text-align:left;
 color:blue;
}
textarea 
{ 
    width:100%; 
} 
</style>
<script type="text/javascript" src="../scripts/fancydropdown.js"></script>
<script type="text/javascript" src="../scripts/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="../scripts/passVarToPhp.js"></script>
<script language="JavaScript" src="http://j.maxmind.com/app/geoip.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#slider-container').cycle({
        fx:     'uncover',
        speed:  1000,
        timeout: 7000,
		pause:	1,
        pager:  '#banner-nav'
	});
});
	function validEMail(email) {
		var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (!re.test(email)){
			document.getElementById("ErrorMessage").innerHTML = "Invalid e-mail address!";
			document.getElementById("email").focus(); 
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
</head>
<body>
<table width="100%" border="1"  bordercolor="blue">
<tr>
	<td valign="top" width="450" height="255" align="center">
		<?php
		$dirPath = $pictures;
		traverseDir( $dirPath );
		function traverseDir( $dir ) {
		$countimg = 0;
		  if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );
		  $files = array();
		  while ( $file = readdir( $handle ) ) {
			if ( $file != "." && $file != ".." ) {
			  if ( is_dir( $dir . "/" . $file ) ) $file .= "/";
			  $files[] = $file;
			}
		  }
		  sort( $files );
		echo '<div style="overflow: hidden;" id="slider-container">';
		  foreach ( $files as $file ) {
		  $countimg++;
		  $content ='<div style="display: none; opacity: 1;height: 315px;" id="banner'."$countimg".'">';
		  $content = "$content"."<img src=$dir". "/" ."$file height='100%' alt='Register' usemap='#mail-info' border='0'>";
		  $content = "$content".'</div>';
		  echo "$content";
		  };
		  closedir( $handle );
		echo '</div>';
		}
		?>	
	</td>
	<td align="center" rowspan="2" width="520">
		<iframe src="VideoMain.php" width="550" height="365" style="border-color:#ff0000 #0000ff;border-style:ridge; border-width: 3px;margin-top:0px;">
		  <p>Your browser does not support iframes.</p>
		</iframe>	
		<iframe src="../messages.php" width="100%" height="180px">
		   <p>Your browser does not support iframes.</p>
		 </iframe>	
		<iframe src="../main.php" width="100%" height="60px">
		   <p>Your browser does not support iframes.</p>
		 </iframe>		 
		
	</td>
	<td align="left">
	<a href='../HTML/FileMaintenance.html' target="_blank">Pictures/Videos Maintenance</a>
	</td>
</tr>
<tr>
	<td class="information">
	    <font color="red"><b>Some information I know about you:</b></font><br/>
		<?php 
			if ($ip != '') echo "Your IP Address: ".$ip; 
			else "Can't figure out your IP address!";
		?>
		<br/>
		You now in <script language="JavaScript">document.write(geoip_city());</script> city of 
		<script language="JavaScript">document.write(geoip_region_name());</script> ,
		<script language="JavaScript">document.write(geoip_country_name());</script>
		<br/>
		<script language="JavaScript">
		if(geoip_postal_code() != ''){
		document.write('Your Postal/Zip Code is:' + geoip_postal_code() + '<br>');
		}
//		else document.write("I am sorry Can't figure out your Postal/Zip Code!<br>");
		</script>	
		Your current Latitude: <script language="JavaScript">document.write(geoip_latitude());</script>
		<br/> 
		Your current Longitude <script language="JavaScript">document.write(geoip_longitude());</script>
		<br/>
<!--		Hope I could figure out your name or address next time!<br/> -->
		<?php print_r($yourbrowser); ?>
	</td>
	<td>
	<center>List of Help Examples(Click to stop scrolling)</center>
		<iframe src="HelpList.php" id="loaddisp" width="98%" height="240px" style="border-color:#ff0000 #0000ff;border-style:ridge; border-width: 3px;margin-top:0px;">
		  <p>Your browser does not support iframes.</p>
		</iframe>	
	</td>	
</tr>
<tr>
	<td valign="top">
		<iframe src="http://raymondlwhuang.host56.com/MyHelpFile.php" width="450" height="240">
		  <p>Your browser does not support iframes.</p>
		</iframe>
		<b><font color="red" id="ErrorMessage" size="6"></font></b>
	</td>
	<td valign="top">
		<form name="DescSearch" method="POST">
		<input type="hidden" name="searchID" id="searchID" />
		<div align="left">
		  <table border="0" id="help">
			<tr>
			<td>
			<img src="../images/help.jpg" width="70%">
			</td>
			<td align="left">
			<font color="red" size="4">My Help Center<br/></font>
			<input type="text"  id="searchField" autocomplete="off" name="ShortDesc" size="40"  maxlength="200" id="ShortDesc"  style="border-color:#ff0000 #0000ff;border-style:ridge; border-width: 3px;" onFocus = "clearChoice();" onKeyUp="SendRequest('../SearchShortDesc.php',document.getElementById('SearchGroup').value);"/><br/>
			<font color="red">Enter Query to Search</font><br/>
			<input type="text" name="ShortDesc2" size="30" maxlength="200" style="font-weight:bold;border: 0px #38c;text-align:left"  value="<?php if (isset($ShortDesc)){ echo htmlspecialchars($ShortDesc); } else ''; ?>" readonly="readonly">
			<?php if($ua['name'] =='Google Chrome' || $ua['name'] == 'Apple Safari' || $ua['name'] == 'Opera')	echo '<input type="submit" value="Slide Show" style="position:absolute; top:10px;float:center">' ?>
			</td>
			</tr>
			<tr>
			<td align="left" colspan="2"><div id="popups"> </div></td>
			</tr>
		  </table>
		  </div>
		</form>	
		<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
		<table width="100%">
		  <tr>
		  <tr>
			<td colspan="6">
			<input type="hidden" name="ShortDesc" size="30" maxlength="200" value="<?php if (isset($ShortDesc)){ echo htmlspecialchars($ShortDesc); } else ''; ?>" readonly="readonly">
			</td>
		  </tr>
		  </tr>
			<tr>
			<td colspan="6">
			<center>
			<div class="container">
			<textarea name="Source" id="Source" rows="6" style="border-color:#ff0000 #0000ff;border-style:ridge; border-width: 3px;position : relative; top:-2em;" readonly="readonly"><?php if (isset($Source)){ echo trim(htmlspecialchars($Source)); } else ''; ?></textarea>
			</div>
			</center>
			</td>	
		   </tr>
		  <tr>
			<td>
			<select name="SearchGroup" id="SearchGroup" class="reqd" style="visibility:hidden;">
			   <option value="" <?php if(isset($SearchGroup) && htmlspecialchars($SearchGroup) == "") echo "selected"; ?>>ALL</option>
			 </select>		
			</td>
			<td align="right"><p></p></td>
			<td width="20"><input type="hidden" name="Name" id="Name" size="15" maxlength="50" style="border: 1px solid #38c;"  value="<?php if (isset($Name)){ echo htmlspecialchars($Name); } else ''; ?>"></td>
			<td align="left" width="10"><p></p></td>
			<td align="left" width="20">
				<input type="hidden" name="Ext" id = "Ext" size="30" maxlength="200" style="border: 1px solid #38c;"  value="<?php if (isset($Ext)){ echo htmlspecialchars($Ext); } else ''; ?>">
			</td>
			<td align="left" width="15"><p></p></td>
		</tr>  
		</table>    
		</form>	
	</td>
	<td valign="top">
		<center>
		<form name="comments" method="POST">
			Comments<br/>
			<textarea name="message" id="message" rows="12" cols="35" style="border-color:#ff0000 #0000ff;border-style:ridge; border-width: 3px;"></textarea><br/>
<!--			Your email:<input type="text" size="30" name="sender_email"  autocomplete="off" id="email" value="" style="border-color:#ff0000 #0000ff;border-style:ridge; border-width: 3px;"><br/> -->
			<input type="submit" name="comments" value="submit" onClick="return validEMail(document.getElementById('email').value);">
		</form>	
		</center>
	</td>	
</tr>
</table>
</body>
</html>
<script type="text/javascript">
	var text = document.getElementById('Ext').value;
	if(text == "php") var value = document.getElementById("Name").value+'.'+text;
	else if(text == "pdf") var value = "../pdf/"+document.getElementById("Name").value+'.'+text;
	else var value = "../HTML/"+document.getElementById("Name").value+'.'+text;
	if(text == "php" || text == "html" || text == "pdf") document.getElementById('loaddisp').src = value;
	else if(text == "link") window.open(document.getElementById("Source").innerHTML);
</script>
		