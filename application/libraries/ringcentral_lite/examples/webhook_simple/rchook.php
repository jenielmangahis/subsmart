<?php

$dt = gmdate('Y-m-d\TH:i:s\Z');
$logfile = '/var/tmp/rchook.log';

logString($logfile, $dt, 'RCHOOK_RECEIVED');

$v = isset($_SERVER['HTTP_VALIDATION_TOKEN']) ? $_SERVER['HTTP_VALIDATION_TOKEN'] : ‘’;
if (strlen($v) > 0) {
    header("Validation-Token: {$v}");
    logString($logfile, $dt, "RCHOOK_HEADER_VALIDATION_TOKEN [{$v}]");
} else {
    logString($logfile, $dt, 'RCHOOK_HEADER_NO_VALIDATION_TOKEN');
    $jsonBody = file_get_contents('php://input');
    logString($logfile, $dt, 'RCHOOK_BODY_JSON: ' . $jsonBody);
}

function logString($logfile, $dt, $data) {
    error_log($dt . ' ' . $data . "\n", 3, $logfile);
}

echo 'RCHOOK';

?>