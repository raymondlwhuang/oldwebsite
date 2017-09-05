<?php
if(!isset( $_COOKIE["greeting"] )) {
 setcookie( "greeting", "Welcome back ", time() + 60 * 60 * 24 * 365, "", "", false, true );
echo <<<_END
<script type="text/javascript">
//window.stop();
window.open('introduction.php',target='_top');
</script>
_END;

exit(); 
} 
require_once 'config2.php';

if($_SESSION['username'])
{
	if ($_SESSION["page"] == "HER") {
		unset($_SESSION["page"]);
echo <<<_END
<script type="text/javascript">
window.open('HERecorder.php',target='_top');
</script>
_END;
		
exit();
		
	}
	elseif ($_SESSION["page"] == "HELP") {
		unset($_SESSION["page"]);
echo <<<_END
<script type="text/javascript">
window.open('../ResultDisp.php',target='_top');
</script>
_END;
		
exit();
		
	}
}
include("../config.php");
include("../inc/CurrentDateTime.inc.php");
include_once("sethash.php");

require_once 'SureRemoveDir.php';
$newdate = strtotime ( "-2 day" , time() ) ;
$dir = "../".date('YMd',"$newdate");
SureRemoveDir($dir, true);
function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    // Check if the IP is passed from a proxy.
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
$ip = getIpAddr();
if(isSet($_REQUEST['submit']))
{
	$do_login = true;
	include_once 'do_login.php';
}
elseif ( isset( $_REQUEST["UserSetup"] ) ) {
  UserSetup();
}
elseif ( isset( $_REQUEST["Temporary"] ) ) {
  $Temporary=$_REQUEST["Temporary"];
}
$ErrorMessage="";
function UserSetup() {
	$email_address = strtolower($_REQUEST['username']);
	$query = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
			$todaydate = date("l, F j, Y, g:i a");
//			$email = "raymondlwhuang@yahoo.com";
			$sendinfo = $email_address.':::'.date('Ymd').'000000';
			$userEmail = newencode($sendinfo);
			$to = "$email_address";
//			$cc = "$email";
//			$headers = "From: no-reply@raymondlwhuang.com\r\n";
			//$headers .= "Reply-To: no-reply@raymondlwhuang.com\r\n";
//			$headers .= "MIME-Version: 1.0\r\n";
//			$headers = "CC: $cc\nX-Sender-IP: $ip\r\n";
//			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers = "From: no-reply@raymondlwhuang.com\r\n";
			$headers .= "Reply-To: no-reply@raymondlwhuang.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message = '<html><body>';	
	$result = mysql_query($query);
	$password = '';
	if (@mysql_num_rows($result) != 0 ){
		while($row = mysql_fetch_array($result)){ 
			$first_name=ucfirst(strtolower($row['first_name']));
			$last_name = ucfirst(strtolower($row['last_name'])); 
			$password = $row['password'];
		}
	}
	mysql_close();
	if($password != ''){
			$subject = "Password reset required";

			$message .= "<h1>Hi $first_name $last_name,</h1>";
			$message .= "<br/><br/>You require a password reset to this email address: $email_address <br/>
			Click here to <a href='http://www.raymondlwhuang.com/UserSetup.php?UserSetup=$userEmail' > Reset your password</a><br/>
		If you forgot the password for one of these usernames, just re-type in all information for this e-mail address,<br/>
		Hope this helps.<br/><br/><br/>
		See you back on www.raymondlwhuang.com!<br/><br/><br/>";
	}
	else {
			$subject = "Account Setup Notification";
			$message .= "<h1>User Setup Notification,</h1>";
			$message .= "<br/><br/>Please Click here to <a href='http://www.raymondlwhuang.com/UserSetup.php?UserSetup=$userEmail' > Set up your account</a><br/>
		Hope this helps.<br/><br/><br/>
		See you back on www.raymondlwhuang.com!<br/><br/><br/>";	
	}
		$message .= '</body></html>';
			if (preg_match("/bcc:/i", $userEmail . " " . $message) == 0 &&          /* check for injected 'bcc' field */
				preg_match("/Content-Type:/i", $userEmail . " " . $message) == 0 && /* check for injected 'content-type' field */
				preg_match("/cc:/i", $userEmail . " " . $message) == 0 &&           /* check for injected 'cc' field */
				preg_match("/to:/i", $userEmail . " " . $message) == 0) {           /* check for injected 'to' field */
				// Format the body of the email
				$message = $message . "\n\nSent from: $ip ($todaydate)\n";
				// Set the header, include the ip and set the reply-to field for convenience when replying to the email
		//		$headers = "CC: $cc\nX-Sender-IP: $ip\nFrom: $email\nReply-To: $email";
				// Send the email and check the result whether the function call was successful or not
				$sent = mail($to, $subject, $message, $headers) ;
				if($sent) {
					$ErrorMessage="Please check your mail and <br/>See you back on www.raymondlwhuang.com!";
				} else {
					$ErrorMessage="We encountered an error sending your mail";
				}
			} else  {
				$ErrorMessage="We encountered an error sending your mail";
			}
}

