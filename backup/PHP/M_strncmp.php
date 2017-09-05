<?php
echo strncmp("Hello world!","hello earth!",6);
echo "<br/>";
if (!strncmp("Hello world!", 'hello earth!', 4)){
       echo "true";
}
else echo "false";
?>