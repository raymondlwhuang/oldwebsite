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
if(isset($_POST['Delete']))
{
	$upload_id = mysql_real_escape_string($_POST['upload_id']);
	if(isset($upload_id)){
	mysql_query("DELETE FROM picture_video WHERE upload_id = $upload_id");
	mysql_query("DELETE FROM upload_infor WHERE id = $upload_id");
	Header("Location: {$_SERVER['REQUEST_URI']}");
	die;
	
	}
}

$show_id = 0;
$PicturePath = "../pictures/$GV_owner_path";
$queryPicture="SELECT * FROM picture_video where picture_video = 'pictures' and owner_path = '$GV_owner_path' group by upload_id";  // query string stored in a variable

$resultPicture=mysql_query($queryPicture);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 
while($row3 = mysql_fetch_array($resultPicture))
{
	$upload_id = $row3['upload_id'];
	$picture_group[$upload_id] = $row3['name'];
	if ($show_id == 0) $show_id = $upload_id;
	$queryupload_infor="SELECT * FROM upload_infor where id = $upload_id";  // query string stored in a variable
	$resultupload_infor=mysql_query($queryupload_infor);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row4 = mysql_fetch_array($resultupload_infor))
	{
		$UploadDate[$upload_id] = $row4['upload_date'];
		$description[$upload_id] = mysql_real_escape_string($row4['description']);
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
	width: 125px;
	background: #FFFFFF;
	border: 2px outset;
	margin:0;
 }
 
div > p:hover  {  border: 2px inset;background: #FFFFFF; border-color: #736F6E;color:white;  }
</style>	

</head>
<body style="color:darkblue;">
<form name="MyForm" enctype="application/x-www-form-urlencoded" method="post">
<input type="hidden" name="upload_id" id="upload_id" value="<?php if($show_id!=0) echo $show_id; ?>">
<input type="submit" name="Delete" value="Delete This Folder" onclick="return confirm('Are you sure?');">
</form>
<div style="display:block;width:130px;" id="Private">
	<table width="100%">
		<tbody>
		<tr>
		<td colspan="2">
			<div class="menu1">
				<p><img src='<?php if($show_id!=0) echo $picture_group[$show_id]; ?>'  width='100px' id="picked" />
				<img src='../images/down_arrow.jpg'  width='19px' height="70px"/></p><span id="picked_owner">
				<?php if($show_id!=0) echo $description[$show_id];
				      echo "<br/>";
					  if($show_id!=0) echo $UploadDate[$show_id]; ?></span>
				<ul style="display: none;text-align:left;" id="menu1">
	<?php
		if($show_id!=0) {
			foreach ($picture_group as $key2 => $value2) {
echo <<<_END
<li><a href="" onClick="document.getElementById('upload_id').value='$key2';clearfield('$value2','$description[$key2]','$UploadDate[$key2]','menu1');refreshiframe('$key2');return false;"><p style="width:135px;position:relative;left:-40px;background: #8FC4FF;color:white;"><img src='$value2' width="135px" />$description[$key2]<br/>$UploadDate[$key2]</p></a></li>
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
<?php
echo <<<_END
<iframe src="PicRemove.php?show_id=$show_id" width="100%" height="1410" id="frame1" frameborder=0 SCROLLING=no style="z-index:-1;">
  <p>Your browser does not support iframes.</p>
</iframe>
_END;

?>
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
function clearfield(picture,description,date,className) {
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = description + "<br/>" + date;
}
function refreshiframe(upload_id)  
{  
	document.getElementById('frame1').src = "PicRemove.php?show_id=" + upload_id;
}
</script>

</body>
</html>
	