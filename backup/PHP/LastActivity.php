<?php
include("../config.php");
include("../inc/CurrentDateTime.inc.php");	
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
mysql_query("UPDATE user SET last_activity='$now' WHERE id = $user_id order by id limit 1");
$Activeresult=mysql_query("SELECT id,is_active,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
while($Active = mysql_fetch_array($Activeresult))
{
	$TimeDiff = $Active['TimeDiff'];
	if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id]");
	else if($Active['is_active'] == 1) mysql_query("UPDATE user SET is_active= 3 WHERE id = $Active[id]");
}
?>