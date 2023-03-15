<?php 
class TrendingProvider {

    private $connectionString, $userLoggedInObj;
    
    public function __construct($connectionString, $userLoggedInObj) {
        $this->connectionString = $connectionString;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();

        $query = $this->connectionString->prepare("SELECT * FROM videos 
                                                WHERE uploadDate >= now() - INTERVAL 7 DAY 
                                                ORDER BY views DESC LIMIT 15");
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->connectionString, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos; 
    }
}
?>