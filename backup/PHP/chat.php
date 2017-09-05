<?php
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
require_once '../config.php';
require_once('../PHP/sethash.php');
include("../inc/GlobalVar.inc.php");
include("../inc/CurrentDateTime.inc.php");
$MyID = '|' . $GV_id . '|';

$ReadyToChat = 0;
$Indicator = 3;
$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$queryFriends="SELECT * FROM user where  email_address = '$row2[viewer_email]' and (is_active = 2 or is_active = 3 or is_active = 4) LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	while($row3 = mysql_fetch_array($friend))
	{
	 $FriendEmail[] = $row2['viewer_email'];
	 if($row2['is_active']==3) $TalkStatus[] = 'checked'; else $TalkStatus[] = '';
	 $TalkValue[] = $row2['is_active'];
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[] = $row3['profile_picture'];
	 $name[] = $first_name." ".$last_name;
	 $ReadyToChat = $ReadyToChat + 1;
	} 
}
$ChatToCount = 0;
$sMessages2="";
if(isset($_REQUEST['SearchGroup']))
{
	mysql_query("UPDATE user SET last_activity='$now' WHERE id = $GV_id order by id limit 1");
	$Activeresult=mysql_query("SELECT id,is_active,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
	while($Active = mysql_fetch_array($Activeresult))
	{
		$TimeDiff = $Active['TimeDiff'];
		if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id]");
		else if($Active['is_active'] == 1) mysql_query("UPDATE user SET is_active= 3 WHERE id = $Active[id]");
	}	

	$queryChat="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
	$resultChat=mysql_query($queryChat);          // query executed 
	while($row6 = mysql_fetch_array($resultChat))
	{
		$curr_path = $row6['owner_path'];
		$queryFriends2="SELECT * FROM user where  email_address = '$row6[viewer_email]' and (is_active = 6 or is_active = 3 or is_active = 4) LIMIT 1";
		$friend2=mysql_query($queryFriends2);          // query executed 
		while($row7 = mysql_fetch_array($friend2))
		{
		 if($row6['is_active']==3)$ChatToCount++;
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
			$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' and is_active = 3 order by viewer_email";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			$TalkList = '|' . $GV_id . '|';
			while($row2 = mysql_fetch_array($result))
			{
				$queryTalk="SELECT * FROM user where email_address = '$row2[viewer_email]' and (is_active = 6 or is_active = 3 or is_active = 4) limit 1;";  // query string stored in a variable
				$resultTalk=mysql_query($queryTalk);
				if (@mysql_num_rows($resultTalk) != 0){
					while($row3 = mysql_fetch_array($resultTalk))
					{
					 $TalkList = $TalkList . $row3['id'] . "|";
					}					
				}
			}
			if($TalkList != '|' . $GV_id . '|')	{			
			mysql_query("INSERT INTO `s_chat_messages` SET `user`='{$GV_name}', `msg_id`={$msg_id}, `when`=UNIX_TIMESTAMP(),`msg_time`=NOW(),`talk_to`='{$TalkList}',`show_flag`='{$GV_id}'");
			}
			 Header("Location: {$_SERVER['REQUEST_URI']}");
			 die;
		}
	}
	else $sMessages2 = "<font color='red'>Please pick a person to chat!</font>";
}
/*
	$queryTalk="SELECT is_active FROM user where id = $GV_id limit 1;";  // query string stored in a variable
	$ResultStatus=mysql_query("SELECT is_active FROM user where id = $GV_id limit 1");
	while($row5 = mysql_fetch_array($ResultStatus))
	{
	 $Indicator = $row5['is_active'];
	}					
*/	
	mysql_close($link);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Chat</title> 
<style type="text/css" media="screen">
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
<script src="../scripts/jquery.js"></script>

