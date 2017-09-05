<?php
$string1='ww3resource';
$string2='W3resource';
$result=strcasecmp($string1,$string2);
echo 'The result for "ww3resource" in a case-insensitive string comparison with "W3resource" is:'. $result;
echo "<br/>";
$var1 = "Hello";
$var2 = "hello";
if (strcasecmp($var1, $var2) == 0) {
    echo '$var1 is equal to $var2 in a case-insensitive string comparison';
}

?>