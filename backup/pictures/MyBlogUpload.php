<html>
<head>
<title>Upload your videos or pictures</title>
<script type="text/javascript">
function validate() {
 if (upload.fileID.value == '') {
 document.getElementById("ErrorMessage").innerHTML = "You must provide your name";
 return false;
 }
 return true;
}
</script>
</head>
<body>
Supported video format is: mp4, swf and flv, You proberly need a converter for it<br/>
<a href="http://www.dvdvideosoft.com/products/dvd/Free-Video-to-Flash-Converter.htm">Click here</a> to Download the converter<br/>
<form name="upload" method="post" enctype="multipart/form-data">
  Your Name:<input type = "text" size="10" name="fileID" autocomplete="off"><br/>
  Send these files:<br />
  <input name="filename0" type="file" /><br />
  <input name="filename1" type="file" /><br />
  <input name="filename2" type="file" /><br />
  <input name="filename3" type="file" /><br />
  <input name="filename4" type="file" /><br />
  <input name="filename5" type="file" /><br />
  <input name="filename6" type="file" /><br />
  <input name="filename7" type="file" /><br />
  <input name="filename8" type="file" /><br />
  <input name="filename9" type="file" /><br />
  <input name="filename10" type="file" /><br />
  <input type="submit" value="Send files" onClick="return validate();" /><br/>
  <b><font color="red" name ="ErrorMessage" id="ErrorMessage" size="6"></font></b>
</form>		
<?php 
		if ($_FILES)
		{
		    if ($_POST['fileID'] != ''){
			  $pictures = "../pictures/$_POST[fileID]/";
			  $videos = "../videos/$_POST[fileID]/";
			  @mkdir($pictures);
			  @mkdir($videos);
			}
			else
			  $pictures = "../pictures/";
			  $videos = "../videos/";
			for($i=0;$i<=10;$i++){
				$filename = "filename"."$i";
				$name = $_FILES["$filename"]['name'];
				$ext = strtolower(substr($name,strpos($name,".") + 1));
				if ($ext == 'gif') $n = "../pdf/".$name;
				else if ($ext == 'gif' 
					  || $ext == 'png'
					  || $ext == 'jpg'
					  || $ext == 'tif'
					  ) $n = $pictures.$name;
				else if ($ext == 'mp4' || $ext == 'swf' || $ext == 'flv') $n = $videos.$name;
				else $n = '';
				//echo $n;
				if ($n != ''){
					if(!move_uploaded_file($_FILES["$filename"]['tmp_name'], $n)) echo  "Upload failed!";
					else echo  "Please remeber your ID: <br />";
				}
			}
		}
		else echo "No file has been uploaded";
?>
<br/><font color="red">It will see by everyone come to this site after upload</font>
</body>
</html>