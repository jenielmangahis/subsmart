<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Lightbox Demo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
 <body>
<!--<body background="SIF.png">-->
<script>
function initiateLightbox () {
            var tokenRequest = {
                ssl_first_name: document.getElementById('name').value,
                ssl_last_name: document.getElementById('lastname').value,
                ssl_amount: document.getElementById('ssl_amount').value
            };
            $.post("lightboxccsaledevportal.php", tokenRequest, function( data ) {
                document.getElementById('token').value = data;
                transactionToken = data;
            });
            return false;
        }

        function showResult (status, msg) {
            document.getElementById('txn_status').innerHTML = "<b>" + status + "</b>";
            document.getElementById('txn_response').innerHTML = msg;
        }
</script>

<script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script>
    <script>
        function openLightbox () {
            var paymentFields = {
                    ssl_txn_auth_token: document.getElementById("token").value
            };
            var callback = {
                onError: function (error) {
                    showResult("error", error);
                },
                onCancelled: function () {
                        showResult("cancelled", "");
                },
                onDeclined: function (response) {
                    showResult("declined", JSON.stringify(response, null, '\t'));
                },
                onApproval: function (response) {
                    showResult("approval", JSON.stringify(response, null, '\t'));
                }
            };
            PayWithConverge.open(paymentFields, callback);
            return false;
        }

        function showResult (status, msg) {
            document.getElementById('txn_status').innerHTML = "<b>" + status + "</b>";
            document.getElementById('txn_response').innerHTML = msg;
        }
    </script>

  </head>
  <body>

  <form name="getSessionTokenForm">
   <br>
        <br>
        <br>
        <br>
            First Name: <input type="text" id="name" name="ssl_first_name" size="25" value="John"> <br><br>
            Last Name: <input type="text" id="lastname" name="ssl_last_name" size="25" value="Smith"> <br>
            Transaction Amount: <input type="text" id="ssl_amount" name="ssl_amount" value="100.00"> <br> <br>
            <button onclick="return initiateLightbox();">Click to Confirm Order</button> <br>
        </form>
        <br>
        <br>
        Transaction Token: <input id="token" type="text" name="token" > <br/>

                    <button onclick="return openLightbox();">Proceed to Payment</button> <br>
        </form>

<br>
<br>
<br>

<br>
        Transaction Status:<div id="txn_status"></div>
        <br>
        Transaction Response:<div id="txn_response"></div>

</body>

</html>