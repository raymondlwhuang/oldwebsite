<?php
IF(isset($_POST['EMail']))
{
	$EMail = mysql_real_escape_string($_POST['EMail']);;
	if(!filter_var((String) $EMail, FILTER_VALIDATE_EMAIL)) $ErrorMessage = "Invalide e-mail address"; else $ErrorMessage = "This is a valid e-mail address";
	
}
//FILTER_VALIDATE_BOOLEAN, FILTER_VALIDATE_FLOAT, FILTER_VALIDATE_INT,FILTER_VALIDATE_IP,FILTER_VALIDATE_REGEXP,FILTER_VALIDATE_URL
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>e-mail valification</title>
</head>
<body>

<form name="ValidateUser" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="Post">
<div align="center"><center>
<font color=#ff8000 id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></font>
<br>
<br>
  <table border="0">
    <tr>
      <td><p>E-Mail Address:</p></td>
      <td><input type="text"  name="EMail" size="30"  maxlength="50" id="EMail" class="email" value="<?php if (isset($_POST['EMail'])){ echo htmlspecialchars($EMail); } else ''; ?>" /></td>
    </tr>
  </table>
  </form>
</center></div>
</body>
</html>