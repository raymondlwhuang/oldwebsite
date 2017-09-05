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
	else if($Active['is_active'] == 1) mysql_query("UPDATE user SET is_active= 3 WHERE id = $Active[id] and password<>''");
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
	$message = "Please upload some picture/video to share!";
}
/*?????????????????????????????????????????????????????????????????*/
$rows2=0;
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE viewer_id = $GV_id");
while($option = mysql_fetch_array($FriendResult)) {
	$FriendResult1 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and viewer_email='$option[owner_email]' limit 1");
	if(mysql_num_rows($FriendResult1) == 0) {
		$PictureResult1 = mysql_query("SELECT * FROM user WHERE email_address = '$option[owner_email]' limit 1"); /* get his/her friend infor */
		while($row1 = mysql_fetch_array($PictureResult1)) {
			$first_name=$row1['first_name'];
			$last_name=$row1['last_name'];
			$viewer_id=$row1['id'];
			$curr_path=$row1['owner_path'];
			$profile_picture2[$curr_path] = $row1['profile_picture'];
			$name[$curr_path] = $first_name." ".$last_name;
			$rows2++; 
		}
	}
	if($option['owner_email']!=$GV_email_address){
		$FriendResult2 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$option[owner_email]'");
		while($option2 = mysql_fetch_array($FriendResult2)) {
			$FriendResult3 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and viewer_email='$option2[viewer_email]' limit 1");
			if(mysql_num_rows($FriendResult3) == 0 && $option2['viewer_email']!=$GV_email_address) {
				$PictureResult2 = mysql_query("SELECT * FROM user WHERE email_address = '$option2[viewer_email]' limit 1"); /* get his/her friend infor */
				while($row2 = mysql_fetch_array($PictureResult2)) {
					$first_name=$row2['first_name'];
					$last_name=$row2['last_name'];
					$viewer_id=$row2['id'];
					$curr_path=$row2['owner_path'];
					$profile_picture2[$curr_path] = $row2['profile_picture'];
					$name[$curr_path] = $first_name." ".$last_name;
					$rows2++; 
				}		
			}
		}
	}
	
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
<?php include("../PHP/Header.php"); ?>
	<div style="display:inline-block;vertical-align:top;">
		<iframe src="PictureMain.php" width="611" height="1935" id="Main2" name="MyBlog" frameborder=0 SCROLLING=no>
		  <p>Your browser does not support iframes.</p>
		</iframe>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<font  color="red">Viewing</font> <font id="my_name"> <?php if(isset($_SESSION["viewingOn"])) echo $_SESSION["viewingOn"]; else echo substr($GV_name,0,20); ?></font>'s photo<br/>
		<img src="<?php if(isset($_SESSION["viewingOnprofile"])) echo $_SESSION["viewingOnprofile"]; else echo $GV_profile_picture; ?>" id="ProfilPicture"  width='240' class="pointer" onMouseOver="Action_pic(1);" onMouseOut="Action_pic(0);" onClick="Action_pic(3);"/><br/>
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
			echo "<img src=\"../images/next1.png\" id='next' onClick=\"FriendList('next');\">";
			echo " ";
			echo "<img src=\"../images/last.png\" id='last'  onClick=\"FriendList('last');\"><br/>";
			$count=0;
		?>
		<div id="Friends" style="height:450px;">
		<?php
		echo "<b>Public</b><br/>";
		foreach ($profile_picture as $key => $value) {
		$count++;
		if(isset($upload_id[$key])) $show_id = $upload_id[$key]; else $show_id = '';
		if($name[$key]=='Public') $ShowName="<font color='red'><b>Friends</b></font>"; else $ShowName=substr($name[$key],0,25);
		$longstring = <<<STRINGBEGIN
		<a href="" onClick="SendRequest ('LastActivity.php?user_id=$GV_id','maincontent');refreshiframe('$name[$key]','$FriendID[$key]','$value','$show_id','$key');return false;"><img src='$value' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;
			if($count > $first_row && $count <= ($first_row+$page_rows)){
				echo $longstring;
			}
		}
		echo "</div><div>";
			echo '<font color="red" id="showtitil" size="2"><b>People You<br> May Know</b></font><br/>';
			$pagenum2 = 1; 
			$page_rows2 = 4;  
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
				echo "<img src=\"../images/first2.png\" id='first2' onClick=\"MayBeFriend('first');\">";
				echo " ";
				echo "<img src=\"../images/previous2.png\" id='previous2'  onClick=\"MayBeFriend('previous');\">";
				echo "<img src=\"../images/next1.png\" id='next2' onClick=\"MayBeFriend('next');\">";
				echo " ";
				echo "<img src=\"../images/last.png\" id='last2'  onClick=\"MayBeFriend('last');\"><br/>";
			$count2=0;
			if(isset($profile_picture2)) {
				echo "<div  id=\"MyBeFriends\">";
				foreach ($profile_picture2 as $key2 => $value2) {
				$count2++;
				$ShowName=substr($name[$key2],0,25);
				$longstring = <<<STRINGBEGIN
				<a href="" onClick="SendRequest ('LastActivity.php?user_id=$GV_id','maincontent');return false;"><img src='$value2' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;
					if($count2 > $first_row2 && $count2 <= ($first_row2+$page_rows2)){
						echo $longstring;
					}
				}
				echo "</div>";
			}
		?>		
		</div>
	</div>
	
</div>
<div id='BlankMsg' style="display:none;"></div>

<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=1 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#E6FFE6;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >
var pagenum = 1;
var last = <?php echo $last; ?>;
var rows = <?php echo $rows; ?>;
var page_rows = <?php echo $page_rows; ?>;
if(rows<=page_rows) {
	document.getElementById('first').style.display = "none";
	document.getElementById('previous').style.display = "none";
	document.getElementById('next').style.display = "none";
	document.getElementById('last').style.display = "none";
}
var pagenum2 = 1;
var last2 = <?php echo $last2; ?>;
var rows2 = <?php echo $rows2; ?>;
var page_rows2 = <?php echo $page_rows2; ?>;
if(rows2<=page_rows2) {
	document.getElementById('first2').style.display = "none";
	document.getElementById('previous2').style.display = "none";
	document.getElementById('next2').style.display = "none";
	document.getElementById('last2').style.display = "none";
}
if(rows2<=0) document.getElementById('showtitil').style.display = "none";
else  document.getElementById('showtitil').style.display = "block";
function SendRequest(url,ajaxobj)  
{
	$(document).ready(function() {
	   $("#"+ajaxobj).load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function FriendList(require)  
{  
	if(require=='first') pagenum=1;
	else if(require=='previous') {
	  pagenum = pagenum - 1;
	} 
	else if(require=='next') {
	  pagenum = pagenum + 1;
	} 
	else if(require=='last') pagenum=last;
	if(pagenum > 1 && pagenum < last) {
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	}
	else if(pagenum<=1) {
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
	

	var url = 'FriendList.php?user_id=<?php echo $GV_id; ?>&pagenum='+pagenum;
	$(document).ready(function() {
	   $("#Friends").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function MayBeFriend(require)  
{  
	if(require=='first') pagenum2=1;
	else if(require=='previous') {
	  pagenum2 = pagenum2 - 1;
	} 
	else if(require=='next') {
	  pagenum2 = pagenum2 + 1;
	} 
	else if(require=='last') pagenum2=last2;
	 if(pagenum2<=1) { 
		pagenum2 = 1;
		document.getElementById('first2').src = "../images/first2.png";
		document.getElementById('previous2').src = "../images/previous2.png";
		document.getElementById('next2').src = "../images/next1.png";
		document.getElementById('last2').src = "../images/last.png";
	 }
	 else if(pagenum2>=last2) {
		pagenum2 = last2;
		document.getElementById('first2').src = "../images/first.png";
		document.getElementById('previous2').src = "../images/previous.png";
		document.getElementById('next2').src = "../images/next2.png";
		document.getElementById('last2').src = "../images/last2.png";
	 }
	 else {
		document.getElementById('first2').src = "../images/first.png";
		document.getElementById('previous2').src = "../images/previous.png";
		document.getElementById('next2').src = "../images/next1.png";
		document.getElementById('last2').src = "../images/last.png";
	 }
	 if(last2==1) {
		document.getElementById('first2').src = "../images/first2.png";
		document.getElementById('previous2').src = "../images/previous2.png";
		document.getElementById('next2').src = "../images/next2.png";
		document.getElementById('last2').src = "../images/last2.png";
	 }
	var url = 'MayBeFriend.php?user_id=<?php echo $GV_id; ?>&pagenum='+pagenum2;
	$(document).ready(function() {
	   $("#MyBeFriends").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function refreshiframe(name,FriendID,picture,show_id,FriendPath)  
{  
	var ViewerID=<?php echo $GV_id ?>;
	document.getElementById('my_name').innerHTML = name.substring(0,20);
	document.getElementById('FriendID').value = FriendID;
	document.getElementById('FriendPath').value = FriendPath;
	document.getElementById('ProfilPicture').src = picture;
	document.getElementById('frame1').src="PictureGroup.php?name="+name+"&FriendID="+FriendID ;
	var url = 'PictureVideoCheck.php?FriendID='+FriendID+'&ViewerID='+ViewerID;
	$.get(url, function(result) { 
		if(result==1) window.open( "PictureMain.php?show_id="+show_id+"&FriendID="+FriendID, "MyBlog");
	});	
	
	window.parent.scroll(0,0);
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
	var user_id = "<?php echo $GV_id; ?>";
	if(document.getElementById('ChatFrame').style.display=='block') {
		var url="MyIndicator.php?Indicator=5&user_id="+user_id;
		document.getElementById('Chat').src='../images/chat.png';
		document.getElementById('ChatFrame').style.display='none';
		document.getElementById('ChatFrame').contentWindow.Stop(); 
	}
	else {
		var url="MyIndicator.php?Indicator=3&user_id="+user_id;
		document.getElementById('Chat').src='../images/StopChat.png';
		document.getElementById('ChatFrame').style.display='block';
		document.getElementById('ChatFrame').contentWindow.Start(); 
	}
	$(document).ready(function() {
	   $("#BlankMsg").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function user_info()  
{
	var user_id=<?php echo $GV_id; ?>;
	var userData="user_id="+user_id;
	userData=userData+"&screen_width="+screen.width;
	userData=userData+"&screen_width="+screen.width;
	userData=userData+"&screen_height="+screen.height;
	userData=userData+"&screen_colorDepth="+screen.colorDepth;
	userData=userData+"&screen_pixelDepth="+screen.pixelDepth;
	userData=userData+"&screen_availWidth="+screen.availWidth;
	userData=userData+"&screen_availHeight="+screen.availHeight;
	var numPlugins = navigator.plugins.length;
	for (i = 0; i < numPlugins; i++) {
		plugin = navigator.plugins[i];
		userData=userData+"&plugin"+i+"="+plugin.name;
		userData=userData+"&file_name"+i+"="+plugin.filename;

	}
	userData=userData+"&numPlugins="+numPlugins;
	var url='userInfo.php?'+userData;
	$(document).ready(function() {
	   $("#BlankMsg").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
$(document).ready(function() {
	var user_id =  <?php echo "$GV_id"; ?>;	
 	 $("#Available").load("ChatTo3.php?user_id="+user_id);
   var refreshId = setInterval(function() {
      $("#Available").load('ChatTo3.php?user_id='+user_id+'&randval='+ Math.random());
   }, 60000);
   $.ajaxSetup({ cache: false });
});
function initialize_load()  
{
	chat();
	user_info();
}
//window.onload=chat;	
window.onload=initialize_load;	
</script>
<?php
$beforeShow2=mysql_query("SELECT * FROM view_permission where user_id = $GV_id and is_active>0 limit 1");  // query string stored in a variable 9 is OK since it is waiting for confirmation
echo mysql_error();  
$message = "";
if(mysql_num_rows($beforeShow2) == 0) {
echo "
<script type='text/javascript' >
function confirmation() {
	var answer = confirm('You have not do the set up yet!\\nWould you like to do the set up?');
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