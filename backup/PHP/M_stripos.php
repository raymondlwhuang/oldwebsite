<?php
echo 'stripos("Hello world!","WO");';
echo stripos("Hello world!","WO");
echo "<br/>";
$findme    = 'a';
$mystring1 = 'xyz';
$mystring2 = 'ABCA';

$pos1 = stripos($mystring1, $findme);
$pos2 = stripos($mystring2, $findme);

// Nope, 'a' is certainly not in 'xyz'
if ($pos1 === false) {
    echo "The string '$findme' was not found in the string '$mystring1'";
    echo "<br/>";
}

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' is the 0th (first) character.
if ($pos2 !== false) {
    echo "We found '$findme' in '$mystring2' at position $pos2";
    echo "<br/>";
}
?>