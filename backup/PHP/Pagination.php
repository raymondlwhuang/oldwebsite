<?php 
 // Connects to your Database 
 include("../config.php");
if(isset($_REQUEST['pagenum']))
{
	$pagenum = (int)$_REQUEST['pagenum'];
}
 
 //This checks to see if there is a page number. If not, it will set it to page 1 
 if (!(isset($pagenum))) 
 { 
 $pagenum = 1; 
 } 
 
 //Here we count the number of results 
 //Edit $data to be your query 
 $data = mysql_query("SELECT * FROM spending") or die(mysql_error()); 
 $rows = mysql_num_rows($data); 
 
 //This is the number of results displayed per page 
 $page_rows = 4; 
 
 //This tells us the page number of our last page 
 $last = ceil($rows/$page_rows); 
 
 //this makes sure the page number isn't below one, or more than our maximum pages 
 if ($pagenum < 1) 
 { 
 $pagenum = 1; 
 } 
 elseif ($pagenum > $last) 
 { 
 $pagenum = $last; 
 } 
 
 //This sets the range to display in our query 
 $max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
 
 //This is your query again, the same one... the only difference is we add $max into it
 $data_p = mysql_query("SELECT * FROM spending $max") or die(mysql_error()); 

 //This is where you display your query results
 while($info = mysql_fetch_array( $data_p )) 
 { 
 Print $info['amount']; 
 echo "<br>";
 } 
 echo "<p>";
 
 // This shows the user what page they are on, and the total number of pages
 echo " --Page $pagenum of $last-- <p>";
 
 // First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page.
 if ($pagenum == 1) 
 {
 } 
 else 
 {
 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'><img src=\"../images/first.png\" name=\"Cancel\" value=\"Cancel\"></a> ";
 echo " ";
 $previous = $pagenum-1;
 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'><img src=\"../images/previous.png\"></a> ";
 } 

 //just a spacer
// echo " ---- ";

 //This does the same as above, only checking if we are on the last page, and then generating the Next and Last links
 if ($pagenum == $last) 
 {
 } 
 else {
 $next = $pagenum+1;
 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'><img src=\"../images/next1.png\"></a> ";
 echo " ";
 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'><img src=\"../images/last.png\"></a> ";
 } 
 ?> 