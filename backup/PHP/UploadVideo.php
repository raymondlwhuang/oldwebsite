<?php
@session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: index.php');
	exit();
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
require_once("../inc/CurrentDateTime.inc.php");
$GroupResult=mysql_query("SELECT * FROM `view_permission` where user_id = $GV_id and viewer_group <> '' group by viewer_group");          // query executed 
while($option = mysql_fetch_array($GroupResult)) {
	$optionGroup["$option[id]"] = $option['viewer_group'];
}
$picture_video = "videos";
$limit_size=20* 1024*1000;
$MaxSize= ($limit_size / (1024*1000));
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html> 
<head> 
	<title>VIDEO UPLOADER</title> 
</head> 
<body> 
<center>
<font style="font-size:18px;color:red;"><?php echo strtoupper(substr($picture_video,0,-1)) ?> UPLOADER</font><br/>
<?php
include("../PHP/Header.php");
if ($_FILES){
	$viewer_group = "";
	$description = "";
	if(isset($_REQUEST['viewer_group']))
	{
		$viewer_group = $_REQUEST['viewer_group'];
		$description = $_REQUEST['description'];
		$_SESSION["viewer_group"] = $viewer_group;
		$_SESSION["description"] = $description;
	}
	$message =  "";
	//$message =  "<font color='darkblue'>No. files uploaded : ".count($_FILES['infile']['name'])."</font><br>";  
	$public=md5($GV_id);
    	$name = $_FILES['infile']['name']; 
		$videos = "../videos/$GV_owner_path/";
		@mkdir("$videos");
		if($viewer_group!='' && $viewer_group !='Public' && $viewer_group !='Temporary')
		{
			@mkdir("../videos/$GV_owner_path/$viewer_group/");
		}
		$pos=strrpos($name,".");
		$ext=strtolower(substr($name,($pos+1)));
		$name1=substr($name,0,$pos);
		$OKformat=0;
		if($ext=='mp4' || $ext=='m4v' || $ext=='ogg' || $ext=='ogv' || $ext=='webm') {
			$OKformat=1;
			if($ext=='m4v') $name=$name1.".mp4";
		}
		
		if($viewer_group =='')
			$targetfilepath= "../$picture_video/$GV_owner_path/" . $name;
		elseif($viewer_group =='Public')
			$targetfilepath= "../$picture_video/$public" . $name;
		elseif($viewer_group =='Temporary')
			$targetfilepath= "../Temporary/" . $name;
		else
			$targetfilepath= "../$picture_video/$GV_owner_path/$viewer_group/" . $name;
		$file_size=$_FILES['infile']['size'];
		$pos=strrpos($targetfilepath,".");
		$pos1=strpos($targetfilepath,".",4);
		$VideoName=substr($targetfilepath,0,$pos1);
		if($file_size <= $limit_size && $OKformat==1){
			$UploadCheck=mysql_query("SELECT * FROM picture_video where name = '$targetfilepath' limit 1");
			if (mysql_num_rows($UploadCheck) == 0){
				 $result = move_uploaded_file($_FILES['infile']['tmp_name'], $targetfilepath); 
				 
				 if ($result){
						$today = substr($now,0,10);
						$vRes = mysql_query("SELECT * FROM `upload_infor` where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' and name='$VideoName' limit 1");
						echo mysql_error(); 
						if (mysql_num_rows($vRes) == 0){
							mysql_query("INSERT INTO upload_infor(user_id,viewer_group,description,upload_date,name) VALUES($GV_id,'$viewer_group','$description','$today','$VideoName')");
						}
						if(!isset($description)) $description ="";
						$GetUploadID = mysql_query("SELECT * FROM `upload_infor` where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' and name='$VideoName' limit 1");
						while($GetUploadIDRow = mysql_fetch_array($GetUploadID))
						{
							$upload_id = $GetUploadIDRow['id'];
						}
						mysql_query("INSERT INTO picture_video(owner_path,picture_video,viewer_group,name,upload_id) VALUES('$GV_owner_path','$picture_video', '$viewer_group', '$targetfilepath',$upload_id)");	
					 
						$message .= "<font color='darkblue' size='3'>$name</font> has been Uploaded succefully. <br>"; 
				 }
				else $message .= "<font color='red' size='3'>File upload Failed for $name. </font><br>"; 
			}
			else $message .= "<font color='red' size='3'>Duplicate upload not allowed for $name! Uploaded canceled. </font><br>";
		}
		else{
			if($OKformat==0) $message .= "<font color='red' size='3'>Invalid file format<font color='blue' size='3'> $name. </font><br>";
			else
				$message .= "<font color='red' size='3'>File size is over limit! File upload Failed for</font><font color='blue' size='3'> $name. </font><br>";
		}
	
	
	
//	$message .= "<font color='red'><b>Upload complete.</b></font><br>";
	if($OKformat==1) {
		$mp4_count=0;
		$webm_count=0;
		$other_count=0;
		$queryVideos=mysql_query("SELECT * FROM picture_video where owner_path='$GV_owner_path' and picture_video='videos' and name like '$VideoName%'");
		while($row2 = mysql_fetch_array($queryVideos))
		{
			$pos=strrpos($row2['name'],".")+1;
			$ext=strtolower(substr($row2['name'],$pos));
			if($ext=="mp4") $mp4_count=1;
			elseif($ext=="webm") $webm_count=1;
			else $other_count=1;
		}
		if($mp4_count==0) $message .= "Missing <font color='red'><b>MP4</b></font> file for this video <br>";
		elseif($webm_count==0) $message .= "Missing <font color='red'><b>WEBM</b></font> file for this video <br>";
	}
	$_SESSION["message"] = $message;
	echo "
        <script type=\"text/javascript\">
			window.open('UploadVideo.php',target='_top');
        </script>";
	exit();
}

