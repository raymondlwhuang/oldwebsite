<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php
include("../config.php");
require_once("../inc/GlobalVar.inc.php");
require_once("../inc/CurrentDateTime.inc.php");
$viewer_group = $_SESSION["viewer_group"];
$description = $_SESSION["descriptionPV"];
$picture_video = $_SESSION["picture_video"];
$uploader=new PhpUploader();

$mvcfile=$uploader->GetValidatingFile();

if($mvcfile->FileName=="accord.bmp")
{
	$uploader->WriteValidationError("My custom error : Invalid file name. ");
	exit(200);
}

//USER CODE:
$pictures = "../pictures/$GV_owner_path/";
$videos = "../videos/$GV_owner_path/";
@mkdir("$pictures");
@mkdir("$videos");
if($viewer_group!='' && $viewer_group !='Public')
{
	@mkdir("../pictures/$GV_owner_path/$viewer_group/");
	@mkdir("../videos/$GV_owner_path/$viewer_group/");
}
$public=md5($GV_id);
if($viewer_group =='')
	$targetfilepath= "../$picture_video/$GV_owner_path/" . $mvcfile->FileName;
elseif($viewer_group =='Public')
	$targetfilepath= "../$picture_video/$public" . $mvcfile->FileName;
else
	$targetfilepath= "../$picture_video/$GV_owner_path/$viewer_group/" . $mvcfile->FileName;
if( is_file ($targetfilepath) )	unlink($targetfilepath);

$today = substr($now,0,10);
$vRes = mysql_query("SELECT * FROM `upload_infor` where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' limit 1");
if (mysql_num_rows($vRes) == 0){
	mysql_query("INSERT INTO upload_infor(user_id,viewer_group,description,upload_date) VALUES($GV_id,'$viewer_group','$description','$today')");
}
if(!isset($description)) $description ="";
$queryUploadID="SELECT id FROM upload_infor where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' limit 1";
$GetUploadID=mysql_query($queryUploadID);          // query executed 
echo mysql_error();
while($GetUploadIDRow = mysql_fetch_array($GetUploadID))
{
	$upload_id = $GetUploadIDRow['id'];
}
mysql_query("INSERT INTO picture_video(owner_path,picture_video,viewer_group,name,upload_id) VALUES('$GV_owner_path','$picture_video', '$viewer_group', '$targetfilepath',$upload_id)");	
echo mysql_error();
$mvcfile->MoveTo( $targetfilepath );

$uploader->WriteValidationOK();

?>