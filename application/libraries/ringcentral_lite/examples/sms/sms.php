<?php

/**
 * To use this demo, use the `ENV_PATH` environment variable
 * to point to your .env file.
 */

require_once(__DIR__ . '/../../src/dotenv.php');
require_once(__DIR__ . '/../../src/ringcentrallite.php');

//loadDotEnv($_ENV['ENV_PATH']);

$rc = new RingCentralLite(
    'yyGrSZo1SUaLHrh5VM-6Pw', //Client id
    'JMU-sm7HQAKU60lEo6Zq9Qe2GFqhEQRVWXTDItUjqlNA', //Client secret
    'https://platform.devtest.ringcentral.com'); //server url
 
$res = $rc->authorize(
    '+13233646599', //username
    '101', //extension
    's@634DFhy&*)2bNy'); //password

$params = array(
    'json'     => array(
        'to'   => array( array('phoneNumber' => '+13233646599') ), //Send to
        'from' => array('phoneNumber' => '+13233646599'), //Username
        'text' => 'This is a sample sent message using ring central api'
    )
);
$res = $rc->post('/restapi/v1.0/account/~/extension/~/sms', $params);
echo "<pre>";
print_r($res);

echo "DONE\n";

?>