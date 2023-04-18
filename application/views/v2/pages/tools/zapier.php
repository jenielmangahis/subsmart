<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<style>
.form-inline input{
    display: inline-block;
    width: 60%;
    font-size: 17px !important;
}
.form-inline a{
    display: inline-block;
}
.btn-copy-clipboard{
    margin-top: 14px;
    display: block;
    margin-left: 0px !important;
    width: 11%;
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
                <?php if( $apiConnector && $apiConnector->zapier_api_key != '' ){ ?>
                    <div class="row" style="margin-bottom:30px;">
                        <div class="col-5">
                            <h1>Zapier</h1>
                            <p style="margin-top: 21px;">Get notified when a Work Order is completed or an Invoice is paid. Pull customers list to send marketing emails. In order for you to get the Zapier integration working you need an API Key.</p>
                        </div>
                        <div class="col-7" style="text-align:right;">
                            <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_zapier.png">
                        </div>
                    </div>
                    <!-- <div class="row" style="margin-bottom:30px;">
                        <div class="col-5">
                            <h4>Zapier URL</h4>
                            <p style="margin-top: 21px;">To use and see the Markate Zapier App please follow this link: 
                            </p>
                        </div>
                    </div> -->

                    <div class="row" style="margin-bottom:30px;">
                        <div class="col-10">
                            <h4>API Key</h4>
                            <p style="margin-top: 7px;">Copy/Paste the API Key when you setup your zap and use Markate App.</p>
                            <div class="form-inline">
                                <input type="text" class="nsm-field form-control" readonly="" disabled="" value="<?= $apiConnector->zapier_api_key; ?>">
                                <a class="nsm-button primary btn-regenerate" href="javascript:void(0);">Regenerate</a>
                            </div>
                            <a class="nsm-button default btn-copy-clipboard" href="javascript:void(0);"><i class='bx bx-copy'></i> Copy to clipboard</a>
                            
                        </div>
                    </div>
                    
                <?php }else{ ?>
                    <div class="row" style="margin-bottom:30px;">
                        <div class="col-5">
                            <h1>Zapier</h1>
                            <p style="margin-top: 21px;">Get notified when a Work Order is completed or an Invoice is paid. Pull customers list to send marketing emails. In order for you to get the Zapier integration working you need an API Key.</p>
                        </div>
                        <div class="col-7" style="text-align:right;">
                            <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_zapier.png">
                        </div>
                    </div>
                    <div class="row" style="margin-bottom:30px;">
                        <div class="col-5">
                            <h4>API not enabled</h4>
                            <p style="margin-top: 21px;">Please enable Zapier in <a href="<?= base_url('tools/api_connectors'); ?>">API Connectors Zapier</a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="zapier_key_regen" tabindex="-1" aria-labelledby="zapier_key_regen_label" aria-hidden="true">
        <div class="modal-dialog mdal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="setup_paypal_modal_label">Regenerate API Key</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <p>This will replace your current API Key with a new one. Your current Zapier zap will no longer work. You'll have to re-authenticate on Zapier Markate app and input the new API Key.</p>
                </div>            

                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary btn-key-regen">Regenerate</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-regenerate').on('click', function(){
            $('#zapier_key_regen').modal('show');
        });

        $(".btn-copy-clipboard").on("click", function() {
            var _shareableLink = $("<input>");
            $("body").append(_shareableLink);
            _shareableLink.val("<?= $apiConnector->zapier_api_key; ?>").select();
            document.execCommand('copy');
            _shareableLink.remove();

            Swal.fire({                
                text: "API key has been copied to clipboard.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        });

        $('.btn-key-regen').on('click', function(){            
            var url = base_url + "tools/_zapier_regenerate_key";
            $.ajax({
                type: 'POST',
                url: url,                                
                dataType: "json",
                success: function(result) {
                    if( result.is_success == 1 ){
                        $('#zapier_key_regen').modal('hide');
                        Swal.fire({
                            text: 'API key updated',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#6a4a86',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                },
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>