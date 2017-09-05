<?php
function addBorderpng($add,$bdr=1,$color='#FFFFFF'){
    $arr = explode('.', $add);
    $extension = strtolower(end($arr));
    $border=$bdr;
    if($extension == 'jpg'){
        $im=imagecreatefromjpeg($add);
    }
    else if($extension =='png'){
        $im=imagecreatefrompng($add);
    }
    $width=imagesx($im);
    $height=imagesy($im);
    $img_adj_width=$width+(2*$border); 
    $img_adj_height=$height+(2*$border);
    $newimage=imagecreatetruecolor($img_adj_width,$img_adj_height);

    $color_gb_temp =HexToRGB($color);
    $border_color = imagecolorallocate($newimage, $color_gb_temp['r'], $color_gb_temp['g'], $color_gb_temp['b']);
    imagefilledrectangle($newimage,0,0,$img_adj_width,$img_adj_height,$border_color);

    imagecopyresized($newimage,$im,$border,$border,0,0,$width,$height,$width,$height); 
    if($extension == 'jpg') {
		header('Content-type: image/jpeg');
        imagejpeg($newimage);
	}
    else if($extension == 'gif') {
		header('Content-type: image/gif');
        imagegif($newimage);
	}
    else if($extension == 'gif') {
		header('Content-type: image/gif');
        imagegif($newimage);
	}
    else if($extension == 'png') {
		header('Content-type: image/png');
        imagepng($newimage);
	}
	else if ($extension == 'wbmp') {
		header("Content-type: image/wbmp");
		imagewbmp($newimage);	
	}
	else if ($extension == 'xbm') {
		header("Content-type: image/xbm");
		imagexbm($newimage);	
	}

}
 function HexToRGB($hex){
    $hex = ltrim($hex,"#");
		
	if($hex=='black') $hex='000000';
	elseif($hex=='silver') $hex='C0C0C0';
	elseif($hex=='gray') $hex='808080';
	elseif($hex=='white') $hex='FFFFFF';
	elseif($hex=='maroon') $hex='800000';
	elseif($hex=='red') $hex='FF0000';
	elseif($hex=='purple') $hex='800080';
	elseif($hex=='fuchsia') $hex='FF00FF';
	elseif($hex=='green') $hex='008000';
	elseif($hex=='lime') $hex='00FF00';
	elseif($hex=='olive') $hex='808000';
	elseif($hex=='yellow') $hex='FFFF00';
	elseif($hex=='navy') $hex='000080';
	elseif($hex=='blue') $hex='0000FF';
	elseif($hex=='teal') $hex='008080';
	elseif($hex=='aqua') $hex='00FFFF';	
		
	$color = array();

	if(strlen($hex) == 3) {
	$color['r'] = hexdec(substr($hex, 0, 1) . $r);
	$color['g'] = hexdec(substr($hex, 1, 1) . $g);
	$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
	$color['r'] = hexdec(substr($hex, 0, 2));
	$color['g'] = hexdec(substr($hex, 2, 2));
	$color['b'] = hexdec(substr($hex, 4, 2));
	}
	return $color;
 }
