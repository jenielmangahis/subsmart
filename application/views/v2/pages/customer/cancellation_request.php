<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_customer_status_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/customer_settings_tabs'); ?>
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
                                    <div class="form-check" style="float:right;">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_collection" id="chk-collection">
                                        <label class="form-check-label" for="chk-collection">
                                            Collection
                                        </label>
                                    </div>                            
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
                                        <label class="content-subtitle"><?php echo number_format($cancel_request_data->boc_amount,2); ?></label>
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

                            <div id="cust-collection-req-container" class="cust-collection-req-container" style="">
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
        $(".nsm-table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));  

        $("#new_customer_status_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "customers/_create_customer_status";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType:'json',
                success: function(result) {
                    if (result.is_success === 1) {
                        $("#new_customer_status_modal").modal('hide');
                        _this.trigger("reset");
                        
                        Swal.fire({
                            title: 'Customer Status',
                            text: "New customer status has been created successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: result.msg
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
\
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>