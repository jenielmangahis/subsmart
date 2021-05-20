<?php

/**
 * To use this demo, copy rc-credentials-sample.json
 * to .rc-credentials.json and populate with your actual
 * credentials
 *
 * To run a local server, use php -S localhost:8000
 * http://php.net/manual/en/features.commandline.webserver.php
 */

const SMS_FILTER_INSTANT  = '/restapi/v1.0/account/~/extension/~/message-store/instant?type=SMS';
const RENEWAL_FILTER_PROD = '/restapi/v1.0/subscription/~?threshold=86400&interval=3600';
const RENEWAL_FILTER_TEST = '/restapi/v1.0/subscription/~?threshold=80&interval=30';

require_once(__DIR__ . '/util.php');

$clientInfo   = getRingCentralClient();
$credentials  = $clientInfo[0];
$client       = $clientInfo[1];
$authResponse = $clientInfo[2];

if (array_key_exists('error', $authResponse)) {
    header("Content-Type: application/json");
    echo json_encode($authResponse, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
} else {
    createWebhook($credentials, $client);
}

function createWebhook($credentials, $client) {
    session_start();
    $renewalFilter = RENEWAL_FILTER_TEST;
    $_SESSION['renewal_filter'] = $renewalFilter;
    $body = array(
        'eventFilters' => array(
            SMS_FILTER_INSTANT,
            $renewalFilter
        ),
        'deliveryMode'      => array(
            'transportType' => 'WebHook',
            'address'       => $credentials['webhookURL']
        )
    );
    file_put_contents('php://stderr', $renewalFilter);
    logJSON($body);

    $info = $client->post('subscription', array('json' => $body));

    $_SESSION['subscription_id'] = $info['id'];

    header('Content-Type: application/json');

    echo json_encode($info, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    logJSON($info);
}

?>