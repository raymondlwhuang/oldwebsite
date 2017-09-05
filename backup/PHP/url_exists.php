<?php
    function url_exists($url){
        $url = str_replace("http://", "", $url);
        if (strstr($url, "/")) {
            $url = explode("/", $url, 2);
            $url[1] = "/".$url[1];
        } else {
            $url = array($url, "/");
        }

        $fh = fsockopen($url[0], 80);
        if ($fh) {
            fputs($fh,"GET ".$url[1]." HTTP/1.1\nHost:".$url[0]."\n\n");
            if (fread($fh, 22) == "HTTP/1.1 404 Not Found") { return FALSE; }
            else { return TRUE;    }

        } else { return FALSE;}
    }
if(url_exists("http://www.raymondlwhuang.com/AddSource.php"))
{
   echo "URL: http://www.raymondlwhuang.com/AddSource.php is exist";
}
else
   echo "URL: http://www.raymondlwhuang.com/AddSource.php is not exist";
?>