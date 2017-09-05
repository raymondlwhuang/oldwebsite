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
        $dict  = array(chr(225) => '�', chr(228) =>  '�', chr(232) => '&#269;', chr(239) => '&#271;',
            chr(233) => '�', chr(236) => '&#283;', chr(237) => '�', chr(229) => '&#314;', chr(229) => '&#318;',
            chr(242) => '&#328;', chr(244) => '�', chr(243) => '�', chr(154) => '�', chr(248) => '&#345;',
            chr(250) => '�', chr(249) => '&#367;', chr(157) => '&#357;', chr(253) => '�', chr(158) => '�',
            chr(193) => '�', chr(196) => '�', chr(200) => '&#268;', chr(207) => '&#270;', chr(201) => '�',
            chr(204) => '&#282;', chr(205) => '�', chr(197) => '&#313;',    chr(188) => '&#317;', chr(210) => '&#327;',
            chr(212) => '�', chr(211) => '�', chr(138) => '�', chr(216) => '&#344;', chr(218) => '�',
            chr(217) => '&#366;', chr(141) => '&#356;', chr(221) => '�', chr(142) => '�',
            chr(150) => '-');
        return strtr($text, $dict);
    }
?>