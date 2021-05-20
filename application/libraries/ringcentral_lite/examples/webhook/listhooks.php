<?php

/**
 * To use this demo, copy rc-credentials-sample.json
 * to .rc-credentials.json and populate with your actual
 * credentials
 *
 * To run a local server, use php -S localhost:8000
 * http://php.net/manual/en/features.commandline.webserver.php
 */

require_once(__DIR__ . '/util.php');

$clientInfo   = getRingCentralClient();
$credentials  = $clientInfo[0];
$client       = $clientInfo[1];
$authResponse = $clientInfo[2];

if (array_key_exists('error', $authResponse)) {
	header("Content-Type: application/json");
	echo json_encode($authResponse, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
} else {
	$info = $client->get('subscription', array());

	header("Content-Type: application/json");

	echo json_encode($info, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
}

?>