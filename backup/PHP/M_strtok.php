<?PHP
echo 'You can do things with strtok that you can\'t do with explode/split. explode breaks a string using another string, split breaks a string using a regular expression.  strtok breaks a string using single _characters_ , but the best part is you can use multiple characters at the same time.

For example, if you are accepting user input and aren\'t sure how the user will decide to divide up their data you could choose to tokenize on spaces, hyphens, slashes and backslashes ALL AT THE SAME TIME:
';
echo "<br/>";
$teststr = "blah1 blah2/blah3-blah4\\blah5";

$tok = strtok($teststr," /-\\");
while ($tok !== FALSE)
{
  $toks[] = $tok;
  $tok = strtok(" /-\\");
}

while (list($k,$v) = each($toks))
{
  echo ("$k => $v<BR/>");
}

?>