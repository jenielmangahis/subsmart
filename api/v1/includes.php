<?php
error_reporting(E_ERROR | E_PARSE);
include_once("includes/connection.inc.php");
include_once("includes/database.class.php");

define("SERVER", "gator4155.hostgator.com");
define("DB_NAME", "admintom_nsmart_companies");
define("DB_USER", "admintom_admin");
define("DB_PASSWORD", "SmarTrac1$!");

$connection = mysqli_connect(SERVER, DB_USER, DB_PASSWORD, DB_NAME);



// get insert query
function getInsertQuery($params, $tblname) {
	// retrieve the keys of the array (column titles)
	$fields = array_keys($params);

	// build the query
	$sql = "INSERT INTO ".$tblname."(`".implode('`,`', $fields)."`) VALUES('".implode("','", $params)."')";

	// return the query string
	return $sql;
}

?>
