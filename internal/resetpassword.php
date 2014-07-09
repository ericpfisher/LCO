<?php

function resetPassword($db, $username){
    $sql = "UPDATE Techs SET password=SHA1('password') WHERE username='$username'";
    
    $stmt = $db->prepare($sql);
    $success = $stmt->execute();
    dbErrorOrClose($stmt, $success);
    
    echo 'success';
}

include_once 'db.inc.php';
include_once 'functions.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$username = $_POST['username'];

resetPassword($db, $username);

?>