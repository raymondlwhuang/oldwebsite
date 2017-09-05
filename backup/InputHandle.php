<html>

<head>

<title></title>

</head>

<body>
<form>
<select name="country" class="formfielddropdown" id="country" onchange="document.getElementById('CountryName').value = this.options[selectedIndex].text" style="width: 200px;">
<option value="1">Asia/Pacific Region</option>
<option value="3">Andorra</option>
</select>
<input type="text" name="CountryName" id='CountryName'>
</form>
</body>

</html>
