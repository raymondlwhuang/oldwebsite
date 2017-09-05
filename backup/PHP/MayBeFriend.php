<?php 
include("../config.php");
$user_id=(int)$_REQUEST['user_id'];
$owner=mysql_query("SELECT * FROM user where id=$user_id LIMIT 1");
echo mysql_error();
while($row = mysql_fetch_array($owner))
{
 $email_address=$row['email_address'];
} 
if(isset($_REQUEST['pagenum'])) $pagenum2 = (int)$_REQUEST['pagenum'];
else $pagenum2 = 1; 
$page_rows2=4;
$max = 'limit ' .($pagenum2 - 1) * $page_rows2 .',' .$page_rows2; 
$rows2=0;
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE viewer_id = $user_id");
while($option = mysql_fetch_array($FriendResult)) {
	$FriendResult1 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$email_address' and viewer_email='$option[owner_email]' limit 1");
	if(mysql_num_rows($FriendResult1) == 0) {
		$PictureResult1 = mysql_query("SELECT * FROM user WHERE email_address = '$option[owner_email]' limit 1"); /* get his/her friend infor */
		while($row1 = mysql_fetch_array($PictureResult1)) {
			$first_name=$row1['first_name'];
			$last_name=$row1['last_name'];
			$viewer_id=$row1['id'];
			$curr_path=$row1['owner_path'];
			if(isset($profile_picture2)) {
				$found=0;
				foreach ($profile_picture2 as $key2 => $value2) {
					if($key2==$curr_path && $value2==$row1['profile_picture']) $found=1;
				}
				if($found==0) {
					$FriendID2[$curr_path] = $row1['id'];
					$profile_picture2[$curr_path] = $row1['profile_picture'];
					$name[$curr_path] = $first_name." ".$last_name;
					$rows2++;
				}
			}
			else {
					$FriendID2[$curr_path] = $row1['id'];
					$profile_picture2[$curr_path] = $row1['profile_picture'];
					$name[$curr_path] = $first_name." ".$last_name;
					$rows2++; 
			} 
		}
	}
	$FriendResult2 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$option[owner_email]'");
	while($option2 = mysql_fetch_array($FriendResult2)) {
		$FriendResult3 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$email_address' and viewer_email='$option2[viewer_email]' limit 1");
		if(mysql_num_rows($FriendResult3) == 0 && $option2['viewer_email']!=$email_address) {
			$PictureResult2 = mysql_query("SELECT * FROM user WHERE email_address = '$option2[viewer_email]' limit 1"); /* get his/her friend infor */
			while($row2 = mysql_fetch_array($PictureResult2)) {
				$first_name=$row2['first_name'];
				$last_name=$row2['last_name'];
				$viewer_id=$row2['id'];
				$curr_path=$row2['owner_path'];
				if(isset($profile_picture2)) {
					$found=0;
					foreach ($profile_picture2 as $key2 => $value2) {
						if($key2==$curr_path && $value2==$row2['profile_picture']) $found=1;
					}
					if($found==0) {
						$FriendID2[$curr_path] = $row2['id'];
						$profile_picture2[$curr_path] = $row2['profile_picture'];
						$name[$curr_path] = $first_name." ".$last_name;
						$rows2++; 
					}
				}
				else {
					$FriendID2[$curr_path] = $row2['id'];
					$profile_picture2[$curr_path] = $row2['profile_picture'];
					$name[$curr_path] = $first_name." ".$last_name;
					$rows2++; 
				} 
			}		
		}
	}
	
}

$last = ceil($rows2/$page_rows2); 
if ($pagenum2 < 1) 
{ 
	$pagenum2 = 1; 
} 
elseif ($pagenum2 > $last) 
{ 
	$pagenum2 = $last; 
} 
$first_row=($pagenum2 -1)* $page_rows2;
$count=0;
if(isset($profile_picture2)) {
	foreach ($profile_picture2 as $key2 => $value2) {
	
	$count++;
	$ShowName=substr($name[$key2],0,25);
	$longstring = <<<STRINGBEGIN
	<a href="" onClick="SendRequest ('LastActivity.php?user_id=$user_id','maincontent');makefriend('$name[$key2]','$FriendID2[$key2]');return false;"><img src='$value2' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;

		if($count > $first_row && $count <= ($first_row+$page_rows2)){
			echo $longstring;
		}
	}
}
?>	
		