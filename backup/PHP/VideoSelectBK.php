<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
				$dir='../videos/wedding/';
				$dh = opendir($dir);
				$i=1;
				while ($filename=readdir($dh)){
					if(preg_match('/^.+\.mp4$|^.+\.flv$|^.+\.swf$/', $filename)){		// | mean or
						$gallery[]=$filename;
					} 
				}
				foreach ($gallery as $vedio){
					if($i==1)  echo "<option value='$vedio'  selected='selected'>$vedio</option>";
					else echo "<option value='$vedio'>$vedio</option>";
					$i++;
				}
				echo "</select>";
				?>
				Video might take time to load.
				<input type="image" src="../images/lock.png" name="submit" value="submit" alt="Logout"  style="position:fixed; left:0px; top:0px;" height="40px">
			</form> 
		</div>	
</body>
</html>

