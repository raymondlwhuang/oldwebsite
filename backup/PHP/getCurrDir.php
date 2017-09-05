<?php
define('APPLICATION_ROOT', dirname(__FILE__));
echo "APPLICATION_ROOT : ".APPLICATION_ROOT."<br/>";
echo "LINE : ".__LINE__."<br/>";
echo "FILE : ". __FILE__."<br/>";
echo "DIR : ". __DIR__."<br/>";
echo "FUNCTION : ". __FUNCTION__."<br/>";
echo "CLASS : ". __CLASS__."<br/>";
echo "METHOD : ". __METHOD__."<br/>";
echo "NAMESPACE : ". __NAMESPACE__."<br/>";
// need to know the following
//chdir($dir);
//$dh = opendir($dir);
//getdir($dir)
?>