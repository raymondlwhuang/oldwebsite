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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
include("sethash.php");
if(isset($_REQUEST['infor'])){
	$infor=newdecode($_REQUEST['infor']);
	$pieces = explode(",", $infor);
	$upload_id = (int)$pieces[0];
	$picture = $pieces[1];
	$pic_date = $pieces[2];
	$pic_desc = $pieces[3];
	$FriendID=(int)$pieces[4];
	$queryUser=mysql_query("SELECT * FROM user where id=$FriendID limit 1 ");  // query string stored in a variable
	echo mysql_error();
	while($row = mysql_fetch_array($queryUser))
	{
		$owner_path=$row['owner_path'];
	}	
}
if(isset($_REQUEST['folder']))
{
		$folder = (int)newdecode($_REQUEST['folder']);
		$queryDelete=mysql_query("SELECT * FROM picture_video where upload_id=$folder ");  // query string stored in a variable
		echo mysql_error();
	    if (mysql_num_rows($queryDelete) != 0){
			while($rowDelete = mysql_fetch_array($queryDelete))
			{
				$Orgname="../Orgpictures".substr($rowDelete['name'],11);
				unlink($rowDelete['name']);
				unlink($Orgname);
				mysql_query("DELETE FROM pv_share WHERE pv_id = $rowDelete[id]");
				mysql_query("DELETE FROM picture_video WHERE id = $rowDelete[id]");
			}
		}
		mysql_query("DELETE FROM upload_infor WHERE id = $folder");
		mysql_query("DELETE FROM pv_comment WHERE upload_id = $folder");
//		echo mysql_error();              // if any error is there that will be printed to the screen 
echo <<<_END
<script type="text/javascript">
window.open('PRemove.php',target='_top');
</script>
_END;
		
exit();		
}
if(isset($_REQUEST['link']))
{
	$link=newdecode($_REQUEST['link']);
	$pieces = explode(",", $link);
	$id = (int)$pieces[0];
	$name = $pieces[1];
	$upload_id = (int)$pieces[2];
	$pic_date = $pieces[3];
	$pic_desc = $pieces[4];
	$picture = $pieces[5];
	$OK=mysql_query("DELETE FROM picture_video WHERE id = $id");
	if($OK) {
		mysql_query("DELETE FROM pv_share WHERE pv_id = $id");
		$Orgname="../Orgpictures".substr($name,11);
		unlink($Orgname);
		unlink($name);
	}
}

$result=mysql_query("SELECT * FROM picture_video where upload_id = $upload_id order by upload_id");  // query string stored in a variable
echo mysql_error();              // if any error is there that will be printed to the screen 
if (mysql_num_rows($result) == 0){
	mysql_query("DELETE FROM upload_infor WHERE id = $upload_id");
echo <<<_END
<script type="text/javascript">
//window.open('PRemove.php',target='_top');
</script>
_END;

exit();			
}
else {
	if(isset($name) && $name==$picture) {
		$Pictureresult=mysql_query("SELECT * FROM picture_video where upload_id = $upload_id order by upload_id limit 1");  // query string stored in a variable
		while($row=mysql_fetch_array($Pictureresult)){
			$picture=$row['name'];
		}
	}
}


 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Remove of Pictures</title>
</head>
<body>
<center>
<font style="font-size:18px;color:red;">PICTURE MAINTENANCE</font><br/>
<?php
include("../PHP/Header.php");

$encode=newencode($upload_id);
echo "<a href='PRemove.php'><img src='ImgOnImgWithBorder.php?second_img=$picture' alt='Go Back'/></a>";
echo "<a href='PicRemove.php?folder=$encode'  onclick=\"return confirm('Are you sure you want to delete this folder?');\"><img src='../images/delete.png' alt='delete' width='25' /></a>";
echo "<br/>$pic_date<br/>";
echo "$pic_desc<br/><br/>";
	
while($nt=mysql_fetch_array($result)){
	$link = newencode("$nt[id],$nt[name],$upload_id,$pic_date,$pic_desc,$picture");
	echo "<div style='display:inline-block;'><img src='$nt[name]' width='134' />";
	echo "<a href='PicRemove.php?link=$link'  onclick='return confirm(\"Are you sure you want to delete?\");'><img src='../images/delete.png' alt='delete' width='25' /></a>&nbsp;</div>";
}

?>
</center>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
</body>
</html>
	