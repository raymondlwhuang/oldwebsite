<?php
echo 'str_ireplace("WORLD","Peter","Hello world!");';
echo '<br/>';

echo str_ireplace("WORLD","Peter","Hello world!");
echo '<br/>----------------------------------<br/>';
echo '$arr = array("blue","red","green","yellow");';
echo '<br/>';
echo 'print_r(str_ireplace("RED","pink",$arr,$i));';
echo '<br/>';
$arr = array("blue","red","green","yellow");
print_r(str_ireplace("RED","pink",$arr,$i));
echo "Replacements: $i";
echo '<br/>----------------------------------<br/>';
echo '$find = array("HELLO","WORLD");';
echo '<br/>';echo '$replace = array("B");';
echo '<br/>';echo '$arr = array("Hello","world","!");';
echo '<br/>';echo 'print_r(str_ireplace($find,$replace,$arr));';
echo '<br/>';
$find = array("HELLO","WORLD");
$replace = array("B");
$arr = array("Hello","world","!");
print_r(str_ireplace($find,$replace,$arr));
?>