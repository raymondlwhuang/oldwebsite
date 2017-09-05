<?php
function asciiEncodeEmail($strEmail,$strDisplay,$blnCreateLink) {
    $strMailto = "&#109;&#097;&#105;&#108;&#116;&#111;&#058;";
    for ($i=0; $i < strlen($strEmail); $i++) {
        $strEncodedEmail .= "&#".ord(substr($strEmail,$i)).";";
    }
    if(strlen(trim($strDisplay))>0) {
        $strDisplay = $strDisplay;
    }
    else {
        $strDisplay = $strEncodedEmail;
    }
    if($blnCreateLink) {
        return "<a href=\"".$strMailto.$strEncodedEmail."\">".$strDisplay."</a>";
    }
    else {
        return $strDisplay;
    }
}

#examples:
echo "yourname@yourdomain.com will display as :<br/>";
echo asciiEncodeEmail("yourname@yourdomain.com","Your Name",true);
echo "<br />";
echo asciiEncodeEmail("yourname@yourdomain.com","",true);
echo "<br />";
echo asciiEncodeEmail("yourname@yourdomain.com","",false);
echo "<br />";
function cleanstr($string){
    $len = strlen($string);
    for($a=0; $a<$len; $a++){
        $p = ord($string[$a]);
        # chr(32) is space, it is preserved..
        (($p > 64 && $p < 123) || $p == 32) ? $ret .= $string[$a] : $ret .= "";
    }
    return $ret;
}
echo "cleaning a string: @@@@ !!!## abc@d <br/>";
$tst = "@@@@ !!!## abc@d";
echo cleanstr($tst);
echo "<br />";
echo "generate a random string";
echo "<br />";
$x = 1;  //minimum length
$y = 10;  //maximum length

$len = rand($x,$y);  //get a random string length

for ($i = 0; $i < $len; $i++) {  //loop $len no. of times
   $whichChar = rand(1,3);  //choose if its a caps, lcase or num
   if ($whichChar == 1) { //it's a number
      $string .= chr(rand(48,57));  //randomly generate a num
   }
   elseif ($whichChar == 2) { //it's a small letter
      $string .= chr(rand(65,90));  //randomly generate an lcase
   }
   else { //it's a capital letter
      $string .= chr(rand(97,122));  //randomly generate a ucase
   }
}
echo $string;
echo "<br />";
?>