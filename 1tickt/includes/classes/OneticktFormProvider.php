<?php
class OneticktFormProvider {

    private $connectionString;

    public function __construct($connectionString) {
        $this->connectionString = $connectionString;
    }

    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        $categoriesInput = $this->createCategoriesInput();
        $uploadButton = $this->createUploadButton();
        return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoriesInput
                    $uploadButton
                </form>";
    }

    private function createFileInput() {

        return "<div class='row mb-3'><div class='col'>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
               </div></div>";
    }

    private function createTitleInput() {
        return "<div class='row mb-3'><div class='col'>
                    <input class='form-control' type='text' placeholder='Title' name='titleInput'>
               </div></div>";
    }

    private function createDescriptionInput() {
        return "<div class='row mb-3'><div class='col'>
                    <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'></textarea>
               </div></div>";
    }

    private function createPrivacyInput() {
        return "<div class='row mb-3'><div class='col'>
                    <select class='form-control' name='privacyInput'>
                        <option value='0'>Private</option>
                        <option value='1'>Public</option>
                    </select>
               </div></div>";
    }

    private function createCategoriesInput() {
        $query = $this->connectionString->prepare("SELECT * FROM categories");    
        $query->execute();
        
        $html = "<div class='row mb-3'><div class='col'>
                    <select class='form-control' name='categoryInput'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $name = $row["name"];

            $html .= "<option value='$id'>$name</option>";
        }
        
        $html .= "</select>
               </div></div>";

        return $html;

    }

    private function createUploadButton() {
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
    }
}
?>