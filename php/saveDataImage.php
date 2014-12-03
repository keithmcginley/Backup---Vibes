<?php

// http://j-query.blogspot.ie/2011/02/save-base64-encoded-canvas-image-to-png.html
//define('UPLOAD_DIR', '../uploads/');
$data = $_POST['imgBase64'];
$image_name = $_POST["name"];


list($type, $data) = explode(';', $data);
list(, $data) = explode(',', $data);
$data = base64_decode($data);

if (file_put_contents('../uploads/' . $image_name . '.png', $data)) {
    echo "Uploaded";
    // Lets Create the Thumbnail
    $orgImg = '../uploads/' . $image_name . '.png';
    $newImg = '../uploads/thumbs/' . $image_name . '.png';
    
    resize($orgImg, $newImg, 300, 338);
} else {
    echo "File was not uploaded" . "\n";
    echo "image name : " . $image_name . ".png \n";
    echo "data : " . $data . "\n";
}

/*	Function resize($filename_original,$filename_resized,$new_w,$new_h)
	creates a resized image
	variables:
	$filename_original	Original filename
	$filename_resized	Filename of the resized image
	$new_w		width of resized image
	$new_h		height of resized image
*/	
function resize($filename_original, $filename_resized, $new_w, $new_h) {
	$extension = pathinfo($filename_original, PATHINFO_EXTENSION);
 
	if ( preg_match("/jpg|jpeg/", $extension) ) $src_img=@imagecreatefromjpeg($filename_original);
 
	if ( preg_match("/png/", $extension) ) $src_img=@imagecreatefrompng($filename_original);
 
	if(!$src_img) return false;
 
	$old_w = imageSX($src_img);
	$old_h = imageSY($src_img);
 
	$x_ratio = $new_w / $old_w;
	$y_ratio = $new_h / $old_h;
 
	if ( ($old_w <= $new_w) && ($old_h <= $new_h) ) {
		$thumb_w = $old_w;
		$thumb_h = $old_h;
	}
	elseif ( $y_ratio <= $x_ratio ) {
		$thumb_w = round($old_w * $y_ratio);
		$thumb_h = round($old_h * $y_ratio);
	}
	else {
		$thumb_w = round($old_w * $x_ratio);
		$thumb_h = round($old_h * $x_ratio);
	}		
 
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_w,$old_h); 
 
	if (preg_match("/png/",$extension)) imagepng($dst_img,$filename_resized); 
	else imagejpeg($dst_img,$filename_resized,100); 
 
	imagedestroy($dst_img); 
	imagedestroy($src_img);
 
	return true;
}

?>