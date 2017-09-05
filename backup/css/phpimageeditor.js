
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
	            

	<div>
	<input type="image" src="../images/home.png" name="Home" id="Home" value="Home" width="40" onClick="window.open('index.php',target='_top');">
	<input type="image" src="../images/sharing.jpg" name="sharing" id="sharing" value="sharing" width="40" onclick="window.open('SetSharing.php',target='_top');">
	<input type="image" src="../images/setup.jpg" name="Setup" id="Setup" value="Setup" width="40" onClick="window.open('PickFriend.php',target='_top');">
	<input type="image" src="../images/pictureupload.jpg" name="PUpload" id="PUpload" value="Picture Upload" width="40" onClick="window.open('FileUploader.php',target='_top');">
	<input type="image" src="../images/videoupload.png" name="VUpload" id="VUpload" value="Video Upload" width="40" onClick="window.open('UploadVideo.php',target='_top');">
	<input type="image" src="../images/deletepic.png" name="DeleteP" id="DeleteP" value="Delete Picture" width="40" onClick="window.open('PRemove.php',target='_top');">
	<input type="image" src="../images/deletevideo.png" name="DeleteV" id="DeleteV" value="Delete Video" width="40" onClick="window.open('VRemove.php',target='_top');">
	<input type="image" src="../images/HERecorder.jpg" name="HERecorder" id="HERecorder" value="Household Expenese" width="40" onclick="window.open('HERecorder.php',target='_top');">
	<input type="image" src="../images/profile.png" name="Profile" id="Profile" value="Profile" width="40" onclick="window.open('ChangeProfile.php',target='_top');">
	<object type="application/x-shockwave-flash" data="player_mp3_maxi.swf" id="audio" width="40" height="40">
		<param name="movie" value="player_mp3_maxi.swf" />
		<param name="bgcolor" value="#000000" />
		<param name="FlashVars" value="mp3=congratulations_en_1.mp3&amp;width=40&amp;height=40&amp;showslider=0&amp;sliderwidth=0&amp;sliderheight=0&amp;volumewidth=0&amp;volumeheight=0" />
	</object>
			<input type="image" src="../images/chat.png" name="start_chat" id="Chat" value="Chat" width="40" onClick="chat();">
		<div style='display:inline-block'>
	<font style="font-size:16px;color:blue;" id="Available"><div style='display:inline-block'><font style="font-size:8px;color:green;">0 Friend Online</font>
	<font id="AvailMsg"></font></div>
	</font><font style="font-size:20px;color:red;font-weight:bold;"></font>
	</div>
	<input type="image" src="../images/logout.png" name="Logout" id="Logout" value="Logout" width="40" style="float:right;" onClick="window.open('signout.php',target='_top');">
	</div><hr>
	<div style="display:inline-block;vertical-align:top;">
		<iframe src="PictureMain.php" width="611" height="1935" id="Main2" name="MyBlog" frameborder=0 SCROLLING=no>
		  <p>Your browser does not support iframes.</p>
		</iframe>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<font  color="red">Viewing</font> <font id="my_name"> Public</font>'s photo<br/>
		<img src="../images/profile/public.jpg" id="ProfilPicture"  width='240' class="pointer" onMouseOver="Action_pic(1);" onMouseOut="Action_pic(0);" onClick="Action_pic(3);"/><br/>
		<div id="popups">Change Picture</div>
		<div>
			<iframe src="PictureGroup.php" height="1935" width="240" id="frame1" frameborder=0 SCROLLING=no>
			  <p>Your browser does not support iframes.</p>
			</iframe>
			<div id="maincontent"></div>
		</div>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<input type="hidden" name="FriendID" id="FriendID" value='3'>
		<input type="hidden" name="FriendPath" id="FriendPath" value='raymond3'>
		<input type="hidden" name="show_id" id="show_id" value="">
		<input type='image' src="../images/first2.png" id='first' onClick="FriendList('first');"> <input type='image' src="../images/previous2.png" id='previous'  onClick="FriendList('previous');"><input type='image' src="../images/next1.png" id='next' onClick="FriendList('next');"> <input type='image' src="../images/last.png" id='last'  onClick="FriendList('last');"><br/>		<div id="Friends" style="height:450px;">
		<b>Public</b><br/>		<a href="" onClick="SendRequest ('LastActivity.php?user_id=3','maincontent');refreshiframe('Public','Public','../images/profile/public.jpg','','public');return false;"><img src='../images/profile/public.jpg' width='67'/></a><br/><font size='2'><font color='red'><b>Friends</b></font></font><br/>		<a href="" onClick="SendRequest ('LastActivity.php?user_id=3','maincontent');refreshiframe('Raymond Huang','3','../images/profile/raymond3/M1190018.JPG','6','raymond3');return false;"><img src='../images/profile/raymond3/M1190018.JPG' width='67'/></a><br/><font size='2'>Raymond Huang</font><br/></div><div><font color="red" id="showtitil" size="2"><b>People You<br> May Know</b></font><br/><input type='image' src="../images/first2.png" id='first2' onClick="MayBeFriend('first');"> <input type='image' src="../images/previous2.png" id='previous2'  onClick="MayBeFriend('previous');"><input type='image' src="../images/next1.png" id='next2' onClick="MayBeFriend('next');"> <input type='image' src="../images/last.png" id='last2'  onClick="MayBeFriend('last');"><br/>		
		</div>
	</div>
	
