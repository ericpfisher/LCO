<?php

function updateUser($db, $first, $last, $isadmin, $username, $password=NULL) {
    $check_sql = "SELECT COUNT(*) FROM Techs WHERE username='$username'";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->execute();
    $user_exists = $check_stmt->fetchColumn();
    $check_stmt->closeCursor();
    
    $sql = NULL;
    if($user_exists) {
        $sql = "UPDATE techs SET first='$first', last='$last', isadmin='$isadmin' WHERE username='$username'";
    } else {
        $sql = "INSERT INTO techs (first, last, username, password, isadmin) VALUES ('$first', '$last', '$username', SHA1('$password'), '$isadmin')";
    }
    
    $stmt = $db->prepare($sql);
    $success = $stmt->execute();
    dbErrorOrClose($stmt, $success);
    
    echo 'success';
    
}
include_once 'functions.php';
include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$first = $_POST['first'];
$last = $_POST['last'];
$username = $_POST['username'];
$password = (isset($_POST['password'])) ? $_POST['password'] : null;
$isadmin = $_POST['isadmin'];

updateUser($db, $first, $last, $isadmin, $username, $password);

?>