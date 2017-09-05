<?php
if(isSet($cookie_name))
{
	// Check if the cookie exists
if(isSet($_COOKIE[$cookie_name]))
	{
	parse_str($_COOKIE[$cookie_name]);
	include("../config.php");
	$email_address = $usr;
	$query="SELECT * FROM user where email_address = '$email_address' and password = '$hash' limit 1;";  // query string stored in a variable
	$result=mysql_query($query);
	  if (@mysql_num_rows($result) != 0){
			$config_username = $usr;
			$config_password = $hash;
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
		  session_write_close();
		}
	}
}
?>