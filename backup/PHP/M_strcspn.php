<?php
echo "use of strcspn()";
echo "<br/>";
echo "Number of characters before 'w' is: ".strcspn("Hello world!","w")." in 'Hello world!'";
echo "<br/>";
echo "Number of characters before 'wo' is: ". strcspn("Hello world!","wo")." in 'Hello world!'";
?>