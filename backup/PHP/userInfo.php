<?php
include("../config.php");
include("geoip.inc");
include("geoipcity.inc");
include("geoipregionvars.php");
function getIpAddr(){

    // Check the IP from share internet.
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    // Check if the IP is passed from a proxy.
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip_address = getIpAddr();
foreach($_REQUEST as $name => $value) {
	${$name}="$value";
}
/* screen,plugin,location,os,browser,*/

$UserScreen=mysql_query("SELECT * FROM user_screen where user_id = $user_id and screen_width=$screen_width and screen_height=$screen_height and screen_availWidth=$screen_availWidth and screen_availHeight=$screen_availHeight and screen_colorDepth=$screen_colorDepth and screen_pixelDepth=$screen_pixelDepth limit 1");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
if(mysql_num_rows($UserScreen) == 0) {
	mysql_query("INSERT INTO user_screen(user_id,screen_width,screen_height,screen_availWidth,screen_availHeight,screen_colorDepth,screen_pixelDepth,activity_date) VALUES($user_id,$screen_width,$screen_height,$screen_availWidth,$screen_availHeight,$screen_colorDepth,$screen_pixelDepth,NOW())");
	echo mysql_error(); 
}
/*  user plugin */
for($i=1;$i<$numPlugins;$i++){
	$plugin="plugin".$i;
	$file="file_name".$i;
	$plugin_name=${$plugin};
	$file_name=${$file};
	$UserPlugin=mysql_query("SELECT * FROM user_plugin where user_id = $user_id and file_name='$file_name' and plugin_name='$plugin_name' limit 1");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	if(mysql_num_rows($UserPlugin) == 0) {
		mysql_query("INSERT INTO user_plugin(user_id,plugin_name,file_name) VALUES($user_id,'$plugin_name','$file_name')");
		echo mysql_error(); 
	}
}
/*
$gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
$rsGeoData = geoip_record_by_addr($gi, $ip);
geoip_close($gi);
if($rsGeoData)	 {
	$city=$rsGeoData->city;
	$region=$rsGeoData->region;
}
else {
	$city="";
	$region="";
}
$UserLocation=mysql_query("SELECT * FROM user_location where user_id = $user_id and ip_address='$ip_address' limit 1");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
if(mysql_num_rows($UserLocation) == 0) {
	mysql_query("INSERT INTO user_location(user_id,ip_address,city,region,activity_date) VALUES($user_id,$ip_address,$city,$region,NOW())");
	echo mysql_error(); 
}
*/

/* Get user's OS */
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
$UserOS=mysql_query("SELECT * FROM user_os where user_id = $user_id and os='$CurrOS' limit 1");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
if(mysql_num_rows($UserOS) == 0) {
	mysql_query("INSERT INTO user_os(user_id,os,activity_date) VALUES($user_id,'$CurrOS',NOW())");
	echo mysql_error(); 
}
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
$UserOS_Browser=mysql_query("SELECT * FROM user_browser where user_id = $user_id and browser='$ua[name]' limit 1");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
if(mysql_num_rows($UserOS_Browser) == 0) {
	mysql_query("INSERT INTO user_browser(user_id,browser,activity_date) VALUES($user_id,'$ua[name]',NOW())");
	echo mysql_error(); 
}
?>		