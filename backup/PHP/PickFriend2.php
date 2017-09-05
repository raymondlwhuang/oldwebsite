<?php
session_start();
include("../config.php");
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$queryOwner = mysql_query("SELECT * FROM user WHERE id = $user_id limit 1"); /* get his/her friend infor */
while($rowOwner = mysql_fetch_array($queryOwner)) {
	$owner_email = $rowOwner['email_address'];
	$owner_path = $rowOwner['owner_path'];
}
//$owner_email = mysql_real_escape_string($_REQUEST['owner_email']);
//$owner_path = mysql_real_escape_string($_REQUEST['owner_path']);
$viewer_id = (int)mysql_real_escape_string($_REQUEST['viewer_id']);
$queryOwner = mysql_query("SELECT * FROM user WHERE id = $viewer_id limit 1"); /* get his/her friend infor */
while($rowOwner = mysql_fetch_array($queryOwner)) {
	$viewer_email = $rowOwner['email_address'];
}
//$viewer_email = mysql_real_escape_string($_REQUEST['viewer_email']);
$name = mysql_real_escape_string($_REQUEST['name']);
$friendnow = (int)mysql_real_escape_string($_REQUEST['friendnow']);
$action = (int)mysql_real_escape_string($_REQUEST['action']);

if($action==0){
	mysql_query("update view_permission set is_active = $friendnow where user_id=$user_id and owner_email='$owner_email' and viewer_email='$viewer_email' limit 1");
}
else {
	mysql_query("update view_permission set is_active = $friendnow where user_id=$user_id and is_active<0");
}
$FriendResult4 = mysql_query("SELECT * FROM view_permission WHERE  owner_email = '$owner_email' and is_active<0");
while($option4 = mysql_fetch_array($FriendResult4)) {
	$PictureResult4 = mysql_query("SELECT * FROM user WHERE email_address = '$option4[viewer_email]' limit 1"); /* get his/her friend infor */
	while($row4 = mysql_fetch_array($PictureResult4)) {
		$profile_picture=$row4['profile_picture'];
		$first_name=$row4['first_name'];
		$last_name=$row4['last_name'];
	}
	if(!isset($optionEmail) && isset($profile_picture)) {
		$optionEmail[] =  $option4['viewer_email'];
		$optionPicture[] = $profile_picture;
		$FirstName[] = $first_name;
		$LastName[] = $last_name;
		$optionSel[] = $option4['is_active'];
	}
	elseif(isset($optionEmail)) {
		$duplicated = false;
		foreach($optionEmail as $id=>$email) {
			if($email==$option4['viewer_email']) $duplicated = true;
		}
		if($duplicated == false){
			$optionEmail[] = $option4['viewer_email'];
			$optionPicture[] = $profile_picture;
			$FirstName[] = $first_name;
			$LastName[] = $last_name;
			$optionSel[] = $option4['is_active'];
		}
	}
}

if(isset($optionEmail)) {
	foreach ($optionEmail as $id => $friendemail) {
	echo "<tr>
		<td  style='width:15px;'>";
		if($optionSel[$id]==-1)
			echo "<input type='checkbox' value='$id' id='$friendemail' checked='checked' onChange='Action(this.value,this.id,0);' />";
		else
			echo "<input type='checkbox' value='$id' id='$friendemail' onChange='Action(this.value,this.id,0);' />";
	echo "
		</td>
		<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>
		<img src=\"$optionPicture[$id]\" width='50px' /> 
		</td>";
	echo "	
		<td  style='font-size:15px;border-style: solid;border-width: 1px;text-align:center;'>
		$FirstName[$id]	$LastName[$id]
		</td>";
	}
}
?>

	