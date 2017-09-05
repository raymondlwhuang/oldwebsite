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
$show_id = 0;
$queryPicture="SELECT * FROM picture_video where viewer_group = 'Public' and picture_video = 'pictures' group by upload_id desc";  // query string stored in a variable
$resultPicture=mysql_query($queryPicture);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
$count = 0;
while($row3 = mysql_fetch_array($resultPicture))
{
	if ($show_id == 0) $show_id = $row3['upload_id'];
	$picture_id[] = $row3['upload_id'];
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
	if(isset($_GET['show_id'])){ $upload_id = $_GET['show_id'];	}
	else $upload_id = $show_id;
	$queryShow="SELECT * FROM picture_video where picture_video = 'pictures' and upload_id = '$upload_id'";  // query string stored in a variable
	$resultShow=mysql_query($queryShow);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$count = 0;
	while($row5 = mysql_fetch_array($resultShow))
	{
		echo "<img src='$row5[name]' width='120' /><br/><br/>";
	}	
?>
</body>
</html>
	