if(isset($_SESSION['private']) && $_SESSION['private'] == "yes") include("../inc/GlobalVar.inc.php");
if(isset($Temporary)) {
	$name['Temporary'] = 'Temporary';
	$profile_picture['Temporary'] = "../images/profile/public.jpg";
	$FriendID['Temporary'] = 'Temporary';
}
else {
	$name['public'] = 'Public';
	$profile_picture['public'] = "../images/profile/public.jpg";
	$FriendID['public'] = 'Public';
}
$rows=1;
$rows2=0;

if(isset($GV_id)) {
	setcookie( "greeting", "Welcome back ".$_SESSION["first_name"], time() + 60 * 60 * 24 * 365, "", "", false, true ); 
	mysql_query("UPDATE user SET last_activity='$now' WHERE id = $GV_id order by id limit 1");
	$Activeresult=mysql_query("SELECT id,is_active,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
	//echo mysql_error(); 
	while($Active = mysql_fetch_array($Activeresult))
	{
		$TimeDiff = $Active['TimeDiff'];
		if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id]");
		else if($Active['is_active'] == 1) mysql_query("UPDATE user SET is_active= 3 WHERE id = $Active[id] and password<>''");
	}
	$name[$GV_owner_path] = $GV_name;
	$profile_picture[$GV_owner_path] = $GV_profile_picture;
	$rows++;
	$FriendID[$GV_owner_path] = $GV_id;
	$PicturePath = "../pictures/$GV_owner_path";
	$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and viewer_group <> 'Temporary' and ((name like '$PicturePath%' and owner_path <> '$GV_owner_path') or owner_path = '$GV_owner_path') group by upload_id desc limit 1";  // query string stored in a variable

	$resultPicture=mysql_query($queryPicture);          // query executed 
	//echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row5 = mysql_fetch_array($resultPicture))
	{
		$upload_id[$GV_owner_path] = $row5['upload_id'];
	}
	if($_SESSION["admin"]==1)  $query="SELECT * FROM view_permission where 1 group by owner_email";  // query string stored in a variable
	else $query="SELECT * FROM view_permission where viewer_id = $GV_id group by owner_email";  // query string stored in a variable
	$result=mysql_query($query);          // query executed 
	//echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row2 = mysql_fetch_array($result))
	{
		$curr_path = $row2['owner_path'];
		$FriendID[$curr_path] = $row2['user_id'];
		$queryOwner="SELECT * FROM user where  email_address = '$row2[owner_email]' LIMIT 1";
		$owner=mysql_query($queryOwner);          // query executed 
		//echo mysql_error();
		while($row3 = mysql_fetch_array($owner))
		{
		 $first_name=ucfirst(strtolower($row3['first_name']));
		 $last_name = ucfirst(strtolower($row3['last_name']));
		 $profile_picture[$curr_path] = $row3['profile_picture'];
		 $rows++; 
		 $name[$curr_path] = $first_name." ".$last_name;
		} 
		$PicturePath = "../pictures/$curr_path";
		$queryPicture2="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and viewer_group <> 'Temporary' and ((name like '$PicturePath%' and owner_path <> '$curr_path') or owner_path = '$curr_path') group by upload_id desc limit 1";  // query string stored in a variable
		
		$resultPicture2=mysql_query($queryPicture2);          // query executed 
		//echo mysql_error();              // if any error is there that will be printed to the screen 
		while($row6 = mysql_fetch_array($resultPicture2))
		{
			$upload_id[$curr_path] = $row6['upload_id'];
		} 
	}
	$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$GV_owner_path' and viewer_group <> 'Public' and viewer_group <> 'Temporary' order by upload_id desc limit 1");  // query string stored in a variable
	$message = "";
	if(mysql_num_rows($beforeShow) == 0) {
		$message = "<br/>Please upload some picture/video to share!";
	}
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
				if(isset($profile_picture2)) {
					$found=0;
					foreach ($profile_picture2 as $key2 => $value2) {
						if($key2==$curr_path && $value2==$row1['profile_picture']) $found=1;
					}
					if($found==0) {
						$FriendID2[$curr_path] = $row1['id'];
						$profile_picture2[$curr_path] = $row1['profile_picture'];
						$name[$curr_path] = $first_name." ".$last_name;
						$rows2++;
					}
				}
				else {
						$FriendID2[$curr_path] = $row1['id'];
						$profile_picture2[$curr_path] = $row1['profile_picture'];
						$name[$curr_path] = $first_name." ".$last_name;
						$rows2++; 
				}			
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
						if(isset($profile_picture2)) {
							$found=0;
							foreach ($profile_picture2 as $key2 => $value2) {
								if($key2==$curr_path && $value2==$row2['profile_picture']) $found=1;
							}
							if($found==0) {
								$FriendID2[$curr_path] = $row2['id'];
								$profile_picture2[$curr_path] = $row2['profile_picture'];
								$name[$curr_path] = $first_name." ".$last_name;
								$rows2++; 
							}
						}
						else {
							$FriendID2[$curr_path] = $row2['id'];
							$profile_picture2[$curr_path] = $row2['profile_picture'];
							$name[$curr_path] = $first_name." ".$last_name;
							$rows2++; 
						}
					}		
				}
			}
		}
		
	}
}	
/*?????????????????????????????????????????????????????????????????*/

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<noscript><meta http-equiv="refresh" content="0;url=introduction.php"></noscript>	
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
<noscript><font color="red">Your browser does not support JavaScript! You also required upgrading your browser to the latest version for the purpose of displaying picture and video.</font><br/></noscript> 
<?php 
	if(!isset($GV_id)) include("Header2.php");
	else  include("Header.php"); 
	if($ErrorMessage!="") {
		echo "<div style='color:red'>$ErrorMessage</div>";
	}
	elseif($greeting!="") {
		//echo "<div style='color:red'>$greeting</div>";
	}
