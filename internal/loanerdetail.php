<?php
include_once 'db.inc.php';

function loanerdetail($db, $kind) {
    $sql = "SELECT asset_tag, serial_num, os_version, issues FROM Loaners WHERE kind=?";
	
    $stmt = $db->prepare($sql);
    $stmt->execute(array($kind));
	
    $json = NULL;

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $json = $row;
    }
    
    echo (json_encode($json, JSON_NUMERIC_CHECK));
}

$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$asset_tag = (isset($_POST['kind'])) ? $_POST['kind'] : NULL;
              
loanerdetail($db, $kind);
?>