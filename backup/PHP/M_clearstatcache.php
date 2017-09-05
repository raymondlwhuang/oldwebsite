<pre>
PHP caches data for some functions for better performance. If a file is being checked several times in a script, you might want to avoid caching to get correct results. To do this, use the clearstatcache() function.

Tip: Functions that are caching:

    stat()
    lstat()
    file_exists()
    is_writable()
    is_readable()
    is_executable()
    is_file()
    is_dir()
    is_link()
    filectime()
    fileatime()
    filemtime()
    fileinode()
    filegroup()
    fileowner()
    filesize()
    filetype()
    fileperms()
</pre>	
<?php
//check filesize
echo filesize("date.txt");
echo "<br />";

$file = fopen("date.txt", "a+");
// truncate file
ftruncate($file,100);
fclose($file);

//Clear cache and check filesize again
clearstatcache();
echo filesize("date.txt");
?> 	