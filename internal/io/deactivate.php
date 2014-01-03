<?php

function deactivatePost($db, $inc) {
	$sql = "UPDATE IO SET active='0' WHERE inc='$inc'";

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$stmt->closeCursor();
	echo 'success';
}

include_once '../db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$inc = $_POST['inc'];

deactivatePost($db, $inc);
?>