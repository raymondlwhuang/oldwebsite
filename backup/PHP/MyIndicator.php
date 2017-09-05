<?php
include("../config.php");
include("../inc/CurrentDateTime.inc.php");
IF(isset($_GET['Indicator']))
{
	$user_id=(int)$_GET['user_id'];
	$activate = (int)$_GET['Indicator'];
	$b = strtotime($now) - 1800;
	$exipred = date('Y-m-d H:i:s',$b);
	mysql_query("UPDATE user SET last_activity='$now',is_active=$activate WHERE id = $user_id");
	if($activate==3) {
		$Me=mysql_query("SELECT * FROM user where id = $user_id LIMIT 1");          // query executed 
		while($row = mysql_fetch_array($Me))
		{
			$MyName=strtolower($row['first_name']." ".$row['last_name']);
		}
		$MyID = '|' . $user_id . '|';		
		$vRes = mysql_query("SELECT * FROM `s_chat_messages` where talk_to like '%$MyID%' ORDER BY `id` DESC LIMIT 1");
		while($row2 = mysql_fetch_array($vRes))
		{
			$ownerName=strtolower($row2['user']);
			$thisID=$row2['id'];
			$thisshow_flag=$row2['show_flag'];
		}
		$talk_user = explode(",", $thisshow_flag);
		$found=false;
		foreach($talk_user as $key=>$thisuser) {
			if($thisuser==$user_id) $found=true;
		}
		if($found==false) {
			$thisshow_flag.=",".$user_id;
			mysql_query("UPDATE s_chat_messages SET show_flag='$thisshow_flag' WHERE id = $thisID");
		}
	}
	mysql_query("UPDATE user SET is_active= 1 WHERE last_activity < '$exipred'");
	echo mysql_error();
}


