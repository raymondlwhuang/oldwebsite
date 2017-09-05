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
    $_REQUEST = _stripslashes_rcurs($_REQUEST);
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
if(isset($_REQUEST['FriendID'])) {
	$FriendID = $_REQUEST['FriendID'];
	 if($FriendID!='Public') {
		$getowner=mysql_query("SELECT * FROM user where id = $FriendID limit 1");  // query string stored in a variable
		while($owneresult = mysql_fetch_array($getowner)) {
			$result_path=$owneresult['owner_path'];
			$result_name=ucfirst(strtolower($owneresult['first_name']))." ".ucfirst(strtolower($owneresult['last_name']));
			$result_profile_picture=$owneresult['profile_picture'];
		}
	}
}
else {
 $result_path = $GV_owner_path;
 $result_name=$GV_name;
 $result_profile_picture=$GV_profile_picture;
}
 
$GetSomething=0;
if(isset($result_path)) {
	$beforeShow=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and viewer_group <> 'Public' order by upload_id desc, id desc limit 1");  // query string stored in a variable
	if(mysql_num_rows($beforeShow) != 0) {
		$GetSomething=1;
	}
}
else $GetSomething=0;
 
	if(isset($_REQUEST['show_id'])){ $upload_id = $_REQUEST['show_id'];	}

	if(!isset($upload_id))
	{
		if($GetSomething==0){ 
			$beforeShow2=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and viewer_group = 'Public' order by upload_id desc,id desc limit 1");  // query string stored in a variable
			echo "PUBLIC PICTURES";
		}
		else 
			$beforeShow2=mysql_query("SELECT * FROM picture_video where owner_path = '$result_path' and picture_video = 'pictures' and viewer_group <> 'Public' order by upload_id desc limit 1");  // query string stored in a variable
		while($row6 = mysql_fetch_array($beforeShow2))
		{
			$upload_id = $row6['upload_id'];
		}
	}
	if(isset($upload_id)) $resultShow=mysql_query("SELECT * FROM picture_video where picture_video = 'pictures' and upload_id = '$upload_id' order by upload_id desc, id desc");  // query string stored in a variable
	$markup = '<div style="position: relative;display:inline-block;" id="slideshow">';
	while(@$row3 = mysql_fetch_array($resultShow)) {
		$markup .= "<img style=\"position: absolute; top: 0px; left: 0px; display: block; z-index: 6; opacity: 1;  height: 420px;\" src=\"$row3[name]\" height=\"420\">";
	};
	$markup .= '</div>';			
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>JQuery Cycle Plugin - Basic Demo</title>
<style type="text/css">
.slideshow { height: 232px; width: 232px; margin: auto }
.slideshow img { padding: 15px; border: 1px solid #ccc; background-color: #eee; }
</style>
<!-- include jQuery library -->
<script type="text/javascript" src="../scripts/jquery.js"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="../scripts/jquery.cycle.all.js"></script>
<script type="text/javascript" src="../scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript">
var markup = '<?php echo $markup; ?>';
var count=0, fxcount=0,startingSlide=0;
var fx_value = new Array();
fx_value[28]='zoom';
fx_value[7]='fade';
fx_value[1]='blindX';
fx_value[2]='blindY';
fx_value[3]='blindZ';
fx_value[4]='cover';
fx_value[5]='curtainX';
fx_value[6]='curtainY';
fx_value[8]='fadeZoom';
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

$(document).ready(function() {
		$('#slideshow').cycle({
			fx: 'zoom', // choose your transition type, ex: fade, scrollUp, shuffle,scrollLeft,zoom etc...
			startingSlide: startingSlide,
			after:   onAfter
		});
});
	function start() {
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

	function onAfter(curr,next,opts) {
		count++;
		startingSlide++;
		if(startingSlide>=opts.slideCount) startingSlide=0;
/*		if((opts.currSlide+1) >= opts.slideCount){
			$('#slideshow').cycle('stop');
		} */
			if((opts.currSlide+1) >= opts.slideCount){
				fxcount++;
				fx=fx_value[fxcount];
				if(fxcount>28) fxcount=0; 
				start();
			}			
	};
	function stop_show() {
		$('#slideshow').cycle('stop');
	};
	function start_show() {
		fx=fx_value[fxcount];
		start();
	};	
</script>
</head>
<body>
<div id="show">
<?php echo $markup; ?>
</div>
<form name='MyForm' action="PictureMain.php" enctype='application/x-www-form-urlencoded' method='post'>
<?php
	foreach($_REQUEST as $name => $value) {
	  if($name!='comment') echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
	}
?>
<input type='hidden' name='upload_id' value="<?php echo $upload_id; ?>">
Comment: <input type='text' name='comment' size='80' value='' onfocus="stop_show();" onblur="start_show();">
</form>
</body></html>