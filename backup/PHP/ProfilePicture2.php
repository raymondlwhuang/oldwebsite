<?php
require_once '../config.php';
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$result3 = mysql_query("select * from user where id=$user_id limit 1");
while($row3 = mysql_fetch_array($result3)) {
	$profile3=$row3['profile_picture'];
}

?>
<img src="<?php echo $profile3 ?>" height="100" />&nbsp;