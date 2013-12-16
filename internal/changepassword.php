<?php

function changePassword($db, $username, $oldpw, $newpw){
	$sql = "SELECT COUNT(*) AS found_user
			FROM Techs 
			WHERE username=? 
			AND password=SHA1(?)";

	$check_stmt = $db->prepare($sql);
	$check_stmt->execute(array($username, $oldpw));
	$result = $check_stmt->fetch();

	if($result['found_user'] > 0){
		$check_stmt->closeCursor();

		$chg_pw_sql = "UPDATE Techs SET password=SHA1('$newpw') WHERE username='$username'";

		$chg_stmt = $db->prepare($chg_pw_sql);
		$chg_stmt->execute();

		$chg_stmt->closeCursor();

		echo 'success';
		exit;
	} else {
		dbErrorOrClose($check_stmt, $result);
		echo 'wrongold';
		exit;
	}
}

include_once 'db.inc.php';
include_once 'functions.php';

$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$username = $_POST['username'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];

changePassword($db, $username, $oldpw, $newpw);

?>

