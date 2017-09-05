<?php
include("../config.php");
$queryOwner="SELECT first_name FROM user where  1 LIMIT 1";
$owner=mysql_query($queryOwner);          // query executed 
echo mysql_error();
$row = mysql_fetch_assoc($owner)
 echo $row['first_name'];
	

?>