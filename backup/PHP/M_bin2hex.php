<?php 
function hex4email ($string,$charset) 
{ 
    $string=bin2hex ($string); 
    $encoded = chunk_split($string, 2, '='); 
    $encoded=preg_replace ("/=$/","",$encoded); 
    $string="=?$charset?Q?".$encoded."?="; 
    
return $string; 
} 
echo hex4email('raymondlwhuang@yahoo.com','=');
?>