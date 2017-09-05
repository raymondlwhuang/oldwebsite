<?php
include("../config.php");
include("../inc/GlobalVar.inc.php");
$queryOwner="SELECT * FROM user where  email_address = '$GV_email_address' order by id LIMIT 1";
$owner=mysql_query($queryOwner);          // query executed 
echo mysql_error();
while($row = mysql_fetch_array($owner))
{
 $chatStat = $row['is_active'];
}
	$FriendCount = 0;
	$query="SELECT * FROM view_permission where owner_email = '$GV_email_address' group by viewer_email";  // query string stored in a variable
	$result=mysql_query($query);          // query executed 
	echo mysql_error();              // if any error is there that will be printed to the screen 
	while($row2 = mysql_fetch_array($result))
	{
		$curr_path = $row2['owner_path'];
		$FriendEmail[] = $row2['viewer_email'];
		if($row2['is_active']==3) $TalkStatus[] = 'checked'; else $TalkStatus[] = '';
		$TalkValue[] = $row2['is_active'];
		$queryFriends="SELECT * FROM user where  email_address = '$row2[viewer_email]' and is_active <> 0 LIMIT 1";
		$friend=mysql_query($queryFriends);          // query executed 
		echo mysql_error();
		while($row3 = mysql_fetch_array($friend))
		{
		 $first_name=ucfirst(strtolower($row3['first_name']));
		 $last_name = ucfirst(strtolower($row3['last_name']));
		 $profile_picture[] = $row3['profile_picture'];
		 $name[] = $first_name." ".$last_name;
		 $FriendStat[] = $row3['is_active'];
		} 
		$FriendCount = $FriendCount + 1;
	}
if(isset($profile_picture))	{
echo "Chat($FriendCount)";
if($chatStat==3 || $chatStat==4) {
	$sMessages =<<<END
	<style type="text/css" media="screen">
	a{text-decoration:none;}
	</style> 

	<input type="hidden" name="email" id="email" value ="">
	<input type="hidden" name="activate" id="activate" value ="">
	<table width="200" border="0">
END;

	foreach ($profile_picture as $key => $value) {
	$sMessages = $sMessages . "<tr><td valign='top'>";
	if($FriendStat[$key] == 3 || $FriendStat[$key] == 4)
	{
		$sMessages = $sMessages . <<<END
		<input type='image' name='TalkTo' value=$FriendEmail[$key] src='$value' width='35' onClick="SendRequest ('../PHP/ChatTo.php?email=$FriendEmail[$key]','responsecontainer');" />
		</td><td  valign='center'><font size='2'><a href="" onClick="SendRequest ('../PHP/ChatTo.php?email=$FriendEmail[$key]','responsecontainer');return false;">$name[$key]</a></font>
END;
	}
	else
		$sMessages = $sMessages . "<img src='$value' width='35'/>
		</td><td  valign='center'><font size='2'>$name[$key]</font>";
	$sMessages = $sMessages . "</td><td valign='center'>";	
	if($FriendStat[$key] == 2) $sMessages = $sMessages . "<img src='../images/yellow.png' width='20'/>";

	elseif($FriendStat[$key] == 3)
	{
	$sMessages = $sMessages . <<<END
	<a href="" onClick="SendRequest ('../PHP/ChatTo.php?email=$FriendEmail[$key]','responsecontainer');return false;"><img src='../images/green.png' width='20' />
END;
	}
	elseif($FriendStat[$key] == 4)
	{
	$sMessages = $sMessages . <<<END
	<a href="" onClick="SendRequest ('../PHP/ChatTo.php?email=$FriendEmail[$key]','responsecontainer');return false;"><img src='../images/red.png' width='20' />
END;
	}		
	else $sMessages = $sMessages . "<img src='../images/white.png' width='20'/>";
	$sMessages = $sMessages . "</td><td valign='center'>";
	if($FriendStat[$key] == 3 || $FriendStat[$key] == 4) {
		$sMessages = $sMessages . <<<END
		<input type='checkbox' name='TalkTo' value='3' $TalkStatus[$key]  onClick="SendRequest ('../PHP/ChatTo.php?email=$FriendEmail[$key]','responsecontainer');" />
END;
		}
		$sMessages = $sMessages . "</td></tr>";
	}
	$sMessages = $sMessages . "</table>";
	mysql_close($link);
	echo "$sMessages";
}
}
?>	

