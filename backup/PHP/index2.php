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
	$show_id2 = 0;
	$queryPicture3="SELECT * FROM picture_video where viewer_group = 'Public' and picture_video = 'pictures' group by upload_id desc";  // query string stored in a variable
	$resultPicture3=mysql_query($queryPicture3);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$count2 = 0;
	while($row7 = mysql_fetch_array($resultPicture3))
	{
		$upload_id2 = $row7['upload_id'];
		if ($show_id2 == 0) $show_id2 = $upload_id2;
		$queryupload_infor2="SELECT * FROM upload_infor where id = $upload_id2";  // query string stored in a variable
		$resultupload_infor2=mysql_query($queryupload_infor2);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		$description2 = '';
		while($row8 = mysql_fetch_array($resultupload_infor2))
		{
			$UploadDate2 = $row8['upload_date'];
			$description2 = $row8['description'];
		}			
		$picture_group[$upload_id2] = $row7['name'];
		$picture_UploadDate2[$upload_id2] = $UploadDate2;
		$picture_description[$upload_id2] = $description2;
		$count2++;
	}	
	if($count2 > 0) $owner_list[] = 'Public';
	/***********************************************/
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
     $platform = 'Unknown';
     $version= "";
 
    //First get the platform?
     if (preg_match('/linux/i', $u_agent)) {
         $platform = 'linux';
     }
     elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
         $platform = 'mac';
     }
     elseif (preg_match('/windows|win32/i', $u_agent)) {
         $platform = 'windows';
     }
     
    // Next get the name of the useragent yes seperately and for good reason
     if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
     $known = array('Version', $ub, 'other');
     $pattern = '#(?<browser>' . join('|', $known) .
     ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
     if (!preg_match_all($pattern, $u_agent, $matches)) {
         // we have no matching number just continue
     }
     
    // see how many we have
     $i = count($matches['browser']);
     if ($i != 1) {
         //we will have two since we are not using 'other' argument yet
         //see if version is before or after the name
         if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
             $version= $matches['version'][0];
         }
         else {
             $version= $matches['version'][1];
         }
     }
     else {
         $version= $matches['version'][0];
     }
     
    // check if we have a number
     if ($version==null || $version=="") {$version="?";}
     
    return array(
         'userAgent' => $u_agent,
         'name'      => $bname,
         'version'   => $version,
         'platform'  => $platform,
         'pattern'    => $pattern
     );
 } 

 $ua=getBrowser();
