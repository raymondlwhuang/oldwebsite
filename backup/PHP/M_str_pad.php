<?php

$str = "test";

function str_pad_right ( $string , $padchar , $int ) {
    $i = strlen ( $string ) + $int;
    $str = str_pad ( $string , $i , $padchar , STR_PAD_RIGHT );
    return $str;
}
   
function str_pad_left ( $string , $padchar , $int ) {
    $i = strlen ( $string ) + $int;
    $str = str_pad ( $string , $i , $padchar , STR_PAD_LEFT );
    return $str;
}
   
function str_pad_both ( $string , $padchar , $int ) {
    $i = strlen ( $string ) + ( $int * 2 );
    $str = str_pad ( $string , $i , $padchar , STR_PAD_BOTH );
    return $str;
}

echo str_pad_left ( $str , "-" , 3 ); // Produces: ---test
echo '<br/>';
echo str_pad_right ( $str , "-" , 3 ); // Produces: test---
echo '<br/>';
echo str_pad_both ( $str , "-" , 3 ); // Produces: ---test---
?>		