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
<div style="position:fixed;top:150px;">
	<?php
		$uploader=new PhpUploader();

		$uploader->MultipleFilesUpload=true;
		$uploader->InsertText="Click here to select multiple picture files (Max 2M)";
		
		$uploader->MaxSizeKB=2048;
		$uploader->AllowedFileExtensions="*.jpg,*.png,*.gif,*.bmp";
		
		$uploader->UploadUrl="BlogUploader.php";
		
		$uploader->Render();
	?>	
	<script type='text/javascript'>
	function CuteWebUI_AjaxUploader_OnTaskComplete(task)
	{
		var div=document.createElement("DIV");
		var link=document.createElement("A");
		link.setAttribute("href","../pictures/myprefix_"+task.FileName);
		//link.innerHTML="You have uploaded file : ../pictures/myprefix_"+task.FileName;
		link.target="_blank";
		div.appendChild(link);
		document.body.appendChild(div);
	}
	</script>
	</div>
	<div style="position:fixed;top:10px;">
Description:<br/><input type="text" name="description" id="description" placeholder="Please enter description before select files" value="" size="30" style="font-size:20px;border-color:#5050FF;border-width: 3px;"><br/>
Share Picture With:<br/>
	<select name="viewer_group" id="viewer_group" style="font-size:20px;width:250px;border-color:#5050FF;border-width: 3px;">
	<option value='0'>All Group</option>
	<?php
		foreach($optionGroup as $id=>$viewer_group) {
			echo "<option value='$id'>$viewer_group</option>";
		}
	?>
	</select><br/>
</div>	
</center>
</body>
	
</html>