<?php 
require_once("includes/header.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$subscriptionsProvider =  new SubscriptionsProvider($connectionString, $userLoggedInObj);
$videos = $subscriptionsProvider->getVideos();

$videoGrid = new VideoGrid($connectionString, $userLoggedInObj);

?>

<div class="largeVideoGridContainer">
    <?php 
        if(sizeof($videos) > 0) {
            echo $videoGrid->createLarge($videos, "New from your subscriptions", false);
        }
        else {
            echo "No videos to show";
        }
    ?>
</div>