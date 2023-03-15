<?php 
require_once("../includes/config.php");

if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {
    
    $userTo = $_POST['userTo'];
    $userFrom = $_POST['userFrom'];

    $query = $connectionString->prepare("SELECT * FROM subscribers WHERE userTo=:userTo and userFrom=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $userFrom);
    $query->execute();

    if($query->rowCount() == 0) {
        // insert if new sub
        $query = $connectionString->prepare("INSERT INTO subscribers(userTo, userFrom) 
                                                VALUES (:userTo, :userFrom)");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    }
    else {
        // delete if unsubbed
        $query = $connectionString->prepare("DELETE FROM subscribers WHERE userTo=:userTo and userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    }

    $query = $connectionString->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
    $query->bindParam(":userTo", $userTo);
    $query->execute();

    // Return new number of subs
    echo $query->rowCount();
}
else {
    echo "One of more parameters are not passed into the subscribe.php file";
}

?>