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
         'name'      => $ub,
         'version'   => $version,
         'platform'  => $platform,
         'pattern'    => $pattern
     );
 } 

// now try it
 $ua=getBrowser();
 //$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
// $yourbrowser= "Your browser is: " . $ua['name'] . " and run on " .$ua['platform'];
 //print_r($yourbrowser);
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://html5media.googlecode.com/svn/trunk/src/jquery.html5media.min.js"></script> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
<title>My Videos</title> 
</head>
<body>
<div style="position : relative; top:-1em;">
<?php
if (isset($_POST['SetShow2']) or isset($_GET['SetShow2']) or isset($SetShow2))
{ 
$SetShow2 =  htmlspecialchars($_GET['SetShow2']);
} 
else $SetShow2 =  "videos/movie.mp4";
$ext = substr($SetShow2,strpos($SetShow2,".") + 1);
if($ua['name'] =='Chrome' && ($ext !='mp4' && $ext !='flv')){
$longstring = <<<STRINGBEGIN
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="420" height="240" id="player1" align="middle">
<param name="movie" value="http://raymondlwhuang.com/$SetShow2"/>
<param name="menu" value="false"/>
<param name="quality" value="high"/>
<param name="bgcolor" value="#FFFFFF"/>
<embed src="http://raymondlwhuang.com/$SetShow2" menu="false" quality="high" bgcolor="#FFFFFF" width="320" height="240" name="player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
</object> 
STRINGBEGIN;
echo $longstring;
}
else if($ua['name'] =='Chrome' && $ext =='flv'){
echo "Sorry your browser don't support this";
}
else
{
$longstring = <<<STRINGBEGIN
<video src="http://raymondlwhuang.com/$SetShow2" width="420" height="240" autoplay=true controls autobuffer></video>
STRINGBEGIN;
echo $longstring;
}

?>
</div>
</body>
</html>