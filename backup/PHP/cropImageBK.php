<?php

if(isset($_REQUEST['filename'])) {
	if (isset($_REQUEST['filename'])) $filename = mysql_real_escape_string($_REQUEST['filename']); // text to display
	if (isset($_REQUEST['x'])) $x = mysql_real_escape_string($_REQUEST['x']); // font to use (include directory if needed).
	if (isset($_REQUEST['y'])) $y = $_REQUEST['y']; // fontsize in points
	if (isset($_REQUEST['cropWidth'])) $cropWidth = $_REQUEST['cropWidth']; // cropWidth
	if (isset($_REQUEST['cropHeight'])) $cropHeight = $_REQUEST['cropHeight']; // cropHeightding in pixels around text.
	if(isset($_REQUEST['CropPic'])) {
	$CropPic = $_REQUEST['CropPic'];
//	unlink($CropPic);
	}
	else $CropPic = "";	
	$image = new cropImage;
	$image->setImage($filename,$x,$y,$cropWidth,$cropHeight);
	$image->createThumb();
	$image->renderImage($CropPic);
}

class cropImage{
	function setImage($filename,$x,$y,$cropWidth,$cropHeight)
	{
	   list($width, $height) = getimagesize($filename); 
	   $this->myImage = imagecreatefromstring(file_get_contents($filename)) or die("Error: Cannot find image!"); 
						 
	//The crop size will be half that of the largest side 
	   $this->cropWidth   = $cropWidth; 
	   $this->cropHeight  = $cropHeight; 
	   $this->Width   = $width; 
	   $this->Height  = $height; 
						 
	//getting the top left coordinate
	   $this->x = $x;
	   $this->y = $y;
				 
	}  

	function createThumb()
	{
	  $this->thumb = imageCreateTrueColor($this->cropWidth, $this->cropHeight); 
	  imageCopyResampled($this->thumb, $this->myImage, 0, 0,$this->x, $this->y, $this->Width, $this->Height, $this->Width, $this->Height); 
	}
	function renderImage($CropPic="")
	{
	   //header('Content-type: image/jpeg');
	   if($CropPic=="") {
		   imagejpeg($this->thumb);
		   imagedestroy($this->thumb); 
	   }
	   else { 
		   imagejpeg($this->thumb,$CropPic);
		   readfile($CropPic); 
		   imagedestroy($CropPic);
	   }
	}
}
