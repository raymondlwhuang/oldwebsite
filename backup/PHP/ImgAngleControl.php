<?php
if(isset($_REQUEST['filename'])) $filename = $_REQUEST['filename'];
else $filename = "../images/Question.jpg";
if(isset($_REQUEST['degrees'])) $degrees = $_REQUEST['degrees'];
else $degrees = 30;
if(isset($_REQUEST['ColorOrHex'])) {
	$ColorOrHex = strtolower($_REQUEST['ColorOrHex']);
	if($ColorOrHex=='black') $bg=hexdec('000000');
	elseif($ColorOrHex=='silver') $bg=hexdec('C0C0C0');
	elseif($ColorOrHex=='gray') $bg=hexdec('808080');
	elseif($ColorOrHex=='white') $bg=hexdec('FFFFFF');
	elseif($ColorOrHex=='maroon') $bg=hexdec('800000');
	elseif($ColorOrHex=='red') $bg=hexdec('FF0000');
	elseif($ColorOrHex=='purple') $bg=hexdec('800080');
	elseif($ColorOrHex=='fuchsia') $bg=hexdec('FF00FF');
	elseif($ColorOrHex=='green') $bg=hexdec('008000');
	elseif($ColorOrHex=='lime') $bg=hexdec('00FF00');
	elseif($ColorOrHex=='olive') $bg=hexdec('808000');
	elseif($ColorOrHex=='yellow') $bg=hexdec('FFFF00');
	elseif($ColorOrHex=='navy') $bg=hexdec('000080');
	elseif($ColorOrHex=='blue') $bg=hexdec('0000FF');
	elseif($ColorOrHex=='teal') $bg=hexdec('008080');
	elseif($ColorOrHex=='aqua') $bg=hexdec('00FFFF');
	else {
		$ColorOrHex=ltrim($ColorOrHex,"#");
		$bg=hexdec("$ColorOrHex");
	}
} 
else $bg = 16777215;
if(isset($_REQUEST['toNewPic'])) {
$toNewPic = $_REQUEST['toNewPic'];
//unlink($toNewPic);
}
else $toNewPic = "";
if(isset($_REQUEST['beforAddText'])) $beforAddText = $_REQUEST['beforAddText'];
	$ext = substr($filename,strrpos($filename,".") + 1);
	if ($ext == 'jpg') {
		header("Content-type: image/jpeg");
		$source = imagecreatefromjpeg($filename);
		$rotate = imagerotate($source, $degrees, $bg);
		if($toNewPic == "") imagejpeg($rotate);
		else imagejpeg($rotate,$toNewPic);		
		if(isset($beforAddText)) imagejpeg($rotate,$beforAddText);
	}
	else if ($ext == 'png') {
		header("Content-type: image/png");
		$source = imagecreatefrompng($filename);
		$rotate = imagerotate($source, $degrees, $bg);
		if($toNewPic == "") imagepng($rotate);	
		else imagepng($rotate,$toNewPic);
		if(isset($beforAddText)) imagepng($rotate,$beforAddText);
	}
	else if ($ext == 'gif') {
		header("Content-type: image/gif");
		$source = imagecreatefromgif($filename);
		$rotate = imagerotate($source, $degrees, $bg);
		if($toNewPic == "") imagegif($rotate);
		else imagegif($rotate,$toNewPic);
		if(isset($beforAddText)) imagegif($rotate,$beforAddText);
	}
	else if ($ext == 'wbmp') {
		header("Content-type: image/wbmp");
		$source = imagecreatefromwbmp($filename);
		$rotate = imagerotate($source, $degrees, $bg);
		if($toNewPic == "") imagewbmp($rotate);
		else imagewbmp($rotate,$toNewPic);
		if(isset($beforAddText)) imagewbmp($rotate,$beforAddText);
	}
	else if ($ext == 'xbm') {
		header("Content-type: image/xbm");
		$source = imagecreatefromxbm($filename);
		$rotate = imagerotate($source, $degrees, $bg);
		if($toNewPic == "") imagexbm($rotate);
		else imagexbm($rotate,$toNewPic);
		if(isset($beforAddText)) imagexbm($rotate,$beforAddText);
	}
	imagedestroy($rotate);
	if($toNewPic != "") readfile($toNewPic);
?>
