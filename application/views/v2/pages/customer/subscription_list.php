<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="row">
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
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                Sort by Status: <span id="dropdown_active">Active</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="status_active">Active</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="status_completed">Completed</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="status_biller">Biller Errors</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="subscription_container"></div>
                </div>
                <!-- <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="City">City</td>
                            <td data-name="State">State</td>
                            <td data-name="Assigned To">Assigned To</td>
                            <td data-name="Email">Email</td>
                            <td data-name="SSS Number">SSS Number</td>
                            <td data-name="Phone">Phone</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($leads)) :
                        ?>
                            <?php
                            foreach ($leads as $lead) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-chart'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $lead->firstname . ' ' . $lead->lastname; ?></td>
                                    <td><?= $lead->city ?></td>
                                    <td><?= $lead->state ?></td>
                                    <td><?= $lead->FName . ' ' . $lead->LName; ?></td>
                                    <td><?= $lead->email_add; ?></td>
                                    <td><?= $lead->sss_num; ?></td>
                                    <td><?= $lead->phone_cell; ?></td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?= $lead->status; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo url('/customer/add_lead/' . $lead->leads_id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo url('/customer/add_lead/' . $lead->leads_id); ?>">Send SMS</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="mailto:<?= $lead->email_add; ?>">Send Email</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $lead->leads_id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        showSubscriptions();

        $("#status_active").on("click", function() {
            showSubscriptions();

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
            default:
                url = "<?php echo base_url(); ?>customer/_load_active_subscriptions";
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