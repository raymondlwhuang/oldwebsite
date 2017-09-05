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
}
include("../config.php");
include_once("sethash.php");
if(isset($_REQUEST['FriendID']))
{
	$FriendID=(int)$_REQUEST['FriendID'];
	$queryUser=mysql_query("SELECT * FROM user where id=$FriendID limit 1 ");  // query string stored in a variable
	echo mysql_error();
	while($row = mysql_fetch_array($queryUser))
	{
		$owner_path=$row['owner_path'];
		$user_id=$row['id'];
	}
}
	$rows=0;
	$queryPicture="SELECT * FROM picture_video where owner_path='$owner_path' and picture_video = 'pictures' order by id desc";  // query string stored in a variable
	
	$resultPicture=mysql_query($queryPicture);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$count = 0;
	$upload_id = '';
	while($row3 = mysql_fetch_array($resultPicture))
	{
			$upload_id = $row3['upload_id'];
			$countrow=true;
			if(isset($picture_group)) {
				$dosave=true;
				foreach ($picture_group as $key5 => $value5) {
					foreach ($value5 as $key6 => $value6) {
						if($key5==$upload_id) $countrow=false;
						if($key5==$upload_id && $value6==$row3['name']) $dosave=false;
					}
				}
				if($dosave) {
					$picture_group[$upload_id][] = $row3['name'];
					if($countrow) $rows++;
				}
			}
			else {
				$rows=1;
				$picture_group[$upload_id][] = $row3['name'];
			}
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
			$picture_description[$upload_id] = $description;
			$count++;
	}	

$pagenum = 1; 
$page_rows = 49;  
$last = ceil($rows/$page_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $last) $pagenum = $last; 
$first_row=($pagenum -1)* $page_rows;
$previous = $pagenum-1;
if($previous == 0) $previous=1;
$next = $pagenum+1;
if($next > $rows) $next=$rows;
$count=0;
$output="";
	if(isset($picture_group)) {
		$listcount=0;
		foreach ($picture_group as $key3 => $value3) {
				$output.= "<div style='display:inline-block;' >";
				$count=0;
				$listcount++;
				if($listcount > $first_row && $listcount <= ($first_row+$page_rows)){
					foreach ($value3 as $key4 => $value4) {
						$infor=newencode("$key3,$value4,$picture_UploadDate[$key3],$picture_description[$key3],$FriendID");
						if($key4==0) $output.= "<input type=\"image\" src='ImgOnImgWithBorder.php?second_img=$value4' alt='' onClick=\"Action('../PHP/LastActivity.php?user_id=$user_id','maincontent');refreshiframe('$infor');\"/>";
					}
					$encode=newencode($key3);
					$output.= "<a href='PRemove.php?link=$encode'  onclick=\"return confirm('Are you sure you want to delete this folder?');\"><img src='../images/delete.png' alt='delete' width='25' /></a>";
					$output.= "<br/>$picture_UploadDate[$key3]<br/>";
					$output.= "$picture_description[$key3]<br/>";
				}
				$output.= "</div>";
		}
	}
echo $output;						
?>