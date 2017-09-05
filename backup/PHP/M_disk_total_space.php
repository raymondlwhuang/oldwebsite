<?php
// $ds contains the total number of bytes available on "/"
$ds = @disk_total_space("/");
echo $ds;
echo '<br/>';
// On Windows:
$ds = @disk_total_space("C:");
echo $ds;
echo '<br/>';
?>
		