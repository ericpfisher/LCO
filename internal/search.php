<?php
function searchCheckouts($db, $search_params=NULL) {
	if(isset($search_params)):
	
		$params_array = explode(", ",$search_params);
	
	endif;

	for($i = 0; $i < count($params_array); $i++) {
		if($i==0 || $i==(count($params_array) - 1)) {
			$params_string = $params_array[$i];
		} else {
			$params_string = "|" . $params_array[$i] . "|";
		}
	}

	$sql = "SELECT * FROM Entries WHERE first_name REGEXP '$params_string'
			UNION
			SELECT * FROM Entries WHERE last_name REGEXP '$params_string'
			UNION
			SELECT * FROM Entries WHERE asset_tag REGEXP '$params_string'
			UNION
			SELECT * FROM Entries WHERE tech_out REGEXP '$params_string'
			UNION
			SELECT * FROM Entries WHERE tech_in REGEXP '$params_string'
			ORDER BY checked_out DESC";

	$stmt = $db->prepare($sql);
	$stmt->execute();

	$search_results = NULL;

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$search_results[] = $row;
	}

	$stmt->closeCursor();

	echo json_encode($search_results, JSON_NUMERIC_CHECK);

}

include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$search_params = (isset($_POST['search_params'])) ? $_POST['search_params'] : "";

searchCheckouts($db, $search_params);

?>