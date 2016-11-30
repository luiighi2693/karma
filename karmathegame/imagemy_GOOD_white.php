<? ini_set('memory_limit','100000M'); // set memory to prevent fatal errors
define('MEMORY_TO_ALLOCATE','100000M');
function getExtension($filename)
{
	$path_info = pathinfo($filename);
	return $path_info['extension'];
}
function thumbnail_box($img, $box_w, $box_h) 
{
	//create the image, of the required size
    $new = imagecreatetruecolor($box_w, $box_h);
    if($new === false) {
        //creation failed -- probably not enough memory
        return null;
    }


    //Fill the image with a light grey color
    //(this will be visible in the padding around the image,
    //if the aspect ratios of the image and the thumbnail do not match)
    //Replace this with any color you want, or comment it out for black.
    //I used grey for testing =)
    $fill = imagecolorallocate($new, 255, 255, 255);
    imagefill($new, 0, 0, $fill);

    //compute resize ratio
    $hratio = $box_h / imagesy($img);
    $wratio = $box_w / imagesx($img);
    $ratio = min($hratio, $wratio);

    //if the source is smaller than the thumbnail size, 
    //don't resize -- add a margin instead
    //(that is, dont magnify images)
    if($ratio > 1.0)
        $ratio = 1.0;

    //compute sizes
    $sy = floor(imagesy($img) * $ratio);
    $sx = floor(imagesx($img) * $ratio);

    //compute margins
    //Using these margins centers the image in the thumbnail.
    //If you always want the image to the top left, 
    //set both of these to 0
    $m_y = floor(($box_h - $sy) / 2); //0;//
    $m_x = floor(($box_w - $sx) / 2);

    //Copy the image data, and resample
    //
    //If you want a fast and ugly thumbnail,
    //replace imagecopyresampled with imagecopyresized
    if(!imagecopyresampled($new, $img,
        $m_x, $m_y, //dest x, y (margins)
        0, 0, //src x, y (0,0 means top left)
        $sx, $sy,//dest w, h (resample to this size (computed above)
        imagesx($img), imagesy($img)) //src w, h (the full size of the original)
    ) {
        //copy failed
        imagedestroy($new);
        return null;
    }
    //copy successful
    return $new;
}

/*$system=explode(".",$_GET["nm"]);
$source=$_GET["nm"];
if (preg_match("/jpg|jpeg/",$system[1])){
	$im=imagecreatefromjpeg($source);				
}else if (preg_match("/png/",$system[1])){
	$im=imagecreatefrompng($source);				
}else if (preg_match("/gif/",$system[1])){
	$im=imagecreatefromgif($source);				
}else if (preg_match("/bmp/",$system[1])){
	$im=imagecreatefromwbmp($source);				
}else if($ext=="jpg" || $ext=="jpeg" || $ext=="JPEG" || $ext=="JPG"){
	$im=imagecreatefromjpeg($source);
}else if($ext=="gif" || $ext=="GIF"){
	$im=imagecreatefromgif($source);
}else if($ext=="png" || $ext=="PNG"){
	$im=imagecreatefrompng($source);
}else if($ext=="bmp" || $ext=="BMP"){
	$im=imagecreatefromwbmp($source);
}else{
	$im=imagecreatefromjpeg($source);
}*/

/*list( $source_width, $source_height, $source_type ) = getimagesize($_GET["nm"]);
switch ( $source_type )
{
	case IMAGETYPE_GIF:
	$im = imagecreatefromgif($_GET["nm"] );
	break;
	case IMAGETYPE_JPEG:
	$im = imagecreatefromjpeg($_GET["nm"] );
	break;
	case IMAGETYPE_PNG:
	$im = imagecreatefrompng($_GET["nm"]);
	break;
	case IMAGETYPE_BMP:
	$im = imagecreatefromwbmp($_GET["nm"] );
	break;
}*/
if($_GET["nm"]!='')
{
	$system=getExtension($_GET["nm"]);//explode(".",$_GET["nm"]);
	//echo $system;
	$source=$_GET["nm"];
	if (preg_match("/jpg|jpeg/",$system)){
		$im=imagecreatefromjpeg($source);				
	}else if (preg_match("/png/",$system)){
		$im=imagecreatefrompng($source);				
	}else if (preg_match("/gif/",$system)){
		$im=imagecreatefromgif($source);				
	}else if (preg_match("/bmp/",$system)){
		$im=imagecreatefromwbmp($source);				
	}else if($ext=="jpg" || $ext=="jpeg" || $ext=="JPEG" || $ext=="JPG"){
		$im=imagecreatefromjpeg($source);
	}else if($ext=="gif" || $ext=="GIF"){
		$im=imagecreatefromgif($source);
	}else if($ext=="png" || $ext=="PNG"){
		$im=imagecreatefrompng($source);
	}else if($ext=="bmp" || $ext=="BMP"){
		$im=imagecreatefromwbmp($source);
	}else{
		$im=imagecreatefromjpeg($source);
	}
		
	//$i = imagecreatefromjpeg($_GET["nm"]);
	$thumb = thumbnail_box($im, ($_GET["mwidth"]), ($_GET["mheight"]));
	imagedestroy($im);
	
	if(is_null($thumb)) {
		/* image creation or copying failed */
		header('HTTP/1.1 500 Internal Server Error');
		exit();
	}
	header('Content-Type: image/jpeg');
	imagejpeg($thumb,'',100);
}	
?>