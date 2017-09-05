<?php
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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
if(isset($_REQUEST['Sharepagenum'])) $Sharepagenum = (int)$_REQUEST['Sharepagenum']; 
else $Sharepagenum = 1;
$user_id = (int)$_REQUEST['user_id'];
$pv_id = (int)$_REQUEST['pv_id'];
$beforeList1 = mysql_query("SELECT * FROM picture_video WHERE id=$pv_id limit 1");
while($rowB1 = mysql_fetch_array($beforeList1)) {
	$owner_path=$rowB1['owner_path'];
}
$beforeList2 = mysql_query("SELECT * FROM user WHERE owner_path='$owner_path' limit 1");
while($rowB2 = mysql_fetch_array($beforeList2)) {
	$owner_id=$rowB2['id'];
}
$beforeList3 = mysql_query("SELECT * FROM pv_share WHERE pv_id=$pv_id and sharefm_id <> $user_id");
while($rowB3 = mysql_fetch_array($beforeList3)) {
	if(!isset($skip_id)) $skip_id[]=$rowB3['sharefm_id'];
	$found=false;
	foreach ($skip_id as $key=>$id) {
		if($rowB3['sharefm_id']==$id) $found=true;
	}
	if($found==false && $rowB3['sharefm_id']!=$user_id)  $skip_id[]=$rowB3['sharefm_id'];
	$found=false;
	foreach ($skip_id as $key=>$id) {
		if($rowB3['shareto_id']==$id) $found=true;
	}
	if($found==false && $rowB3['shareto_id']!=$user_id)  $skip_id[]=$rowB3['shareto_id'];
}
$Sharerows=0;
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and viewer_id<> $owner_id and is_active>0 group by viewer_id");
	while($option = mysql_fetch_array($FriendResult)) {
	$found=false;
	if(isset($skip_id)) {
		if (in_array($option['viewer_id'], $skip_id)) {
			$found=true;
		}
	}
	if($found==false) {
		$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$option[viewer_email]' limit 1"); /* get his/her friend infor */
		while($row = mysql_fetch_array($PictureResult)) {
			$profile_picture=$row['profile_picture'];
			$first_name=$row['first_name'];
			$last_name=$row['last_name'];
		}
		if(!isset($optionViewer_id) && isset($profile_picture)) {
			$optionViewer_id[] =  $option['viewer_id'];
			$optionPicture[] = $profile_picture;
			$FirstName[] = $first_name;
			$LastName[] = $last_name;
			$optionSel[] = $option['share_flag'];
			$Sharerows++;
			$shareResult = mysql_query("SELECT * FROM pv_share WHERE pv_id=$pv_id and shareto_id=$option[viewer_id] limit 1");
			if(mysql_num_rows($shareResult) != 0) $shareFlag[]="checked='checked'";
			else $shareFlag[]="";
		}
		elseif(isset($optionViewer_id)) {
			$duplicated = false;
			foreach($optionViewer_id as $id=>$Viewer_id) {
				if($Viewer_id==$option['viewer_id']) $duplicated = true;
			}
			if($duplicated == false){
				$optionViewer_id[] = $option['viewer_id'];
				$optionPicture[] = $profile_picture;
				$FirstName[] = $first_name;
				$LastName[] = $last_name;
				$optionSel[] = $option['share_flag'];
				$Sharerows++;
				$shareResult = mysql_query("SELECT * FROM pv_share WHERE pv_id=$pv_id and shareto_id=$option[viewer_id] limit 1");
				if(mysql_num_rows($shareResult) != 0) $shareFlag[]="checked='checked'";
				else $shareFlag[]="";
			}
		}
	}
}
$Sharepage_rows = 12;  
$Sharelast = ceil($Sharerows/$Sharepage_rows); 
if ($Sharepagenum < 1) $Sharepagenum = 1; elseif ($Sharepagenum > $Sharelast) $Sharepagenum = $Sharelast; 
$Sharefirst_row=($Sharepagenum -1) * $Sharepage_rows;

if(isset($optionViewer_id)) {
	$listcount=0;
	foreach ($optionViewer_id as $id => $friendeID) {
	$listcount++;
	if($listcount > $Sharefirst_row && $listcount <= ($Sharefirst_row+$Sharepage_rows)){
		$name=substr($FirstName[$id]." ".$LastName[$id],0,15);
		echo "<tr>
			<td  style='width:15px;'>";
		echo "<input type='checkbox' value='$id' id='$friendeID' $shareFlag[$id] onChange='Share(this.id,0);' />";
		echo "
			</td>
			<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>
			<img src=\"$optionPicture[$id]\" width='40px' class='img' /> 
			</td>";
		echo "	
			<td  style='font-size:10px;border-style: solid;border-width: 1px;text-align:center;'>
			$name
			</td></tr>";
		}
	}
}
?>
