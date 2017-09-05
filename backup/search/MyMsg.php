<?php
require_once '../config.php';
require_once('../PHP/sethash.php');
$user_id = (int)$_REQUEST['user_id'];
$Me=mysql_query("SELECT * FROM user where id = $user_id LIMIT 1");          // query executed 
while($row = mysql_fetch_array($Me))
{
	$MyName=$row['first_name']." ".$row['last_name'];
}
$MyID = '|' . $user_id . '|';
//returning the last 15 messages
	$vRes = mysql_query("SELECT * FROM `s_chat_messages` where talk_to like '%$MyID%' ORDER BY `id` DESC LIMIT 15");

	$sMessages = '';
	$Msg_Output = '';
	// collecting list of messages
	$count=0;
	if ($vRes) {
		while($aMessages = mysql_fetch_array($vRes)) {
				
				$GetMsg = mysql_query("SELECT * FROM talk_message WHERE id = $aMessages[msg_id] LIMIT 1");
				while($row4 = mysql_fetch_array($GetMsg))
				{
						 $Msg_Output = newdecode($row4['message']);
				}				
		
		
			//$sWhen = date("M j h:i:s A", $aMessages['msg_time']);
			$sWhen = $aMessages['msg_time'];
			$count++;
			if($count==1) {
				if(strtolower(trim($MyName))!=strtolower(trim($aMessages['user'])))
					$sMessages = '<div ><font style="font-size:xx-small;color:red;">' .$aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . '<font style="font-size:medium;color:green;">'.$Msg_Output.'</font>'.' </div>'.$sMessages;
				else
					$sMessages = '<div ><font style="font-size:xx-small;color:#800080;">' .$aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . '<font style="font-size:medium;color:green;">'.$Msg_Output.'</font>'.' </div>'.$sMessages;
			}
			else {
				if(strtolower(trim($MyName))==strtolower(trim($aMessages['user']))) {
				$sMessages = '<div ><font style="font-size:xx-small;color:black;">' .$aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . '<font style="font-size:medium;color:green;">'.$Msg_Output.'</font>'.' </div>'.$sMessages;
				}
				else {
				$sMessages = '<div ><font style="font-size:xx-small;color:blue;">' .$aMessages['user'] . '<span>(' . $sWhen . ')</span>'. ': ' . '<font style="font-size:medium;color:green;">'.$Msg_Output.'</font>'.' </div>'.$sMessages;
				}
			}
		}
	} else {
		$sMessages = 'DB error, create SQL table before';
	}

	mysql_close($link);
	echo $sMessages;
?>