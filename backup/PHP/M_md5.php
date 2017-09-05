<?php
$str = 'apple';

if (MD5($str) === '1f3870be274f6c49b3e31a0c6728957f') {
    echo "Would you like a green or red apple?</br>";
}
?>		
It is not recommended to use this function to secure passwords, due to the fast nature of this hashing algorithm.