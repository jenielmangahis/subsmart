<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<style>
.api-label{
    display: block;
    margin-bottom: 4px;
    font-weight: bold;
    font-size: 16px;
}
.f-green{
    color: #2ab363;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-5">
                        <h1>Google Contacts</h1>
                        <p style="margin-top: 21px;">Export your <span class="fw-bold">nSmarTrac Customers</span> to <span class="fw-bold">Google Contacts</span> so you can identify the customers on your phone Caller ID or on sending emails from Gmail.</p>
                    </div>
                    <div class="col-7" style="text-align:right;">
                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_google_contacts.png">
                    </div>
                </div>
                <?php if($companyGoogleContactsApi && $companyGoogleContactsApi->status == 1){ ?>
                    <div class="row mt-4">
                        <div class="col-2">
                            <span class="api-label">Google Contacts Status</span>
                            <span class="api-label f-green">You are connected</span>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="nsm-button primary btn-disconnect-google-account">Disconnect</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <span class="api-label">Google Account</span>
                        <span class="api-label f-green"><?= $companyGoogleContactsApi->google_email; ?></span>
                    </div>                    
                    <div class="row mt-5">
                        <?php if($companyGoogleContactsApi->google_last_sync != NULL){ ?>
                        <div class="col-12" style="text-align:right;">
                            <span class="api-label">Last Sync : <?= date("F j, Y g:i A", strtotime($companyGoogleContactsApi->google_last_sync)); ?></span>
                        </div>
                        <?php } ?>                    
                        <div class="col-12">
                            <a class="nsm-button primary btn-export-to-google-contacts" href="javascript:void(0);">
                                <i class='bx bxl-google'></i> Export to Google Contacts
                            </a>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <table class="nsm-table mt-5">                        
                                <thead>
                                    <tr>
                                        <td class="table-icon" style="width:70%;">Resource</td>
                                        <td data-name="TotalRecords">Total</td>
                                        <td data-name="TotalExported">Exported</td>
                                        <td data-name="TotalFailed">Failed</td>       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Customers</td>
                                        <td><?= $total_customers; ?></td>
                                        <td><?= $companyGoogleContactsApi->google_contacts_total_imported; ?></td>
                                        <td><?= $companyGoogleContactsApi->google_contacts_total_failed; ?></td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a href="<?= base_url('tools/google_contacts_logs') ?>" class="nsm-button default">View Logs</a>
                <?php }else{ ?>
                    <div class="row">
                        <div class="col-8">
                            <label class="content-title d-block mt-4">Important Notice</label>
                            <label class="d-block">- In order to add new contacts we'll need write permission to your Google Contacts.</label>
                            <label class="d-block mb-5">- Please stay assured that nSmarTrac will only add contacts and it will not read and delete any existent contacts</label>

                            <a href="javascript:void(0);" onclick="checkAuth();" id="connectBtn"><img src="<?php echo base_url('/assets/img/api-tools/btn_google_signin_dark_normal_web.png') ?>"></a>
                        </div>
                    </div>
                <?php } ?>                
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://apis.google.com/js/client.js?onload=checkAuth"/></script>
<script type="text/javascript">
<?php if($companyGoogleContactsApi && $companyGoogleContactsApi->status == 1){ ?>
    $(function(){
        $('.btn-export-to-google-contacts').on('click', function(){
            var url = base_url + "tools/_import_customer_data_to_google_contacts";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                beforeSend: function(data) {
                    $('#loading_modal').modal('show');
                    $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Importing Customer Data to Google Contacts....');
                },
                success: function(o) {                    
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Customer Import',
                            text: "Gmail import contacts was successfully created.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });  
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: o.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }             
                },
                complete : function(){
                    $('#loading_modal').modal('hide');
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $('.btn-disconnect-google-account').on('click', function(){
            var url = base_url + "tools/_disconnect_google_contacts";
            
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                beforeSend: function(data) {
                    $('#loading_modal').modal('show');
                    $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Disconnecting Google Account....');
                },
                success: function(data) {                    
                    Swal.fire({                        
                        text: "Gmail account was successfully disconnected.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });                    
                },
                complete : function(){
                    $('#loading_modal').modal('hide');
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    });
<?php }else{ ?>
    function checkAuth() {
        gapi.auth.authorize({
            'client_id': "<?= $google_credentials['client_id']; ?>",
            'scope': 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/contacts',
            'prompt': 'consent',
            'access_type': 'offline',
            'response_type': 'code token',
        }, handleAuthResult);
    }

    function handleAuthResult(authResult) {
        //console.log(authResult);        
        var url = base_url + "tools/_google_contact_account_bind";
        var auth_code = authResult['code'];
        if (typeof auth_code !== "undefined") {            
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    token: authResult['code']
                },
                dataType: 'json',
                beforeSend: function(data) {
                    $('#loading_modal').modal('show');
                    $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Connecting your google account....');
                },
                success: function(data) {                    
                    Swal.fire({
                        title: 'Gmail Connect',
                        text: "Gmail account connected successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });                    
                },
                complete : function(){
                    $('#loading_modal').modal('hide');
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    }
<?php } ?>
</script>
<?php include viewPath('v2/includes/footer'); ?>