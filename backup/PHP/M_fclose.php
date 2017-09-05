<?php
$file = fopen("M_fclose.php", "r");

//Output a line of the file until the end is reached
while(! feof($file))
{
  $current_line = fgets($file);
  if (!feof($file)) {   /* You can put an additional test for feof() inside the loop to avoid the infinite loop */
    echo $current_line. "<br />";
  }
}

fclose($file);
?>