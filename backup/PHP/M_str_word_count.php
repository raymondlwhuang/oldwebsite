We can also specify a range of values for charlist.

<?php
$str = "Hello fri3nd, you're
       looking          good today!
       look1234ing";
echo str_word_count($str);
echo '<br/>';
echo str_word_count($str,1);
echo '<br/>';
echo str_word_count($str,2);
echo '<br/>';
print_r(str_word_count($str, 1, '0..3'));
?> 		