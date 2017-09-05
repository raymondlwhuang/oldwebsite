<?php
foreach (glob("../PHP/*") as $path) { //configure path
    $docs[$path] = filectime($path);
} arsort($docs); // sort by value, preserving keys

foreach ($docs as $path => $timestamp) {
    print date("d. M. Y: ", $timestamp);
    print '<a href="'. $path .'">'. basename($path) .'</a><br />';
}
?>