echo <<<_END
<div style="border:solid;color:green;width:900px;">
<font color='red' SIZE='12'><b>HINTS:</b></font>(to make your video supported <font color='red'><b>by most browser</b></font>)<br>
Upload 3 files for each video clip. One in <font color='red'><b>MP4</b></font> format, one in <font color='red'><b>WebM(vp8)</b></font> format and one in <font color='red'><b>Theora</b></font> format <br>
<a href=\"http://www.mirovideoconverter.com/download_win.html\" target=\"_blank\">Click here</a> to Download the converter if needed<br/><font color='red'><b>(to make sure your mp4 file works you must convert your mp4 video with this converter)</b></font><br/>
</div>
_END;


?>
<br/>
<form name="uploader" id="uploader" action="" method="POST" enctype="multipart/form-data" > 
<table>
	<tr>
		<td>Description:
		</td>
		<td align="left">
		<input type="text" name="description" id="description" placeholder="Enter description here before select files" value="<?php if(isset($_SESSION["description"])) echo $_SESSION["description"]; echo ""; ?>" size="40" style="font-size:20px;border-color:#5050FF;border-width: 3px;">
		</td>
	</tr>
	<tr>
		<td>Share Video With:
		</td>
		<td align="left">
				<select name="viewer_group" id="viewer_group" style="font-size:20px;width:385px;border-color:#5050FF;border-width: 3px;">
				<option value='' <?php if(isset($_SESSION["viewer_group"]) && $_SESSION["viewer_group"] == '') echo "selected='selected'"; ?>>All Group</option>
				<?php
					foreach($optionGroup as $id=>$viewer_group2) {
						if(isset($_SESSION["viewer_group"]) && $viewer_group2 == $_SESSION["viewer_group"]) echo "<option value='$viewer_group2' selected='selected'>$viewer_group2</option>";
						else echo "<option value='$viewer_group2'>$viewer_group2</option>";
					}
				?>
				<option value='Public' <?php if(isset($_SESSION["viewer_group"]) && $_SESSION["viewer_group"] == 'Public') echo "selected='selected'"; ?>>Public</option>
				<option value='Temporary' <?php if(isset($viewer_group) && $viewer_group == 'Temporary') echo "selected='selected'"; ?>>Temporary</option>
				</select>
		</td>
	</tr>
	<tr>
		<td>Video Upload(Max <?php echo $MaxSize."MB"; ?>):</td>
		<td align="left">
		<input id="infile" name="infile" type="file" accept="video/*" size="40" onChange="send_mail();Action();" style="font-size:20px;border-color:#5050FF;border-width: 3px;"/> 
		</td>
	</tr>
</table>
</form>
<div id='BlankMsg' style="display:none;"></div>
<img src="../images/upload.gif" id="loading" />
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<?php 
if(isset($_SESSION["message"])) echo $_SESSION["message"];
unset ($_SESSION['message'], $message);
unset ($_SESSION['message']);
?>
</center>
	
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>	
<script type="text/javascript">
var admin = <?php echo $_SESSION["admin"]; ?>;
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
document.getElementById('VUpload').style.display = "none";
var user_id=<?php echo $GV_id; ?>;
function Action() {
	document.getElementById('loading').style.display='block';
	document.getElementById('uploader').submit();
}
document.getElementById('loading').style.display='none';
function send_mail()  
{ 
	var viewer_group=document.getElementById('viewer_group').value;
	if (viewer_group!="Public" && viewer_group!="Temporary"){
		$.ajax({ 
		   type: "POST", 
		   url: "SendEMail.php",
		   data: "user_id="+user_id+"&viewer_group="+viewer_group, 
			error:function (xhr, ajaxOptions, thrownError){ 
						alert(xhr.status); 
						alert(thrownError); 
			}     	   
		 }); 	
	}

}
</script>
</body> 
</html>