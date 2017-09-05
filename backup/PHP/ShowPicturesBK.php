<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
$GetSomething=0;
$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$GV_owner_path' and viewer_group <> 'Public' order by upload_id desc limit 1");  // query string stored in a variable
if(mysql_num_rows($beforeShow) != 0) {
	$GetSomething=1;
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pictures Slide Show</title>
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
<body><center>
<?php	
	if(isset($_GET['show_id'])){ $upload_id = $_GET['show_id'];	}
	if(isset($upload_id)){
		$resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and upload_id = '$upload_id' order by upload_id desc");  // query string stored in a variable
	}
	if(!isset($upload_id) || mysql_num_rows($resultShow) ==0)
	{
		$beforeShow2=mysql_query("SELECT * FROM picture_video where owner_path = '$GV_owner_path' and picture_video = 'pictures' and viewer_group <> 'Public' order by upload_id desc limit 1");  // query string stored in a variable
		if(mysql_num_rows($beforeShow2) == 0) {
			if($GetSomething==0) $beforeShow2=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public' order by upload_id desc limit 1");  // query string stored in a variable
		}
		while($row6 = mysql_fetch_array($beforeShow2))
		{
			$upload_id = $row6['upload_id'];
		}
		if(isset($upload_id)) $resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and upload_id = '$upload_id'");  // query string stored in a variable
	}
//	$resultShow=mysql_query($queryShow);          // query executed 
			$countimg = 0;
			echo '<div style="overflow: hidden;" id="slider-container">';
			if(@mysql_num_rows($resultShow) == 1) {
			  $countimg++;
			  $content ='<div style="display: none; opacity: 1;height: 600px;" id="banner'."$countimg".'">';
			  $content = "$content"."<img src='$GV_profile_picture' height=420px border='0'>";
			  $content = "$content".'</div>';
			  echo "$content";			
			}			
			while(@$row3 = mysql_fetch_array($resultShow)) {
			  $countimg++;
			  $content ='<div style="display: none; opacity: 1;height: 600px;cursor: pointer" id="banner'."$countimg".'">';
			  $content = "$content"."<img src='$row3[name]' height=420px border='0'><br />
							<iframe src='ShowComments.php?picture_id=$row3[id]' width='600' height='100%'  frameborder=0 SCROLLING=no>
							  <p>Your browser does not support iframes.</p>
							</iframe>";
			  $content = "$content".'</div>';
			  echo "$content";
			};
		echo '</div>';		
	
	
?>
</center>		
</body>
</html>