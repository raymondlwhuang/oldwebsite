<?php
IF(isset($_POST['find']))
{
	$dir = $_POST['target_path'];
	chdir($dir);
	$files = glob('*.{php,txt}', GLOB_BRACE);  
	$files = array_map('realpath',$files);    
	var_dump($files);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title></title>
</head>
<body>
<?php echo "YOUR CURRENT WORKING DIRECTORY IS: ".substr(getcwd(),0); ?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
Find Files in Which Directory?<input type="text" name="target_path" value="<?php if (isset($_POST['target_path'])){ echo $_POST['target_path']; } else echo substr(getcwd(),0); ?>" size="116" maxlength="200"><br/>
<input type="Submit" name="find" value="Display Result" />

</form>
</body>
</html>