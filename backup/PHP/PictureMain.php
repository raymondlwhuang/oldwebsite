<?php
@session_start();
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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
}
include("../config.php");
if(isset($_SESSION['private']) && $_SESSION['private'] == "yes")
{
	include("../inc/GlobalVar.inc.php");
	$profile_picture=$GV_profile_picture;
	$user_id=$GV_id;
	$curr_path=$GV_owner_path;
	if(isset($_REQUEST['comment']))
	{
		$upload_id2 = (int)$_REQUEST['upload_id'];
		$comment =  mysql_real_escape_string($_REQUEST['comment']);
		if(isset($_REQUEST['ViewingID']) && $_REQUEST['ViewingID'] != "" && $_REQUEST['ViewingID'] != "Public" && $_REQUEST['ViewingID'] != "Temporary") $ViewingID = $_REQUEST['ViewingID'];
		else $ViewingID = $GV_id;
		$beforeIns=mysql_query("SELECT * FROM pv_comment where upload_id=$upload_id2 and user_id=$ViewingID and viewer_user_id=$GV_id and comment='$comment' and type=0 limit 1");  // query string stored in a variable
		if(mysql_num_rows($beforeIns)==0) mysql_query("INSERT INTO pv_comment(upload_id,viewer_user_id,user_id,name,comment) VALUES($upload_id2,$GV_id,$ViewingID,'$GV_name','$comment')"); /* I am a viewer, the name is my name for display purpose*/

	} 
	elseif(isset($_REQUEST['VideoComment']))
	{
		$upload_id2 = (int)$_REQUEST['video_id'];
		$_SESSION["video_id"]=$upload_id2;
		$_SESSION["video_name"]=mysql_real_escape_string($_REQUEST['video_name']);
		if(isset($_REQUEST['ViewingID']) && $_REQUEST['ViewingID'] != "" && $_REQUEST['ViewingID'] != "Public" && $_REQUEST['ViewingID'] != "Temporary") $ViewingID = $_REQUEST['ViewingID'];
		else $ViewingID = $GV_id;
		$comment =  mysql_real_escape_string($_REQUEST['VideoComment']);
		$pv_idresult=mysql_query("SELECT * FROM picture_video where picture_video='videos' and upload_id=$upload_id2 limit 1");  // query string stored in a variable
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($pv_idrow = mysql_fetch_array($pv_idresult))
		{
			$PV_id=$pv_idrow['id'];
		};	
		if($comment!="") {
			$beforeIns=mysql_query("SELECT * FROM pv_comment where PV_id = $PV_id and upload_id=$upload_id2 and user_id=$ViewingID and viewer_user_id=$GV_id and comment='$comment' and type=1 limit 1");  // query string stored in a variable
			if(mysql_num_rows($beforeIns)==0) mysql_query("INSERT INTO pv_comment(upload_id,viewer_user_id,user_id,name,comment,PV_id,type) VALUES($upload_id2,$GV_id,$ViewingID,'$GV_name','$comment',$PV_id,1)"); /* I am a viewer, the name is my name for display purpose*/
			echo mysql_error();
		}		
	}
}
$upload_id=0;
if(isset($GV_id) && (isset($_REQUEST['FriendID']) || isset($_REQUEST['ViewingID']) || isset($_SESSION["FriendID"])) )
{
	if(isset($_REQUEST['FriendID'])) {
		$FriendID = $_REQUEST['FriendID'];
		$_SESSION["FriendID"]=$FriendID;
	}
	elseif(isset($_REQUEST['ViewingID'])) {
		$FriendID = $_REQUEST['ViewingID'];
		$_SESSION["FriendID"]=$FriendID;
	}
	else $FriendID=$_SESSION["FriendID"];
	if(isset($_REQUEST['show_id']) && $_REQUEST['show_id']!='')	{
		$show_id=$_REQUEST['show_id'];
		$_SESSION["show_id"]=$show_id;
	}
	
	if(!isset($show_id) && isset($_SESSION["show_id"]) && $FriendID!="Public" && $FriendID!="SharedPicture") $show_id=$_SESSION["show_id"];
	if($FriendID == 'Public') {
		$Picked['Public'] = 'Public';
		$GetSomething="both";
		$user_id='Public';
	}
	elseif($FriendID == 'Temporary') {
		$TemporaryShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Temporary' and upload_id=$show_id order by upload_id desc,id desc limit 1");  // query string stored in a variable
		while($Temporaryrow = mysql_fetch_array($TemporaryShow)) {
			$TemporaryPath=$Temporaryrow['owner_path'];
		}
		$TemporaryShow2=mysql_query("SELECT * FROM user where owner_path = '$TemporaryPath' limit 1");  // query string stored in a variable
		while($Temporaryrow2 = mysql_fetch_array($TemporaryShow2)) {
			$TemporaryUser=$Temporaryrow2['id'];
		}
		$Picked['Temporary'] = 'Temporary';
		$GetSomething="both";
		$user_id='Temporary';
	}	
	elseif($FriendID == 'SharedPicture') {
		$Picked['SharedPicture'] = 'SharedPicture';
		$GetSomething="both";
		$user_id='SharedPicture';
	}	
	else if($FriendID == $GV_id) {
			$GetSomething='';
			$user_id=$GV_id;
			$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$GV_owner_path' and viewer_group <> 'Public' and viewer_group <> 'Temporary'");  // query string stored in a variable
			while($row3 = mysql_fetch_array($beforeShow)) {
				if($GetSomething=='') $GetSomething=$row3['picture_video'];
				elseif($GetSomething!=$row3['picture_video']) $GetSomething="both";
			}	
			if($GetSomething=='' && $FriendID!="Temporary") $Picked['Public'] = 'Public';	
			elseif($GetSomething=='' && $FriendID=="Temporary") $Picked['Temporary'] = 'Temporary';	
			else {
				$queryPermission="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_group";  // query string stored in a variable
				$resultPermission=mysql_query($queryPermission);          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				while($row = mysql_fetch_array($resultPermission))
				{
				 $viewer_group = $row['viewer_group'];
				 $Picked[$GV_owner_path] = $viewer_group;
				}
			}
		}	
	else {
			$GetSomething='';
			$getowner1=mysql_query("SELECT * FROM user where id = $FriendID limit 1");  // query string stored in a variable
			while($owneresult1 = mysql_fetch_array($getowner1)) {
				$result_path=$owneresult1['owner_path'];
				$user_id=$owneresult1['id'];
				$curr_path=$result_path;
				$profile_picture=$owneresult1['profile_picture'];
			}
			$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and viewer_group <> 'Public' and viewer_group <> 'Temporary'");  // query string stored in a variable
			while($row3 = mysql_fetch_array($beforeShow)) {
				if($GetSomething=='') $GetSomething=$row3['picture_video'];
				elseif($GetSomething!=$row3['picture_video']) $GetSomething="both";
			}	
			if($GetSomething=='' && $FriendID!="Temporary") $Picked['Public'] = 'Public';	
			elseif($GetSomething=='' && $FriendID=="Temporary") $Picked['Temporary'] = 'Temporary';	
			else {
				$queryPermission="SELECT * FROM view_permission where user_id = $FriendID and viewer_id = $GV_id order by owner_path";  // query string stored in a variable
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
}
elseif(isset($GV_id) && !(isset($_REQUEST['FriendID']) || isset($_REQUEST['ViewingID']) || isset($_SESSION["FriendID"]))) {
	$FriendID=$GV_id;
	$GetSomething='';
	$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$GV_owner_path' and viewer_group <> 'Public' and viewer_group <> 'Temporary'");  // query string stored in a variable
	while($row3 = mysql_fetch_array($beforeShow)) {
		if($GetSomething=='') $GetSomething=$row3['picture_video'];
		elseif($GetSomething!=$row3['picture_video']) $GetSomething="both";
	}	
	if($GetSomething=='' && $FriendID!="Temporary") $Picked['Public'] = 'Public';
	elseif($GetSomething=='' && $FriendID=="Temporary") $Picked['Public'] = 'Public';
	else {
		$queryPermission="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_group";  // query string stored in a variable
		$resultPermission=mysql_query($queryPermission);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		while($row = mysql_fetch_array($resultPermission))
		{
		 $viewer_group = $row['viewer_group'];
		 $GV_owner_path = $row['owner_path'];
		 $Picked[$GV_owner_path] = $viewer_group;
		}
	}
}
elseif(isset($_REQUEST['FriendID']) && $_REQUEST['FriendID']=="Temporary") {
	if(isset($_REQUEST['show_id']) && $_REQUEST['show_id']!='')	{
		$show_id=$_REQUEST['show_id'];
		$_SESSION["show_id"]=$show_id;
	}
	$TemporaryShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Temporary' and upload_id=$show_id order by upload_id desc,id desc limit 1");  // query string stored in a variable
	while($Temporaryrow = mysql_fetch_array($TemporaryShow)) {
		$TemporaryPath=$Temporaryrow['owner_path'];
	}
	$TemporaryShow2=mysql_query("SELECT * FROM user where owner_path = '$TemporaryPath' limit 1");  // query string stored in a variable
	while($Temporaryrow2 = mysql_fetch_array($TemporaryShow2)) {
		$TemporaryUser=$Temporaryrow2['id'];
	}
	$FriendID="Temporary";
	$Picked['Temporary'] = 'Temporary';
}
else {
	$FriendID="Public";
	$Picked['Public'] = 'Public';
}
$Videocount = 0;
$OwnerComcount=0;
$PictureComcount=0;
$VideoComcount=0;

if(isset($Picked)) {
	foreach ($Picked as $key => $value) {
		if($key =='Public') {
			$query="SELECT * FROM upload_infor where viewer_group = 'Public' and name <> ''";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($result))
			{
				$video[$Videocount]=$row2['name'].".";
				$VDupload_id[$Videocount]=$row2['id'];
				$VideoGroup[$Videocount]=$value;
				$Videocount++;
			};
		}
		elseif($key =='Temporary') {
			$query="SELECT * FROM upload_infor where viewer_group = 'Temporary' and user_id=$TemporaryUser and name <> ''";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($result))
			{
				$video[$Videocount]=$row2['name'].".";
				$VDupload_id[$Videocount]=$row2['id'];
				$VideoGroup[$Videocount]=$value;
				$Videocount++;
			};
		}
		elseif($key =='SharedPicture') {
			$query="SELECT * FROM pv_share where shareto_id = $GV_id and is_video=1";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($result))
			{
				$pos = strpos($row2['pv_name'], ".",3);
				$video[]=substr($row2['pv_name'],0,$pos).".";
				$VideoGroup[$Videocount]=$value;
				$Videocount++;
				$upload_idresult=mysql_query("SELECT * FROM picture_video where id=$row2[pv_id] limit 1"); 
				while($upload_idrow = mysql_fetch_array($upload_idresult))
				{
					$VDupload_id[]=$upload_idrow['upload_id'];
				}				
			};
		}
		else {
			$getowner2=mysql_query("SELECT * FROM user where owner_path = '$key' limit 1");  // query string stored in a variable
			while($owneresult2 = mysql_fetch_array($getowner2)) {
				$user_id1=$owneresult2['id'];
			}			
		
			$query="SELECT * FROM upload_infor where user_id=$user_id1 and (viewer_group = '$value' or viewer_group = '') and name <> ''";  // query string stored in a variable
			$result=mysql_query($query);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($result))
			{
				$video[$Videocount]=$row2['name'].".";
				$VDupload_id[$Videocount]=$row2['id'];
				$VideoGroup[$Videocount]=$value;
				$Videocount++;
			};
		}
	}
}
if(isset($user_id) && $user_id!='Public' && $user_id!='Temporary' && $user_id!='SharedPicture')	{
	$name="";
	$queryComment=mysql_query("SELECT * FROM pv_comment where viewer_user_id=$user_id order by id desc");  // query string stored in a variable
	echo mysql_error(); 
	$OwnerComcount=mysql_num_rows($queryComment);
	while($row4 = mysql_fetch_array($queryComment))
	{		
		$queryUser=mysql_query("SELECT * FROM user where id=$row4[user_id] limit 1");
		while($row6 = mysql_fetch_array($queryUser))
		{		
			$name=$row6['first_name']." ".$row6['last_name'];
			$profile_picture=$row6['profile_picture'];
		}				
		$queryPV=mysql_query("SELECT * FROM picture_video where upload_id=$row4[upload_id] limit 1");
		$date1= strtotime($row4['comment_date']);
		$comment_date= substr(date('r',$date1),0,-15);
		if($FriendID!='Public' && $FriendID!='SharedPicture' && $FriendID!='Temporary') {
			while($row5 = mysql_fetch_array($queryPV))
			{
				$pic_group[]=$row5['viewer_group'];
			}
			$comment_tmp=$row4['comment']."<font color='darkblue'> on $name"."'s</font> ";
			if($row4['type']==1) $comment_tmp.="<font color='blue'>video</font>($comment_date)<br/>";
			else $comment_tmp.="<font color='red'>photo</font>($comment_date)</font><br/>";
			$comments[] = $comment_tmp;
			$pic_upload_id[]=$row4['upload_id'];
			$owner_id[]=$row4['user_id'];
		}
	}
}
	
