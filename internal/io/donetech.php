<?php

function doneTech($db, $inc, $donetech) {
	$sql = "UPDATE IO SET donetech='$donetech', active='0' WHERE inc='$inc'";

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$stmt->closeCursor();
	echo 'success';
}

include_once '../db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$inc = $_POST['inc'];
$donetech = $_POST['donetech'];
doneTech($db, $inc, $donetech);

?>