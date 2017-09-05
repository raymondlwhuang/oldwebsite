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
$name[$GV_owner_path] = $GV_name;
$profile_picture[$GV_owner_path] = $GV_profile_picture;
$FriendEmail[$GV_owner_path] = $GV_email_address;
//$queryPicture="SELECT * FROM picture_video where owner_path = '$GV_owner_path' and picture_video = 'pictures' and viewer_group <> 'Public' group by upload_id desc limit 1";  // query string stored in a variable
$PicturePath = "../pictures/$GV_owner_path";
$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and ((name like '$PicturePath%' and owner_path <> '$GV_owner_path') or owner_path = '$GV_owner_path') group by upload_id desc limit 1";  // query string stored in a variable

$resultPicture=mysql_query($queryPicture);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$count = 0;
while($row5 = mysql_fetch_array($resultPicture))
{
	$upload_id[$GV_owner_path] = $row5['upload_id'];
}

$query="SELECT * FROM view_permission where viewer_email = '$GV_email_address' group by owner_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$FriendEmail[$curr_path] = $row2['owner_email'];
	$queryOwner="SELECT * FROM user where  email_address = '$row2[owner_email]' LIMIT 1";
	$owner=mysql_query($queryOwner);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($owner))
	{
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[$curr_path] = $row3['profile_picture'];
	 $name[$curr_path] = $first_name." ".$last_name;
	} 
	//$queryPicture2="SELECT * FROM picture_video where owner_path = '$curr_path' and picture_video = 'pictures' and viewer_group <> 'Public' group by upload_id desc limit 1";  // query string stored in a variable
	$PicturePath = "../pictures/$curr_path";
	$queryPicture2="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and ((name like '$PicturePath%' and owner_path <> '$curr_path') or owner_path = '$curr_path') group by upload_id desc limit 1";  // query string stored in a variable
	
	$resultPicture2=mysql_query($queryPicture2);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$count = 0;
	while($row6 = mysql_fetch_array($resultPicture2))
	{
		$upload_id[$curr_path] = $row6['upload_id'];
	} 
}

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Friends</title>
<style type="text/css" media="screen">
div {
	margin-bottom: 0px;
}

ul {
	display: none;
	list-style-type: none;
	margin-top: 0px;
}

ul > li > a:hover {background: #736F6E;}

div > p {
	display: block;
	width: 200px;
	background: #FFFFFF;
	border-bottom-style:solid;
	margin:0;
 }
 
div > p:hover  {  border-bottom-style:solid;  }
BODY {background:none transparent;}
</style>
<script type="text/javascript" src="../scripts/ajaxload.js"></script>	
<script type="text/javascript" >
window.onload = initAll;

function initAll() {
	var allLinks = document.getElementsByTagName("div");
	
	for (var i=0; i<allLinks.length; i++) {
		allLinks[i].onmouseover = function (){
		document.getElementById("menu1").style.display = "block";
		}
		allLinks[i].onmouseout =  function (){
		document.getElementById("menu1").style.display = "none";
		}
		allLinks[i].onclick =  function (){
		document.getElementById("menu1").style.display = "none";
		}
	}
}
function clearfield(picture,description) {
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = description;
}
</script>

</head>
<body>
<font color="darkblue">
<CENTER id="profile"><font id="my_name"> <?php echo $GV_name; ?></font>
<br/><img src="<?php echo $GV_profile_picture; ?>" width='240' id="ProfilPicture" /><br/>
</CENTER><br/>
<a href="../PHP/PictureUploader.php" target="_top">Photo Upload</a><br/>
<a href="../PHP/VideoUploader.php" target="_top">Video Upload</a><br/>
<!--<a href="../HTML/FileMaintenance.html" target="_top">Edit Profile</a><br/> -->
<a href="HERecorder.php" target="_top">Household Expenses Recorder</a>
<a href="signout.php" target="_top">Logout</a>
<table width="100%" border="0">
<tr>
<td valign="top" width="67">
<input type="hidden" name="FriendEmail" id="FriendEmail" value='<?php echo $GV_email_address; ?>'>
<input type="hidden" name="show_id" id="show_id" value="<?php if(isset($show_id)) echo $show_id; else echo''; ?>">
<b>Friends</b>
<?php
foreach ($profile_picture as $key => $value) {
if(isset($upload_id[$key])) $show_id = $upload_id[$key]; else $show_id = '';
$longstring = <<<STRINGBEGIN
<a href="" onClick="SendRequest ('../PHP/LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$name[$key]','$FriendEmail[$key]','$value','$show_id');return false;"><img src='$value' width='67'/></a><br/><font size='2'>$name[$key]</font><br/>
STRINGBEGIN;
echo $longstring;
}

?>	
	</td>
	<td valign="top">
		<iframe src="PictureGroup.php" height="270" width="160" id="frame1" frameborder=0 SCROLLING=no>
		  <p>Your browser does not support iframes.</p>
		</iframe>
	</td>
</tr>
</table>
<div id="maincontent"></div>
</font>
<script type="text/javascript" >
    function refreshiframe(name,email,picture,show_id)  
    {  
		document.getElementById('my_name').innerHTML = name;
		document.getElementById('FriendEmail').value = email;
		document.getElementById('ProfilPicture').src = picture;
		document.getElementById('frame1').src="PictureGroup.php?name="+name+"&FriendEmail="+document.getElementById('FriendEmail').value ;
		if(show_id!='')	window.open( "PictureMain.php?show_id="+show_id+"&FriendEmail="+document.getElementById('FriendEmail').value, "MyBlog");
    }
</script>

</body>
</html>
	