$ReadyToChat = 0;
$Indicator = 3;
$query2="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
$result2=mysql_query($query2);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($chatrow2 = mysql_fetch_array($result2))
{
	$chat_curr_path = $chatrow2['owner_path'];
	$queryFriends="SELECT * FROM user where  email_address = '$chatrow2[viewer_email]' and (is_active = 2 or is_active = 3 or is_active = 4) LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	echo mysql_error();
	while($chatrow3 = mysql_fetch_array($friend))
	{
	 $FriendEmail2[] = $chatrow2['viewer_email'];
	 if($chatrow2['is_active']==3) $TalkStatus[] = 'checked'; else $TalkStatus[] = '';
	 $TalkValue[] = $chatrow2['is_active'];
	 $first_name2=ucfirst(strtolower($chatrow3['first_name']));
	 $last_name2 = ucfirst(strtolower($chatrow3['last_name']));
	 $profile_picture2[] = $chatrow3['profile_picture'];
	 $name2[] = $first_name2." ".$last_name2;
	 $ReadyToChat = $ReadyToChat + 1;
	} 
}
$ChatToCount = 0;
$sMessages2="";
if(isset($_REQUEST['SearchGroup']))
{
	$queryChat="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
	$resultChat=mysql_query($queryChat);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($chatrow6 = mysql_fetch_array($resultChat))
	{
		$chat_curr_path = $chatrow6['owner_path'];
		$queryFriends2="SELECT * FROM user where  email_address = '$chatrow6[viewer_email]' and (is_active = 2 or is_active = 3 or is_active = 4) LIMIT 1";
		$friend2=mysql_query($queryFriends2);          // query executed 
		echo mysql_error();
		while($chatrow7 = mysql_fetch_array($friend2))
		{
		 if($chatrow6['is_active']==3) $ChatToCount++;
		} 
	}
	if($ChatToCount >0)	{ 
		$SearchGroup = $_REQUEST['SearchGroup'];
		$SearchGroup = mysql_real_escape_string($SearchGroup);
		if ($SearchGroup != '') {
				$SearchGroup = newencode($SearchGroup);
				$SaveCheck = "SELECT * FROM talk_message WHERE message = '$SearchGroup' LIMIT 1";
				$CheckResult = mysql_query($SaveCheck);
				if (mysql_num_rows($CheckResult) == 0){
						mysql_query("INSERT INTO `talk_message` SET `message`='{$SearchGroup}'");
				}				
				$idResult = mysql_query("SELECT id FROM talk_message WHERE  message = '$SearchGroup' order by id desc LIMIT 1");
				while($row = mysql_fetch_array($idResult))
				{
						 $msg_id = $row['id'];
				}				
			$query3="SELECT * FROM view_permission where owner_email = '$GV_email_address' and is_active = 3 order by viewer_email";  // query string stored in a variable
			$result3=mysql_query($query3);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			$TalkList = '|' . $GV_id . '|';
			while($chatrow2 = mysql_fetch_array($result3))
			{
				$queryTalk="SELECT * FROM user where email_address = '$chatrow2[viewer_email]' and (is_active = 2 or is_active = 3 or is_active = 4) limit 1;";  // query string stored in a variable
				$resultTalk=mysql_query($queryTalk);
				if (@mysql_num_rows($resultTalk) != 0){
					while($chatrow3 = mysql_fetch_array($resultTalk))
					{
					 $TalkList = $TalkList . $chatrow3['id'] . "|";
					}					
				}
			}
			if($TalkList != '|' . $GV_id . '|')	{			
			mysql_query("INSERT INTO `s_chat_messages` SET `user`='{$GV_name}', `msg_id`={$msg_id}, `when`=UNIX_TIMESTAMP(),`msg_time`=NOW(),`talk_to`='{$TalkList}'");
			}
			 Header("Location: {$_SERVER['REQUEST_URI']}");
			 die;
		}
	}
	else $sMessages2 = "<font color='red'>Please pick a person to chat!</font>";
}
	$queryTalk="SELECT is_active FROM user where id = $GV_id limit 1;";  // query string stored in a variable
	$ResultStatus=mysql_query("SELECT is_active FROM user where id = $GV_id limit 1");
	while($chatrow5 = mysql_fetch_array($ResultStatus))
	{
	 $Indicator = $chatrow5['is_active'];
	}
/*---------------------------------------------*/
$name3 = $GV_name;
$show_id3 = 0;
	if(isset($_GET['FriendEmail']))
	{	
		$email = $_GET['FriendEmail'];
	}		
	if(isset($email) && $GV_email_address != $email){
		$queryPermit="SELECT * FROM view_permission where owner_email = '$email' and viewer_email = '$GV_email_address'";  // query string stored in a variable
	}
	else {
		$queryPermit="SELECT * FROM view_permission where owner_email = '$GV_email_address'";  // query string stored in a variable
	}
	$resultPermit=mysql_query($queryPermit);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	if (mysql_num_rows($resultPermit) != 0){
		while($row = mysql_fetch_array($resultPermit))
		{	
			$pic_curr_path = $row['owner_path'];
			$permit[$pic_curr_path][] = $row['viewer_group'];
		}
		foreach ($permit as $key => $value) {
			foreach ($value as $key2 => $value2) {
//				$queryPicture4="SELECT * FROM picture_video where picture_video = 'pictures' owner_path = '$key' and (viewer_group = '$value2' or viewer_group = '') and  group by upload_id desc limit 1";  // query string stored in a variable
				$PicturePath2 = "../pictures/$key";
				$queryPicture4="SELECT * FROM picture_video where picture_video = 'pictures' and (viewer_group = '$value2' or viewer_group = '') and name like '$PicturePath2%' group by upload_id desc";  // query string stored in a variable
				
				$resultPicture4=mysql_query($queryPicture4);          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				$count3 = 0;
				while($pic_row3 = mysql_fetch_array($resultPicture4))
				{
					$upload_id3 = $pic_row3['upload_id'];
					$picture_group2[$upload_id3] = $pic_row3['name'];
					if ($show_id3 == 0) $show_id3 = $upload_id3;
					$queryupload_infor="SELECT * FROM upload_infor where id = $upload_id3";  // query string stored in a variable
					$resultupload_infor=mysql_query($queryupload_infor);          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					$description = '';
					while($pic_row4 = mysql_fetch_array($resultupload_infor))
					{
						$UploadDate = $pic_row4['upload_date'];
						$description = $pic_row4['description'];
					}			
					$picture_UploadDate[$upload_id3] = $UploadDate;
					$picture_description[$upload_id3] = mysql_real_escape_string($description);
					$count3++;
				}	
				if($count3 > 0) $owner_list[] = $key;			
			}
		}
	}	
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<head>
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
#searchfield {
	font: 1.2em arial, helvetica, sans-serif;
}

