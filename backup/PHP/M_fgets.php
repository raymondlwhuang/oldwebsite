<?php
$myfile = 'date.txt';
$command = "tac $myfile > /tmp/myfilereversed.txt";
passthru($command);
$ic = 0;
$ic_max = 100;  // stops after this number of rows
$handle = fopen("/tmp/myfilereversed.txt", "r");
while (!feof($handle) && ++$ic<=$ic_max) {
   $buffer = fgets($handle, 4096);
   echo $buffer."<br>";
}
fclose($handle);
?>