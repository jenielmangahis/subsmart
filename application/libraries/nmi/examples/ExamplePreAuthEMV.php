<?php

include('Common.php');

// Setup the request.
$request = new Request();
$request->setSoftwareName('SoftwareName');
$request->setSoftwareVersion('SoftwareVersion');
$request->setTerminalID($_REQUEST['TERMINALID']);
$request->setTransactionKey($_REQUEST['TRANSACTIONKEY']);

// Setup the request detail.
$request->setRequestType(RequestType_PreAuth);
$request->setAmount('123');
$request->addICCTag(new ICCTag('0x57', '5413330089000013D2012201087490938F'));
$request->addICCTag(new ICCTag('0x5a', '5413330089000013'));
$request->addICCTag(new ICCTag('0x5f24', '201231'));
$request->addICCTag(new ICCTag('0x5f34', '00'));
$request->addICCTag(new ICCTag('0x9f02', '000000000123'));
$request->addICCTag(new ICCTag('0x9f03', '000000000000'));
$request->addICCTag(new ICCTag('0x9f26', '095BDFF410C27326'));
$request->addICCTag(new ICCTag('0x82', '1800'));
$request->addICCTag(new ICCTag('0x9f36', '0003'));
$request->addICCTag(new ICCTag('0x9f37', '28BB7FE5'));
$request->addICCTag(new ICCTag('0x95', '800000E000'));
$request->addICCTag(new ICCTag('0x9c', '00'));
$request->addICCTag(new ICCTag('0x9f10', '020000000000'));
$request->addICCTag(new ICCTag('0x9f06', 'A0000000041010'));
$request->addICCTag(new ICCTag('0x9f09', '0002'));
$request->addICCTag(new ICCTag('0x9f27', '80'));
$request->addICCTag(new ICCTag('0x9f34', '410302'));
$request->addICCTag(new ICCTag('0x9f35', '24'));
$request->addICCTag(new ICCTag('0x9b', '6800'));
$request->addICCTag(new ICCTag('0x4f', 'A0000000041010'));
$request->addICCTag(new ICCTag('0x9f08', '0002'));
$request->addICCTag(new ICCTag('0x9f07', 'FF00'));
$request->addICCTag(new ICCTag('0x5f28', '0056'));
$request->addICCTag(new ICCTag('0x9f0d', 'F040642000'));
$request->addICCTag(new ICCTag('0x9f0e', '0010880000'));
$request->addICCTag(new ICCTag('0x9f0f', 'F0E064F800'));
$request->addICCTag(new ICCTag('0x9f33', '6098C8'));
$request->addICCTag(new ICCTag('0x9a', '060424'));
$request->addICCTag(new ICCTag('0x5f20', ICCTagValueType_String, 'REQ01 MC'));

echo '<p>'.$request->toString();

// Setup the client.
$client = new Client();
$client->addServerURL('https://test.cardeasexml.com/generic.cex', 45000);
$client->setRequest($request);

// Process the request.
$client->processRequest();

// Get the response.
$response = $client->getResponse();
echo '<p>'.$response->toString();
?>
