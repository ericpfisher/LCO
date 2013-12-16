<?php

include_once 'db.inc.php';
include_once 'functions.php';

$sql = "DELETE FROM Entries WHERE NOT DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= checked_out";

$db = new PDO(DB_INFO, DB_USER, DB_PASS);

$stmt = $db->prepare($sql);
$result = $stmt->execute();

dbErrorOrClose($stmt, $result);

?>

