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
	$show_id = 0;
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
				<p><img src='<?php echo $picture_group['Public'][$show_id] ?>'  width='100px' id="picked" />
				<img src='../images/down_arrow.jpg'  width='19px' height="80px"/></p><span id="picked_owner" >
				<?php echo $picture_description['Public'][$show_id];
				      echo "<br/>";
					  echo $picture_UploadDate['Public'][$show_id]; ?></span>
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
