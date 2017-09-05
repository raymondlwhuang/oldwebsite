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
IF(isset($_POST))
{
	if(isset($_POST['2_x'])) $chatStat = 2;
	elseif(isset($_POST['3_x'])) $chatStat = 3;
	elseif(isset($_POST['4_x'])) $chatStat = 4;
	else $chatStat = 5;
	mysql_query("UPDATE user SET is_active=$chatStat WHERE email_address = '$owner_email'");
	echo mysql_error();
}
$queryOwner="SELECT * FROM user where  email_address = '$owner_email' order by id LIMIT 1";
$owner=mysql_query($queryOwner);          // query executed 
echo mysql_error();
while($row = mysql_fetch_array($owner))
{
 $first_name=ucfirst(strtolower($row['first_name']));
 $last_name = ucfirst(strtolower($row['last_name']));
 $owner_id = $row['id'];
 $owner_path = $row['owner_path'];
 $name[$owner_path] = $first_name." ".$last_name;
 $my_picture = $row['profile_picture'];
 $my_name = $first_name." ".$last_name;
 $FriendEmail[$owner_path] = $owner_email;
 $chatStat = $row['is_active'];
} 

$FriendCount = 0;
$query="SELECT * FROM view_permission where owner_email = '$owner_email' group by viewer_email";  // query string stored in a variable
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
if($chatStat == 2) {
	$MyStatus = "&nbsp;&nbsp;&nbsp;I am not ready";
	$MyIndicator = "../images/yellow.png";
}
elseif($chatStat == 3) {
	$MyStatus = "&nbsp;&nbsp;&nbsp;I am ready";
	$MyIndicator = "../images/green.png";
}
elseif($chatStat == 4) {
	$MyStatus = "&nbsp;&nbsp;&nbsp;I am bussy";
	$MyIndicator = "../images/red.png";
}
else {
	$MyStatus = "&nbsp;&nbsp;&nbsp;I am away";
	$MyIndicator = "../images/white.png";
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Friends</title>
<style type="text/css" media="screen">
div {
	margin-bottom: 0px;
}

ul {
	display: none;
	list-style-type: none;
	margin-top: 0px;
}

ul > li > a:hover {background: #736F6E;}

div > p {
	display: block;
	width: 200px;
	background: #FFFFFF;
	border: 1px outset;
	margin:0;
 }
 
div > p:hover  {  border: 1px inset;background: #FFFFFF; border-color: #736F6E;color:white;  }
</style>	

<script type="text/javascript" >
window.onload = initAll;

function initAll() {
	var allLinks = document.getElementsByTagName("div");
	
	for (var i=0; i<allLinks.length; i++) {
		allLinks[i].onmouseover = function (){
		document.getElementById("menu1").style.display = "block";
		document.getElementById("frame1").style.display = "none";
		}
		allLinks[i].onmouseout =  function (){
		document.getElementById("menu1").style.display = "none";
		document.getElementById("frame1").style.display = "block";
		}
		allLinks[i].onclick =  function (){
		document.getElementById("menu1").style.display = "none";
		document.getElementById("frame1").style.display = "block";
		}
	}
}
function clearfield(picture,description) {
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = description;
}
</script>

</head>
<body><font color="darkblue">

<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>"  name="MyForm" id="MyForm" method="post">
<div style='display:block;'>
	<div class='menu1'>
<?php
echo "
	<p>Chat($FriendCount)&nbsp;&nbsp;&nbsp;<span id='picked_owner'>$MyStatus</span><img src='../images/down_arrow.jpg'  width='15' style='float:right' /><img src='$MyIndicator'  width='20' id='picked' style='float:right' /></p>";
?>				
		<ul style='display: none;text-align:left;' id='menu1'>
		<li><p><input type="image" name="2" src='../images/yellow2.png' width='100' onClick="clearfield('../images/yellow.png','&nbsp;&nbsp;&nbsp;I am not ready');" /></p></li>
		<li><p><input type="image" name="3" src='../images/green2.png' width='100' onClick="clearfield('../images/green.png','&nbsp;&nbsp;&nbsp;I am ready');" /></p></li>
		<li><p><input type="image" name="4" src='../images/red2.png' width='100' onClick="clearfield('../images/red.png','&nbsp;&nbsp;&nbsp;I am busy');" /></p></li>
		<li><p><input type="image" name="5" src='../images/white2.png' width='100' onClick="clearfield('../images/white.png','&nbsp;&nbsp;&nbsp;I am away');"  /></p></li>
		</ul>
	</div>
</div>
</form>			
<div id="Friends" style="display:<?php if($chatStat == 3) echo 'block'; else echo 'none'; ?>;">
<table width="200" border="0">
<?php
foreach ($profile_picture as $key => $value) {
$longstring = <<<STRINGBEGIN
<tr>
<td valign="top">
<a href="" ><img src='$value' width='35'/></a>
</td>
<td  valign='center'>
<font size='2'>$name[$key]</font>
</td>
STRINGBEGIN;
echo $longstring;
echo "<td valign='center'>";
if($FriendStat[$key] == 2) echo "<img src='../images/yellow.png' width='20'/>";
elseif($FriendStat[$key] == 3) echo "<img src='../images/red.png' width='20'/>";
elseif($FriendStat[$key] == 4) echo "<img src='../images/green.png' width='20'/>";
else echo "<img src='../images/white.png' width='20'/>";
echo "</td><td valign='center'>
<input type='checkbox' name='vehicle' value='1' /></td></tr>";
}
?>	
</table>
</div>
</font>

</body>
</html>
	