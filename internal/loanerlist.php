<?php

function loanerList($db, $kind) {
    $sql = "SELECT asset_tag, kind FROM Loaners WHERE checked_in=1 AND kind='$kind' ORDER BY asset_tag ASC";
    
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
$kind = $_POST['kind'];

loanerList($db, $kind);

?>