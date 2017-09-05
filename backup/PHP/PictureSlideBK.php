<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
$owner_email = $_SESSION['email_address'];
$queryOwner="SELECT * FROM user where  email_address = '$owner_email' order by id DESC LIMIT 1";
$owner=mysql_query($queryOwner);          // query executed 
echo mysql_error();
while($row = mysql_fetch_array($owner))
{
 $first_name=$row['first_name'];
 $last_name = $row['last_name'];
 $owner_id = $row['id'];
 $owner_path = $row['owner_path'];
} 

if(isset($_GET['FriendEmail']))
{
	if($_GET['FriendEmail'] == 'Public') {
		$Picked['Public'] = 'Public';
	}
	else if($_GET['FriendEmail'] == "$owner_email") {
			$queryPermission="SELECT * FROM view_permission where owner_email = '$owner_email' group by viewer_group";  // query string stored in a variable
			$resultPermission=mysql_query($queryPermission);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($resultPermission))
			{
			 $viewer_group = $row2['viewer_group'];
			 $owner_path = $row2['owner_path'];
			 $Picked[$owner_path] = $viewer_group;
			}
		}	
	else {
			$FriendEmail = $_GET['FriendEmail'];
			$queryPermission="SELECT * FROM view_permission where owner_email = '$FriendEmail' and viewer_email = '$owner_email' order by owner_path";  // query string stored in a variable
			$resultPermission=mysql_query($queryPermission);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($resultPermission))
			{
			 $viewer_group = $row2['viewer_group'];
			 $owner_path = $row2['owner_path'];
			 $Picked[$owner_path] = $viewer_group;
			} 
		}
}
else {
		$queryPermission="SELECT * FROM view_permission where owner_email = '$owner_email' group by viewer_group";  // query string stored in a variable
		$resultPermission=mysql_query($queryPermission);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($row2 = mysql_fetch_array($resultPermission))
		{
		 $viewer_group = $row2['viewer_group'];
		 $owner_path = $row2['owner_path'];
		 $Picked[$owner_path] = $viewer_group;
		}
}

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Pictures Slide Show</title>
<script type="text/javascript" src="../scripts/DocUp.js"></script>
</head>
<body>
<?php	
	foreach ($Picked as $key => $value) {
		if($key !='Public') {
			$query="SELECT * FROM picture_video where owner_path = '$key' and picture_video = 'pictures' and viewer_group = '$value'";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row3 = mysql_fetch_array($result))
			{
				echo "<img src='$row3[name]' width='134' /><br/><br/>";
			} 
		}
		else {
			$query="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public'";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row3 = mysql_fetch_array($result))
			{
				echo "<img src='$row3[name]' width='134' /><br/><br/>";
			} 
		}
	}
?>
</body>
</html>
	