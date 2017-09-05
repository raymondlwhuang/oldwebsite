<?php
echo 'stripcslashes() skips special character sets like "\n" and "\r", preserving any line breaks, return carriages, etc. that may be in the string. stripslashes() simply removes any slashes it encounters without parsing anything beforehand.';
echo "<br/>";
echo 'stripcslashes("Hello, \my na\me is Kai Ji\m.");';
echo "<br/>";
echo stripcslashes("Hello, \my na\me is Kai Ji\m.");
echo "<br/>";
?>