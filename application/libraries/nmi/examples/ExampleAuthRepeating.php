<?php

include('Common.php');

// Setup the request
$request = new Request();
$request->setSoftwareName('SoftwareName');
$request->setSoftwareVersion('SoftwareVersion');
$request->setTerminalID($_REQUEST['TERMINALID']);
$request->setTransactionKey($_REQUEST['TRANSACTIONKEY']);

// Setup the request detail
$request->setRequestType(RequestType_Auth);
$request->setAmount('123');
$request->setTrack2(';341111597241002=2012030948492?');

echo '<p>'.$request->toString();

// Setup the client
$client = new Client();
$client->addServerURL('https://test.cardeasexml.com/generic.cex', 45000);
$client->setRequest($request);

// Process the request
$client->processRequest();

// Get the response
$response = $client->getResponse();
echo '<p>'.$response->toString();

$cardHash = $response->getCardHash();
$cardReference = $response->getCardReference();

// Setup the request
$request = new Request();
$request->setSoftwareName('SoftwareName');
$request->setSoftwareVersion('SoftwareVersion');
$request->setTerminalID($_REQUEST['TERMINALID']);
$request->setTransactionKey($_REQUEST['TRANSACTIONKEY']);

// Setup the request detail
$request->setRequestType(RequestType_Auth);
$request->setAmount('123');
$request->setCardHash($cardHash);
$request->setCardReference($cardReference);

echo '<p>'.$request->toString();

// Setup the client
$client = new Client();
$client->addServerURL('https://test.cardeasexml.com/generic.cex', 45000);
$client->setRequest($request);

// Process the request
$client->processRequest();

// Get the response
$response = $client->getResponse();
echo '<p>'.$response->toString();
?>
