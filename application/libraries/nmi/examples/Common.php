<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html>
<head>
<title>CardEaseXML</title>
</head>
<body>
<h1>CardEaseXML</h1>
<?php

/**
 * Due to the lack of support for exceptions in PHP4, error handling is best
 * performed by using a custom error handler.  This example shows how
 * CardEaseXML errors can be filtered and managed on an individual basis.
 */
function cardeasexml_error_handler($errno, $errstr, $errfile, $errline)
{
	// Check that this error should be reported.
	if ((error_reporting() & $errno) === 0)
	{	
		return;
	}

	// Not a CardEaseXML error.
	if (strpos($errstr, 'CardEaseXML') !== 0)
	{
		echo '<p><b>';

		switch ($errno)
		{
		case E_ALL:
			echo 'All';
			break;
		case E_COMPILE_ERROR:
			echo 'Compile Error';
			break;
		case E_COMPILE_WARNING:
			echo 'Compile Warning';
			break;
		case E_CORE_ERROR:
			echo 'Core Error';
			break;
		case E_CORE_WARNING:
			echo 'Core Warning';
			break;
		case E_ERROR:
			echo 'Error';
			break;
		case E_PARSE:
			echo 'Parse';
			break;
		case E_NOTICE:
			echo 'Notice';
			break;
		case E_USER_ERROR:
			echo 'User Error';
			break;
		case E_USER_NOTICE:
			echo 'User Notice';
			break;
		case E_USER_WARNING:
			echo 'User Warning';
			break;
		case E_WARNING:
			echo 'Warning';
			break;
		}

		echo ':</b> '.$errstr.' in <b>'.$errfile.'</b> on line <b>'.$errline.'</b>'."\n";

		if (
			$errno == E_COMPILE_ERROR ||
			$errno == E_CORE_ERROR ||
			$errno == E_ERROR ||
			$errno == E_PARSE ||
			$errno == E_USER_ERROR)
		{
			exit(0);
		}

		return;
	}

	echo '<p><b>CardEaseXML failed due to: '.$errstr.'</b>';

	if ($errno === E_USER_ERROR)
	{
		exit(1);
	}
}

set_error_handler('cardeasexml_error_handler');

ini_set('display_errors', 'on');
echo '<p>Running under PHP '.phpversion();

/*if (empty($_REQUEST['TERMINALID']) || empty($_REQUEST['TRANSACTIONKEY'])) {	
	trigger_error('TerminalID and TransactionKey must be specified in GET or POST variables', E_USER_ERROR);
}*/
if (file_exists('../src/Client.php')) {
	echo 777;exit;
	require_once('.../src/Client.php');
}
?>
