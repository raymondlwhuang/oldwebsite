<?php
$video = $_REQUEST["video"];
if(isset($_REQUEST["VideoWidth"])) $VideoWidth = (int)$_REQUEST["VideoWidth"]; 
else $VideoWidth = 320;  
?>
<video id="OnShow" width="<?php echo $VideoWidth; ?>" controls="controls" onClick="VideoShow('<?php echo $video ?>')">
  <source src="<?php echo $video ?>mp4" type="video/mp4" />
  <source src="<?php echo $video ?>ogg" type="video/ogg" />
  <source src="<?php echo $video ?>ogv" type="video/ogv" />
  <source src="<?php echo $video ?>webm" type="video/webm" />
  <source src="<?php echo $video ?>mp4video.mp4" type="video/mp4" />
  <source src="<?php echo $video ?>theora.ogv" type="video/ogg" />
  <source src="<?php echo $video ?>webmvp8.webm" type="video/webm" />
  Your browser does not support the video tag.
</video>