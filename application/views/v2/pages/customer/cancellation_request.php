<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_customer_status_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Customers cancel request.
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="col-12 col-md-8 mb-2" style="margin: 0 auto;">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-fw bx-file'></i> Customer Cancellation Request Details</span>
                                    <!-- <div class="form-check" style="float:right;">
                                        <input class="form-check-input chk-collection" type="checkbox" value="1" name="is_collection" id="chk-collection">
                                        <label class="form-check-label" for="chk-collection">
                                            Collection
                                        </label>
                                    </div> -->                        
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <hr>
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">Date Request Received</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->request_date)); ?></label>
                                    </div>
                                </div>  
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">Reason</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle"><?php echo $cancel_request_data->reason; ?></label>
                                    </div>
                                </div>                       
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">Next Step</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle"><?php echo $cancel_request_data->next_action; ?></label>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">BOC Amount</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle">$<?php echo number_format($cancel_request_data->boc_amount,2); ?></label>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">BOC Received Date</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->boc_received_date)); ?></label>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">CS Closed Date</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->cs_close_date)); ?></label>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-subtitle fw-bold">Equipment Return Date</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label class="content-subtitle"><?php echo date('m/d/Y', strtotime($cancel_request_data->equipment_return_date)); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div id="cust-collection-req-container" class="cust-collection-req-container">
                                <br />
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span><i class='bx bx-fw bx-file'></i> Collections</span>                           
                                    </div>
                                    <div class="form-check" style="float:right;">
                                        <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-edit-customer-collection"><span class="fa fa-edit"></span> Edit</a>
                                    </div>                                    
                                </div>
                                <div class="nsm-card-content">
                                    <hr>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Send to Collection</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->send_to_collection != null ? $cancel_request_data->send_to_collection : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Statement of Claim</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->statement_of_claim != null ? $cancel_request_data->statement_of_claim : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Court Date</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->court_date != null ? date('m/d/Y', strtotime($cancel_request_data->court_date)) : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Claim $</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->claim_amount > 0 ? $cancel_request_data->claim_amount : '--'; ?></label>
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-subtitle fw-bold">Award Amount</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <label class="content-subtitle"><?php echo $cancel_request_data->award_amount > 0 ? $cancel_request_data->award_amount : '--'; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br />
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-fw bx-file'></i> Customer Profile</span>                           
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <hr>
                            </div>

                            <br />
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-fw bx-file'></i> Alarm Details</span>                           
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <hr>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#chk-collection').change(function() {
            $('#cust-collection-req-container').toggle(this.checked);
        });       
        
        $("#btn-quick-edit-customer-collection").click(function() {
            let cancellation_id = "<?= $cancel_request_data->id ? $cancel_request_data->id : 0; ?>";
            if( cancellation_id > 0 ){
                $('#request-cancellation-id').val(cancellation_id);
                $('#modal_customer_cancel_request_collection_update_modal').modal('show');
            }             
        });    
        
        $("#frm-customer-cancellation-collection-update").on("submit", function(e) { 
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "customer/_update_customer_collection_request";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                beforeSend: function(data) {
                    $("#btn-customer-update-collection-request").html('<span class="bx bx-loader bx-spin"></span>');
                },                
                success: function(result) {
                    if (result.is_success === 1) {
                        $('#modal_customer_cancel_request_collection_update_modal').modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Customer Collection',
                            text: "Customer collection has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }

                    $("#btn-customer-update-collection-request").html("Update");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
 

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>