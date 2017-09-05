<?php
echo 'Only the superuser may change the group of a file arbitrarily; other users may change the group of a file to any group of which that user is a member. ';
echo '<br/>';
$filename = 'date.txt';
$format = "%s's Group ID @ %s: %d\n";
printf($format, $filename, date('r'), filegroup($filename));
echo '<br/>';
chgrp($filename, 8);
//chgrp($filename, "admin");
clearstatcache(); // do not cache filegroup() results
printf($format, $filename, date('r'), filegroup($filename));
echo '<br/>';
?>