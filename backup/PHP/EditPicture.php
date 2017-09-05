<?php
session_start();
include("getFiles.php");
include("../config.php");
include("CopyImg.php");

if(isset($_SESSION['private']) && $_SESSION['private'] == "yes") include("../inc/GlobalVar.inc.php");
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
if(isset($GV_id)) $tempname=$GV_id; else $tempname=session_id();
if ($_FILES){
	$limit_size=10* 1024*1000;
	$name = $_FILES['infile']['name']; 
	$thisPicture = "../Orgpictures/";
	@mkdir("$thisPicture");
	
	$targetfilepath= $thisPicture . $name;
	$file_size=$_FILES['infile']['size'];
	if($file_size <= $limit_size){
		$result = move_uploaded_file($_FILES['infile']['tmp_name'], $targetfilepath); 
		if ($result){ 
			echo "
				<script type=\"text/javascript\">
					window.open('EditPicture.php?thisPicture=$targetfilepath',target='_top');
				</script>";
			exit();
		}
	}
}

if(isset($_REQUEST['thisPicture'])) $thisPicture=$_REQUEST['thisPicture'];
if(isset($_REQUEST['org_picture'])) $org_picture=$_REQUEST['org_picture'];
else $org_picture=$thisPicture;

	$targetfilepath = "../".date('YMd')."/";
	@mkdir("$targetfilepath");

$pieces = explode("/", $thisPicture);
//var_dump($pieces);
//echo session_id();
if(isset($pieces[4])) {
 $ext = explode(".", $pieces[4]);
}
elseif(isset($pieces[3])) {
 $ext = explode(".", $pieces[3]);
}
else {
 $ext = explode(".", $pieces[2]);
}
$CropPic=$targetfilepath."temp".$tempname.".jpg";
$firstPic=$targetfilepath."temp5".$tempname.".jpg";
$toNewPic=$targetfilepath."temp1".$tempname.".jpg";
$toNewPic2=$targetfilepath."temp2".$tempname.".jpg";
$toNewPic3=$targetfilepath."temp3".$tempname.".jpg";
$toNewPic4=$targetfilepath."temp4".$tempname.".jpg";
$beforAddText=$targetfilepath."temp6".$tempname.".jpg";
$image = new CopyImg;
$image->setImage("$thisPicture",7,"$targetfilepath","temp","$tempname");

/*
copy("$thisPicture","$firstPic");
copy("$thisPicture","$CropPic");
copy("$thisPicture","$toNewPic");
copy("$thisPicture","$toNewPic2");
copy("$thisPicture","$toNewPic3");
copy("$thisPicture","$toNewPic4");
copy("$thisPicture","$beforAddText");
*/
$EditMode=true;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<head>
	<title>PHP Image Editor Service</title>
	<script type="text/javascript" src="../scripts/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../css/imgareaselect-default.css">
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript">
function getwidth(img, selection) {
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;
    $('#cropx').val(selection.x1);
    $('#cropy').val(selection.y1);
//    $('#x2').val(selection.x2);
//    $('#y2').val(selection.y2);
    $('#cropwidth').val(selection.width);
    $('#cropheight').val(selection.height);    
}

$(function () {
    $('#image').imgAreaSelect({ handles: true, onSelectChange: getwidth });
});
</script>	
	<link rel="stylesheet" type="text/css" href="../css/phpimageeditor.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="../scripts/slider.js"></script>
	<link href="../css/default.css" rel="stylesheet" type="text/css">
<!-- The page stylesheet below contains modifications to the default slider and page specific styling -->
	<style type="text/css">
	/* Stylesheet for sliders (only properties that differ from default) */
	#horizontal_slider_1,#horizontal_slider_2,#horizontal_slider_3,#horizontal_slider_4,
	#horizontal_slider_5,#horizontal_slider_6,#horizontal_slider_7,#horizontal_slider_8,#horizontal_slider_9,
	#horizontal_slider_10,#horizontal_slider_11,#horizontal_slider_12,#horizontal_slider_13,#horizontal_slider_14,#horizontal_slider_15 {
		background-color: #696;
		border-color: #9c9 #363 #363 #9c9;
		}
	#horizontal_track_1,#horizontal_track_2,#horizontal_track_3,#horizontal_track_4,#horizontal_track_5,#horizontal_track_6,#horizontal_track_7,#horizontal_track_8,#horizontal_track_9,#horizontal_track_10,#horizontal_track_11,#horizontal_track_12,#horizontal_track_13,#horizontal_track_14,#horizontal_track_15,
	#display_holder_1,#display_holder_2,#display_holder_3,#display_holder_4,#display_holder_5,#display_holder_6,#display_holder_7,#display_holder_8,#display_holder_9,#display_holder_10,#display_holder_11,#display_holder_12,#display_holder_13,#display_holder_14,#display_holder_15 {
		background-color: #bdb;
		border-color: #ded #9a9 #9a9 #ded;
		}
	#horizontal_slit_1,#horizontal_slit_2,#horizontal_slit_3,#horizontal_slit_4,#horizontal_slit_5,#horizontal_slit_6,#horizontal_slit_7,#horizontal_slit_8,#horizontal_slit_9,#horizontal_slit_10,#horizontal_slit_11,#horizontal_slit_12,#horizontal_slit_13,#horizontal_slit_14,#horizontal_slit_15 {
		background-color: #232;
		border-color: #9a9 #ded #ded #9a9;
		}
	#Contrast, #Smoothvalue, #Brightness, #Pixelate,#red,#green,#blue,#resize,#degrees,#radius,#fontsize,#textrotate,#FontR,#FontG,#FontB {
		background-color: #bdb;
		color: #363;
		}
	.pointer { cursor: pointer }

	</style>
