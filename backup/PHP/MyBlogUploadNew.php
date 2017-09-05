<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
?>
<html>
<head>
<title>Upload your videos or pictures</title>
</head>
<body>
<p style='font-size:10px;'>Supported video format: mp4,swf and flv.<br/>
<a href="http://www.dvdvideosoft.com/products/dvd/Free-Video-to-Flash-Converter.htm"target="_blank">Click here</a> to Download the converter if needed</p>
<a href="http://www.mirovideoconverter.com/download_win.html" target="_blank">Click here</a> to Download the converter if needed</p>
<center>
<form name="upload" method="post" enctype="multipart/form-data">
  <font color="red" style='font-size:12px;'>Select videos/pictures to upload below:</font><br />
  <input name="filename0" type="file" size="15" /><br />
  <input name="filename1" type="file" size="15" /><br />
  <input name="filename2" type="file" size="15" /><br />
  <input name="filename3" type="file" size="15" /><br />
  <input name="filename4" type="file" size="15" /><br />
  <input name="filename5" type="file" size="15" /><br />
  <input name="filename6" type="file" size="15" /><br />
  <input name="filename7" type="file" size="15" /><br />
  <input type="submit" value="Send files" onClick="return validate();" />
</form>		
</center>
<?php 
		if ($_FILES)
		{
		/*
		    if ($_POST['fileID'] != ''){
			  $pictures = "../$_POST[fileID]/";
			  $videos = "../$_POST[fileID]/";
			  @mkdir($pictures);
			}
			else
			  $pictures = "../pictures/";
			  $videos = "../videos/";
			*/
			  $pictures = "../pictures/wedding/";
			  $videos = "../videos/wedding/";
			for($i=0;$i<=7;$i++){
			    $filename = "filename"."$i";
				$name = $_FILES["$filename"]['name'];
				$ext = strtolower(substr($name,strpos($name,".") + 1));
				if ($ext == 'gif') $n = "../pdf/".$name;
				else if ($ext == 'gif' 
					  || $ext == 'png'
					  || $ext == 'jpg'
					  || $ext == 'tif'
					  ) $n = $pictures.$name;
				else if ($ext == 'mp4') $n = $videos.$name;
				else $n = '';
				if ($n != ''){
					if(!move_uploaded_file($_FILES["$filename"]['tmp_name'], $n)) echo "<p style='position:fixed; right:20px; top:0px;color:red;'>Upload failed!</p>";
					else echo "<p style='position:fixed; right:20px; top:0px;color:red;'>File had been uploaded</p>";
				}
			}
		}
		//else echo "No file has been uploaded";
?>
<!--<br/><font color="red">It will see by everyone come to this site after upload</font>-->
</body>
</html>