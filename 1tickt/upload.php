<?php require_once("includes/header.php"); ?>
<?php require_once("includes/classes/oneticktFormProvider.php"); ?>

<div class="column">
    <?php 
        $formProvider = new oneticktFormProvider();
        echo $formProvider->createUploadForm();
    ?>
</div>

<?php require_once("includes/footer.php"); ?>