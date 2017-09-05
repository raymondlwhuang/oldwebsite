<?php
	if(!isset( $_COOKIE["greeting"] )) setcookie( "greeting", "Welcome back ", time() + 60 * 60 * 24 * 365, "", "", false, true );
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>My Helping Site</title>
<style type="text/css" media="screen">
div#backdrop {
	width:985px;
	margin:auto;
	position:relative;
	top:80px;
	font-size:26px;
}
.pointer { cursor: pointer }
</style>	
</head>
<body>
<div id="backdrop" style="display:block;">

I create this site is intentional for personal use and I start working on it in about half years ago(use my spare time after work). Now I use it as an example due to argent job search.
I have not fully tested it yet. Please understand it might have lot of bugs in it. If you fund any please let me know. With my promise I will fix whatever bugs you found within 24 hours.

Also because this site is for picture and video display. It require that you have the <br/><font color="red">latest version of browser with JavaScript and cookie enabled</font>.<br/><br/>
Thanks for visiting my site.<br/><br/>
<font style="font-size:50px;">RAYMOND</font>
<br/><br/>
<center><button class="pointer"  style="font-size:36px;" onclick=\'window.open("index.php",target="_top");\'>Click here to main page</button></center>
</div>
</body>
</html>';
