<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
include("../inc/CurrentDateTime.inc.php");
 
mysql_query("UPDATE user SET last_activity='$now' WHERE id = $GV_id order by id limit 1");
$Activeresult=mysql_query("SELECT id,is_active,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
echo mysql_error(); 
while($Active = mysql_fetch_array($Activeresult))
{
	$TimeDiff = $Active['TimeDiff'];
	if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id]");
	else if($Active['is_active'] == 1) mysql_query("UPDATE user SET is_active= 3 WHERE id = $Active[id]");
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
$name['public'] = 'Public';
$profile_picture['public'] = "../images/profile/public.jpg";
$FriendID['public'] = 'Public';

$name[$GV_owner_path] = $GV_name;
$profile_picture[$GV_owner_path] = $GV_profile_picture;
$rows = 2;
$FriendID[$GV_owner_path] = $GV_id;
$PicturePath = "../pictures/$GV_owner_path";
$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and ((name like '$PicturePath%' and owner_path <> '$GV_owner_path') or owner_path = '$GV_owner_path') group by upload_id desc limit 1";  // query string stored in a variable

$resultPicture=mysql_query($queryPicture);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row5 = mysql_fetch_array($resultPicture))
{
	$upload_id[$GV_owner_path] = $row5['upload_id'];
}

