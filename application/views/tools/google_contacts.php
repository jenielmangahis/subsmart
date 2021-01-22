<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header');
?>
<div class="wrapper" role="wrapper">
<?php $this->load->view('includes/sidebars/api_connectors', $sidebars) ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Google Contacts</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <?php 
                            $client = new Google_Client();
                            $client -> setApplicationName('nSmarTrac');
                            $client -> setClientid($google_client_id);
                            $client -> setClientSecret($google_client_secret);
                            $client -> setRedirectUri($google_redirect_uri);
                            $client -> setAccessType('online');
                            $client -> setScopes('https://www.google.com/m8/feeds');
                            $googleImportUrl = $client-> createAuthUrl();
                        
                            if (isset($_GET['code'])) {
                                $code =  $_GET['code'];
                                $client->authenticate($code);
                                $_SESSION['access_token'] = $client->getAccessToken();
                                $this->session->set_userdata('google_access_token', $_SESSION['access_token']);
                            }
                            
                            //print_r($this->session->userdata());
                        ?>
                        
                        <p class="margin-bottom">
                            Export your <span class="weight-medium">nSmarTrac Customers</span> to <span class="weight-medium">Google Contacts</span> so you can identify the customers on your phone Caller ID or on sending emails from Gmail.
                        </p>
                        <p class="margin-bottom">
                            <span class="weight-medium">Important Notice</span><br>
                            - in order to add new contacts we'll need write permission to your Google Contacts<br>
                            - please stay assured that nSmarTrac will only add contacts and it will not read and delete any existent contacts<br>
                        </p>
                        <hr>
                        <div class="weight-medium text-lg margin-bottom-sec">Connect to Google Contacts</div>
                        <!--<a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $this->config->item('google_contact_client_id'); ?>&redirect_uri=<?php echo $this->config->item('google_contact_redirect_url'); ?>&scope=https://www.google.com/m8/feeds/&response_type=code"><img src="<?php echo base_url('/assets/img/api-tools/btn_google_signin_dark_normal_web.png') ?>"></a>-->
                        <!--<a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $google_client_id ?>&redirect_uri=<?php echo $google_redirect_uri; ?>&scope=https://www.google.com/m8/feeds/&response_type=code"><img src="<?php echo base_url('/assets/img/api-tools/btn_google_signin_dark_normal_web.png') ?>"></a>-->
                        <a id="connectBtn" href="#"><img src="<?php echo base_url('/assets/img/api-tools/btn_google_signin_dark_normal_web.png') ?>"></a>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <?php //if (hasPermissions('users_add')):  ?>
                                        <!-- <a href="<?php //echo url('users/add')  ?>" class="btn btn-primary"
                                           aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> New Employee
                                        </a> -->
                                    <?php //endif  ?>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <!--<img src="/assets/img/api-tools/thumb_google_contacts.png" alt="google contacts">-->
                                </div>

                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">

                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- page wrapper end -->
            </div>
<?php include viewPath('includes/footer'); ?>

<script src="https://apis.google.com/js/client.js?onload=checkAuth"/></script>
<script type="text/javascript">
function checkAuth() {
  gapi.auth.authorize({
    'client_id' : "<?= $google_client_id; ?>",
    'scope' : 'https://www.google.com/m8/feeds'
  }, handleAuthResult);
}

function handleAuthResult(authResult) {
  //console.log(authResult);  
  var msg1 = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Connecting Gmail Account...</div>';
  var url = base_url + "tools/saveGoogleAcount";
  var auth_code = authResult['code'];
  if (typeof auth_code !== "undefined") {
    $.ajax({
      type: 'POST',
      url: url,
      data:{
          token: authResult['code'],
          client_id : '<?= $google_client_id ?>',
          client_secret : '<?= $google_client_secret ?>'
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
    
    
    $('.dataTableCampaign').DataTable({
        'searching': false,
        "lengthChange": false
    });
</script>