//	if(!isset( $_COOKIE["greeting"] )) setcookie( "greeting", "Welcome back ", time() + 60 * 60 * 24 * 365, "", "", false, true );

?>
	<div style="display:inline-block;vertical-align:top;">
		<iframe src="PictureMain.php<?php if(isset($Temporary)) echo "?show_id=$Temporary&FriendID=Temporary"; ?>" width="611" height="1935" id="Main2" name="MyBlog" frameborder=0 SCROLLING=no>
		  <p>Your browser does not support iframes.</p>
		</iframe>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<font  color="red">Viewing</font> <font id="my_name"><?php if(isset($GV_name)) echo substr($GV_name,0,20)."'s"; elseif(isset($Temporary)) echo "Temporary"; else echo "Public"; ?></font> photo<br/>
		<img src="<?php if(isset($GV_profile_picture)) echo $GV_profile_picture; else echo "../images/profile/public.jpg"; ?>" id="ProfilPicture"  width='240' class="pointer" onMouseOver="Action_pic(1);" onMouseOut="Action_pic(0);" onClick="Action_pic(3);"/><br/>
		<div id="popups">Change Picture</div>
		<div>
			<iframe src="<?php if(isset($Temporary)) echo ''; else echo 'PictureGroup.php'; ?>" height="1935" width="240" id="frame1" frameborder=0 SCROLLING=no>
			  <p>Your browser does not support iframes.</p>
			</iframe>
			<div id="maincontent"></div>
		</div>
	</div>
	<div style="display:inline-block;vertical-align:top;">
		<input type="hidden" name="FriendID" id="FriendID" value='<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary"; else echo "Public" ?>'>
		<input type="hidden" name="FriendPath" id="FriendPath" value='<?php if(isset($GV_id)) echo $GV_owner_path; else echo ""; ?>'>
		<input type="hidden" name="show_id" id="show_id" value="<?php if(isset($show_id)) echo $show_id; else echo''; ?>">
		
		<?php
		$last = 0;
		$page_rows = 5; 
		if(!isset($Temporary)) {
			$pagenum = 1; 
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
			echo "<input type='image' src=\"../images/first2.png\" id='first' onClick=\"FriendList('first');\">";
			echo " ";
			echo "<input type='image' src=\"../images/previous2.png\" id='previous'  onClick=\"FriendList('previous');\">";
			echo "<input type='image' src=\"../images/next1.png\" id='next' onClick=\"FriendList('next');\">";
			echo " ";
			echo "<input type='image' src=\"../images/last.png\" id='last'  onClick=\"FriendList('last');\"><br/>";
			$count=0;
		}
		?>
		<div id="Friends" style="height:450px;">
		<?php
		$pagenum2 = 1; 
		$page_rows2 = 4;  
		$last2 = ceil($rows2/$page_rows2); 
		if(!isset($Temporary)) {
		echo "<b>Public</b><br/>";
		foreach ($profile_picture as $key => $value) {
		$count++;
		if(isset($upload_id[$key])) $show_id = $upload_id[$key]; else $show_id = '';
		if($name[$key]=='Public') $ShowName="<font color='red'><b>Friends</b></font>"; else $ShowName=substr($name[$key],0,25);
		$longstring = <<<STRINGBEGIN
		<a href="" onClick="refreshiframe('$name[$key]','$FriendID[$key]','$value','$show_id','$key');return false;"><img src='$value' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;
			if($count > $first_row && $count <= ($first_row+$page_rows)){
				echo $longstring;
			}
		}
		echo "</div><div>";
			echo '<font color="red" id="showtitil" size="2"><b>People You<br> May Know</b></font><br/>';
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
				echo "<input type='image' src=\"../images/first2.png\" id='first2' onClick=\"MayBeFriend('first');\">";
				echo " ";
				echo "<input type='image' src=\"../images/previous2.png\" id='previous2'  onClick=\"MayBeFriend('previous');\">";
				echo "<input type='image' src=\"../images/next1.png\" id='next2' onClick=\"MayBeFriend('next');\">";
				echo " ";
				echo "<input type='image' src=\"../images/last.png\" id='last2'  onClick=\"MayBeFriend('last');\"><br/>";
			$count2=0;
			if(isset($profile_picture2)) {
				echo "<div  id=\"MyBeFriends\">";
				foreach ($profile_picture2 as $key2 => $value2) {
				$count2++;
				$ShowName=substr($name[$key2],0,25);
				$longstring = <<<STRINGBEGIN
				<a href="" onClick="SendRequest ('LastActivity.php?user_id=$GV_id','maincontent');makefriend('$name[$key2]','$FriendID2[$key2]');return false;"><img src='$value2' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;
					if($count2 > $first_row2 && $count2 <= ($first_row2+$page_rows2)){
						echo $longstring;
					}
				}
				echo "</div>";
			}
			}
			?>		
		</div>
	</div>
	
