money_format() is only defined if the system has strfmon capabilities. For example, Windows does not, so money_format() is undefined in Windows.
<?php

$number = 1234.56;

// let's print the international format for the en_US locale
setlocale(LC_MONETARY, 'en_US');
echo money_format('%i', $number) . "</br>";
// USD 1,234.56

// Italian national format with 2 decimals`
setlocale(LC_MONETARY, 'it_IT');
echo money_format('%.2n', $number) . "</br>";
// Eu 1.234,56

// Using a negative number
$number = -1234.5672;

// US national format, using () for negative numbers
// and 10 digits for left precision
setlocale(LC_MONETARY, 'en_US');
echo money_format('%(#10n', $number) . "</br>";
// ($        1,234.57)

// Similar format as above, adding the use of 2 digits of right
// precision and '*' as a fill character
echo money_format('%=*(#10.2n', $number) . "</br>";
// ($********1,234.57)

// Let's justify to the left, with 14 positions of width, 8 digits of
// left precision, 2 of right precision, withouth grouping character
// and using the international format for the de_DE locale.
setlocale(LC_MONETARY, 'de_DE');
echo money_format('%=*^-14#8.2i', 1234.56) . "</br>";
// Eu 1234,56****

// Let's add some blurb before and after the conversion specification
setlocale(LC_MONETARY, 'en_GB');
$fmt = 'The final value is %i (after a 10%% discount)';
echo money_format($fmt, 1234.56) . "</br>";
// The final value is  GBP 1,234.56 (after a 10% discount)

?>