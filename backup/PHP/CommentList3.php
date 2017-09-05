<?php 
 // Connects to your Database 
include("../config.php");
$upload_id=(int)$_REQUEST['upload_id'];
$type=(int)$_REQUEST['type'];
if(isset($_REQUEST['pagenum'])) $pagenum = (int)$_REQUEST['pagenum'];
else $pagenum = 1; 
if(isset($_REQUEST['VideoCompage_rows'])) $VideoCompage_rows = (int)$_REQUEST['VideoCompage_rows']; 
else $VideoCompage_rows = 2;  
$max = 'limit ' .($pagenum - 1) * $VideoCompage_rows .',' .$VideoCompage_rows; 
$VideoComcount=0;
if(isset($upload_id))	{
	$queryComment3=mysql_query("SELECT * FROM pv_comment where upload_id=$upload_id and type=$type order by id desc");  // query string stored in a variable
	echo mysql_error();
	$VideoComcount=mysql_num_rows($queryComment3);
	while($row13 = mysql_fetch_array($queryComment3))
	{	
		$curr_user=$row13['viewer_user_id'];
		$queryUser=mysql_query("SELECT * FROM user where id=$curr_user limit 1");
		while($row15 = mysql_fetch_array($queryUser))
		{		
			$Currname=$row15['first_name']." ".$row15['last_name'];
			$CurrVideoprofile_picture[]=$row15['profile_picture'];
		}				
		$date1= strtotime($row13['comment_date']);
		$comment_date= substr(date('r',$date1),0,-5);
		$CurrVideoComment[] = "<font size=\"3\">".$row13['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
		$Videoupload_id[]=$upload_id;
	}	
$VideoCompage_rows = 2;  
$VideoComplast = ceil($VideoComcount/$VideoCompage_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $VideoComplast) $pagenum = $VideoComplast; 
$first_row=($pagenum -1)* $VideoCompage_rows;
$previous = $pagenum-1;
if($previous <= 0) $previous=1;
$next = $pagenum+1;
if($next > $VideoComcount) $next=$VideoComcount;
$VideoComplast = ceil($VideoComcount/$VideoCompage_rows); 
	if($VideoComcount==0)  $height="0px";
	elseif($VideoComcount==1)  $height="49px";
	else $height="98px";
	echo "<div style=\"width:17px;display:inline-block;height:$height;\">";
	echo "<img src=\"../images/first_up2.png\" id='VideoComfirst' onClick=\"CommentList3('first',$upload_id,1,0);\"><br/>";
	echo "<img src=\"../images/previous_up2.png\" id='VideoComprevious'  onClick=\"CommentList3('previous',$upload_id,1,0);\"><br/>";
	echo "<img src=\"../images/next_up.png\" id='VideoComnext' onClick=\"CommentList3('next',$upload_id,1,0);\"><br/>";
	echo "<img src=\"../images/last_up.png\" id='VideoComlast'  onClick=\"CommentList3('last',$upload_id,1,0);\">";
	echo "</div>";
	echo "<div style=\"background-color:#E6FFE6;height:$height;display:inline-block;vertical-align:top;\">";
	echo "<div id=\"CurrVideoComment\" style=\"width:570px;display:inline-block;vertical-align:top;font-size:13px\">";
			$listcount=0;
	if(isset($CurrVideoComment)) {
			foreach ($CurrVideoComment as $key2 => $comment2) {
				$listcount++;
				if($listcount > $first_row && $listcount <= ($first_row+$VideoCompage_rows)){
					echo "<div style=\"display:inline-block;\"><img src=\"$CurrVideoprofile_picture[$key2]\" height=\"37\" class='img' ></div>";
					echo "<div style=\"display:inline-block;vertical-align:top;\">".$comment2."</div><br/>";
				}
			}				
	echo "</div>";
	echo "</div>";
	}	
}

?> 
<script type="text/javascript">
VideoComcount = <?php echo $VideoComcount; ?>;
VideoCompage_rows = <?php echo $VideoCompage_rows; ?>;
VideoComplast = <?php echo $VideoComplast; ?>;
if(VideoComcount<=VideoCompage_rows) {
	document.getElementById('VideoComfirst').style.display = "none";
	document.getElementById('VideoComprevious').style.display = "none";
	document.getElementById('VideoComnext').style.display = "none";
	document.getElementById('VideoComlast').style.display = "none";
}
if(VideoComcount==0) document.getElementById('VDComment').style.display = "none";
else  document.getElementById('VDComment').style.display = "block";
</script>
