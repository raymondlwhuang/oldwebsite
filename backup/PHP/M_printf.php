<?php
echo 'sprintf()-Writes a formatted string to a variable,<br/>
vprintf()-Outputs a formatted string, <br/>
sscanf()-Parses input from a string according to a format, <br/>
fscanf()-Parses input from a file according to a format,  <br/>
vsprintf()-Return a formatted string
vfprintf()-Write a formatted string to a stream <br/>';
echo "<br/>";
$file = "test.txt"; $lines = 7;
echo '$file = "test.txt"; $lines = 7';
echo "<br/>"; 
echo 'printf("The file %s consists of %d lines\n", $file, $lines)';
echo "<br/>"; 
printf("The file %s consists of %d lines\n", $file, $lines);
// returns --> The file test.txt consists of 7 lines
echo "<br/>"; 
 
// padding something, prefix a string with "_"
$word = 'foobar';
echo '$word = "foobar";';
echo "<br/>"; 
echo 'printf("%\'_10s\n", $word)';
echo "<br/>"; 
printf("%'_10s\n", $word);
// returns --> ____foobar
 echo "<br/>"; 
 
// format a number:
$number = 100.85995;
echo '$number = 100.85995;';
echo "<br/>"; 
echo 'printf("%03d\n", $number);';
echo "<br/>"; 
printf("%03d\n", $number); // returns --> 100
echo "<br/>"; 
echo 'printf("%01.2f\n", $number);';
echo "<br/>"; 
printf("%01.2f\n", $number); // returns --> 100.86
echo "<br/>"; 
echo 'printf("%01.3f\n", $number);';
echo "<br/>"; 
printf("%01.3f\n", $number); // returns --> 100.860
 echo "<br/>"; 
 
// parse a string with sscanf #1
list($number) = sscanf("ID/1234567","ID/%d");
echo 'list($number) = sscanf("ID/1234567","ID/%d");';
echo "<br/>"; 
echo 'print "$number\n";';
echo "<br/>"; 
print "$number\n";
// returns --> 1234567
 echo "<br/>"; 
 
// parse a string with sscanf #2
$test = "string 1234 string 5678";
$result = sscanf($test, "%s %d %s %d");
echo '$test = "string 1234 string 5678";';
echo "<br/>"; 
echo '$result = sscanf($test, "%s %d %s %d");';
echo "<br/>";
echo 'print_r($result);';
echo "<br/>";
print_r($result);
 
/*
 
--> returns:
 
Array
(
    [0] => string
    [1] => 1234
    [2] => string
    [3] => 5678
)
 
*/
echo <<<_END
<pre>
    % - a literal percent character. No argument is required.
    b - the argument is treated as an integer, and presented as a binary number.
    c - the argument is treated as an integer, and presented as the character with that ASCII value.
    d - the argument is treated as an integer, and presented as a (signed) decimal number.
    e - the argument is treated as scientific notation (e.g. 1.2e+2). The precision specifier stands for the number of digits after the decimal point since PHP 5.2.1. In earlier versions, it was taken as number of significant digits (one less).
    E - like %e but uses uppercase letter (e.g. 1.2E+2).
    u - the argument is treated as an integer, and presented as an unsigned decimal number.
    f - the argument is treated as a float, and presented as a floating-point number (locale aware).
    F - the argument is treated as a float, and presented as a floating-point number (non-locale aware). Available since PHP 4.3.10 and PHP 5.0.3.
    g - shorter of %e and %f.
    G - shorter of %E and %f.
    o - the argument is treated as an integer, and presented as an octal number.
    s - the argument is treated as and presented as a string.
    x - the argument is treated as an integer and presented as a hexadecimal number (with lowercase letters).
    X - the argument is treated as an integer and presented as a hexadecimal number (with uppercase letters).
</pre>
_END;
echo "<br/>"; 