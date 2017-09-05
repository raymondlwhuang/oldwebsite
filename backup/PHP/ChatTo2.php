<?php
session_start();
include("../config.php");
$user_id = (int)$_REQUEST['user_id'];
$ReadyToChat = 0;
$ChatToCount = 0;
$query="SELECT * FROM view_permission where user_id = $user_id group by viewer_id";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row = mysql_fetch_array($result))
{
	$curr_path = $row['owner_path'];
	$viewer_id[] = $row['viewer_id'];
	$queryFriends="SELECT * FROM user where  id = $row[viewer_id] and (is_active = 2 or is_active = 3 or is_active = 4 or is_active = 6) LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($friend))
	{
	 $TalkValue[] = $row['is_active'];
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[] = $row3['profile_picture'];
	 $name[] = $first_name." ".$last_name;
	 $FriendStat[] = $row3['is_active'];
	 if($row3['is_active']==3 || $row3['is_active']==4) $ReadyToChat = $ReadyToChat + 1;
		 if($row['is_active']==3) {
			 $ChatToCount++;
			 $TalkStatus[] = 'checked'; 
		 }
		 else $TalkStatus[] = '';
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
						<input type='image' name='TalkTo1' src='$value' width='35' onClick="SetChatTo('$viewer_id[$key]',3);" />
						</td><td  valign='center'><font size='2'><a href="" onClick="SetChatTo('$viewer_id[$key]',3);return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo2' value='$viewer_id[$key]' src='../images/green.png' width='20' onClick="SetChatTo('$viewer_id[$key]',3);" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$viewer_id[$key]' value='1' $TalkStatus[$key] onClick="SetChatTo('$viewer_id[$key]',this.checked);"/>
END;
					}
					elseif($FriendStat[$key] == 4)
					{
						echo <<<END
						<input type='image' name='TalkTo1' src='$value' width='35' onClick="SetChatTo('$viewer_id[$key]',3);" />
						</td><td  valign='center'><font size='2'><a href="" onClick="SetChatTo('$viewer_id[$key]',3);return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo2' value='$viewer_id[$key]' src='../images/red.png' width='20' onClick="SetChatTo('$viewer_id[$key]',3);" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$viewer_id[$key]' value='1' $TalkStatus[$key] onClick="SetChatTo('$viewer_id[$key]',this.checked);"/>
END;
					}
					elseif($FriendStat[$key] == 2)
					{
						echo <<<END
						<img src='$value' width='35'/>
						</td><td  valign='center'><font size='2'>$name[$key]</font>
						<img src='../images/yellow.png' width='20'/>
						</td><td valign='center'>
END;

}
					elseif($FriendStat[$key] == 6)
					{
						echo <<<END
						<input type='image' name='TalkTo1' src='$value' width='35' onClick="SetChatTo('$viewer_id[$key]',3);" />
						</td><td  valign='center'><font size='2'><a href="" onClick="SetChatTo('$viewer_id[$key]',3);return false;">$name[$key]</a></font>
						<input type='image' name='TalkTo2' value='$viewer_id[$key]' src='../images/blue.jpg' width='20' onClick="SetChatTo('$viewer_id[$key]',3);" />
						</td><td valign='center'>
						<input type='checkbox' name='TalkTo' id ='$viewer_id[$key]' value='1' $TalkStatus[$key] onClick="SetChatTo('$viewer_id[$key]',this.checked);"/>
END;

}					elseif($FriendStat[$key] == 5) {
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

