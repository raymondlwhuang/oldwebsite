This shows how rtrim works when using the optional charlist parameter:
rtrim reads a character, one at a time, from the optional charlist parameter and compares it to the end of the str string. If the characters match, it trims it off and starts over again, looking at the "new" last character in the str string and compares it to the first character in the charlist again. If the characters do not match, it moves to the next character in the charlist parameter comparing once again. It continues until the charlist parameter has been completely processed, one at a time, and the str string no longer contains any matches. The newly "rtrimmed" string is returned.
<?php
  // Example 1:
echo "<br/>";
  echo rtrim('This is a short short sentence', 'short sentence');
  echo "<br/>";
  // returns 'This is a'
  // If you were expecting the result to be 'This is a short ',
  // then you're wrong; the exact string, 'short sentence',
  // isn't matched.  Remember, character-by-character comparison!
  // Example 2:
  echo rtrim('This is a short short sentence', 'cents');
  // returns 'This is a short short '
echo "<br/>";
?>