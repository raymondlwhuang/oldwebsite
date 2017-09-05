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
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
IF(isset($_GET['profile_picture']))
{
	$profile_picture = $_GET['profile_picture'];
	if(isset($_GET['show_id'])){ $upload_id = $_GET['show_id'];	}
	$queryShow="SELECT * FROM picture_video where picture_video = 'pictures' and upload_id = '$upload_id' order by upload_id desc";  // query string stored in a variable

	$resultShow=mysql_query($queryShow);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
			$countimg = 0;
			if(mysql_num_rows($resultShow) <= 1) {
			  $countimg++;
			  $content ='<div style="display: block; opacity: 1;height: 600px;" id="banner'."$countimg".'">';
			  $content = "$content"."<img src='$profile_picture' height=420px border='0'>";
			  $content = "$content".'</div>';
			  echo "$content";			
			}			
			while($pic_row5 = mysql_fetch_array($resultShow)) {
		  $countimg++;
		  $content ='<div style="display: block; opacity: 1;height: 600px;" id="banner'."$countimg".'">';
		  $content = "$content"."<img src='$pic_row5[name]' height=420px border='0'><br />
						<iframe src='ShowComments.php?picture_id=$pic_row5[id]' width='600' height='100%'  frameborder=0 SCROLLING=no>
						  <p>Your browser does not support iframes.</p>
						</iframe>";
		  $content = "$content".'</div>';
		  echo "$content";
		  };
}
?>
