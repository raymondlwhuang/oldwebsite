<html>

<head>

<title></title>
<script type="text/javascript" src="jquery-1.4.2.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	
	$('#login_btn').mouseover(function () {
		$(this).attr('src', 'images/go-btn-over.jpg');
	});

	$('#login_btn').mouseout(function () {
		$(this).attr('src', 'images/go-btn.jpg');
	});

	
});
</script>
</head>

<body>
<img src="images/go-btn.jpg" width="107" height="27" id="login_btn">
<form>
<input type="image" onMouseOver="this.src='images/go-btn-over.jpg'" onMouseOut="this.src='images/go-btn.jpg'" src="images/go-btn.jpg" name="Image6" width=107 height=27 border="0">
</form>
</body>

</html>
