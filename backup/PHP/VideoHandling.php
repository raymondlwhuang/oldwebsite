<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../scripts/VideoSelect.js"></script>
	<title>Select and Go Navigation</title>
</head>
<body bgcolor="#FFFFFF">
		<div align="center">
			<form name="f1" method='post'>
				<select id="newLocation" name="SetShow">
				<option value="../video/movie.mp4" selected>Select a show</option>
				<?php 
				$dir='../videos/';
				$dh = opendir($dir);
				$i=1;
				while ($filename=readdir($dh)){
					if(preg_match('/^.+\.mp4$|^.+\.flv$|^.+\.wmv$|^.+\.swf$/', $filename)){		// | mean or
						$gallery[]=$filename;
					} 
				}
				foreach ($gallery as $vedio){
					if($i==1)  echo "<option value='$vedio'  selected='selected'>$vedio</option>";
					else echo "<option value='$vedio'>$vedio</option>";
					$i++;
				}
				echo "</select>";
				?>
				</form> 
		</div>	
</body>
</html>

