<?php
function str_repeat_extended($input, $multiplier, $separator='')
{
    return $multiplier==0 ? '' : str_repeat($input.$separator, $multiplier-1).$input;
}

$tst = str_repeat_extended('this is a testing', 3, ';');
echo $tst;
?>		