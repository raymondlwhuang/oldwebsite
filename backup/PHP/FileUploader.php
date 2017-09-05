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
include("ResizeImg.php");
$GroupResult=mysql_query("SELECT * FROM `view_permission` where user_id = $GV_id and viewer_group <> '' group by viewer_group");          // query executed 
while($option = mysql_fetch_array($GroupResult)) {
	$optionGroup["$option[id]"] = $option['viewer_group'];
}
$limit_size=10* 1024*1000;
$MaxSize= ($limit_size / (1024*1000));
 $u_agent = strtolower($_SERVER['HTTP_USER_AGENT']); 
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
    }
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html> 
<head> 
	<title>PICTURE UPLOADER</title> 
</head> 
<body> 
<center>
<font style="font-size:18px;color:red;">PICTURE UPLOADER</font><br/>
<?php
include("../PHP/Header.php");
if ($_FILES){
	$viewer_group = "";
	$description = "";
	if(isset($_REQUEST['viewer_group']))
	{
		$viewer_group = $_REQUEST['viewer_group'];
		$description = $_REQUEST['description'];
	}
	$message =  "<font color='darkblue'>No. files uploaded : ".count($_FILES['infile']['name'])."</font><br>";  
	$public=md5($GV_id);
	$pictures = "../pictures/$GV_owner_path/";
	$Orgpictures = "../Orgpictures/$GV_owner_path/";
	$Temporary="../Temporary/";
	$temppictures = "../temppictures/";
	@mkdir("../Orgpictures/");
	@mkdir("$pictures");
	@mkdir("$Orgpictures");
	@mkdir("$temppictures");
	@mkdir("$Temporary");
	for ($i = 0; $i < count($_FILES['infile']['name']); $i++) { 
    	$name = $_FILES['infile']['name'][$i]; 
		if($viewer_group!='' && $viewer_group !='Public' && $viewer_group !='Temporary')
		{
			@mkdir("../pictures/$GV_owner_path/$viewer_group/");
			@mkdir("../Orgpictures/$GV_owner_path/$viewer_group/");
		}
		if($viewer_group =='') {
			$targetfilepath= "../Orgpictures/$GV_owner_path/" . $name;
			$picturefilepath= "../pictures/$GV_owner_path/" . $name;
		}
		elseif($viewer_group =='Public') {
			$targetfilepath= "../Orgpictures/$public" . $name;
			$picturefilepath= "../pictures/$public" . $name;
		}
		elseif($viewer_group =='Temporary') {
			$targetfilepath= "../Orgpictures/$public" . $name;
			$picturefilepath= "../Temporary/$public" . $name;
		}
		else {
			$targetfilepath= "../Orgpictures/$GV_owner_path/$viewer_group/" . $name;
			$picturefilepath= "../pictures/$GV_owner_path/$viewer_group/" . $name;
		}
		$temppath=$temppictures . $name;
		$file_size=$_FILES['infile']['size']["$i"];
		if($file_size <= $limit_size){
			$UploadCheck=mysql_query("SELECT * FROM picture_video where picture_video='pictures' and name = '$picturefilepath' limit 1");
			if (mysql_num_rows($UploadCheck) == 0){
				 $result = move_uploaded_file($_FILES['infile']['tmp_name'][$i], $temppath); 
				 
				 if ($result){
						ResizeImg::ResizeImage($temppath,480,360,$picturefilepath);
						ResizeImg::ResizeImage($temppath,1920,1440,$targetfilepath);
						unlink($temppath);
						$today = substr($now,0,10);
						$vRes = mysql_query("SELECT * FROM `upload_infor` where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' limit 1");
						echo mysql_error(); 
						if (mysql_num_rows($vRes) == 0){
							mysql_query("INSERT INTO upload_infor(user_id,viewer_group,description,upload_date) VALUES($GV_id,'$viewer_group','$description','$today')");
						}
						if(!isset($description)) $description ="";
						$queryUploadID="SELECT id FROM upload_infor where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' limit 1";
						$GetUploadID=mysql_query($queryUploadID);          // query executed 
						while($GetUploadIDRow = mysql_fetch_array($GetUploadID))
						{
							$upload_id = $GetUploadIDRow['id'];
						}
						mysql_query("INSERT INTO picture_video(owner_path,picture_video,viewer_group,name,upload_id) VALUES('$GV_owner_path','pictures', '$viewer_group', '$picturefilepath',$upload_id)");	
					 
						$message .= "<font color='blue' size='3'>$name has been Uploaded succefully. </font><br>"; 
				 }
				else $message .= "<font color='red' size='3'>File upload Failed for $name. </font><br>"; 
			}
			else $message .= "<font color='red' size='3'>Duplicate upload not allowed for $name! Uploaded canceled. </font><br>";
		}
		else $message .= "<font color='red' size='3'>File size is over limit! File upload Failed for</font><font color='blue' size='3'> $name. </font><br>";
	}
	$message .= "<font color='red'><b>Upload complete.</b></font><br>";
	$_SESSION["message"] = $message;
	echo "
        <script type=\"text/javascript\">
			window.open('FileUploader.php?picture_video=pictures',target='_top');
        </script>";
	exit();
}
if($bname =="Internet Explorer" || $bname =="Apple Safari") {
echo <<<_END
<div style="border:solid;color:green;width:900px;">
<font color='red' SIZE='12'><b>HINTS:</b></font>(Your browser don't support multiple Picture Upload!<br/>Please consider using 'Google Chrome,FireFox,Aurora,Opera,Avant instead!)<br>
Picture will put as the same group base on 'Date->Group->Description' <br/>
Recommend maximum <font color='red'><b>10 pictures</b></font>/day/group. <br/>
Picture will automatically resize to less then <font color='red'><b>2MB</b></font> after upload.<br/> 
To increase your upload speed. Please reduce your picture size previous to upload! </div>
_END;
}
else {
echo <<<_END
<div style="border:solid;color:green;width:900px;">
<font color='red' SIZE='12'><b>HINTS:</b></font><br>
Picture will put as the same group base on 'Date->Group->Description' <br/>
Recommend maximum <font color='red'><b>10 pictures</b></font>/day/group.<br/>
Picture will automatically resize to less then <font color='red'><b>2MB</b></font> after upload.<br/> 
To increase your upload speed. Please reduce your picture size previous to upload!</div>
_END;
}
?>
<br/>
<form name="uploader" id="uploader" action="" method="POST" enctype="multipart/form-data" > 
<table>
	<tr>
		<td>Description:
		</td>
		<td align="left">
		<input type="text" name="description" id="description" placeholder="Enter description here before select files" value="<?php if(isset($description)) echo "$description"; echo ""; ?>" size="40" style="font-size:20px;border-color:#5050FF;border-width: 3px;">
		</td>
	</tr>
	<tr>
		<td>Share Picture With:
		</td>
		<td align="left">
				<select name="viewer_group" id="viewer_group" style="font-size:20px;width:385px;border-color:#5050FF;border-width: 3px;">
				<option value='' <?php if(isset($viewer_group) && $viewer_group == '') echo "selected='selected'"; ?>>All Group</option>
				<?php
					foreach($optionGroup as $id=>$viewer_group2) {
						if(isset($viewer_group) && $viewer_group2 == $viewer_group) echo "<option value='$viewer_group2' selected='selected'>$viewer_group2</option>";
						else echo "<option value='$viewer_group2'>$viewer_group2</option>";
					}
				?>
				<option value='Public' <?php if(isset($viewer_group) && $viewer_group == 'Public') echo "selected='selected'"; ?>>Public</option>
				<option value='Temporary' <?php if(isset($viewer_group) && $viewer_group == 'Temporary') echo "selected='selected'"; ?>>Temporary</option>
				</select>
		</td>
	</tr>
	<tr>
		<td><?php if($bname =="Internet Explorer" || $bname =="Apple Safari") echo "Picture Upload(Max ".$MaxSize."MB):"; else echo "Mulitiple pictures Upload(Max ".$MaxSize."MB each):"?></td>
		<td align="left">
		<input id="infile" name="infile[]" type="file" accept="image/*" onChange="send_mail();Action();" <?php if($bname =="Internet Explorer" || $bname =="Apple Safari") echo ""; else echo 'multiple="true"' ?> size="40" style="font-size:20px;border-color:#5050FF;border-width: 3px;"/> 
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
document.getElementById('PUpload').style.display = "none";
var user_id=<?php echo $GV_id; ?>;
var admin = <?php echo $_SESSION["admin"]; ?>;
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
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
		 }); 	
	}

}
</script>
</body> 
</html>