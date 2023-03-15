<?php 
class SelectThumbnail {

    private $connectionString, $video;

    public function __construct($connectionString, $video) {
        $this->connectionString = $connectionString;
        $this->video = $video;
    }

    public function create() {
        $thumbnailData = $this->getThumbnailData();

        $html = "";

        foreach($thumbnailData as $data) {
            $html .= $this->createThumbnailItem($data);
        }

        return "<div class='thumbnailItemsContainer'>$html</div>";
    }

    private function getThumbnailData() {
        $data = array();

        $query = $this->connectionString->prepare("SELECT * from thumbnails WHERE videoId=:videoId");
        $query->bindParam(":videoId", $videoId);
        $videoId = $this->video->getId();

        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
            return $data;
        }
    }

    private function createThumbnailItem($data) {
        $id = $data["id"];
        $url = $data["filePath"];
        $videoId = $data["videoId"];
        $selected = $data["selected"] == 1 ? "selected" : "";

        return "<div class='thumbnailItem $selected' onclick='setNewThumbnail($id, $videoId, this)'>
                    <img src='$url'>
                </div>";
    }
}
?>