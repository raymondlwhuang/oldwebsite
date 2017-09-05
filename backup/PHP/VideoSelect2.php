<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
$GV_email_address = $_SESSION['email_address'];
if ( isset( $_POST["submit_x"] ) ) {
	setcookie('member_name', '', time() - 96 * 3600, '/');
	setcookie('user_name', '', time() - 96 * 3600, '/');
	setcookie('member_pass', '', time() - 96 * 3600, '/');

	unset($_COOKIE['member_name']);
	unset($_COOKIE['user_name']);
	unset($_COOKIE['member_pass']);
	unset( $_SESSION["username"] );
	unset( $_SESSION["private"] );
  
  session_write_close();
//  header( "Location: login.php" );
echo '
  <script language="JavaScript">
  window.open( "../PHP/login.php", "_top");
  </script>';
  exit();
}
$queryGroup="SELECT viewer_group,owner_path FROM view_permission where  owner_email = '$GV_email_address' group by viewer_group";
$Group=mysql_query($queryGroup);          // query executed 
echo mysql_error();
while($row = mysql_fetch_array($Group))
{
	$owner_path = $row['owner_path'];
	$viewer_group = $row['viewer_group'];
//	$group_list[$owner_path] = $viewer_group;
	$queryVideo="SELECT * FROM picture_video where  owner_path = '$owner_path' and picture_video = 'videos' and (viewer_group = '$viewer_group' or viewer_group = '')  order by name";
	$Videos=mysql_query($queryVideo);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($Videos))
	{
//	echo $row3['owner_path']."viewr_group: ".$row3['viewer_group'];
//	echo "<br/>";
		if(!isset($group_list[$owner_path])) $group_list[$owner_path] = $viewer_group;
		$video_list[$owner_path][$viewer_group][] = $row3['name'];
		$disp_name[$owner_path][$viewer_group][] = substr($row3['name'],strripos($row3['name'],"/") + 1);
	} 
}
$queryOthGroup="SELECT viewer_group,owner_path FROM view_permission where  viewer_email = '$GV_email_address' order by viewer_group";
$OtherGroup=mysql_query($queryOthGroup);          // query executed 
echo mysql_error();
while($row2 = mysql_fetch_array($OtherGroup))
{
	$owner_path = $row2['owner_path'];
//	$group_list[$owner_path] = $row2['viewer_group'];
	$queryVideo="SELECT * FROM picture_video where  owner_path = '$owner_path' and picture_video = 'videos' and (viewer_group = '$viewer_group' or viewer_group = '')  order by name";
	$Videos=mysql_query($queryVideo);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($Videos))
	{
		if(!isset($group_list[$owner_path])) $group_list[$owner_path] = $viewer_group;
		$video_list[$owner_path][$viewer_group][] = $row3['name'];
		$disp_name[$owner_path][$viewer_group][] = substr($row3['name'],strripos($row3['name'],"/") + 1);
	} 
}
$queryVideo="SELECT * FROM picture_video where  viewer_group = 'Public' and picture_video = 'videos' order by name";
$Videos=mysql_query($queryVideo);          // query executed 
echo mysql_error();
while($row3 = mysql_fetch_array($Videos))
{
	if(!isset($group_list['Public'])) $group_list['Public'] = 'Public';
	$video_list['Public']['Public'][] = $row3['name'];
	$owner_path = $row3['owner_path'];
	$tst = substr($row3['name'],strripos($row3['name'],"/") + 1);
	$disp_name['Public']['Public'][] = substr($tst,strripos($tst,"$owner_path") + strlen($owner_path) + 1);
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../scripts/VideoSelect2.js"></script>
	<title>Select and Go Navigation</title>
</head>
<body bgcolor="#FFFFFF">
		<div align="center">
			<form name="f1" method='post'>
				<select id="newLocation" name="SetShow">
				<option value="../video/movie.mp4" selected>Select a show</option>
				<?php
					foreach ($group_list as $key => $value)
					{
						foreach ($video_list[$key] as $key2 => $value2)
						{
							foreach ($value2 as $key3 => $value3)
							{
							//echo $disp_name[$key][$value][$key3];
							//echo "<br/>";
							$name = $disp_name[$key][$value][$key3];
							$ext = substr($name,strpos($name,".") + 1);
								echo "<option value='$value3'>$name</option>";
							
							}						
						}
					} 
				echo "</select>";
				?>
				Video might take time to load.
				<input type="image" src="../images/lock.png" name="submit" value="submit" alt="Logout"  style="position:fixed; left:0px; top:0px;" height="40px">
			</form> 
		</div>	
</body>
</html>

