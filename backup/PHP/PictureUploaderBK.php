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

<div style="position:fixed;top:200px;left: 40%;">
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
		var viewer_group=document.getElementById('viewer_group').value;
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
$_SESSION["picture_video"] = 'pictures';

if(isset($_POST['viewer_group']))
{
$viewer_id = $_POST['viewer_group'];
$description = $_POST['description'];
$_SESSION["viewer_group"] = $viewer_id;	
$_SESSION["descriptionPV"] = $description;
}
?>		
<div style="position:fixed;top:10px;left: 40%;">
	<font style="font-size:18px;color:red;">PICTURE UPLOADER</font><br/>
	<input type="image" src="../images/home.png" name="Home" value="Home" width="40" onClick="window.open('index.php',target='_top');">
		<form action="" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
		<font color="white">Description:</font><br/><input type="text" name="description" id="description" placeholder="Enter description here before select files" value="<?php if(isset($description)) echo "$description"; echo ""; ?>" size="40" style="font-size:18px;border-color:#5050FF;border-width: 3px;" onBlur="document.MyForm.submit();"><br/>
		<font color="white">Share Picture With:</font><br/>
		<select name="viewer_group" id="viewer_group" style="font-size:20px;width:250px;border-color:#5050FF;border-width: 3px;" onChange="document.MyForm.submit();">
		<option value='' <?php if(isset($viewer_id) && $viewer_id == '') echo "selected='selected'"; ?>>All Group</option>
		<?php
			foreach($optionGroup as $id=>$viewer_group) {
				if(isset($viewer_id) && $id == $viewer_id) echo "<option value='$id' selected='selected'>$viewer_group</option>";
				else echo "<option value='$id'>$viewer_group</option>";
			}
		?>
		<option value='Public' <?php if(isset($viewer_id) && $viewer_id == 'Public') echo "selected='selected'"; ?>>Public</option>
		</select><br/>
	</form>
</div>

</center>
</body>
	
</html>