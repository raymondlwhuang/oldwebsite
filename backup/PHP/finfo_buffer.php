<?php
function getUrlMimeType($url) {
    $buffer = file_get_contents($url);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return $finfo->buffer($buffer);
}
$tst = getUrlMimeType('http://www.raymondlwhuang.com/AddSpending.php');
var_dump($tst);
?>