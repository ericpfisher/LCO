<?php

function userList($db) {
    $sql = "SELECT username, isadmin, first, last FROM techs";
    
    $stmt=$db->prepare($sql);
    $stmt->execute();
    $json = null;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $json[] = $row;
    }
    
    $stmt->closeCursor();
    
    echo (json_encode($json, JSON_NUMERIC_CHECK));
}

include 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);

userList($db);
?>