<?php

function loanerCount($db, $kind) {
	$avail_sql = "SELECT asset_tag, serial_num, os_version, issues FROM Loaners WHERE kind='$kind' AND checked_in=1";
	$checked_sql = "SELECT asset_tag, serial_num, os_version, issues FROM Loaners WHERE kind='$kind' AND checked_in=0";

	$avail_obj = $db->query($avail_sql);
	$avail_count = array();
    while($row = $avail_obj->fetch(PDO::FETCH_ASSOC)) {
        $avail_count[] = $row;
    }
    
	$avail_obj->closeCursor();

	$checked_obj = $db->query($checked_sql);
	$checked_count = array();
    while($row = $checked_obj->fetch(PDO::FETCH_ASSOC)){
        $checked_count[] = $row;
    }
	$checked_obj->closeCursor();

	$json = array("avail" => $avail_count, "checked" => $checked_count);
    
    echo (json_encode($json, JSON_NUMERIC_CHECK));
}

include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$kind = (isset($_POST['kind'])) ? $_POST['kind'] : NULL;

loanerCount($db, $kind);

?>