</div>
<div id='BlankMsg' style="display:none;"></div>
<?php if(isset($GV_id)) : ?>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=1 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#E6FFE6;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<?php endif; ?>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id="<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary"; else echo "Public"; ?>";</script>
<?php if(isset($GV_id)) : ?>
<script src="../scripts/chat.js"></script>
<?php endif; ?>
<script type="text/javascript" >
var OrgFriendID="<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary"; else echo "Public"; ?>";
var pagenum = 1;
var last = <?php echo $last; ?>;
var rows = <?php echo $rows; ?>;
var page_rows = <?php echo $page_rows; ?>;
var admin = <?php if(isset($_SESSION["admin"])) echo $_SESSION["admin"]; else echo "0"; ?>;
<?php if(isset($GV_id)) : ?>
document.getElementById('Home').style.display = "none";
<?php endif; ?>
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
if(rows<=page_rows) {
	if(document.getElementById('first')) document.getElementById('first').style.display = "none";
	if(document.getElementById('previous')) document.getElementById('previous').style.display = "none";
	if(document.getElementById('next')) document.getElementById('next').style.display = "none";
	if(document.getElementById('last')) document.getElementById('last').style.display = "none";
}
var pagenum2 = 1;
var last2 = <?php echo $last2; ?>;
var rows2 = <?php echo $rows2; ?>;
var page_rows2 = <?php echo $page_rows2; ?>;
if(rows2<=page_rows2) {
	if(document.getElementById('first2')) document.getElementById('first2').style.display = "none";
	if(document.getElementById('previous2')) document.getElementById('previous2').style.display = "none";
	if(document.getElementById('next2')) document.getElementById('next2').style.display = "none";
	if(document.getElementById('last2')) document.getElementById('last2').style.display = "none";
}
if(rows2<=0) {if(document.getElementById('showtitil')) document.getElementById('showtitil').style.display = "none";}
else  {if(document.getElementById('showtitil')) document.getElementById('showtitil').style.display = "block";}
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
	

	var url = 'FriendList.php?user_id=<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary"; else echo "Public"; ?>&pagenum='+pagenum;
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
	var url = 'MayBeFriend.php?user_id=<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary"; else echo "Public"; ?>&pagenum='+pagenum2;
	$(document).ready(function() {
	   $("#MyBeFriends").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function refreshiframe(name,FriendID,picture,show_id,FriendPath)  
{  
	var ViewerID="<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary";  else echo "Public"; ?>";
	document.getElementById('my_name').innerHTML = name.substring(0,20);
	document.getElementById('FriendID').value = FriendID;
	document.getElementById('FriendPath').value = FriendPath;
	document.getElementById('ProfilPicture').src = picture;
//	document.getElementById('frame1').src="PictureGroup.php?name="+name+"&FriendID="+FriendID ;
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
	var user_id="<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary";  else echo "Public"; ?>";
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
	var owner = "<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary";  else echo "Public"; ?>";
	var curr = document.getElementById('FriendID').value;
	var FriendPath = document.getElementById('FriendPath').value;
//	alert(owner+'tst'+curr);
	if(disp==1 && curr!="Public" && curr!="Temporary") {
		document.getElementById('popups').style.display = 'block';
		if(owner==curr) document.getElementById('popups').innerHTML="Change Picture";
		else document.getElementById('popups').innerHTML="Profile Pictures";
	}
	else document.getElementById('popups').style.display = 'none';
	if(owner==curr && disp==3 && curr!="Public" && curr!="Temporary") window.open('ChangeProfile.php',target='_top');
	else if(owner!=curr && disp==3 && curr!='Public' && curr!='Temporary')  window.open('ProfilePicture.php?FriendPath='+FriendPath,target='_top');
}



function Set_OrgFriendID(CurrID)  
{
  OrgFriendID=CurrID;
}

</script>

<?php
if(isset($GV_id)) {
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
}
?>
</body>
</html>