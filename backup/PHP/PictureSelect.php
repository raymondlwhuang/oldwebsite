<?php
session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: login.php');
	exit();
}
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
    $_GET = _stripslashes_rcurs($_GET);////
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
$show_id = 0;

if(isset($_GET['FriendEmail']))
{
	if($_GET['FriendEmail'] == 'Public') {
			$queryPicture="SELECT * FROM picture_video where viewer_group = 'Public' and picture_video = 'pictures' group by upload_id desc";  // query string stored in a variable
			$resultPicture=mysql_query($queryPicture);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			$count = 0;
			while($row3 = mysql_fetch_array($resultPicture))
			{
				$upload_id = $row3['upload_id'];
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
				$picture_group['Public'][$upload_id] = $row3['name'];
				$picture_UploadDate['Public'][$upload_id] = $UploadDate;
				$picture_description['Public'][$upload_id] = $description;
				$count++;
			}	
			if($count > 0) $owner_list[] = 'Public';			
	}
	else if($_GET['FriendEmail'] == "$GV_email_address") {
			$queryPicture="SELECT * FROM picture_video where owner_path = '$GV_owner_path' and picture_video = 'pictures' group by upload_id desc";  // query string stored in a variable
			$resultPicture=mysql_query($queryPicture);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			$count = 0;
			while($row3 = mysql_fetch_array($resultPicture))
			{
				$upload_id = $row3['upload_id'];
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
				$picture_group[$GV_owner_path][$upload_id] = $row3['name'];
				$picture_UploadDate[$GV_owner_path][$upload_id] = $UploadDate;
				$picture_description[$GV_owner_path][$upload_id] = $description;
				$count++;
			}
			if($count > 0) $owner_list[] = $GV_owner_path;
		}	
	else {
			$FriendEmail = $_GET['FriendEmail'];
			$queryPermission="SELECT * FROM view_permission where owner_email = '$FriendEmail' and viewer_email = '$GV_email_address' order by owner_path";  // query string stored in a variable
			$resultPermission=mysql_query($queryPermission);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			while($row2 = mysql_fetch_array($resultPermission))
			{
			 $viewer_group = $row2['viewer_group'];
			 $curr_path = $row2['owner_path'];
			 $Picked[$curr_path] = $viewer_group;
			} 

			$queryPicture="SELECT * FROM picture_video where owner_path = $curr_path and picture_video = 'pictures' and viewer_group <> '' group by upload_id desc";  // query string stored in a variable
			$resultPicture=mysql_query($queryPicture);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			$count = 0;
			while($row3 = mysql_fetch_array($resultPicture))
			{
				$count++;
				$upload_id = $row3['upload_id'];
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
				$picture_group[$curr_path][$upload_id] = $row3['name'];
				$picture_UploadDate[$curr_path][$upload_id] = $UploadDate;
				$picture_description[$curr_path][$upload_id] = $description;
			}				
			if($count > 0) {
				$queryPicture2="SELECT * FROM picture_video where owner_path = '$curr_path' and picture_video = 'pictures' and viewer_group = '' group by upload_id desc";  // query string stored in a variable
				$resultPicture2=mysql_query($queryPicture2);          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				while($row5 = mysql_fetch_array($resultPicture))
				{		
					$upload_id = $row5['upload_id'];			
					if ($show_id == 0) $show_id = $upload_id;
					$queryupload_infor2="SELECT * FROM upload_infor where id = $upload_id";  // query string stored in a variable
					$resultupload_infor2=mysql_query($queryupload_infor2);          // query executed 
					echo mysql_error();              // if any error is there that will be printed to the screen 
					$description = '';
					while($row6 = mysql_fetch_array($resultupload_infor2))
					{
						$UploadDate = $row6['upload_date'];
						$description = $row6['description'];
					}				
					$picture_group[$curr_path][$upload_id] = $row5['name'];
					$picture_UploadDate[$curr_path][$upload_id] = $UploadDate;
					$picture_description[$curr_path][$upload_id] = $description;
				}
			}
			if($count > 0) $owner_list[] = $curr_path;
		}
}
else {
 		$queryPicture="SELECT * FROM picture_video where owner_path = '$GV_owner_path' and picture_video = 'pictures' group by upload_id desc";  // query string stored in a variable
		$resultPicture=mysql_query($queryPicture);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		$count = 0;
		while($row3 = mysql_fetch_array($resultPicture))
		{
			$upload_id = $row3['upload_id'];
			if ($show_id == 0) $show_id = $upload_id;
			$queryupload_infor="SELECT * FROM upload_infor where id = $upload_id";  // query string stored in a variable
			$resultupload_infor=mysql_query($queryupload_infor);          // query executed 
			echo mysql_error();              // if any error is there that will be printed to the screen 
			$description = '';
			$UploadDate = date("Y-m-d");
			while($row4 = mysql_fetch_array($resultupload_infor))
			{
				$UploadDate = $row4['upload_date'];
				$description = $row4['description'];
			}
						
			$picture_group[$GV_owner_path][$upload_id] = $row3['name'];
			$picture_UploadDate[$GV_owner_path][$upload_id] = $UploadDate;
			$picture_description[$GV_owner_path][$upload_id] = $description;
			$count++;
		}
		if($count > 0) $owner_list[] = $GV_owner_path;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Make your Selection</title>
<style type="text/css" media="screen">
div {
	margin-bottom: 10px;
}

ul {
	display: none;
	list-style-type: none;
	margin-top: 2px;
}

ul > li > a:hover {background: #736F6E;}

div > p {
	display: block;
	width: 134px;
/*	font-size: 10px;
	font-weight: bold;*/
	background: #FFFFFF;
	border: 2px outset;
	margin:0
 }
 
div > p:hover  {  border: 2px inset;background: #FFFFFF; border-color: #736F6E;color:white  }
</style>	

</head>
<body style="color:darkblue;">
<form name="upload" method="post" enctype="multipart/form-data">
Select to view: <br/>
<div style="display:block;" id="Private">
	<table width="100%">
		<tbody>
		<tr>
		<td colspan="2">
			<div class="menu1">
				<p><img src='<?php echo $picture_group[$GV_owner_path][$show_id] ?>'  width='110px' id="picked" />
				<img src='../images/down_arrow.jpg'  width='19px' height="80px"/></p><span id="picked_owner" >
				<?php echo $picture_description[$GV_owner_path][$show_id];
				      echo "<br/>";
					  echo $picture_UploadDate[$GV_owner_path][$show_id]; ?></span>
				<ul style="display: none;text-align:left;" id="menu1">
	<?php
		foreach ($owner_list as $key => $value) {
			foreach ($picture_group[$value] as $key2 => $value2) {
			$UploadDate = $picture_UploadDate[$value][$key2];
			$description = $picture_description[$value][$key2];
echo <<<_END
<li><a href="" onClick="clearfield('$value2','$description','$UploadDate');return false;"><img src='$value2'  width='110px'/></a><br/>$description<br/>$UploadDate</li>
_END;
			}
		}
			?>	
				</ul>
			</div>
		</td>
		</tr>
		</tbody>
	</table>
</div>	 

 </form>
<script type="text/javascript" >
window.onload = initAll;

function initAll() {
	var allLinks = document.getElementsByTagName("div");
	
	for (var i=0; i<allLinks.length; i++) {
		allLinks[i].onmouseover = function (){document.getElementById(this.className).style.display = "block";}
		allLinks[i].onmouseout =  function (){document.getElementById(this.className).style.display = "none";}
	}
}
function clearfield(picture,description,date) {
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = description + "<br/>" + date;
}

/*
window.open( "../HTML/RemovePicture.html", "Remove");
*/
</script>
</body>
</html>
