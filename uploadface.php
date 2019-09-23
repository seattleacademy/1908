<?php
$target_dir = "/var/www/faces/"; //global directory
$target_dir = "faces/"; // local directory, use chmod 777 faces to give write access to the server
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = strtolower($target_file);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$baseFile = pathinfo($target_file,PATHINFO_FILENAME);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
$counter = 1;

while(file_exists($target_dir . $baseFile . "." . $counter . "."  . $imageFileType)) {
    $counter++;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $baseFile . "." . $counter . "."  . $imageFileType)) {
        echo $target_dir . $baseFile . "." . $counter . "."  . $imageFileType . " has been uploaded.";
    } else {
        print_r(error_get_last());
    }
}
?>