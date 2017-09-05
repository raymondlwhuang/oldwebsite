<?php
@session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
include("sethash.php");
if(isset($_GET['link']))
{
	$link=newdecode($_GET['link']);
	$pieces = explode(",", $link);
	$id = (int)$pieces[0];
	$name = $pieces[1];
	$FriendPath = $pieces[2];
	$pos=strrpos($name,"/");
	$OrgPicture1=substr($name,0,$pos)."/original".substr($name,$pos);
	$OK=mysql_query("DELETE FROM profile_picture WHERE id = $id");
	if($OK) {
		unlink($name);
		unlink($OrgPicture1);
		$resultCheck=mysql_query("SELECT * FROM user where owner_path = '$FriendPath' and profile_picture='$name' limit 1");  // query string stored in a variable
		if (mysql_num_rows($resultCheck) != 0) {
			mysql_query("update user set profile_count = (profile_count - 1), profile_picture = '../images/profile/default_profile.png' where  owner_path = '$FriendPath' limit 1");
			$_SESSION["profile_picture"] = "../images/profile/default_profile.png";
		}
		else {
			mysql_query("update user set profile_count = (profile_count - 1) where  owner_path = '$FriendPath' limit 1");
		}
	echo "
        <script type=\"text/javascript\">
			window.open('ProfilePicture.php?FriendPath=$FriendPath',target='_top');
        </script>";
	exit();		
	}
}

if(isset($_GET['FriendPath'])) $FriendPath = $_GET['FriendPath']; else $FriendPath='Public';
//echo $FriendPath;
if(strtolower($FriendPath)!='public') {
	$queryUserID=mysql_query("SELECT * FROM user where owner_path = '$FriendPath'");  // query string stored in a variable
	while($row = mysql_fetch_array($queryUserID)) {
		$name= $row['first_name']." ".$row['last_name']."'s Profile Pictures";
		$user_id = $row['id'];
	}
	$result2 = mysql_query("select * from profile_picture where user_id=$user_id");
	if (mysql_num_rows($result2) != 0){
		while($row2 = mysql_fetch_array($result2)) {
			$pp_id[]=$row2['id'];
			$oldprofile[]=$row2['profile_picture'];
			$pos=strrpos($row2['profile_picture'],"/");
			if($row2['profile_picture']!="../images/profile/default_profile.png") $OrgPicture[]=substr($row2['profile_picture'],0,$pos)."/original".substr($row2['profile_picture'],$pos);
			else $OrgPicture[]="../images/profile/default_profile.png";
		}
	}
	else {
		$oldprofile[]="../images/profile/default_profile.png";
		$OrgPicture[]="../images/profile/default_profile.png";
	}
}
else {
 $oldprofile[]="../images/profile/default_profile.png";
 $OrgPicture[]="../images/profile/default_profile.png";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Profile Picture Upload</title>
<style>
 img {border: 5px grey double;}
 .pointer { cursor: pointer }
</style>

</head>
<body>
<center>
<?php if(isset($name)) echo strtoupper($name); ?>
<table>
<tr>
<td align="center">
<?php include("../PHP/Header.php"); ?>
</td>
</tr>
<tr>
<td>
<img src="<?php echo $OrgPicture[0] ?>" height="600" id="profile">
</td>
</tr>
<tr>
<td id="list_profile" align="center">
 <?php
 if (isset($oldprofile)){
	foreach($oldprofile as $key=>$picture) {
	   echo "<img src='$picture' height='100' onClick='document.getElementById(\"profile\").src=\"$OrgPicture[$key]\";' class='pointer'/>";
	   if(isset($pp_id)){
		   $link = newencode("$pp_id[$key],$picture,$FriendPath");
		   if($_SESSION["admin"]==1) echo "<a href='ProfilePicture.php?link=$link'  onclick='return confirm(\"Are you sure you want to delete?\");'><img src='../images/delete.png' alt='delete' width='25' /></a>";
	   }
	}
}
?>
</td>
</tr>
</table>
</center>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
</body>
</html>