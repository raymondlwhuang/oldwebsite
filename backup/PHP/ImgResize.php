<?php 
if(isset($_REQUEST['filename'])) {
	if(isset($_REQUEST['filename'])) $filename = $_REQUEST['filename'];
	else $filename = "../images/Question.jpg";
	if(isset($_REQUEST['Percent'])) $Percent = $_REQUEST['Percent'];
	else $Percent = 100;
	if(isset($_REQUEST['EditMode'])) $EditMode = (int)$_REQUEST['EditMode'];
	else $EditMode = 0;
	$image = new ImgResize;
	$image->setImage($filename);
	$image->ResizeImage($Percent);
	$image->renderImage();
}
class ImgResize{
 var $imgSrc,$myImage,$cropHeight,$cropWidth,$x,$y,$thumb; 
	function setImage($image)
	{
	   $this->imgSrc = $image; // the image source
	   list($width, $height,$type, $attr) = getimagesize($this->imgSrc); 	//getting the image dimensions
	   $this->myImage = imagecreatefromstring(file_get_contents($this->imgSrc)) or die("Error: Cannot find image!"); 	//create image from the jpeg
	   //getting the top left coordinate
	   $this->width = $width;
	   $this->height = $height;
	} 
	function ResizeImage($Percent)
	{
		$dest_x = $this->width *$Percent/100;
		$dest_y = $this->height *$Percent/100;
		$this->image = imageCreateTrueColor($dest_x, $dest_y) or die ('failed imageCreateTrueColor'); 

		imageCopyResampled($this->image, $this->myImage, 0, 0, 0, 0, $dest_x, $dest_y, $this->width, $this->height) or die ('failed imageCopyResampled');

	}	
	function renderImage()
	{
	   header('Content-type: image/jpeg');
	   imagejpeg($this->image);
	   imagedestroy($this->image); 
	}	
}