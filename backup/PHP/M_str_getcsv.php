<?php
//
// Convert csv file to associative array:
//

function csv_to_array($input, $delimiter='|')
{
    $header = null;
    $data = array();
    $csvData = str_getcsv($input, "
");
   
    foreach($csvData as $csvLine){
        if(is_null($header)) $header = explode($delimiter, $csvLine);
        else{
           
            $items = explode($delimiter, $csvLine);
           
            for($n = 0, $m = count($header); $n < $m; $n++){
                $prepareData[$header[$n]] = $items[$n];
            }
           
            $data[] = $prepareData;
        }
    }
   
    return $data;
}

//-----------------------------------
//
//Usage:

$csvArr = csv_to_array(file_get_contents('M_rtrim.php'));
var_dump($csvArr);
?>