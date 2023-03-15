<?php 
class SearchResultsProvider {

    private $connectionString, $userLoggedInObj;
    
    public function __construct($connectionString, $userLoggedInObj) {
        $this->connectionString = $connectionString;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos($term, $orderBy) {
        $query = $this->connectionString->prepare("SELECT * FROM videos 
                                                WHERE title LIKE CONCAT('%', :term, '%') 
                                                OR uploadedBy LIKE CONCAT('%', :term, '%') 
                                                ORDER BY $orderBy DESC");
        $query->bindParam(":term", $term);
        $query->execute();

        $videos = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->connectionString, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos;
    }
}

?>