if(isset($_REQUEST['FriendID']) || isset($_SESSION["FriendID"])) {
	if(isset($_REQUEST['FriendID'])) $FriendID = $_REQUEST['FriendID'];
	else $FriendID = $_SESSION["FriendID"];
	if($FriendID!='Public' && $FriendID!='Temporary' && $FriendID!='SharedPicture') {
		$getowner=mysql_query("SELECT * FROM user where id = $FriendID limit 1");  // query string stored in a variable
		while($owneresult = mysql_fetch_array($getowner)) {
			$result_path=$owneresult['owner_path'];
			$result_name=ucfirst(strtolower($owneresult['first_name']))." ".ucfirst(strtolower($owneresult['last_name']));
			$result_profile_picture=$owneresult['profile_picture'];
		}
	}
}
elseif(isset($GV_id)) {
 $FriendID=$GV_id;
 $result_path = $GV_owner_path;
 $result_name=$GV_name;
 $result_profile_picture=$GV_profile_picture;
}
elseif(isset($FriendID) && $FriendID=="Temporary") {
 $FriendID="Temporary";
}
else $FriendID="Public";
$GetSomething=0;
if(isset($result_path)) {
	$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and viewer_group <> 'Public' and viewer_group <> 'Temporary' order by upload_id desc, id desc limit 1");  // query string stored in a variable
	if(mysql_num_rows($beforeShow) != 0) {
		$GetSomething=1;
	}
}
 
	if(isset($upload_id2)){ $upload_id = $upload_id2;	}
	elseif(isset($show_id)) $upload_id = $show_id;
	if(!isset($upload_id) || $upload_id =="")
	{
		if($GetSomething==0){ 
			$beforeShow2=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public' order by upload_id desc,id desc limit 1");  // query string stored in a variable
//			echo "PUBLIC PICTURES";
		}
		elseif($FriendID=="Temporary") 
			$beforeShow2=mysql_query("SELECT * FROM picture_video where upload_id = $upload_id and picture_video = 'pictures' order by upload_id desc limit 1");  // query string stored in a variable
		else 
			$beforeShow2=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and picture_video = 'pictures' and viewer_group <> 'Public' and viewer_group <> 'Temporary' order by upload_id desc limit 1");  // query string stored in a variable
		while($row7 = mysql_fetch_array($beforeShow2))
		{
			$upload_id = $row7['upload_id'];
		}
	}
	if(isset($GV_id) && isset($upload_id) && $upload_id!="" && $upload_id!=0 && $upload_id!="SharedPicture") $resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and upload_id = $upload_id order by upload_id desc, id desc");  // query string stored in a variable
	elseif($upload_id=="SharedPicture") $resultShow=mysql_query("SELECT * FROM pv_share where shareto_id = $GV_id and is_video=0 order by id desc");  // query string stored in a variable
	elseif(!isset($GV_id) && isset($FriendID) && $FriendID=="Temporary") $resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Temporary' and upload_id=$upload_id order by upload_id desc, id desc");  // query string stored in a variable
	else $resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public' order by upload_id desc, id desc");  // query string stored in a variable

	$markup = '<div  id="slideshow">';
	$pictureCount=0;
	$markupviewer_group="";
	while($row3 = mysql_fetch_array($resultShow)) {
		$pictureCount++;
		if($upload_id=="SharedPicture") {
			$markup .= "<img class=\"pointer\" style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 420px;\" src=\"$row3[pv_name]\" height=\"420\">";
		}
		else {
			$markupviewer_group=$row3['viewer_group'];
			$markup .= "<img class=\"pointer\" style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 420px;\" src=\"$row3[name]\" height=\"420\">";
		}
	};
	if($pictureCount==0) $markup .= "<img style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 420px;\" src=\"../images/blank.jpg\" height=\"420\"><img style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 420px;\" src=\"../images/blank.jpg\" height=\"420\">";
	//elseif($pictureCount==1) $markup .= "<img style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 420px;\" src=\"../images/blank.jpg\" height=\"420\">";
	$markup .= '</div>';	
	if(isset($upload_id) && $upload_id!='' && $upload_id!="SharedPicture")	{
		$queryComment2=mysql_query("SELECT * FROM pv_comment where upload_id=$upload_id and type=0 order by id desc");  // query string stored in a variable
		echo mysql_error(); 
		$PictureComcount=mysql_num_rows($queryComment2);
		while($row8 = mysql_fetch_array($queryComment2))
		{	
			$curr_user=$row8['viewer_user_id'];
			$queryPV2=mysql_query("SELECT * FROM picture_video where upload_id=$row8[upload_id] limit 1");
			$queryUser=mysql_query("SELECT * FROM user where id=$curr_user limit 1");
			while($row10 = mysql_fetch_array($queryUser))
			{		
				$Currname=$row10['first_name']." ".$row10['last_name'];
				$Currprofile_picture[]=$row10['profile_picture'];
			}				
			$date1= strtotime($row8['comment_date']);
			$comment_date= substr(date('r',$date1),0,-5);
			$CurrComment[] = "<font size=\"3\">".$row8['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
		}
	}
	if(isset($video)) {
		foreach ($video as $key => $value) {
			$queryComment3=mysql_query("SELECT * FROM pv_comment where upload_id=$VDupload_id[$key] and type=1 order by id desc");  // query string stored in a variable
			echo mysql_error();
			if(isset($_SESSION["video_id"])) {
				if($_SESSION["video_id"]==$VDupload_id[$key]) $VideoComcount=$VideoComcount+mysql_num_rows($queryComment3);
			}
			else if($key==0) $VideoComcount=$VideoComcount+mysql_num_rows($queryComment3);
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
				if(isset($_SESSION["video_id"])) {
					if($_SESSION["video_id"]==$VDupload_id[$key]) {
						$CurrVideoComment[] = "<font size=\"3\">".$row13['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
						$Videoupload_id[]=$VDupload_id[$key];
					}
				}
				elseif($key==0)	{
					$CurrVideoComment[] = "<font size=\"3\">".$row13['comment']."</font><font size=\"3\" color='darkblue'><br/>$comment_date ($Currname)</font><br/>";
					$Videoupload_id[]=$VDupload_id[$key];
				}
			}
		}
	}
$Videopagenum = 1; 
$Videopage_rows = 4;
$Videolast = ceil($Videocount/$Videopage_rows); 
if ($Videopagenum < 1) $Videopagenum = 1; elseif ($Videopagenum > $Videolast) $Videopagenum = $Videolast; 
$Videofirst_row=($Videopagenum -1)* $Videopage_rows;
$Videoprevious = $Videopagenum-1;
if($Videoprevious <= 0) $Videoprevious=1;
$Videonext = $Videopagenum+1;
if($Videonext > $Videocount) $Videonext=$Videocount;

$VideoCompagenum = 1; 
$VideoCompage_rows = 2;  
$VideoComlast = ceil($VideoComcount/$VideoCompage_rows); 
if ($VideoCompagenum < 1) $VideoCompagenum = 1; elseif ($VideoCompagenum > $VideoComlast) $VideoCompagenum = $VideoComlast; 
$VideoComfirst_row=($VideoCompagenum -1)* $VideoCompage_rows;
$VideoComprevious = $VideoCompagenum-1;
if($VideoComprevious <= 0) $VideoComprevious=1;
$VideoComnext = $VideoCompagenum+1;
if($VideoComnext > $VideoComcount) $VideoComnext=$VideoComcount;

$Ownerpagenum = 1; 
$Ownerpage_rows = 4;  
$Ownerlast = ceil($OwnerComcount/$Ownerpage_rows); 
if ($Ownerpagenum < 1) $Ownerpagenum = 1; elseif ($Ownerpagenum > $Ownerlast) $Ownerpagenum = $Ownerlast; 
$Ownerfirst_row=($Ownerpagenum -1)* $Ownerpage_rows;
$Ownerprevious = $Ownerpagenum-1;
if($Ownerprevious <= 0) $Ownerprevious=1;
$Ownernext = $Ownerpagenum+1;
if($Ownernext > $OwnerComcount) $Ownernext=$OwnerComcount;
$Ownercount=0;
	
$Picturepagenum = 1; 
$Picturepage_rows = 2;  
$Picturelast = ceil($PictureComcount/$Picturepage_rows); 
if ($Picturepagenum < 1) $Picturepagenum = 1; elseif ($Picturepagenum > $Picturelast) $Picturepagenum = $Picturelast; 
$Picturefirst_row=($Picturepagenum -1)* $Picturepage_rows;
$Pictureprevious = $Picturepagenum-1;
if($Pictureprevious <= 0) $Pictureprevious=1;
$Picturenext = $Picturepagenum+1;
if($Picturenext > $PictureComcount) $Picturenext=$PictureComcount;
if($FriendID!="Public" && $FriendID!="SharedPicture" && $FriendID!="Temporary") {
	$UserScreen=mysql_query("SELECT * FROM user_screen where user_id = $FriendID ORDER BY  `id` DESC limit 1 ");  // query string stored in a variable
	echo mysql_error(); 
	$UserBrowser=mysql_query("SELECT * FROM user_browser where user_id = $FriendID ORDER BY  `id` DESC ");  // query string stored in a variable
	echo mysql_error(); 
	$UserOS=mysql_query("SELECT * FROM user_os where user_id = $FriendID ORDER BY  `id` DESC limit 1");  // query string stored in a variable
	echo mysql_error(); 
	$UserLocation=mysql_query("SELECT * FROM user_location where user_id = $FriendID ORDER BY  `id` DESC limit 1");  // query string stored in a variable
	echo mysql_error(); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html class="cufon-active cufon-ready">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My Blog</title>
<style type="text/css" media="screen">
.pointer { cursor: pointer }
.slideshow { height: 420px; width: 610px; margin: auto;position: relative;display:inline-block; }
.slideshow img { padding: 15px; border: 1px solid #ccc; background-color: #eee; }

</style>
</head>
<body>
<table width="100%" border="0" align="left" >
<tr id="pictures">
	<td colspan="3" >
		<?php if($upload_id!="SharedPicture" && $FriendID!="Temporary") echo "<div style=\"height:420px;\" id=\"show\" onClick=\"window.open('CommentPicture.php?owner_id=$FriendID&viewer_group=$markupviewer_group&upload_id=$upload_id&viewingOn=$FriendID',target='_top');\">";
			  elseif($pictureCount>0 && $FriendID=="Temporary")  echo "<div style=\"height:420px;\" id=\"show\" >";
			  elseif($pictureCount>0 && $FriendID!="Temporary")  echo "<div style=\"height:420px;\" id=\"show\" onClick=\"window.open('ComSharePic.php',target='_top');\">";
			  echo $markup; 
		?>
		</div>
		<?php if($FriendID!="Temporary") : ?>
		<div id="PicCtrl">
		<a id="prev2" href="#" onclick="backforward2();return false;"><input type="image" src="../images/backward.png" id="backward" style="display:none;"></a>
		<input type="image" src="../images/play.png" id='play'  onClick="start_show();" style="display:none;">
		<?php 
			if($pictureCount>0) {
				if($upload_id!="SharedPicture") echo "<input type=\"image\" src=\"../images/to_view.png\" id='to_view' onClick=\"window.open('CommentPicture.php?owner_id=$FriendID&viewer_group=$markupviewer_group&upload_id=$upload_id&viewingOn=$FriendID',target='_top');\">";
				else echo "<input type=\"image\" src=\"../images/to_view.png\" id='to_view' onClick=\"window.open('ComSharePic.php',target='_top');\">";
			}
		?>
		<input type="image" src="../images/stop.png" id='stop' onClick="stop_show();">
		<a id="next2" href="#" onclick="backforward2();return false;"><input type="image" src="../images/forward.png" id="forward" style="display:none;"></a>
		</div>		
		<?php endif; ?>
		<?php if(isset($CurrComment) && $upload_id!="SharedPicture" && $FriendID!="Temporary") {
			echo "<div id=\"PicNav\" style=\"width:17px;display:inline-block;height:78px;\">";
			echo "<input type='image' src=\"../images/first_up2.png\" id='Picturefirst' onClick=\"CommentList2('first',$upload_id,0);\"><br/>";
			echo "<input type='image' src=\"../images/previous_up2.png\" id='Pictureprevious'  onClick=\"CommentList2('previous',$upload_id,0);\"><br/>";
			echo "<input type='image' src=\"../images/next_up.png\" id='Picturenext' onClick=\"CommentList2('next',$upload_id,0);\"><br/>";
			echo "<input type='image' src=\"../images/last_up.png\" id='Picturelast'  onClick=\"CommentList2('last',$upload_id,0);\">";
			echo "</div>";
			echo "<div style=\"background-color:#E6FFE6;height:78px;display:inline-block;vertical-align:top;\">";
			echo "<div id=\"CurrComment\" style=\"width:570px;display:inline-block;vertical-align:top;font-size:13px\">";
					$listcount=0;
					foreach ($CurrComment as $key2 => $comment2) {
						$listcount++;
						if($listcount > $Picturefirst_row && $listcount <= ($Picturefirst_row+$Picturepage_rows)){
							echo "<div style=\"display:inline-block;\"><img src=\"$Currprofile_picture[$key2]\" height=\"37\"></div>";
							echo "<div style=\"display:inline-block;vertical-align:top;\">".$comment2."</div><br/>";
						}
					}				
			echo "</div>";
			echo "</div>";
		}
		if($pictureCount!=0 && $upload_id!="SharedPicture" && $FriendID!="Temporary"){
	    echo "<form name=\"MyForm\" enctype=\"application/x-www-form-urlencoded\" method=\"post\" onsubmit=\"if(document.getElementById('comment').value=='') return false;\">";
		echo "<input type=\"hidden\" name=\"ViewingID\" value=\"$FriendID\">";
		echo "<input type=\"hidden\" name=\"upload_id\" value=\"$upload_id;\">";
		echo "Comment: <input type=\"text\" name=\"comment\" id=\"comment\" size=\"80\" value=\"\" onfocus=\"stop_show();\" onblur=\"start_show();\">";
		echo "</form>";
		}
		?>
	</td>
</tr>
<tr>
	<td colspan="3" id="PictureOwnerComment">
	<?php if(isset($comments) && $FriendID!='Temporary') {
		echo "<div style=\"background-color:#E9FFFF;height:78px;\">";
		echo '<div style="display:inline-block;">';
		echo "<img src=\"$result_profile_picture\" height=\"78\"></div>";
		echo "<div id=\"OwnerComNav\" style=\"width:17px;display:inline-block;vertical-align:top;\"><input type='image' src=\"../images/first_up2.png\" id='Ownerfirst' onClick=\"CommentList('first',$FriendID,0);\"><br/>";
		echo "<input type='image' src=\"../images/previous_up2.png\" id='Ownerprevious'  onClick=\"CommentList('previous',$FriendID,0);\"><br/>";
		echo "<input type='image' src=\"../images/next_up.png\" id='Ownernext' onClick=\"CommentList('next',$FriendID,0);\"><br/>";
		echo "<input type='image' src=\"../images/last_up.png\" id='Ownerlast'  onClick=\"CommentList('last',$FriendID,0);\"></div>";
		echo '<div id="comments" style="width:460px;display:inline-block;vertical-align:top;font-size:13px">';
		$listcount=0;
		foreach ($comments as $key => $comment) {
			$listcount++;
			if($listcount > $Ownerfirst_row && $listcount <= ($Ownerfirst_row+$Ownerpage_rows)){
				if($pic_group[$key]!='Public' && $owner_id[$key]!=$GV_id) {
					$queryPermission=mysql_query("SELECT * FROM view_permission where user_id = $owner_id[$key] and viewer_id=$GV_id and viewer_group='$pic_group[$key]' group by viewer_group limit 1");  // query string stored in a variable
					if(mysql_num_rows($queryPermission)!=0) {
						echo "<input type=\"image\" src=\"../images/view.png\" name=\"view\" value=\"view\" width=\"16\" onClick=\"window.open('CommentPicture.php?owner_id=$owner_id[$key]&viewer_group=$pic_group[$key]&upload_id=$pic_upload_id[$key]&viewingOn=$FriendID',target='_top');\">";
					}
					else echo "&nbsp;&nbsp;&nbsp;&nbsp; ";

				}
				else {
					echo "<input type=\"image\" src=\"../images/view.png\" name=\"view\" value=\"view\" width=\"16\" onClick=\"window.open('CommentPicture.php?owner_id=$owner_id[$key]&viewer_group=$pic_group[$key]&upload_id=$pic_upload_id[$key]&viewingOn=$FriendID',target='_top');\">";
				}
			
				echo $comment;
			}
		}
		echo "</div></div>";
	}
	?>
	</td>
</tr>
<tr>
<td  colspan="3" align="center">
<div id='videomain' style="display:inline-block;">
	<?php if(isset($video)) {
		if(isset($_SESSION["video_id"])) $video_id=$_SESSION["video_id"];
		else $video_id=$VDupload_id[0];
		if(isset($_SESSION["video_name"])) $video_name=$_SESSION["video_name"];
		else $video_name=$video[0];
		echo "
		<video id='OnShow' width='320' controls='controls' onClick='VideoShow($video_id);'>
		  <source src='$video_name"."mp4' type='video/mp4' />
		  <source src='$video_name"."ogg' type='video/ogg' />
		  <source src='$video_name"."ogv' type='video/ogv' />
		  <source src='$video_name"."webm' type='video/webm' />
		  <source src='$video_name"."mp4video.mp4' type='video/mp4' />
		  <source src='$video_name"."theora.ogv' type='video/ogg' />
		  <source src='$video_name"."webmvp8.webm' type='video/webm' />
		  Your browser does not support the video tag. <br/>Click the Compatibility button on IE or switch to other browser
		</video>";
	}
	?>
</div>
<div style="display:inline-block;">
<?php
if($FriendID != 'Public' && isset($video) && $FriendID != 'Temporary') {
	if($upload_id!="SharedPicture")	echo "<input type='image' src=\"../images/videoShare.jpg\" width='40' onClick=\"window.open('CommentVideo.php?FriendID=$FriendID',target='_top');\"/>";
	else echo "<input type='image' src=\"../images/videoShare.jpg\" width='40' onClick=\"window.open('CommentVideo.php?FriendID=SharedPicture',target='_top');\"/>";
}
?>
</div>	
</td>
</tr>
<tr>
<td  colspan="3">
<div id="VDComment">
<?php
if(isset($CurrVideoComment)) {
	if($VideoComcount==0)  $height="0px";
	elseif($VideoComcount==1)  $height="39px";
	else $height="78px";
	echo "<div style=\"width:17px;display:inline-block;height:$height;\">";
	echo "<input type='image' src=\"../images/first_up2.png\" id='VideoComfirst' onClick=\"CommentList3('first',video_id,1,0);\"><br/>";
	echo "<input type='image' src=\"../images/previous_up2.png\" id='VideoComprevious'  onClick=\"CommentList3('previous',video_id,1,0);\"><br/>";
	echo "<input type='image' src=\"../images/next_up.png\" id='VideoComnext' onClick=\"CommentList3('next',video_id,1,0);\"><br/>";
	echo "<input type='image' src=\"../images/last_up.png\" id='VideoComlast'  onClick=\"CommentList3('last',video_id,1,0);\">";
	echo "</div>";
	echo "<div style=\"background-color:#E6FFE6;height:$height;display:inline-block;vertical-align:top;\">";
	echo "<div id=\"CurrVideoComment\" style=\"width:570px;display:inline-block;vertical-align:top;font-size:13px\">";
			$listcount=0;
			foreach ($CurrVideoComment as $key2 => $comment2) {
				$listcount++;
				if($listcount > $VideoComfirst_row && $listcount <= ($VideoComfirst_row+$VideoCompage_rows)){
					echo "<div style=\"display:inline-block;\"><img src=\"$CurrVideoprofile_picture[$key2]\" height=\"37\"></div>";
					echo "<div style=\"display:inline-block;vertical-align:top;\">".$comment2."</div><br/>";
				}
			}				
	echo "</div>";
	echo "</div>";
}
echo "</div>";
if(isset($video)) {
//	if(isset($_REQUEST['FriendID'])) $FriendID=$_REQUEST['FriendID'];
	if(!isset($video_id))  $video_id="";
	echo "<form name=\"VideoForm\" id=\"VideoForm\" action=\"PictureMain.php\" enctype='application/x-www-form-urlencoded' method='post' onsubmit=\"if(document.getElementById('VideoComment').value=='') return false;\">";
	echo "<input type='hidden' name='ViewingID' value=\"$FriendID\">";
	echo "<input type='hidden' name='video_id' id='video_id' size='80' value=\"$video_id\"><br/>";
	if(isset($_SESSION["video_name"])) echo "<input type='hidden' name='video_name' id='video_name' size='80' value=\"$_SESSION[video_name]\"><br/>";
	else echo "<input type='hidden' name='video_name' id='video_name' size='80' value=\"$video[0]\"><br/>";
	echo "Comment: <input type='text' name='VideoComment' id='VideoComment' size='80' value=''>";
	echo "</form>";
}	
?>

</td>
</tr>
<tr>
<td  colspan="3" align="center" id="VideoNav">
<?php
echo "<input type='image' src=\"../images/first2.png\" id='Videofirst' onClick=\"VideoList('first',$FriendID);\">";
echo " ";
echo "<input type='image' src=\"../images/previous2.png\" id='Videoprevious'  onClick=\"VideoList('previous',$FriendID);\">";
echo "<input type='image' src=\"../images/next1.png\" id='Videonext' onClick=\"VideoList('next',$FriendID);\">";
echo " ";
echo "<input type='image' src=\"../images/last.png\" id='Videolast'  onClick=\"VideoList('last',$FriendID);\"><br/>";
?>
</td>
</tr>
<tr>
<td valign="top"  colspan="3" id="NextVideos">
<?php
if(isset($video)) {
	$listcount=0;
	foreach ($video as $key => $value) {
		$listcount++;
		if($listcount > $Videofirst_row && $listcount <= ($Videofirst_row+$Videopage_rows)){
			echo "
			<video width='130' onClick=\"Action('ShowVideos.php?video=$value'+'&VideoWidth='+VideoWidth,'videomain','$VDupload_id[$key]','$video[$key]');\" class='pointer'>
			  <source src='$video[$key]mp4' type='video/mp4' />
			  <source src='$video[$key]ogg' type='video/ogg' />
			  <source src='$video[$key]ogv' type='video/ogv' />
			  <source src='$video[$key]webm' type='video/webm' />
			  <source src='$video[$key]mp4video.mp4' type='video/mp4' />
			  <source src='$video[$key]theora.ogv' type='video/ogg' />
			  <source src='$video[$key]webmvp8.webm' type='video/webm' />
			  Your browser does not support the video tag. <br/>Click the Compatibility button on IE or switch to other browser
			</video>";
		}	
	}    
}
?>

</td>	
</tr>
<tr>
<td  colspan="3" align="center">
<?php 
if($FriendID!="Public" && $FriendID!="SharedPicture" && $FriendID!="Temporary") {
	echo "<div style='background-color:#E9FFFF;text-align:left;font-size:12px;' >";
	echo "SOME INFORMATION ABOUT THIS PERSON<br/>Screen:";
	while($rowScreen = mysql_fetch_array($UserScreen)) {
		echo "<font color='blue'>$rowScreen[screen_width] X $rowScreen[screen_height]</font>";
		echo " available: <font color='blue'>$rowScreen[screen_availWidth] X $rowScreen[screen_availHeight]</font>";
		echo " colorDepth: <font color='blue'>$rowScreen[screen_colorDepth]</font>";
		echo " pixelDepth: <font color='blue'>$rowScreen[screen_pixelDepth]</font><br/>";
	}
	echo "Browser been used:";
	while($rowBrowser = mysql_fetch_array($UserBrowser)) {
		echo "<font color='blue'>$rowBrowser[browser]</font>, ";
	}
	while($rowOS = mysql_fetch_array($UserOS)) {
		echo " and run on <font color='blue'>$rowOS[os] or up</font>";
	}
	if(mysql_num_rows($UserLocation) != 0) {
		while($rowLocation = mysql_fetch_array($UserLocation)) {
			echo "<br/>Last login location: <font color='blue'>$rowLocation[city],$rowLocation[region],</font> with IP address: <font color='blue'>$rowLocation[ip_address]</font>";
		}
	}
	echo "</div>";
}
unset($_SESSION["video_id"]);
unset($_SESSION["video_name"]);
?>
</td>
</tr>
</table>

<script type="text/javascript" src="../scripts/jquery.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="../scripts/jquery.cycle.all.js"></script>
<script type="text/javascript" src="../scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript">
var markup = '<?php echo $markup; ?>';
var fxcount=0,startingSlide=0;
var fx_value = new Array();
fx_value[28]='zoom';
fx_value[1]='fade';
fx_value[7]='blindX';
fx_value[8]='blindY';
fx_value[3]='blindZ';
fx_value[4]='cover';
fx_value[5]='curtainX';
fx_value[6]='curtainY';
fx_value[2]='fadeZoom';
fx_value[9]='growX';
fx_value[10]='growY';
fx_value[11]='none';
fx_value[12]='scrollUp';
fx_value[13]='scrollDown';
fx_value[14]='scrollLeft';
fx_value[15]='scrollRight';
fx_value[16]='scrollHorz';
fx_value[17]='scrollVert';
fx_value[18]='shuffle';
fx_value[19]='slideX';
fx_value[20]='slideY';
fx_value[21]='toss';
fx_value[22]='turnUp';
fx_value[23]='turnDown';
fx_value[24]='turnLeft';
fx_value[25]='turnRight';
fx_value[26]='uncover';
fx_value[27]='wipe';
var backforward=0;
var pictureCount =<?php echo $pictureCount; ?>;
$(document).ready(function() {
	if(pictureCount>1) {
		$('#slideshow').cycle({
			fx: 'zoom', // choose your transition type, ex: fade, scrollUp, shuffle,scrollLeft,zoom etc...
			startingSlide: startingSlide,
			after:   onAfter
		});
	}
	else document.getElementById('stop').style.display = "none";
});
	function start() {
		if(document.getElementById('backward')) document.getElementById('backward').style.display = "none";
		if(document.getElementById('forward')) document.getElementById('forward').style.display = "none";
		if(document.getElementById('play')) document.getElementById('play').style.display = "none";
		if(document.getElementById('stop')) document.getElementById('stop').style.display = "inline-block";
	
		$('#slideshow').cycle('stop').remove();
        $('#show').append(markup);
		$('#slideshow').cycle({
			fx: fx,
			startingSlide: startingSlide,
			speed:  2000,
			timeout: 5000,
			pause:         1,		
			pauseOnPagerHover: 1,
			after: onAfter,
			delay:  -4000
		});
	}
	function backforward2() {
		if(backforward==1) {
			backforward=0;
			backforward3();
		}
	}	
	function backforward3() {
		$('#slideshow').cycle('stop').remove();
        $('#show').append(markup);
		$('#slideshow').cycle({
			startingSlide: startingSlide,
			fx:     'fade',
			speed:  'fast',
			timeout: 0,
			next:   '#next2',
			prev:   '#prev2'
		});
		backforward=0;
	}
	function onAfter(curr,next,opts) {
		startingSlide++;
		if((opts.currSlide+1) >= opts.slideCount){
			startingSlide=0;
			fxcount++;
			fx=fx_value[fxcount];
			if(fxcount>28) fxcount=0; 
			start();
		}			
	};
	function stop_show() {
		$('#slideshow').cycle('stop');
		document.getElementById('backward').style.display = "inline-block";
		document.getElementById('forward').style.display = "inline-block";
		document.getElementById('play').style.display = "inline-block";
		document.getElementById('stop').style.display = "none";
		backforward=1;
		//backforward2();
	};
	function start_show() {
		fx=fx_value[fxcount];
		start();
	};	
function Action(url,affect_id,videoID,video_name) {
	video_id=videoID;
	document.getElementById("video_id").value=video_id;
	document.getElementById("video_name").value=video_name;
	var id = "#"+affect_id;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
	CommentList3('first',video_id,1,1);
}
var Videopagenum = 1;
var Videolast = <?php echo $Videolast; ?>;
var Videocount = <?php echo $Videocount; ?>;
var Videopage_rows = <?php echo $Videopage_rows; ?>;

var VideoCompagenum = 1;
var VideoComlast = <?php echo $VideoComlast; ?>;
var VideoComcount = <?php echo $VideoComcount; ?>;
var VideoCompage_rows = <?php echo $VideoCompage_rows; ?>;

var Ownerpagenum = 1;
var Ownerlast = <?php echo $Ownerlast; ?>;
var OwnerComcount = <?php echo $OwnerComcount; ?>;
var Ownerpage_rows = <?php echo $Ownerpage_rows; ?>;

var Picturepagenum = 1;
var Picturelast = <?php echo $Picturelast; ?>;
var PictureComcount = <?php echo $PictureComcount; ?>;
var Picturepage_rows = <?php echo $Picturepage_rows; ?>;
var pictureCount = <?php echo $pictureCount; ?>;
var VideoWidth=320;
var video_id = "<?php if(isset($video_id)) echo $video_id; ?>";

if(Videocount<=Videopage_rows) {
	if(document.getElementById('VideoNav')) document.getElementById('VideoNav').style.display = "none";
	if(document.getElementById('Videofirst')) document.getElementById('Videofirst').style.display = "none";
	if(document.getElementById('Videoprevious')) document.getElementById('Videoprevious').style.display = "none";
	if(document.getElementById('Videonext')) document.getElementById('Videonext').style.display = "none";
	if(document.getElementById('Videolast')) document.getElementById('Videolast').style.display = "none";
}
if(VideoComcount<=VideoCompage_rows) {
	if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').style.display = "none";
	if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').style.display = "none";
	if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').style.display = "none";
	if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').style.display = "none";
}
if(OwnerComcount<=Ownerpage_rows) {
	if(document.getElementById('OwnerComNav')) document.getElementById('OwnerComNav').style.display = "none";
	if(document.getElementById('Ownerfirst')) document.getElementById('Ownerfirst').style.display = "none";
	if(document.getElementById('Ownerprevious')) document.getElementById('Ownerprevious').style.display = "none";
	if(document.getElementById('Ownernext')) document.getElementById('Ownernext').style.display = "none";
	if(document.getElementById('Ownerlast')) document.getElementById('Ownerlast').style.display = "none";
}
if(PictureComcount<=Picturepage_rows) {
	if(document.getElementById('PicNav')) document.getElementById('PicNav').style.display = "none";
	if(document.getElementById('Picturefirst')) document.getElementById('Picturefirst').style.display = "none";
	if(document.getElementById('Pictureprevious')) document.getElementById('Pictureprevious').style.display = "none";
	if(document.getElementById('Picturenext')) document.getElementById('Picturenext').style.display = "none";
	if(document.getElementById('Picturelast')) document.getElementById('Picturelast').style.display = "none";
}
function VideoShow(videoID)  
{  
	VideoWidth=600;
	document.getElementById("OnShow").width=VideoWidth;
	document.getElementById("pictures").style.display="none";
	document.getElementById("PictureOwnerComment").style.display="none";
	document.getElementById("video_id").value=videoID;
	window.parent.scroll(0,0);
}
function VideoList(require,FriendID)  
{  
	var viewer_id =  "<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary"; else echo "Public"; ?>";
	if(require=='first') Videopagenum=1;
	else if(require=='previous') {
	  Videopagenum = Videopagenum - 1;
	} 
	else if(require=='next') {
	  Videopagenum = Videopagenum + 1;
	} 
	else if(require=='last') Videopagenum=Videolast;
	if(Videopagenum > 1 && Videopagenum < Videolast) {
		document.getElementById('Videofirst').src = "../images/first.png";
		document.getElementById('Videoprevious').src = "../images/previous.png";
		document.getElementById('Videonext').src = "../images/next1.png";
		document.getElementById('Videolast').src = "../images/last.png";
	}
	else if(Videopagenum<=1) {
		Videopagenum = 1;
		document.getElementById('Videofirst').src = "../images/first2.png";
		document.getElementById('Videoprevious').src = "../images/previous2.png";
		document.getElementById('Videonext').src = "../images/next1.png";
		document.getElementById('Videolast').src = "../images/last.png";
	}
	 else if(Videopagenum>=Videolast) {
		Videopagenum = Videolast;
		document.getElementById('Videofirst').src = "../images/first.png";
		document.getElementById('Videoprevious').src = "../images/previous.png";
		document.getElementById('Videonext').src = "../images/next2.png";
		document.getElementById('Videolast').src = "../images/last2.png";
	 }		

	var url = 'VideoList.php?FriendID='+FriendID+'&viewer_id='+viewer_id+'&pagenum='+Videopagenum+'&page_rows='+Videopage_rows+'&VideoWidth='+VideoWidth;
	$(document).ready(function() {
	   $("#NextVideos").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}

function CommentList(require,FriendID,type)  
{  
	var viewer_id =  "<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary";  else echo "Public"; ?>";
	if(require=='first') Ownerpagenum=1;
	else if(require=='previous') {
	  Ownerpagenum = Ownerpagenum - 1;
	} 
	else if(require=='next') {
	  Ownerpagenum = Ownerpagenum + 1;
	} 
	else if(require=='last') Ownerpagenum=Ownerlast;

	if(Ownerpagenum > 1 && Ownerpagenum < Ownerlast) {
		document.getElementById('Ownerfirst').src = "../images/first_up.png";
		document.getElementById('Ownerprevious').src = "../images/previous_up.png";
		document.getElementById('Ownernext').src = "../images/next_up.png";
		document.getElementById('Ownerlast').src = "../images/last_up.png";
	}
	else if(Ownerpagenum<=1) {
		Ownerpagenum = 1;
		document.getElementById('Ownerfirst').src = "../images/first_up2.png";
		document.getElementById('Ownerprevious').src = "../images/previous_up2.png";
		document.getElementById('Ownernext').src = "../images/next_up.png";
		document.getElementById('Ownerlast').src = "../images/last_up.png";
	}
	 else if(Ownerpagenum>=Ownerlast) {
		Ownerpagenum = Ownerlast;
		document.getElementById('Ownerfirst').src = "../images/first_up.png";
		document.getElementById('Ownerprevious').src = "../images/previous_up.png";
		document.getElementById('Ownernext').src = "../images/next_up2.png";
		document.getElementById('Ownerlast').src = "../images/last_up2.png";
	 }	
	var url = 'CommentList.php?FriendID='+FriendID+'&viewer_id='+viewer_id+'&pagenum='+Ownerpagenum+'&type='+type;
	$(document).ready(function() {
	   $("#comments").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function CommentList2(require,upload_id,type)  
{  
	var viewer_id =  "<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary";  else echo "Public"; ?>";
	if(require=='first') Picturepagenum=1;
	else if(require=='previous') {
	  Picturepagenum = Picturepagenum - 1;
	} 
	else if(require=='next') {
	  Picturepagenum = Picturepagenum + 1;
	} 
	else if(require=='last') Picturepagenum=Picturelast;
	if(Picturepagenum > 1 && Picturepagenum < Picturelast) {
		document.getElementById('Picturefirst').src = "../images/first_up.png";
		document.getElementById('Pictureprevious').src = "../images/previous_up.png";
		document.getElementById('Picturenext').src = "../images/next_up.png";
		document.getElementById('Picturelast').src = "../images/last_up.png";
	}
	else if(Picturepagenum<=1) {
		Picturepagenum = 1;
		document.getElementById('Picturefirst').src = "../images/first_up2.png";
		document.getElementById('Pictureprevious').src = "../images/previous_up2.png";
		document.getElementById('Picturenext').src = "../images/next_up.png";
		document.getElementById('Picturelast').src = "../images/last_up.png";
	}
	 else if(Picturepagenum>=Picturelast) {
		Picturepagenum = Picturelast;
		document.getElementById('Picturefirst').src = "../images/first_up.png";
		document.getElementById('Pictureprevious').src = "../images/previous_up.png";
		document.getElementById('Picturenext').src = "../images/next_up2.png";
		document.getElementById('Picturelast').src = "../images/last_up2.png";
	 }
	var url = 'CommentList2.php?upload_id='+upload_id+'&viewer_id='+viewer_id+'&pagenum='+Picturepagenum+'&type='+type;
	$(document).ready(function() {
	   $("#CurrComment").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}
function CommentList3(require,upload_id,type,reset)  
{  
	var viewer_id =  "<?php if(isset($GV_id)) echo $GV_id; elseif(isset($Temporary)) echo "Temporary";  else echo "Public"; ?>";
	if(require=='first') VideoCompagenum=1;
	else if(require=='previous') {
	  VideoCompagenum = VideoCompagenum - 1;
	} 
	else if(require=='next') {
	  VideoCompagenum = VideoCompagenum + 1;
	} 
	else if(require=='last') VideoCompagenum=VideoComlast;
	if(VideoCompagenum > 1 && VideoCompagenum < VideoComlast) {
		if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').src = "../images/first_up.png";
		if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').src = "../images/previous_up.png";
		if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').src = "../images/next_up.png";
		if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').src = "../images/last_up.png";
	}
	else if(VideoCompagenum<=1) {
		VideoCompagenum = 1;
		if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').src = "../images/first_up2.png";
		if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').src = "../images/previous_up2.png";
		if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').src = "../images/next_up.png";
		if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').src = "../images/last_up.png";
	}
	 else if(VideoCompagenum>=VideoComlast) {
		VideoCompagenum = VideoComlast;
		if(document.getElementById('VideoComfirst')) document.getElementById('VideoComfirst').src = "../images/first_up.png";
		if(document.getElementById('VideoComprevious')) document.getElementById('VideoComprevious').src = "../images/previous_up.png";
		if(document.getElementById('VideoComnext')) document.getElementById('VideoComnext').src = "../images/next_up2.png";
		if(document.getElementById('VideoComlast')) document.getElementById('VideoComlast').src = "../images/last_up2.png";
	 }

	 if(reset==0) {	
		 var url = 'CommentList2.php?upload_id='+upload_id+'&viewer_id='+viewer_id+'&pagenum='+VideoCompagenum+'&type='+type;
		$(document).ready(function() {
		   $("#CurrVideoComment").load(url);
		   $.ajaxSetup({ cache: false });
		});		
	 }
	 else {
		var url = 'CommentList3.php?upload_id='+upload_id+'&viewer_id='+viewer_id+'&pagenum='+VideoCompagenum+'&type='+type;
		$(document).ready(function() {
		   $("#VDComment").load(url);
		   $.ajaxSetup({ cache: false });
		});		
	 }
}
$("#backward").attr('title', 'Previous'); 
$("#play").attr('title', 'Play'); 
$("#to_view").attr('title', 'View'); 
$("#stop").attr('title', 'Stop'); 
$("#forward").attr('title', 'Next'); 
var FriendID="<?php echo $FriendID; ?>";
if(pictureCount==0) {
	document.getElementById('PicCtrl').style.display = "none";
	<?php if(isset($video_id)){
		echo "VideoShow($video_id)";
	}
	?> 
}
<?php if(isset($GV_id)) : ?>
window.onload=parent.Set_OrgFriendID(FriendID);
<?php endif; ?>
</script>
</body>
</html>
		