<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="GetUserInfo.css" />
<script type="text/javascript" src="GetUserInfo.js"></script>

<SCRIPT language=JavaScript>
document.onmousedown=click
var times=0
var times2=10
function click() {
if ((event.button==2) || (event.button==3)) {
if (times>=3) { bye() }
alert("No right clicking!!!!!! don't do it again.."); 
times++ } }
function bye() {
alert("I said NO right clicking! click ok to exit LMAO!");
bye() }
</SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
</head>
<body>

<marquee style="color:#04B404;font-family:'Monotype Corsiva';font-size:x-large">Welcome</marquee>
<p style="font-family:'Times New Roman';font-size:8pt; color:red" id="reminder">
<blink>
<script type="text/javascript">
document.write("Window loading very slow for this free hosting service. Please wait.");
</script>
</blink>
<noscript>
More friendly if Javascript enabled		
</noscript>
</p></marquee>
<hr>
<hr>
<blockquote>
<?php include("Useresult.inc"); ?>
</blockquote>
<form name="ValidateUser" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="Post">
<div align="center"><center>
<font color=#ff8000 id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></font>
<br>
<br>
  <table border="0">
    <tr>
      <td><p class="invalid">Your Name:</p></td>
      <td><input type="text"  name="ContactName" size="50"  maxlength="50" id="ContactName" class="invalid reqd" 
      value="<?php if (isset($_POST['Employer'])){ echo htmlspecialchars($ContactName); } else ''; ?>" /></td>
    </tr>  
    <tr>
      <td><p>Company Name:</p></td>
      <td><input type="text"  name="Employer" size="50"  maxlength="50" id="Employer" class="reqd" value="<?php if (isset($_POST['Employer'])){ echo htmlspecialchars($Employer); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><p>What Position you offer:</p></td>
      <td><input type="text"  id="searchField" autocomplete="off" name="Title" size="50"  maxlength="50" id="Title" class="reqd" value="<?php if (isset($_POST['Title'])){ echo htmlspecialchars($Title); } else ''; ?>" /></td>
      <div id="popups"> </div>
    </tr>
    <tr>
      <td><p>E-Mail Address:</p></td>
      <td><input type="text"  id="searchDone" name="EMail" size="50"  maxlength="50" id="EMail" class="email" value="<?php if (isset($_POST['EMail'])){ echo htmlspecialchars($EMail); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><p>What Skill I need to have for this position:</p></td>
      <td><input type="text"  name="ProgrammingLanguages" size="50"  maxlength="255" id="ProgrammingLanguages" class="reqd" value="<?php if (isset($_POST['ProgrammingLanguages'])){ echo htmlspecialchars($ProgrammingLanguages); } else ''; ?>" /></td>
    </tr>        
    <tr>
      <td></td>
      <td><input type="Submit" name="Submit" value="Submit" style="background : #AFDCEC ; width : 5em ;color:#04B404;"></td>
    </tr>    
  </table>
  </form>
</center></div>  
</body>
</html>