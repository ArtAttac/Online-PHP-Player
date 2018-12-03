<?php

//handle the data user submitted
class VideoProcesser{

    private $con;
    //5 million bytes or 500mb
    private $sizeLimit = 500000000;
    //variable for file type
    private $allowedTypes = array("mp4","flv","webm","mkv","vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");

    //making the constructor
    //setting the value of con each time
    public function __construct($con){
        $this->con = $con; 
    }
    //calling this function from processing.php
    public function upload($videoUploadData){
        //where we are going to store the videos
        $targetDir = "uploads/videos/";
        //the actual file upload and giving it a temporary path
        $videoData = $videoUploadData->videoDataArray;

        //giving a unique identifier for processing, and then the name of the file
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        //"uploads/videos/ + 5aefffhwy1738 + dogs playing

        //replaces part of a string with another string
        $tempFilePath = str_replace(" ", "_", $tempFilePath);

        //process data
        $isValidData = $this->processData($videoData, $tempFilePath);

        echo ($isValidData);
        echo ($tempFilePath);
        

        if(!$isValidData){
            return false;
        }

        //check if its a valid file type and path then puts it into temp path, it it works, true, if not, false
        if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {
            echo "File moved successfully";
        }

        //store as a weird file type then convert
    }
    private function processData($videoData, $filePath){
        //create variable for video type uploaded
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);
        //check if file size is too big
        if (!$this->isValidSize($videoData)) {
            echo "File too large! Can't be more than " . $this->sizeLimit . " bytes";
            return false;
        }
        //check for valid data type
        else if(!$this->isValidType($videoType)){
            echo "Invalid file type";
            return false;
        }
    else if($this->hasError($videoData)){
        //if it did find an error
        echo "Error code: " . $videoData["error"];
        return false;
    }   

    return true;
    }
    
    private function isValidSize($data){
        return $data["size"] <= $this->sizeLimit;
    }

    private function isValidType($type){
        //function is all lower case letters
        $lowercased = strtolower($type);
        //check if something is in array
        return in_array($lowercased, $this->allowedTypes);
    }

    //Returns errors if caught
    private function hasError($data){
        //anything other than 0 is an error
        return $data["error"] != 0;
    }
}
?>