$query="SELECT * FROM view_permission where viewer_id = $GV_id group by owner_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$FriendID[$curr_path] = $row2['user_id'];
	$queryOwner="SELECT * FROM user where  email_address = '$row2[owner_email]' LIMIT 1";
	$owner=mysql_query($queryOwner);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($owner))
	{
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[$curr_path] = $row3['profile_picture'];
	 $rows++; 
	 $name[$curr_path] = $first_name." ".$last_name;
	} 
	$PicturePath = "../pictures/$curr_path";
	$queryPicture2="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and ((name like '$PicturePath%' and owner_path <> '$curr_path') or owner_path = '$curr_path') group by upload_id desc limit 1";  // query string stored in a variable
	
	$resultPicture2=mysql_query($queryPicture2);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row6 = mysql_fetch_array($resultPicture2))
	{
		$upload_id[$curr_path] = $row6['upload_id'];
	} 
}
$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$GV_owner_path' and viewer_group <> 'Public' order by upload_id desc limit 1");  // query string stored in a variable
$message = "";
if(mysql_num_rows($beforeShow) == 0) {
	$message = "You got no picture/video to share with friends!";
}

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<head>
<title>Pictures and Videos</title>
<style type="text/css" media="screen">
div#backdrop {
	width:985px;
	margin:auto;
	position:relative;
}
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
.pointer { cursor: pointer }
#popups {
	display: none;
	padding: 5px;
	border: 1px #CC0 solid;
	clip: auto;
	overflow: hidden;	
}
</style>
</head>	
<body>
<div id="backdrop" style="display:block;">
	<div>
	<input type="image" src="../images/setup.jpg" name="Setup" value="Setup" width="40" onClick="window.open('PickFriend.php',target='_top');">
	<input type="image" src="../images/pictureupload.jpg" name="PUpload" value="Picture Upload" width="40" onClick="window.open('FileUploader.php?picture_video=pictures',target='_top');">
	<input type="image" src="../images/videoupload.png" name="VUpload" value="Video Upload" width="40" onClick="window.open('FileUploader.php?picture_video=videos',target='_top');">
	<input type="image" src="../images/deletepic.png" name="DeleteP" value="Delete Picture" width="40" onClick="window.open('PRemove.php',target='_top');">
	<input type="image" src="../images/deletevideo.png" name="DeleteV" value="Delete Video" width="40" onClick="window.open('VRemove.php',target='_top');">
	<input type="image" src="../images/HERecorder.jpg" name="HERecorder" value="Household Expenese" width="40" onclick="window.open('HERecorder.php',target='_top');">
	<input type="image" src="../images/profile.png" name="Profile" value="Profile" width="40" onclick="window.open('ChangeProfile.php',target='_top');">
	<input type="image" src="../images/chat.png" name="start_chat" value="Chat" id="Chat" width="40" onClick="chat();">
	<input type="image" src="../images/logout.png" name="Logout" value="Logout" width="40" style="float:right;" onClick="window.open('signout.php',target='_top');">
	<font style="font-size:26px;color:red;font-weight:bold;"><?php echo $message ?></font>
	</div><hr>
	<div style="display:inline-block;vertical-align:top;">
		<iframe src="PictureMain.php" width="611" height="1935" id="Main2" name="MyBlog" frameborder=0 SCROLLING=no>
		  <p>Your browser does not support iframes.</p>
		</iframe>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<font id="my_name"> <?php echo $GV_name; ?></font><br/>
		<img src="<?php echo $GV_profile_picture; ?>" id="ProfilPicture"  width='240' class="pointer" onMouseOver="Action_pic(1);" onMouseOut="Action_pic(0);" onClick="Action_pic(3);"/><br/>
		<div id="popups">Change Picture</div>
		<div>
			<iframe src="PictureGroup.php" height="1935" width="240" id="frame1" frameborder=0 SCROLLING=no>
			  <p>Your browser does not support iframes.</p>
			</iframe>
			<div id="maincontent"></div>
		</div>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<input type="hidden" name="FriendID" id="FriendID" value='<?php echo $GV_id; ?>'>
		<input type="hidden" name="FriendPath" id="FriendPath" value='<?php echo $GV_owner_path; ?>'>
		<input type="hidden" name="show_id" id="show_id" value="<?php if(isset($show_id)) echo $show_id; else echo''; ?>">
		<?php
			$pagenum = 1; 
			$page_rows = 5;  
			$last = ceil($rows/$page_rows); 
			if ($pagenum < 1) 
			{ 
				$pagenum = 1; 
			} 
			elseif ($pagenum > $last) 
			{ 
				$pagenum = $last; 
			} 
		    $first_row=($pagenum -1)* $page_rows;
			$previous = $pagenum-1;
			if($previous == 0) $previous=1;
			$next = $pagenum+1;
			if($next > $rows) $next=$rows;
			echo "<img src=\"../images/first2.png\" id='first' onClick=\"FriendList('first');\">";
			echo " ";
			echo "<img src=\"../images/previous2.png\" id='previous'  onClick=\"FriendList('previous');\">";
			echo "<img src=\"../images/next1.png\" id='next' disabled='disabled' onClick=\"FriendList('next');\">";
			echo " ";
			echo "<img src=\"../images/last.png\" id='last'  onClick=\"FriendList('last');\"><br/>";
			$count=0;
		?>
		<div id="Friends">
		<?php
		echo "<b>Public</b><br/>";
		foreach ($profile_picture as $key => $value) {
		$count++;
		if(isset($upload_id[$key])) $show_id = $upload_id[$key]; else $show_id = '';
		if($name[$key]=='Public') $ShowName="<font color='red'><b>Friends</b></font>"; else $ShowName=$name[$key];
		$longstring = <<<STRINGBEGIN
		<a href="" onClick="SendRequest ('LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$name[$key]','$FriendID[$key]','$value','$show_id','$key');return false;"><img src='$value' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;
			if($count > $first_row && $count <= ($first_row+$page_rows)){
				echo $longstring;
			}
		}

			echo '<font color="red" size="2"><b>People You<br> May Know</b></font><br/>';
			$rows2=0;
			echo "need to<br/> set the<br/> \$rows";

			$pagenum2 = 1; 
			$page_rows2 = 5;  
			$last2 = ceil($rows2/$page_rows2); 
			if ($pagenum2 < 1) 
			{ 
				$pagenum2 = 1; 
			} 
			elseif ($pagenum2 > $last2) 
			{ 
				$pagenum2 = $last2; 
			} 
		    $first_row2=($pagenum2 -1)* $page_rows2;
			$previous2 = $pagenum2-1;
			if($previous2 == 0) $previous2=1;
			$next2 = $pagenum2+1;
			if($next2 > $rows2) $next2=$rows2;
			echo "<img src=\"../images/first2.png\" id='first' onClick=\"FriendList('first',2);\">";
			echo " ";
			echo "<img src=\"../images/previous2.png\" id='previous'  onClick=\"FriendList('previous',2);\">";
			echo "<img src=\"../images/next1.png\" id='next' disabled='disabled' onClick=\"FriendList('next',2);\">";
			echo " ";
			echo "<img src=\"../images/last.png\" id='last'  onClick=\"FriendList('last',2);\"><br/>";
			$count=0;
		?>		
		</div>
	</div>
	
