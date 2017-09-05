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
include("sethash.php");
if(isset($_GET['link']))
{
	$link=newdecode($_GET['link']);
	$pieces = explode(",", $link);
	$id = $pieces[0];
//	$name = $pieces[1];
	$upload_infor = (int)$pieces[2];
	$name = strtolower(substr($pieces[1],0,strpos($pieces[1],".",3)))."%";
//	echo $name;
	$GetDelete=mysql_query("SELECT * FROM picture_video where upload_id = $upload_infor and picture_video = 'videos' and name like '$name' order by upload_id");
	while($row = mysql_fetch_array($GetDelete)) {
		$name2 = $row['name'];
		$id2 = $row['id'];
		$OK=mysql_query("DELETE FROM picture_video WHERE id = $id2");
		if($OK) {
			unlink($name2);
		}
	}	
	$queryCheck="SELECT * FROM picture_video where upload_id = $upload_infor limit 1";  // query string stored in a variable
	$resultCheck=mysql_query($queryCheck);          // query executed 
	if (mysql_num_rows($resultCheck) == 0){
		mysql_query("DELETE FROM upload_infor WHERE id = $upload_infor");
echo <<<_END
<script type="text/javascript">
window.parent.location.href = window.parent.location.href;
</script>
_END;
			
		}
		else {		
			Header("Location: VRemove.php");
			die;
		}
}

$query="SELECT * FROM picture_video where owner_path='$GV_owner_path' and picture_video='videos' order by upload_id";  // query string stored in a variable
$result=mysql_query($query);          // query executed 

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Remove of Videos</title>
<script type="text/javascript" src="../scripts/DocUp.js"></script>
</head>
<body>
<center>
<input type="image" src="../images/home.png" name="Home" value="Home" width="80" style="display:inline-block;" onClick="window.open('index.php',target='_top');"><hr/>
<?php	
while(@$nt=mysql_fetch_array($result)){
	$link = newencode("$nt[id],$nt[name],$nt[upload_id]");
	echo "<div style='display:inline-block;'>
	<video width='134' controls='controls'>
		<source src='$nt[name]' type='video/mp4' />
		<source src='$nt[name]' type='video/webm' />
		<source src='$nt[name]' type='video/ogg' />
	</video>	
	<br/>";
	echo "<a href='VRemove.php?link=$link'>Delete this video</a></div>";
}
if (mysql_num_rows($result) == 0) {
echo <<<_END
<script type="text/javascript">
alert("No more video file available to delete!");
window.open("index.php",target="_top");
</script>
_END;

}
?>
</center>
</body>
</html>
	