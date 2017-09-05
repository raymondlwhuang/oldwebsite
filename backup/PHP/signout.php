<?php
	setcookie('member_name', '', time() - 96 * 3600, '/');
	setcookie('user_name', '', time() - 96 * 3600, '/');
	setcookie('member_pass', '', time() - 96 * 3600, '/');
	setcookie ('siteAuth', '', time() - 96 * 3600);
	setcookie ('Pid', '', time() - 96 * 3600);
	setcookie ('greeting', '', time() - 96 * 3600);
	session_start();
	include("../config.php");
	include("../inc/GlobalVar.inc.php");
	mysql_query("UPDATE user SET last_activity=NOW(), is_active = 1 WHERE email_address = '$GV_email_address' order by id limit 1");
	$Activeresult=mysql_query("SELECT id,TIMESTAMPDIFF(MINUTE,last_activity,NOW()) as TimeDiff from user where 1");
	while($Active = mysql_fetch_array($Activeresult))
	{
		$TimeDiff = $Active['TimeDiff'];
		if($TimeDiff >30) mysql_query("UPDATE user SET is_active= 1 WHERE id = $Active[id]");
	}	
	mysql_query("UPDATE view_permission SET is_active = 1 WHERE owner_email = '$GV_email_address' and is_active > 1 and is_active < 9 order by owner_email");
	
	mysql_query("UPDATE view_permission SET is_active = 1 WHERE viewer_email = '$GV_email_address' and is_active > 1 and is_active < 9 order by viewer_email");
	
//	unset($_COOKIE['member_name']);
//	unset($_COOKIE['user_name']);
//	unset($_COOKIE['member_pass']);
	foreach($_COOKIE as $name=>$value) {
		unset($_COOKIE["$name"]);
	}
	foreach($_SESSION as $name=>$value) {
		unset($_SESSION["$name"]);
	
	}
  session_write_close();
	echo "
        <script type=\"text/javascript\">
			window.open('index.php',target='_top');
        </script>";
	exit();  
?>  
