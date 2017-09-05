<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reset your password</title>
<style type="text/css">
body {
background-image:url('../images/Desert.jpg');
}
input.invalid {
	background-color: #FF9;
	border: 2px red inset;
}

label.invalid {
	color: #F00;
	font-weight: bold;
}
p {
	color:#0000A0;
	text-align:right;
	font-family:"Monotype Corsiva";
	margin:0;
}
p.invalid {
	color: #ffffff;
}
</style>

<?php
session_start();
if (isset($_POST['Submit']))
{
	include("../config.php");
	 $first_name = mysql_real_escape_string($_POST['first_name']);
	 $last_name =  mysql_real_escape_string($_POST['last_name']);
	 $oldPassword = mysql_real_escape_string($_POST['oldPassword']);
	 $email_address = mysql_real_escape_string($_POST['email_address']);
	 $password = mysql_real_escape_string($_POST['password']);
	 $passwordConfirm = mysql_real_escape_string($_POST['passwordConfirm']);
	 $username = $email_address;
	 if (($first_name == "") 
		or ($last_name == "") 
		or ($oldPassword== "") 
		or ($password == "") 
		or ($passwordConfirm == "") 
		or !preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email_address)
	 )
	 {
		if(($first_name == "") 
		or ($last_name == "") 
		or ($oldPassword== "") 
		or ($email_address == "") 
		or ($passwordConfirm == "") 
		or ($password == "") )
		{
			$ErrorMessage = "** Please fill in missing information **";
		}
		else $ErrorMessage = "** Invalid e-mail address **"; 	   
	 }
	 else {
		$searchID3 =  (int)mysql_real_escape_string($_POST['searchID']);
		$first_name =  mysql_real_escape_string($_POST['first_name']);
		$last_name = mysql_real_escape_string($_POST['last_name']);
		$email_address =  mysql_real_escape_string($_POST['email_address']);
		$oldPassword =  mysql_real_escape_string($_POST['oldPassword']);
		$password =  MD5(sha1(mysql_real_escape_string($_POST['password'])));
		$passwordConfirm =  mysql_real_escape_string($_POST['passwordConfirm']);
		mysql_query("UPDATE user SET first_name='$first_name', last_name='$last_name', 	email_address='$email_address', password='$password' WHERE id = $searchID3");
		session_write_close();
		$_SESSION["username"] = $email_address;
		$_SESSION["private"] = "yes";
		header( "Location: MyBlog.php" );
		die;
	 
	 }
}
else {
	 $ErrorMessage = "*** Please set up your password ***";
	 $searchID = $_SESSION['searchID'];
	 $first_name = $_SESSION['first_name'];
	 $last_name =  $_SESSION['last_name'];
	 $oldPassword =  $_SESSION['oldPassword'];
	 $email_address = $_SESSION['email_address'];
}

?>
<script language="javascript">var emailfield = "email", reqdfield = "reqd", passwordConfirm = "passwordConfirm",invalid = "invalid",MessageTag = "",colorLabel=true;</script>
<script type="text/javascript" src="../scripts/NewUser.js"></script>
</head>
<body>
<div id="mydiv">
<form name="ValidateUser" method="Post">
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
<center>
<font color=red id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></font>
<br>
<br>
  <table border="0">
    <tr>
      <td><label for="first_name">First Name:</label></td>
      <td><input type="text"  name="first_name" size="30"  maxlength="50" id="first_name" class="invalid reqd" value="<?php if (isset($first_name)){ echo $first_name; } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><label for="last_name">Last Name:</label></td>
      <td><input type="text"  name="last_name" size="30"  maxlength="50" id="last_name"  class="reqd" value="<?php if (isset($last_name)){ echo $last_name; } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><label for="email_address">Your Email:</label></td>
      <td><input type="text"  name="email_address" size="30"  maxlength="50" id="email_address" class="email" value="<?php if (isset($email_address)){ echo $email_address; } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><label for="oldPassword">Old Password:</label></td>
      <td><input type="password"  name="oldPassword" size="30"  maxlength="15" id="oldPassword" class="oldPassword" value="<?php if (isset($_POST['oldPassword'])){ echo htmlspecialchars($oldPassword); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><label for="password">Password:</label></td>
      <td><input type="password"  name="password" size="30"  maxlength="15" id="password" class="reqd" value="<?php if (isset($_POST['password'])){ echo htmlspecialchars($password); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><label for="passwordConfirm">Confirm Your Password:</label></td>
      <td><input type="password"  name="passwordConfirm" size="30"  maxlength="15" id="passwordConfirm" class="passwordConfirm" value="<?php if (isset($_POST['passwordConfirm'])){ echo htmlspecialchars($passwordConfirm); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="Submit" name="Submit" value="Submit" style="background : #AFDCEC ; width : 5em ;color:#04B404;"></td>
    </tr>
  </table>
  </form>
</center>
</div>
</body>
</html>