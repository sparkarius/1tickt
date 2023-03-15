<?php 
require_once("includes/classes/ProfileData.php");

class ProfileGenerator {

    private $connectionString, $userLoggedInObj, $profileData;

    public function __construct($connectionString, $userLoggedInObj, $profileUsername) {
        $this->connectionString = $connectionString;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($connectionString, $profileUsername);
    }

    public function create() {
        $profileUsername = $this->profileData->getProfileUsername();

        if(!$this->profileData->userExists()) {
            return "User does not exists";
        }

        $coverPhotoSection = $this->createCoverPhotoSection();
        $headerSection = $this->createHeaderSection();
        $tabsSection = $this->createTabsSection();
        $contentSection = $this->createContentSection();

        return "<div class='profileContainer'>
                    $coverPhotoSection
                    $headerSection
                    $tabsSection
                    $contentSection
                </div>";
    }

    public function createCoverPhotoSection() {
        $coverPhotoSrc = $this->profileData->getCoverPhoto();
        $name = $this->profileData->getProfileUserFullName();
        return "<div class='coverPhotoContainer'>
                    <img src='$coverPhotoSrc' class='coverPhoto'>
                    <span class='channelName'>$name</span>
                </div>";
    }

    public function createHeaderSection() {
        $profileImage = $this->profileData->getProfilePic();
        $name = $this->profileData->getProfileUserFullName();
        $subCount = $this->profileData->getSubscriberCount();

        $button = $this->createHeaderButton();

        return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img src='$profileImage' class='profileImage'>
                        <div class='userInfo'>
                            <span class='title'>$name</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                        </div>
                    </div>
                    <div class='buttonContainer'>
                        <div class='buttonItem'>$button</div>
                    </div>
                </div>";
    }

    public function createTabsSection() {
        return "<ul class='nav nav-tabs' id='myTab' role='tablist'>
                    <li class='nav-item' role='presentation'>
                        <button class='nav-link active' id='videos' data-bs-toggle='tab' data-bs-target='#videos-pane' type='button' 
                        role='tab' aria-controls='videos-pane' aria-selected='true'>VIDEOS</button>
                    </li>
                    <li class='nav-item' role='presentation'>
                        <button class='nav-link' id='about' data-bs-toggle='tab' data-bs-target='#about-pane' type='button' 
                        role='tab' aria-controls='about-pane' aria-selected='false'>ABOUT</button>
                    </li>
                </ul>";
    }

    public function createContentSection() {
        $videos = $this->profileData->getUsersVideos();

        if(sizeof($videos) > 0) {
            $videoGrid = new VideoGrid($this->connectionString, $this->userLoggedInObj);
            $videoGridHtml = $videoGrid->create($videos, null, false);
        }
        else {
            $videoGridHtml = "<span>This user has no videos</span>";
        }

        $aboutSection = $this->createAboutSection();
        

        return "<div class='tab-content channelContent'>
                    <div class='tab-pane fade show active' id='videos-pane' role='tabpanel' aria-labelledby='videos' tabindex='0'>
                        $videoGridHtml
                    </div>
                    <div class='tab-pane fade' id='about-pane' role='tabpanel' aria-labelledby='about' tabindex='0'>
                        $aboutSection
                    </div>
                </div>";
    }

    private function createHeaderButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        }
        else {
            return ButtonProvider::createSubscriberButton($this->connectionString, 
                        $this->profileData->getProfileUserObj(), $this->userLoggedInObj);
        }
    }

    private function createAboutSection() {
        $html = "<div class='section'>
                    <div class='title'>
                        <span>Details</span>
                    </div>
                    <div class='values'>";
        $details = $this->profileData->getAllUserDetails();
        foreach($details as $key => $value) {
            $html .= "<span>$key: $value</span>";
        }

        $html .= "</div></div>";

        return $html;
    }
}

?>