<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Slide Show</title>
</head>
<body>
<script type="text/javascript" src="../scripts/fancydropdown.js"></script>
<script type="text/javascript" src="../scripts/jquery.cycle.all.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#slider-container').cycle({
        fx:     'uncover',
        speed:  1000,
        timeout: 7000,
		pause:	1,
        pager:  '#banner-nav'
	});
});
</script>
<?php
$dirPath = "../pictures/";
function traverseDir( $dir ) {
$countimg = 0;
  if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );
  $files = array();
  while ( $file = readdir( $handle ) ) {
    if ( $file != "." && $file != ".." ) {
      if ( is_dir( $dir . "/" . $file ) ) $file .= "/";
      $files[] = $file;
    }
  }
  sort( $files );
?>
<script type="text/javascript">
    var j = <?php echo count($files); ?>;
	var adpictures = new Array(j);
	var i = 0;
</script>
<?php
echo '<div style="overflow: hidden;" id="slider-container">';
  foreach ( $files as $file ) {
  $countimg++;
  $content ='<div style="position: absolute; top: 0px; left: -855px; display: none; z-index: 5; opacity: 1; " id="banner'."$countimg".'">';
  $content = "$content"."<img src='../pictures/$file' alt='Register' usemap='#mail-info' border='0'>";
  $content = "$content".'</div>';
  echo "$content";
	  foreach ( $files as $file ) {
		if ( substr( $file, -1 )  == "/" ) traverseDir( "$dir/" . substr( $file, 0, -1 ) );
	  }
  };
  closedir( $handle );
echo '</div>';
}
traverseDir( $dirPath );
?>
</body>
</html>