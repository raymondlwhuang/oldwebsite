<?php
$orig = "I'll \"walk\" the <b>dog</b> now";

$a = htmlentities($orig);

$b = html_entity_decode($a);
echo $orig;
echo "</br>";
echo $a; // I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now
echo "</br>";
echo $b; // I'll "walk" the <b>dog</b> now