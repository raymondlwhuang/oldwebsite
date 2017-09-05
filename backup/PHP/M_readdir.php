<?php
if ($handle = opendir('../images/')) {
   $dir_array = array();
    while (false !== ($file = readdir($handle))) {
        if($file!="." && $file!=".."){
            $dir_array[] = $file;
        }
    }
    $name = $dir_array[rand(0,count($dir_array)-1)];
	echo "<img src='../images/$name' alt='Angry face' />";
	
    closedir($handle);
}
?>