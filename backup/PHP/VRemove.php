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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
include("sethash.php");

if(isset($_REQUEST['link']))
{
	$link=newdecode($_REQUEST['link']);
	$pieces = explode(",", $link);
	$upload_infor = (int)$pieces[0];
	$pos=strpos($pieces[1] , ".",4) + 1;
	$name = substr($pieces[1],0,$pos)."%";
//	$name = strtolower(substr($pieces[1],0,strpos($pieces[1],".",3)))."%";
	$GetDelete=mysql_query("SELECT * FROM picture_video where upload_id = $upload_infor and picture_video = 'videos' and name like '$name' order by upload_id");
	while($row = mysql_fetch_array($GetDelete)) {
		$name2 = $row['name'];
		$id2 = $row['id'];
		$OK=mysql_query("DELETE FROM picture_video WHERE id = $id2");
		if($OK) {
			mysql_query("DELETE FROM pv_share WHERE pv_id = $id2");
			unlink($name2);
		}
	}	
	$queryCheck="SELECT * FROM picture_video where upload_id = $upload_infor limit 1";  // query string stored in a variable
	$resultCheck=mysql_query($queryCheck);          // query executed 
	if (mysql_num_rows($resultCheck) == 0){
		mysql_query("DELETE FROM pv_comment WHERE upload_id = $upload_infor");
		mysql_query("DELETE FROM upload_infor WHERE id = $upload_infor");
echo <<<_END
<script type="text/javascript">
window.open("VRemove.php",target="_top");
</script>
_END;
			
		}
		else {		
			Header("Location: VRemove.php");
			die;
		}
}

$query="SELECT * FROM picture_video where owner_path='$GV_owner_path' and picture_video='videos' order by upload_id";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
while($row2 = mysql_fetch_array($result))
{
	$pos=strpos($row2['name'] , ".",4) + 1;
//	$upload_id=$row2['upload_id'];
	$VideoName=substr($row2['name'],0,$pos);
	$AddVideo=1;
	if(isset($video)){
		foreach ($video as $key1 => $value1) {
			if($value1==$VideoName) $AddVideo=0;
		}
	}
	if($AddVideo!=0)
	{
		$video[]=$VideoName;
		$upload_id[] = $row2['upload_id'];
	}
};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Remove of Videos</title>
</head>
<body>
<center>
<font style="font-size:18px;color:red;">VIDEO MAINTENANCE</font><br/>
<?php
include("../PHP/Header.php");
if(isset($video)){
	foreach ($video as $key1 => $value1) {
		$link = newencode("$upload_id[$key1],$value1");
		$VideoName1=$value1."mp4";
		$VideoName2=$value1."ogg";
		$VideoName3=$value1."ogv";
		$VideoName4=$value1."webm";
		$VideoName5=$value1."mp4video.mp4";
		$VideoName6=$value1."theora.ogv";
		$VideoName7=$value1."webmvp8.webm";
		echo "<div style='display:inline-block;'>
		<video width='134'>
		  <source src='$VideoName1' type='video/mp4' />
		  <source src='$VideoName2' type='video/ogg' />
		  <source src='$VideoName3' type='video/ogv' />
		  <source src='$VideoName4' type='video/webm' />
		  <source src='$VideoName5' type='video/mp4' />
		  <source src='$VideoName6' type='video/ogg' />
		  <source src='$VideoName7' type='video/webm' />
		  Your browser does not support the video tag.
		</video><br/><a href='VRemove.php?link=$link'>Delete this video</a></div>";
	}
}
else {	
echo <<<_END
<script type="text/javascript">
alert("No more video file available to delete!");
window.open("index.php",target="_top");
</script>
_END;

}
?>
</center>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript" >
var admin = <?php echo $_SESSION["admin"]; ?>;
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
document.getElementById('DeleteV').style.display = "none";
</script>
</body>
</html>
	