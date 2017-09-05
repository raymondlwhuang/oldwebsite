<?php
echo 'check file chmod value of ResultDisp.php';
echo "<br/>";
$file = "../ResultDisp.php";
$rights = decoct(fileperms($file));
echo "File rights: ".substr_replace($rights, "", 0, 3);

?>