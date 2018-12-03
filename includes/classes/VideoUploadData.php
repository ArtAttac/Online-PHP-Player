<?php
//Class ensures data passed is all ok and through
class VideoUploadData{

    //saving space by putting em all on one line
    public $videoDataArray, $title, $description, $privacy, $category, $uploadedBy;

    //then a constructor to pass all the upload info data through this class
    public function __construct($videoDataArray, $title, $description, $privacy, $category, $uploadedBy){
        $this->videoDataArray = $videoDataArray;
        $this->title = $title;
        $this->description = $description;
        $this->privacy = $privacy;
        $this->caregory = $category;
        $this->uploadedBy = $uploadedBy;

    }

    //This would return the title 
    // public function getTitle(){
    //     return $this->title
    // }
    

}

?>