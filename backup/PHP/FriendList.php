<?php 
 // Connects to your Database 
include("../config.php");
$user_id=(int)$_REQUEST['user_id'];
$queryresult=mysql_query("SELECT * FROM user where id=$user_id limit 1");  // query string stored in a variable
while($row = mysql_fetch_array($queryresult))
{
$owner_path1=$row['owner_path'];
$profile_picture1=$row['profile_picture'];
$name1=$row['first_name']." ".$row['last_name'];
$friendid1=$row['email_address'];
$friendid1=$row['id'];
}

if(isset($_REQUEST['pagenum']))
{
	$pagenum = (int)$_REQUEST['pagenum'];
}
 
 //This checks to see if there is a page number. If not, it will set it to page 1 
if (!(isset($pagenum))) 
{ 
	$pagenum = 1; 
} 
$name['public'] = 'Public';
$profile_picture['public'] = "../images/profile/public.jpg";
$FriendID['public'] = 'Public';
$name[$owner_path1] = $name1;
$profile_picture[$owner_path1] = $profile_picture1;
$FriendID[$owner_path1] = $friendid1;
$PicturePath = "../pictures/$owner_path1";
$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and ((name like '$PicturePath%' and owner_path <> '$owner_path1') or owner_path = '$owner_path1') group by upload_id desc limit 1";  // query string stored in a variable

$resultPicture=mysql_query($queryPicture);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row5 = mysql_fetch_array($resultPicture))
{
	$upload_id[$owner_path1] = $row5['upload_id'];
}
$rows = 2;
$query="SELECT * FROM view_permission where viewer_id = $friendid1 group by owner_email";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row2 = mysql_fetch_array($result))
{
	$curr_path = $row2['owner_path'];
	$FriendID[$curr_path] = $row2['user_id'];
	$queryOwner="SELECT * FROM user where  email_address = '$row2[owner_email]' LIMIT 1";
	$owner=mysql_query($queryOwner);          // query executed 
	echo mysql_error();
	while($row3 = mysql_fetch_array($owner))
	{
	 $first_name=ucfirst(strtolower($row3['first_name']));
	 $last_name = ucfirst(strtolower($row3['last_name']));
	 $profile_picture[$curr_path] = $row3['profile_picture'];
	 $rows++; 
	 $name[$curr_path] = $first_name." ".$last_name;
	} 
	$PicturePath = "../pictures/$curr_path";
	$queryPicture2="SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group <> 'Public' and ((name like '$PicturePath%' and owner_path <> '$curr_path') or owner_path = '$curr_path') group by upload_id desc limit 1";  // query string stored in a variable
	
	$resultPicture2=mysql_query($queryPicture2);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row6 = mysql_fetch_array($resultPicture2))
	{
		$upload_id[$curr_path] = $row6['upload_id'];
	}
} 
 
 //This is the number of results displayed per page 
 $page_rows = 5; 
 
 //This tells us the page number of our last page 
 $last = ceil($rows/$page_rows); 
 
 //this makes sure the page number isn't below one, or more than our maximum pages 
 if ($pagenum < 1) 
 { 
 $pagenum = 1; 
 } 
 elseif ($pagenum > $last) 
 { 
 $pagenum = $last; 
 } 
	$first_row=($pagenum -1)* $page_rows; 
	$count=0;
	if($pagenum==1) echo "<b>Public</b><br/>";
	foreach ($profile_picture as $key => $value) {
	$count++;
	if(isset($upload_id[$key])) $show_id = $upload_id[$key]; else $show_id = '';
	if($name[$key]=='Public') $ShowName="<font color='red'><b>Friends</b></font>"; else $ShowName=substr($name[$key],0,25);
	$longstring = <<<STRINGBEGIN
	<a href="" onClick="SendRequest ('../PHP/LastActivity.php?user_id=$user_id','maincontent');refreshiframe('$name[$key]','$FriendID[$key]','$value','$show_id','$key');return false;"><img src='$value' width='67'/></a><br/><font size='2'>$ShowName</font><br/>
STRINGBEGIN;
		if($count > $first_row && $count <= ($first_row+$page_rows)){
			echo $longstring;
		}
	}

?> 