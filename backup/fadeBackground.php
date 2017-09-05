<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Disable and fade out background</title>

<style type="text/css">
.black_overlay {
background-image: url(dim_transparent_red.png);
display:none;
height:100%;
padding:750px 0;
left:0;
opacity:0.7;
position:fixed;
_position:absolute;
top:0;
width:100%;
position:absolute;
z-index:1;
}
.content_overlay {
	background:#fff;
	width:440px;
	position:absolute;
	left:50%;
	margin-left:-253px;
	z-index:10;
	top:125px;
	border:3px solid #12465e;
	padding:25px 25px 10px;
	display:none;
}
</style>
</head>

<body>
<div id="fade" class="unitPng black_overlay" style="display:none;">
</div> <!--- end black --->
<div id="wrapper" style="display:block;" align="center">
    <table width="175" height="156" border="0">
      <tr>
        <td width="150" align="center"><img src="next_green.jpg" width="120" height="150" /></td>
      </tr>
      <tr>
        <td height="30" align="center" class="profilenames">DimondBubbles <span class="profileages">29/F</span></td>
      </tr>
    </table>
</div>

<div class="content_overlay" id="step1overlay" style="display: none;">

	<div class="form trueLpForm">
		<form method="post" id="register_form" action="index2.php"  onsubmit="return validateZip_postal();">
			<div id="fieldzip" class="field" style="display: block;">
				<label for="zip_postal">Postal Code:</label>
				<input id="zip_postal" name="zip_postal" type="text" maxlength="7">
			</div>
		</form>
	</div>

</div>
<script type="text/javascript">

function showForm() {
document.getElementById('fade').style.display = "block";
document.getElementById('step1overlay').style.display = "block";
}

document.getElementById('step1overlay').style.display = "none";
document.getElementById('wrapper').style.display = "block";
setTimeout("showForm()",3800);
</script>
</body>
</html>
