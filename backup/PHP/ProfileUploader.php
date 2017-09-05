<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php
include("../config.php");
require_once("../inc/GlobalVar.inc.php");
$result = mysql_query("select * from user where id=$GV_id limit 1");
while($row = mysql_fetch_array($result)) {
	$profile=$row['profile_picture'];
	$profile_count = $row['profile_count'] + 1;
}
$uploader=new PhpUploader();

$mvcfile=$uploader->GetValidatingFile();

if($mvcfile->FileName=="accord.bmp")
{
	$uploader->WriteValidationError("My custom error : Invalid file name. ");
	exit(200);
}

//USER CODE:
$pictures = "../images/profile/$GV_owner_path/";
@mkdir("$pictures");
	$targetfilepath= "../images/profile/$GV_owner_path/" . $mvcfile->FileName;
if( is_file ($targetfilepath) )	unlink($targetfilepath);

$SaveCheck = "SELECT * FROM profile_picture WHERE user_id=$GV_id and profile_picture='$targetfilepath' LIMIT 1";
$Checkresult = mysql_query($SaveCheck);
if (mysql_num_rows($Checkresult) == 0){
	mysql_query("INSERT INTO profile_picture(id,user_id,profile_picture) VALUES($profile_count,$GV_id, '$targetfilepath')");
}
else $profile_count = $profile_count - 1;
mysql_query("UPDATE user SET profile_picture='$targetfilepath',profile_count=$profile_count WHERE email_address = '$GV_email_address'");
$_SESSION["profile_picture"] = "$targetfilepath";

$mvcfile->MoveTo( $targetfilepath );

$uploader->WriteValidationOK();

?>