</div>

<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:none;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" >
var pagenum = 1;
var pagenum2 = 1;
var last = <?php echo $last; ?>;
var last2 = <?php echo $last2; ?>;
function SendRequest(url,ajaxobj)  
{
	$(document).ready(function() {
	   $("#"+ajaxobj).load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function FriendList(require, flag)  
{
	flag = typeof flag !== 'undefined' ? 1 : 2; 
  
	if(require=='first')
	{
		if(flag==1) pagenum=1; else  pagenum2=1; 
	}
	else if(require=='previous') {
      if(flag==1) pagenum--; else  pagenum2--; 
	} 
	else if(require=='next') {
	  if(flag==1) pagenum++; else  pagenum2++; 
	} 
	else if(require=='last'){
		if(flag==1) pagenum=last; else pagenum2=last;
	}
	 if(pagenum<=1) { 
		pagenum = 1;
		document.getElementById('first').src = "../images/first2.png";
		document.getElementById('previous').src = "../images/previous2.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	 }
	 else if(pagenum>=last) {
		pagenum = last;
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next2.png";
		document.getElementById('last').src = "../images/last2.png";
	 }
	 else {
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	 }
	 if(last==1) {
		document.getElementById('first').src = "../images/first2.png";
		document.getElementById('previous').src = "../images/previous2.png";
		document.getElementById('next').src = "../images/next2.png";
		document.getElementById('last').src = "../images/last2.png";
	 }
	var url = 'FriendList.php?user_id=<?php echo $GV_id; ?>&pagenum='+pagenum;
	$(document).ready(function() {
	   $("#Friends").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function refreshiframe(name,FriendID,picture,show_id,FriendPath)  
{  
	document.getElementById('my_name').innerHTML = name;
	document.getElementById('FriendID').value = FriendID;
	document.getElementById('FriendPath').value = FriendPath;
	document.getElementById('ProfilPicture').src = picture;
	document.getElementById('frame1').src="PictureGroup.php?name="+name+"&FriendID="+FriendID ;
	//if(show_id!='')
	window.open( "PictureMain.php?show_id="+show_id+"&FriendID="+FriendID, "MyBlog");
}
function Action_pic(disp)  
{
	var owner = "<?php echo $GV_id; ?>";
	var curr = document.getElementById('FriendID').value;
	var FriendPath = document.getElementById('FriendPath').value;
	if(disp==1) {
		document.getElementById('popups').style.display = 'block';
		if(owner==curr) document.getElementById('popups').innerHTML="Change Picture";
		else document.getElementById('popups').innerHTML="Profile Pictures";
	}
	else document.getElementById('popups').style.display = 'none';
	if(owner==curr && disp==3) window.open('ChangeProfile.php',target='_top');
	else if(owner!=curr && disp==3)  window.open('ProfilePicture.php?FriendPath='+FriendPath,target='_top');
}
function chat()  
{
	if(document.getElementById('ChatFrame').style.display=='block') {
		document.getElementById('Chat').src='../images/chat.png';
		document.getElementById('ChatFrame').style.display='none';
	}
	else {
		document.getElementById('Chat').src='../images/StopChat.png';
		document.getElementById('ChatFrame').style.display='block';
	}
}
</script>
<?php
$beforeShow2=mysql_query("SELECT * FROM view_permission where user_id = $GV_id and is_active>0 limit 1");  // query string stored in a variable 9 is OK since it is waiting for confirmation
echo mysql_error();  
$message = "";
if(mysql_num_rows($beforeShow2) == 0) {
echo "
<script type='text/javascript' >
function confirmation() {
	var answer = confirm('You have not do the set up yet!\\nWould you like to so?');
	if (answer){
		window.location = 'PickFriend.php';
	}
}
window.onload = confirmation;
</script>
";
}
?>
</body>
</html>