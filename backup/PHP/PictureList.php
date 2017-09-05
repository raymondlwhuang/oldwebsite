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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);////
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
	$show_id = 0;
	if(isset($_REQUEST['FriendID'])) $FriendID = $_REQUEST['FriendID']; else $FriendID = 'Public';
	$viewer_id = (int)$_REQUEST['viewer_id'];
	if($FriendID !='Public'){
		if($FriendID!=$viewer_id){
			$queryPermit="SELECT * FROM view_permission where user_id = $FriendID and viewer_id = $viewer_id group by viewer_group";  // query string stored in a variable
		}
		else {
			$queryPermit="SELECT * FROM view_permission where user_id = $FriendID group by viewer_group";  // query string stored in a variable
		}
	}
	else $queryPermit="SELECT * FROM view_permission where 1 group by user_id";  // query string stored in a variable
	$resultPermit=mysql_query($queryPermit);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$rows=0;
	if (mysql_num_rows($resultPermit) != 0){
		while($row = mysql_fetch_array($resultPermit))
		{	
			$curr_path = $row['owner_path'];
			if($FriendID !='Public') $permit[$curr_path][] = $row['viewer_group'];
			else $permit[$curr_path][] = 'Public';
			
		}
		foreach ($permit as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$PicturePath = "../pictures/$key";
				if($FriendID !='Public') $queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and name like '$PicturePath%' order by id desc";  // query string stored in a variable
				else $queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public' order by id desc";
				
				$resultPicture=mysql_query($queryPicture);          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				$count = 0;
				$upload_id = '';
				while($row3 = mysql_fetch_array($resultPicture))
				{
					if ($row3['viewer_group']=="$value2" || $row3['viewer_group'] == '') { 				
						$upload_id = $row3['upload_id'];
						if(isset($picture_group)) {
							$dosave=true;
							foreach ($picture_group as $key5 => $value5) {
								foreach ($value5 as $key6 => $value6) {
									if($key5==$upload_id && $value6==$row3['name']) $dosave=false;
								}
							}
							if($dosave) {
								$rows++;
								$picture_group[$upload_id][] = $row3['name'];
							}
						}
						else {
							$rows=1;
							$picture_group[$upload_id][] = $row3['name'];
						}
						if ($show_id == 0) $show_id = $upload_id;
						$queryupload_infor="SELECT * FROM upload_infor where id = $upload_id";  // query string stored in a variable
						$resultupload_infor=mysql_query($queryupload_infor);          // query executed 
						echo mysql_error();              // if any error is there that will be printed to the screen 
						$description = '';
						while($row4 = mysql_fetch_array($resultupload_infor))
						{
							$UploadDate = $row4['upload_date'];
							$description = $row4['description'];
						}			
						$picture_UploadDate[$upload_id] = $UploadDate;
						$picture_description[$upload_id] = mysql_real_escape_string($description);
						$count++;
					}
				}	
				if($count > 0) $owner_list[] = $key;			
			}
		}
	}
if(isset($_REQUEST['pagenum'])) $pagenum = (int)$_REQUEST['pagenum']; 
 //This checks to see if there is a page number. If not, it will set it to page 1 
if (!(isset($pagenum)))	$pagenum = 1; 
$page_rows = 4;  
$last = ceil($rows/$page_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $last) $pagenum = $last; 
$first_row=($pagenum -1)* $page_rows;
/*
$previous = $pagenum-1;
if($previous == 0) $previous=1;
$next = $pagenum+1;
if($next > $rows) $next=$rows;
*/

$count=0;
if(isset($picture_group)) {
	$listcount=0;
	foreach ($picture_group as $key3 => $value3) {
			$count=0;
			$listcount++;
			if($listcount > $first_row && $listcount <= ($first_row+$page_rows)){
				foreach ($value3 as $key4 => $value4) {
					$count++;
					if($count>5) break;
					if($key4==0) echo "<input type=\"image\" src='ImgOnImgWithBorder.php?second_img=$value4' alt='' onClick=\"Action('../PHP/LastActivity.php?user_id=$FriendID','maincontent');refreshiframe('$key3');\"/><br/>";
					else echo "<img src='$value4' width='35'/>";
/*					
					if($count>3) break;
					if($key4==0) echo "<input type=\"image\" src='ImgAngleControl.php?filename=$value4&degrees=60&ColorOrHex=white' width='30%' alt='' onClick=\"Action('../PHP/LastActivity.php?user_id=$FriendID','maincontent');refreshiframe('$key3');\"/>";
					if($key4==1) echo "<input type=\"image\" src='$value4' width='40%' onClick=\"Action('../PHP/LastActivity.php?user_id=$FriendID','maincontent');refreshiframe('$key3');\"/>";
					if($key4==2) echo "<input type=\"image\" src='ImgAngleControl.php?filename=$value4&degrees=300&ColorOrHex=white' width='30%' alt='' onClick=\"Action('../PHP/LastActivity.php?user_id=$FriendID','maincontent');refreshiframe('$key3');\"/>";
					if($key4==3) echo "<input type=\"image\" src='$value4' width='43%' onClick=\"Action('../PHP/LastActivity.php?user_id=$FriendID','maincontent');refreshiframe('$key3');\"/>"; */
				}
				echo "<br/>$picture_UploadDate[$key3]<br/>";
				echo "$picture_description[$key3]<br/>";
			}
	}
}		
?>