</div>
<div id='BlankMsg' style="display:none;"></div>

<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=1 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#E6FFE6;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id=3;</script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript" >
var OrgFriendID=3;
var pagenum = 1;
var last = 1;
var rows = 2;
var page_rows = 5;
var admin = 0;
document.getElementById('Home').style.display = "none";
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
if(rows<=page_rows) {
	document.getElementById('first').style.display = "none";
	document.getElementById('previous').style.display = "none";
	document.getElementById('next').style.display = "none";
	document.getElementById('last').style.display = "none";
}
var pagenum2 = 1;
var last2 = 0;
var rows2 = 0;
var page_rows2 = 4;
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
	

	var url = 'FriendList.php?user_id=3&pagenum='+pagenum;
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
	var url = 'MayBeFriend.php?user_id=3&pagenum='+pagenum2;
	$(document).ready(function() {
	   $("#MyBeFriends").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function refreshiframe(name,FriendID,picture,show_id,FriendPath)  
{  
	var ViewerID=3;
	document.getElementById('my_name').innerHTML = name.substring(0,20);
	document.getElementById('FriendID').value = FriendID;
	document.getElementById('FriendPath').value = FriendPath;
	document.getElementById('ProfilPicture').src = picture;
	document.getElementById('frame1').src="PictureGroup.php?name="+name+"&FriendID="+FriendID ;
	if(OrgFriendID!=FriendID){
		var url = 'PictureVideoCheck.php?FriendID='+FriendID+'&ViewerID='+ViewerID;
		$.get(url, function(result) { 
			if(result==1) window.open( "PictureMain.php?show_id="+show_id+"&FriendID="+FriendID, "MyBlog");
		});	
	}
	window.parent.scroll(0,0);
}
function makefriend(name,FriendID)  
{ 
	var viewer_group = prompt("You want to add "+name+" as your friend?\nIf so please assign a group then click OK", "");
	var user_id=3;
	if (viewer_group!="" && viewer_group!=null){
		$.ajax({ 
		   type: "POST", 
		   url: "RequiredAsFriend.php",
		   data: "user_id="+user_id+"&FriendID="+FriendID+"&viewer_group="+viewer_group, 
		   success: function(msg){ 
			 alert( "Your require as a friend to "+name+"has been " + msg ); //Anything you want 
		   }, 
			error:function (xhr, ajaxOptions, thrownError){ 
						alert(xhr.status); 
						alert(thrownError); 
			}     	   
		 }); 	
		window.parent.scroll(0,0);
	}
	else {
		if(viewer_group!=null)	 alert("You must assign a group to your friend!\nPlease try again!"); 
	}

}
function Action_pic(disp)  
{
	var owner = "3";
	var curr = document.getElementById('FriendID').value;
	var FriendPath = document.getElementById('FriendPath').value;
	if(disp==1) {
		document.getElementById('popups').style.display = 'block';
		if(owner==curr) document.getElementById('popups').innerHTML="Change Picture";
		else document.getElementById('popups').innerHTML="Profile Pictures";
	}
	else document.getElementById('popups').style.display = 'none';
	if(owner==curr && disp==3) window.open('ChangeProfile.php',target='_top');
	else if(owner!=curr && disp==3 && curr!='Public')  window.open('ProfilePicture.php?FriendPath='+FriendPath,target='_top');
}



function Set_OrgFriendID(CurrID)  
{
  OrgFriendID=CurrID;
}

</script>
</body>
</html>