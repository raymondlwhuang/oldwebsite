<?php
include("../config.php");
include_once("sethash.php");
$flag=(int)$_REQUEST['flag'];
$pv_id=(int)$_REQUEST['pv_id'];
$user_id=(int)$_REQUEST['user_id'];
$shareto_id = (int)$_REQUEST['shareto_id'];
$share = (int)$_REQUEST['share'];
if(isset($_REQUEST['is_video'])) $is_video = (int)$_REQUEST['is_video'];
else $is_video = 0;
$RequireResult = mysql_query("SELECT * FROM user WHERE id=$user_id limit 1");
while($Reqopt = mysql_fetch_array($RequireResult)) {
	$ReqName=$Reqopt['first_name']." ".$Reqopt['last_name'];
}

$todaydate = date("l, F j, Y, g:i a");
$headers = "From: no-reply@raymondlwhuang.com\r\n";
$headers .= "Reply-To: no-reply@raymondlwhuang.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$websit = $_SERVER['HTTP_HOST'];
$inviter = newencode($user_id);
$bodyText ='
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <head>
 <style>
 <!--
 body, P.msoNormal, LI.msoNormal
 {
 background-position: top;
 background-color: #336699;
 margin-left:  10em;
 margin-top: 1em;
 font-family: "verdana";
 font-size:   10pt;
 font-weight:bold ;
 color:    #000000;
 }
a {
background-color: #DFB214;
border: 3px #FDD032 outset;
text-decoration: none;
}
 -->
 </style>
 </head>
 <body> 
';						
$bodyText .= "<h1><b>From: $ReqName</b><h1><br/>";
$bodyText .= "<h1>Please click accept to grain me to share one of your photo to my friend<br/>";
$bodyText .= "Sent at: $todaydate</h1><br/><br/><br/>";
$message = $bodyText;	
$message .= "<br/><br/>LIKE TO SHARE YOU SOME PHOTOS<br/>";	
$message .= "<br/><br/><a href='$websit/' style=\"background-color:#AFC7C7;border-style:outset;text-decoration: none;padding:5px;\">Click here to take a look at the picture</a><br/>";	
$message .= '</body></html>';
$PictureResult = mysql_query("SELECT * FROM picture_video WHERE id=$pv_id limit 1");
// echo mysql_error();
while($row = mysql_fetch_array($PictureResult)) {
	$pv_name=$row['name'];
}
if($flag==1) {
	$FriendResult = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and is_active>0 group by viewer_id");
	while($option = mysql_fetch_array($FriendResult)) {
		$viewer_id=$option['viewer_id'];
		if($share==1) {
			$beforeInsert = mysql_query("SELECT * FROM pv_share WHERE pv_id=$pv_id and shareto_id=$viewer_id limit 1");
			if(mysql_num_rows($beforeInsert) == 0) {
				// echo mysql_error(); 
				$EmailResult = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and viewer_id=$viewer_id limit 1");
				// echo mysql_error();
				while($emailopt = mysql_fetch_array($EmailResult)) {
					if($emailopt['share_flag']==2) {
						mysql_query("INSERT INTO pv_share(pv_id,sharefm_id,shareto_id,pv_name,is_video) VALUES($pv_id,$user_id,$viewer_id,'$pv_name',$is_video)"); /* I am a viewer, the name is my name for display purpose*/
						mail("$emailopt[viewer_email]", "Picture sharing",  $message, $headers);
					}
					else {
						mysql_query("INSERT INTO pv_share(pv_id,sharefm_id,shareto_id,pv_name,accept,is_video) VALUES($pv_id,$user_id,$viewer_id,'$pv_name',1,$is_video)"); /* I am a viewer, the name is my name for display purpose*/
						$infor=newencode("$pv_id,$user_id,$viewer_id,$pv_name");
						$invitee = newencode($emailopt['viewer_email']);
						$bodyText .= "<a href='$websit/PHP/ShareReply.php?infor=$infor&accept=1' onClick=\"alert('Thank you. Your photo is been shared!');\">&nbsp;&nbsp;Accept&nbsp;&nbsp;</a>   <a href='$websit/PHP/ShareReply.php?infor=$infor&accept=0' onClick=\"alert('Thank you. Your photo will not be shared!');\">&nbsp;&nbsp;Decline&nbsp;&nbsp;</a><br/>";
						$bodyText .= "$ReqImg</body></html>";
						$link=$websit.substr($pv_name,3);
						$ReqImg="<a href=\"$link\">Click here to view your photo </a>";
						$bodyText .= "$ReqImg</body></html>";						
						mail("$emailopt[viewer_email]", "Sharing Required",  $bodyText, $headers);
					}
				}				
			}
		}
		else {
			mysql_query("DELETE FROM `pv_share` WHERE pv_id=$pv_id and sharefm_id=$user_id and shareto_id=$viewer_id limit 1");
			// echo mysql_error();
		}
	}
}
else {
	if($share==1) {
		$beforeInsert = mysql_query("SELECT * FROM pv_share WHERE pv_id=$pv_id and shareto_id=$shareto_id limit 1");
		if(mysql_num_rows($beforeInsert) == 0) {
			// echo mysql_error();
			$EmailResult = mysql_query("SELECT * FROM view_permission WHERE user_id=$user_id and viewer_id=$shareto_id limit 1");
			// echo mysql_error();
			while($emailopt = mysql_fetch_array($EmailResult)) {
				if($emailopt['share_flag']==2) {
					mysql_query("INSERT INTO pv_share(pv_id,sharefm_id,shareto_id,pv_name,is_video) VALUES($pv_id,$user_id,$shareto_id,'$pv_name',$is_video)"); /* I am a viewer, the name is my name for display purpose*/
					mail("$emailopt[viewer_email]", "Picture sharing",  $message, $headers);
				}
				else {
					mysql_query("INSERT INTO pv_share(pv_id,sharefm_id,shareto_id,pv_name,accept,is_video) VALUES($pv_id,$user_id,$shareto_id,'$pv_name',1,$is_video)"); /* I am a viewer, the name is my name for display purpose*/
					$infor=newencode("$pv_id,$user_id,$shareto_id,$pv_name");
					$invitee = newencode($emailopt['viewer_email']);
					$bodyText .= "<a href='$websit/PHP/ShareReply.php?infor=$infor&accept=1' onClick=\"alert('Thank you. Your photo is been shared!');\">&nbsp;&nbsp;Accept&nbsp;&nbsp;</a>   <a href='$websit/PHP/ShareReply.php?infor=$infor&accept=0' onClick=\"alert('Thank you. Your photo will not be shared!');\">&nbsp;&nbsp;Decline&nbsp;&nbsp;</a><br/>";
					$bodyText .= "$ReqImg</body></html>";
					$link=$websit.substr($pv_name,3);
					$ReqImg="<a href=\"$link\">Click here to view your photo </a>";
					$bodyText .= "$ReqImg</body></html>";						
					mail("$emailopt[viewer_email]", "Sharing Required",  $bodyText, $headers);
				}
			}
		}
	}	
	else {
		mysql_query("DELETE FROM `pv_share` WHERE pv_id=$pv_id and sharefm_id=$user_id and shareto_id=$shareto_id");
		// echo mysql_error();
	}
}

	