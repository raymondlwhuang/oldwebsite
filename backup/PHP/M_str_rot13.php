You can use the function here to replace str_rot13<br/>
<?php
function str_rot($s, $n = 13) {
    $n = (int)$n % 26;
    if (!$n) return $s;
    for ($i = 0, $l = strlen($s); $i < $l; $i++) {
        $c = ord($s[$i]);
        if ($c >= 97 && $c <= 122) {
            $s[$i] = chr(($c - 71 + $n) % 26 + 97);
        } else if ($c >= 65 && $c <= 90) {
            $s[$i] = chr(($c - 39 + $n) % 26 + 65);
        }
    }
    return $s;
}
echo 'str_rot13("Hello World")';
echo "<br />";
echo str_rot13("Hello World");
echo "<br />";
echo 'str_rot13("Uryyb Jbeyq")';
echo "<br />";
echo str_rot13("Uryyb Jbeyq");
echo "<br />";
echo 'str_rot("Hello World",14);';
echo "<br />";
echo str_rot("Hello World",14);
echo "<br />";
echo 'str_rot("Vszzc Kcfzr",-14);';
echo "<br />";
echo str_rot("Vszzc Kcfzr",-14);
?>