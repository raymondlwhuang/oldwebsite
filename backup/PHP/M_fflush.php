<?php
$filename = 'date.txt';

$file = fopen($filename, 'r+');
rewind($file);
fwrite($file, 'Foo Bar Tea Apple');
fflush($file);
ftruncate($file, ftell($file));
fclose($file);
?>