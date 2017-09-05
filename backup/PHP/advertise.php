<?php
session_start();
include("../config.php");
$query="SELECT * FROM advertisement where is_active = 1 and expire_date >= NOW() order by id desc";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$markup = '<div  id="slideshow">';
$pictureCount=0;
if(mysql_num_rows($result) == 0) {
	$resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public'");  // query string stored in a variable
	while($row3 = mysql_fetch_array($resultShow)) {
		$pictureCount++;
		$markup .= "<img class=\"pointer\" style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 200px;\" src=\"$row3[name]\" height=\"200\">";
	};	
}
while($nt=mysql_fetch_array($result)){
	$pictureCount++;
	if($nt['msg_flag'] == 1) {
	$markup .= "<div style='height:200px;width:250px;font-size:18px;text-align:center;'>	
	$nt[message]
	</div>";
	}
	if($nt['disp_flag'] == 1) {
	$markup .= "<div style='text-align:center;'>	
	<img class=\"pointer\" style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 200px;\" src=\"$nt[display]\" height=\"200\">
	</div>
	";
	}
}
if($pictureCount==1) $markup .= "<img style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 200px;\" src=\"../images/blank.jpg\" height=\"200\">";
$markup .= '</div>';	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Help listing</title>

</head>
<body>
		<div id="show">
		<?php echo $markup; ?>
		</div>
<?php	
/*
$totalHeight = 0;
while($nt=mysql_fetch_array($result)){
	if($nt['msg_flag'] == 1) {
	$totalHeight = $totalHeight + 200;
	echo "<div style='height:200px;color:yellow;text-align:center;'>	
	$nt[message]
	</div>";
	}
	if($nt['disp_flag'] == 1) {
	$totalHeight = $totalHeight + 200;
	echo "<div style='text-align:center;'>	
	<img src='$nt[display]' height='200px' />
	</div>
	";
	}
}*/
?>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/jquery.cycle.all.js"></script>
<script type="text/javascript">
var fxcount=0,startingSlide=0;
$(document).ready(function() {
		$('#slideshow').cycle({
			fx: 'scrollUp', // choose your transition type, ex: fade, scrollUp, shuffle,scrollLeft,zoom etc...
			startingSlide: startingSlide
		});
});
</script>
</body>
</html>
	