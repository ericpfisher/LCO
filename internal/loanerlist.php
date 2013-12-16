<?php

function loanerList($db) {
    $sql = "SELECT kind, asset_tag FROM Loaners WHERE checked_in=1";
    
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

loanerList($db);

?>