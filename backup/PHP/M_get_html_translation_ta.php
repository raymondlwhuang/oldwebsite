<?php
$trans = get_html_translation_table(HTML_ENTITIES);
$str = "Hallo & <Frau> & Kr�mer";
$encoded = strtr($str, $trans);

echo $encoded;
?>