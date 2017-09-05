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
$MyID = '|' . $GV_id . '|';

$FriendCount = 0;
$CharCount = 0;
$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$FriendEmail[] = $row2['viewer_email'];
	if($row2['is_active']==3) $TalkStatus[] = 'checked'; else $TalkStatus[] = '';
	$TalkValue[] = $row2['is_active'];
	$queryFriends="SELECT * FROM user where  email_address = '$row2[viewer_email]' and (is_active = 3 or is_active = 4) LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($friend))
	{
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[] = $row3['profile_picture'];
	 $name[] = $first_name." ".$last_name;
	 $FriendStat[] = $row3['is_active'];
	 $FriendCount = $FriendCount + 1;
  	 if($row2['is_active']==3) $CharCount++;
	} 
}

if(isset($_REQUEST['SearchGroup']))
{	
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
		$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' and (is_active = 3 or is_active = 4) order by viewer_email";  // query string stored in a variable
		$result=mysql_query($query);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		$TalkList = '|' . $GV_id . '|';
		while($row2 = mysql_fetch_array($result))
		{
			$queryTalk="SELECT * FROM user where email_address = '$row2[viewer_email]' and (is_active = 3 or is_active = 4) limit 1;";  // query string stored in a variable
			$resultTalk=mysql_query($queryTalk);
			if (@mysql_num_rows($resultTalk) != 0){
				while($row3 = mysql_fetch_array($resultTalk))
				{
				 $TalkList = $TalkList . $row3['id'] . "|";
				}					
			}
		}
		if($TalkList != '|' . $GV_id . '|')	{			
		mysql_query("INSERT INTO `s_chat_messages` SET `user`='{$GV_name}', `msg_id`={$msg_id}, `when`=UNIX_TIMESTAMP(),`talk_to`='{$TalkList}'");
		}
		 Header("Location: {$_SERVER['REQUEST_URI']}");
		 die;
	}
}
	$vRes = mysql_query("SELECT * FROM `s_chat_messages` where talk_to like '%$MyID%' ORDER BY `id` DESC LIMIT 15");

	$sMessages = '';
	$Msg_Output = '';
	// collecting list of messages
	if ($vRes) {
		while($aMessages = mysql_fetch_array($vRes)) {
				
				$GetMsg = mysql_query("SELECT * FROM talk_message WHERE id = $aMessages[msg_id] LIMIT 1");
				while($row4 = mysql_fetch_array($GetMsg))
				{
						 $Msg_Output = newdecode($row4['message']);
				}				
		
		
			$sWhen = date("M j h:i:s A", $aMessages['when']);
			$sMessages = '<div>' . $aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . $Msg_Output.' </div>'.$sMessages;
		}
	} else {
		$sMessages = 'DB error, create SQL table before';
	}

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
<script type="text/javascript" src="../scripts/passVarToPhp5.js"></script>
<script type="text/javascript">
window.onload=doTimer;
var CharCount = <?php echo "$CharCount"; ?>;
if(CharCount == 0 && document.getElementById('DescSearch')) document.getElementById('DescSearch').style.display = 'none';
function SetChat (ChatStatus) {
	if(ChatStatus ==3){
	 document.getElementById('FriendList').style.display = 'block';
	 document.getElementById('picked').src = "../images/green.png";
	}
	else if(ChatStatus ==2){
	 document.getElementById('FriendList').style.display = 'none';
	 document.getElementById('picked').src = "../images/yellow.png";
	}
	else if(ChatStatus ==4){
	 document.getElementById('FriendList').style.display = 'block';
	 document.getElementById('picked').src = "../images/red.png";
	}
	else {
	 document.getElementById('FriendList').style.display = 'none';
	 document.getElementById('picked').src = "../images/white.png";
	}
}
function SetChatTo(email,SetCheckBox) {
	if (SetCheckBox===undefined) {
		if(document.getElementById(email).checked==true)
		{
			CharCount--;
			if(CharCount < 0) CharCount = 0;
			document.getElementById(email).checked = false;
		}
		else
		{
			CharCount++;
			document.getElementById(email).checked = true;
		}
	}
	else {
		if(SetCheckBox) CharCount++; else CharCount--;
	}
	if(CharCount == 0) {
	document.getElementById('ChatMsg').style.display = 'none';
	document.getElementById('DescSearch').style.display = 'none';
	}
	else {
	document.getElementById('ChatMsg').style.display = 'block';
	document.getElementById('DescSearch').style.display = 'block';
	doTimer();
	}
}
var t;
 
