<?php
echo ord('A');
echo "</br>";
$str = "The string ends in a letter 'A': ";
$str .= chr(65); 
echo $str;
echo "</br>";
$str = sprintf("The string ends in a letter 'A': %c", 65);
echo $str;

?>