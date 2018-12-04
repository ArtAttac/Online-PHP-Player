<?php

//handle the data user submitted
class VideoProcesser{

    private $con;
    //5 million bytes or 500mb
    private $sizeLimit = 500000000;
    //variable for file type
    private $allowedTypes = array("mp4","flv","webm","mkv","vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
    private $ffmegPath;
    //making the constructor
    //setting the value of con each time
    public function __construct($con){
        $this->con = $con; 
        //windows needs the full absolute path 
        private $ffmpegPath = "C:/xampp1/htdocs/onlineplayer/ffmpeg/bin/ffmpeg.exe";
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
        

        if(!$isValidData){
            return false;
        }

        //check if its a valid file type and path then puts it into temp path, it it works, true, if not, false
        if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {
            //moved successfully, create final temporary path. final path should be mp4
            $finalFilePath = $targetDir . uniqid() . ".mp4";
            //insert video into data table, pass two arguments, file that was submitted to be uploaded and the second is the final file path
            if(!$this->insertVideoData($videoUploadData, $finalFilePath)){
                echo "Insert Query failed";
                return false;
            }

            if(!$this->convertVideoToMP4($tempFilePath, $finalFilePath)){
                echo "Upload Failed";
                return false;
            }
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
    //a function to insert video data properly
    //prepare specifies which query we're going to use
    private function insertVideoData($uploadData, $filePath){
        //using prepared statements, prepare SQL DB to the videos values and bind them to values recieved from upload
        $query = $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
                                        VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");
        $query->bindParam(":title", $uploadData->title);   
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);                                
        $query->bindParam(":privacy", $uploadData->privacy);                                
        $query->bindParam(":category", $uploadData->category);                                
        $query->bindParam(":filePath", $filePath);   
        
        //if it returns successfully it'll return true, otherwise false
        return $query->execute();
    }

    //method for converting video from whatever file it is to mp4 using ffmegg
    public function convertVideoToMP4($tempFilePath, $finalFilePath){
        //2>&1 outputs errors for you, but this line runes ffmeg using the tempfile and ending at final path file
        $cmd = "$this->ffmegPath -i  $tempFilePath $finalFilePath 2>&1";

        $outputLog = array();
        //passing in what to begin, where it'll be stored after and whether we were successful or not (returncode)
        exec($cmd, $outputLog, $returnCode);

        if($returnCode != 0){
            //command failed
            //every iteration it will display what is going on
            foreach($outputLog as $line){
                echo $line . "<br>";
            }
            return false;
        }
        return true;
    }
}
?>