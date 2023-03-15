<?php 
require_once("../includes/config.php");   
require_once("../includes/classes/Video.php"); 
require_once("../includes/classes/User.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId =  $_POST["videoId"];

$userLoggedInObj = new User($connectionString, $username);
$video = new Video($connectionString, $videoId, $userLoggedInObj);

echo $video->like();
?>