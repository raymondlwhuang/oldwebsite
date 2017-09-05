<?php
session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
if(isset($_REQUEST['viewer_group'])) $viewer_group = $_REQUEST['viewer_group'];
if(isset($_REQUEST['upload_id'])) $upload_id = (int)$_REQUEST['upload_id'];
if(isset($_REQUEST['owner_id'])) $user_id = $_REQUEST['owner_id']; else $user_id=$GV_id;
if(isset($_REQUEST['viewingOn'])) {
	if($_REQUEST['viewingOn']!="Public") {
		$queryOwner=mysql_query("SELECT * FROM user where  id = $_REQUEST[viewingOn] LIMIT 1");
		echo mysql_error();
		while($row3 = mysql_fetch_array($queryOwner))
		{
		 $first_name=ucfirst(strtolower($row3['first_name']));
		 $last_name = ucfirst(strtolower($row3['last_name']));
		 $_SESSION["viewingOn"]=$first_name." ".$last_name;
		 $_SESSION["viewingOnprofile"]=$row3['profile_picture'];
		}
	}
	else {
		 $_SESSION["viewingOn"]="Public";
		 $_SESSION["viewingOnprofile"]="../images/profile/public.jpg";
	}
}
if(isset($_REQUEST['comment']))
{
	$upload_id = (int)mysql_real_escape_string($_REQUEST['upload_id']);
	$PV_id = (int)mysql_real_escape_string($_REQUEST['pv_id']);
	$comment =  mysql_real_escape_string($_REQUEST['comment']);
	if(isset($_REQUEST['owner_id']) && $_REQUEST['owner_id'] != "" && $_REQUEST['owner_id'] != "Public") $owner_id1 = $_REQUEST['owner_id'];
	else $owner_id1 = $GV_id;
	mysql_query("INSERT INTO pv_comment(upload_id,viewer_user_id,user_id,name,comment,PV_id) VALUES($upload_id,$GV_id,$owner_id1,'$GV_name','$comment',$PV_id)"); /* I am a viewer, the name is my name for display purpose*/
	echo mysql_error(); 
}

if($viewer_group!="Public") {
	$getowner=mysql_query("SELECT * FROM user where id = $user_id limit 1");  // query string stored in a variable
	while($owneresult = mysql_fetch_array($getowner)) {
		$result_path=$owneresult['owner_path'];
		$result_name=ucfirst(strtolower($owneresult['first_name']))." ".ucfirst(strtolower($owneresult['last_name']));
	//	$result_profile_picture=$owneresult['profile_picture'];
	}
	$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and viewer_group = '$viewer_group' and upload_id=$upload_id");  // query string stored in a variable
	while($row3 = mysql_fetch_array($beforeShow)) {
		$pictures[]=$row3['name'];
		$OrgPicture[] = str_replace("/pictures/", "/Orgpictures/", $row3['name']);
		$pv_id[]=$row3['id'];
	}	
}
else {
	$beforeShow=mysql_query("SELECT * FROM picture_video where viewer_group = 'Public' and upload_id=$upload_id");  // query string stored in a variable
	while($row3 = mysql_fetch_array($beforeShow)) {
		$pictures[]=$row3['name'];
		$OrgPicture[] = str_replace("/pictures/", "/Orgpictures/", $row3['name']);
		$pv_id[]=$row3['id'];
	}	

}
	$name="";
	$queryComment=mysql_query("SELECT * FROM pv_comment where upload_id=$upload_id order by id desc");  // query string stored in a variable
	echo mysql_error(); 
	$Comcount=0;
	while($row4 = mysql_fetch_array($queryComment))
	{	
		if($row4['PV_id']==0 || $row4['PV_id']==$pv_id[0]) {
			$Comcount++;
			$queryUser=mysql_query("SELECT * FROM user where id=$row4[viewer_user_id] limit 1");
			while($row6 = mysql_fetch_array($queryUser))
			{		
				$name=$row6['first_name']." ".$row6['last_name'];
				$result_profile_picture[]=$row6['profile_picture'];
			}				
			$queryPV=mysql_query("SELECT * FROM picture_video where upload_id=$row4[upload_id] limit 1");
			$date1= strtotime($row4['comment_date']);
			$comment_date= substr(date('r',$date1),0,-6);
			while($row5 = mysql_fetch_array($queryPV))
			{
				$pic_group[]=$row5['viewer_group'];
			}
			if($row4['PV_id']==0) $color='darkblue';
			else $color='black';
			$comments[] = "<div style=\"display:inline-block;vertical-align:top;text-align:left;color:$color;\">".$row4['comment']."<font size='3'>($comment_date)</font></div>";
			$pic_upload_id[]=$row4['upload_id'];
			$owner_id[]=$row4['user_id'];
		}
	}
