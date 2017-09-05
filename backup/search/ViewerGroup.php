<?php
require_once '../config.php';
$findme   = ':::';
$SearchString = mysql_real_escape_string($_REQUEST['SearchGroup']);
$pos = strpos($SearchString, $findme);
$SearchGroup = substr($SearchString,0,$pos);
$owner_path = substr($SearchString,($pos+3));

if($SearchGroup != '')
	$query = "SELECT allow_viewer_upload, viewer_group FROM viewer_group where viewer_group  LIKE '%$SearchGroup%' group by viewer_group";
else
	$query = "SELECT allow_viewer_upload, viewer_group FROM viewer_group where 1 group by viewer_group";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());

$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
//	echo mysql_result($result,$j,'allow_viewer_upload'). ':';
	echo mysql_result($result,$j,'viewer_group'). ':::';
}
?>