<?php
define("SERVER", "localhost"); // gator4155.hostgator.com
define("DB_NAME", "admintom_nsmart_companies");
define("DB_USER", "admintom_admin");
define("DB_PASSWORD", "SmarTrac1$!");

#CLASS TO HANDLE DATABASE
class database_handler {

	public $mysqli;


	function connect() {
		$mysqli = new mysqli(SERVER, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		return $mysqli;
	}


	/************** FUNCTION *************/


	function executeQuery($sql){

		$mysqli = new mysqli(SERVER, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		return $mysqli->real_query($sql);
	}

	function updateQuery($params, $tblname, $id, $columnname) {

		$mysqli = new mysqli(SERVER, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		// loop and build the column
	    $sets = array();

	    foreach($params as $column => $value) {
	         $sets[] = "`".$column."` = '".$mysqli->real_escape_string($value)."'";
	    }

		$sql = "UPDATE ".$tblname." SET ";
	    $sql .= implode(', ', $sets);
		$sql .= " WHERE ".$columnname." = '".$id."'";

		if (!$mysqli->real_query($sql)) {
		    printf("Error message: %s\n", $mysqli->error);
		    exit();
		}

	    // run and return the query result resource
	    return $mysqli->real_query($sql);
	}

	function insertQuery($params, $tblname) {

		$mysqli = new mysqli(SERVER, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		// retrieve the keys of the array (column titles)
	    $fields = array_keys($params);

	    // build the query
	    $sql = "INSERT INTO ".$tblname."(`".implode('`,`', $fields)."`) VALUES ('".implode("','", $params)."')";
		$insert = $mysqli->real_query($sql);

		if (!$insert) {
		    printf("Error message: %s\n", $mysqli->error);
		    exit();
		} else {
			$result['response'] 	= $insert;
			$result['inserted_id'] 	= $mysqli->insert_id;
		}

	    // run and return the query result resource
	    return $result; //$mysqli->real_query($sql);
	}

	function fetchAll($sql) {

		$mysqli = new mysqli(SERVER, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		$mysqli->real_query($sql);
		$result = $mysqli->store_result();
		//$rows = $result->fetch_all(MYSQLI_ASSOC);

		$rows = array();

		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row);
		}

		return $rows;
	}

	function fetchRow($sql) {

		$mysqli = new mysqli(SERVER, DB_USER, DB_PASSWORD, DB_NAME);

		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		$mysqli->real_query($sql);
		$result = $mysqli->store_result();
		$row = $result->fetch_assoc();

		return $row;
	}

	/************** FUNCTION END *************/

}//END OF THE CLASS
?>
