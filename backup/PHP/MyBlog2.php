<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<FRAMESET COLS="*,985,*" border="0" framespacing="0"> 
	<frame src="" frameborder=0 scrolling=no />
	<FRAMESET COLS="240,*,134" border="0" framespacing="0"> 
		<frame src="../PHP/Friends.php" name="Friends" frameborder=0 scrolling=no />
		<FRAMESET ROWS="600,*" border="0" framespacing="0"> 
			<frame src="../PHP/PictureMain.php" name="MyBlog" scrolling=no />
			<frame src="../PHP/MyBlog4.php" name="Remove" frameborder=0 scrolling=no />
		</FRAMESET>
		<frame src="../PHP/Public.php" name="Remove2" frameborder=0 scrolling=no />
	</FRAMESET>
	<frame src="" frameborder=0 scrolling=no />
</FRAMESET>