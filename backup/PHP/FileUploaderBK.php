<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
require_once("../inc/CurrentDateTime.inc.php");
$GroupResult=mysql_query("SELECT * FROM `view_permission` where user_id = $GV_id group by viewer_group");          // query executed 
while($option = mysql_fetch_array($GroupResult)) {
	$optionGroup["$option[id]"] = $option['viewer_group'];
}
if(isset($_REQUEST['picture_video'])) $picture_video = $_REQUEST['picture_video'];
else $picture_video = "All";
if($picture_video=='videos') $limit_size=20* 1024*1000;
else $limit_size=2* 1024*1000;
$MaxSize= ($limit_size / (1024*1000));

if ($_FILES){
	if(isset($_REQUEST['viewer_group']))
	{
		$viewer_group = $_REQUEST['viewer_group'];
		$description = $_REQUEST['description'];
	}
	$message =  "<font color='darkblue'>No. files uploaded : ".count($_FILES['infile']['name'])."</font><br>";  
	 
	$public=md5($GV_id);
	for ($i = 0; $i < count($_FILES['infile']['name']); $i++) { 
    	$name = $_FILES['infile']['name'][$i]; 
		$pictures = "../pictures/$GV_owner_path/";
		$videos = "../videos/$GV_owner_path/";
		@mkdir("$pictures");
		@mkdir("$videos");
		if($viewer_group!='' && $viewer_group !='Public')
		{
			@mkdir("../pictures/$GV_owner_path/$viewer_group/");
			@mkdir("../videos/$GV_owner_path/$viewer_group/");
		}
		if($viewer_group =='')
			$targetfilepath= "../$picture_video/$GV_owner_path/" . $name;
		elseif($viewer_group =='Public')
			$targetfilepath= "../$picture_video/$public" . $name;
		else
			$targetfilepath= "../$picture_video/$GV_owner_path/$viewer_group/" . $name;
		$file_size=$_FILES['infile']['size'][$i];
		if( is_file ($targetfilepath) )	unlink($targetfilepath);
		if($file_size <= $limit_size){
			$today = substr($now,0,10);
			$vRes = mysql_query("SELECT * FROM `upload_infor` where user_id=$GV_id and description = '$description' and upload_date='$today' and viewer_group='$viewer_group' limit 1");
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
			mysql_query("INSERT INTO picture_video(owner_path,picture_video,viewer_group,name,upload_id) VALUES('$GV_owner_path','$picture_video', '$viewer_group', '$targetfilepath',$upload_id)");	
			 $result = move_uploaded_file($_FILES['infile']['tmp_name'][$i], $targetfilepath); 
			 
			 if ($result){ 
			  $message .= "<font color='blue' size='3'>$name has been Uploaded succefully. </font><br>"; 
			 }
			else $message .= "<font color='red' size='3'>File upload Failed for $name. </font><br>"; 
		}
		else $message .= "<font color='red' size='3'>File size is over limit! File upload Failed for</font><font color='blue' size='3'> $name. </font><br>";
	} 
	$message .= "<font color='red'><b>Upload complete.</b></font><br>";
	$_SESSION["message"] = $message;
	echo "
        <script type=\"text/javascript\">
			window.open('PictureUploader.php?picture_video=$picture_video',target='_top');
        </script>";
	exit();		
}
 $u_agent = strtolower($_SERVER['HTTP_USER_AGENT']); 
//echo "This is the browser your current running: ".$u_agent;
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
<font style="font-size:18px;color:red;"><?php echo strtoupper(substr($picture_video,0,-1)) ?> UPLOADER</font><br/>
<input type="image" src="../images/home.png" name="Home" value="Home" width="80" onClick="window.open('index.php',target='_top');">
<hr/>
<?php if($bname =="Internet Explorer" || $bname =="Apple Safari") echo "<font color='Blue'><b>Your browser don't support multiple Picture Upload!<br/>Please consider using 'Google Chrome,FireFox,Aurora,Opera,Avant instead!'</b></font><br/><br/>"; ?>

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
				</select>
		</td>
	</tr>
	<tr>
		<td><?php if($bname =="Internet Explorer" || $bname =="Apple Safari") echo "Picture Upload(Max ".$MaxSize."MB):"; else echo "Mulitiple $picture_video Upload(Max ".$MaxSize."MB each):"?></td>
		<td align="left">
		<input id="infile" name="infile[]" type="file" accept="<?php if($picture_video=='pictures') echo 'image/*'; elseif($picture_video=='videos') echo 'video/*'; ?>" onChange="document.getElementById('uploader').submit();" <?php if($bname =="Internet Explorer" || $bname =="Apple Safari") echo ""; else echo 'multiple="true"' ?> size="40" style="font-size:20px;border-color:#5050FF;border-width: 3px;"/> 
		</td>
	</tr>
</table>
</form>

<?php 
if(isset($_SESSION["message"])) echo $_SESSION["message"];
unset ($_SESSION['message'], $message);
unset ($_SESSION['message']);
?>
</center>		
</body> 
</html>