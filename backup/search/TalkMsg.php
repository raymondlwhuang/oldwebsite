<?php
require_once '../config.php';
require_once('../PHP/sethash.php');
$SearchGroup = $_REQUEST['SearchGroup'];
$SearchGroup = mysql_real_escape_string($SearchGroup);
$SearchGroup = newencode($SearchGroup);
if($SearchGroup != '')
	$query = "SELECT * FROM talk_message where message LIKE '%$SearchGroup%' order by message";
else
	$query = "SELECT * FROM talk_message order by message";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());

$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
	echo newdecode(mysql_result($result,$j,'message')). ':::';
}
?>