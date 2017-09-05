Be careful when replacing characters (or repeated patterns in the FROM and TO arrays)
<?php
echo '<pre>';
echo '<br/>';
$bodytag = str_replace("%body%", "black", "<body text='%body%'>");

// Provides: Hll Wrld f PHP
$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");

// Provides: You should eat pizza, beer, and ice cream every day
$phrase  = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy   = array("pizza", "beer", "ice cream");
$newphrase = str_replace($healthy, $yummy, $phrase);
echo $newphrase ;
echo '<br/>';
// Provides: 2
$str = str_replace("ll", "", "good golly miss molly!", $count);
echo $count;
echo '<br/>';
$str = ' This is    a    test   ';
echo $str ;
echo '<br/>';
$count = 1;
while($count)
    $str = str_replace('  ', ' ', $str, $count);

echo $str ;
echo '<br/>';
echo '</pre>';
?>