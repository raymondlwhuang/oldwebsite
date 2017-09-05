<?php
require_once '../config.php';
include("sethash.php");
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$result2 = mysql_query("select * from profile_picture where user_id=$user_id order by id desc");
while($row2 = mysql_fetch_array($result2)) {
	$oldid=$row2['id'];
	$oldprofile["$oldid"]=$row2['profile_picture'];
}
 if (isset($oldprofile)){
	foreach($oldprofile as $key=>$picture) {
	   $link = newencode("$key,$picture,$user_id");
echo "<table style='display:inline-block;'>
<tr>
<td><img src='$picture' height='100' onClick='document.getElementById(\"profile\").src=\"$picture\";' class='pointer' /></td>
</tr>
<tr>
<td><a href='ChangeProfile.php?link=$link'  onclick='return confirm(\"Are you sure you want to delete?\");'><img src='../images/delete.png' alt='delete' width='25' /></a>&nbsp;<a href='ChangeProfile.php?link2=$link');'><font style='border: 5px grey double;background-color:#E4E4E4;color:black;position:relative;top:-10px;'>Set as Profile</font></a>
</td>
</tr>
</table>";
	}
}
?>