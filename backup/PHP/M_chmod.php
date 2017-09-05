<?php
echo 'Changes directories/file mode recursive in $pathname to $filemode';
echo '<pre>
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pathname), RecursiveIteratorIterator::SELF_FIRST);

foreach($iterator as $item) {
    chmod($item, $filemode);
}

Usefull reference:

Value    Permission Level
400    Owner Read
200    Owner Write
100    Owner Execute
40    Group Read
20    Group Write
10    Group Execute
4    Global Read
2    Global Write
1    Global Execute
</pre>';
?>