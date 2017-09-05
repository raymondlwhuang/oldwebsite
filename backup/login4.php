<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link type="text/css" rel="stylesheet" href="Welcome.css" />
<script type="text/javascript" src="login.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
</head>
<body>

<marquee style="color:#04B404;font-family:'Monotype Corsiva';font-size:x-large">This is my private area!</marquee>
<hr><hr>
<blockquote>
<?php include("getresult.inc"); ?>
</blockquote>
<form name="ValidateUser" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="Post">
<div align="center"><center>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right">
      <table border="0" height="59" bgcolor="#FFFFFF" cellspacing="1" cellpadding="0">
    <tr>
      <td height="19" bgcolor="#04B404" align="right"><font color="#FFFFFF"><small>Username:</small></font></td>
      <td height="19" bgcolor="#04B404" align="left"><p>
      <input id="select" type="text"  name="username" size="16"  maxlength="16" id="username" class="invalid reqd" value="<?php if (isset($_POST['username'])){ echo htmlspecialchars($username); } else ''; ?>" />
      </p></td>
      <td t="19" bgcolor="#C0C0C0" align="center">
      <div align="center">
      <center><a href="javascript:alert('The username must be between 4 and 16 characters long.')"><small><small>Help</small></small></a></td>
    </tr>  
    <tr>
      <td height="19" bgcolor="#04B404" align="right"><font color="#FFFFFF"><small>Password:</small></font></td>
      <td height="19" bgcolor="#04B404" align="left"><p>
      <input type="password"  name="password" size="16"  maxlength="16" id="password" class="reqd" value="" />
      </p></td>
          <td height="19" bgcolor="#C0C0C0" align="center">
          <div align="center">
          <center><a href="javascript:alert('The password must be between 4 and 16 characters long.')"><small><small>Help</small></small></a></td>
    </tr>
    <tr>
        <tr align="center">
          <td height="1" bgcolor="#04B404"></td>
          <td height="1" bgcolor="#04B404" align="left"><p><input TYPE="submit" NAME="FormsButton2" VALUE="Login" style="font-family: Verdana; font-size: 8pt;width:11.5em"></td>
          <td height="1" bgcolor="#C0C0C0" align="center"><a href="javascript:alert('Click to login')"><small><small>Help</small></small></a></td>
        </tr>
    </tr>    
  </table>
  </td>
  </tr>
  </table>
  </form>
</center></div>  
</body>
</html>