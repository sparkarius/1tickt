<?php 
class LikedVideosProvider {

    private $connectionString, $userLoggedInObj;
    
    public function __construct($connectionString, $userLoggedInObj) {
        $this->connectionString = $connectionString;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();

        $query = $this->connectionString->prepare("SELECT videoId FROM likes 
                                                WHERE username=:username AND commentId=0 ORDER BY id DESC");
        $query->bindParam(":username", $username);
        $username = $this->userLoggedInObj->getUsername();
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->connectionString, $row["videoId"], $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos; 
    }
}
?>