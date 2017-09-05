<?php
$str = "A 'quote' is <b>bold</b>";

// Outputs: A 'quote' is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str);
echo "</br>";
// Outputs: A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str, ENT_QUOTES);
echo "</br>";
?>
<pre>
ENT_COMPAT 	Will convert double-quotes and leave single-quotes alone.
ENT_QUOTES 	Will convert both double and single quotes.
ENT_NOQUOTES 	Will leave both double and single quotes unconverted.
ENT_IGNORE 	Silently discard invalid code unit sequences instead of returning an empty string. Added in PHP 5.3.0. 
                This is provided for backwards compatibility; avoid using it as it may have security implications.
</pre>