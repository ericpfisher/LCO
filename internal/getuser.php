<?php

function getUser($db, $username) {
    if($username) {
        $get_user_sql = "SELECT first, last, isadmin FROM techs WHERE username='$username'";
        
        $stmt = $db->query($get_user_sql);
        $user_details = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        echo json_encode($user_details, JSON_NUMERIC_CHECK);
    } else {
        echo "failure";
    }
}

include_once "db.inc.php";
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$username = (isset($_POST['username'])) ? $_POST['username'] : null;
getUser($db, $username);

?>