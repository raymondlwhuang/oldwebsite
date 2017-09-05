<?php
$str = '<p>this -&gt; &quot;</p>';

echo htmlspecialchars_decode($str);
echo "</br>";
// note that here the quotes aren't converted
echo htmlspecialchars_decode($str, ENT_NOQUOTES);
?>