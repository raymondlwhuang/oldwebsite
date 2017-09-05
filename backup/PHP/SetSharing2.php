<?php
include("../config.php");
$user_id=(int)$_REQUEST['user_id'];
$share_flag = (int)$_REQUEST['share_flag'];
$viewer_id = (int)$_REQUEST['viewer_id'];
$Nameresult=mysql_query("SELECT * from user where id=$viewer_id limit 1");
echo mysql_error(); 
while($Row = mysql_fetch_array($Nameresult))
{
	$name=$Row['first_name'] . " " . $Row['last_name'];
}
mysql_query("UPDATE view_permission SET share_flag=$share_flag WHERE user_id = $user_id and viewer_id=$viewer_id");
echo mysql_error();
if($share_flag==0) echo "This is to confirmed that\n$name will not allowe for sharing pictures/videos!";
elseif($share_flag==1) echo "This is to confirmed that\n$name need to ask before sharing pictures/videos!";
elseif($share_flag==2) echo "Pictures/videos sharing permit has been set up for $name!";

	