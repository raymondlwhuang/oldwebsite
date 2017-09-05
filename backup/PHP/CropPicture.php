<?php
session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
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
if(isset($_REQUEST['thisPicture'])) $thisPicture=mysql_real_escape_string($_REQUEST['thisPicture']);
$pieces = explode("/", $thisPicture);
//var_dump($pieces);
if(isset($pieces[4])) {
 $toNewPic=$pieces[0]."/".$pieces[1]."/".$pieces[2]."/".$pieces[3]."/"."temp1".$pieces[4];
 $toNewPic2=$pieces[0]."/".$pieces[1]."/".$pieces[2]."/".$pieces[3]."/"."temp2".$pieces[4];
 $toNewPic3=$pieces[0]."/".$pieces[1]."/".$pieces[2]."/".$pieces[3]."/"."temp3".$pieces[4];
}
else {
 $toNewPic=$pieces[0]."/".$pieces[1]."/".$pieces[2]."/"."temp1".$pieces[3];
 $toNewPic2=$pieces[0]."/".$pieces[1]."/".$pieces[2]."/"."temp2".$pieces[3];
 $toNewPic3=$pieces[0]."/".$pieces[1]."/".$pieces[2]."/"."temp3".$pieces[3];
}
$EditMode=true;
$picturefilepath= "../pictures/$GV_owner_path/temp";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
		<title>PHP Image Editor Service</title>
	<script type="text/javascript" src="../scripts/jquery.js"></script>
	<script type="text/javascript" src="../scripts/jquery.jcrop.js"></script>
	<script type="text/javascript" src="../scripts/jquery.numeric.js"></script>
	<script type="text/javascript" src="../scripts/jquery-ui-1.8.20.custom.min.js"></script>
	<script type="text/javascript" src="../scripts/colorpicker.js"></script>
	<script type="text/javascript" src="../scripts/phpimageeditor.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/phpimageeditor.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body>
	<div id="phpImageEditor">
			<input id="const-menuresize" value="0" type="hidden">
			<input id="const-menurotate" value="1" type="hidden">
			<input id="const-menucrop" value="2" type="hidden">
			<input id="const-menueffects" value="3" type="hidden">
			<input id="const-menutext" value="4" type="hidden">
			<input id="const-menusaveas" value="5" type="hidden">
			<input id="const-ajaxposttimeoutms" value="20000" type="hidden"> 
			<div class="tabs">
				<div id="actionContainer">
					<div style="opacity: 0; display: none;" id="panel_0" class="panel">
						<table border="0" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td>	
									<div class="field widthAndHeight">
										<div class="col-1">
											<label for="width">Width</label>
											<input class="input-number" name="width" id="width" value="1000" type="text">
											<input name="widthoriginal" id="widthoriginal" value="1000" type="hidden">
										</div>
										<div class="col-2">
											<label for="height">Height</label>
											<input class="input-number" name="height" id="height" value="500" type="text">
											<input name="heightoriginal" id="heightoriginal" value="500" type="hidden">
										</div>
									</div>
								</td>
								<td>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<div >
						<input class="input-number" name="croptop" id="croptop" value="103" type="hidden">
						<input class="input-number" name="cropleft" id="cropleft" value="157" type="hidden">
						<input class="input-number" name="cropright" id="cropright" value="155" type="hidden">
						<input class="input-number" name="cropbottom" id="cropbottom" value="80" type="hidden">
						<table border="0" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td>
												<div class="field">
													<label for="cropwidth">Crop width</label>
													<input class="input-number" name="cropwidth" id="cropwidth" value="688" type="text">
												</div>
											</td>
											<td>
												<div class="field">
													<label for="cropheight">Crop height</label>
													<input class="input-number" name="cropheight" id="cropheight" value="317" type="text">
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="field">
													<label for="cropx">Startposition x</label>
													<input class="input-number" name="cropx" id="cropx" value="157" type="text">
												</div>
											</td>
											<td>
												<div class="field">
													<label for="cropy">Startposition y</label>
													<input class="input-number" name="cropy" id="cropy" value="103" type="text">
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<div class="field" id="cropkeepproportions-container">
													<input id="cropkeepproportions" class="checkbox" name="cropkeepproportions" type="checkbox">
													<label class="checkbox" for="cropkeepproportions">Constrain crop proportions</label>
													<input id="cropkeepproportionsval" name="cropkeepproportionsval" value="0" type="hidden">									
													<input id="cropkeepproportionsratiow" name="cropkeepproportionsratiow" value="1" type="hidden">									
													<input id="cropkeepproportionsratioh" name="cropkeepproportionsratioh" value="1" type="hidden">									
												</div>
											</td>
										</tr>
									</tbody></table>											
								</td>
								<td valign="top">
									<div class="help" id="crophelp">
										<div class="help-header" id="crophelpheader">Instructions</div>
										<div class="help-content" id="crophelpcontent">Drag and drop to create a crop area on the image.<br>Or use the fields to do the cropping.</div>
									</div>
								</td>
							</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
			<input name="panel" id="panel" value="2" type="hidden">
		<div id="editimage">
		<img id="image" style="position: absolute; left: 0px; top: 0px; width: 1000px; height: 500px; display: block;" alt="" src="a_data/1189_1336491219_96_125_130_146_1336491219_96_125_130_146.png">
		</div>	
	</div>
</body>
</html>
</body>
</html>