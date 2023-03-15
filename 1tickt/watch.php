<?php 
require_once("includes/header.php"); 
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfoSection.php");
require_once("includes/classes/Comment.php");
require_once("includes/classes/CommentSection.php");

if(!isset($_GET["id"])) {
    echo "Url path not found";
    exit();
}

$video = new Video($connectionString, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>
<script src="assets/js/videoPlayerActions.js"></script>
<script src="assets/js/commentActions.js"></script>

<div class="watchLeftColumn">

    <?php 
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(true);

        $videoInfoSection = new VideoInfoSection($connectionString, $video, $userLoggedInObj);
        echo $videoInfoSection->create();

        $commentSection = new CommentSection($connectionString, $video, $userLoggedInObj);
        echo $commentSection->create();
    ?>

</div>

<div class="suggestions">
    <?php 
        $videoGrid = new VideoGrid($connectionString, $userLoggedInObj);
        echo $videoGrid->create(null, null, false);
    ?>
</div>

<?php require_once("includes/footer.php"); ?>