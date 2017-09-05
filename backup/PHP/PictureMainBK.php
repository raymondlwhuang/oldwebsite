<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}

include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My Blog</title>
<script type="text/javascript" src="../scripts/fancydropdown.js"></script>
<script type="text/javascript" src="../scripts/jquery.cycle.all.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#slider-container').cycle({
        fx:     'uncover',
        speed:  1000,
        timeout: 7000,
		pause:	1,
        pager:  '#banner-nav'
	});
});
</script>
</head>
<body>
<table width="100%" border="0" align="left" >
<tr>
	<td width="100%" height="520">
	<?php
if(isset($_GET['FriendEmail'])) {
$FriendEmail = $_GET['FriendEmail'];
if(isset($_GET['show_id'])){
$show_id = $_GET['show_id'];
$longstring = <<<STRINGBEGIN
<iframe src="ShowPictures.php?FriendEmail=$FriendEmail&show_id=$show_id" width="100%" height="520"  frameborder=0 SCROLLING=no>
  <p>Your browser does not support iframes.</p>
</iframe>
STRINGBEGIN;

	echo $longstring;
	}	
}
else {
$longstring = <<<STRINGBEGIN
<iframe src="ShowPictures.php" width="100%" height="520"  frameborder=0 SCROLLING=no>
  <p>Your browser does not support iframes.</p>
</iframe>
STRINGBEGIN;
echo $longstring;	
}	
?>
	</td>
</tr>
</table>

</body>
</html>
		