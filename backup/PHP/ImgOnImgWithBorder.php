<?php
if(isset($_REQUEST['second_img'])) {
	if(isset($_REQUEST['first_img'])) $first_img = $_REQUEST['first_img'];
	else $first_img = "../images/Folder.png";
	if(isset($_REQUEST['second_img'])) $second_img = $_REQUEST['second_img'];
	else $second_img = "../images/Question.jpg";
	list($FirstImg_w, $FirstImg_h, $FirstImg_t, $FirstImg_a) = getimagesize($first_img);
	// pointer position:
	if(isset($_REQUEST['Xposition'])) $Xposition = (int)$_REQUEST['Xposition'];
	else $Xposition = 25;
	if(isset($_REQUEST['Yposition'])) $Yposition = (int)$_REQUEST['Yposition'];
	else $Yposition = 20;
	if(isset($_REQUEST['pct'])) $pct = (int)$_REQUEST['pct'];
	else $pct = 100;
	if(isset($_REQUEST['ResizePct'])) $ResizePct = (int)$_REQUEST['ResizePct'];
	else $ResizePct = 75;

	$image = new ImageOnImage;
	$image->setImage($first_img,$second_img);
	$image->ResizeSecondToPercentOfFistImage($ResizePct);
	$image->renderImage($Xposition,$Yposition,$pct);
}
class ImageOnImage{
 var $firstImgSrc,$firstImage,$secondImgSrc,$secondImage,$firstImgWidth,$firstImgHeight,$secondImgWidth,$secondImgHeight,$ratio,$secondNewWith,$secondNewHeight,$SecondImageSmall,$newimage; 
	function setImage($first_img,$second_img)
	{
	   $this->firstImgSrc = $first_img; // the first_img source
	   list($firstWidth, $firstHeight,$firstType, $firstAttr) = getimagesize($this->firstImgSrc); 	//getting the image dimensions
	   $this->firstImage = imagecreatefromstring(file_get_contents($this->firstImgSrc)) or die("Error: Cannot find image!"); 	//create image from the jpeg
	   $this->secondImgSrc = $second_img; // the second_img source
	   list($secondWidth, $secondHeight,$secondType, $secondAttr) = getimagesize($this->secondImgSrc); 	//getting the image dimensions
	   $this->secondImage = imagecreatefromstring(file_get_contents($this->secondImgSrc)) or die("Error: Cannot find image!"); 	//create image from the jpeg
	   $this->firstImgWidth = $firstWidth;
	   $this->firstImgHeight = $firstHeight;
	   $this->secondImgWidth = $secondWidth;
	   $this->secondImgHeight = $secondHeight;
	   $this->ratio=$firstWidth/$secondWidth;
	} 
	function ResizeSecondToPercentOfFistImage($Percent)
	{
	    $this->secondNewWith = $this->secondImgWidth * $this->ratio * $Percent/100;
	    $this->secondNewHeight = $this->secondImgHeight * $this->ratio  * $Percent/100;
		$this->SecondImageSmall = imageCreateTrueColor($this->secondNewWith, $this->secondNewHeight) or die ('failed imageCreateTrueColor'); 
		imageCopyResampled($this->SecondImageSmall, $this->secondImage, 0, 0, 0, 0, $this->secondNewWith, $this->secondNewHeight, $this->secondImgWidth, $this->secondImgHeight) or die ('failed imageCopyResampled');
		$img_adj_width=$this->secondNewWith+10; 
		$img_adj_height=$this->secondNewHeight+10;
		$this->newimage=imagecreatetruecolor($img_adj_width,$img_adj_height);
		// add border to image
		imagefilledrectangle($this->newimage,0,0,$img_adj_width,$img_adj_height,16777215);

		imageCopyResampled($this->newimage,$this->SecondImageSmall,2,2,0,0,$this->secondNewWith-4,$this->secondNewHeight-4,$this->secondNewWith,$this->secondNewHeight); 
	
	}
	function renderImage($Xposition, $Yposition,$pct)
	{
	   imagecopymerge($this->firstImage, $this->newimage, $Xposition, $Yposition, 0, 0, $this->secondNewWith, $this->secondNewHeight, $pct); 
	   header('Content-type: image/jpeg');
	   imagejpeg($this->firstImage);
	   imagedestroy($this->firstImage); 
	}	
}