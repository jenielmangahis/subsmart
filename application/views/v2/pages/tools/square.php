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
.f-purple{
    color: #6a4a86;
}
.date-filter{
    display: inline-block;
    margin-left: 16px;
    width: 12%;
}
.select2-hr{
    margin: 2px;
}
.select2-bx-icon{
    font-size: 16px;
    position: relative;
    top: 2px;
    margin-right: 8px;
}
.api-logo{
    height: 49px;
    float: right;
    position: relative;
    top: -15px;
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
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button>
                            Connect your square payment account to receive payments.
                            <!-- <img class="nsm-card-img-lg api-logo" src="<?= base_url() ?>/assets/img/square-payment.png"> -->
                        </div>
                    </div>
                </div>

                <?php if( $companyOnlinePaymentAccount && $companyOnlinePaymentAccount->square_refresh_token != '' ){ ?>
                    <div class="row mt-4">
                        <div class="col-2">
                            <span class="api-label">Square Status</span>
                            <span class="">You are connected</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <span class="api-label">Square Account</span>
                        <span class=""><?= $companyOnlinePaymentAccount->square_business_name; ?></span>
                        <span class=""><?= $companyOnlinePaymentAccount->square_owner_email; ?></span>
                    </div>
                    <div class="row mt-5">
                        <div class="col-3">
                            <a href="javascript:void(0);" class="nsm-button primary" id="btn-disconnect-square">Disconnect</a>
                            <a href="<?= base_url('tools/square_payment_logs') ?>" class="nsm-button default">View Payment Logs</a>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="row mt-5">
                        <div class="col-8">                                                    
                            <button class="nsm-button primary" id="btn-connect-square">Connect to your Square Account</button>                            
                        </div>
                    </div>
                <?php } ?>
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
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#btn-connect-square').on('click', function(){
        var url = '<?= $square_connect_url; ?>';
        location.href = url;
    });
    
    $('#btn-disconnect-square').on('click', function(){
        Swal.fire({            
            html: "Disconnect your Square Account?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = base_url + "tools/_disconnect_square_account";
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    beforeSend: function(data) {
                        $('#loading_modal').modal('show');
                        $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Disconnecting Square Account....');
                    },
                    success: function(data) {                                                
                        setTimeout(
                            function() 
                            {                                
                                $('#loading_modal').modal('hide');
                                Swal.fire({                        
                                    text: "Square account was successfully disconnected.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });                    
                            }, 
                        1000);                                        
                    },
                    complete : function(){
                        
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>