$pagenum = 1; 
$page_rows = 6;  
$last = ceil($Comcount/$page_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $last) $pagenum = $last; 
$first_row=($pagenum -1)* $page_rows;
$previous = $pagenum-1;
if($previous <= 0) $previous=1;
$next = $pagenum+1;
if($next > $Comcount) $next=$Comcount;
$Sharerows=0;
$shareallowed = "no";
if($user_id==$GV_id) $shareallowed = "yes";
elseif($user_id!="Public") {
	$PermitResult = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and viewer_id=$GV_id and is_active>0 and share_flag>0  group by viewer_id");
	echo mysql_error(); 
	if(mysql_num_rows($PermitResult) != 0) {
		$shareallowed = "yes";
	}
}

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
			$Sharerows++;
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
			}
		}
}
$Sharepagenum=1;
$Sharepage_rows = 12;  
$Sharelast = ceil($Sharerows/$Sharepage_rows); 
if ($Sharepagenum < 1) $Sharepagenum = 1; elseif ($Sharepagenum > $Sharelast) $Sharepagenum = $Sharelast; 
$Sharefirst_row=($Sharepagenum -1) * $Sharepage_rows;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Profile Picture Upload</title>
<style>
 img {border: 5px grey double;}
 .pointer { cursor: pointer }
</style>

</head>
<body>
<center>
<?php //if(isset($name)) echo strtoupper($name); ?>
<?php include("../PHP/Header.php"); ?>
<div style="width:160px;display:inline-block;vertical-align:top;">
<table name="mytable" style="border-style: solid;border-color:#0000ff;border-width: 3px;" id="Result">
<tr>
	<td colspan="3" style="border-style: solid;border-color:#0000ff;border-width: 3px;text-align:center;" >
		<?php
		echo "<input type='image' src=\"../images/first2.png\" id='Sharefirst' onClick=\"SharingList('first');\">";
		echo " ";
		echo "<input type='image' src=\"../images/previous2.png\" id='Shareprevious'  onClick=\"SharingList('previous');\">";
		echo "<input type='image' src=\"../images/next1.png\" id='Sharenext' onClick=\"SharingList('next');\">";
		echo " ";
		echo "<input type='image' src=\"../images/last.png\" id='Sharelast'  onClick=\"SharingList('last');\">";
		?>	
	</td>
</tr>
<tr>
	<td colspan="3" style="border-style: solid;border-color:#0000ff;border-width: 3px;" >
	<input type="checkbox" name="All" id="All" value="All"  onChange="Share('1','1',1);">Share to All
	</td>
