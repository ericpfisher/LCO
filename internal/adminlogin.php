<?php

include_once 'db.inc.php';
    
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
    
$sql = "SELECT COUNT(*) AS num_users
		FROM Techs
		WHERE username=?
		AND password=SHA1(?)
        AND isadmin='1'";
    
$stmt = $db->prepare($sql);
$stmt->execute(array($_POST['username'], $_POST['password']));

$response = $stmt->fetch();

if($response['num_users'] > 0){
    
    $active_user = $_POST['username'];
} else {
    $active_user = NULL;
}

echo json_encode($active_user);

?>