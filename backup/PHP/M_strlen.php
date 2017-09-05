<?php
echo 'strlen("Hello world!");';
echo "<br/>";
echo strlen("Hello world!");
echo "<br/>";
echo 'Beware: strlen() counts new line characters at the end of a string, too! ';
echo "<br/>";
echo 'strlen("123\n");';
echo "<br/>";
$a = "123\n";
echo "<p>".strlen($a)."</p>"; 
echo "<br/>";
?>