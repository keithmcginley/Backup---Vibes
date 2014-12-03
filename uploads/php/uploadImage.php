<?php
print_r($_FILES);


$new_image_name = $_FILES["file"]["name"].'.jpg';
//$imageName = filter_input(INPUT_POST, 'fileName');
$imageName = 'test';
$uploads_dir = "../uploads/";
//$uploads_dir = "../uploads/";    $_SERVER['DOCUMENT_ROOT'] . 
if (move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/".$new_image_name))
{
    echo "Uploaded";
} else 
{
    echo "File was not uploaded". "\n";
    echo "image name : ".$new_image_name. "\n";
    echo "temp name : ".$_FILES["file"]["tmp_name"]. "\n";
    echo "file location : ".$uploads_dir.$new_image_name. "\n";
    echo "full file localtion : ". $uploads_dir . "\n";
}      


?>