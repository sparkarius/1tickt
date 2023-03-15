<?php
class OneticktFormProvider {

    private $connectionString;

    public function __construct($connectionString) {
        $this->connectionString = $connectionString;
    }

    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput(null);
        $descriptionInput = $this->createDescriptionInput(null);
        $privacyInput = $this->createPrivacyInput(null);
        $categoriesInput = $this->createCategoriesInput(null);
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

    public function createEditDetailsForm($video) {  
        $titleInput = $this->createTitleInput($video->getTitle());
        $descriptionInput = $this->createDescriptionInput($video->getDescription());
        $privacyInput = $this->createPrivacyInput($video->getPrivacy());
        $categoryInput = $this->createCategoriesInput($video->getCategory());
        $saveButton = $this->createSaveButton();
        return "<form method='POST'>       
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $categoryInput
                    $saveButton
                </form>";
    }

    private function createFileInput() {

        return "<div class='row mb-3'><div class='col'>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
               </div></div>";
    }

    private function createTitleInput($value) {
        if($value == null) $value = "";
        return "<div class='row mb-3'><div class='col'>
                    <input class='form-control' type='text' placeholder='Title' name='titleInput' value='$value'>
               </div></div>";
    }

    private function createDescriptionInput($value) {
        if($value == null) $value = "";
        return "<div class='row mb-3'><div class='col'>
                    <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'>$value</textarea>
               </div></div>";
    }

    private function createPrivacyInput($value) {
        if($value == null) $value = "";

        $privateSelected = ($value == 0) ? "selected='selected'" : "";
        $publicSelected = ($value == 0) ? "selected='selected'" : "";
        return "<div class='row mb-3'><div class='col'>
                    <select class='form-control' name='privacyInput'>
                        <option value='0' $privateSelected>Private</option>
                        <option value='1' $publicSelected>Public</option>
                    </select>
               </div></div>";
    }

    private function createCategoriesInput($value) {
        if($value == null) $value = "";
        $query = $this->connectionString->prepare("SELECT * FROM categories");    
        $query->execute();
        
        $html = "<div class='row mb-3'><div class='col'>
                    <select class='form-control' name='categoryInput' value='$value'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $name = $row["name"];
            $selected = ($id == $value) ? "selected='selected'" : "";

            $html .= "<option $selected value='$id'>$name</option>";
        }
        
        $html .= "</select>
               </div></div>";

        return $html;

    }

    private function createUploadButton() {
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
    }

    private function createSaveButton() {
        return "<button type='submit' class='btn btn-primary' name='saveButton'>Save</button>";
    }
}
?>