<?php 
class VideoUploadData {

    public $videoDataArray, $title, $description, $privacy, $category, $uploadedBy;

    public function __construct($videoDataArray, $title, $description, $privacy, $category, $uploadedBy) {
        $this->videoDataArray = $videoDataArray;
        $this->title = $title;
        $this->description = $description;
        $this->privacy = $privacy;
        $this->category = $category;
        $this->uploadedBy = $uploadedBy;    
    }

    public function updateDetails($connectionString, $videoId) {
        $query = $connectionString->prepare("UPDATE videos SET title=:title, description=:description, privacy=:privacy, category=:category WHERE id=:videoId");
        $query->bindParam(":title", $this->title);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":privacy", $this->privacy);
        $query->bindParam(":category", $this->category);
        $query->bindParam(":videoId", $videoId);
        
        return $query->execute();
    }

    // public function getVideoDataArray() {
    //     return $this->videoDataArray; 
    // }

    // public function getTitle() {
    //     return $this->title; 
    // }

    // public function getDescription() {
    //     return $this->description; 
    // }

    // public function getPrivacy() {
    //     return $this->privacy; 
    // }

    // public function getCategory() {
    //     return $this->category; 
    // }

    // public function getUploadedBy() {
    //     return $this->uploadedBy; 
    // }
    
    
}

?>