<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catcha Refreshing</title>
<script type="text/javascript">
function reload()    {        
	var img = new Image();        
	img.src = '../PHP/CaptchaSecurityImages.php?rand=' + Math.random();        
	var x = document.getElementById('captcha');        
	x.src = img.src;    
}
</script>
</head>
<body>
        seems we need to install the 'gd libraries' to make it works
	<?php echo "need to upload to the server to make it works"; ?>
	<a href="" onclick="reload();return false;">Reload</a></br>
	<img src="../PHP/CaptchaSecurityImages.php" alt="captcha image" id="captcha">

</body>
</html>