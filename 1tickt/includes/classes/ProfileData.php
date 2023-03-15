<?php 
class ProfileData {

    private $connectionString, $profileUserObj;

    public function __construct($connectionString, $profileUsername) {
        $this->connectionString = $connectionString;
        $this->profileUserObj = new User($connectionString, $profileUsername);
    }

    public function getProfileUsername() {
        return $this->profileUserObj->getUsername();
    }

    public function userExists() {
        $query = $this->connectionString->prepare("SELECT * from users WHERE username=:username");
        $query->bindParam(":username", $profileUsername);
        $profileUsername = $this->getProfileUsername();
        $query->execute();

        return $query->rowCount() != 0;
    }

    public function getCoverPhoto() {
        return "assets/images/coverPhotos/default-cover-photo.jpg";
    }

    public function getProfileUserFullName() {
        return $this->profileUserObj->getName();
    }

    public function getProfilePic() {
        return $this->profileUserObj->getProfilePic();
    }

    public function getSubscriberCount() {
        return $this->profileUserObj->getSubscriberCount();
    }

    public function getProfileUserObj() {
        return $this->profileUserObj;
    }

    public function getUsersVideos() {
        $query = $this->connectionString->prepare("SELECT * FROM videos WHERE 
                                                    uploadedBy=:uploadedBy ORDER BY uploadDate DESC");
        $query->bindParam(":uploadedBy", $username);
        $username = $this->getProfileUsername();
        $query->execute();

        $videos = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $videos[] = new Video($this->connectionString, $row, $this->profileUserObj->getUsername());
        }

        return $videos;
    }

    public function getAllUserDetails() {
        return array(
            "Name" => $this->getProfileUserFullName(),
            "Username" => $this->getProfileUsername(),
            "Subscribers" => $this->getSubscriberCount(),
            "Total views" => $this->getTotalViews(),
            "Date joined" => $this->getSignUpDate()
        );
    }


    private function getTotalViews() {
        $query = $this->connectionString->prepare("SELECT sum(views) FROM videos WHERE uploadedBy=:uploadedBy");
        $query->bindParam(":uploadedBy", $username);
        $username = $this->getProfileUsername();
        $query->execute();

        return $query->fetchColumn();
    }

    private function getSignUpDate() {
        $date = $this->profileUserObj->getSignUpDate();

        return date("F j, Y", strtotime($date));
    }

}
?>