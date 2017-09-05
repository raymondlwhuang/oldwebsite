<?php
echo ("<h1>Directory Overzicht:</h1>");

function getFiles($path) {
   //Function takes a path, and returns a numerically indexed array of associative arrays containing file information,
   //sorted by the file name (case insensitive).  If two files are identical when compared without case, they will sort
   //relative to each other in the order presented by readdir()
   $files = array();
   $fileNames = array();
   $i = 0;
  
   if (is_dir($path)) {
       if ($dh = opendir($path)) {
           while (($file = readdir($dh)) !== false) {
               if ($file == "." || $file == "..") continue;
               $fullpath = $path . "/" . $file;
               $fkey = strtolower($file);
               while (array_key_exists($fkey,$fileNames)) $fkey .= " ";
               $a = stat($fullpath);
               $files[$fkey]['size'] = $a['size'];
               if ($a['size'] == 0) $files[$fkey]['sizetext'] = "-";
               else if ($a['size'] > 1024) $files[$fkey]['sizetext'] = (ceil($a['size']/1024*100)/100) . " K";
               else if ($a['size'] > 1024*1024) $files[$fkey]['sizetext'] = (ceil($a['size']/(1024*1024)*100)/100) . " Mb";
               else $files[$fkey]['sizetext'] = $a['size'] . " bytes";
               $files[$fkey]['name'] = $file;
               $files[$fkey]['type'] = filetype($fullpath);
               $fileNames[$i++] = $fkey;
           }
           closedir($dh);
       } else die ("Cannot open directory:  $path");
   } else die ("Path is not a directory:  $path");
   sort($fileNames,SORT_STRING);
   $sortedFiles = array();
   $i = 0;
   foreach($fileNames as $f) $sortedFiles[$i++] = $files[$f];
  
   return $sortedFiles;
}

$files = getFiles("./");
foreach ($files as $file) print "&nbsp;&nbsp;&nbsp;&nbsp;<b><a href=\"$file[name]\">$file[name]</a></b><br>\n";
?>