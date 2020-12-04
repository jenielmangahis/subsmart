<?php
include_once("includes.php");

$db = new database_handler();
$rows = $db->fetchAll("select * from users");

// response
$response = array("Status" => "success", "Code" => 200, "Message" => "Fetching data successful.", "Data" => $rows);

// return the header
header('Content-Type: application/json');
echo json_encode($response);
?>
