<?php
echo 'function that prints out everything from the starting path to the end';
echo "<br/>";
map_dirs("../",0);

function map_dirs($path,$level) {
        if(is_dir($path)) {
                if($contents = opendir($path)) {
                        while(($node = readdir($contents)) !== false) {
                                if($node!="." && $node!="..") {
                                        for($i=0;$i<$level;$i++) echo "  ";
                                        if(is_dir($path."/".$node)) echo "../"; else echo " ";
                                        echo $node."<br/>";
                                        map_dirs("$path/$node",$level+1);
                                }
                        }
                }
        }
}
?>