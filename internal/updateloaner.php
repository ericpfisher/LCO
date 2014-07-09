<?php

function updateLoaner($db, $kind, $asset_tag, $serial_num, $os_version, $issues, $original_tag=NULL) {
    $check_sql = "SELECT id FROM Loaners WHERE asset_tag='$original_tag'";
    $check_stmt = $db->query($check_sql);
    $loaner_exists = $check_stmt->fetch(PDO::FETCH_ASSOC);
    $check_stmt->closeCursor();
    
    $id = $loaner_exists['id'];

    $sql = NULL;
    if($id) {
        $sql = "UPDATE Loaners SET kind='$kind', os_version='$os_version', serial_num='$serial_num', issues='$issues', asset_tag='$asset_tag' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO Loaners (kind, asset_tag, serial_num, os_version, issues, checked_in) VALUES ('$kind', '$asset_tag', '$serial_num', '$os_version', '$issues', 1)";
    }
    
    $stmt = $db->prepare($sql);
    $success = $stmt->execute();
    dbErrorOrClose($stmt, $success);
    
    echo 'success';
    
}
include_once 'functions.php';
include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$kind = $_POST['kind'];
$asset_tag = $_POST['asset_tag'];
$serial_num = $_POST['serial_num'];
$os_version = $_POST['os_version'];
$issues = $_POST['issues'];
$original_tag = (isset($_POST['original_tag'])) ? $_POST['original_tag'] : NULL;

updateLoaner($db, $kind, $asset_tag, $serial_num, $os_version, $issues, $original_tag);

?>