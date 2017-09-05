<?php
if(!$do_login) exit;
@session_start();
// declare post fields
require_once("../config.php");
	$post_username = trim($_REQUEST['username']);
	$post_password = MD5(trim($_REQUEST['password']));

	if(isset($_REQUEST['autologin'])) $post_autologin = $_REQUEST['autologin']; else $post_autologin = 0;
	$email_address = $post_username;
	$query="SELECT * FROM user where email_address = '$email_address' and password = '$post_password' and is_active > 0 limit 1;";  // query string stored in a variable
	//echo mysql_error();  
	$result=mysql_query($query);
	  if (@mysql_num_rows($result) != 0){
			$config_username = $post_username;
			$config_password = $post_password;
		while($row = mysql_fetch_array($result))
		{
		 $_SESSION["first_name"] =ucfirst(strtolower($row['first_name']));
		 $_SESSION["last_name"] = ucfirst(strtolower($row['last_name']));
		 $_SESSION["id"] = $row['id'];
		 $_SESSION["owner_path"] = $row['owner_path'];
		 $_SESSION["name"] = ucfirst(strtolower($row['first_name']))." ".ucfirst(strtolower($row['last_name']));
		 $_SESSION["profile_picture"] = $row['profile_picture'];
		 $_SESSION["admin"] = $row['is_super_admin'];
		 $_SESSION["discoverable"] = $row['discoverable'];
		} 	  
	  
		  $_SESSION["username"] = $usr;
		  $_SESSION["email_address"] = $email_address;
		  $_SESSION["private"] = "yes";
		  $_SESSION["MsgBox"] = "no";
		  mysql_query("UPDATE user SET is_active=3 WHERE email_address = '$email_address' LIMIT 1");
		  //echo mysql_error();
  		  mysql_query("UPDATE view_permission SET is_active = 1 WHERE owner_email = '$email_address' and is_active > 1 and is_active < 9 order by owner_email");
		  //echo mysql_error();	
		  $login_ok = true;
		  session_write_close();
	if($post_autologin == 1)
	{
		$password_hash = $config_password; // will result in a 32 characters hash

		setcookie ($cookie_name, 'usr='.$config_username.'&hash='.$password_hash, time() + $cookie_time);
	}
echo <<<_END
<script type="text/javascript">
window.open('index.php',target='_top');
</script>
_END;
		
exit();
//	header("Location: index.php");
}
else
{
	$login_error = true;
	login();
}
function login() {
  if ( isset( $_REQUEST["username"] ) and isset( $_REQUEST["password"] ) ) {
   $username = $_REQUEST['username'];
	$email_address = strtolower($username);
	$password = MD5($_REQUEST["password"]);
	$query="SELECT * FROM user where email_address = '$email_address' and password = '$password' and is_active > 0 limit 1;";  // query string stored in a variable
	$result=mysql_query($query);
	  if (@mysql_num_rows($result) != 0){
	  
		while($row = mysql_fetch_array($result))
		{
		 $_SESSION["first_name"] =ucfirst(strtolower($row['first_name']));
		 $_SESSION["last_name"] = ucfirst(strtolower($row['last_name']));
		 $_SESSION["id"] = $row['id'];
		 $_SESSION["owner_path"] = $row['owner_path'];
		 $_SESSION["name"] = ucfirst(strtolower($row['first_name']))." ".ucfirst(strtolower($row['last_name']));
		 $_SESSION["profile_picture"] = $row['profile_picture'];
		 $_SESSION["admin"] = $row['is_super_admin'];
		 $_SESSION["discoverable"] = $row['discoverable'];
		} 	  
	  
		  $_SESSION["username"] = strtolower($email_address);
		  $_SESSION["email_address"] = strtolower($email_address);
		  $_SESSION["private"] = "yes";
		  $_SESSION["MsgBox"] = "no";
		  mysql_query("UPDATE user SET is_active=3 WHERE email_address = '$email_address' LIMIT 1");
		  //echo mysql_error();
  		  mysql_query("UPDATE view_permission SET is_active = 1 WHERE owner_email = '$email_address' and is_active > 1 and is_active < 9 order by owner_email");
		  //echo mysql_error();	
		  session_write_close();
		}
echo <<<_END
<script type="text/javascript">
window.open('index.php?login=failed',target='_top');
</script>
_END;
		
exit();		
//		header( "Location: index.php" );
  }
}
