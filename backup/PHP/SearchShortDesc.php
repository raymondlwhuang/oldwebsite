<?php
require_once '../config.php';
$SearchGroup = $_REQUEST['SearchGroup'];
$SearchGroup = mysql_real_escape_string($SearchGroup);

if($SearchGroup != '')
	$query = "SELECT id, ShortDesc,Name FROM main where SearchGroup = '$SearchGroup' order by ShortDesc";
else
	$query = "SELECT id, ShortDesc,Name FROM main order by ShortDesc";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());

$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{

	echo substr('00000'.mysql_result($result,$j,'id'). ':', -7);
	echo mysql_result($result,$j,'ShortDesc').':'.mysql_result($result,$j,'Name'). ':::';
}
?>