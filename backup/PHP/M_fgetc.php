<?php
$file = fopen("date.txt","r");

while (! feof ($file))
  {
  echo fgetc($file);
  }

fclose($file);

?>