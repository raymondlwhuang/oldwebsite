<?php
echo 'strspn("this is number of 42 is the answer to the 128th question.", "1234567890");';
$var = strspn("this is number of 42 is the answer to the 128th question.", "1234567890");
echo "<br/>";
echo $var;
echo "<br/>";
echo 'strspn("42 is the answer to the 128th question.", "1234567890");';
echo "<br/>";
$var = strspn("42 is the answer to the 128th question.", "1234567890");
echo $var;
echo "<br/>";
echo 'strspn("Hello world!","kHlleo");';
echo "<br/>";
echo strspn("Hello world!","kHlleo");
echo "<br/>";
echo 'strspn("hHello world!","kHlleo");';
echo "<br/>";
echo strspn("hHello world!","kHlleo");

?>