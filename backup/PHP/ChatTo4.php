<?php
session_start();
include("../config.php");
$Activeresult=mysql_query("SELECT id,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
while($Active = mysql_fetch_array($Activeresult))
{
	$TimeDiff = $Active['TimeDiff'];
	if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id]");
}
$email_address = mysql_real_escape_string($_REQUEST['email_address']);
$ReadyToChat = 0;
$ChatToCount = 0;
$query="SELECT * FROM view_permission where owner_email = '$email_address' group by viewer_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$queryFriends="SELECT * FROM user where  email_address = '$row2[viewer_email]' and (is_active = 2 or is_active = 3 or is_active = 4) LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($friend))
	{
	 $FriendEmail[] = $row2['viewer_email'];
	 if($row2['is_active']==3) $TalkStatus[] = 'checked'; else $TalkStatus[] = '';
	 $TalkValue[] = $row2['is_active'];
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[] = $row3['profile_picture'];
	 $name[] = $first_name." ".$last_name;
	 $FriendStat[] = $row3['is_active'];
	 $ReadyToChat = $ReadyToChat + 1;
  	 if($row2['is_active']==3) $ChatToCount++;
	} 
}
echo "Available to chat: <font color='red'>($ReadyToChat)</font><font color='green' id='ChatToCount'>($ChatToCount)</font>";
?>

			<table width="200" border="0">
			<?php
			if(isset($profile_picture)){
				foreach ($profile_picture as $key => $value) {
					echo "<tr><td valign='top'>";
					if($FriendStat[$key] == 3)
					{
						echo <<<END
						<input type='image' name='TalkTo1' src='$value' width='35' onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);" />
						</td><td  valign='center'><font size='2'><a href="" onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo2' value='$FriendEmail[$key]' src='../images/green.png' width='20' onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$FriendEmail[$key]' value='1' $TalkStatus[$key] onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',this.checked);"/>
END;
					}
					if($FriendStat[$key] == 4)
					{
						echo <<<END
						<input type='image' name='TalkTo1' src='$value' width='35' onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);" />
						</td><td  valign='center'><font size='2'><a href="" onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo2' value='$FriendEmail[$key]' src='../images/red.png' width='20' onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$FriendEmail[$key]' value='1' $TalkStatus[$key] onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',this.checked);"/>
END;
					}
					if($FriendStat[$key] == 2)
					{
						echo <<<END
						<input type='image' name='TalkTo1' src='$value' width='35' onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);" />
						</td><td  valign='center'><font size='2'><a href="" onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo2' value='$FriendEmail[$key]' src='../images/yellow.png' width='20' onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',3);" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$FriendEmail[$key]' value='1' $TalkStatus[$key] onClick="Action('ChatTo.php?email_address=$email_address&email=$FriendEmail[$key]','BlankMsg');SetChatTo('$FriendEmail[$key]',this.checked);"/>
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

