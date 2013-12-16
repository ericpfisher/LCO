<?php
include_once 'functions.php';

function checkout($db, $first_name, $last_name, $user_ext, $floor, $desk, $asset_tag, $tech_out) {
    
	$sql = "INSERT INTO Entries (first_name, last_name, user_ext, floor, desk, asset_tag, tech_out)
			values ('$first_name', '$last_name', '$user_ext', '$floor', '$desk', '$asset_tag', '$tech_out')";
			
	$stmt = $db->prepare($sql);
	$query1 = $stmt->execute();
	
	dbErrorOrClose($stmt, $query1);

	$sql2 = "UPDATE Loaners SET checked_in=0 WHERE asset_tag='$asset_tag'";

	$stmt2 = $db->prepare($sql2);
	$query2 = $stmt2->execute();

	dbErrorOrClose($stmt2, $query2);
	
	$get_id_sql = "SELECT LAST_INSERT_ID() FROM Entries LIMIT 1";

	$id_obj = $db->prepare($get_id_sql);
	$query3 = $id_obj->execute();

	if(!$query3) { // did not use Error Or Close so I can fetch the ID before closing. 
	   die("Database error: " . print_r($id_obj->errorInfo()));
	} else {
        $id = $id_obj->fetch();
        $id_obj->closeCursor();
    }
	
    $time_sql = "UPDATE Entries SET checked_out=NOW() WHERE ID=?";
	
    $time_stmt = $db->prepare($time_sql);
    $query4 = $time_stmt->execute(array($id[0]));
	
    dbErrorOrClose($time_stmt, $query4);

    echo 'success';
}
    
include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : "Place";
$last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : "Holder";
$user_ext = (isset($_POST['user_ext'])) ? $_POST['user_ext'] : "9999";
$floor = (isset($_POST['floor'])) ? $_POST['floor'] : "33";
$desk = (isset($_POST['desk'])) ? $_POST['desk'] : "999";
$asset_tag = (isset($_POST['asset_tag'])) ? $_POST['asset_tag'] : "99999";
$tech_out = (isset($_POST['tech_out'])) ? $_POST['tech_out'] : "placeholder";

checkout($db, $first_name, $last_name, $user_ext, $floor, $desk, $asset_tag, $tech_out);

?>