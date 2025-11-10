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
                                <div class="row g-1">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Customer Type</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= !empty($profile_info->customer_type) ? $profile_info->customer_type : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Sales Area</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">
                                            <?php $salesArea = '---';
                                            foreach ($sales_area as $sa) : ?>
                                                <?php if (isset($profile_info) && $profile_info->fk_sa_id != 0) {
                                                    if ($profile_info->fk_sa_id == $sa->sa_id) {
                                                        $salesArea = $sa->sa_name;
                                                    }
                                                } ?>
                                            <?php endforeach ?>
                                            <?= $salesArea ?>
                                        </label>
                                    </div>
                                    <?php if( $profile_info->customer_type == 'Commercial' ){ ?>
                                        <div class="col-12 col-md-6">
                                            <label class="content-subtitle fw-bold">Business Name</label>
                                        </div>            
                                        <div class="col-12 col-md-6">
                                            <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->business_name) ? $profile_info->business_name : '---'; ?></label>
                                        </div>
                                    <?php } ?>
                                    <?php if($companyId == 1): ?>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Industry Type</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= $industryType ? $industryType->name : 'Not Specified'; ?></label>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">First Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->first_name) ? $profile_info->first_name : 'n/a'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Middle Initial</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->middle_name) ? strtoupper($profile_info->middle_name) : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Last Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->last_name) ? $profile_info->last_name : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Name Prefix</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->prefix) ? $profile_info->prefix : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Suffix</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->suffix) ? $profile_info->suffix : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Address</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->mail_add) ? $profile_info->mail_add : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">County</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->county) ? $profile_info->county : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">City</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->city) ? $profile_info->city : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">State</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->state) ? $profile_info->state : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Zip Code</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->zip_code) ? $profile_info->zip_code : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Cross Street</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->cross_street) ? $profile_info->cross_street : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">County</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->county) ? $profile_info->county : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Subdivision</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->subdivision) ? $profile_info->subdivision : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Social Security No.</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">
                                            <?php 
                                                if (logged("user_type") == 1){
                                                    $ssn = $profile_info->ssn;
                                                }else{
                                                    $ssn = maskString($profile_info->ssn);
                                                }

                                                echo $ssn;
                                            ?>
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Date Of Birth</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?php echo ($profile_info->date_of_birth) ? date_format(date_create($profile_info->date_of_birth), "M d, Y") : "&mdash;"; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Email</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->email) ? $profile_info->email : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Phone (H)</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_h) ? formatPhoneNumber($profile_info->phone_h) : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Phone (M)</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_m) ? formatPhoneNumber($profile_info->phone_m) : '---'; ?></label>
                                    </div>
                                </div>                                
                            </div>

                            <br />
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-fw bx-file'></i> Alarm Details</span>                           
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <hr>
                                <div class="row g-1 mb-5">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Monitoring ID</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != '0' ? $alarm_info->monitor_id : '---' ; } ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Panel Type</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle"><?= isset($alarm_info) ? $alarm_info->panel_type : "" ?></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Security Package</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">---</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Rate Plan</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">---</label>
                                    </div>
                                </div>                                        
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