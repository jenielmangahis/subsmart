<?php

include('Common.php');

// Setup the request
$request = new Request();
$request->setSoftwareName('SoftwareName');
$request->setSoftwareVersion('SoftwareVersion');
$request->setTerminalID($_REQUEST['TERMINALID']);
$request->setTransactionKey($_REQUEST['TRANSACTIONKEY']);

// Setup the request detail
$request->setRequestType(RequestType_PreAuth);
$request->setAmount('123');
$request->setPAN('341111597241002');
$request->setExpiryDate('2012');

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
