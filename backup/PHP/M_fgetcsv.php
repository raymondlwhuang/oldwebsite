<?php
$filename = 'date.txt';

$file = fopen($filename, 'r+');
rewind($file);
fwrite($file, 'Foo,Bar,Tea,Apple');
fflush($file);
ftruncate($file, ftell($file));
fclose($file);


$file = fopen("date.txt","r");
print_r(fgetcsv($file));
fclose($file);
?>