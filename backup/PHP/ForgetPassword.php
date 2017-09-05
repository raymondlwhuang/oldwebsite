<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="GetUserInfo.css" />
<script type="text/javascript" src="GetUserInfo.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
</head>
<body>
<form name="ValidateUser" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="Post">
<div align="center"><center>
<font color=#ff8000 id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></font>
    <tr>
      <td><p>Your Email Address:</p></td>
      <td><input type="text"  name="EMail" size="30"  maxlength="50" id="EMail" class="email" value="<?php if (isset($_POST['EMail'])){ echo htmlspecialchars($EMail); } else ''; ?>" /></td>
    </tr>
  </table>
  </form>
</center></div>
</body>
</html>