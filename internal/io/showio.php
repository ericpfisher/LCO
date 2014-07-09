<?php

include_once '../db.inc.php';
include_once '../functions.php';

function showio($db) {
	$sql = "SELECT inc, user, inorout, tech, needpws, notes FROM IO WHERE active='1'";

	$stmt = $db->query($sql);
	$io_posts = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$io_posts[] = $row;
	}

	$stmt->closeCursor();

	echo json_encode($io_posts, JSON_NUMERIC_CHECK);
}

$db = new PDO(DB_INFO, DB_USER, DB_PASS);
showio($db);
?>