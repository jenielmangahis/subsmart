<?php 

$response = file_get_contents('https://www.convergepay.com/hosted-payments/myip?fbclid=IwAR0dzvd6GaCdUq9m64kt9Xr4YS4WoqcoK-jmK7TE-9Yep5G2SI3Kk4jqsxM');
echo $response;