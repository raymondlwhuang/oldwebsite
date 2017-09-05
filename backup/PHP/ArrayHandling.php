<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Using array_splice()</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
    <style type="text/css">
      h2, pre { margin: 1px; }
      table { margin: 0; border-collapse: collapse; width: 100%; }
      th { text-align: left; }
      th, td { text-align: left; padding: 4px; vertical-align: top; border: 1px solid gray; }
    </style>
  </head>
  <body>
    <h1>Using array_splice()</h1>

<?php
echo "1. Adding two new elements to the middle</br>";
$authors = array( "Steinbeck", "Kafka", "Tolkien" );
$arrayToAdd = array( "Melville", "Hardy" );
print_r( $authors );
echo "</br>";
array_splice( $authors, 2, 0, $arrayToAdd );
print_r( $authors );
echo "</br>";
echo "2. Replacing two elements with a new element";
echo "</br>";
$authors = array( "Steinbeck", "Kafka", "Tolkien" );
$arrayToAdd = array( "Bronte" );
print_r( $authors );
echo "</br>";
array_splice( $authors, 0, 2, $arrayToAdd );
print_r( $authors );
echo "</br>";
echo "3. Removing the last two elements";
echo "</br>";
$authors = array( "Steinbeck", "Kafka", "Tolkien" );
print_r( $authors );
array_splice( $authors, 1 );
print_r( $authors );
echo "</br>";
echo "4. Inserting a string instead of an array";
echo "</br>";
$authors = array( "Steinbeck", "Kafka", "Tolkien" );
print_r( $authors );
array_splice( $authors, 1, 0, "Orwell" );
print_r( $authors );
echo "<p>The current element is: " . current( $authors ) . ".</p>";
echo "<p>The next element is: " . next( $authors ) . ".</p>";
echo "<p>...and its index is: " . key( $authors ) . ".</p>";
echo "<p>The next element is: " . next( $authors ) . ".</p>";
echo "<p>The previous element is: " . prev( $authors ) . ".</p>";
echo "<p>The first element is: " . reset( $authors ) . ".</p>";
echo "<p>The last element is: " . end( $authors ) . ".</p>";
echo "<p>The previous element is: " . prev( $authors ) . ".</p>";
?>

  </body>
</html>