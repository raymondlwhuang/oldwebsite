<?php
session_start();
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
$query="SELECT * FROM view_permission where viewer_email = '$GV_email_address' group by owner_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
if(isset($_GET['delete']))
{
	$picture_video = $_GET['picture_video'];
	$viewer_group = $_GET['viewer_group'];
	$name = 	$_GET['name'];
	$deleteFile = "../$picture_video/$GV_owner_path/$viewer_group/$name";
	unlink($deleteFile); 
	mysql_query("DELETE FROM picture_video WHERE picture_video = '$picture_video' and owner_path = '$GV_owner_path' and viewer_group = '$viewer_group' and name = '$name'");
    Header("Location: RemovePicture.php");
	die;
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Remove of Pictures and Video</title>
<script type="text/javascript" src="../scripts/DocUp.js"></script>
</head>
<body>

<?php	
while($nt=mysql_fetch_array($result)){
$GetOwner="SELECT * FROM user where owner_email = '$nt[owner_email]' LIMIT 1";  // query string stored in a variable
$OwnInfo=mysql_query($GetOwner);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($ownerResult=mysql_fetch_array($OwnInfo)){
echo "<img src='../pictures/ownerResult[owner_path]/$nt[viewer_group]/$nt[name]' width='134' height='100' /><br/>";
}

echo "In ";
if($nt['viewer_group'] != '')	echo $nt['viewer_group']." group<br/>"; else echo "All group<br/>";
if($nt['picture_video'] == "pictures")
echo "<img src='../$nt[picture_video]/$GV_owner_path/$nt[viewer_group]/$nt[name]' width='134' height='100' /><br/>";
echo "<a href='RemovePicture.php?delete=yes&picture_video=$nt[picture_video]&viewer_group=$nt[viewer_group]&name=$nt[name]'>Delete this picture</a><br/><br/>";
}

?>
</body>
</html>
	