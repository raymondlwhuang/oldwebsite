<?php 
session_start();

$result = mysql_query($GetDisplay) or die(mysql_error());

while($row = mysql_fetch_array($result))
{
 $searchID=$row['id'];
 $ShortDesc=$row['ShortDesc'];
 $Source = $row['Source'];
 $Name =  $row['Name'];
 $Ext =  $row['Ext'];
 $SearchGroup =  $row['SearchGroup'];
} 
?>