<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/OneticktFormProvider.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/SelectThumbnail.php");


if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}


if(!isset($_GET["videoId"])) {
    echo "No video selected";
    exit();
}


$video = new Video($connectionString, $_GET["videoId"], $userLoggedInObj);

// Prevents others from editing your video
if($video->getUploadedBy() != $userLoggedInObj->getUsername()) {
    echo "Not your video";
    exit();
}

$detailsMessage = "";
if(isset($_POST["saveButton"])) {
    $videoData = new VideoUploadData(
        null, 
        $_POST["titleInput"],
        $_POST["descriptionInput"],
        $_POST["privacyInput"],
        $_POST["categoryInput"],
        $userLoggedInObj->getUsername()
    );

    
    if($videoData->updateDetails($connectionString, $video->getId())) {
        $detailsMessage = "<div class='alert alert-success'>
                                <strong>SUCCESS!</strong> Details updated successfully!
                            </div>";
        $video = new Video($connectionString, $_GET["videoId"], $userLoggedInObj);
    }
    else {
        $detailsMessage = "<div class='alert alert-danger'>
                                <strong>ERROR!</strong> Something went wrong
                            </div>";
    }
}

?>
<script src="assets/js/editVideoActions.js"></script>
<div class="editVideoContainer column">

    <div class="message">
        <?php echo $detailsMessage; ?>
    </div>
    <div class="topSection">
        <?php 
            $videoPlayer = new VideoPlayer($video);
            echo $videoPlayer->create(false);

            $selectThumbnail = new SelectThumbnail($connectionString, $video);
            echo $selectThumbnail->create(false);
        ?>
    </div>
    <div class="bottomSection">
        <?php 
            $formProvider = new OneticktFormProvider($connectionString);
            echo $formProvider->createEditDetailsForm($video);
        ?>
    </div>
</div>