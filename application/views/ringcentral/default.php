<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php $this->load->view('includes/sidebars/api_connectors', $sidebar) ;
            
       $url = $platform->authUrl(array(
          'redirectUri' => $RINGCENTRAL_REDIRECT_URL,
          'state' => 'initialState',
          'brandId' => '',
          'display' => '',
          'prompt' => ''
        ));
               
            
    ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-5 bg-white">
                <div class="card">
                    <div class="card-body" >
                        <div class="col-sm-12">
                            <h3 class="page-title">Ring Central</h3>
                            <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                <span style="color:black;">
                                    Call, Message, and Meet Seamlessly
                                    The Ring Central app's intuitive and unified user interface allows you to seamlessly transition between phone calls, video meetings, and team chat without
                                    losing track of what you’re working on. Less toggling between communications applications and solutions means your projects move forward, your teams
                                    stay connected, and your productivity increases.
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <?php if(!$this->session->isRCLogin) : ?>
                                <a class="btn btn-primary btn-small" onclick="oauth.loginPopup()" href="#">Login RingCentral Account</a>
                            <?php else: ?>
                                <a class="btn btn-primary btn-small" href="<?= base_url('ring_central/logout') ?>">Logout</a>
                            <?php endif; ?>
                                <pre id="token" style="background-color:#efefef;padding:1em;overflow-x:scroll"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    
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

    
</script>    

<?php include viewPath('includes/footer');