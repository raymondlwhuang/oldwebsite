<?php
@session_start();
include("../config.php");
if(@$_SESSION['private'] != "yes")
{
	header('Location: index.php');
	exit();
}
include("../inc/GlobalVar.inc.php");

$FriendResult = mysql_query("SELECT * FROM view_permission WHERE viewer_id = $GV_id");
while($option = mysql_fetch_array($FriendResult)) {
	$FriendResult1 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and viewer_email='$option[owner_email]' limit 1");
	if(mysql_num_rows($FriendResult1) == 0) {
		$PictureResult1 = mysql_query("SELECT * FROM user WHERE email_address = '$option[owner_email]' limit 1"); /* get his/her friend infor */
		while($row1 = mysql_fetch_array($PictureResult1)) {
			$first_name=$row1['first_name'];
			$last_name=$row1['last_name'];
			$viewer_id=$row1['id'];
		}
		mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,is_active,viewer_id,viewer_email,first_name,last_name) VALUES($GV_id,'$GV_email_address', '$GV_owner_path',-2,$viewer_id,'$option[owner_email]','$first_name','$last_name')");
	}
	$FriendResult2 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$option[owner_email]'");
	while($option2 = mysql_fetch_array($FriendResult2)) {
		$FriendResult3 = mysql_query("SELECT * FROM view_permission WHERE owner_email = '$GV_email_address' and viewer_email='$option2[viewer_email]' limit 1");
		if(mysql_num_rows($FriendResult3) == 0 && $option2['viewer_email']!=$GV_email_address) {
			$PictureResult2 = mysql_query("SELECT * FROM user WHERE email_address = '$option2[viewer_email]' limit 1"); /* get his/her friend infor */
			while($row2 = mysql_fetch_array($PictureResult2)) {
				$first_name=$row2['first_name'];
				$last_name=$row2['last_name'];
				$viewer_id=$row2['id'];
			}		
			mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,is_active,viewer_id,viewer_email,first_name,last_name) VALUES($GV_id,'$GV_email_address', '$GV_owner_path',-2,$viewer_id,'$option2[viewer_email]','$first_name','$last_name')");
		}
	}
	
}
$count=0;
$FriendResult4 = mysql_query("SELECT * FROM view_permission WHERE  owner_email = '$GV_email_address' and is_active<0");
while($option4 = mysql_fetch_array($FriendResult4)) {
	$PictureResult4 = mysql_query("SELECT * FROM user WHERE email_address = '$option4[viewer_email]' limit 1"); /* get his/her friend infor */
	while($row4 = mysql_fetch_array($PictureResult4)) {
		$profile_picture=$row4['profile_picture'];
		$first_name=$row4['first_name'];
		$last_name=$row4['last_name'];
	}
		if(!isset($optionViewer_id) && isset($profile_picture)) {
			$optionViewer_id[] =  $option4['viewer_id'];
			$optionPicture[] = $profile_picture;
			$FirstName[] = $first_name;
			$LastName[] = $last_name;
			$optionSel[] = $option4['is_active'];
			$count++;
		}
		elseif(isset($optionViewer_id)) {
			$duplicated = false;
			foreach($optionViewer_id as $id=>$Viewer_id) {
				if($Viewer_id==$option4['viewer_id']) $duplicated = true;
			}
			if($duplicated == false){
				$optionViewer_id[] = $option4['viewer_id'];
				$optionPicture[] = $profile_picture;
				$FirstName[] = $first_name;
				$LastName[] = $last_name;
				$optionSel[] = $option4['is_active'];
				$count++;
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
<script src="../scripts/jquery.js"></script>
<script type="text/javascript">
function Action(name,viewer_id,action) {
	var user_id = "<?php echo $GV_id; ?>";
	var postname=encodeURIComponent(name);
	if(action==1){
		var friendnow = document.getElementById("All").checked?-1:-2;
	}
	else if(action==0 && document.getElementById(viewer_id)) friendnow = document.getElementById(viewer_id).checked?-1:-2;
	var url ="PickFriend2.php?user_id="+user_id+"&viewer_id="+viewer_id+"&name="+postname+"&friendnow="+friendnow+"&action="+action;
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
if(isset($optionViewer_id)) {
	foreach ($optionViewer_id as $id => $friendeID) {
	echo "<tr>
		<td  style='width:15px;'>";
		if($optionSel[$id]==-1)
			echo "<input type='checkbox' value='$id' id='$friendeID' checked='checked' onChange='Action(this.value,this.id,0);' />";
		else
			echo "<input type='checkbox' value='$id' id='$friendeID' onChange='Action(this.value,this.id,0);' />";
	echo "
		</td>
		<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>
		<img src=\"$optionPicture[$id]\" width='50px' /> 
		</td>";
	echo "	
		<td  style='font-size:15px;border-style: solid;border-width: 1px;text-align:center;'>
		$FirstName[$id]	$LastName[$id]
		</td></tr>";
	}
}
?>
</table>
</center>
</body>
</html>
	