</head>
<body>
<center>
<?php 
	if(isset($GV_id)) include("../PHP/Header.php"); 
	else  include("../PHP/Header2.php"); 

?>
</center>
<div id="phpImageEditor">
	<div class="tabs">
	<div class="pointer" id="croptab" style="display:inline-block;background-image: url(../images/tab_selected.png); height: 29px; width: 100px;text-align:center;font-weight:bold;" onclick="ShowOpt(0);" ><p style="line-height: 10px;">Crop Image</p></div>
	<div class="pointer" id="effecttab" style="display:inline-block;background-image: url(../images/tab_not_selected.png); height: 29px; width: 100px;text-align:center;color:white;font-weight:bold;" onclick="ShowOpt(1);" ><p style="line-height: 10px;">Effect</p></div>
	<div class="pointer" id="texttab" style="display:inline-block;background-image: url(../images/tab_not_selected.png); height: 29px; width: 100px;text-align:center;color:white;font-weight:bold;" onclick="ShowOpt(2);" ><p style="line-height: 10px;">Text</p></div>
	<div style="display:inline-block;">Upload File</div>
	<div class="pointer" style="display:inline-block; height: 24px; width: 300px;" >
		<form name="uploader" id="uploader" action="" method="POST" enctype="multipart/form-data" > 
			<input id="infile" name="infile" type="file" accept="image/*" onChange="document.getElementById('loading').style.display='block';document.getElementById('uploader').submit();" size="30" style="height: 24px;"/>
		</form>
	</div>
	<input type="hidden" id="cur_picture" value="<?php echo $thisPicture; ?>" size="200">
	<input type="hidden" id="org_picture" value="<?php echo $org_picture; ?>" size="200">

	<div id="actionContainer">
		<input type="button" value="Reset" id="Resetbtn" style="vertical-align:bottom;" onclick="window.open('EditPicture.php?thisPicture='+document.getElementById('org_picture').value,target='_top');" >
		<div style="display:inline-block;vertical-align:top;" id="cropopt">
			<table border="0" cellpadding="0" cellspacing="0" style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
				<tbody>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td>
									<div class="field">
										<label for="cropwidth">Crop width</label>
										<input class="input-number" name="cropwidth" id="cropwidth" value="0" type="text">
									</div>
								</td>
								<td>
									<div class="field">
										<label for="cropheight">Crop height</label>
										<input class="input-number" name="cropheight" id="cropheight" value="0" type="text">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="field">
										<label for="cropx">Startposition x</label>
										<input class="input-number" name="cropx" id="cropx" value="0" type="text">
									</div>
								</td>
								<td>
									<div class="field">
										<label for="cropy">Startposition y</label>
										<input class="input-number" name="cropy" id="cropy" value="0" type="text">
									</div>
								</td>
							</tr>
						</tbody>
						</table>
						
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
						<div class="help" id="crophelp">
						<div class="help-header" id="crophelpheader">Instructions</div>
						<div class="help-content" id="crophelpcontent">Drag and drop to create a crop area on the<br> image.Or use the fields to do the cropping.</div>
						</div>
						<input type="button" value="Crop" id="cropbtn" onclick="cropImage();">
					</td>
				</tr>
			</tbody>
			</table>
		</div>
		<?php require_once 'FilterSel2.php'; ?>
	</div>
	<input name="panel" id="panel" value="2" type="hidden">
	</div>
</div>

<div id="editimage" onclick="point_it(event)">
<img id="image" style="position: absolute; left: 0px; top: 0px; display: block;" alt="" src="<?php echo $thisPicture."?time_x=".time(); ?>" />
</div>
<div id='BlankMsg' style="display:none;"></div>
<?php if(isset($GV_id)) : ?>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=1 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#E6FFE6;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<?php endif; ?>
<script type="text/javascript">
var user_id = "<?php echo $tempname; ?>";
var CropPic="<?php echo $CropPic; ?>";
var firstPic="<?php echo $firstPic; ?>";
var toNewPic="<?php echo $toNewPic; ?>";
var toNewPic2="<?php echo $toNewPic2; ?>";
var toNewPic3="<?php echo $toNewPic3; ?>";
var toNewPic4="<?php echo $toNewPic4; ?>";
var beforAddText="<?php echo $beforAddText; ?>";
var cur_picture=document.getElementById('cur_picture').value;
var org_picture=document.getElementById('org_picture').value;
if(cur_picture !=org_picture) document.getElementById('crophelpcontent').innerHTML = "Drag and drop to create a crop area on the<br> image.Or use the fields to do the cropping.<br/>TEXT had been removed for croping purpose";
</script>
<script type="text/javascript" src="../scripts/ImgEdit.js"></script>
<?php if(isset($GV_id)) : ?>
<script src="../scripts/chat.js"></script>
<?php endif; ?>
</body>
</html>