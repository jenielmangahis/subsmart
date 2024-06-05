<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

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
                            Listing of customer subscriptions.
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="nsm-counter primary h-100 mb-2">
                                        <div class="row h-100">
                                            <div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
                                                <i class='bx bx-receipt'></i>
                                            </div>
                                            <div class="col-12 col-md-9 text-center text-md-start d-flex flex-column justify-content-center">
                                                <h2 id="total_this_year"><?= $subscriptionSummary->total_subscriptions; ?></h2>
                                                <span>TOTAL NUMBER</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="nsm-counter secondary h-100 mb-2">
                                        <div class="row h-100">
                                            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                                <i class='bx bx-receipt'></i>
                                            </div>
                                            <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                                <h2 id="total_this_year">$<?= number_format($subscriptionSummary->total_amount_subscriptions,2,'.',''); ?></h2>
                                                <span>TOTAL AMOUNT</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                Sort by Status: <span id="dropdown_active">All</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="status_all">All</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="status_active">Active</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="status_completed">Completed</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="subscription_container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        showSubscriptions('all');

        $("#status_all").on("click", function() {
            showSubscriptions('all');

            $("#dropdown_active").text("Active");
        });

        $("#status_active").on("click", function() {
            showSubscriptions('active');

            $("#dropdown_active").text("Active");
        });

        $("#status_completed").on("click", function() {
            showSubscriptions("completed");

            $("#dropdown_active").text("Completed");
        });

        $("#status_biller").on("click", function() {
            showSubscriptions("biller_errors");

            $("#dropdown_active").text("Biller Errors");
        });

        $(document).on("click", ".view-payment-item", function() {
            let customer_id = $(this).attr("data-customer-id");
            let billing_id = $(this).attr("data-billing-id");
            let url = "<?php echo base_url(); ?>customer/_load_subscription_payment_history";
            showLoader($("#payment_history_container"));
            $("#payment_history_modal").modal('show');

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    customer_id: customer_id,
                    billing_id: billing_id
                },
                success: function(result) {
                    $("#payment_history_container").html(result);
                },
            });
        });

        $(document).on("click", ".fix-item", function() {
            let billing_id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>customer/_load_billing_credit_card_details";

            $("#bid").val(billing_id);
            showLoader($("#card_details"));
            $("#edit_cc_modal").modal('show');

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    billing_id: billing_id
                },
                success: function(result) {
                    $("#card_details").html(result);
                },
            });
        });

        $("#update_cc_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/_update_billing_credit_card_details";
            _this.find("button[type=submit]").html("Updating");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: $("#update_cc_form").serialize(),
                success: function(result) {
                    if(result.is_success == 1){
                        $("#edit_cc_modal").modal('show');
                        
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your billing credit card info was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                showSubscriptions("biller_errors");
                            }
                        });
                    }
                    else{
                        Swal.fire({
                            title: 'Cannot update billing',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    
                    _this.find("button[type=submit]").html("Update");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });

    function showSubscriptions(status = "active") {
        switch (status) {
            case "completed":
                url = "<?php echo base_url(); ?>customer/_load_completed_subscriptions";
                break;
            case "biller_errors":
                url = "<?php echo base_url(); ?>customer/_load_billing_error_subscriptions";
                break;
                case "active":
                url = "<?php echo base_url(); ?>customer/_load_active_subscriptions";
                break;
            default:
                url = "<?php echo base_url(); ?>customer/_load_all_subscriptions";
        }

        showLoader($("#subscription_container"));
        $.ajax({
            type: 'POST',
            url: url,
            success: function(result) {
                $("#subscription_container").html(result);
                $(".nsm-table").nsmPagination();
            },
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>