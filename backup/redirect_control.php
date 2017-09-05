<?php
//session_start();
define('BASE_PATH', dirname(realpath(__FILE__)));

require 'lib/Controller.php';
require 'lib/Bootstrap.php';
//require 'lib/Model.php';
require 'lib/View.php';

$app = new Bootstrap();

?>