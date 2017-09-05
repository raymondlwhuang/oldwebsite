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
if(isset($_GET['show_id'])){
	$upload_id = $_GET['show_id'];
}
else if(isset($_GET['delete']))
{
	$id = $_GET['id'];
	$name = $_GET['name'];
	$upload_infor = $_GET['upload_infor'];
	$OK=mysql_query("DELETE FROM picture_video WHERE owner_path = '$GV_owner_path' and id = '$id'");
	if($OK) {
		unlink($name);
		$queryCheck="SELECT * FROM picture_video where upload_id = '$upload_infor' limit 1";  // query string stored in a variable
		$resultCheck=mysql_query($queryCheck);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		if (mysql_num_rows($resultCheck) == 0){
			mysql_query("DELETE FROM upload_infor WHERE id = $upload_infor");
echo <<<_END
<script type="text/javascript">
window.parent.location.href = window.parent.location.href;
</script>
_END;
			
		}
		else {		
			Header("Location: RemovePicture.php?show_id=$upload_infor");
			die;
		}
	}
	
}
if(!isset($upload_id)){
	$queryPicture="SELECT * FROM picture_video where owner_path = '$GV_owner_path' and picture_video = 'pictures' group by upload_id desc";  // query string stored in a variable
	$resultPicture=mysql_query($queryPicture);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row3 = mysql_fetch_array($resultPicture))
	{
		$upload_id = $row3['upload_id'];
	}
}

@$query="SELECT * FROM picture_video where upload_id = '$upload_id' and picture_video='pictures' order by upload_id";  // query string stored in a variable
@$result=mysql_query($query);          // query executed 
//echo mysql_error();              // if any error is there that will be printed to the screen 

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
while(@$nt=mysql_fetch_array($result)){
	echo "<img src='$nt[name]' width='134' />";
	echo "<a href='RemovePicture.php?delete=yes&id=$nt[id]&name=$nt[name]&upload_infor=$nt[upload_id]'>Delete this picture</a><br/>";
}

?>
</body>
</html>
	