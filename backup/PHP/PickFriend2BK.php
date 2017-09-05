<?php
session_start();
include("../config.php");
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$owner_email = mysql_real_escape_string($_REQUEST['owner_email']);
$viewer_email = mysql_real_escape_string($_REQUEST['viewer_email']);
$owner_path = mysql_real_escape_string($_REQUEST['owner_path']);
$name = mysql_real_escape_string($_REQUEST['name']);
$friendnow = (int)mysql_real_escape_string($_REQUEST['friendnow']);
$action = (int)mysql_real_escape_string($_REQUEST['action']);

if($action==0){
	$QueryResult=mysql_query("SELECT * FROM `view_permission` where user_id=$user_id and owner_email='$owner_email' and viewer_email='$viewer_email'");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	if(mysql_num_rows($QueryResult) == 0) {
		$PictureResult1 = mysql_query("SELECT * FROM user WHERE email_address = '$viewer_email' limit 1"); /* get his/her friend infor */
		while($row1 = mysql_fetch_array($PictureResult1)) {
			$first_name=$row1['first_name'];
			$last_name=$row1['last_name'];
		}	
		if($viewer_email !=$owner_email) mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,viewer_email,first_name,last_name,is_active) VALUES($user_id,'$owner_email','$owner_path','$viewer_email','$first_name','$last_name',$friendnow)");
	}
	else {
		mysql_query("update view_permission set is_active = $friendnow where user_id=$user_id and owner_email='$owner_email' and viewer_email='$viewer_email' limit 1");
	}
}
else {
	$FriendResult = mysql_query("SELECT * FROM view_permission WHERE viewer_email = '$owner_email' or owner_email = '$owner_email'");
	while($option = mysql_fetch_array($FriendResult)) {
		$user_email = $option['owner_email']; /* person that set you as his/her friend */
		$Friends = mysql_query("SELECT * FROM view_permission WHERE (owner_email = '$user_email' and viewer_email != '$owner_email') or owner_email='$owner_email' group by viewer_email"); /* list all of his/her friend */
		while($row = mysql_fetch_array($Friends)) {
			$cur_email = $row['viewer_email'];
			$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$cur_email'"); /* get his/her friend infor */
			while($Picture = mysql_fetch_array($PictureResult)) {
				$first_name=$Picture['first_name'];
				$last_name=$Picture['last_name'];
				$QueryResult1=mysql_query("SELECT * FROM `view_permission` where user_id=$user_id and owner_email='$owner_email' and viewer_email='$cur_email' and is_active!=0 limit 1");          // check if it is set 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				if(mysql_num_rows($QueryResult1) == 0) { // list if not found
					if($friendnow==-1)	mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,viewer_email,first_name,last_name,is_active) VALUES($user_id,'$owner_email','$owner_path','$cur_email','$first_name','$last_name',$friendnow)");
					$profile_picture = $Picture['profile_picture'];
					$name = $Picture['first_name']." ".$Picture['last_name'];
					$ckselect=$friendnow;
				}
				else {
					while($Picture1 = mysql_fetch_array($QueryResult1)) { // list if is_active < 0
						if($Picture1['is_active'] < 0) {
							mysql_query("update view_permission set is_active = $friendnow where user_id=$user_id and owner_email='$owner_email' and viewer_email='$cur_email'");
							$profile_picture = $Picture['profile_picture'];
							$name = $Picture['first_name']." ".$Picture['last_name'];
							$ckselect=$friendnow;
						}
					}
				}
			}	
		}
	}
}	
$ckselect=-2;
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE viewer_email = '$owner_email' or owner_email = '$owner_email'");
while($option = mysql_fetch_array($FriendResult)) {
	$user_email = $option['owner_email']; /* person that set you as his/her friend */
	$Friends = mysql_query("SELECT * FROM view_permission WHERE (owner_email = '$user_email' and viewer_email != '$owner_email') or owner_email = '$owner_email' group by viewer_email"); /* list all of his/her friend */
	while($row = mysql_fetch_array($Friends)) {
		$cur_email = $row['viewer_email'];
		$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$cur_email' and email_address != '$owner_email'"); /* get his/her friend infor */
		while($Picture = mysql_fetch_array($PictureResult)) {
			$QueryResult1=mysql_query("SELECT * FROM `view_permission` where user_id=$user_id and owner_email='$owner_email' and viewer_email='$cur_email' and is_active!=0 limit 1");          // check if it is set 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			if(mysql_num_rows($QueryResult1) == 0) { // list if not found
				$profile_picture = $Picture['profile_picture'];
				$name = $Picture['first_name']." ".$Picture['last_name'];
				$ckselect=-2;
			}
			else {
				while($Picture1 = mysql_fetch_array($QueryResult1)) { // list if is_active < 0
					if($Picture1['is_active'] < 0) {
						$profile_picture = $Picture['profile_picture'];
						$name = $Picture['first_name']." ".$Picture['last_name'];
						$ckselect=$Picture1['is_active'];
					}
				}
			}
		}	
	
		if(!isset($optionEmail) && isset($profile_picture)) {
			$optionEmail[] = $cur_email;
			$optionPicture[] = $profile_picture;
			$optionName[] = $name;
			$optionSel[] = $ckselect;
		}
		elseif(isset($optionEmail)) {
			$duplicated = false;
			foreach($optionEmail as $id=>$email) {
				if($email==$cur_email) $duplicated = true;
			}
			if($duplicated == false){
				$optionEmail[] = $cur_email;
				$optionPicture[] = $profile_picture;
				$optionName[] = $name;
				$optionSel[] = $ckselect;
			}
		}
	}
}
if(isset($optionEmail)) {
	foreach ($optionEmail as $id => $friendemail) {
	echo "
	<tr>
		<td  style='width:15px;'>";
		if($optionSel[$id]==-1)
			echo "<input type='checkbox' value='$optionName[$id]' id='$friendemail' checked='checked' onChange='Action(this.value,this.id,0);' />";
		else
			echo "<input type='checkbox' value='$optionName[$id]' id='$friendemail' onChange='Action(this.value,this.id,0);' />";
	echo "
		</td>
		<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>
		<img src=\"$optionPicture[$id]\" width='50px' /> 
		</td>";
	echo "	
		<td  style='font-size:15px;border-style: solid;border-width: 1px;text-align:center;'>
		$optionName[$id]
		</td></tr>";
	}
}
?>

	