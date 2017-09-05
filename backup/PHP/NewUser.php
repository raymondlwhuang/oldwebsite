<?php
session_start();
include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>New User Setup</title>
<style type="text/css">
html, body {
   height: 100%;
   margin: 0;
   padding: 0;
 }

img#bg {
   position:fixed;
   top:0;
   left:0;
   width:100%;
   height:100%;
 } 
body {
background-image:url('../images/Desert.jpg');
}
input.invalid {
	background-color: #FF9;
	border: 2px red inset;
}

label.invalid {
	color: #FFFFFF;
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
include_once("sethash.php");
if (isset($_POST['Submit']))
{
	 $first_name = mysql_real_escape_string($_POST['first_name']);
	 $last_name =  mysql_real_escape_string($_POST['last_name']);
	 $email_address = strtolower(mysql_real_escape_string($_POST['email_address']));
	 $password = mysql_real_escape_string($_POST['password']);
	 $passwordConfirm = mysql_real_escape_string($_POST['passwordConfirm']);
	 $username = $email_address;
	 if (($first_name == "") 
		or ($last_name == "") 
		or ($password == "") 
		or ($passwordConfirm == "") 
		or !preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email_address)
	 )
	 {
		if(($first_name == "") 
		or ($last_name == "") 
		or ($email_address == "") 
		or ($passwordConfirm == "") 
		or ($password == "") )
		{
			$ErrorMessage = "** Please fill in missing information **";
		}
		else $ErrorMessage = "** Invalid e-mail address **"; 	   
	 }
	 else {
		$first_name =  mysql_real_escape_string($_POST['first_name']);
		$last_name = mysql_real_escape_string($_POST['last_name']);
		$email_address =  strtolower(mysql_real_escape_string($_POST['email_address']));
		$password =  MD5(mysql_real_escape_string($_POST['password']));
		$SaveCheck = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
		$result2 = mysql_query($SaveCheck);
		if (mysql_num_rows($result2) > 0){
			while($nt=mysql_fetch_array($result2)){
				if($nt['password'] == ''){
					mysql_query("UPDATE user SET first_name='$first_name',last_name=$last_name,owner_path='$first_name'+id,password=$password,member_date=NOW() WHERE 1 ORDER BY id DESC LIMIT 1");
				}
				else $ErrorMessage = "**Duplication User Exist(email_address: $email_address)**";
			}
		}
		ELSE {
				mysql_query("INSERT INTO user(first_name,last_name,password,email_address,member_date) VALUES('$first_name','$last_name','$password','$email_address',NOW())");
				$SaveCheck3 = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
				$result3 = mysql_query($SaveCheck3);
				while($pathresult = mysql_fetch_array($result3)) {
					$owner_path = $pathresult['first_name'].$pathresult['id'];
					mysql_query("UPDATE user SET owner_path='$owner_path' WHERE 1 ORDER BY id DESC LIMIT 1");
					echo mysql_error(); 
				}				
				mysql_close();
				$_SESSION["username"] = $email_address;
				$_SESSION["private"] = "yes";
				session_write_close();
echo <<<_END
<script type="text/javascript">
window.open( 'MyBlog.php', '_top');
</script>
_END;

	} /* SaveCheck.RecordCount */
 }
}
else if (isset($_GET['ResetUser']))
{
	$ErrorMessage = "*** Please setup your account ***";
	$findme   = ':::';
	$SearchString = newdecode($_GET['ResetUser']);
	$pos = strpos($SearchString, $findme);
	$email_address = strtolower(substr($SearchString,0,$pos));
	$ReqDate = substr($SearchString,($pos+3));
	$ExpirDate = strtotime ( '2 day' , strtotime ( $ReqDate ) ) ;	
	$ExpirDate = date ( 'Y-m-j' , $ExpirDate );
}
else {
echo <<<_END
<script type="text/javascript">
window.open( 'login.php', '_top');
</script>
_END;

}

?>
<script language="javascript">var emailfield = "email", reqdfield = "reqd", passwordConfirm = "passwordConfirm",invalid = "invalid",MessageTag = "",colorLabel=true;</script>
<script type="text/javascript" src="../scripts/NewUser.js"></script>
</head>
<body>
<img src="../images/Desert.jpg" alt="background image" id="bg" style="z-index:-1;"/>
<div id="mydiv">
<form name="ValidateUser" method="Post">
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
<center>
<font color=white id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></font>
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
      <td><input type="text"  name="email_address" size="30"  maxlength="50" id="email_address" class="email" value="<?php if (isset($email_address)){ echo $email_address; } else ''; ?>" readonly="readonly" /></td>
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
      <td>
	  <input type="Submit" name="Submit" value="Submit" >
<!--	  <input type="button" name="Cancel" value="Back"   onclick="window.open( '../PHP/login.php', '_top');return false;"> -->
	  </td>
    </tr>
  </table>
  </form>
</center>
</div>
</body>
</html>