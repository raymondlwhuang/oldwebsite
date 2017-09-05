<?php 
@session_start();
$_SESSION["profile"] = 'yes';	
include("../config.php");
include("../inc/GlobalVar.inc.php");
include("ResizeImg.php");
include("sethash.php");
$result1 = mysql_query("select * from user where id=$GV_id limit 1");
while($row = mysql_fetch_array($result1)) {
	$profile=$row['profile_picture'];
	$profile_count = $row['profile_count'] + 1;
}
$result2 = mysql_query("select * from profile_picture where user_id=$GV_id");
while($row2 = mysql_fetch_array($result2)) {
	$oldid=$row2['id'];
	$oldprofile["$oldid"]=$row2['profile_picture'];
}

$result3 = mysql_query("select * from user where id=$GV_id limit 1");
while($row3 = mysql_fetch_array($result3)) {
	$profile3=$row3['profile_picture'];
	$pos=strrpos($profile3,"/");
	if($profile3!="../images/profile/default_profile.png") $OrgPicture=substr($profile3,0,$pos)."/original".substr($profile3,$pos);
	else $OrgPicture=$profile3;
	
}
if ($_FILES){
	$limit_size=10* 1024*1000;
	$name = $_FILES['infile']['name']; 
	$Orgpictures = "../images/profile/$GV_owner_path/original/";
	$pictures = "../images/profile/$GV_owner_path/";
	$temppictures = "../temppictures/";
	@mkdir("$pictures");
	@mkdir("$Orgpictures");
	@mkdir("$temppictures");
	
	$targetfilepath= $Orgpictures . $name;
	$picturefilepath= $pictures . $name;
	$temppath=$temppictures . $name;
	$file_size=$_FILES['infile']['size'];
//	if( is_file ($targetfilepath) )	unlink($targetfilepath);
	$message='';
	if($file_size <= $limit_size){
		$result = move_uploaded_file($_FILES['infile']['tmp_name'], $temppath); 
		 
		if ($result){ 
//			ResizeImg::ResizeImage($targetfilepath,240,180,$picturefilepath);
			ResizeImg::ResizeImage($temppath,240,180,$picturefilepath);
			ResizeImg::ResizeImage($temppath,1920,1440,$targetfilepath);
			unlink($temppath);
		    $message .= "<font color='red' size='3'>Your profile picture $name has been Uploaded succefully. </font><br>"; 
			$SaveCheck = "SELECT * FROM profile_picture WHERE user_id=$GV_id and profile_picture='$picturefilepath' LIMIT 1";
			$Checkresult = mysql_query($SaveCheck);
			if (mysql_num_rows($Checkresult) == 0){
				mysql_query("INSERT INTO profile_picture(id,user_id,profile_picture) VALUES($profile_count,$GV_id, '$picturefilepath')");
			}
			else $profile_count = $profile_count - 1;
			$_SESSION["profile_picture"] = "$picturefilepath";
			mysql_query("UPDATE user SET profile_picture='$picturefilepath',profile_count=$profile_count WHERE email_address = '$GV_email_address'");
		}
		else $message .= "<font color='red' size='3'>Profile picture upload Failed! </font><br>"; 
	
	}
	else $message .= "<font color='red' size='3'>File size is over limit! Profile picture upload Failed! </font><br>";
	$_SESSION["message"] = $message;
	echo "
        <script type=\"text/javascript\">
			window.open('ChangeProfile.php',target='_top');
        </script>";
	exit();
}
if(isset($_GET['link']))
{
	$link=newdecode($_GET['link']);
	$pieces = explode(",", $link);
	$id = (int)$pieces[0];
	$name = $pieces[1];
	$pos=strrpos($name,"/");
	$OrgPicture=substr($name,0,$pos)."/original".substr($name,$pos);
	
	$OK=mysql_query("DELETE FROM profile_picture WHERE id = $id and user_id=$GV_id");
	if($OK) {
		unlink($name);
		unlink($OrgPicture);
		$resultCheck=mysql_query("SELECT * FROM user where id = $GV_id and profile_picture='$name' limit 1");  // query string stored in a variable
		if (mysql_num_rows($resultCheck) != 0) {
			mysql_query("update user set profile_count = (profile_count - 1), profile_picture = '../images/profile/default_profile.png' where id=$GV_id limit 1");
			$_SESSION["profile_picture"] = "../images/profile/default_profile.png";
		}
		else {
			mysql_query("update user set profile_count = (profile_count - 1) where id=$GV_id limit 1");
		}
	echo "
        <script type=\"text/javascript\">
			window.open('ChangeProfile.php',target='_top');
        </script>";
	exit();		
	}
}
elseif(isset($_GET['link2']))
{
	$link2=newdecode($_GET['link2']);
	$pieces = explode(",", $link2);
	$id = (int)$pieces[0];
	$name = $pieces[1];
	mysql_query("update user set profile_picture = '$name' where id=$GV_id limit 1");
	$_SESSION["profile_picture"] = "$name";
	echo "
        <script type=\"text/javascript\">
			window.open('ChangeProfile.php',target='_top');
        </script>";
	exit();	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>MY PROFILE PICTURES</title>
<style>
 img {border: 5px grey double;}
 a {text-decoration: none;}
 td#list_profile { border: 1px solid }
.pointer { cursor: pointer } 
</style>
</head>
<body>
<center>
<font style="font-size:18px;color:red;">MY PROFILE PICTURES</font><br/>
<?php include("../PHP/Header.php"); ?>
<table>
<tr>
	<td colspan="2">
		<img src="<?php echo $OrgPicture; ?>" height="550" id="profile" />
	</td>
</tr>
<tr>
<td colspan="2" align="center">

</td>
</tr>
<tr>
<td colspan="2" id="list_profile">
 <?php
 if (isset($oldprofile)){
	foreach($oldprofile as $key=>$picture) {
	$pos=strrpos($picture,"/");
	$OrgPicture=substr($picture,0,$pos)."/original".substr($picture,$pos);
	$link = newencode("$key,$picture");
echo "<table style='display:inline-block;'>
<tr>
<td><img src='$picture' height='70' onClick='document.getElementById(\"profile\").src=\"$OrgPicture\";' class='pointer' /></td>
</tr>
<tr>
<td><a href='ChangeProfile.php?link=$link'  onclick='return confirm(\"Are you sure you want to delete?\");'><img src='../images/delete.png' alt='delete' width='25' /></a>&nbsp;<a href='ChangeProfile.php?link2=$link');'><font style='border: 5px grey double;background-color:#E4E4E4;color:black;position:relative;top:-10px;'>Set as Profile</font></a>
</td>
</tr>
</table>";
	}
}
?>
</td>
</tr>
<tr>
	<td>Upload Profile Picture(Max 2MB):</td>
	<td>
	<form name="uploader" id="uploader" action="" method="POST" enctype="multipart/form-data" > 
	<input id="infile" name="infile" type="file" accept="image/*" onChange="document.getElementById('loading').style.display='block';document.getElementById('uploader').submit();" size="30" style="font-size:20px;border-color:#5050FF;border-width: 3px;"/> 
	</form>
	</td>
</tr>
</table>
<?php 
if(isset($_SESSION["message"])) echo $_SESSION["message"];
unset ($_SESSION['message'], $message);
unset ($_SESSION['message']);
?>
</center>
<div id='BlankMsg' style="display:none;"></div>
<img src="../images/upload.gif" id="loading" />
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript">
var admin = <?php echo $_SESSION["admin"]; ?>;
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
document.getElementById('Profile').style.display = "none";
document.getElementById('loading').style.display='none';
</script>
</body>
</html>