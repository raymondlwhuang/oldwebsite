<?php
session_start();
include("../config.php");
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
$query="SELECT * FROM main where Ext = 'php' or Ext ='html' order by ShortDesc";  // query string stored in a variable
$result=mysql_query($query);          // query executed 
echo mysql_error();              // if any error is there that will be printed to the screen 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Help listing</title>
<script type="text/javascript" src="../scripts/DocUp.js"></script>
</head>
<body>

<table width="100%">
<?php	
while($nt=mysql_fetch_array($result)){
echo "	
<tr>
<td style='border-style: solid;text-align:left;'>
$nt[ShortDesc]
</td>
</tr>
";
}
?>
</table>
</body>
</html>
	