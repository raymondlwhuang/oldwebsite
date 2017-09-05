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
$owner_list[] = $GV_owner_path;
$owner_name[$GV_owner_path] = $GV_name;
$owner_picture[$GV_owner_path] = $GV_profile_picture;
$pictures = "../pictures/$GV_owner_path/";
$videos = "../videos/$GV_owner_path/";
@mkdir("$pictures");
@mkdir("$videos");
 
$queryMyGroup="SELECT * FROM view_permission where  owner_email = '$GV_email_address' group by viewer_group";
$MyGroup=mysql_query($queryMyGroup);          // query executed 
echo mysql_error();
while($MyGroupRow = mysql_fetch_array($MyGroup))
{
	$Cur_path = $MyGroupRow['owner_path'];
	$SelectOpt[$Cur_path][] = $MyGroupRow['viewer_group'];
	$pictures = "../pictures/$Cur_path/";
	$videos = "../videos/$Cur_path/";
	@mkdir("$pictures");
	@mkdir("$videos");
} 
$queryOtherGroup="SELECT * FROM view_permission where  viewer_email = '$GV_email_address' order by viewer_group";
$OtherGroup=mysql_query($queryOtherGroup);          // query executed 
echo mysql_error();
while($OtherGroupRow = mysql_fetch_array($OtherGroup))
{
	$Cur_path = $OtherGroupRow['owner_path'];
    $SelectOpt[$Cur_path][] = $OtherGroupRow['viewer_group'];
	$queryOwner="SELECT * FROM user where  email_address = '$OtherGroupRow[owner_email]' order by email_address limit 1";
	$owner=mysql_query($queryOwner);          // query executed 
	echo mysql_error();
	while($row = mysql_fetch_array($owner))
	{
	 $first_name=$row['first_name'];
	 $last_name = $row['last_name'];
	 $owner_id = $row['id'];
	 $other_path = $row['owner_path'];
	 $owner_list[] = $other_path;
	 $owner_name[$other_path] = $first_name .' '.$last_name;
	 $owner_picture[$other_path] = $row['profile_picture'];
	} 
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Upload your videos or pictures</title>
<style type="text/css" media="screen">
div {
	margin-bottom: 10px;
}

ul {
	display: none;
	list-style-type: none;
	margin-top: 5px;
}

ul > li > a:hover {background: #736F6E;}

div > p {
	display: block;
	width: 280px;
	background: #FFFFFF;
	border: 2px outset;
	margin:0
 }
 
div > p:hover  {  border: 2px inset;background: #FFFFFF; border-color: #736F6E;color:white  }
</style>	

</head>
<body style="color:darkblue;">

<?php
if (mysql_num_rows($MyGroup) == 0) {
echo "<font color='red' id='ErrorMessage'>You have not create any viewer group yet.<br/>
      Plese add the viewer group first!</font>";
}
?>
<form name="upload" method="post" enctype="multipart/form-data">
Upload files to: <br/>
<div  style="display:inline-block;width:280px;" id="Private">
	<table width="100%">
		<tbody>
		<tr>
		<td colspan="2">
			<div class="menu1" id="Result">
				<p><img src='<?php echo $owner_picture[$GV_owner_path] ?>'  height='50px' id="picked" />
				<img src='../images/down_arrow.jpg'  width='50px'/><span id="picked_owner" >
				<?php echo $owner_name[$GV_owner_path] ?></span></p>
				<ul style="display: none;text-align:left;" id="menu1">
				<li><a href="" onClick="GetDisp();clearfield('../images/profile/public.jpg','Public','');return false;"><img src='../images/profile/public.jpg'  width='50px' /></a>Public</li>
	<?php
		foreach ($owner_list as $key => $value) {
echo <<<_END
<li><a href="" onClick="clearfield('$owner_picture[$value]','$owner_name[$value]','$value');return false;"><img src='$owner_picture[$value]'  width='50px'/></a>$owner_name[$value]</li>
_END;

			echo "<select name='$value' id='$value' style='display: none;'>";
			if($value == $GV_owner_path)	{
				echo "<option value=''>All My Group</option>";
			}
			if(isset($SelectOpt[$value])) {
				foreach ($SelectOpt[$value] as $key2 => $value2) {
					echo "<option value='$value2'>$value2</option>";
				}
			}
			echo "</select>";
		}
			?>	
				</ul>
			</div>
		</td>
		</tr>
		<tr>
		<td align="right">
		</td>
		<td align="left">
		</td>
		</tr>
		</tbody>
	</table>
</div><br/>
<font id="share" color="red">Share with: </font>
	<select name='GroupID' id='GroupID'>
	<option value=''>All My Group</option>
	<?php
		if(isset($SelectOpt[$GV_owner_path])) {
			foreach ($SelectOpt[$GV_owner_path] as $key4 => $value4) {
				echo "<option value='$value4'>$value4</option>";
			}
		}
	?>
	</select><br/>
Descriptions:
  <input type="text" name="description" id="description" value="" size="40"><br/>
  <font color="red">Maximum size of 2M for each picture:</font><br />
  <input type="hidden" name="sel_path" id="sel_path" value='<?php echo $GV_owner_path ?>'>
  <input type="hidden" name="sel_name" id="sel_name" value="<?php echo $owner_name[$GV_owner_path] ?>">
  <input name="filename0" id="filename0" type="file" size="50" /><br />
  <input name="filename1" id="filename1" type="file" size="50" /><br />
  <input name="filename2" id="filename2" type="file" size="50" /><br />
  <input name="filename3" id="filename3" type="file" size="50" /><br />
  <input name="filename4" id="filename4" type="file" size="50" /><br />
  <input name="filename5" id="filename5" type="file" size="50" /><br />
  <input name="filename6" id="filename6" type="file" size="50" /><br />
  <input name="filename7" id="filename7" type="file" size="50" /><br />
  Upload your profile picture below if needed <br />
  <input name="profile" id="profile" type="file" size="50" /><br />
  <input type="submit" value="Send files" onClick="return UploadCheck();"/>
 </form>
<?php 
//var_dump($_POST);
define("MAX_SIZE",2000000); 

        if(isset($_SESSION['message'])) echo $_SESSION['message'];
		$message = '';
		if ($_FILES)
		{
			$CreateID = 0;
			$viewer_group = '';
			$sel_name = mysql_real_escape_string($_POST['sel_name']);
			$sel_path = mysql_real_escape_string($_POST['sel_path']);
			$description = mysql_real_escape_string($_POST['description']);
			if(isset($_POST['GroupID'])) $viewer_group = mysql_real_escape_string($_POST['GroupID']);
			if($sel_path != ''){
				if($viewer_group!='') {
					$pictures = "../pictures/".$sel_path.'/'.$viewer_group.'/';
					$videos = "../videos/".$sel_path.'/'.$viewer_group.'/';
					@mkdir("$pictures");
					@mkdir("$videos");
					}
				else {
					$pictures = "../pictures/".$sel_path.'/';
					$videos = "../videos/".$sel_path.'/';
					}
			}
			else {
				$pictures = "../pictures/";
				$videos = "../videos/";
				}
			for($i=0;$i<=7;$i++){
			    $filename = "filename"."$i";
				$name = $_FILES["$filename"]['name'];
				$ext = strtolower(substr($name,strpos($name,".") + 1));
				if ($ext == 'gif' 
					  || $ext == 'png'
					  || $ext == 'jpg'
					  || $ext == 'tif'
					  ) 
					  {
					  if($sel_name!='Public') $n = "$pictures"."$name";
					  else $n = "$pictures"."$GV_owner_path"."_"."$name";
					  $picture_video = 'pictures';
					  }
				else if ($ext == 'mp4' 
					  || $ext == 'swf' 
					  || $ext == 'flv'
					  ) 
					  {
					  if($sel_name!='Public') $n = "$videos"."$name";
					  else $n = "$videos"."$GV_owner_path"."_"."$name";
					  $picture_video = 'videos';
					  }
				else $n = '';
				if ($n != ''){
					if(($_FILES["$filename"]["size"] < MAX_SIZE) || $picture_video == 'videos'){
						if(!move_uploaded_file($_FILES["$filename"]['tmp_name'], $n)) $message .= "<p>Upload file $name failed!</p>";
						else {
							if($viewer_group!='')
								$message .= "<p>File $name had been uploaded to $sel_name's $viewer_group group</p>";
							else if($sel_name != 'Public')
								$message .= "<p>File $name had been uploaded to $sel_name's all group</p>";
							else
								$message .= "<p>File $name had been uploaded to the public section</p>";
							if($sel_name!='Public') $SaveCheck = "SELECT * FROM picture_video WHERE owner_path = '$sel_path' AND viewer_group = '$viewer_group' and name = '$n' LIMIT 1";
							else  $SaveCheck = "SELECT * FROM picture_video WHERE owner_path = '$GV_owner_path' AND viewer_group = 'Public' and name = '$n' LIMIT 1";
							$result2 = mysql_query($SaveCheck);
							if (mysql_num_rows($result2) == 0){
								if($CreateID == 0) {
									mysql_query("INSERT INTO upload_infor(description,upload_date) VALUES('$description',NOW())");
									echo mysql_error();
									$queryUploadID="SELECT id FROM upload_infor where 1 order by id desc limit 1";
									$GetUploadID=mysql_query($queryUploadID);          // query executed 
									echo mysql_error();
									while($GetUploadIDRow = mysql_fetch_array($GetUploadID))
									{
										$upload_id = $GetUploadIDRow['id'];
									} 								
								}
								if($sel_name!='Public')	mysql_query("INSERT INTO picture_video(owner_path,picture_video,viewer_group,name,upload_id) VALUES('$GV_owner_path','$picture_video', '$viewer_group', '$n',$upload_id)");
								else mysql_query("INSERT INTO picture_video(owner_path,picture_video,viewer_group,name,upload_id) VALUES('$GV_owner_path','$picture_video', 'Public', '$n',$upload_id)");
								$CreateID = 1;
							}
						}
					}
					else {
					echo "There was an error uploading the file, please try again!";
					exit();
					}
				}
			}
			$filename = "profile";
			$name = $_FILES["$filename"]['name'];
			$ext = strtolower(substr($name,strpos($name,".") + 1));
			if ($ext == 'gif' 
				  || $ext == 'png'
				  || $ext == 'jpg'
				  || $ext == 'tif'
				  ) $n = "../images/profile/$GV_owner_path.$ext";
			else $n = '';
			if ($n != ''){
				if(!move_uploaded_file($_FILES["$filename"]['tmp_name'], $n)) $message .= "<p>Profile picture upload failed!</p>";
				else {
					$message .= "<p>Profile picture had been uploaded and replaced</p>";
					mysql_query("UPDATE user SET profile_picture='../images/profile/$GV_owner_path.$ext' WHERE email_address = '$GV_email_address'");
					echo mysql_error();
				}
			}
			
			if($sel_name!='Public' && $_SERVER['HTTP_HOST'] !='localhost:8380')	{		
					$querySend="SELECT viewer_email FROM view_permission where  owner_email = '$GV_email_address' and viewer_group = $viewer_group order by owner_email";
					$SendResult=mysql_query($querySend);          // query executed 
					echo mysql_error();
					while($SendResultRow = mysql_fetch_array($SendResult))
					{
						$todaydate = date("l, F j, Y, g:i a");
						$email = $SendResultRow['viewer_email'];
						$to = $SendResultRow['viewer_email'];
						$websit = $_SERVER['HTTP_HOST'];
			//			$to = "raymondlwhuang@gmail.com,raymondlwhuang@yahoo.com";
						$cc = "";
						$subject = "New Pictures/Videos";
						$headers = "From: raymondlwhuang@yahoo.com\r\n";
						$headers .= "Reply-To: raymondlwhuang@yahoo.com\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$bodyText = '<html><body>';
						$bodyText .= "<h1>Just have some new pictures and videos uploaded!<br/>";
						$bodyText .= "Sent at: $todaydate</h1><br/>";
						$bodyText .= "<br/><a href='$websit' >Click here to view</a><br/>";
						$bodyText .= "<br/><br/><br/><h1>Regard<br/><br/>$owner_name[$GV_email_address]</h1><br/>";
						$bodyText .= '</body></html>';
						if (preg_match("/bcc:/i", $email . " " . $bodyText) == 0 &&          /* check for injected 'bcc' field */
							preg_match("/Content-Type:/i", $email . " " . $bodyText) == 0 && /* check for injected 'content-type' field */
							preg_match("/cc:/i", $email . " " . $bodyText) == 0 &&           /* check for injected 'cc' field */
							preg_match("/to:/i", $email . " " . $bodyText) == 0) {           /* check for injected 'to' field */
							// Format the body of the email
							$sent = @mail($to, $subject, $bodyText, $headers) ;
							/*
							if($sent) {
								echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "Your mail was sent successfully.<br>Thanks for your comment"</script>';
							} else {
								echo '<script type="text/javascript">document.getElementById("ErrorMessage").innerHTML = "We encountered an error sending your mail"</script>';
							}
							*/
						} else  {
							$message = "We encountered an error sending your mail<br/>";
						}
						$_SESSION['message'] = $message;

					}
				}
	echo <<<_END
	<script type="text/javascript">
	window.open( 'MyBlogUpload.php', '_self');
	</script>
_END;
		}
		//else echo "No file has been uploaded";
		unset ($_SESSION['message'], $message);
?>
<!--<br/><font color="red">It will see by everyone come to this site after upload</font>-->
Supported video format:
<table border="1" width="100%">
<tr>
<th>Browser</th><th>MP4</th><th>WebM</th><th>Ogg</th>
</tr>
<tr>
<td>Internet Explorer</td><td>YES</td><td>NO</td><td>NO</td>
</tr>
<tr>
<td>Firefox</td><td>NO</td><td>YES</td><td>YES</td>
</tr>
<tr>
<td>Google Chrome</td><td>YES</td><td>YES</td><td>YES</td>
</tr>
<tr>
<td>Apple Safari</td><td>YES</td><td>NO</td><td>NO</td>
</tr>
<tr>
<td>Opera</td><td>NO</td><td>YES</td><td>YES</td>
</tr>
</table>
<!--<a href="http://www.dvdvideosoft.com/products/dvd/Free-Video-to-Flash-Converter.htm"target="_blank">Click here</a> to Download the converter if needed<br/>-->
<a href="http://www.mirovideoconverter.com/download_win.html" target="_blank">Click here</a> to Download the converter if needed</p><br/>

</body>
</html>
<script src="../scripts/jquery-1.3.2.min.js"></script>

<script type="text/javascript" >
window.onload = initAll;

function initAll() {
	var allLinks = document.getElementsByTagName("div");
	
	for (var i=0; i<allLinks.length; i++) {
		allLinks[i].onmouseover = function (){document.getElementById("menu1").style.display = "block";}
		allLinks[i].onmouseout =  function (){document.getElementById("menu1").style.display = "none";}
		allLinks[i].onclick =  function (){document.getElementById("menu1").style.display = "none";}
	}
}
function UploadCheck() {
  if(document.getElementById('MyGroupID').selectedIndex == 0) 
  return confirm('Are you sure want your upload files to be view by public?');
  else if(document.getElementById('MyGroupID').selectedIndex == 1) return confirm('Are you sure want your upload files to be view by all of your group?');
  return true;
}
function GetDisp() {
alert('tst');
	url = "../search/deleteViewer.php?user_id=<?php echo $GV_id; ?>&action=get&id="+this_id;
	$(document).ready(function() {
	   $('#Result').load(url);
	   $.ajaxSetup({ cache: false });
	});
}
function clearfield(picture,name,curr_path) {
	var ID = '';
	for (var i=0; i<8; i++) {
		ID = 'filename'+i;
		document.getElementById(ID).value = '';
	}
	document.getElementById('picked').src = picture;
	document.getElementById('picked_owner').innerHTML = name;
	if(curr_path !='') {
	document.getElementById('share').innerHTML='Share with: ';
	var inner = document.getElementById(curr_path).innerHTML;
	select_innerHTML(document.getElementById("GroupID"),inner);
	document.getElementById('GroupID').style.display='inline-block';
	document.getElementById('sel_path').value=curr_path;
	document.getElementById('sel_name').value=name;
	}
	else {
	document.getElementById('share').innerHTML='';
	document.getElementById('GroupID').innerHTML='';
	document.getElementById('GroupID').style.display='none';
	document.getElementById('sel_path').value='';
	document.getElementById('sel_name').value='Public';
	}
	
}

function select_innerHTML(objeto,innerHTML){
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.toLowerCase().indexOf("<option")<0){
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION")
    
   if(document.all){ //IE
    objeto.add(opt)
   }else{
    objeto.appendChild(opt)
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   //IE
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}
window.open( "../PHP/RemovePicture1.php", "Remove");
</script>

