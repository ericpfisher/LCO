<?php // io.php

include_once '../db.inc.php';
include_once '../functions.php';

function getTech($db, $fullname) {
	$sql = "SELECT username FROM Techs WHERE CONCAT(first,' ',last)='$fullname'";

	$stmt = $db->query($sql);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	dbErrorOrClose($stmt, $result);

	return $result['username'];
}

function ioPost($db, $user, $inc, $inorout, $techid, $needpws, $notes) {
	$sql = "INSERT INTO IO (user, inc, inorout, tech, needpws, notes) VALUES ('$user','$inc', '$inorout', '$techid', '$needpws', '$notes')";

	$io_stmt = $db->prepare($sql);
	$result = $io_stmt->execute();
	dbErrorOrClose($io_stmt, $result);

	echo 'success';
}

$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$user = $_POST['user'];
$inc = $_POST['inc'];
$inorout = $_POST['inorout'];
$fullname = $_POST['tech'];
$needpws = $_POST['passwords'];
$notes = $_POST['notes'];
$techid = getTech($db, $fullname);
ioPost($db, $user, $inc, $inorout, $techid, $needpws, $notes);

?>