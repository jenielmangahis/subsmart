<?php include viewPath('v2/includes/header_clienthub'); ?>

<style>
    .nsm-profile {
        --size: 35px;
        max-width: var(--size);
        height: var(--size);
        min-width: var(--size);
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_portal_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Your personal information.
                        </div>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-12 text-end mb-2">
                        <button type="button" class="nsm-button primary" id="btn-request-change-information">
                            <i class='bx bx-clipboard'></i> Request change in information
                        </button>
                    </div>
                    <div class="col-md-6">
                        <?php include viewPath('v2/pages/customer/client_hub/_customer_info_a'); ?>            
                    </div>
                    <div class="col-md-6">
                        <?php include viewPath('v2/pages/customer/client_hub/_customer_info_b'); ?>            
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modal-request-change-information" tabindex="-1" aria-labelledby="modal-request-change-information_label" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Request change of information</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <form id="frm-request-change-information" method="POST">
                    <input type="hidden" name="cid" value="<?= $customer_id_incrypt; ?>" />
                    <div class="modal-body">
                        <div class="row g-3 tc-off-group">
                            <div class="col-12">
                                <div class="col-12">
                                    <label class="content-subtitle fw-bold d-block mb-2">Details</label>
                                    <textarea name="details" id="request-details" style="height:200px;" class="nsm-field form-control" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary">Send</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
$(function(){
    $('#btn-request-change-information').on('click', function(){
        $('#modal-request-change-information').modal('show');
    });

    $('#frm-request-change-information').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'client_hub/_send_request_change_information';

        Swal.fire({
            title: 'Request change information',
            html: `Proceed with sending your request for change in information?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#frm-request-change-information').serialize(),
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            $('#modal-request-change-information').modal('hide');
                            $('#frm-request-change-information')[0].reset();
                            
                            Swal.fire({
                            icon: 'success',
                            title: 'Request change information',
                            text: 'Your request has been sent.',
                            }).then((result) => {
                                
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer_clienthub'); ?>
