<meta http-equiv="refresh" content="1">
<?php

require_once('inc/chat.inc.php');
$oSimpleChat = new SimpleChat();
echo $oSimpleChat->getMessages();

?>