#ChatMsg {
	padding: 2px;
	border: 2px #0000ff solid;
	border-style:ridge;
	width:400px;
	clip: auto;
	margin-left:25px;
	overflow: hidden;	
}

#searchField.error {
	background-color: #FFC;
}
a{text-decoration:none} 
</style>

<title>Pictures and Videos</title>
<script src="../scripts/jquery-1.3.2.min.js"></script>
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
<script type="text/javascript" src="../scripts/fancydropdown.js"></script>
<script type="text/javascript" src="../scripts/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="../scripts/DocUp.js"></script>
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

var email_address = "<?php echo $GV_email_address; ?>";
var user_id =  "<?php echo $GV_id; ?>";
$(document).ready(function() {
 	 $("#FriendList").load("ChatTo2.php?email_address="+email_address);
   var refreshId = setInterval(function() {
      $("#FriendList").load('ChatTo2.php?email_address='+email_address+'&randval='+ Math.random());
   }, 7000);
   $.ajaxSetup({ cache: false });
});
$(document).ready(function() {
 	 $("#ChatMsg").load("../search/MyMsg.php?user_id="+user_id);
   var refreshId = setInterval(function() {
      $("#ChatMsg").load('../search/MyMsg.php?user_id='+user_id+'&randval='+ Math.random());
   }, 7000);
   $.ajaxSetup({ cache: false });
});
function SetChat (Indicator) {
	if(Indicator ==3){
	 document.getElementById('FriendList').style.display = 'block';
	 document.getElementById('picked').src = "../images/green.png";
 	 document.getElementById('ChatMsg').style.display = 'block';
     document.getElementById('DescSearch').style.display = 'block';
	}
	else if(Indicator ==2){
	 document.getElementById('FriendList').style.display = 'none';
	 document.getElementById('picked').src = "../images/yellow.png";
 	 document.getElementById('ChatMsg').style.display = 'none';
     document.getElementById('DescSearch').style.display = 'none';
	}
	else if(Indicator ==4){
	 document.getElementById('FriendList').style.display = 'block';
	 document.getElementById('picked').src = "../images/red.png";
	document.getElementById('ChatMsg').style.display = 'block';
	document.getElementById('DescSearch').style.display = 'block';
	 
	}
	else {
	 document.getElementById('FriendList').style.display = 'none';
	 document.getElementById('picked').src = "../images/white.png";
 	 document.getElementById('ChatMsg').style.display = 'none';
     document.getElementById('DescSearch').style.display = 'none';
	}
}
function SetChatTo(email,SetCheckBox) {
	if (SetCheckBox==3) document.getElementById(email).checked = !(document.getElementById(email).checked);
}
function Action(url,affect_id) {
	var id = "#"+affect_id;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
}
</script>

</head>	
</body>

<div id="backdrop" style="display:block;">
<table width="100%">
<tbody>
<tr>
<td width="240" valign="top">
	<!---iframe src="Friends.php" width="240" height="900" id="Main1" frameborder=0 SCROLLING=no>	</iframe--->
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
	<input type="hidden" name="show_id" id="show_id" value="<?php if(isset($show_id)) echo $show_id; else echo''; ?>">
	<b>Friends</b>
	<?php
	foreach ($profile_picture as $key => $value) {
	if(isset($upload_id[$key])) $show_id = $upload_id[$key]; else $show_id = '';
$longstring = <<<STRINGBEGIN
<a href="" onClick="Action('PictureShow.php?profile_picture=$value&show_id=$show_id','slider-container');refreshiframe('$name[$key]','$FriendEmail[$key]','$value','$show_id');return false;"><img src='$value' width='67'/></a><br/><font size='2'>$name[$key]</font><br/>
STRINGBEGIN;
echo $longstring;
}

