<?php
echo 'List all drives, free space, total space and percentage free.';
echo '<br/>';
	$drive = dirname(__FILE__);
            $freespace           = @disk_free_space($drive);
            $total_space         = @disk_total_space($drive);
            $percentage_free     = $freespace ? round($freespace / $total_space, 2) * 100 : 0;
            echo $drive.'Free space: '.to_readble_size($freespace).' / '.'Total space: '.to_readble_size($total_space).' ['.$percentage_free.'%]<br />';

    function to_readble_size($size)
    {
        switch (true)
        {
            case ($size > 1000000000000):
                $size /= 1000000000000;
                $suffix = 'TB';
                break;
            case ($size > 1000000000):
                $size /= 1000000000;
                $suffix = 'GB';
                break;
            case ($size > 1000000):
                $size /= 1000000;
                $suffix = 'MB';   
                break;
            case ($size > 1000):
                $size /= 1000;
                $suffix = 'KB';
                break;
            default:
                $suffix = 'B';
        }
        return round($size, 2).$suffix;
    }
	
?>