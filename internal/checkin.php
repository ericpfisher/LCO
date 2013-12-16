<?php
include_once 'functions.php';

function checkin($db, $asset_tag) {
	$sql = "UPDATE Loaners SET checked_in=1 WHERE asset_tag='$asset_tag'";

	$stmt = $db->prepare($sql);
	$stmt->execute();

	$stmt->closeCursor();
// -------------------------------------------- END CHANGE CHECKED IN STATUS
	$get_co_sql = "SELECT MAX(id) FROM Entries WHERE asset_tag='$asset_tag'";

	$id_obj = $db->prepare($get_co_sql);
	$id_obj->execute();
	$id_wrap = $id_obj->fetch(PDO::FETCH_BOTH);

	$id = $id_wrap[0];

	$id_obj->closeCursor();

// -------------------------------------------- END GET ID OF LATEST CHECKOUT BY ASSET TAG	
	$time_sql = "UPDATE Entries SET checked_in=NOW(), tech_in='$tech_in' WHERE id='$id'";
	
	$time_stmt = $db->prepare($time_sql);
	$time_stmt->execute();
	
	$time_stmt->closeCursor();
// -------------------------------------------- END UPDATE CHECKED IN TIMESTAMP

    echo "success";
}

include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$asset_tag = (isset($_POST['asset_tag'])) ? $_POST['asset_tag'] : "99999";
$tech_in = (isset($_POST['tech_in'])) ? $_POST['tech_in'] : "placeholder";

checkin($db, $asset_tag, $tech_in);
?>