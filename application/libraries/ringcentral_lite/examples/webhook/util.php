<?php

/**
 * To use this demo, copy rc-credentials-sample.json
 * to .rc-credentials.json and populate with your actual
 * credentials
 *
 * To run a local server, use php -S localhost:8000
 * http://php.net/manual/en/features.commandline.webserver.php
 */

require_once(__DIR__ . '/../../src/ringcentrallite.php');

function getRingCentralClient() {
    $credentials = json_decode(file_get_contents(__DIR__ . '/.rc-credentials.json'), true);
    $client = new RingCentralLite(
        $credentials['clientID'],
        $credentials['clientSecret'],
        $credentials['serverURL']);

    $authResponse = $client->authorize(
        $credentials['username'],
        $credentials['extension'],
        $credentials['password']);
    return array($credentials, $client, $authResponse);
}

function logJSON($data) {
    file_put_contents('php://stderr', json_encode($data, TRUE));
}

function logString($data) {
    file_put_contents('php://stderr', $data);
}

?>