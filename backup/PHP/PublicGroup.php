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
    $_GET = _stripslashes_rcurs($_GET);////
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
	$show_id = 0;
	$queryPicture="SELECT * FROM picture_video where viewer_group = 'Public' order by upload_id desc";  // query string stored in a variable
	$resultPicture=mysql_query($queryPicture);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$Pcount=0;
	$Vcount=0;
	$upload_id = 0;
	$current_id = 0;
	while($row = mysql_fetch_array($resultPicture))
	{
		if($upload_id != $row['upload_id']){
			$count = 0;
			$count2 = 0;
			if($row['picture_video']=='pictures') $Pcount++;
			if($Pcount<3) $current_id = $row['upload_id'];
			$upload_id = $row['upload_id'];
		}
		if($row['picture_video']=='videos') $Vcount++;
		if ($show_id == 0) $show_id = $upload_id;
		$queryupload_infor="SELECT * FROM upload_infor where id = $upload_id";  // query string stored in a variable
		$resultupload_infor=mysql_query($queryupload_infor);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		$description = '';
		while($row1 = mysql_fetch_array($resultupload_infor))
		{
			$UploadDate = $row1['upload_date'];
			$description = $row1['description'];
		}
		if(($row['picture_video']=='pictures') && $count < 4) {
			$picture_group[$upload_id][] = $row['name'];
			$count++;
		}
		elseif($row['picture_video']=='videos' && $count2 < 5){
			$pos=strpos($row['name'] , ".",4) + 1;
			$video_group[$upload_id][] = substr($row['name'],0,$pos);
			$count2++;
		}
		$picture_UploadDate[$upload_id] = $UploadDate;
		$picture_description[$upload_id] = $description;
	}
	$current_count=3;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Make your Selection</title>
<style>
 img {border: 4px grey double;}
 a {text-decoration: none;}
 td#list_profile { border: 1px solid }
.pointer { cursor: pointer } 
</style>	
<script src="../scripts/jquery.js"></script>
<script type="text/javascript">
var CPcount= 0;
var current_id=0;
function Action(url,affect_id) {
	var id = "#"+affect_id;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function setcount() {
	CPcount= parseInt(document.getElementById('CPcount').value)+3;
	current_id= document.getElementById('current_id').value;
	document.getElementById('CPcount').value = CPcount;
}
</script>
</head>
<body>
<center>
<input type="text" name="CPcount" id="CPcount" value=0>
<?php
if($current_count<$Pcount) {
$longstring = <<<STRINGBEGIN
<input type="image" src="../images/more.gif" onClick="setcount();Action('MorePublicPictures.php?CPcount='+CPcount+'&current_id='+current_id+'&user_id=$GV_id','Pictures');">
STRINGBEGIN;
echo $longstring;
}
?>
<div id="Pictures">
<input type="text" name="current_id" id="current_id" value=<?php echo $current_id ?>>
<?php
if(isset($picture_group)) {
	echo "<font color='red'>Public Pictures</font>";
	$count=0;
	foreach ($picture_group as $key => $value) {
		$count++;
		if($count<=3){
			foreach ($value as $key2 => $value2) {
				if($key2==0) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$key');\"/>";
				if($key2==1) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$key');\"/>";
				if($key2==2) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$key');\"/>";
				if($key2==3) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$key');\"/>";
			}
			echo "$picture_UploadDate[$key]<br/>";
			echo "$picture_description[$key]";
		}
	}
}
?>
</div>
<?php
if(isset($video_group)) {
	echo "<font color='red'>Public Videos</font>";
	foreach ($video_group as $key => $value) {
		foreach ($value as $key2 => $value2) {
			$video1="$value2"."mp4";
			$video2="$value2"."ogg";
			$video3="$value2"."ogv";
			$video4="$value2"."webm";
			$video5="$value2"."mp4video.mp4";
			$video6="$value2"."theora.ogv";
			$video7="$value2"."webmvp8.webm";
			echo "
				<video width='120'>
				  <source src=\"$video1\" type='video/mp4' />
				  <source src=\"$video2\" type='video/ogg' />
				  <source src=\"$video3\" type='video/ogv' />
				  <source src=\"$video4\" type='video/webm' />
				  <source src=\"$video5\" type='video/mp4' />
				  <source src=\"$video6\" type='video/ogg' />
				  <source src=\"$video7\" type='video/webm' />
				  Your browser does not support the video tag.
				</video><br/>";		
		}
	}
}
?>
</center>
<div id="maincontent"></div>
<script type="text/javascript" >
function refreshiframe(upload_id)  
{  
	window.open( "PictureMain.php?FriendEmail=Public&show_id=" + upload_id, "MyBlog");
}
</script>

</body>
</html>
	