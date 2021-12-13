<?php

include('Common.php');

// Setup the request.
$request = new Request();
$request->setSoftwareName('SoftwareName');
$request->setSoftwareVersion('SoftwareVersion');
$request->setTerminalID($_REQUEST['TERMINALID']);
$request->setTransactionKey($_REQUEST['TRANSACTIONKEY']);

// Setup the request detail.
$request->setRequestType(RequestType_Auth);
$request->setAmount('123');
$request->setPAN('341111597241002');
$request->setExpiryDate('2012');

// Setup 3DS v2 parameters.
$request->setThreeDSecureDirectoryServerTransactionId('1a8de801-eb04-431c-936e-88e5d3379db2');
$request->setThreeDSecureServerTransactionId('f7681149-e400-4a93-8ba3-7cb154effb08');
$request->setThreeDSecureVersion('2');

$request->setThreeDSecureCardHolderEnrolled(ThreeDSecureCardHolderEnrolled_Yes);
$request->setThreeDSecureTransactionStatus(ThreeDSecureTransactionStatus_Successful);
$request->setThreeDSecureIAV('kAACCUWCFzQnGYVocoIXAAAAAAA=');
$request->setThreeDSecureIAVAlgorithm('123456789');
$request->setThreeDSecureECI('02');


echo '<p>'.$request->toString();

// Setup the client.
$client = new Client();
$client->addServerURL('https://test.cardeasexml.com/generic.cex', 45000);
$client->setRequest($request);
// Process the request
$client->processRequest();

// Get the response.
$response = $client->getResponse();
echo '<p>'.$response->toString();
?>
