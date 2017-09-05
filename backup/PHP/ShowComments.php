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
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Pictures Slide Show</title>
</head>
<body>	
<?php 
include("../config.php");
include("../inc/GlobalVar.inc.php");
if(isset($_POST['comment']))
{
	$id = (int)mysql_real_escape_string($_POST['id']);
	$queryShow=mysql_query("SELECT comments FROM picture_video where id = $id order by id limit 1"); 
		while($row = mysql_fetch_array($queryShow))
		{
			$comments = $row['comments'];
		}
	$comments .= "$GV_name: ";
	$comments .= $_POST['comment']."\n";
	mysql_query("UPDATE picture_video SET comments='$comments' WHERE id = $id");
	Header("Location: ShowComments.php?picture_id=$id");
	die;
} 
if(isset($_GET['picture_id'])){ $id = $_GET['picture_id'];
	$queryShow=mysql_query("SELECT comments FROM picture_video where id = $id"); 
		while($row = mysql_fetch_array($queryShow))
		{
			$comments = $row['comments'];
		}	
if($comments!='') echo "Comments-$comments";
echo <<<_END
<form name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<input type="hidden" name="id" value=$id>
Your Comment: <input type="text" name="comment" size="70" value=''>
</form>	
_END;

	
} 
?>

</body>
</html>