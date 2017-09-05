<?php
session_start();
include("../config.php");
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../inc/GlobalVar.inc.php");
include("../inc/CurrentDateTime.inc.php");
$count=0;
$ckselect=-2;
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE viewer_email = '$GV_email_address' or owner_email = '$GV_email_address'");
while($option = mysql_fetch_array($FriendResult)) {
	$user_email = $option['owner_email']; /* person that set you as his/her friend */
	if($user_email!=$GV_email_address) {
		$FriendResult1 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and viewer_email = '$user_email'");
		if(mysql_num_rows($FriendResult1) == 0) {
			$PictureResult1 = mysql_query("SELECT * FROM user WHERE email_address = '$user_email' limit 1"); /* get his/her friend infor */
			while($row1 = mysql_fetch_array($PictureResult1)) {
				$first_name=$row1['first_name'];
				$last_name=$row1['last_name'];
			}
			mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,is_active,viewer_email,first_name,last_name) VALUES($GV_id,'$GV_email_address', '$GV_owner_path',-2,'$user_email','$first_name','$last_name')");
		}
	}
	$Friends = mysql_query("SELECT * FROM view_permission WHERE (owner_email = '$user_email' and viewer_email != '$GV_email_address') or owner_email = '$GV_email_address' group by viewer_email"); /* list all of his/her friend */
	while($row = mysql_fetch_array($Friends)) {
		$cur_email = $row['viewer_email'];
		$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$cur_email'"); /* get his/her friend infor */
		while($Picture = mysql_fetch_array($PictureResult)) {
			$QueryResult1=mysql_query("SELECT * FROM `view_permission` where user_id=$GV_id and owner_email='$GV_email_address' and viewer_email='$cur_email' and is_active!=0 limit 1");          // check if it is set 
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
			$count++;
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
				$count++;
			}
		}
	}
}
if($count==0) {
	header('Location: AddFriend.php');
	exit();

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Pick Friends</title>
<script src="../scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
function Action(name,viewer_email,action) {
	var user_id = "<?php echo $GV_id; ?>";
	var owner_email = "<?php echo $GV_email_address; ?>";
	var owner_path = "<?php echo $GV_owner_path; ?>";
	var postname=encodeURIComponent(name);
	if(action==1){
		var friendnow = document.getElementById("All").checked?-1:-2;
	}
	else if(action==0 && document.getElementById(viewer_email)) friendnow = document.getElementById(viewer_email).checked?-1:-2;
	var url ="PickFriend2.php?user_id="+user_id+"&owner_email="+owner_email+"&viewer_email="+viewer_email+"&owner_path="+owner_path+"&name="+postname+"&friendnow="+friendnow+"&action="+action;
	$(document).ready(function() {
	   $("#Result").load(url);
	   $.ajaxSetup({ cache: false });
	});
}
</script>
</head>
<body style="font-size:60px;">
<center>
<table width="600" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
    <td align="center" colspan="3" style="font-size:18px;font-weight:bold;border-style: solid;border-width: 1px;text-align:center;">PICK YOUR FRIENDS OR ADD FRIEND IN NEXT STEP</td>
	</tr>
	<tr>
	<td style='font-size:15px;width:100px;text-align:left;'>
	<input type="checkbox" name="All" id="All" value="All"  onChange="Action('1','1',1);">Select All
	</td>
	<td style='text-align:right;'>
	<input type="image" src="../images/home.png" name="Home" value="Home" height="60px" onClick="window.open('index.php',target='_top');">
	</td>
	<td style='text-align:right;' width="150px">
	<input type="image" src="../images/nextStep.png" height="60px" onClick="window.open('AddFriend.php',target='_top');">
	</td>
	</tr>
</table>
<table name="mytable" width="600" style="border-style: solid;border-color:#0000ff;border-width: 3px;" id="Result">
<?php
if(isset($optionEmail)) {
	foreach ($optionEmail as $id => $friendemail) {
	echo "
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
else {

}
?>
</table>
</center>
</body>
</html>
	