</tr>
<tr>
<td>
<table width="100%" id="ShareList">
<?php
if(isset($optionViewer_id)) {
	$listcount=0;
	foreach ($optionViewer_id as $id => $friendeID) {
	$listcount++;
	if($listcount > $Sharefirst_row && $listcount <= ($Sharefirst_row+$Sharepage_rows)){
		$name=substr($FirstName[$id]." ".$LastName[$id],0,15);
		echo "<tr>
			<td  style='width:15px;'>";
			if($optionSel[$id]==-1)
				echo "<input type='checkbox' value='$id' id='$friendeID' checked='checked' onChange='Share(this.value,this.id,0);' />";
			else
				echo "<input type='checkbox' value='$id' id='$friendeID' onChange='Share(this.value,this.id,0);' />";
		echo "
			</td>
			<td  style='border-style: solid;border-width: 1px;text-align:center;width:50px;'>
			<img src=\"$optionPicture[$id]\" width='40px' /> 
			</td>";
		echo "	
			<td  style='font-size:10px;border-style: solid;border-width: 1px;text-align:center;'>
			$name
			</td></tr>";
		}
	}
}
?>
</table>
</td>
</tr>
</table>
</div>
<div style="width:650px;display:inline-block;text-align:right;">
<img src="<?php echo $OrgPicture[0] ?>" width="640" id="profile">
<form name='MyForm' action="" enctype='application/x-www-form-urlencoded' method='post'>
<?php
		foreach($_REQUEST as $name => $value) {
		  echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
		}
?>
<input type="hidden" name="pv_id" id="pv_id" value="<?php echo $pv_id[0]; ?>">
Comment: <input type='text' name='comment' value=''  style="font-size:18px;width:560px;border-color:#5050FF;border-width: 3px;" onfocus="stop_show();" onblur="start_show();">
</form>
<?php
	echo "<div id=\"ComMain\" style=\"background-color:#E9FFFF;height:270px;text-align:left;\">";
		echo "<div id=\"ComNav\" style=\"width:17px;display:inline-block;\">";
			echo "<img src=\"../images/first_up2.png\" id='first' onClick=\"CommentList('first',$upload_id);\" style=\"border:none;\">";
			echo "<img src=\"../images/previous_up2.png\" id='previous'  onClick=\"CommentList('previous',$upload_id);\" style=\"border:none;\">";
			echo "<img src=\"../images/next_up.png\" id='next' onClick=\"CommentList('next',$upload_id);\" style=\"border:none;\">";
			echo "<img src=\"../images/last_up.png\" id='last'  onClick=\"CommentList('last',$upload_id);\" style=\"border:none;\">";
		echo "</div>";
		echo '<div id="comments" style="width:580px;display:inline-block;vertical-align:top;font-size:28px;text-align:left;">';
		if(isset($comments)) {
			$listcount=0;
			foreach ($comments as $key => $comment) {
				$listcount++;
				if($listcount > $first_row && $listcount <= ($first_row+$page_rows)){
					echo "<div>";
						echo '<div style="width:70px;display:inline-block;">';
							echo "<img src=\"$result_profile_picture[$key]\" height=\"38\" style=\"border:none;\">";
						echo "</div>";
						echo $comment;
					echo "</div>";
				}
			}
		}
		echo "</div>";
	echo "</div>";

?>	
</div>
<div style="width:180px;display:inline-block;vertical-align:top;text-align:right;">
 <?php
 if (isset($pictures)){
	foreach($pictures as $key=>$picture) {
	   echo "<img src='$picture' width='80' onClick='Action(\"$OrgPicture[$key]\",$pv_id[$key],$upload_id)' class='pointer'/>";
	}
}
?>
</div>

</center>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript">
var shareallowed="<?php echo $shareallowed; ?>";
if(shareallowed=="no") document.getElementById('Result').style.display = "none";
function Action(picture,pv_id,upload_id) {
	document.getElementById("profile").src=picture;
	document.getElementById("pv_id").value=pv_id;
	var url = 'PicCommentList2.php?pv_id='+pv_id+'&upload_id='+upload_id+'&pagenum=1';
	$(document).ready(function() {
	   $("#ComMain").load(url);
	   $.ajaxSetup({ cache: false });
	});	
}
function Share(picture,pv_id,upload_id) {
alert("need to add!");
}

