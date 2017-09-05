<?php 
 // Connects to your Database 
include("../config.php");
$upload_id=(int)$_REQUEST['upload_id'];
$type=(int)$_REQUEST['type'];
if(isset($_REQUEST['pagenum'])) $pagenum = (int)$_REQUEST['pagenum'];
else $pagenum = 1; 
if(isset($_REQUEST['page_rows'])) $page_rows = (int)$_REQUEST['page_rows']; 
else $page_rows = 2;  
$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
if(isset($upload_id))	{
	$queryComment=mysql_query("SELECT * FROM pv_comment where upload_id=$upload_id and type = $type order by id desc $max");  // query string stored in a variable
	echo mysql_error(); 
	while($row = mysql_fetch_array($queryComment))
	{		
		$queryUser=mysql_query("SELECT * FROM user where id='$row[viewer_user_id]' limit 1");
		while($row2 = mysql_fetch_array($queryUser))
		{		
			$Currname=$row2['first_name']." ".$row2['last_name'];
			$Currprofile_picture=$row2['profile_picture'];
			echo "<div style=\"display:inline-block;\"><img src=\"$Currprofile_picture\" height=\"37\"></div>";
		}				
		$date1= strtotime($row['comment_date']);
		$comment_date= substr(date('r',$date1),0,-5);
		$CurrComment = "<font size=\"3\">".$row['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
		echo "<div style=\"display:inline-block;vertical-align:top;\">".$CurrComment."</div><br/>";
		
	}
}

?> 