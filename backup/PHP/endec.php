<?php
$cloak_keyword = "raymond".$GV_pin;

class endec {
	
	public function new_encode($string) {
	    global $cloak_keyword;
	    $key = sha1($cloak_keyword);
	    $strLen = strlen($string);
	    $keyLen = strlen($key);
		$hash = '';
	    $j = 0;
	    for ($i = 0; $i < $strLen; $i++) {
			$ordStr = ord(substr($string,$i,1));
			if ($j == $keyLen) { $j = 0; }
			$ordKey = ord(substr($key,$j,1));
			$j++;
			$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
	    }
	    return $hash;
	}

	public function new_decode($string) {
	    global $cloak_keyword;
	    $key = sha1($cloak_keyword);
	    $strLen = strlen($string);
	    $keyLen = strlen($key);
		$hash = '';
	    $j = 0;
	    for ($i = 0; $i < $strLen; $i+=2) {
			$ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
			if ($j == $keyLen) { $j = 0; }
			$ordKey = ord(substr($key,$j,1));
			$j++;
			$hash .= chr($ordStr - $ordKey);
	    }
	    return $hash; 
	} 
	
} 

?>		