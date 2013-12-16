<?php

function deleteUser($db, $username) {
    $sql = "DELETE FROM Techs WHERE username='$username'";
    
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
    echo 'success';
}

include_once "db.inc.php";
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$username = $_POST['username'];

deleteUser($db, $username);

?>