<?php
echo '
    0 - if the two strings are equal<br/>
    <0 - if string1 (from startpos) is less than string2<br/>
    >0 - if string1 (from startpos) is greater than string2';
echo "<br/>";
echo 'substr_compare("abcde", "bc", 1, 2);';
echo "<br/>";
echo substr_compare("abcde", "bc", 1, 2); 
echo "<br/>";
echo 'substr_compare("abcde", "de", -2, 2);';
echo "<br/>";
echo substr_compare("abcde", "de", -2, 2);
echo "<br/>";
echo 'substr_compare("abcde", "bcg", 1, 2);';
echo "<br/>";
echo substr_compare("abcde", "bcg", 1, 2);
echo "<br/>";
echo 'substr_compare("abcde", "BC", 1, 2, true);';
echo "<br/>";
echo substr_compare("abcde", "BC", 1, 2, true);
echo "<br/>";
echo 'substr_compare("abcde", "bc", 1, 3);';
echo "<br/>";
echo substr_compare("abcde", "bc", 1, 3);
echo "<br/>";
echo 'substr_compare("abcde", "cd", 1, 2);';
echo "<br/>";
echo substr_compare("abcde", "cd", 1, 2);
echo "<br/>";
echo 'substr_compare("abcde", "abc", 5, 1);';
echo "<br/>";
echo substr_compare("abcde", "abc", 5, 1);
echo "<br/>";
?>