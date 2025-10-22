<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Admin</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Entered by</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->entered_by) {
                                        echo $office_info->entered_by; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Time Entered</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->time_entered) {
                                        echo $office_info->time_entered; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Pre Survey</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->pre_install_survey) {
                                        echo $office_info->pre_install_survey; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Post Survey</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->post_install_survey) {
                                        echo $office_info->post_install_survey; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Language</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->language) {
                                        echo $office_info->language; 
                                    } else {
                                        echo "English";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Date Enter</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->sales_date) {
                                        echo $office_info->sales_date; 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Sales Rep</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->fk_sales_rep_office) {
                                        echo getUser($office_info->fk_sales_rep_office); 
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>

                                <?php
                                    //$sales_rep = !empty($office_info->fk_sales_rep_office) ?  get_employee_name($office_info->fk_sales_rep_office) : '---';
                                ?>
                                <?php //$sales_rep->FName. ' ' . $sales_rep->LName; ?>
                            </span>
                        </div>                        
                        <div class="col-12 col-md-6">
                            <label class="content-title">Tech</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <span class="content-subtitle">
                                <?php 
                                    if ($office_info->technician) {
                                        echo getUser($office_info->technician);
                                    } else {
                                        echo "&mdash;";
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>            
            <?php include viewPath('v2/pages/customer/adv_cust_modules/billing'); ?>      
            <?php if( isAdmin() && in_array(logged('company_id'), adi_company_ids()) ){ ?>
                <?php include viewPath('v2/pages/customer/adv_cust_modules/payment_method_images'); ?>      
            <?php } ?>
            <div class="row g-1">                
                <?php if( isAdmin() && in_array(logged('company_id'), adi_company_ids()) ){ ?>
                <div class="col-12 col-md-6">
                    <button type="button" id="btn-billing-upload-payment-method" class="nsm-button primary w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-upload'></i> Upload Image
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button type="button" id="btn-billing-capture-payment" class="nsm-button primary w-100 ms-0 mt-3">
                        <i class='bx bx-fw bx-dollar-circle' ></i> Capture Payment
                    </button>
                </div>
                <?php } ?>
                <div class="col-12 col-md-6">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" onclick="window.open('<?= base_url('customer/activities/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-history'></i> History Log
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" onclick="window.open('<?= base_url('/customer/add_advance/' . $profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-message-square-edit'></i> View/Edit Module
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modal-admin-upload-image" tabindex="-1" aria-labelledby="modal-admin-upload-image-modal_label" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Upload Image</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-admin-upload-image" method="POST">
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label for="admin-image" class="block-label"><b>Image</b></label>
                                    <input type="file" class="form-control" name="image" id="admin-image" accept="image/*" />
                                </div>  
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-admin-upload-image" form="frm-admin-upload-image">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modal-admin-capture-payment" tabindex="-1" aria-labelledby="modal-admin-capture-payment_label" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Capture Payment</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm-admin-capture-payment" method="POST">
                            <div class="row g-3" id="admin-capture-payment-step1">
                                <div class="col-md-12 form-group">
                                    <label for="processing-fee" class="block-label"><b>Processing Fee</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">$</div>
                                        <input type="number" step="any" value="0" min="0" class="form-control" name="processing_fee" id="processing-fee" />
                                    </div> 
                                </div>  
                                <div class="col-md-12 form-group">
                                    <label for="payment-amount" class="block-label"><b>Amount</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">$</div>
                                        <input type="number" step="any" value="0" min="0" class="form-control" name="payment_amount" id="payment-amount" />
                                    </div>                                
                                </div> 
                                <div class="col-md-12 form-group">
                                    <label for="payment-amount" class="block-label"><b>Total Amount</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">$</div>
                                        <input type="number" step="any" value="0" min="0" class="form-control" name="payment_total_amount" id="payment-total-amount" disabled readonly />
                                    </div>                                
                                </div>  
                            </div>                        
                        </form>
                        <div id="admin-capture-payment-step2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="nsm-button primary" id="btn-admin-capture-payment-next">Next</button>
                        <button type="button" class="nsm-button primary" id="btn-admin-capture-payment-back" style="display:none;">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if( isAdmin() ){ ?>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?= paypal_credential('client_id'); ?>&currency=USD"></script>
<?php } ?>
<script>
$(function(){
    <?php if( isAdmin() && in_array(logged('company_id'), adi_company_ids()) ){ ?>
    $('#btn-billing-upload-payment-method').on('click', function(){
        $('#modal-admin-upload-image').modal('show');
    });

    $('#btn-billing-capture-payment').on('click', function(){
        $('#modal-admin-capture-payment').modal('show');
    });

    $('#btn-admin-capture-payment-next').on('click', function(){      
        let url = base_url + 'customer/_capture_payment_form'  
        let processing_fee = $('#processing-fee').val();
        let payment_amount = $('#payment-amount').val();
        let customer_id = "<?= $customer_id; ?>";
		$.ajax({
			type: "POST",
			url: url,
			data: {processing_fee:processing_fee, payment_amount:payment_amount, customer_id:customer_id},
			success: function(o)
			{	
				$('#admin-capture-payment-step2').html(o);
			},
			beforeSend:function(){
                $('#admin-capture-payment-step1').hide();
                $('#btn-admin-capture-payment-next').hide();
                $('#admin-capture-payment-step2').show();
                $('#btn-admin-capture-payment-back').show();
				$('#admin-capture-payment-step2').html('<span class="bx bx-loader bx-spin"></span> loading payment form...');
			}
		});
    });

    $('#btn-admin-capture-payment-back').on('click', function(){
        $('#admin-capture-payment-step1').show();
        $('#btn-admin-capture-payment-next').show();
        
        $('#admin-capture-payment-step2').html('');
        $('#admin-capture-payment-step2').hide();
        $('#btn-admin-capture-payment-back').hide();
    });

    $('#processing-fee, #payment-amount').on('change', function(){
        let total_amount = computeCapturePaymentTotalAmount();
        $('#payment-total-amount').val(total_amount);
    });

    function computeCapturePaymentTotalAmount(){
        let processing_fee = $('#processing-fee').val();
        let payment_amount = $('#payment-amount').val();
        let payment_total_amount = parseFloat(processing_fee) + parseFloat(payment_amount);

        return payment_total_amount.toFixed(2);
        
    }

    $('#frm-admin-upload-image').on('submit', function(){
        event.preventDefault(); // Prevent default form submission

        let customer_id = "<?= $customer_id; ?>";
        let fileInput = $('#admin-image')[0];
        let files = fileInput.files;

        if (files.length > 0) {
            let url = base_url + 'customer/_upload_payment_method_image';
            let formData = new FormData();
            formData.append('admin_image', files[0]); 
            formData.append('customer_id', customer_id);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false, 
                success: function(response) {
                    $('#modal-admin-upload-image').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error uploading file: ' + textStatus,
                    });
                },
                beforeSend: function(){
                    Swal.fire({
                        icon: "info",
                        title: "Processing",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                }
            });
        } else {
            alert('Please select a file to upload.');
        }
    });
    <?php } ?>
});
</script>