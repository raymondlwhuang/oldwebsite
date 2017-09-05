<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
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

 $ua=getBrowser();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My Blog</title> 
 <style type="text/css" media="screen">
#searchfield {
	font: 1.2em arial, helvetica, sans-serif;
}

.suggestions {
	padding: 2px 6px;
}

.suggestions:hover {
	background-color: #69F;
	cursor: pointer;
}

#popups {
	display: none;
	padding: 2px;
	border: 2px #0000ff solid;
	border-style:ridge;
	width:290px;
	clip: auto;
	margin-left:25px;
	overflow: hidden;	
}

#searchField.error {
	background-color: #FFC;
}
</style>
<script type="text/javascript" src="scripts/passVarToPhp4.js"></script>
</head>
<body>
<form action="main.php" class="submit_form" name="DescSearch" id="DescSearch" method="post">
<div style="position:fixed;bottom:0px;">
<div id="popups" style="position:relative;bottom:-7px;"> </div>
<img src="images/chat.jpg" alt="chat" height="22"/>
<?php if($ua['name'] == 'Internet Explorer') {
echo <<<_END
<div style="display:none;">
 <input style=”border:0; width:0; height:0? type=”text” size=”0? maxlength=”0?  />
 </div>
_END;
}
?>
<input type="text" size="45" id="searchField" autocomplete="off"  onKeyUp="SendRequest('search/TalkMsg.php',this.value);" name="s_message" style="border-color:#0000ff;border-style:ridge;" />
<input type="submit" value="Say" name="s_say"/>
</div>
</form>
