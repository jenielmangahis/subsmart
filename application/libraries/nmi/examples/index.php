<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html>
<head>
<title>CardEaseXML</title>
</head>
<body>
<h1>CardEaseXML</h1>
<?php

echo '<p>Running under PHP '.phpversion();

if (empty($_REQUEST['TERMINALID']) || empty($_REQUEST['TRANSACTIONKEY'])) {
	echo '<form action=\''.$_SERVER['PHP_SELF'].'\'>'.
		'<table>'.
		'<tr><th>Terminal ID:</th><td><input type=text name=\'TERMINALID\'></td></tr>'.
		'<tr><th>TransactionKey:</th><td><input type=text name=\'TRANSACTIONKEY\'></td></tr>'.
		'<tr><th>&nbsp;</th><td><input type=submit value=\'Submit\'></td></tr>'.
		'</table>'.
		'</form>';

	return;
}

$args = 'TERMINALID='.urlencode($_REQUEST['TERMINALID']).'&amp;TRANSACTIONKEY='.urlencode($_REQUEST['TRANSACTIONKEY']);

$dir = opendir('.');
while (($file = readdir($dir)) !== false) {

	if (preg_match('/^Example.+\.php$/', $file) === 0) {
		continue;
	}

	$files[] = $file;
}

sort($files);

foreach ($files as $file) {
	echo '<p><a href=\''.$file.'?'.$args.'\'>'.$file.'</a>';
}

?>
