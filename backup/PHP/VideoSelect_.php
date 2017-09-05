<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
$owner_email = $_SESSION['email_address'];
$queryGroup="SELECT viewer_group,owner_name FROM view_permission where  owner_email = '$owner_email' group by viewer_group";
$Group=mysql_query($queryGroup);          // query executed 
echo mysql_error();


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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../scripts/VideoSelect.js"></script>
	<title>Select and Go Navigation</title>
</head>
<body bgcolor="#FFFFFF">
		<div align="center">
			<form name="f1" method='post'>
				<select id="newLocation" name="SetShow">
				<option value="../video/wedding/09-17-2011_132609.swf" selected>Select a show</option>
				<?php
					while($row = mysql_fetch_array($Group))
					{
					 $viewer_group=$row['viewer_group'];
					 $owner_path=$row['owner_name'];
						$gallery = glob( "../videos/$owner_path/$viewer_group/*.*" );
						array_multisort(
						array_map( 'filemtime', $gallery ),
						SORT_NUMERIC,
						SORT_DESC,
						$gallery
						);				
						foreach ($gallery as $video){
							$pos = strrpos($video, "/") + 1;
							$name = substr($video,$pos);
							$ext = substr($name,strpos($name,".") + 1);
							if($ext == 'mp4' || $ext == 'swf' || $ext == 'flv'){
								if($i==1)  echo "<option value='$video'  selected='selected'>($viewer_group)$name</option>";
								else echo "<option value='$video'>($viewer_group)$name</option>";
								$i++;
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

