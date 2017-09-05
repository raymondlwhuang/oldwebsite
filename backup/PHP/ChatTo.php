<?php
session_start();
include("../config.php");
$Activeresult=mysql_query("SELECT id,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
while($Active = mysql_fetch_array($Activeresult))
{
	$TimeDiff = $Active['TimeDiff'];
	if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id] and password<>''");
}
IF(isset($_REQUEST['user_id']))
{
	$user_id = (int)$_REQUEST['user_id'];
	$viewer_id = (int)$_REQUEST['viewer_id'];
	$is_active = (int)$_REQUEST['is_active'];
	mysql_query("UPDATE view_permission SET is_active=$is_active WHERE user_id = $user_id and viewer_id = $viewer_id");
	echo mysql_error();
}
