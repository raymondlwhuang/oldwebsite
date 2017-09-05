<?php
echo 'stristr("Hello world!","WORLD");';
echo stristr("Hello world!","WORLD");
echo "<br/>";
$unencripted = "hello";
$from = "abcdefghijklmnopqrstuvwxyz";
$to =    "zyxwvutsrqponmlkjihgfedcba";
$temp = strtr($unencripted, $from, $to);
echo $temp;
echo "<br/>";
echo 'strtr("svool", $from, $to);';
echo "<br/>";
echo strtr("svool", $from, $to);
echo "<br/>";
echo 'To convert special chars to their html entities strtr you can use strtr in conjunction with get_html_translation_table(HTML_ENTITIES) :';
echo "<br/>";
echo "<br/>";
echo "<br/>";
$trans = get_html_translation_table(HTML_ENTITIES);
$html_code = strtr($html_code, $trans); 

echo 'Here is a function to convert middle-european windows charset (cp1250) to the charset, that php script is written in:';
    function cp1250_to_utf2($text){
        $dict  = array(chr(225) => 'á', chr(228) =>  'ä', chr(232) => '&#269;', chr(239) => '&#271;',
            chr(233) => 'é', chr(236) => '&#283;', chr(237) => 'í', chr(229) => '&#314;', chr(229) => '&#318;',
            chr(242) => '&#328;', chr(244) => 'ô', chr(243) => 'ó', chr(154) => 'š', chr(248) => '&#345;',
            chr(250) => 'ú', chr(249) => '&#367;', chr(157) => '&#357;', chr(253) => 'ý', chr(158) => 'ž',
            chr(193) => 'Á', chr(196) => 'Ä', chr(200) => '&#268;', chr(207) => '&#270;', chr(201) => 'É',
            chr(204) => '&#282;', chr(205) => 'Í', chr(197) => '&#313;',    chr(188) => '&#317;', chr(210) => '&#327;',
            chr(212) => 'Ô', chr(211) => 'Ó', chr(138) => 'Š', chr(216) => '&#344;', chr(218) => 'Ú',
            chr(217) => '&#366;', chr(141) => '&#356;', chr(221) => 'Ý', chr(142) => 'Ž',
            chr(150) => '-');
        return strtr($text, $dict);
    }
?>