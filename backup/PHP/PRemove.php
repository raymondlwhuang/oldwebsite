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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);////
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
include_once("sethash.php");
$FriendID=$GV_id;
$notmypic=false;
if($_SESSION["admin"]==1 && isset($_SESSION["FriendID"]) && $_SESSION["FriendID"]!=$GV_id && $_SESSION["FriendID"]!="Public")
{
	$FriendID=$_SESSION["FriendID"];
	$queryUser=mysql_query("SELECT * FROM user where id=$FriendID limit 1 ");  // query string stored in a variable
	echo mysql_error();
	while($row = mysql_fetch_array($queryUser))
	{
		$FriendName=$row['first_name']." ".$row['last_name'];
		$owner_path=$row['owner_path'];
	}
}
if(isset($_REQUEST['link']))
{
	$link = (int)newdecode($_REQUEST['link']);
	$queryDelete=mysql_query("SELECT * FROM picture_video where owner_path='$GV_owner_path' and upload_id=$link ");  // query string stored in a variable
	echo mysql_error();
	if (mysql_num_rows($queryDelete) != 0){
		while($rowDelete = mysql_fetch_array($queryDelete))
		{
			$Orgname="../Orgpictures".substr($rowDelete['name'],11);
			unlink($rowDelete['name']);
			unlink($Orgname);
			mysql_query("DELETE FROM pv_share WHERE pv_id = $rowDelete[id]");
			mysql_query("DELETE FROM picture_video WHERE id = $rowDelete[id]");
		}
	}
	mysql_query("DELETE FROM upload_infor WHERE id = $link");
	mysql_query("DELETE FROM pv_comment WHERE upload_id = $link");
	$queryCheck="SELECT * FROM picture_video where owner_path='$GV_owner_path' and picture_video ='pictures' limit 1";  // query string stored in a variable
		$resultCheck=mysql_query($queryCheck);          // query executed 
		if (mysql_num_rows($resultCheck) == 0){
echo <<<_END
<script type="text/javascript">
alert("You got no picture to delete!");
window.open('index.php',target='_top');
</script>
_END;
		
exit();		
		}
		else {		
			Header("Location: PRemove.php");
			die;
		}
}
	$rows=0;
	$queryPicture="SELECT * FROM picture_video where owner_path='$GV_owner_path' and picture_video = 'pictures' order by id desc";  // query string stored in a variable
	$resultPicture=mysql_query($queryPicture);          // query executed 
	if(mysql_num_rows($resultPicture) == 0 && $_SESSION["admin"]==1 && isset($_SESSION["FriendID"]) && $_SESSION["FriendID"]!=$GV_id) {
		$queryPicture="SELECT * FROM picture_video where owner_path='$owner_path' and picture_video = 'pictures' order by id desc";  // query string stored in a variable
		$resultPicture=mysql_query($queryPicture);          // query executed 
		$notmypic=true;
	}	
	echo mysql_error();              // if any error is there that will be printed to the screen 
	$count = 0;
	$upload_id = '';
	while($row3 = mysql_fetch_array($resultPicture))
	{
			$upload_id = $row3['upload_id'];
			$countrow=true;
			if(isset($picture_group)) {
				$dosave=true;
				foreach ($picture_group as $key5 => $value5) {
					foreach ($value5 as $key6 => $value6) {
						if($key5==$upload_id) $countrow=false;
						if($key5==$upload_id && $value6==$row3['name']) $dosave=false;
					}
				}
				if($dosave) {
					$picture_group[$upload_id][] = $row3['name'];
					if($countrow) $rows++;
				}
			}
			else {
				$rows=1;
				$picture_group[$upload_id][] = $row3['name'];
			}
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
			$picture_description[$upload_id] = $description;
			$count++;
	}	
	if($rows==0) {
echo <<<_END
<script type="text/javascript">
alert("You got no picture to delete!");
window.open('index.php',target='_top');
</script>
_END;
	
	}
$pagenum = 1; 
$page_rows = 49;  
$last = ceil($rows/$page_rows); 
if ($pagenum < 1) $pagenum = 1; elseif ($pagenum > $last) $pagenum = $last; 
$first_row=($pagenum -1)* $page_rows;
$previous = $pagenum-1;
if($previous == 0) $previous=1;
$next = $pagenum+1;
if($next > $rows) $next=$rows;
$count=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Make your Selection</title>
<style type="text/css" media="screen">
a {
text-decoration: none;
}
</style>	

</head>
<body style="color:darkblue;">
<center>
<font style="font-size:18px;color:red;">PICTURE MAINTENANCE</font><br/>
<?php
include("../PHP/Header.php");
if ($_SESSION["admin"]==1 && isset($_SESSION["FriendID"]) && $_SESSION["FriendID"]!=$GV_id && $_SESSION["FriendID"]!="Public") {
	if($notmypic)
		echo "$FriendName's picture";
	else
		echo "$FriendName's picture<input type=\"checkbox\" value=\"\" id=\"other_pic\" onchange=\"other_pic();\">";
 }
