<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
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
include("../config.php");
include("../inc/GlobalVar.inc.php");
if(isset($_POST['Delete_x']))
{
	$delete_id = (int)mysql_real_escape_string($_REQUEST['delete_id']);
	mysql_query("DELETE from `view_permission` where id = $delete_id limit 1");
	mysql_close();
	echo "
        <script type=\"text/javascript\">
			window.open('SetGroup.php',target='_top');
        </script>";
	exit();		

}
$GroupResult=mysql_query("SELECT * FROM `viewer_group` where (user_id = $GV_id or user_id = 0)");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
if (mysql_num_rows($GroupResult) == 0){
	mysql_query("INSERT INTO viewer_group(user_id,viewer_group,owner_path) VALUES($GV_id,'Friend','$GV_owner_path')");
	$GroupResult=mysql_query("SELECT * FROM `viewer_group` where (user_id = $GV_id or user_id = 0)");          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
}

while($option = mysql_fetch_array($GroupResult)) {
	$optionGroup["$option[id]"] = $option['viewer_group'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>VIEWER GROUP SET UP</title>
<style type="text/css"> 
 #AddDialog {
	position:relative;
	top:-50px;
	width:550px;
	height:250px;
	background-color: #FFFFFF;
	border-style:solid outset;
	border-width:3px;
	z-index:999;
	display:none;
}
a {
text-decoration: none;
}
</style> 
</head>
<body style="font-size:30px;">
<center>
<table width="600" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
    <td align="center" colspan="2" style="font-size:18px;font-weight:bold;border-style: solid;border-width: 1px;text-align:center;">VIEWER GROUP SET UP</td>
	</tr>
	<tr>
	<td style='text-align:right;'>
	<input type="image" src="../images/home.png" name="Home" value="Home" height="60px" onClick="window.open('index.php',target='_top');">
	</td>
	<td style='text-align:right;' width="150px">
	<input type="image" src="../images/nextStep.png" height="60px" onClick="window.open('InviteFriend.php',target='_top');">
	</td>
	</tr>
</table>
<table width="600" style="border-style: solid;border-color:#0000ff;border-width: 3px;text-align:center;">
<tr>
	<td width="250" align="right"><input type="image" src="../images/AddToGroup.png" name="AddGroup" value="Add Group" width="50px" onclick="SetVisibleDiv('none');SetDialog('Add a new group then click submit',5);">
	<a href="" onclick="SetVisibleDiv('none');SetDialog('Add a new group then click submit',5);return false">Group</a></td>
	<td align="left">
	<select name="viewer_group" id="viewer_group" style="font-size:25px;width:250px;border-color:#5050FF;border-width: 3px;">
	<?php
		if(isset($optionGroup)){
			foreach($optionGroup as $id=>$viewer_group) {
				echo "<option value='$id'>$viewer_group</option>";
			}
		}
	?>
	</select>	
	</td>
</tr>
<tr>
	<td><font color="DarkBlue" size="3">Click to add new group</font><img src="../images/UpArrowR.jpg" width='30px' /></td>
	<td align="right"><img src="../images/UpArrowL.jpg" width='30px' /><font color="DarkBlue" size="3">Select Group</font></td>
</tr>
</table>
<div id="AddDialog">
	<table width="100%">
	<tr>
	<td align="center" id="dialog_text" style="font-size:25px;">Add a new group then click submit</td>
	<td align="right" valign="top"><input type="image" name="close" src="../images/close_icon.png" width="39" onclick="SetVisibleDiv('block'); AddInfor(0);"></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="text" name="input_text" id="input_text" value="" size="15" maxlength="30" style="font-size:60px;text-align:left;border-style: solid;border-color:#5050FF;border-width: 3px;"></td>
	</tr>	
	<tr>
	<td colspan="2" align="center">&nbsp;</td>
	</tr>
	<tr>
	<td align="center" id="insert"><input type="image" name="insert" src="../images/submit.jpg" width="160" onclick="SetVisibleDiv('block'); AddInfor(1);"></td>
	</tr>
	</table>
</div>
<div id="main">
<div style="display:inline-block;vertical-align:top;">
<table border="0" width="400" id="mytable">
	<tr>
		<td style="border: 1px solid #38c;font-size:18px;" colspan="2">
		<input type="checkbox" name="All" id="All" value="All" onChange="Select_all();">Select All
		</td>
		<td align="center" style="border: 1px solid #38c;font-size:20px;">Pick a friend below
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
$ViewerList = mysql_query("SELECT * FROM view_permission WHERE  user_id=$GV_id and is_active>=0 group by viewer_email");

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
    <td valign='left' style=\"border: 1px solid #38c;\">
	<img src=\"$profile_picture\" width='50px' /> 
	</td>
    <td align='left' style=\"border: 1px solid #38c;\">
	$nt[first_name]	$nt[last_name]
	</td></tr>";
}
?>
</table>
</div>
<div  style="display:inline-block;vertical-align:top;">
<img src="../images/right_arrow.png" width="50" />
</div>
<div  style="display:inline-block;">
<form name="FriendDel" method="Post">
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
$ViewerList2 = mysql_query("SELECT * FROM view_permission WHERE  user_id=$GV_id and is_active>0 and viewer_group!=''");
if(mysql_num_rows($ViewerList2) == 0) {
	echo "
	<tr>
		<td style='font-size:25px;border-style: solid;border-width: 1px;text-align:left;color:red;' colspan='4'>
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
</center>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript">
function SetVisibleDiv(disp) {
document.getElementById("main").style.display = disp;
}
function SetDialog(text,infor_id) {
	document.getElementById('AddDialog').style.display='block';
	document.getElementById('dialog_text').innerHTML = text;
	document.getElementById('input_text').style.display='block';
}
function AddInfor(action_id) {
	document.getElementById('AddDialog').style.display='none';
	var text1 = document.getElementById('input_text').value;
	var id = '#viewer_group';
	
	if(action_id != 0) {
		text = encodeURIComponent(text1);
		text1 = text1.trim();
		if(text1.indexOf(" ") > 0 )
		{  
		   document.getElementById('AddDialog').style.display='block';
		   alert("Viewer Group must be single word");
		}
		else {
			url = '../search/AddGroup.php?user_id=<?php echo $GV_id; ?>&viewer_group='+text;
			$(document).ready(function() {
			   $(id).load(url);
			   $.ajaxSetup({ cache: false });
			});
		}
	}
}
function Action(view_permission_id) {
	var select_list_field = document.getElementById('viewer_group');
	var select_list_selected_index = select_list_field.selectedIndex;

	var viewer_group = select_list_field.options[select_list_selected_index].text;
	var url ="SetGroup2.php?view_permission_id="+view_permission_id+"&viewer_group="+viewer_group;
	$(document).ready(function() {
	   $("#main").load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function Select_all() {
	var select_list_field = document.getElementById('viewer_group');
	var select_list_selected_index = select_list_field.selectedIndex;
	var viewer_group = select_list_field.options[select_list_selected_index].text;
	var user_id = "<?php echo $GV_id; ?>";
	var url ="SetGroup2.php?view_permission_id=All&viewer_group="+viewer_group+"&user_id="+user_id;
	$(document).ready(function() {
	   $("#main").load(url);
	   $.ajaxSetup({ cache: false });
	});
}
	document.getElementById("viewer_group").focus();
</script>
</body>
</html>
	