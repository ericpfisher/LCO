<?php

function deleteLoaner($db, $asset_tag) {
    $sql = "DELETE FROM Loaners WHERE asset_tag='$asset_tag'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $stmt->closeCursor();
    echo 'success';
}

include_once "db.inc.php";
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$asset_tag = $_POST['asset_tag'];

deleteLoaner($db, $asset_tag);

?>