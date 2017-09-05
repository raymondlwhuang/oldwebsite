<?php
$filename = $_REQUEST['filename'];
$radius = isset($_REQUEST['radius']) ? $_REQUEST['radius'] : 20; // The default corner radius is set to 20px
$degrees = isset($_REQUEST['degrees']) ? $_REQUEST['degrees'] : 0; // The default degrees is set to 0º
$topleft = (isset($_REQUEST['topleft']) and $_REQUEST['topleft'] == "no") ? false : true; // Top-left rounded corner is shown by default
$bottomleft = (isset($_REQUEST['bottomleft']) and $_REQUEST['bottomleft'] == "no") ? false : true; // Bottom-left rounded corner is shown by default
$bottomright = (isset($_REQUEST['bottomright']) and $_REQUEST['bottomright'] == "no") ? false : true; // Bottom-right rounded corner is shown by default
$topright = (isset($_REQUEST['topright']) and $_REQUEST['topright'] == "no") ? false : true; // Top-right rounded corner is shown by default
if(isset($_REQUEST['toNewPic'])) {
	$toNewPic = mysql_real_escape_string($_REQUEST['toNewPic']);
}
else $toNewPic = "";
if(isset($_REQUEST['beforAddText'])) $beforAddText = $_REQUEST['beforAddText'];

$images_dir = '../images/';
$corner_source = imagecreatefrompng('../images/rounded_corner.png');

$corner_width = imagesx($corner_source);  
$corner_height = imagesy($corner_source);  
$corner_resized = ImageCreateTrueColor($radius, $radius);
ImageCopyResampled($corner_resized, $corner_source, 0, 0, 0, 0, $radius, $radius, $corner_width, $corner_height);

$corner_width = imagesx($corner_resized);  
$corner_height = imagesy($corner_resized);  
$image = imagecreatetruecolor($corner_width, $corner_height);  
$image = imagecreatefromjpeg($images_dir . $filename); // replace filename with $_REQUEST['filename'] 
$size = getimagesize($images_dir . $filename); // replace filename with $_REQUEST['filename'] 
$white = ImageColorAllocate($image,255,255,255);
$black = ImageColorAllocate($image,0,0,0);

// Top-left corner
if ($topleft == true) {
    $dest_x = 0;  
    $dest_y = 0;  
    imagecolortransparent($corner_resized, $black); 
    imagecopymerge($image, $corner_resized, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);
} 

// Bottom-left corner
if ($bottomleft == true) {
    $dest_x = 0;  
    $dest_y = $size[1] - $corner_height; 
    $rotated = imagerotate($corner_resized, 90, 0);
    imagecolortransparent($rotated, $black); 
    imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
}

// Bottom-right corner
if ($bottomright == true) {
    $dest_x = $size[0] - $corner_width;  
    $dest_y = $size[1] - $corner_height;  
    $rotated = imagerotate($corner_resized, 180, 0);
    imagecolortransparent($rotated, $black); 
    imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
}

// Top-right corner
if ($topright == true) {
    $dest_x = $size[0] - $corner_width;  
    $dest_y = 0;  
    $rotated = imagerotate($corner_resized, 270, 0);
    imagecolortransparent($rotated, $black); 
    imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
}

// Rotate image
$image = imagerotate($image, $degrees, $white);
header("Content-type: image/jpeg");
// Output final image
if(isset($beforAddText)) imagejpeg($image,$beforAddText);
if($toNewPic!="")  imagejpeg($image,$toNewPic);
else imagejpeg($image);

imagedestroy($image);  
imagedestroy($corner_source);
if($toNewPic!="") readfile($toNewPic); 
?>
