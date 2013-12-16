<?php

include_once 'db.inc.php';
    
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
    
$sql = "SELECT isadmin
		FROM Techs
		WHERE username=?
		AND password=SHA1(?)";
    
$stmt = $db->prepare($sql);
$stmt->execute(array($_POST['username'], $_POST['password']));

$response = $stmt->fetch(PDO::FETCH_ASSOC);

if($response['isadmin'] == '0'){    
    $isadmin = "no";
} elseif ($response['isadmin']=='1') {
	$isadmin = "yes";
} else {
    $active_user = NULL;
}

echo json_encode($isadmin);
exit;
?>