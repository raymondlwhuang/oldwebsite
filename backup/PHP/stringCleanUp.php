<?php
function clean_text ( $strVar )
{
	$strVar = strip_tags ( $strVar );
	$strVar = htmlentities ( $strVar, ENT_QUOTES );
	$strVar = stripslashes ( $strVar );

	return $strVar;
}

$text = '<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>';
echo strip_tags($text);
echo "\n";

// Allow <p> and <a>
echo strip_tags($text, '<p><a>');
$str = "A 'quote' is <b>bold</b>";

// Outputs: A 'quote' is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str);

// Outputs: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str, ENT_QUOTES);
$str = "Is your name O\'reilly?";

// Outputs: Is your name O'reilly?
echo stripslashes($str);
?>