<?php
@session_start();
if(@$_SESSION['private'] != "yes")
{
	header('Location: index.php');
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
	if(isset($_REQUEST['FriendID']))
	{	
		$FriendID = $_REQUEST['FriendID'];
		$ViewerID = $_REQUEST['ViewerID'];
	}
	if($FriendID!="Public") {
		if($_SESSION["admin"]!=1){
			if($ViewerID != $FriendID){
				$queryPermit="SELECT * FROM view_permission where user_id = $FriendID and viewer_id = $ViewerID group by viewer_group";  // query string stored in a variable
			}
			else {
				$queryPermit="SELECT * FROM view_permission where user_id = $ViewerID group by viewer_group";  // query string stored in a variable
			}
		}
		else $queryPermit="SELECT * FROM view_permission where user_id = $FriendID group by viewer_group";
		$resultPermit=mysql_query($queryPermit);          // query executed 
		echo mysql_error();              // if any error is there that will be printed to the screen 
		$passed=0;
		if (mysql_num_rows($resultPermit) != 0){
			while($row = mysql_fetch_array($resultPermit))
			{	
				$curr_path = $row['owner_path'];
				$permit[$curr_path][] = $row['viewer_group'];
				
			}
			foreach ($permit as $key => $value) {
				foreach ($value as $key2 => $value2) {
					$queryPicture=mysql_query("SELECT * FROM picture_video where owner_path = '$key' and viewer_group = '$value2' order by id desc");  // query string stored in a variable
					echo mysql_error();              // if any error is there that will be printed to the screen 
					if(mysql_num_rows($queryPicture) !=0){
						$passed=1;
					}
				}
			}
		}
		echo $passed;
	}
	else echo 1;

?>
