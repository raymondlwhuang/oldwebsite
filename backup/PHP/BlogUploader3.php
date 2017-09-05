<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php session_start();
include("../config.php");
include("../inc/GlobalVar.inc.php");
$GroupResult=mysql_query("SELECT * FROM `view_permission` where user_id = $GV_id group by viewer_group");          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($option = mysql_fetch_array($GroupResult)) {
	$optionGroup["$option[id]"] = $option['viewer_group'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Picture Uploader</title>
<style type="text/css"> 
input.wide {display:block; width: 99%} 
</style>	
</head>
<body>Share Picture With:
	<select name="viewer_group" id="viewer_group" style="font-size:20px;width:300px;border-color:#5050FF;border-width: 3px;">
	<option value='0'>All Group</option>
	<?php
		foreach($optionGroup as $id=>$viewer_group) {
			echo "<option value='$id'>$viewer_group</option>";
		}
	?>
	</select><br/>

</body>
	
</html>