<?php 
echo 'number_format(number,decimals,decimalpoint,separator)';

$number = 1234.56;

echo 'english notation (default): ';
$english_format_number = number_format($number);
echo $english_format_number."<br/>";
echo 'French notation: ';
$nombre_format_francais = number_format($number, 2, ',', ' ');
echo $nombre_format_francais."<br/>";

$number = 1234.5678;

echo 'english notation without thousands separator: ';
$english_format_number = number_format($number, 2, '.', '');
echo $english_format_number."<br/>";

?>