<?php
echo "use of strip_tags(string,allow) ";
echo "<br/>";
echo strip_tags("Hello <b>world!</b>");
echo "<br/>";
echo strip_tags("Hello <b><i>world!</i></b>","<b>");
echo "<br/>";
echo "simple way to strip BBCode:";
echo "<br/>";
$bbcode_str = "Here is some [b]bold text[/b] and some [color=#FF0000]red text[/color]!";
echo $bbcode_str;
echo "<br/>";
$plain_text = strip_tags(str_replace(array('[',']'), array('<','>'), $bbcode_str));
echo $plain_text;
echo "<br/>";
echo 'Note that strip_tags may stumble when it encounters two consecutive quotes. Regardless of whether that\'s a bug or a feature (different PHP versions seem to behave differently) here\'s a workaround:';
  $wtf = '
    <p>First line</p>
    <a href=\"foo">bar</a>
    <p>Second line</p>
    <a href=\"foo\"">bar</a>
    <p>Third line</p>
  ';
  echo 'Raw: ' . $wtf . "<br/>";
  echo 'strip_tags(): ' . strip_tags ($wtf);
  echo "<br/>";
  echo 'Regexp: ' . preg_replace ('/<[^>]*>/', '', $wtf);
?>