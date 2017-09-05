<?php
require_once '../config.php';
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$result2 = mysql_query("select * from profile_picture where user_id=$user_id");
while($row2 = mysql_fetch_array($result2)) {
	$oldprofile[]=$row2['profile_picture'];
}
 if (isset($oldprofile)){
	foreach($oldprofile as $key=>$picture) {
	   echo "<img src='$picture' height='100' />";
	}
}
?>