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
include("../inc/GlobalVar.inc.php");
IF(isset($_POST))
{
	if(isset($_POST['MyStatus'])){
		$chatStat = (int)$_POST['MyStatus'];
		mysql_query("UPDATE user SET is_active=$chatStat WHERE email_address = '$GV_email_address'");
		echo mysql_error();
	}
}
$name[] = $GV_first_name." ".$GV_last_name;
$chatStat = 2;
$FriendCount = 0;
$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$FriendEmail[$curr_path] = $row2['viewer_email'];
	$queryFriends="SELECT * FROM user where  email_address = '$row2[viewer_email]' LIMIT 1";
	$friend=mysql_query($queryFriends);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($friend))
	{
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[] = $row3['profile_picture'];
	 $name[] = $first_name." ".$last_name;
	 $FriendStat[] = $row3['is_active'];
	} 
	$FriendCount = $FriendCount + 1;

}
	$MyStatus = "&nbsp;&nbsp;&nbsp;I am Away";
	$MyIndicator = "../images/yellow.png";
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Friend List</title>
<script src="../scripts/jquery.js"></script>

<script>
 $(document).ready(function() {
 	 $("#responsecontainer").load("ShowFriends.php");
   var refreshId = setInterval(function() {
      $("#responsecontainer").load('ShowFriends.php?randval='+ Math.random());
   }, 60000);
   $.ajaxSetup({ cache: false });
});
</script>
</head>
<body>
<font color="darkblue" style="position:fixed;bottom:0px;">

<div id="Friends" style="border-style:solid;border-width:1px;display:<?php if($chatStat == 3) echo 'block'; else echo 'none'; ?>;">
<div id="responsecontainer">
</div>
</div>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>"  name="MyForm" id="MyForm" method="post">
<?php echo "Chat($FriendCount)"; echo "<img src='$MyIndicator'  width='20' id='picked' />"; ?>
<select name="MyStatus" border=0 onChange="document.getElementById('MyForm').submit()">
   <option value="2" <?php if($chatStat==2) echo 'selected' ?> >I am Away</option>
   <option value="3" <?php if($chatStat==3) echo 'selected' ?>>I am Available</option>
   <option value="4" <?php if($chatStat==4) echo 'selected' ?>>I am Busy</option>
   <option value="5" <?php if($chatStat==5) echo 'selected' ?>>I am Offline</option>
 </select> 
</form>
</font>
<iframe src="chat.php" height="620" width="420" id="frame1" frameborder=0 SCROLLING=no allowTransparency="false" style="position:relative;left:-220px;z-index:3;background-color:#FFFFFF;<?php if($chatStat == 3) echo 'display:block'; else echo 'display:none'; ?>;">
  <p>Your browser does not support iframes.</p>
</iframe>
</body>
</html>
	