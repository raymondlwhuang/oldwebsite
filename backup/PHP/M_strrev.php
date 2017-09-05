<?php
echo 'strrev("Hello World!");';
echo "<br/>";
echo strrev("Hello World!");
echo "<br/>";
echo 'Add commas to numbers: 1500000.1254';
echo "<br/>";
echo commafy("1500000.1254"); // prints 1,500,000.1254
echo "<br/>";
function commafy($_) {
        return strrev( (string)preg_replace( '/(\d{3})(?=\d)(?!\d*\.)/', '$1,' , strrev( $_ ) ) );
}

?>