<?php
if(isset($_REQUEST['filename'])) $filename = $_REQUEST['filename'];
else $filename = "../images/Question.jpg";
if(isset($_REQUEST['Smoothvalue'])) $Smoothvalue = (int)$_REQUEST['Smoothvalue'];
if(isset($_REQUEST['imgEffect'])) $imgEffect = $_REQUEST['imgEffect'];
if(isset($_REQUEST['red'])) $red = (int)$_REQUEST['red'];
else $red=0;
if($red>255) $red=255;
if($red<0) $red=0;
if(isset($_REQUEST['green'])) $green = (int)$_REQUEST['green'];
else $green = 0;
if($green>255) $green=255;
if($green<0) $green=0;
if(isset($_REQUEST['blue'])) $blue = (int)$_REQUEST['blue'];
else $blue = 0;
if($blue>255) $blue=255;
if($blue<0) $blue=0;
if(isset($_REQUEST['Contrast'])) $Contrast = (int)$_REQUEST['Contrast'];
if($Contrast>255) $Contrast=255;
if($Contrast<-255) $Contrast=-255;
if(isset($_REQUEST['Brightness'])) $Brightness = (int)$_REQUEST['Brightness'];
if($Brightness>255) $Brightness=255;
if($Brightness<-255) $Brightness=-255;
if(isset($_REQUEST['Pixelate'])) $Pixelate = (int)$_REQUEST['Pixelate'];
if(isset($_REQUEST['toNewPic'])) {
	$toNewPic = $_REQUEST['toNewPic'];
	//unlink($toNewPic);
}
else $toNewPic = "";
if(isset($_REQUEST['beforAddText'])) {
	$beforAddText = $_REQUEST['beforAddText'];
}

$pieces = explode(",", $imgEffect);

header('Content-type: image/jpeg');
$image = imagecreatefromjpeg("$filename");
foreach($pieces as $key=>$value){
  if($value==10) imagefilter($image, (int)$value,$Smoothvalue);
  elseif($value==2) imagefilter($image, (int)$value,$Brightness);
  elseif($value==3) imagefilter($image, (int)$value,$Contrast);
  elseif($value==4) imagefilter($image, (int)$value,$red,$green,$blue);
  elseif($value==11) imagefilter($image, (int)$value,$Pixelate);
  else imagefilter($image, (int)$value);
} 
// imagefilter($image, IMG_FILTER_PIXELATE, 3, true);
if(isset($beforAddText)) imagejpeg($image,$beforAddText);
if($toNewPic=="") {
  imagejpeg($image);
  imagedestroy($image);
 }
else {
  imagejpeg($image,$toNewPic);
  imagedestroy($image);
  readfile($toNewPic);
}  
