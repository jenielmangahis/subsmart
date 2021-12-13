<?php

include('Common.php');

// Setup the request
$request = new Request();
$request->setSoftwareName('SoftwareName');
$request->setSoftwareVersion('SoftwareVersion');
$request->setTerminalID($_REQUEST['TERMINALID']);
$request->setTransactionKey($_REQUEST['TRANSACTIONKEY']);

// Setup the request detail
$request->setRequestType(RequestType_Query);
$request->setSubType(SubType_QueryFraudState);
$request->setCardEaseReference('B7BBB119-B1BA-DB11-BB19-00065B3E6C8D');

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
