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
$name = $GV_name;
$show_id = 0;
	if(isset($_GET['FriendEmail']))
	{	
		$email = $_GET['FriendEmail'];
	}		
	if(isset($email) && $GV_email_address != $email){
		$queryPermit="SELECT * FROM view_permission where owner_email = '$email' and viewer_email = '$GV_email_address'";  // query string stored in a variable
	}
	else {
		$queryPermit="SELECT * FROM view_permission where owner_email = '$GV_email_address'";  // query string stored in a variable
	}
	$resultPermit=mysql_query($queryPermit);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	if (mysql_num_rows($resultPermit) != 0){
		while($row = mysql_fetch_array($resultPermit))
		{	
			$curr_path = $row['owner_path'];
			$permit[$curr_path][] = $row['viewer_group'];
		}
		foreach ($permit as $key => $value) {
			foreach ($value as $key2 => $value2) {
//				$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' owner_path = '$key' and (viewer_group = '$value2' or viewer_group = '') and  group by upload_id desc limit 1";  // query string stored in a variable
				$PicturePath = "../pictures/$key";
				$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and (viewer_group = '$value2' or viewer_group = '') and name like '$PicturePath%' group by upload_id desc";  // query string stored in a variable
				
				$resultPicture=mysql_query($queryPicture);          // query executed 
				echo mysql_error();              // if any error is there that will be printed to the screen 
				$count = 0;
				while($row3 = mysql_fetch_array($resultPicture))
				{
					$upload_id = $row3['upload_id'];
					$picture_group[$upload_id] = $row3['name'];
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
				if($count > 0) $owner_list[] = $key;			
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Make your Selection</title>
<style type="text/css" media="screen">
div {
	margin-bottom: 0px;
}

ul {
	display: none;
	list-style-type: none;
	margin-top: 0px;
}

ul > li > a:hover {background: #736F6E;}

div > p {
	display: block;
	width: 120px;
	background: #FFFFFF;
	border: 2px outset;
	margin:0;
 }
 
div > p:hover  {  border: 2px inset;background: #FFFFFF; border-color: #736F6E;color:white;  }
a {
text-decoration: none;
}
</style>	
<script type="text/javascript" src="../scripts/ajaxload.js"></script>	

</head>
<body style="color:darkblue;">
<div id="maincontent"></div>
<div style="display:block;" id="Private">
	<table width="100%">
		<tbody>
		<tr>
		<td colspan="2">
			<?php echo $name; ?>
			<div class="menu1">
				<p><img src='<?php if($show_id !=0) echo $picture_group[$show_id] ?>'  width='90px' id="picked" />
				<img src='../images/down_arrow.jpg'  width='19px' height="60px"/></p><span id="picked_owner">
				<?php 
				if($show_id !=0) {
					echo $picture_description[$show_id];
					echo "<br/>";
					echo $picture_UploadDate[$show_id];
				}
				else echo "No picture available";
					   ?></span>
				<ul style="display: none;text-align:left;" id="menu1">
	<?php
		if($show_id!=0) {
			foreach ($picture_group as $key3 => $value3) {
			$UploadDate = $picture_UploadDate[$key3];
			$description = $picture_description[$key3];
echo <<<_END
<li><a href="" onClick="SendRequest ('../PHP/LastActivity.php','maincontent');clearfield('$value3','$description','$UploadDate');refreshiframe('$key3');return false;"><p style="width:130px;position:relative;left:-40px;background: #8FC4FF;color:white;"><img src='$value3' width="130px" />$description<br/>$UploadDate</p></a></li>
_END;
			}
		}
		else echo "No picture provided!";
			?>	
				</ul>
			</div>
		</td>
		</tr>
		</tbody>
	</table>
</div>
<input type="hidden" name="FriendEmail" id="FriendEmail" value="<?php if(isset($email)) echo $email; else echo $GV_email_address; ?>">

<script type="text/javascript" >
window.onload = initAll;

function initAll() {
	var allLinks = document.getElementsByTagName("div");
	
	for (var i=0; i<allLinks.length; i++) {
		allLinks[i].onmouseover = function (){
		document.getElementById("menu1").style.display = "block";
		document.getElementById("frame1").style.display = "none";
		}
		allLinks[i].onmouseout =  function (){
		document.getElementById("menu1").style.display = "none";
		document.getElementById("frame1").style.display = "block";
		}
		allLinks[i].onclick =  function (){
		document.getElementById("menu1").style.display = "none";
		document.getElementById("frame1").style.display = "block";
		}
	}
}
function clearfield(picture,description,date) {
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = description + "<br/>" + date;
}
function refreshiframe(upload_id)  
{  
	document.getElementById('frame1').src = "PictureSlide2.php?show_id=" + upload_id;
	window.open( "PictureMain.php?FriendEmail="+document.getElementById("FriendEmail").value + "&show_id=" + upload_id, "MyBlog");
}
</script>
<?php
echo <<<_END
<iframe src="PictureSlide2.php?show_id=$show_id" height="410" id="frame1" frameborder=0 SCROLLING=no style="position:absolute;top:200px;z-index:-1;">
  <p>Your browser does not support iframes.</p>
</iframe>
_END;

?>

</body>
</html>
	