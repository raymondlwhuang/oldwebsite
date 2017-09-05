<?php
echo strncasecmp("Hello world!","hello earth!",6);
echo "<br/>";
if (!strncasecmp("Hello world!", 'hello earth!', 4)){
       echo "true";
}

?>