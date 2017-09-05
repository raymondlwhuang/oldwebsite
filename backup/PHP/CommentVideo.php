<?php
session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
if(isset($_REQUEST['FriendID'])) $FriendID = $_REQUEST['FriendID'];
if(isset($_REQUEST['VideoComment']))
{
	$upload_id = (int)$_REQUEST['upload_id'];
	$_SESSION["upload_id"]=$upload_id;
	$comment =  mysql_real_escape_string($_REQUEST['VideoComment']);
	$pv_idresult=mysql_query("SELECT * FROM picture_video where picture_video='videos' and upload_id=$upload_id limit 1");  // query string stored in a variable
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($pv_idrow = mysql_fetch_array($pv_idresult))
	{
		$PV_id=$pv_idrow['id'];
		$_SESSION["pv_id"]=$PV_id;
		$pos=strpos($pv_idrow['name'],".",3)+1;
		$_SESSION["curr_video"]=substr($pv_idrow['name'],0,$pos);
		$owner_path=$pv_idrow['owner_path'];
	};	
	$owneridResult = mysql_query("SELECT * FROM user WHERE owner_path = '$owner_path' limit 1"); /* get his/her friend infor */
	while($owneridrow = mysql_fetch_array($owneridResult)) {
		$owner_id1=$owneridrow['id'];
	}
	if($comment!="") {
		$beforeIns=mysql_query("SELECT * FROM pv_comment where PV_id = $PV_id and upload_id=$upload_id and user_id=$owner_id1 and viewer_user_id=$GV_id and comment='$comment' and type=1 limit 1");  // query string stored in a variable
		if(mysql_num_rows($beforeIns)==0) mysql_query("INSERT INTO pv_comment(upload_id,viewer_user_id,user_id,name,comment,PV_id,type) VALUES($upload_id,$GV_id,$owner_id1,'$GV_name','$comment',$PV_id,1)"); /* I am a viewer, the name is my name for display purpose*/
		echo mysql_error();
	}	
}
if($FriendID==$GV_id || $FriendID=="SharedPicture") $Permissionresult=mysql_query("SELECT * FROM view_permission where user_id=$GV_id group by viewer_group");  // query string stored in a variable
else $Permissionresult=mysql_query("SELECT * FROM view_permission where user_id=$FriendID and viewer_id=$GV_id group by viewer_group");  // query string stored in a variable
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row3 = mysql_fetch_array($Permissionresult))
{
	$group[]=$row3['viewer_group'];
};
$VideoComcount=0;

$Videocount=0;
if($FriendID=="SharedPicture") {
	$pv_idresult2=mysql_query("SELECT * FROM pv_share where shareto_id=$GV_id and is_video=1"); 
	while($pv_idrow2 = mysql_fetch_array($pv_idresult2))
	{
		$pos = strpos($pv_idrow2['pv_name'], ".",3);
		$video[]=substr($pv_idrow2['pv_name'],0,$pos).".";
		$pv_id[]=$pv_idrow2['pv_id'];
		$Videocount++;	
		$upload_idresult=mysql_query("SELECT * FROM picture_video where id=$pv_idrow2[pv_id] limit 1"); 
		while($upload_idrow = mysql_fetch_array($upload_idresult))
		{
			$VDupload_id[]=$upload_idrow['upload_id'];
		}	
	}
}
else {
	$result=mysql_query("SELECT * FROM upload_infor where user_id=$FriendID and name<>''");  // query string stored in a variable
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row2 = mysql_fetch_array($result))
	{
		$pv_idresult3 = mysql_query("SELECT * FROM picture_video WHERE upload_id=$row2[id] limit 1");
		echo mysql_error(); 
		while($pv_idrow3 = mysql_fetch_array($pv_idresult3)) {
			$curr_pv_id=$pv_idrow3['id'];
		}	
		if($row2['viewer_group']=="") {
			$video[]=$row2['name'].".";
			$VDupload_id[]=$row2['id'];
			$pv_id[]=$curr_pv_id;
			$Videocount++;
		}
		else {
			foreach ($group as $key => $this_group) {
				if($row2['viewer_group']==$this_group) {
					$video[]=$row2['name'].".";
					$VDupload_id[]=$row2['id'];
					$pv_id[]=$curr_pv_id;
					$Videocount++;
				}
			}
		}
	};
}
if(!isset($_SESSION["pv_id"])) $_SESSION["pv_id"]=$pv_id[0];
$Sharerows=0;
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
		$shareResult = mysql_query("SELECT * FROM pv_share WHERE pv_id=$_SESSION[pv_id] and shareto_id=$option[viewer_id] limit 1");
		echo mysql_error(); 
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
			$shareResult = mysql_query("SELECT * FROM pv_share WHERE pv_id=$_SESSION[pv_id] and shareto_id=$option[viewer_id] limit 1");
			if(mysql_num_rows($shareResult) != 0) $shareFlag[]="checked='checked'";
			else $shareFlag[]="";
		}
	}
}	

