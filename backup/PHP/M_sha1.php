Note that the sha1 algorithm has been compromised and is no longer being used by government agencies.
As of PHP 5.1.2 a new set of hashing functions are available.
http://www.php.net/manual/en/function.hash.php
The new function hash() supports a new range of hashing methods.
echo hash('sha256', 'The quick brown fox jumped over the lazy dog.');
It is recommended that developers start to future proof their applications by using the stronger sha-2, hashing methods such as sha256, sha384, sha512 or better.
As of PHP 5.1.2 hash_algos() returns an array of system specific or registered hashing algorithms methods that are available to PHP.
print_r(hash_algos());<br/>
==============================================================<br/>

<?php
echo hash('sha256', 'The quick brown fox jumped over the lazy dog.');
echo "<br/>";
echo hash('sha256', 'The quick brown fox jumped over the lazy dog.');
echo "<br/>";

print_r(hash_algos());