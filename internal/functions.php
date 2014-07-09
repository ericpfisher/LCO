<?php
function dbErrorOrClose($db_object, $query_result) {
	if(!$query_result) {
		die("Database error: " . print_r($db_object->errorInfo()));
	} else {
		$db_object->closeCursor();
	}
}

?>