<?php
$prevVars["foo"] = "foovalue";
$queryString = "bar=barvalue&stuff=stuffval";
$newVars = array();
parse_str($queryString, $newVars);

$vars = array_merge($prevVars, $newVars);
echo "<pre>";
print_r($vars);
echo "</pre>";
?>		