echo "<img src=\"../images/first2.png\" id='first' onClick=\"PRemoveList('first');\">";
echo " ";
echo "<img src=\"../images/previous2.png\" id='previous'  onClick=\"PRemoveList('previous');\">";
echo "<img src=\"../images/next1.png\" id='next' onClick=\"PRemoveList('next');\">";
echo " ";
echo "<img src=\"../images/last.png\" id='last'  onClick=\"PRemoveList('last');\"><br/>";
?>
<div style="display:block;" id="Private">
	<table width="985">
		<tbody>
		<tr>
		<td colspan="2">
			<div class="menu1" style="text-align:center;">
				<?php
						echo '<div id="Pictures">';
						if(isset($picture_group)) {
							$listcount=0;
							foreach ($picture_group as $key3 => $value3) {
									echo "<div style='display:inline-block;' >";
									$count=0;
									$listcount++;
									if($listcount > $first_row && $listcount <= ($first_row+$page_rows)){
										foreach ($value3 as $key4 => $value4) {
											$infor=newencode("$key3,$value4,$picture_UploadDate[$key3],$picture_description[$key3],$FriendID");
											if($key4==0) echo "<input type=\"image\" src='ImgOnImgWithBorder.php?second_img=$value4' alt='' onClick=\"Action('../PHP/LastActivity.php?user_id=$GV_id','BlankMsg');refreshiframe('$infor');\"/>";
										}
										$encode=newencode($key3);
										echo "<a href='PRemove.php?link=$encode'  onclick=\"return confirm('Are you sure you want to delete this folder?');\"><img src='../images/delete.png' alt='delete' width='25' /></a>";
										echo "<br/>$picture_UploadDate[$key3]<br/>";
										echo "$picture_description[$key3]<br/>";
									}
									echo "</div>";
							}
						}
						
						echo '</div>';
				?>
			</div>
		</td>
		</tr>
		</tbody>
	</table>
</div>
</center>
<div id='BlankMsg' style="display:none;"></div>
<iframe src="chat.php" height="380" width="645" id="ChatFrame" frameborder=0 SCROLLING=no allowTransparency="false" style="position:fixed;bottom:0px;right:0px;z-index:3;background-color:#FFFFFF;display:block;">
  <p>Your browser does not support iframes.</p>
</iframe>
<input type="hidden" name="GV_id" id="GV_id" value="<?php if(isset($GV_id)) echo $GV_id; else echo $GV_id; ?>">
<script src="../scripts/jquery.js"></script>
<script type="text/javascript" >var user_id = "<?php echo $GV_id; ?>";</script>
<script src="../scripts/chat.js"></script>
<script type="text/javascript" >
var admin = <?php echo $_SESSION["admin"]; ?>;
if(admin==1) {
	document.getElementById('Setup').style.display = "none";
}
document.getElementById('DeleteP').style.display = "none";
var pagenum = 1;
var last = <?php echo $last; ?>;
var rows = <?php echo $rows; ?>;
var page_rows = <?php echo $page_rows; ?>;
if(rows<=page_rows) {
	document.getElementById('first').style.display = "none";
	document.getElementById('previous').style.display = "none";
	document.getElementById('next').style.display = "none";
	document.getElementById('last').style.display = "none";
}
function PRemoveList(require)  
{  
	var owner_path =  "<?php echo $GV_owner_path ?>";

	if(require=='first') pagenum=1;
	else if(require=='previous') {
	  pagenum = pagenum - 1;
	} 
	else if(require=='next') {
	  pagenum = pagenum + 1;
	} 
	else if(require=='last') pagenum=last;
	if(pagenum > 1 && pagenum < last) {
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	}
	else if(pagenum<=1) {
		pagenum = 1;
		document.getElementById('first').src = "../images/first2.png";
		document.getElementById('previous').src = "../images/previous2.png";
		document.getElementById('next').src = "../images/next1.png";
		document.getElementById('last').src = "../images/last.png";
	}
	 else if(pagenum>=last) {
		pagenum = last;
		document.getElementById('first').src = "../images/first.png";
		document.getElementById('previous').src = "../images/previous.png";
		document.getElementById('next').src = "../images/next2.png";
		document.getElementById('last').src = "../images/last2.png";
	 }

	var url = 'PRemoveList.php?user_id='+user_id+'&owner_path='+owner_path+'&pagenum='+pagenum;;
	$(document).ready(function() {
	   $("#Pictures").load(url);
	   $.ajaxSetup({ cache: false });
	});		
}

function refreshiframe(infor)  
{
	window.open( "PicRemove.php?infor=" + infor, "_top");
}
function Action(url,affect_id) {
	var id = "#"+affect_id;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
	window.parent.scroll(0,0);
}
function other_pic() {
	if(document.getElementById('other_pic')) {
		if(document.getElementById('other_pic').checked) var FriendID= <?php echo $FriendID; ?>;
		else  var FriendID= <?php echo $GV_id; ?>;
	}
	else  var FriendID= <?php echo $GV_id; ?>;
	var id = "#Pictures";
	url="PRemove2.php?FriendID="+FriendID;
	$(document).ready(function() {
	   $(id).load(url);
	   $.ajaxSetup({ cache: false });
	});
}
</script>

</body>
</html>
	