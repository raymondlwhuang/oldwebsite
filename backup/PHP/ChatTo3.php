<?php
include("../config.php");
require_once('../PHP/sethash.php');
$Activeresult=mysql_query("SELECT id,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
while($Active = mysql_fetch_array($Activeresult))
{
	$TimeDiff = $Active['TimeDiff'];
	if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id] and password<>''");
}
$user_id = (int)$_REQUEST['user_id'];
$OnlineCount = 0;
$query="SELECT * FROM view_permission where user_id = $user_id group by viewer_id";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
//echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$friend=mysql_query("SELECT * FROM user where  id = $row2[viewer_id] and (is_active = 2 or is_active = 3 or is_active = 4 or is_active = 6) LIMIT 1");
	//echo mysql_error();
	while($row3 = mysql_fetch_array($friend))
	{
  	 $OnlineCount++;
	} 
}
/*??????????????????*/

$Me=mysql_query("SELECT * FROM user where id = $user_id LIMIT 1");          // query executed 
while($row = mysql_fetch_array($Me))
{
	$MyName=strtolower($row['first_name']." ".$row['last_name']);
	$is_active=$row['is_active'];
}
$MyID = '|' . $user_id . '|';
//returning the last 15 messages
	$sMessages = '';
	$diff=0;
	if($is_active==6) {
		$vRes = mysql_query("SELECT * FROM `s_chat_messages` where talk_to like '%$MyID%' ORDER BY `id` DESC LIMIT 1");
		
		$Msg_Output = '';
		// collecting list of messages
		while($aMessages = mysql_fetch_array($vRes)) {
			$thisName=strtolower($aMessages['user']);
			$thisshow_flag=$aMessages['show_flag'];
			$talk_user = explode(",", $thisshow_flag);
			$found=false;
			foreach($talk_user as $key=>$thisuser) {
				if($thisuser==$user_id) $found=true;
			}
			if($found==false) {
				$GetMsg = mysql_query("SELECT * FROM talk_message WHERE id = $aMessages[msg_id] LIMIT 1");
				while($row4 = mysql_fetch_array($GetMsg))
				{
						 $Msg_Output = newdecode($row4['message']);
				}				
				$sWhen = $aMessages['msg_time'];
				$When  = $aMessages['when'];
				$diff=time() - $When;
				if((time() - $When) <= 600)	$sMessages = $aMessages['user'] . ': ' . $Msg_Output;
			}
		}
	}
	mysql_close($link);
	if($OnlineCount==0)
		echo "<div style='display:inline-block'><font style=\"font-size:8px;color:green;\" >$OnlineCount Friend Online</font> <br/>	<font id=\"AvailMsg\">$sMessages</font></div>";
	else
		echo "<div style='display:inline-block'><font style=\"font-size:8px;color:green;\" >$OnlineCount Friends Online</font> <br/><font id=\"AvailMsg\">	$sMessages</font></div>";
?>
