   var OAuthCode = function(rcsdk, config) {
    this.config = config;
    this.loginPopup  = function() {
        var authUri = rcsdk.platform().loginUrl({
            redirectUri: this.config['MY_APP_REDIRECT_URL'],
            client_id: this.config['RINGCENTRAL_CLIENT_ID']
        })
        this.loginPopupUri(authUri, this.config['MY_APP_REDIRECT_URL']);
    }
    this.loginPopupUri  = function(authUri, redirectUri) {
        console.log('Open login popup window', authUri);
        var win         = window.open(authUri, 'windowname1', 'width=800, height=600'); 

        var pollOAuth   = window.setInterval(function() { 
            try {
                var redirectUrl = this.config['MY_APP_REDIRECT_URL'];
                var callbackUrl = win.document.URL;
                if (callbackUrl.indexOf(redirectUrl) != -1) {
                    window.clearInterval(pollOAuth);

                    var qs = rcsdk.platform().parseLoginRedirect(win.location.hash || win.location.search);
                    qs.redirectUri = redirectUri;

                    if ('code' in qs) {
                        var res = rcsdk.platform()
                            .login(qs)
                            .then(function(response) {
                                document.getElementById('token').innerHTML = response.text();
                                win.close();
                            }).catch(function(e) {
//                                console.log(e);
//                                document.write("E_AUTHZ_ERR");
                                win.close();
                                location.reload();
                            });
                    } else {
                        console.log("E_NO_CODE");
                        win.close();
                    }                 
                }
            } catch(e) {
                console.log(e);
                //win.close();
            }
        }, 500);
    }
}

var rcsdk = new RingCentral.SDK({
    server: config['RINGCENTRAL_SERVER_URL'],
    clientId: config['RINGCENTRAL_CLIENT_ID'],
    clientSecret: config['RINGCENTRAL_CLIENT_SECRET']
});

var oauth = new OAuthCode(rcsdk, config);
