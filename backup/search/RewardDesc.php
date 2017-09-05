<?php
require_once '../config.php';
$SearchGroup = $_REQUEST['SearchGroup'];
$SearchGroup = mysql_real_escape_string($SearchGroup);

if($SearchGroup != '')
	$query = "SELECT id, description FROM kidsreward where description  LIKE '%$SearchGroup%' order by description";
else
	$query = "SELECT id, description FROM kidsreward order by description";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());

$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
	echo mysql_result($result,$j,'description'). ':::';
}
?>