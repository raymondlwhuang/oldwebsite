<?php
//Open images directory
$dir = opendir("../images");
echo getcwd();
echo "<br/>";
//List files in images directory
while (($file = readdir($dir)) !== false)
  {
  echo "filename: " . $file . "<br />";
  }

//Resets the directory stream
rewinddir($dir);

//Code to check for changes

closedir($dir);
echo getcwd();
echo "<br/>";
?>