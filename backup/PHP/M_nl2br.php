<?php 
      $string_text=file_get_contents("../robots.txt"); // load text file in var
      $new_text=nl2br($string_text); // convert CR & LF in <br> in newvar
      echo $new_text; // print out HTML formatted text
      unset($string_text, $new_text); // clear all vars to unload memory
 ?>