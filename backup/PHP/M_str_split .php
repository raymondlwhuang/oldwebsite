<?php
function str_rsplit($str, $sz)
{
    // splits a string "starting" at the end, so any left over (small chunk) is at the beginning of the array.   
    if ( !$sz ) { return false; }
    if ( $sz > 0 ) { return str_split($str,$sz); }    // normal split
   
    $l = strlen($str);
    $sz = min(-$sz,$l);
    $mod = $l % $sz;
   
    if ( !$mod ) { return str_split($str,$sz); }    // even/max-length split

    // split
    return array_merge(array(substr($str,0,$mod)), str_split(substr($str,$mod),$sz));
}

$str = 'aAbBcCdDeEfFg';
str_split($str,5); // return: {'aAbBc','CdDeE','fFg'}
str_rsplit($str,5); // return: {'aAbBc','CdDeE','fFg'}
str_rsplit($str,-5); // return: {'aAb','BcCdD','eEfFg'}

?>		