?>	
		</td>
		<td valign="top">
			<!--iframe src="PictureGroup.php" height="270" width="160" id="frame1" frameborder=0 SCROLLING=no>			</iframe-->
<div id="maincontent"></div>
<div style="display:block;" id="Private">
	<table width="100%">
		<tbody>
		<tr>
		<td colspan="2">
			<div class="menu1"><span id="picked_owner">
				<?php if($show_id3 ==0) echo "No picture available"; ?></span>
	<?php
		$totalHeight = 0;
		if($show_id3!=0) {
			foreach ($picture_group2 as $key3 => $value3) {
			$UploadDate = $picture_UploadDate[$key3];
			$description = $picture_description[$key3];
			$totalHeight = $totalHeight + 200;

echo <<<_END
<a href="" style="color:red;" onClick="SendRequest ('../PHP/LastActivity.php?user_id=$GV_id','maincontent2');refreshiframe('$key3');return false;"><img src='$value3' width="130px" /><br/>$description<br/>$UploadDate<br/></a>
_END;

			}
		}
		else echo "No picture provided!";
			?>	
			</div>
		</td>
		</tr>
		</tbody>
	</table>
</div>
<input type="hidden" name="FriendEmail" id="FriendEmail" value="<?php if(isset($email)) echo $email; else echo $GV_email_address; ?>">
	
	<!-------------------------------------------------------------------------------------------->
		</td>
	</tr>
	</table>
	<div id="maincontent2"></div>
	</font>
	<!-------------------------------------------------------------------------------------------->
</td>
<td valign="top">
	<!--iframe src="PictureMain.php" width="611" height="535" id="Main2" name="MyBlog"  id="MyBlog" frameborder=0 SCROLLING=no>	</iframe-->
<table width="100%" border="1" align="left" >
<tr>
	<td width="100%" height="520">
<?php
	$queryShow="SELECT * FROM picture_video where owner_path='$GV_owner_path' and picture_video = 'pictures' order by upload_id desc";  // query string stored in a variable

	$resultShow=mysql_query($queryShow);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
			$countimg = 0;
?>			
			<div style="overflow: hidden;" id="slider-container">
<?php			
			if(mysql_num_rows($resultShow) <= 1) {
			  $countimg++;
			  $content ='<div style="display: none; opacity: 1;height: 600px;" id="banner'."$countimg".'">';
			  $content = "$content"."<img src='$profile_picture' height=420px border='0'>";
			  $content = "$content".'</div>';
			  echo "$content";			
			}			
			while($pic_row5 = mysql_fetch_array($resultShow)) {
		  $countimg++;
		  $content ='<div style="display: none; opacity: 1;height: 600px;" id="banner'."$countimg".'">';
		  $content = "$content"."<img src='$pic_row5[name]' height=420px border='0'><br />
						<iframe src='ShowComments.php?picture_id=$pic_row5[id]' width='600' height='100%'  frameborder=0 SCROLLING=no>
						  <p>Your browser does not support iframes.</p>
						</iframe>";
		  $content = "$content".'</div>';
		  echo "$content";
		  };
?>		  
		</div>	
	</td>
</tr>
</table>
	
	<!-------------------------------------------------------------------------------------------->
</td>
<td width="134" valign="top">
	<!---iframe src="PublicGroup.php" width="134" height="550" id="Main3" name="Public"  id="Public" frameborder=0 SCROLLING=no>	</iframe-->
<div style="display:block;" id="Private">
	<table width="100%">
		<tbody>
		<tr>
		<td colspan="2"><span id="picked_owner">
				<?php if($show_id2 ==0) echo "No picture available"; ?></span>
	<?php
		if($show_id2!=0) {
			foreach ($picture_group as $key2 => $value2) {
			$UploadDate2 = $picture_UploadDate2[$key2];
			$description2 = $picture_description[$key2];
echo <<<_END
<a href="" onClick="SendRequest ('../PHP/LastActivity.php?user_id=$GV_id','maincontent3');return false;"><p style="width:130px;background: #8FC4FF;color:white;"><img src='$value2' width="130px" />$description2<br/>$UploadDate2</p></a>
_END;
			}
		}
			?>	
		</td>
		</tr>
		</tbody>
	</table>
