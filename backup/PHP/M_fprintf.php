<?php
if (!($fp = fopen('date.txt', 'w'))) {
    return;
}

fprintf($fp, "%04d-%02d-%02d", 2011, 08, 09);
echo "write to date.txt";
?>