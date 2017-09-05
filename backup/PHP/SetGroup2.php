<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
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
$viewer_group = mysql_real_escape_string($_REQUEST['viewer_group']);
$view_permission_id = (int)mysql_real_escape_string($_REQUEST['view_permission_id']);
if($view_permission_id!='All') {
	$GetInfo = mysql_query("SELECT * FROM view_permission WHERE  id = $view_permission_id");
	while($Row = mysql_fetch_array($GetInfo)) {
		$user_id=$Row['user_id'];
		$viewer_id=$Row['viewer_id'];
		$owner_email=$Row['owner_email'];
		$owner_path=$Row['owner_path'];
		$viewer_email=$Row['viewer_email'];
		$is_active=$Row['is_active'];
		$first_name=$Row['first_name'];
		$last_name=$Row['last_name'];
	}
	$BeforeInsert = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and viewer_group='$viewer_group' and viewer_email='$viewer_email' limit 1");
	if(mysql_num_rows($BeforeInsert) == 0) {
		mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,viewer_group,is_active,viewer_email,first_name,last_name,viewer_id) VALUES($user_id,'$owner_email','$owner_path','$viewer_group',$is_active,'$viewer_email','$first_name','$last_name',$viewer_id)");
	}
}
else {
	$user_id=(int)mysql_real_escape_string($_REQUEST['user_id']);
	$ViewerList1 = mysql_query("SELECT * FROM view_permission WHERE  user_id=$user_id and is_active>=0 group by viewer_email");
	while($nt1=mysql_fetch_array($ViewerList1)){
		$viewer_id=$nt1['viewer_id'];
		$BeforeInsert1 = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and viewer_group='$viewer_group' and viewer_email='$nt1[viewer_email]' limit 1");
		if(mysql_num_rows($BeforeInsert1) == 0) {
			mysql_query("INSERT INTO view_permission(user_id,owner_email,owner_path,viewer_group,is_active,viewer_email,first_name,last_name,viewer_id) VALUES($user_id,'$nt1[owner_email]','$nt1[owner_path]','$viewer_group',$nt1[is_active],'$nt1[viewer_email]','$nt1[first_name]','$nt1[last_name]',$viewer_id)");
		}	
	}
}
$ViewerList = mysql_query("SELECT * FROM view_permission WHERE  user_id=$user_id and is_active>=0 group by viewer_email");

?>
<div style="display:inline-block;vertical-align:top;">
<table border="0" width="400" id="mytable">
	<tr>
		<td style="border: 1px solid #38c;font-size:20px;" colspan="2">
		<input type="checkbox" name="All" id="All" value="All" onChange="Select_all();">Select All
		</td>
		<td align="center" style="border: 1px solid #38c;font-size:20px;">Pick a friend
		</td>
	</tr>
	<tr>
		<th width="40" style="border: 1px solid #38c;">
		</th>
		<th align='left' width="50" style="border: 1px solid #38c;">
		
		</th>	
		<th align='left' style="border: 1px solid #38c;">
		</th>	
	</tr>	
<?php	

while($nt=mysql_fetch_array($ViewerList)){
	$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$nt[viewer_email]' limit 1"); /* get his/her friend infor */
	while($row = mysql_fetch_array($PictureResult)) {
		$profile_picture=$row['profile_picture'];
		$user_id1=$row['id'];
	}
echo "
<tr>
    <td align='center' style=\"border: 1px solid #38c;\">
	<input type=\"image\" src=\"../images/click-here.gif\" width='50px' alt=\"Add to group\" name=\"$user_id1\" value=\"$nt[id]\" id='$user_id1' onClick=\"Action(this.value);\">
	<font size='2' color='DarkBlue'><b>To Add</b></font></td>
    <td align='left' style=\"border: 1px solid #38c;\">
	<img src=\"$profile_picture\" width='50px' /> 
	</td>
    <td align='left' style=\"border: 1px solid #38c;\">
	$nt[first_name]	$nt[last_name]
	</td></tr>";
}
?>
</table>
</div>
<div  style="display:inline-block;">
<form name="FriendDel" method="Post">
<input type="hidden" name="owner_email"  value="<?php if (isset($GV_email_address)){ echo htmlspecialchars($GV_email_address); } else ''; ?>">
<input type="hidden" name="delete_id" id="delete_id" value="">
<table border="0" width="450">
	<tr>
		<th colspan="4" align="center" style="border: 1px solid #38c;">Group List
		</th>
	</tr>
	<tr>
		<th style="border: 1px solid #38c;text-align:right;color:green;" colspan="3">Asign to group
		</th>	
		<th style="border: 1px solid #38c;text-align:center;">Name
		</th>	
	</tr>	
<?php
$ViewerList2 = mysql_query("SELECT * FROM view_permission WHERE  user_id=$user_id and is_active>0 and viewer_group!='' order by viewer_group");
if(mysql_num_rows($ViewerList2) == 0) {
	echo "
	<tr>
		<td style='font-size:25px;border-style: solid;border-width: 1px;text-align:center;' colspan='4'>
		Currently your friend list in the left only allow to view pictures/videos that you upload to the All Group area. <br/>Please create your viewer group now.
		</td>
	</tr>";
}
else {
	$viewer_group='';
	$color="brown";
	while($nt2=mysql_fetch_array($ViewerList2)){
		if($viewer_group!=$nt2['viewer_group']) {
			$viewer_group=$nt2['viewer_group'];
			if($color=="green") $color="brown";
			else  $color="green";
		}
		$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$nt2[viewer_email]' limit 1"); /* get his/her friend infor */
		while($row = mysql_fetch_array($PictureResult)) {
			$profile_picture=$row['profile_picture'];
		}
	echo "
	<tr>
		<td width=\"40\" style=\"border: 1px solid #38c;\">
		<input type='image' src='../images/delete.png' name='Delete' value='$nt2[id]' onClick=\"document.getElementById('delete_id').value=this.value\">
		</td>
		<td width=\"50\" style=\"border: 1px solid #38c;\">
		<img src=\"$profile_picture\" width='50px' /> 
		</td>
		<td align='left' style=\"border: 1px solid #38c;color:$color;\">
		$nt2[viewer_group] 
		</td>
		<td align='left' style=\"border: 1px solid #38c;\">
		$nt2[first_name]	$nt2[last_name]
		</td></tr>";
	}
}
?>
</table>
</form>
</div>
</div>	