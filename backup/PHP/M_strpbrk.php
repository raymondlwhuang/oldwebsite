<?php
echo 'This function returns the rest of the string from where it found the first occurrence of a specified character, otherwise it returns FALSE.';
echo "<br/>";
$text = 'This is a Simple text.';

// this echoes "is is a Simple text." because 'i' is matched first
echo 'strpbrk($text, "mi");';
echo "<br/>";
echo strpbrk($text, "mi");
echo "<br/>";

// this echoes "Simple text." because chars are case sensitive
echo 'strpbrk($text, "S");';
echo "<br/>";
echo strpbrk($text, "S");
echo "<br/>";

?>