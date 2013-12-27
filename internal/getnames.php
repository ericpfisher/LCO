<?php //getnames.php

include_once 'db.inc.php';
include_once 'functions.php';

function getFirstNames($db) {
	$sql = "SELECT username, first FROM Techs";

	$stmt = $db->query($sql);
	$techfirsts = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$techfirsts[] = $row;
	}
	$stmt->closeCursor();

	echo json_encode($techfirsts);
}

$db = new PDO(DB_INFO, DB_USER, DB_PASS);
getFirstNames($db);

?>