function timedCount()
 {
 SendRequest('../search/MyMsg.php','ChatMsg');
 t=setTimeout("timedCount()",7000);
 }
 
function doTimer()
 {
	if(CharCount != 0)  timedCount();
 }
 
function stopCount()
 {
 clearTimeout(t);
 }
 </script>
 
</head>
<body>
<div id='BlankMsg' style="display:none;"></div>
<div color="darkblue" style="position:fixed;bottom:0px;right:10px;float:right;">
	<table>
	<tr>
		<td>
		<div id="ChatMsg"><?php echo "$sMessages"; ?> </div>
		<form action="" class="submit_form" name="DescSearch" id="DescSearch" method="post">
			<img src="../images/chat.jpg" alt="chat" height="22"/>
			<?php if($ua['name'] == 'Internet Explorer') {
			echo <<<_END
			<div style="display:none;">
			<input style=”border:0; width:0; height:0? type=”text” size=”0? maxlength=”0?  />
			</div>
_END;
			}
			?>
			<input type="text" size="45" maxlength="400" name="SearchGroup"  AUTOCOMPLETE=OFF id="searchField" onKeyUp="stopCount();SendRequest('../search/MyMsg.php','ChatMsg');" name="s_message" style="border-color:#0000ff;border-style:ridge;" />
			<input type="submit" value="Say" name="s_say"/>
		</form>
		</td>
		<td valign="bottom">
			<div id="FriendList">
			<table width="200" border="0">
			<?php
			if(isset($profile_picture)){
				foreach ($profile_picture as $key => $value) {
					echo "<tr><td valign='top'>";
					if($FriendStat[$key] == 3 || $FriendStat[$key] == 4)
					{
						echo <<<END
						<input type='image' name='TalkTo' src='$value' width='35' onClick="SendRequest ('ChatTo.php?email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]');" />
						</td><td  valign='center'><font size='2'><a href="" onClick="SendRequest ('ChatTo.php?email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]');return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo' value='$FriendEmail[$key]' src='../images/green.png' width='20' onClick="SendRequest ('ChatTo.php?email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]');" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$FriendEmail[$key]' value='1' $TalkStatus[$key] onClick="SendRequest ('ChatTo.php?email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',this.checked);"/>
END;
					}
					elseif($FriendStat[$key] == 2) {
						echo <<<END
						<img src='$value' width='35'/>
						</td><td  valign='center'><font size='2'>$name[$key]</font>
						<img src='../images/yellow.png' width='20'/>
						</td><td valign='center'>
END;

					}
					elseif($FriendStat[$key] == 5) {
						echo <<<END
						<img src='$value' width='35'/>
						</td><td  valign='center'><font size='2'>$name[$key]</font>
						<img src='../images/white.png' width='20'/>
						</td><td valign='center'>
END;

					}
					echo "</td></tr>";
				}
			}
			?>	
			</table>
			</div>
		<span style="display:inline-block;"><img src='../images/green.png'  width='20' id='picked' /></span>
		<select name="MyStatus" border=0 onChange="SetChat(this.value);SendRequest ('MyIndicator.php?Indicator='+this.value,'BlankMsg');">
		   <option value="3">I am Available</option>
		   <option value="2">I am Away</option>
		   <option value="4">I am Busy</option>
		   <option value="5">I am Offline</option>
		 </select> chat(<?php echo "$FriendCount"; ?>)
		</td>
	</tr>
	</table> 
</div>
<?php if($ua['name'] == 'Internet Explorer') {
echo <<<_END
<script type="text/javascript">
doTimer();
</script>
_END;
}
?>
