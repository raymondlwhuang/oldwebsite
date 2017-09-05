<?php
session_start();
include("../config.php");
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../inc/GlobalVar.inc.php");
$pagenum = 1; 
$rows=0;
$FriendResult = mysql_query("SELECT * FROM view_permission WHERE user_id=$GV_id and is_active>0 group by viewer_id");
while($option = mysql_fetch_array($FriendResult)) {
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
			$rows++;
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
				$rows++;
			}
		}
}
$page_rows = 12;  
$last = ceil($rows/$page_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $last) $pagenum = $last; 
$first_row=($pagenum -1)* $page_rows;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/MyResource.css" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Set up for Sharing</title>
<script src="../scripts/jquery.js"></script>
</head>
<body>
<center>
<font style="font-size:18px;color:red;">SETTING UP FOR SHARING</font>
<?php include("../PHP/Header.php"); ?>
<?php
echo "<input type='image' src=\"../images/first2.png\" id='first' onClick=\"SharingList('first');\">";
echo " ";
echo "<input type='image' src=\"../images/previous2.png\" id='previous'  onClick=\"SharingList('previous');\">";
echo "<input type='image' src=\"../images/next1.png\" id='next' onClick=\"SharingList('next');\">";
echo " ";
echo "<input type='image' src=\"../images/last.png\" id='last'  onClick=\"SharingList('last');\">";
?>
<table name="mytable" width="985" style="border-style: solid;border-color:#0000ff;border-width: 3px;" id='Result'>
<?php
if(isset($optionViewer_id)) {
	$listcount=0;
	foreach ($optionViewer_id as $id => $friendeID) {
	$listcount++;
	if($listcount > $first_row && $listcount <= ($first_row+$page_rows)){
		echo "<tr>";
		echo "<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>
			<img src=\"$optionPicture[$id]\" width='50px' /> 
			</td>";
		echo "<td  style='font-size:15px;border-style: solid;border-width: 1px;text-align:center;'>
			  $FirstName[$id]	$LastName[$id]
			  </td>";
		echo "<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>";
		echo "<select onChange='Action(this.value,$friendeID);'>";
		if($optionSel[$id]==0) echo "<option value=\"0\" selected=\"selected\">No Sharing</option>";
		else  echo "<option value=\"0\" >No Sharing</option>";
		if($optionSel[$id]==1) echo "<option value=\"1\" selected=\"selected\">Ask to share</option>";
		else echo "<option value=\"1\">Ask to share</option>";
		if($optionSel[$id]==2) echo "<option value=\"2\" selected=\"selected\">Share allowed</option>";
		else echo "<option value=\"2\">Share allowed</option></select></td></tr>";
		}
	}
}
?>
</table>
</center>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >
var user_id = "<?php echo $GV_id; ?>";
var admin = <?php echo $_SESSION["admin"]; ?>;
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
var pagenum = 1;
var last = <?php echo $last; ?>;
var rows = <?php echo $rows; ?>;
var page_rows = <?php echo $page_rows; ?>;
if(rows<=page_rows) {
	document.getElementById('first').style.display = "none";
	document.getElementById('previous').style.display = "none";
	document.getElementById('next').style.display = "none";
	document.getElementById('last').style.display = "none";
}
function SharingList(require)  
{  
	if(require=='first') pagenum=1;
	else if(require=='previous') {
	  pagenum = pagenum - 1;
	} 
	else if(require=='next') {
	  pagenum = pagenum + 1;
	} 
	else if(require=='last') pagenum=last;
	if(pagenum > 1 && pagenum < last) {
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	}
	else if(pagenum<=1) {
		pagenum = 1;
		document.getElementById('first').src = "../images/first2.png";
		document.getElementById('previous').src = "../images/previous2.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	}
	 else if(pagenum>=last) {
		pagenum = last;
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next2.png";
		document.getElementById('last').src = "../images/last2.png";
	 }

	var url = 'SetSharing3.php?user_id='+user_id+'&pagenum='+pagenum;
	$(document).ready(function() {
	   $("#Result").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}

function Action(share_flag,viewer_id) {
    $.ajax({ 
       type: "POST", 
       url: "SetSharing2.php",
       data: "share_flag="+share_flag+"&user_id="+user_id+"&viewer_id="+viewer_id, 
       success: function(msg){
		 if(msg!="")  alert( msg ); //Anything you want 
       }, 
		error:function (xhr, ajaxOptions, thrownError){ 
                    alert(xhr.status); 
                    alert(thrownError); 
        }     	   
     }); 
}
document.getElementById('sharing').style.display = "none";

</script>

</body>
</html>
	