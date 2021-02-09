<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Checkout.js Demo</title>
    <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <script>
        function initiateCheckoutJS() {
            var tokenRequest = {
                ssl_first_name: document.getElementById('name').value,
                ssl_last_name: document.getElementById('lastname').value,
                ssl_amount: document.getElementById('ssl_amount').value
            };
            $.post("checkoutjscurlrequestdevportal.php", tokenRequest, function (data) {
                document.getElementById('token').value = data;
                transactionToken = data;
            });
            return false;
        }

        function showResult(status, msg) {
            document.getElementById('txn_status').innerHTML = "<b>" + status + "</b>";
            document.getElementById('txn_response').innerHTML = msg;
        }
    </script>

    <script>
        function pay() {
            var token = document.getElementById('token').value;
            var card = document.getElementById('card').value;
            var exp = document.getElementById('exp').value;
            var cvv = document.getElementById('cvv').value;
            var gettoken = document.getElementById('gettoken').value;
            var addtoken = document.getElementById('addtoken').value;
            var firstname = document.getElementById('name').value;
            var lastname = document.getElementById('lastname').value;
            var merchanttxnid = document.getElementById('merchanttxnid').value;
            var paymentData = {
                ssl_txn_auth_token: token,
                ssl_card_number: card,
                ssl_exp_date: exp,
                ssl_get_token: gettoken,
                ssl_add_token: addtoken,
                ssl_first_name: firstname,
                ssl_last_name: lastname,
                ssl_cvv2cvc2: cvv,
                ssl_merchant_txn_id: merchanttxnid
            };
            var callback = {
                onError: function (error) {
                    showResult("error", error);
                },
                onDeclined: function (response) {
                    console.log("Result Message=" + response['ssl_result_message']);
                    showResult("declined", JSON.stringify(response));
                },
                onApproval: function (response) {
                    console.log("Approval Code=" + response['ssl_approval_code']);
                    showResult("approval", JSON.stringify(response));
                }
            };
            ConvergeEmbeddedPayment.pay(paymentData, callback);
            return false;
        }

        function showResult(status, msg) {
            document.getElementById('txn_status').innerHTML = "<b>" + status + "</b>";
            document.getElementById('txn_response').innerHTML = msg;
        }
    </script>

    </head>

    <body>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form name="getSessionTokenForm">
            First Name: <input type="text" id="name" name="ssl_first_name" size="25" value="John"> <br><br>
            Last Name: <input type="text" id="lastname" name="ssl_last_name" size="25" value="Smith"> <br><br>
            Transaction Amount: <input type="text" id="ssl_amount" name="ssl_amount" value="25.00"> <br> <br>
            <button onclick="return initiateCheckoutJS();">Click to Confirm Order</button> <br>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        Transaction Token: <input id="token" type="text" name="token"> <br />

        Card Number: <input id="card" type="text" name="card" value="4124939999999990" /> <br />
        Expiry Date: <input id="exp" type="text" name="exp" value="1219" /> <br />
        CVV2: <input id="cvv" type="text" name="cvv" value="123"> <br />
        Merchant TXN ID: <input id="merchanttxnid" type="text" name="merchanttxnid" value="MerchantTXNIDHere" /> <br />
        <input id="gettoken" type="hidden" name="gettoken" value="y" />
        <input id="addtoken" type="hidden" name="addtoken" value="y" />
        <button onclick="return pay();">Process Payment</button>

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