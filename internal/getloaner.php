<?php

function getLoaner($db, $asset_tag) {
    $sql = "SELECT kind, serial_num, os_version, issues FROM Loaners WHERE asset_tag='$asset_tag'";
    
    $stmt = $db->query($sql);
    $loaner_details = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    echo json_encode($loaner_details, JSON_NUMERIC_CHECK);
}

include_once "db.inc.php";
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$asset_tag = $_POST['asset_tag'];
getLoaner($db, $asset_tag);

?>