if(isset($video)) {
	foreach ($video as $key => $value) {
		$queryComment3=mysql_query("SELECT * FROM pv_comment where upload_id=$VDupload_id[$key] and type=1 order by id desc");  // query string stored in a variable
		echo mysql_error();
		if($key==0)	$VideoComcount=$VideoComcount+mysql_num_rows($queryComment3);
		while($row13 = mysql_fetch_array($queryComment3))
		{	
			$curr_user=$row13['viewer_user_id'];
			$queryUser=mysql_query("SELECT * FROM user where id=$curr_user limit 1");
			while($row15 = mysql_fetch_array($queryUser))
			{		
				$Currname=$row15['first_name']." ".$row15['last_name'];
				$CurrVideoprofile_picture[]=$row15['profile_picture'];
			}				
			$date1= strtotime($row13['comment_date']);
			$comment_date= substr(date('r',$date1),0,-5);
			if(isset($_SESSION["upload_id"])) {
				if($_SESSION["upload_id"]==$VDupload_id[$key]) {
					$CurrVideoComment[] = "<font size=\"3\">".$row13['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
					$Videoupload_id[]=$VDupload_id[$key];
				}
			}
			elseif($key==0)	{
				$CurrVideoComment[] = "<font size=\"3\">".$row13['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
				$Videoupload_id[]=$VDupload_id[$key];
				$_SESSION["upload_id"]=$VDupload_id[$key];
			}
		}
	}
}
$Sharepagenum=1;
$Sharepage_rows = 12;  
$Sharelast = ceil($Sharerows/$Sharepage_rows); 
if ($Sharepagenum < 1) $Sharepagenum = 1; elseif ($Sharepagenum > $Sharelast) $Sharepagenum = $Sharelast; 
$Sharefirst_row=($Sharepagenum -1) * $Sharepage_rows;
$Videopagenum = 1; 
$Videopage_rows = 4;
$Videolast = ceil($Videocount/$Videopage_rows); 
if ($Videopagenum < 1) $Videopagenum = 1; elseif ($Videopagenum > $Videolast) $Videopagenum = $Videolast; 
$Videofirst_row=($Videopagenum -1)* $Videopage_rows;
$Videoprevious = $Videopagenum-1;
if($Videoprevious <= 0) $Videoprevious=1;
$Videonext = $Videopagenum+1;
if($Videonext > $Videocount) $Videonext=$Videocount;

$VideoCompagenum = 1; 
$VideoCompage_rows = 2;  
$VideoComlast = ceil($VideoComcount/$VideoCompage_rows); 
if ($VideoCompagenum < 1) $VideoCompagenum = 1; elseif ($VideoCompagenum > $VideoComlast) $VideoCompagenum = $VideoComlast; 
$VideoComfirst_row=($VideoCompagenum -1)* $VideoCompage_rows;
$VideoComprevious = $VideoCompagenum-1;
if($VideoComprevious <= 0) $VideoComprevious=1;
$VideoComnext = $VideoCompagenum+1;
if($VideoComnext > $VideoComcount) $VideoComnext=$VideoComcount;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Profile Picture Upload</title>
<style>
 .img {border: 5px grey double;}
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
	<input type="checkbox" name="All" id="All" value="All"  onChange="Share(this.id,1);">Share to All
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
	</table>
</td>
</tr>
</table>
</div>
<div style="display:inline-block;vertical-align:top;width:605px;">
	<table>
	<tr>
		<td align="center">
			<div id='videomain' style="display:inline-block;">
			<?php if(isset($video)) {
			$pvID=$_SESSION["pv_id"];
			if(isset($_SESSION["curr_video"])) $curr_video=$_SESSION["curr_video"];
			else $curr_video="$video[0]";
			echo "
			<video id='OnShow' width='600' controls='controls' onClick='VideoShow($pvID);'>
			  <source src='".$curr_video."mp4' type='video/mp4' />
			  <source src='".$curr_video."ogg' type='video/ogg' />
			  <source src='".$curr_video."ogv' type='video/ogv' />
			  <source src='".$curr_video."webm' type='video/webm' />
			  <source src='".$curr_video."mp4video.mp4' type='video/mp4' />
			  <source src='".$curr_video."theora.ogv' type='video/ogg' />
			  <source src='".$curr_video."webmvp8.webm' type='video/webm' />
			  Your browser does not support the video tag. <br/>Click the Compatibility button on IE or switch to other browser
			</video>";
			}
			?>
			</div>
		</td>
	<tr>
	</tr>
		<td>
			<div id="VDComment">
			<?php
			if(isset($CurrVideoComment)) {
				$pvID=$_SESSION["pv_id"];
				if($VideoComcount==0)  $height="0px";
				elseif($VideoComcount==1)  $height="49px";
				else $height="98px";
				echo "<div style=\"width:17px;display:inline-block;height:$height;\">";
				echo "<input type='image' src=\"../images/first_up2.png\" id='VideoComfirst' onClick=\"CommentList3('first',$pvID,1,0);\"><br/>";
				echo "<input type='image' src=\"../images/previous_up2.png\" id='VideoComprevious'  onClick=\"CommentList3('previous',$pvID,1,0);\"><br/>";
				echo "<input type='image' src=\"../images/next_up.png\" id='VideoComnext' onClick=\"CommentList3('next',$pvID,1,0);\"><br/>";
				echo "<input type='image' src=\"../images/last_up.png\" id='VideoComlast'  onClick=\"CommentList3('last',$pvID,1,0);\">";
				echo "</div>";
				echo "<div style=\"background-color:#E6FFE6;height:$height;display:inline-block;vertical-align:top;\">";
				echo "<div id=\"CurrVideoComment\" style=\"width:570px;display:inline-block;vertical-align:top;font-size:13px\">";
						$listcount=0;
						foreach ($CurrVideoComment as $key2 => $comment2) {
							$listcount++;
							if($listcount > $VideoComfirst_row && $listcount <= ($VideoComfirst_row+$VideoCompage_rows)){
								echo "<div style=\"display:inline-block;\"><img src=\"$CurrVideoprofile_picture[$key2]\" height=\"37\" class='img' ></div>";
								echo "<div style=\"display:inline-block;vertical-align:top;\">".$comment2."</div><br/>";
							}
						}				
				echo "</div>";
				echo "</div>";
			}
			echo "</div>";
			if(isset($video)) {
				echo "<form name=\"VideoForm\" id=\"VideoForm\" action=\"\" enctype='application/x-www-form-urlencoded' method='post' onsubmit=\"if(document.getElementById('VideoComment').value=='') return false;\">";
				foreach($_REQUEST as $name => $value) { if($name=="FriendID") echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";	}
				if(isset($_SESSION["upload_id"])) echo "<input type='hidden' name='upload_id' id='upload_id' size='80' value=\"$_SESSION[upload_id]\">";
				else  echo "<input type='hidden' name='upload_id' id='upload_id' size='80' value=\"$VDupload_id[0]\">";
				echo "<input type='hidden' name='pv_id' id='pv_id' size='80' value=\"$_SESSION[pv_id]\">";
				if(isset($_SESSION["curr_video"])) echo "<input type=\"hidden\" name=\"curr_video\" id=\"curr_video\" value=\"$_SESSION[curr_video]\">";
				else echo "<input type=\"hidden\" name=\"curr_video\" id=\"curr_video\" value=\"$video[0]\">";
				echo "Comment: <input type='text' name='VideoComment' id='VideoComment' size='80' value=''>";
				echo "</form>";
			}	
			?>
		</td>
	</tr>
	<tr>
		<td  align="center" id="VideoNav">
		<?php
		echo "<input type='image' src=\"../images/first2.png\" id='Videofirst' onClick=\"VideoList('first',$FriendID);\">";
		echo " ";
		echo "<input type='image' src=\"../images/previous2.png\" id='Videoprevious'  onClick=\"VideoList('previous',$FriendID);\">";
		echo "<input type='image' src=\"../images/next1.png\" id='Videonext' onClick=\"VideoList('next',$FriendID);\">";
		echo " ";
		echo "<input type='image' src=\"../images/last.png\" id='Videolast'  onClick=\"VideoList('last',$FriendID);\"><br/>";
		?>
		</td>
	</tr>
	<tr>
		<td valign="top"  id="NextVideos">
		<?php
			if(isset($video)) {
				$listcount=0;
				foreach ($video as $key => $value) {
					$listcount++;
					if($listcount > $Videofirst_row && $listcount <= ($Videofirst_row+$Videopage_rows)){
						echo "
						<video width='130' onClick=\"Action('ShowVideos.php?video=$value'+'&VideoWidth='+VideoWidth,'videomain',$VDupload_id[$key],$pv_id[$key]);\" class='pointer'>
						  <source src='$video[$key]mp4' type='video/mp4' />
						  <source src='$video[$key]ogg' type='video/ogg' />
						  <source src='$video[$key]ogv' type='video/ogv' />
						  <source src='$video[$key]webm' type='video/webm' />
						  <source src='$video[$key]mp4video.mp4' type='video/mp4' />
						  <source src='$video[$key]theora.ogv' type='video/ogg' />
						  <source src='$video[$key]webmvp8.webm' type='video/webm' />
						  Your browser does not support the video tag. <br/>Click the Compatibility button on IE or switch to other browser
						</video>";
					}	
				}    
			}		
		?>
		</td>	
	</tr>
	</table>
</div>
</center>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">
var user_id = "<?php echo $GV_id; ?>";
var Sharepagenum = 1;
var Sharelast = <?php echo $Sharelast; ?>;
var Sharerows = <?php echo $Sharerows; ?>;
var Sharepage_rows = <?php echo $Sharepage_rows; ?>;
var Videopagenum = 1;
var Videolast = <?php echo $Videolast; ?>;
var Videocount = <?php echo $Videocount; ?>;
var Videopage_rows = <?php echo $Videopage_rows; ?>;
var VideoWidth=600;
var VideoCompagenum = 1;
var VideoComlast = <?php echo $VideoComlast; ?>;
var VideoComcount = <?php echo $VideoComcount; ?>;
var VideoCompage_rows = <?php echo $VideoCompage_rows; ?>;
if(VideoComcount<=VideoCompage_rows) {
	if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').style.display = "none";
	if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').style.display = "none";
	if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').style.display = "none";
	if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').style.display = "none";
}
if(Videocount<=Videopage_rows) {
	if(document.getElementById('Videofirst')) document.getElementById('Videofirst').style.display = "none";
	if(document.getElementById('Videoprevious')) document.getElementById('Videoprevious').style.display = "none";
	if(document.getElementById('Videonext')) document.getElementById('Videonext').style.display = "none";
	if(document.getElementById('Videolast')) document.getElementById('Videolast').style.display = "none";
}
function VideoList(require,FriendID)  
{  
	var viewer_id =  <?php echo $GV_id ?>;
	if(require=='first') Videopagenum=1;
	else if(require=='previous') {
	  Videopagenum = Videopagenum - 1;
	} 
	else if(require=='next') {
	  Videopagenum = Videopagenum + 1;
	} 
	else if(require=='last') Videopagenum=Videolast;
	if(Videopagenum > 1 && Videopagenum < Videolast) {
		document.getElementById('Videofirst').src = "../images/first.png";
		document.getElementById('Videoprevious').src = "../images/previous.png";
		document.getElementById('Videonext').src = "../images/next1.png";
		document.getElementById('Videolast').src = "../images/last.png";
	}
	else if(Videopagenum<=1) {
		Videopagenum = 1;
		document.getElementById('Videofirst').src = "../images/first2.png";
		document.getElementById('Videoprevious').src = "../images/previous2.png";
		document.getElementById('Videonext').src = "../images/next1.png";
		document.getElementById('Videolast').src = "../images/last.png";
	}
	 else if(Videopagenum>=Videolast) {
		Videopagenum = Videolast;
		document.getElementById('Videofirst').src = "../images/first.png";
		document.getElementById('Videoprevious').src = "../images/previous.png";
		document.getElementById('Videonext').src = "../images/next2.png";
		document.getElementById('Videolast').src = "../images/last2.png";
	 }		

	var url = 'VideoList.php?FriendID='+FriendID+'&viewer_id='+viewer_id+'&pagenum='+Videopagenum+'&page_rows='+Videopage_rows+'&VideoWidth='+VideoWidth;
	$(document).ready(function() {
	   $("#NextVideos").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}

function Action(url,affect_id,upload_id,pv_id) {
	var id = "#"+affect_id;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
	document.getElementById("upload_id").value=upload_id;
	CommentList3('first',upload_id,1,1);
	
	document.getElementById("pv_id").value=pv_id;
	document.getElementById("All").checked=false;
	Sharepagenum=1;

	var url = 'ShareList.php?user_id='+user_id+'&Sharepagenum='+Sharepagenum+'&pv_id='+pv_id;
	$(document).ready(function() {
	   $("#ShareList").load(url);
	   $.ajaxSetup({ cache: false });
	});		
	
	
}
function CommentList3(require,upload_id,type,reset)  
{  
	var viewer_id =  <?php echo $GV_id ?>;
	if(require=='first') VideoCompagenum=1;
	else if(require=='previous') {
	  VideoCompagenum = VideoCompagenum - 1;
	} 
	else if(require=='next') {
	  VideoCompagenum = VideoCompagenum + 1;
	} 
	else if(require=='last') VideoCompagenum=VideoComlast;
	if(VideoCompagenum > 1 && VideoCompagenum < VideoComlast) {
		if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').src = "../images/first_up.png";
		if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').src = "../images/previous_up.png";
		if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').src = "../images/next_up.png";
		if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').src = "../images/last_up.png";
	}
	else if(VideoCompagenum<=1) {
		VideoCompagenum = 1;
		if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').src = "../images/first_up2.png";
		if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').src = "../images/previous_up2.png";
		if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').src = "../images/next_up.png";
		if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').src = "../images/last_up.png";
	}
	 else if(VideoCompagenum>=VideoComlast) {
		VideoCompagenum = VideoComlast;
		if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').src = "../images/first_up.png";
		if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').src = "../images/previous_up.png";
		if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').src = "../images/next_up2.png";
		if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').src = "../images/last_up2.png";
	 }

	 if(reset==0) {	
		 var url = 'CommentList2.php?upload_id='+upload_id+'&viewer_id='+viewer_id+'&pagenum='+VideoCompagenum+'&type='+type;
		$(document).ready(function() {
		   $("#CurrVideoComment").load(url);
		   $.ajaxSetup({ cache: false });
		});		
	 }
	 else {
		var url = 'CommentList3.php?upload_id='+upload_id+'&viewer_id='+viewer_id+'&pagenum='+VideoCompagenum+'&type='+type;
		$(document).ready(function() {
		   $("#VDComment").load(url);
		   $.ajaxSetup({ cache: false });
		});		
	 }
}
function VideoShow(pvID)  
{  
	VideoWidth=600;
	document.getElementById("OnShow").width=VideoWidth;
	document.getElementById("pv_id").value=pvID;
	window.parent.scroll(0,0);
}
function Share(shareto_id,flag) {
	var answer = confirm("Please click \"OK\" to confirm")
	var success = true;
	if (answer){
		var pv_id=document.getElementById("pv_id").value;
		if(document.getElementById(shareto_id).checked)	var share=1;
		else var share=0;
		$.ajax({ 
		   type: "POST", 
		   url: "UpdateShare.php",
		   data: "pv_id="+pv_id+"&user_id="+user_id+"&shareto_id="+shareto_id+"&flag="+flag+"&share="+share+"&is_video=1", 
			error:function (xhr, ajaxOptions, thrownError){ 
				alert(xhr.status); 
				alert(thrownError);
				success	=false;
			}     	   
		 });
		if(success){
		alert( "Required have been successfully set" );
		Sharepagenum=1;
		var pv_id=document.getElementById('pv_id').value;
		var url = 'ShareList.php?user_id='+user_id+'&Sharepagenum='+Sharepagenum+'&pv_id='+pv_id;
		$(document).ready(function() {
		   $("#ShareList").load(url);
		   $.ajaxSetup({ cache: false });
		});	
		}
	}
	else{
		document.getElementById(shareto_id).checked=!document.getElementById(shareto_id).checked;
	}

}

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
	var pv_id=document.getElementById('pv_id').value;
	var url = 'ShareList.php?user_id='+user_id+'&Sharepagenum='+Sharepagenum+'&pv_id='+pv_id;
	$(document).ready(function() {
	   $("#ShareList").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
</script>
<script src="../scripts/chat.js"></script>

</body>
</html>