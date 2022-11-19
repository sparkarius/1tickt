<?php
class oneticktFormProvider {
    
    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        return "<form action='processing.php' method='POST'>
            $fileInput
            $titleInput
            $descriptionInput
            $privacyInput
        </form>";
    }

    private function createFileInput() {
        return "<div class='row mb-3'><div class='col'>
                    <input type='file' class='form-control-file' id='label1' name='fileInput' required>
                </div></div>";
    }

    private function createTitleInput() {
        return "<div class='row mb-3'><div class='col'>
                    <input class='form-control' type='text' placeholder='Title' name='titleInput'>
                </div></div>";
    }

    private function createDescriptionInput() {
        return "<div class='row mb-3'><div class='col'>
                    <textArea class='form-control' placeholder='Description' descriptionInput='titleInput' rows='3'></textArea>
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
}

?>