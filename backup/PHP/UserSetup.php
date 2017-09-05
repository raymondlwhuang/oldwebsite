<?php
session_start();
include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>User Setup</title>
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
	color: red;
	font-weight: bold;
}
p {
	color:#0000A0;
	text-align:right;
	font-family:"Monotype Corsiva";
	margin:0;
}
p.invalid {
	color: red;
}
</style>

<?php
include_once("sethash.php");
if (isset($_POST['Submit']))
{
	 $first_name = $_POST['first_name'];
	 $last_name =  $_POST['last_name'];
	 $email_address = strtolower($_POST['email_address']);
	 $password = $_POST['password'];
	 $passwordConfirm = $_POST['passwordConfirm'];
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
		$first_name =  $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email_address =  strtolower($_POST['email_address']);
		$password =  MD5($_POST['password']);
		$SaveCheck = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
		$result2 = mysql_query($SaveCheck);
		if (mysql_num_rows($result2) > 0){
				mysql_query("UPDATE user SET first_name='$first_name',last_name='$last_name',password='$password' WHERE email_address = '$email_address' LIMIT 1");
		}
		ELSE {
				mysql_query("INSERT INTO user(first_name,last_name,password,email_address) VALUES('$first_name','$last_name','$password','$email_address')");
				$SaveCheck2 = "SELECT * FROM user WHERE 1 ORDER BY id DESC LIMIT 1";
				$result4 = mysql_query($SaveCheck2);
				while($Row=mysql_fetch_array($result4)){
					$id = $Row['id'];
					$first_name = str_replace (" ", "", $first_name);
					$owner_path = "$first_name"."$id";
					mysql_query("INSERT INTO spender(user_id,name) VALUES($id,'Me')");
					$SaveCheck5 = "SELECT * FROM spender WHERE user_id = $id LIMIT 1";
					$result5 = mysql_query($SaveCheck5);
					while($Row5=mysql_fetch_array($result5)){
						$spender_id = $Row5['id'];
						mysql_query("INSERT INTO sp_bank(user_id,spender_id,bank) VALUES($id,$spender_id,'Cash On Hand(Me)')");
					}
				}
				mysql_query("UPDATE user SET owner_path='$owner_path' WHERE id=$id ORDER BY id DESC LIMIT 1");
				echo mysql_error();
				mysql_close();
				$_SESSION["username"] = $email_address;
				$_SESSION["private"] = "yes";
				session_write_close();
	} /* SaveCheck.RecordCount */
echo <<<_END
<script type="text/javascript">
alert('Password had been set!');
//window.stop();
window.open( 'index.php', '_top');
</script>
_END;

 }
}
else if (isset($_GET['UserSetup']))
{
	$ErrorMessage = "*** Please setup your account ***";
	$findme   = ':::';
	$SearchString = newdecode($_GET['UserSetup']);
	$pos = strpos($SearchString, $findme);
	$email_address = strtolower(substr($SearchString,0,$pos));
	$ReqDate = strtotime (substr($SearchString,($pos+3)));
	$ExpirDate = strtotime ( '+7 day' , $ReqDate ) ;	
	$start_date=gregoriantojd(date('m'), date('d'), date('Y'));   
    $end_date=gregoriantojd(date('m',$ExpirDate), date('d',$ExpirDate), date('Y',$ExpirDate));   
	$daysdiff = $end_date - $start_date;
	if($daysdiff < 0) {
echo <<<_END
<script type="text/javascript">
alert('Your requirement has expired!');
//window.stop();
window.open( 'index.php', '_top');
</script>
_END;
	}
		$DisCheck = "SELECT * FROM user WHERE email_address = '$email_address' LIMIT 1";
		$result3 = mysql_query($DisCheck);
		if (mysql_num_rows($result3) != 0){
			while($nt=mysql_fetch_array($result3)){
				$first_name =  $nt['first_name'];
				$last_name = $nt['last_name'];
			}
		}	
}
else {
echo <<<_END
<script type="text/javascript">
window.open( 'index.php', '_top');
</script>
_END;

}

?>
<style type="text/css">
html, body {
   background-image:url('../images/background.png');
 }
 #mydiv {
	position:fixed;
	top:150px;
	width:380px;
	height:220px;
	background-color: #FFFFFF;
	text-align: left;
	left: 50%;
	margin-left: -190px;	
	border-style:solid outset;
	border-width:7px;
	background-color:#8FC4FF;
}
</style>
<script language="javascript">var emailfield = "email", reqdfield = "reqd", passwordConfirm = "passwordConfirm",invalid = "invalid",MessageTag = "",colorLabel=true;</script>
<script type="text/javascript" src="../scripts/UserSetup.js"></script>
</head>
<body>
<div id="mydiv">
<form name="ValidateUser" action="" method="Post">
<input type="hidden" name="searchID" size="4" value="<?php if (isset($searchID)){ echo $searchID; } else ''; ?>">
<center>
<font color="red" id="ErrorMessage"><?php if (isset($ErrorMessage)){ echo '**'.htmlspecialchars($ErrorMessage).'**   '; } else ''; ?></font>
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
      <td><input type="password"  name="password" size="30"  maxlength="15" id="password" class="reqd" onBlur="return CheckPassword(this.value);" value="<?php if (isset($_POST['password'])){ echo htmlspecialchars($password); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td><label for="passwordConfirm">Confirm Your Password:</label></td>
      <td><input type="password"  name="passwordConfirm" size="30"  maxlength="15" id="passwordConfirm" class="passwordConfirm" value="<?php if (isset($_POST['passwordConfirm'])){ echo htmlspecialchars($passwordConfirm); } else ''; ?>" /></td>
    </tr>
    <tr>
      <td></td>
      <td>
	  <input type="Submit" name="Submit" value="Submit" >
<!--	  <input type="button" name="Cancel" value="Back"   onclick="window.open( '../PHP/index.php', '_top');return false;"> -->
	  </td>
    </tr>
  </table>
  </form>
</center>
</div>
</body>
</html>