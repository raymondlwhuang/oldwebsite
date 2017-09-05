<?php
$pw1 = "yeah";
$pw2 = "yeah";
echo 'Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal. ';
echo "<br/>";
if (strcmp($pw1, $pw2) == 0) {   // This returns false.
    echo '$pw1 and $pw2 are the same.';
} else {
    echo '$pw1 and $pw2 are NOT the same.';
}
echo "<br/>";
if (strcmp($pw1, $pw2)) {   // This returns false.
    echo '$pw1 and $pw2 are the same.';
} else {
    echo '$pw1 and $pw2 are NOT the same.';
}
echo "<br/>";
//Where the use of the == operator would give us.:
if ($pw1==$pw2) {    // This returns true.
    echo '$pw1 and $pw2 are the same.';
} else {
    echo '$pw1 and $pw2 are NOT the same.';
}