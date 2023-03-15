<?php 
require_once("includes/classes/VideoInfoControls.php");

class VideoInfoSection {

    private $connectionString, $video, $userLoggedInObj;

    public function __construct($connectionString, $video, $userLoggedInObj) {
        $this->connectionString = $connectionString;  
        $this->video = $video;  
        $this->userLoggedInObj = $userLoggedInObj;    
    }

    public function create() {
        // Append info sections and return them
        return $this->createPrimaryInfo() . $this->createSecondaryInfo();
    }

    private function createPrimaryInfo() {
        $title = $this->video->getTitle();
        $views = $this->video->getViews();

        $videoInfoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
        $controls = $videoInfoControls->create();

        return "<div class='videoInfo'>
                    <h1>$title</h1>
                    <div class='bottomSection'>
                        <span class='viewCount'>$views views</span>
                        $controls
                    </div>
                </div>";
    }

    private function createSecondaryInfo() {

        $description = $this->video->getDescription();
        $uploadDate = $this->video->getUploadDate();
        $uploadedBy = $this->video->getUploadedBy();
        $profileButton = ButtonProvider::createUserProfileButton($this->connectionString, $uploadedBy);

        if($uploadedBy == $this->userLoggedInObj->getUserName()) {
            $actionButton = ButtonProvider::createEditVideoButton($this->video->getId()); 
        }
        else {
            $userToObject = new User($this->connectionString, $uploadedBy);
            $actionButton = ButtonProvider::createSubscriberButton($this->connectionString, $userToObject, $this->userLoggedInObj);
        }

        return "<div class='secondaryInfo'>
                    <div class='topRow'>
                        $profileButton

                        <div class='uploadInfo'>
                            <span class='owner'>
                                <a href='profile.php?username=$uploadedBy'>$uploadedBy</a>
                            </span>
                            <span class='date'>Published on $uploadDate</span> 
                        </div>
                        $actionButton
                    </div>
                    <div class='descriptionContainer'>
                        Detail of video
                    </div>
                </div>";
    }
}

?>