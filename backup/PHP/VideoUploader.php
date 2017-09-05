<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
$GroupResult=mysql_query("SELECT * FROM `view_permission` where user_id = $GV_id group by viewer_group");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option = mysql_fetch_array($GroupResult)) {
	$optionGroup["$option[id]"] = $option['viewer_group'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Picture Uploader</title>
</head>
<body>
<center>
<div style="position:fixed;top:300px;left: 40%;">
	<?php
		$uploader=new PhpUploader();

		$uploader->MultipleFilesUpload=true;
		$uploader->InsertText="Click here to select multiple vidoe files (Max 100M)";
		
		$uploader->MaxSizeKB=102400;
		$uploader->AllowedFileExtensions="*.mp4,*.webm,*.ogg,*.ogv";
		
		$uploader->UploadUrl="BlogUploader.php";
		
		$uploader->Render();
	?>	
	<script type='text/javascript'>
	function CuteWebUI_AjaxUploader_OnTaskComplete(task)
	{
		var div=document.createElement("DIV");
		var link=document.createElement("A");
		if(viewer_group=='')
			link.setAttribute("href","../pictures/$GV_owner_path/"+task.FileName);
		else if(viewer_group=='Public')
			link.setAttribute("href","../pictures/"+task.FileName);
		else
			link.setAttribute("href","../pictures/$GV_owner_path/"+viewer_group+"/"+task.FileName);
			
		//link.innerHTML="You have uploaded file : ../pictures/myprefix_"+task.FileName;
		link.target="_blank";
		div.appendChild(link);
		document.body.appendChild(div);
	}
	</script>
	</div>
<?php
$_SESSION["viewer_group"] = '';	
$_SESSION["descriptionPV"] = '';
$_SESSION["picture_video"] = 'videos';

if(isset($_POST['viewer_group']))
{
$viewer_group = $_POST['viewer_group'];
$description = $_POST['description'];
$_SESSION["viewer_group"] = $viewer_group;	
$_SESSION["descriptionPV"] = $description;
$_SESSION["picture_video"] = 'videos';
}
?>		
	<div style="position:fixed;top:10px;left: 40%;">
	<font style="font-size:18px;color:red;">VIDEO UPLOADER</font><br/>
	<font style="font-size:12px;color:blue;">If you would like your video to be played in most browser</font><br/>
	<font style="font-size:12px;color:blue;">Please upload both <font style="font-size:16px;color:red;">MP4</font> and <font style="font-size:16px;color:red;">WEBM</font> file for each video(same name)</font><br/>
	<a href="http://www.mirovideoconverter.com/download_win.html" target="_blank">Click here</a> to Download the converter if needed<br/>
	<font style="font-size:12px;color:blue;">Reconvert with this converter if your MP4 file not working in IE or Safari</font><br/>
	<input type="image" src="../images/home.png" name="Home" value="Home" width="40" onClick="window.open('index.php',target='_top');">
	<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
		<font color="white">Description:</font><br/>
		<input type="text" name="description" id="description" placeholder="Enter description here before select files" value="<?php if(isset($description)) echo "$description"; echo ""; ?>" size="40" style="font-size:18px;border-color:#5050FF;border-width: 3px;" onBlur="document.MyForm.submit();"><br/>
		<font color="white">Share Video With:</font><br/>
		<select name="viewer_group" id="viewer_group" style="font-size:20px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="document.MyForm.submit();">
		<option value='' <?php if(isset($viewer_group) && $viewer_group == '') echo "selected='selected'"; ?>>All Group</option>
		<?php
			foreach($optionGroup as $id=>$viewer_group2) {
				if(isset($viewer_group) && $viewer_group2 == $viewer_group) echo "<option value='$viewer_group2' selected='selected'>$viewer_group2</option>";
				else echo "<option value='$viewer_group2'>$viewer_group2</option>";
			}
		?>
		<option value='Public' <?php if(isset($viewer_group) && $viewer_group == 'Public') echo "selected='selected'"; ?>>Public</option>
		</select><br/>
	</form>
</div>

</center>
</body>
	
</html>