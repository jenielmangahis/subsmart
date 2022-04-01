<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center align-items-center" style="height: 70vh;">
                        <div class="d-block text-center">
                            <?php
                            $client = new Google_Client();
                            $client->setApplicationName('nSmarTrac');
                            $client->setClientid($google_client_id);
                            $client->setClientSecret($google_client_secret);
                            $client->setRedirectUri($google_redirect_uri);
                            $client->setAccessType('online');
                            $client->setScopes('https://www.google.com/m8/feeds');
                            $googleImportUrl = $client->createAuthUrl();

                            if (isset($_GET['code'])) {
                                $code =  $_GET['code'];
                                $client->authenticate($code);
                                $_SESSION['access_token'] = $client->getAccessToken();
                                $this->session->set_userdata('google_access_token', $_SESSION['access_token']);
                            }

                            //print_r($this->session->userdata());
                            ?>


                            <label class="content-title d-block mb-2 fs-4">Connect to Google Contacts</label>
                            <label class="d-block">
                                Export your <span class="fw-bold">nSmarTrac Customers</span> to <span class="fw-bold">Google Contacts</span> so you can identify the customers on your phone Caller ID or on sending emails from Gmail.
                            </label>

                            <label class="content-title d-block mt-5">Important Notice</label>
                            <label class="d-block">In order to add new contacts we'll need write permission to your Google Contacts.</label>
                            <label class="d-block mb-5">Please stay assured that nSmarTrac will only add contacts and it will not read and delete any existent contacts</label>

                            <a href="#" id="connectBtn"><img src="<?php echo base_url('/assets/img/api-tools/btn_google_signin_dark_normal_web.png') ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://apis.google.com/js/client.js?onload=checkAuth"/></script>
<script type="text/javascript">
    $(document).ready(function() {

    });

    function checkAuth() {
        gapi.auth.authorize({
            'client_id': "<?= $google_client_id; ?>",
            'scope': 'https://www.google.com/m8/feeds'
        }, handleAuthResult);
    }

    function handleAuthResult(authResult) {
        //console.log(authResult);  
        var msg1 = '<div class="alert alert-info" role="alert"><img src="' + base_url + '/assets/img/spinner.gif" style="display:inline;" /> Connecting Gmail Account...</div>';
        var url = base_url + "tools/saveGoogleAcount";
        var auth_code = authResult['code'];
        if (typeof auth_code !== "undefined") {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    token: authResult['code'],
                    client_id: '<?= $google_client_id ?>',
                    client_secret: '<?= $google_client_secret ?>'
                },
                dataType: 'json',
                beforeSend: function(data) {
                    $('#connectBtn').html(msg1);
                },
                success: function(data) {
                    location.href = base_url + 'settings/schedule?calendar_update=1';
                },
                error: function(e) {
                    console.log(e);
                }
            });
        } else {
            alert('warning!');
        }
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>