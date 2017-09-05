<?php
$longstring = <<<STRINGBEGIN
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
<title>My Introduction Page</title> 
</head>
<frameset cols="130,*"  border="0" framespacing="0">
   <frame src="VideoSelect.php" frameborder=0 scrolling=no />
   <frame src="VideoShow.php" name="VideoMain" scrolling=yes />
</frameset>
STRINGBEGIN;
echo $longstring;
?>
