<?php
echo "<pre>";
echo 'wordwrap(string,width,break,cut) ';
echo "<br/>";
echo '$str = "An example on a long word is: Supercalifragulistic";';
echo "<br/>";
$str = "An example on a long word is: Supercalifragulistic";
echo "<br/>";
echo 'wordwrap($str,15);';
echo "<br/>";
echo wordwrap($str,15);
echo "<br/>";
echo "<br/>";
echo 'wordwrap($str,15,"<br />\n");';
echo "<br/>";
echo wordwrap($str,15,"<br />\n");
echo "<br/>";
echo 'echo wordwrap($str,15,"<br />\n",TRUE);';
echo "<br/>";
echo wordwrap($str,15,"<br />\n",TRUE);
echo "<br/>";
echo "</pre>";
?>