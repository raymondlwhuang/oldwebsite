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
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
include("../config.php");
include("../inc/GlobalVar.inc.php");
include_once("sethash.php");
if(isset($_POST['Invite_x']))
{
	foreach($_REQUEST as $encode_email => $invited) {
	  if($invited=="invited"){
		$viewer_email=newdecode($encode_email);
		if($GV_username=="") {
			$from=$GV_first_name. " ".$GV_last_name;
			if($from=="") $from=$GV_email_address;
		}
		else $from=$GV_username;
	    mysql_query("UPDATE view_permission SET is_active=10 WHERE user_id=$GV_id and viewer_email='$viewer_email';");
						$todaydate = date("l, F j, Y, g:i a");
						$to = $viewer_email;
			//			$to = "raymondlwhuang@gmail.com,raymondlwhuang@yahoo.com";
						$inviter = newencode($GV_email_address);
						$invitee = newencode($viewer_email);
						$cc = "";
						$subject = "Invitation";
						$headers = "From: $GV_email_address\r\n";
						$headers .= "Reply-To: $GV_email_address\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
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
						.pointer { cursor: pointer }
						 -->
						 </style>
						 </head>
						 <body> 
						';						
						$bodyText .= "<h1><b>From: $from</b><h1><br/>";
						$bodyText .= "<h1>You're invited to view my photo book at http://www.raymondlwhuang.com Enjoy!<br/> Please accept me as your friend<br/>";
						$bodyText .= "Sent at: $todaydate</h1><br/><br/><br/>";
						$bodyText .= "<a href='http://www.raymondlwhuang.com/IReply.php?inviter=$inviter&invitee=$invitee&accept=1' class='pointer'>&nbsp;&nbsp;Accept&nbsp;&nbsp;</a>   <a href='http://www.raymondlwhuang.com/IReply.php?inviter=$inviter&invitee=$invitee&accept=0'  class='pointer'>&nbsp;&nbsp;Decline&nbsp;&nbsp;</a><br/>";
						$bodyText .= '</body></html>';
						if (preg_match("/bcc:/i", $viewer_email . " " . $bodyText) == 0 &&          /* check for injected 'bcc' field */
							preg_match("/Content-Type:/i", $viewer_email . " " . $bodyText) == 0 && /* check for injected 'content-type' field */
							preg_match("/cc:/i", $viewer_email . " " . $bodyText) == 0 &&           /* check for injected 'cc' field */
							preg_match("/to:/i", $viewer_email . " " . $bodyText) == 0) {           /* check for injected 'to' field */
							// Format the body of the email
							$sent = @mail($to, $subject, $bodyText, $headers) ;
						} else  {
							$message = "We encountered an error sending your mail<br/>";
						}		
	  }
	}
	mysql_close();
echo <<<_END
	<script type="text/javascript">
		window.open('InviteFriend.php',target='_top');
	</script>
_END;

	exit(); 
}
$ViewerList = mysql_query("SELECT * FROM view_permission WHERE  user_id=$GV_id and is_active=9 group by viewer_email");
if (mysql_num_rows($ViewerList) == 0){
echo <<<_END
	<script type="text/javascript">
		alert("Congratulation you have successfully finish your set up!\\nClick OK to start your session");
		window.open("index.php",target="_top");			
	</script>
_END;

	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>VIEWER GROUP SET UP</title>
<script type="text/javascript">
function Select_all(is_checked) {
	var allTags = document.getElementsByTagName("input");
	for (var i=0; i<allTags.length; i++) {
		if(allTags[i].type=="checkbox") allTags[i].checked=is_checked;
	}
}
</script>
</head>
<body style="font-size:30px;">
<center>
<table width="600" style="border-style: solid;border-color:#0000ff;border-width: 3px;">
	<tr>
    <td align="center" colspan="2" style="font-size:18px;font-weight:bold;border-style: solid;border-width: 1px;text-align:center;">INVITE FRIENDS</td>
	</tr>
	<tr>
	<td style='text-align:right;'>
	<input type="image" src="../images/home.png" name="Home" value="Home" height="60px" onClick="window.open('index.php',target='_top');">
	</td>
	<td style='text-align:right;' width="150px">
	<input type="image" src="../images/nextStep.png" height="60px" onClick="alert('Congratulation you have successfully finish your set up!\nClick OK to start your session');window.open('index.php',target='_top');">
	</td>
	</tr>
</table>
<form name="InviteFriends" method="Post">
<table border="0" width="600" id="mytable">
	<tr>
		<td style="border: 1px solid #38c;font-size:18px;" colspan="2">
		<input type="checkbox" name="All" id="All" value="All" onChange="Select_all(this.checked);">Select All
		</td>
		<td align="center" style="border: 1px solid #38c;font-size:20px;">Pick a friend to invite from below
		</td>
	</tr>
	<tr>
		<th width="40" style="border: 1px solid #38c;">
		</th>
		<th align='left' width="50" style="border: 1px solid #38c;">
		
		</th>	
		<th align='left' style="border: 1px solid #38c;">
		</th>	
	</tr>	
<?php	

while($nt=mysql_fetch_array($ViewerList)){
	$viewer_email1=newencode($nt['viewer_email']);
	$PictureResult = mysql_query("SELECT * FROM user WHERE email_address = '$nt[viewer_email]' limit 1"); /* get his/her friend infor */
	while($row = mysql_fetch_array($PictureResult)) {
		$profile_picture=$row['profile_picture'];
		$user_id1=$row['id'];
	}
echo "
<tr>
    <td align='center' style=\"border: 1px solid #38c;\">
	<input type=\"checkbox\" name=\"$viewer_email1\" value=\"invited\" id='$user_id1'>
	</td>
    <td valign='left' style=\"border: 1px solid #38c;\">
	<img src=\"$profile_picture\" width='50px' /> 
	</td>
    <td align='left' style=\"border: 1px solid #38c;font-size:30px;\">
	$nt[first_name]	$nt[last_name]
	</td></tr>";
}
?>
<tr>
<td colspan="3" align="center" style="border: 1px solid #38c;">
<input type='image' src='../images/InviteFriends.jpg' name='Invite' width="120">
</td>
</tr>
</table>
</form>
</center>

</body>
</html>
	