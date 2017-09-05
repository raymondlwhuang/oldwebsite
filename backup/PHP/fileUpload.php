<?php 
echo <<<_END
<html><head><title>PHP Form Upload</title></head><body>
<form method='post' enctype='multipart/form-data'>
Select a File:
<input type='file' name='filename' size='10' />
<input type='submit' value='Upload' /></form>
_END;

if ($_FILES)
{
	$name = $_FILES['filename']['name'];
	$ext = substr($name,strpos($name,".") + 1);
	if ($ext == 'pdf') $n = "pdf/".$name;
	else if ($ext == 'txt') $n = "txt/".$name;
	else if ($ext == 'zip') $n = "zip/".$name;
	else if ($ext == 'sql') $n = "sql/".$name;
	else if ($ext == 'php') $n = "PHP/".$name;
	else if ($ext == 'js') $n = "scripts/".$name;
	else if ($ext == 'html') $n = "HTML/".$name;
	else if ($ext == 'htm') $n = "HTML/".$name;
	else $n = "images/".$name;
	if(!move_uploaded_file($_FILES['filename']['tmp_name'], $n))
	echo  "$ext Upload failed!";
	else echo  "$ext Uploaded file '$name' as '$n':<br />";
}
else echo "No file has been uploaded";
echo "</body></html>";
/*
if ($_FILES)
{
	$name = $_FILES['filename']['name'];

	switch($_FILES['filename']['type'])
	{
		case 'image/jpeg': $ext = 'jpg'; break;
		case 'image/gif':  $ext = 'gif'; break;
		case 'image/png':  $ext = 'png'; break;
		case 'image/tiff': $ext = 'tif'; break;
		default:		   $ext = '';    break;
	}
	if ($ext)
	{
		//$n = "image.$ext";
		$n = "../images/".$name;
		move_uploaded_file($_FILES['filename']['tmp_name'], $n);
		echo "Uploaded image '$name' as '$n':<br />";
		echo "<img src='$n' />";
	}
	else echo "'$name' is not an accepted image file";
}
else echo "No image has been uploaded";
*/
?>