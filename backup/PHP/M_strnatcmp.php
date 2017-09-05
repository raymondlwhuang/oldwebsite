<?php
echo "string '2Hello world!' is less than: '10Hello world!'";
echo "<br />";
echo strnatcmp("2Hello world!","10Hello world!");
echo "<br />";
echo "string '10Hello world!' is greater than: '2Hello world!'";
echo "<br />";
echo strnatcmp("10Hello world!","2Hello world!");
echo "<br />";
echo "string 'Hello world!' is less than: 'hello world!'";
echo "<br />";
echo strnatcmp("Hello world!","hello world!");
echo "<br />";
echo "string '10hello world!' is less than: '12Hello world!'";
echo "<br />";
echo strnatcmp("10hello world!","12Hello world!");

?>