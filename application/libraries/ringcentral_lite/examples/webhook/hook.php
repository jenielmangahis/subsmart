<?php

/**
 * To use this demo, copy rc-credentials-sample.json
 * to .rc-credentials.json and populate with your actual
 * credentials
 *
 * To run a local server, use php -S localhost:8000
 * http://php.net/manual/en/features.commandline.webserver.php
 */

const RENEWAL_FILTER_PROD = '/restapi/v1.0/subscription/~?threshold=86400&interval=3600';
const RENEWAL_FILTER_TEST = '/restapi/v1.0/subscription/~?threshold=80&interval=30';

if (array_key_exists('HTTP_VALIDATION_TOKEN', $_SERVER)) {
    file_put_contents('php://stderr', 'Got Validation-Token ' + $_SERVER['HTTP_VALIDATION_TOKEN']);
    header("Validation-Token: {$_SERVER['HTTP_VALIDATION_TOKEN']}");
} else {
    session_start();
    require_once(__DIR__ . '/util.php');
    logString('Message (n Validation-Token)');

    $jsonBody = file_get_contents('php://input');
    logString('JSON Body ' + $jsonBody);

    $body = json_decode($jsonBody, TRUE);
    if (array_key_exists('renewal_filter', $_SESSION)) {
        $filter = $_SESSION['renewal_filter'];
        if ($body['event'] == $filter) {
            renewWebhook();
        } else {
            logJSON($jsonBody);
        }
    } else {
        logJSON($jsonBody);
    }
}

function renewWebhook() {
    $clientInfo   = getRingCentralClient();
    $client       = $clientInfo[1];

    $info = $client->post("subscription/{$_SESSION['subscription_id']}/renew", array());

    header('Content-Type: application/json');
    echo $info;
    logJSON($info);
}

?>