<?php
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
    $_GET = _stripslashes_rcurs($_GET);////
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
$CPcount = (int)mysql_real_escape_string($_REQUEST['CPcount']);
$user_id = (int)mysql_real_escape_string($_REQUEST['user_id']);
$upload_id = (int)mysql_real_escape_string($_REQUEST['current_id']);
	$queryPicture="SELECT * FROM picture_video where picture_video='pictures' and viewer_group = 'Public' and upload_id < $upload_id order by upload_id desc limit 3";  // query string stored in a variable
	$resultPicture=mysql_query($queryPicture);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$Pcount=0;
	$Vcount=0;
	$current_id = 0;
	while($row = mysql_fetch_array($resultPicture))
	{
		if($upload_id != $row['upload_id']){
			$upload_id = $row['upload_id'];
			$count = 0;
			$count2 = 0;
			if($row['picture_video']=='pictures') $Pcount++;
			if($Pcount<3) $current_id = $row['upload_id'];
			$upload_id = $row['upload_id'];
		}
		$queryupload_infor="SELECT * FROM upload_infor where id = $upload_id";  // query string stored in a variable
		$resultupload_infor=mysql_query($queryupload_infor);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		$description = '';
		while($row1 = mysql_fetch_array($resultupload_infor))
		{
			$UploadDate = $row1['upload_date'];
			$description = $row1['description'];
		}
		if(($row['picture_video']=='pictures') && $count < 4) {
			$picture_group[$upload_id][] = $row['name'];
			$count++;
		}
		$picture_UploadDate[$upload_id] = $UploadDate;
		$picture_description[$upload_id] = $description;
	}
	$current_count=3;
if(isset($picture_group)) {
	echo "<font color='red'>Public Pictures</font>";
	$count=0;
	foreach ($picture_group as $key => $value) {
			echo "$count<$Pcount";

		if($count<$Pcount){
			foreach ($value as $key2 => $value2) {
				if($key2==0) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$user_id','maincontent');refreshiframe('$key');\"/>";
				if($key2==1) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$user_id','maincontent');refreshiframe('$key');\"/>";
				if($key2==2) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$user_id','maincontent');refreshiframe('$key');\"/>";
				if($key2==3) echo "<img src='$value2' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$user_id','maincontent');refreshiframe('$key');\"/>";
			}
			echo "$picture_UploadDate[$key]<br/>";
			echo "$picture_description[$key]";
		}
		$count++;
	}
}
?>
	