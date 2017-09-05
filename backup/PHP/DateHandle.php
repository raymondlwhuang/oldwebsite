<?php
$date = "1998-08-14";
echo $date;
echo "<br/>";
echo "subtracting 3 days from the date: ";
$newdate = strtotime ( '-3 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );
 
echo $newdate;		
echo "<br/>";
echo "subtracting 3 weeks from the date: ";
$newdate = strtotime ( '-3 week' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );
 
echo $newdate;
echo "<br/>";
echo "subtracting 3 months from the date: ";
$newdate = strtotime ( '-3 month' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );
 
echo $newdate;
echo "<br/>";
echo "subtracting 3 years from the date: ";
$newdate = strtotime ( '-3 year' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );
 
echo $newdate;