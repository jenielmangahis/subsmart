<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 10px;
    }

    h5 {
        color: #333;
    }

    button {
        display: inline-block;
        margin: 10px 0;
        padding: 8px 16px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
        font-size: 14px;
    }

    button:hover {
        background-color: #0056b3;
    }

    pre {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        padding: 8px;
        border-radius: 4px;
    }

    #result {
        margin-top: 20px;
    }

    .input-group {
        margin: 10px 0;
    }

    .input-group label {
        display: block;
        font-size: 14px;
        color: #555;
    }

    .input-group input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .note {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
    }

    .note a {
        color: #007bff;
        text-decoration: none;
    }

    .note a:hover {
        text-decoration: underline;
    }
</style>
<h5>RingCentral API Testing</h5>
<label class="text-muted">Test only.</label><br><br>
<button id="connect-btn" onclick="connectRingCentralAPI()">Connect</button>
<div id="sms-section" style="display: none;">
    <div class="input-group">
        <label for="from-phone">From Phone No.:</label>
        <input id="from-phone" type="text" value="+18333426872" />
    </div>
    <div class="input-group">
        <label for="to-phone">
            To Phone No.:
            <span class="note">
                (Default: <a href="https://receive-smss.com/sms/13135243034/" target="_blank">+13135243034</a>)
            </span>
        </label>
        <input id="to-phone" type="text" value="+13135243034" />
    </div>
    <button id="send-sms-btn" onclick="sendSampleSMS()">Send Sample SMS</button>
</div>

<div id="result">
    <h5>Access Token:</h5>
    <pre id="access-token">Not available</pre>
    <h5>Error Details:</h5>
    <pre id="error-details">No errors</pre>
</div>

<script>
    var BASE_URL = window.origin;
    let accessToken = null;

    const config = {
        RINGCENTRAL_CLIENT_ID: '24hh9x2JfkPavT4CoWEd7U',
        RINGCENTRAL_CLIENT_SECRET: '7U0t4kLG1nCc3TAC0Bt8dbboy7W81r6I1aweeSWO59Dw',
        RINGCENTRAL_SERVER_URL: 'https://platform.ringcentral.com',
        REDIRECT_URL: BASE_URL + '/RingCentraAPITestOnly',
    };

    function connectRingCentralAPI() {
        const authUri = `${config.RINGCENTRAL_SERVER_URL}/restapi/oauth/authorize` +
            `?response_type=code` +
            `&client_id=${encodeURIComponent(config.RINGCENTRAL_CLIENT_ID)}` +
            `&redirect_uri=${encodeURIComponent(config.REDIRECT_URL)}`;

        const popup = window.open(authUri, 'RingCentralLogin', 'width=500,height=750');
        if (!popup) {
            alert("Popup blocked! Please allow popups for this site.");
            return;
        }

        const pollOAuth = setInterval(() => {
            try {
                if (!popup || popup.closed) {
                    clearInterval(pollOAuth);
                    alert("Login popup has been closed.");
                    return;
                }

                const currentUrl = popup.location.href;
                if (currentUrl.includes(config.REDIRECT_URL)) {
                    clearInterval(pollOAuth);
                    popup.close();
                    const code = new URLSearchParams(currentUrl.split('?')[1]).get('code');

                    if (code) {
                        exchangeAuthorizationCodeForToken(code);
                    } else {
                        document.getElementById('error-details').innerText = "Authorization code not found.";
                    }
                }
            } catch (e) {}
        }, 500);
    }

    function exchangeAuthorizationCodeForToken(code) {
        const tokenUrl = `${config.RINGCENTRAL_SERVER_URL}/restapi/oauth/token`;

        const body = {
            grant_type: 'authorization_code',
            code: code,
            redirect_uri: config.REDIRECT_URL,
            client_id: config.RINGCENTRAL_CLIENT_ID,
            client_secret: config.RINGCENTRAL_CLIENT_SECRET
        };

        $.ajax({
            url: tokenUrl,
            method: 'POST',
            data: body,
            dataType: 'json',
            success: function(data) {
                accessToken = data.access_token;
                document.getElementById('access-token').innerText = accessToken;
                document.getElementById('error-details').innerText = "No errors";
                document.getElementById('connect-btn').style.display = 'none';
                document.getElementById('sms-section').style.display = 'block';
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                document.getElementById('error-details').innerText = `Status: ${status}\nError: ${error}\nResponse: ${xhr.responseText}`;
            }
        });
    }

    function sendSampleSMS() {
        if (!accessToken) {
            alert("No access token available. Please login first.");
            return;
        }

        const fromPhone = document.getElementById('from-phone').value;
        const toPhone = document.getElementById('to-phone').value;

        $.ajax({
            url: 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/sms',
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${accessToken}`,
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                from: {
                    phoneNumber: fromPhone
                },
                to: [{
                    phoneNumber: toPhone
                }],
                text: 'Hello! This is a test message from RingCentral.'
            }),
            success: function(response) {
                alert("SMS sent successfully!");
                console.log('SMS sent successfully:', response);
            },
            error: function(xhr, status, error) {
                console.error('Failed to send SMS:', error);
                document.getElementById('error-details').innerText = `Status: ${status}\nError: ${error}\nResponse: ${xhr.responseText}`;
            }
        });
    }
</script>