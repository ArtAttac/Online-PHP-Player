<?php 
// This page is for handling the input
require_once("includes/header.php"); 
require_once("includes/classes/VideoUploadData.php"); 
require_once("includes/classes/VideoProcessing.php"); 

if(!isset($_POST["uploadButton"])) {
    echo "What is going on.";
    //will stop execution of code
    exit();
}

// 1) create file upload data
//passing each of the arguments needed through
$videoUplodeData = new VideoUploadData(
        $_FILES["fileInput"],
        $_POST["titleInput"],
        $_POST["descriptionInput"],
        $_POST["privacyInput"],
        $_POST["categoryInput"],
        //Will eventually make this a user once i read the stack overflow...
        //IF USER IS LOGGED IN
        "REPLACE-THIS"
    );



// 2) Process video data (upload)
$videoProcesser = new VideoProcesser($con);
$wasSuccessful = $videoProcesser->upload($videoUplodeData); 



// 3) Check if upload was successful
?>