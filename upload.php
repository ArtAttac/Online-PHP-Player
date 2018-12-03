<?php 
require_once("includes/header.php"); 
require_once("includes/classes/VideoDetailForm.php");
?>
                
    <div class = "column">
        <?php
        $formProvider = new VideoDetailForm($con);
        echo $formProvider->createUploadForm();

        ?>

    </div>
<?php require_once("includes/footer.php"); ?>