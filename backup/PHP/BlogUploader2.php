<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Video Uploader</title>
</head>
<body>
<div>
	<?php
		$uploader=new PhpUploader();

		$uploader->MultipleFilesUpload=true;
		$uploader->InsertText="Select multiple video files (Max 100M)";
		
		$uploader->MaxSizeKB=102400;
		$uploader->AllowedFileExtensions="*.mp4,*.webm,*.ogg";
		
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
Description:<br/><input type="text" name="description" id="description" class="wide" placeholder="Please enter description before select files" value="" size="40" style="font-size:20px;border-color:#5050FF;border-width: 3px;">
<br/><br/>
	To supported by all browser please provide the "webm" video format<br/>
	<a href="http://www.mirovideoconverter.com/download_win.html" target="_blank">Click here</a> to Download the converter if needed</p><br/>
	
</body>
	
</html>