<script type="text/javascript" >
var user_id =  <?php echo $GV_id; ?>;
var refreshId, refreshId1;
function Start() {
	$(document).ready(function() {
		 $("#FriendList").load("ChatTo2.php?user_id="+user_id);
		refreshId = setInterval(function() {
		  $("#FriendList").load('ChatTo2.php?user_id='+user_id+'&randval='+ Math.random());
	   }, 6000);
	   $.ajaxSetup({ cache: false });
	});
	$(document).ready(function() {
		 $("#ChatMsg").load("../search/MyMsg.php?user_id="+user_id);
		refreshId1 = setInterval(function() {
		  $("#ChatMsg").load('../search/MyMsg.php?user_id='+user_id+'&randval='+ Math.random());
	   }, 6000);
	   $.ajaxSetup({ cache: false });
	});
}
function Stop() {
	clearInterval(refreshId);
	clearInterval(refreshId1);
}
function SetChat (Indicator) {
	if(Indicator ==3){
		document.getElementById('FriendList').style.display = 'block';
		document.getElementById('picked').src = "../images/green.png";
		document.getElementById('ChatMsg').style.display = 'block';
		document.getElementById('DescSearch').style.display = 'block';
	}
	else if(Indicator ==2){
		document.getElementById('FriendList').style.display = 'block';
		document.getElementById('picked').src = "../images/yellow.png";
		document.getElementById('ChatMsg').style.display = 'block';
		document.getElementById('DescSearch').style.display = 'block';
		parent.chat(2);
	}
	else if(Indicator ==4){
		document.getElementById('FriendList').style.display = 'block';
		document.getElementById('picked').src = "../images/red.png";
		document.getElementById('ChatMsg').style.display = 'block';
		document.getElementById('DescSearch').style.display = 'block';
	}
	else if(Indicator ==5){
		document.getElementById('FriendList').style.display = 'block';
		document.getElementById('picked').src = "../images/white.png";
		document.getElementById('ChatMsg').style.display = 'block';
		document.getElementById('DescSearch').style.display = 'block';
		parent.chat(5);
	}
	else{
		document.getElementById('FriendList').style.display = 'block';
		document.getElementById('picked').src = "../images/blue.jpg";
		document.getElementById('ChatMsg').style.display = 'block';
		document.getElementById('DescSearch').style.display = 'block';
		parent.chat();
	}
}
function SetChatTo(viewer_id,SetCheckBox) {
	if (SetCheckBox==3) document.getElementById(viewer_id).checked = !(document.getElementById(viewer_id).checked);
	if(document.getElementById(viewer_id).checked) is_active=3; else is_active=1;
	var id = "#BlankMsg";
	var url = "ChatTo.php?user_id="+user_id+"&viewer_id="+viewer_id+"&is_active="+is_active;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
	$("#FriendList").load("ChatTo2.php?user_id="+user_id);
}
function Action(url,affect_id) {
	var id = "#"+affect_id;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
}
window.onload=Start;
</script>
 
</head>
<body>
<div id='BlankMsg' style="display:none;"></div>
<div color="darkblue">
	<table>
	<tr>
		<td>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$sMessages2"; ?> </div>
		<div id="ChatMsg"> </div>
		<form action=""  class="submit_form" name="DescSearch" id="DescSearch" method="post">
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
		<div id="FriendList" style="display:<?php if($Indicator==3 || $Indicator==4 || $Indicator==6) echo 'block'; else echo 'none'; ?>">
		<font color='green' id="ChatToCount">0</font>
		</div>		
		<span style="display:inline-block;">
		<?php 
		if($Indicator==3) echo "<img src='../images/green.png'  width='20' id='picked' />"; 
		else if($Indicator==2) echo "<img src='../images/yellow.png'  width='20' id='picked' />"; 
		else if($Indicator==4) echo "<img src='../images/red.png'  width='20' id='picked' />"; 
		else if($Indicator==5) echo "<img src='../images/white.png'  width='20' id='picked' />"; 
		else echo "<img src='../images/blue.jpg'  width='20' id='picked' />"; 
		?>
		</span>
		<select name="MyStatus" border=0 onChange="SetChat(this.value);Action('MyIndicator.php?user_id=<?php echo $GV_id; ?>&Indicator='+this.value,'BlankMsg');">
		   <option value="3" <?php if($Indicator==3) echo "selected"; else echo ""; ?>>I am Available</option>
		   <option value="2" <?php if($Indicator==2) echo "selected"; else echo ""; ?>>I am Away</option>
		   <option value="4" <?php if($Indicator==4) echo "selected"; else echo ""; ?>>I am Busy</option>
		   <option value="6" <?php if($Indicator==6) echo "selected"; else echo ""; ?>>I am Online(minimize)</option>
		   <option value="5" <?php if($Indicator==5) echo "selected"; else echo ""; ?>>I am Offline</option>
		 </select>
		</td>
	</tr>
	</table> 

</div>
</body>
</html>
