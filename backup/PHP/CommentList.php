<?php 
 // Connects to your Database 
include("../config.php");
$user_id=(int)$_REQUEST['FriendID'];
if(isset($_REQUEST['pagenum'])) $pagenum = (int)$_REQUEST['pagenum'];
if (!(isset($pagenum)))	$pagenum = 1; 
$page_rowsC=4;
$maxC = 'limit ' .($pagenum - 1) * $page_rowsC .',' .$page_rowsC; 
$queryComment=mysql_query("SELECT * FROM pv_comment where viewer_user_id=$user_id order by id desc $maxC");  // query string stored in a variable
echo mysql_error(); 
while($row4 = mysql_fetch_array($queryComment))
{	
	$queryUser=mysql_query("SELECT * FROM user where id=$row4[user_id] limit 1");
	while($row6 = mysql_fetch_array($queryUser))
	{		
		$name=$row6['first_name']." ".$row6['last_name'];
		$profile_picture=$row6['profile_picture'];
	}	
	$queryPV=mysql_query("SELECT * FROM picture_video where upload_id=$row4[upload_id] limit 1");
	
	while($row5 = mysql_fetch_array($queryPV))
	{	
		$pic_group=$row5['viewer_group'];
	}
	$date1= strtotime($row4['comment_date']);
	$comment_date= substr(date('r',$date1),0,-15);
	$comment_tmp="<input type=\"image\" src=\"../images/view.png\" name=\"view\" value=\"view\" width=\"16\" onClick=\"window.open('CommentPicture.php?owner_id=$row4[user_id]&viewer_group=$pic_group&upload_id=$row4[upload_id]',target='_top');\">";

	$comment_tmp.=$row4['comment'].$row4['upload_id']."<font color='darkblue'> on $name"."'s</font> ";
	if($row4['type']==1) $comment_tmp.="<font color='blue'>video</font>($comment_date)<br/>";
	else $comment_tmp.="<font color='red'>photo</font>($comment_date)</font><br/>";
	
	echo $comment_tmp;
}


?> 