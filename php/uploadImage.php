<?php
print_r($_FILES);

function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' ) 
    {
      echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  }
  // close the directory
  closedir( $dir );
}

$new_image_name = $_FILES["file"]["name"].'.jpg';
//$imageName = filter_input(INPUT_POST, 'fileName');
$uploads_dir = "../uploads/";
//$uploads_dir = "../uploads/";    $_SERVER['DOCUMENT_ROOT'] . 
if (move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/".$new_image_name))
{
    echo "Uploaded";
    $pathToThumbs = '../uploads/thumbs';
    $thumbWidth = 300;
    createThumbs($uploads_dir, $pathToThumbs, $thumbWidth);
} else 
{
    echo "File was not uploaded". "\n";
    echo "image name : ".$new_image_name. "\n";
    echo "temp name : ".$_FILES["file"]["tmp_name"]. "\n";
    echo "file location : ".$uploads_dir.$new_image_name. "\n";
    echo "full file localtion : ". $uploads_dir . "\n";
}    

// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links
//createThumbs("upload/","upload/thumbs/",100);


?>