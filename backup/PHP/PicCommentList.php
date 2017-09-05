<?php 
 // Connects to your Database 
include("../config.php");
$upload_id=$_REQUEST['upload_id'];
$pv_id=(int)$_REQUEST['pv_id'];
if(isset($_REQUEST['pagenum'])) $pagenum = (int)$_REQUEST['pagenum'];
$page_rows = 6;
if($upload_id=="SharedPicture")$queryComment=mysql_query("SELECT * FROM pv_comment where PV_id=$pv_id order by id desc");  // query string stored in a variable
else   $queryComment=mysql_query("SELECT * FROM pv_comment where upload_id=$upload_id order by id desc");  // query string stored in a variable
echo mysql_error(); 
$Comcount=0;
while($row4 = mysql_fetch_array($queryComment))
{	
	if($row4['PV_id']==0 || $row4['PV_id']==$pv_id) {
		$Comcount++;
		$queryUser=mysql_query("SELECT * FROM user where id=$row4[viewer_user_id] limit 1");
		while($row6 = mysql_fetch_array($queryUser))
		{		
			$name=$row6['first_name']." ".$row6['last_name'];
			$result_profile_picture[]=$row6['profile_picture'];
		}				
		$queryPV=mysql_query("SELECT * FROM picture_video where upload_id=$row4[upload_id] limit 1");
		$date1= strtotime($row4['comment_date']);
		$comment_date= substr(date('r',$date1),0,-6);
		while($row5 = mysql_fetch_array($queryPV))
		{
			$pic_group[]=$row5['viewer_group'];
		}
		if($row4['PV_id']==0) $color='darkblue';
		else $color='black';
		$comments[] = "<div style=\"display:inline-block;vertical-align:top;text-align:left;color:$color;\">".$row4['comment']."<font size='3'>($comment_date - $name)</font></div>";
		$pic_upload_id[]=$row4['upload_id'];
		$owner_id[]=$row4['user_id'];
	}
}
$last = ceil($Comcount/$page_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $last) $pagenum = $last; 
$first_row=($pagenum -1)* $page_rows;
$previous = $pagenum-1;
if($previous <= 0) $previous=1;
$next = $pagenum+1;
if($next > $Comcount) $next=$Comcount;
	if(isset($comments)) {
		$listcount=0;
		foreach ($comments as $key => $comment) {
			$listcount++;
			if($listcount > $first_row && $listcount <= ($first_row+$page_rows)){
				echo "<div>";
					echo '<div style="display:inline-block;">';
					echo "<img src=\"$result_profile_picture[$key]\" height=\"38\" style=\"border:none;\">";
					echo "</div>";
					echo $comment;
				echo "</div>";
			}
		}
	}

?> 

