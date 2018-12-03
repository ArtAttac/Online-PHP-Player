<?php
class VideoDetailForm{

    private $con;

    //first bit of code executed when class is intialized
    public function __construct($con){
        $this->con = $con;
    }

    public function createUploadForm(){
        //call that file upload button function here
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        $categoriesInput = $this->createCategoriesInput();
        $uploadButton = $this->createUploadButton();
        //using double quotes, the next line will be read as php
        return "<form action = 'processing.php' method = 'POST' enctype = 'multipart/form-data'>
                     $fileInput
                     $titleInput
                     $descriptionInput
                     $privacyInput
                     $categoriesInput
                     $uploadButton
                </form>";
    }
    // we don't need to call this outside the function, thus the private
    private function createFileInput(){
        // when called, function will use the php of fileinput above to insert to be uploaded.
      return "<div class='form-group'>
            <input type='file' class='form-control-file' id='exampleInputFile' aria-describedby='fileHelp' name = 'fileInput' required>
            <small id='fileHelp' class='form-text text-muted'>This is some placeholder block-level help text for the above input. Its a bit lighter and easily wraps to a new line.</small>
        </div>";
    }

    private function createTitleInput(){
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Title' name = 'titleInput'>
                 </div>";
    }

    private function createDescriptionInput(){
        return "<div class='form-group'>
                     <textarea class='form-control' placeholder='Description' name = 'descriptionInput' rows='3'></textarea>
                 </div>";
    }
    // form group class allows for the spacing between each input, allows for each to have it's own operating box in the window
    private function createPrivacyInput(){
        return "<div class = 'form-group'>
                    <select class='form-control' name = 'privacyInput'>
                        <option value = '0'>Private</option>
                        <option value = '1'>Public</option>
                    </select>
                </div>";
    }

    private function createCategoriesInput(){
            //Using PHP code to query the database
            //$query is the query variable and we're putting the query inside parenthesis (return all data from categories branch)
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class = 'form-group'>
                        <select class='form-control' name = 'categoryInput'>";

            //loop through each query and gather the name and display it on new lines
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $name = $row['name'];
                $id = $row['id'];

                $html .= "<option value = '$id'>$name</option>";
               
            }

            $html .= "</select>
                        </div>";

            return $html;
    }

    private function createUploadButton(){
        return "<button type='submit' class = 'btn btn-primary' name='uploadButton'>Upload</button>";
    }
}
?>