</div>
<div id="maincontent3"></div>	
	<!-------------------------------------------------------------------------------------------->
</td>
</tr>
</tbody>
</table>
</div>
<!---iframe src="chat.php" height="400" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;"></iframe--->
<div id='BlankMsg' style="display:none;"><?php echo "$sMessages2"; ?></div>
<div color="darkblue" style="position:fixed;bottom:0px;right:10px;float:right;">
	<table>
	<tr>
		<td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$sMessages2"; ?> </div>
		<div id="ChatMsg" <?php if($Indicator == 3 || $Indicator == 4) echo "style='display:block'"; else echo "style='display:none'"; ?>><?php echo "$sMessages"; ?> </div>
		<form action=""   <?php if($Indicator == 3 || $Indicator == 4) echo "style='display:block'"; else echo "style='display:none'"; ?> class="submit_form" name="DescSearch" id="DescSearch" method="post">
			<img src="../images/chat.jpg" alt="chat" height="22"/>
			<?php if($ua['name'] == 'Internet Explorer') {
			echo <<<_END
			<div style="display:none;">
			<input style=”border:0; width:0; height:0? type=”text” size=”0? maxlength=”0?  />
			</div>
_END;
			}
			?>
			<input type="text" size="45" maxlength="400" name="SearchGroup"  AUTOCOMPLETE=OFF id="searchField" name="s_message" style="border-color:#0000ff;border-style:ridge;" />
			<input type="submit" value="Say" name="s_say"/>
		</form>
		</td>
		<td valign="bottom">
		<div id="FriendList" style="display:<?php if($Indicator==3 || $Indicator==4) echo 'block'; else echo 'none'; ?>">
		<font color='green' id="ChatToCount">0</font>
		</div>		
		<span style="display:inline-block;">
		<?php 
		if($Indicator==3) echo "<img src='../images/green.png'  width='20' id='picked' />"; 
		else if($Indicator==2) echo "<img src='../images/yellow.png'  width='20' id='picked' />"; 
		else if($Indicator==4) echo "<img src='../images/red.png'  width='20' id='picked' />"; 
		else echo "<img src='../images/white.png'  width='20' id='picked' />"; 
		?>
		</span>
		<select name="MyStatus" border=0 onChange="SetChat(this.value);Action('MyIndicator.php?Indicator='+this.value,'BlankMsg');">
		   <option value="3" <?php if($Indicator==3) echo "selected"; else echo ""; ?>>I am Available</option>
		   <option value="2" <?php if($Indicator==2) echo "selected"; else echo ""; ?>>I am Away</option>
		   <option value="4" <?php if($Indicator==4) echo "selected"; else echo ""; ?>>I am Busy</option>
		   <option value="5" <?php if($Indicator==5) echo "selected"; else echo ""; ?>>I am Offline</option>
		 </select>
		</td>
	</tr>
	</table> 
</div>

	<!-------------------------------------------------------------------------------------------->
<script type="text/javascript">var ScrollStep=1, ScrollInterval=100, WindowPostion=0, ToggleVariable=1, ScrollPosition1=0, ScrollPosition2=-1,upid="",MiniAdjust=1,Ajustment=-50;</script>
<script type="text/javascript">var totalHeight = <?php echo "$totalHeight"; ?> </script>

<script type="text/javascript" src="../scripts/AutoScroll.js"></script>
<script type="text/javascript" >
    function refreshiframe(name,email,picture,show_id)  
    {  
		document.getElementById('my_name').innerHTML = name;
		document.getElementById('FriendEmail').value = email;
		document.getElementById('ProfilPicture').src = picture;
//		document.getElementById('frame1').src="PictureGroup.php?name="+name+"&FriendEmail="+document.getElementById('FriendEmail').value ;
//		if(show_id!='')	window.open( "PictureMain.php?show_id="+show_id+"&FriendEmail="+document.getElementById('FriendEmail').value, "MyBlog");
    }
</script>	
</body>
</html>