var Sharepagenum = 1;
var Sharelast = <?php echo $Sharelast; ?>;
var Sharerows = <?php echo $Sharerows; ?>;
var Sharepage_rows = <?php echo $Sharepage_rows; ?>;
if(Sharerows<=Sharepage_rows) {
	document.getElementById('Sharefirst').style.display = "none";
	document.getElementById('Shareprevious').style.display = "none";
	document.getElementById('Sharenext').style.display = "none";
	document.getElementById('Sharelast').style.display = "none";
}
function SharingList(require)  
{  
	if(require=='first') Sharepagenum=1;
	else if(require=='previous') {
	  Sharepagenum = Sharepagenum - 1;
	} 
	else if(require=='next') {
	  Sharepagenum = Sharepagenum + 1;
	} 
	else if(require=='last') Sharepagenum=Sharelast;
	if(Sharepagenum > 1 && Sharepagenum < Sharelast) {
		document.getElementById('Sharefirst').src = "../images/first.png";
		document.getElementById('Shareprevious').src = "../images/previous.png";
		document.getElementById('Sharenext').src = "../images/next1.png";
		document.getElementById('Sharelast').src = "../images/last.png";
	}
	else if(Sharepagenum<=1) {
		Sharepagenum = 1;
		document.getElementById('Sharefirst').src = "../images/first2.png";
		document.getElementById('Shareprevious').src = "../images/previous2.png";
		document.getElementById('Sharenext').src = "../images/next1.png";
		document.getElementById('Sharelast').src = "../images/last.png";
	}
	 else if(Sharepagenum>=Sharelast) {
		Sharepagenum = Sharelast;
		document.getElementById('Sharefirst').src = "../images/first.png";
		document.getElementById('Shareprevious').src = "../images/previous.png";
		document.getElementById('Sharenext').src = "../images/next2.png";
		document.getElementById('Sharelast').src = "../images/last2.png";
	 }

	var url = 'ShareList.php?user_id='+user_id+'&Sharepagenum='+Sharepagenum;
	$(document).ready(function() {
	   $("#ShareList").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}

var pagenum = 1;
var last = <?php echo $last; ?>;
var Comcount = <?php echo $Comcount; ?>;
var page_rows = <?php echo $page_rows; ?>;

if(Comcount<=page_rows) {
	if(document.getElementById('ComNav')) document.getElementById('ComNav').style.display = "none";
	if(document.getElementById('first')) document.getElementById('first').style.display = "none";
	if(document.getElementById('previous')) document.getElementById('previous').style.display = "none";
	if(document.getElementById('next')) document.getElementById('next').style.display = "none";
	if(document.getElementById('last')) document.getElementById('last').style.display = "none";
}

function CommentList(require,upload_id)  
{  
	var viewer_id =  <?php echo $GV_id ?>;
	var pv_id = document.getElementById('pv_id').value;
	if(require=='first') pagenum=1;
	else if(require=='previous') {
	  pagenum = pagenum - 1;
	} 
	else if(require=='next') {
	  pagenum = pagenum + 1;
	} 
	else if(require=='last') pagenum=last;

	if(pagenum > 1 && pagenum < last) {
		document.getElementById('first').src = "../images/first_up.png";
		document.getElementById('previous').src = "../images/previous_up.png";
		document.getElementById('next').src = "../images/next_up.png";
		document.getElementById('last').src = "../images/last_up.png";
	}
	else if(pagenum<=1) {
		pagenum = 1;
		document.getElementById('first').src = "../images/first_up2.png";
		document.getElementById('previous').src = "../images/previous_up2.png";
		document.getElementById('next').src = "../images/next_up.png";
		document.getElementById('last').src = "../images/last_up.png";
	}
	 else if(pagenum>=last) {
		pagenum = last;
		document.getElementById('first').src = "../images/first_up.png";
		document.getElementById('previous').src = "../images/previous_up.png";
		document.getElementById('next').src = "../images/next_up2.png";
		document.getElementById('last').src = "../images/last_up2.png";
	 }
	var url = 'PicCommentList.php?pv_id='+pv_id+'&upload_id='+upload_id+'&pagenum='+pagenum;
	$(document).ready(function() {
	   $("#comments").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
</script>

</body>
</html>