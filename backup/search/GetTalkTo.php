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
		
		
			//$sWhen = date("M j h:i:s A", $aMessages['msg_time']);
			$sWhen = $aMessages['msg_time'];
			//$sMessages = '<div>' . $aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . $Msg_Output.' </div>'.$sMessages;
			$sMessages = '<div ><font style="font-size:xx-small;">' . $aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . '<font style="font-size:medium;color:green;">'.$Msg_Output.'</font>'.' </div>'.$sMessages;
		}
	} else {
		$sMessages = 'DB error, create SQL table before';
	}

	mysql_close($link);
 ?>
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

