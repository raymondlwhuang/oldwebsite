<?php
include("../config.php");
if(isset($_REQUEST['pagenum'])) $pagenum = (int)$_REQUEST['pagenum']; 
else $pagenum = 1; 
if(isset($_REQUEST['page_rows'])) $page_rows = (int)$_REQUEST['page_rows']; 
else $page_rows = 4;  
$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 

if(isset($_REQUEST['VideoWidth'])) $VideoWidth = (int)$_REQUEST['VideoWidth']; 
else $VideoWidth = 320;  
if(isset($_REQUEST['FriendID']))
{
	$FriendID = (int)$_REQUEST['FriendID'];
	$viewer_id = (int)$_REQUEST['viewer_id'];
	$getviewer=mysql_query("SELECT * FROM user where id = $FriendID limit 1");  // query string stored in a variable
	while($vieweresult = mysql_fetch_array($getviewer)) {
		$viewer_path=$vieweresult['owner_path'];
		$viewer_email_address=$vieweresult['email_address'];
		$user_id=$vieweresult['id'];
	}	
	if(isset($_REQUEST['show_id']) && $_REQUEST['show_id']!='')	$show_id=$_REQUEST['show_id'];
	if($FriendID == 'Public') {
		$Picked['Public'] = 'Public';
		$GetSomething="both";
	}
	else if($FriendID == $viewer_id) {
			$GetSomething='';
			$user_id=$viewer_id;
			$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$viewer_path' and viewer_group <> 'Public'");  // query string stored in a variable
			while($row3 = mysql_fetch_array($beforeShow)) {
				if($GetSomething=='') $GetSomething=$row3['picture_video'];
				elseif($GetSomething!=$row3['picture_video']) $GetSomething="both";
			}	
			if($GetSomething=='') $Picked['Public'] = 'Public';	
	
			$queryPermission="SELECT * FROM view_permission where owner_email = '$viewer_email_address' group by viewer_group";  // query string stored in a variable
			$resultPermission=mysql_query($queryPermission);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row = mysql_fetch_array($resultPermission))
			{
			 $viewer_group = $row['viewer_group'];
			 $viewer_path = $row['owner_path'];
			 $Picked[$viewer_path] = $viewer_group;
			}
		}	
	else {
			$GetSomething='';
			$getowner=mysql_query("SELECT * FROM user where id = '$FriendID' limit 1");  // query string stored in a variable
			while($owneresult = mysql_fetch_array($getowner)) {
				$result_path=$owneresult['owner_path'];
				$user_id=$owneresult['id'];
			}
			$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and viewer_group <> 'Public'");  // query string stored in a variable
			while($row3 = mysql_fetch_array($beforeShow)) {
				if($GetSomething=='') $GetSomething=$row3['picture_video'];
				elseif($GetSomething!=$row3['picture_video']) $GetSomething="both";
			}	
			if($GetSomething=='') $Picked['Public'] = 'Public';	
	
			$queryPermission="SELECT * FROM view_permission where user_id = $FriendID and viewer_id = $viewer_id order by owner_path";  // query string stored in a variable
			$resultPermission=mysql_query($queryPermission);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row = mysql_fetch_array($resultPermission))
			{
			 $viewer_group = $row['viewer_group'];
			 $owner_path = $row['owner_path'];
			 $Picked[$owner_path] = $viewer_group;
			} 
		}
}
else {
	$FriendID=$viewer_id;
	$queryPermission="SELECT * FROM view_permission where owner_email = '$viewer_email_address' group by viewer_group";  // query string stored in a variable
	$resultPermission=mysql_query($queryPermission);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row = mysql_fetch_array($resultPermission))
	{
	 $viewer_group = $row['viewer_group'];
	 $viewer_path = $row['owner_path'];
	 $Picked[$viewer_path] = $viewer_group;
	}
	$GetSomething='';
	$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$viewer_path' and viewer_group <> 'Public'");  // query string stored in a variable
	while($row3 = mysql_fetch_array($beforeShow)) {
		if($GetSomething=='') $GetSomething=$row3['picture_video'];
		elseif($GetSomething!=$row3['picture_video']) $GetSomething="both";
	}	
	if($GetSomething=='') $Picked['Public'] = 'Public';
}
$videocount = 0;

if(isset($Picked)) {
	foreach ($Picked as $key => $value) {
		if($key =='Public') {
			$query="SELECT * FROM upload_infor where viewer_group = 'Public' and name <> ''";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
		}
		else {
			$getowner2=mysql_query("SELECT * FROM user where owner_path = '$key' limit 1");  // query string stored in a variable
			while($owneresult2 = mysql_fetch_array($getowner2)) {
				$user_id1=$owneresult2['id'];
			}			
		
			$query="SELECT * FROM upload_infor where user_id=$user_id1 and (viewer_group = '$value' or viewer_group = '') and name <> '' $max";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
		}
		while($row2 = mysql_fetch_array($result))
		{
			$video[]=$row2['name'].".";
			$VDupload_id[]=$row2['id'];
		};
	}
}


if(isset($video)) {
	foreach ($video as $key => $value) {
		echo "
		<video width='130' onClick=\"Action('ShowVideos.php?video=$value'+'&VideoWidth='+VideoWidth,'videomain','$VDupload_id[$key]');\" class='pointer'>
		  <source src='$video[$key]mp4' type='video/mp4' />
		  <source src='$video[$key]ogg' type='video/ogg' />
		  <source src='$video[$key]ogv' type='video/ogv' />
		  <source src='$video[$key]webm' type='video/webm' />
		  <source src='$video[$key]mp4video.mp4' type='video/mp4' />
		  <source src='$video[$key]theora.ogv' type='video/ogg' />
		  <source src='$video[$key]webmvp8.webm' type='video/webm' />
		  Your browser does not support the video tag.
		</video>";
	}    
}

?>
