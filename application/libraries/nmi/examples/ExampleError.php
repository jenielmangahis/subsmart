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
$request->setTrack2(';this is a bad track2?');

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

$errors = $response->getErrors();
if ($errors !== null) {
	foreach ($errors as $error) {
		echo '<p>String: '.$error->toString();
		echo '<br/>Code: '.$error->getCode();
		echo '<br/>Message: '.$error->getMessage();
	}
}
?>
