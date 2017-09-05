<?php
$foo = 'HelloWorld';
$foo = lcfirst($foo);             // helloWorld
echo $foo;
echo "</br>";
$bar = 'HELLO WORLD!';
$bar = lcfirst($bar);             // hELLO WORLD!
echo $bar;
echo "</br>";
$bar = lcfirst(strtoupper($bar)); // hELLO WORLD!
echo $bar;
?>