<?php

 // Set variables

$merchantID = "2159250"; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
$merchantUserID = "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
$merchantPinCode = "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)

 //$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
 $url = "https://api.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

/*Payment Field Variables*/

// In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.
$firstname=$_POST['ssl_first_name']; //Post first name
$lastname=$_POST['ssl_last_name']; //Post first name
$amount= $_POST['ssl_amount']; //Post Tran Amount
//$merchanttxnid = $_POST['ssl_merchant_txn_id']; //Capture user-defined ssl_merchant_txn_id as POST data
//$invoicenumber = $_POST['ssl_invoice_number']; //Capture user-defined ssl_invoice_number as POST data

//Follow the above pattern to add additional fields to be sent in curl request below.

$ch = curl_init();    // initialize curl handle
curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
curl_setopt($ch,CURLOPT_POST, true); // set POST method
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set up the post fields. If you want to add custom fields, you would add them in Converge, and add the field name in the curlopt_postfields string.
curl_setopt($ch,CURLOPT_POSTFIELDS,
"ssl_merchant_id=$merchantID".
"&ssl_user_id=$merchantUserID".
"&ssl_pin=$merchantPinCode".
"&ssl_transaction_type=CCSALE".
"&ssl_first_name=$firstname".
"&ssl_last_name=$lastname".
"&ssl_get_token=Y".
"&ssl_add_token=Y".
"&ssl_amount=$amount"
);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$result = curl_exec($ch); // run the curl procss
curl_close($ch); // Close cURL

//session tokens need to be URL encoded
$sessiontoken = urlencode($result);

echo $sessiontoken;  //shows the session token.

 ?>