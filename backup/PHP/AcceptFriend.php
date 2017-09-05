<?php
session_start();
include("../config.php");
include_once("sethash.php");
if (isset($_REQUEST['assigntogroup']))
{
	$assigntogroup=$_REQUEST['assigntogroup'];
	$userEmail=newdecode($_REQUEST['userEmail']);
	$sender_name = $pieces[2];
	$pieces = explode(",", $userEmail);
	$user_id = (int)$pieces[3];
	$viewer_id = $pieces[4];
	mysql_query("UPDATE view_permission SET viewer_group='$assigntogroup' WHERE user_id=$viewer_id and viewer_id=$user_id;");
echo <<<_END
<script type="text/javascript">
alert("$sender_name is set as your friend now!");
window.open('index.php',target='_top');
</script>
_END;
		
exit();	
}
elseif (isset($_REQUEST['userEmail']))
{
	$accept=$_REQUEST['accept'];
	$userEmail=newdecode($_REQUEST['userEmail']);
	$pieces = explode(",", $userEmail);
	$from_email = $pieces[0];
	$to_email = $pieces[1];
	$sender_name = $pieces[2];
	$user_id = (int)$pieces[3];
	$viewer_id = $pieces[4];
	$viewer_group = $pieces[5];
	$owner_path = $pieces[6];
	$first_name = $pieces[7];
	$last_name = $pieces[8];
	if($accept=="yes") {
		mysql_query("UPDATE view_permission SET is_active=1 WHERE user_id=$user_id and viewer_id=$viewer_id;");
		mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,is_active,viewer_id,viewer_email,first_name,last_name) VALUES($viewer_id,'$to_email', '$owner_path',1,$user_id,'$from_email','$first_name','$last_name')");

	}
	else {
		mysql_query("DELETE FROM view_permission WHERE user_id=user_id and viewer_id=$viewer_id");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php 
if(isset($accept) && $accept=="no") echo "<font color='red'><b>Friend require has removed from $sender_name's list!</b></font>"; 
else {
	echo "<form action='' name='MyForm' enctype='application/x-www-form-urlencoded' method='post'>";
		foreach($_REQUEST as $name => $value) {
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
		}
	echo "Please assign a group for $sender_name<input type=\"text\" name=\"assigntogroup\" value=\"\">";
	echo "<input type=\"submit\" name=\"submit\" value=\"submit\"></form>";

}
?>
</body>
</html>