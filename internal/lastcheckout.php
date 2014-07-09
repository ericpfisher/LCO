<?php

function lastcheckout($db, $asset_tag) {

    $get_co_sql = "SELECT MAX(id) FROM Entries WHERE asset_tag='$asset_tag'";

	$id_obj = $db->prepare($get_co_sql);
	$id_obj->execute();
	$id_wrap = $id_obj->fetch(PDO::FETCH_BOTH);
    $id = $id_wrap[0];
	$id_obj->closeCursor();
    
    $co_sql = "SELECT checked_out, first_name, last_name, user_ext, desk, floor, tech_out FROM Entries WHERE id='$id'";
    $stmt = $db->prepare($co_sql);
    $stmt->execute();
    $co_deets = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    echo json_encode($co_deets, JSON_NUMERIC_CHECK);
}

include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$asset_tag = (isset($_POST['asset_tag'])) ? $_POST['asset_tag'] : "99999";

lastcheckout($db, $asset_tag);

?>