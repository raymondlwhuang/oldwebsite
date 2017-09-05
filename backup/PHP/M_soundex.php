<?php
function train($file = '../big.txt') {
        $contents = file_get_contents($file);
        // get all strings of word letters
        preg_match_all('/\w+/', $contents, $matches);
        unset($contents);
        $dictionary = array();
        foreach($matches[0] as $word) {
                $word = strtolower($word);
                $soundex_key = soundex($word);
                if(!isset($dictionary[$soundex_key][$word])) {
                    $dictionary[$soundex_key][$word] = 0;
                }
 
                $dictionary[$soundex_key][$word] += 1;
        }
        unset($matches);
        return $dictionary;
}
function train2($file = '../big.txt') {
        $contents = file_get_contents($file);
        // get all strings of word letters
        preg_match_all('/\w+/', $contents, $matches);
        unset($contents);
        $dictionary = array();
        foreach($matches[0] as $word) {
                $word = strtolower($word);
                if(!isset($dictionary[$word])) {
                        $dictionary[$word] = 0;
                }
                $dictionary[$word] += 1;
        }
        unset($matches);
        return $dictionary;
}
function correct($word) {
	$dic = train2();
    if (array_key_exists($word, $dic)) {
        return $word;
    }  
	$dic = train();
    if (array_key_exists($word, $dic)) {
        return $word;
    }  	
	if (isset($dic[soundex($word)])) $search_result = $dic[soundex($word)]; else return '';
 
    foreach ($search_result as $key => &$res) {
        $dist = levenshtein($key,$word);
        // consider just distance equals to 1 (the best) or 2
        if ($dist == 1 || $dist == 2) {
            $res = $res / $dist;
        }
        // discard all the other candidates that have distances other than 1 and 2
        // from the original word
        else {
            unset($search_result[$key]);
        }
    }
 
    // reverse sorting of the words by frequence
    arsort($search_result);
 
    // return the first key of the array (which will be the word suggested)
    foreach ($search_result as $key => $res) {
        return $key;
    }
}
IF(isset($_POST['submit']))
{
	$wrongs = $_POST['secondword'];
	$good = $bad = 0;
	$wrongs = explode(' ', $wrongs);
	foreach($wrongs as $wrong) {
		$CorrectWord = correct($wrong);
		if($CorrectWord != '') {
			if($wrong == $CorrectWord){
				echo "You spell it correctly!";
				echo "<br/>";
			}
			else {
			echo "The correct spelling of this word is: ";
			echo $CorrectWord;
			echo "<br/>";
			}
		} else {
			echo "Can not valify this word";
			echo "<br/>";
		}

	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
This spelling correct program is about 80% correct! <br/>
<form name="validate" id="validate"  method="post">
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td>Enter a word: <input type="text" size="50" name="secondword" id="secondword" value=""  /></td>
</tr>
	<tr>
		<td><input type="submit" value="Click to find the correct spelling" name="submit" /><br/><b><font color="red" id="ErrorMessage"></font></b></td>
	</tr>
</table>
</form>
</body>
</html>