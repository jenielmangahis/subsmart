<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/mycrm/membership_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Company plan subscription.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <?php if( !in_array($client->id, exempted_company_ids()) ){ ?>
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">                                    
                                    <span><?= $client->is_trial == 1 ? 'Trial' : 'Paid'; ?> Membership</span>
                                    <?php if ($client->is_plan_active == 0 && !in_array($client->id, exempted_company_ids())) : ?>
                                        <label class="nsm-badge error">Expired</label>
                                    <?php endif; ?>
                                </div>
                                <div class="nsm-card-controls">
                                    <?php if ($client->is_plan_active == 1 || in_array($client->id, exempted_company_ids())) : ?>
                                        <button type="button" class="nsm-button primary"  data-bs-toggle="modal" data-bs-target="#upgrade_plan_modal">
                                            <i class='bx bx-fw bx-list-check'></i> Upgrade Plan
                                        </button>
                                    <?php endif; ?>

                                    <button type="button" class="nsm-button primary btn-pay-subscription">
                                        <i class='bx bx-fw bx-purchase-tag'></i>
                                        <?php if ($client->is_plan_active == 1) : ?>
                                            Pay Subscription
                                        <?php else : ?>
                                            <?php if( in_array($client->id, exempted_company_ids()) ){ ?>
                                                Pay Subscription
                                            <?php }else{ ?>
                                                Renew Subscription
                                            <?php } ?>                                            
                                        <?php endif; ?>
                                    </button>
                                </div>
                                <!-- <label class="nsm-subtitle">These are your current account options</label> -->
                            </div>
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-4" style="height: 150px;">
                                        <div class="nsm-counter primary h-100 mb-2">
                                            <div class="row h-100">
                                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                                    <i class="bx bx-calendar"></i>
                                                </div>
                                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                                    <label class="content-title">Total <?= $client->recurring_payment_type == 'monthly' ? 'Monthly' : 'Yearly'; ?></label>
                                                    <h2>$<?= number_format($total_membership_cost, 2); ?></h2>
                                                    <span>For 1 <?= $client->recurring_payment_type == 'month' ?: 'year'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4" style="height: 150px;">
                                        <div class="nsm-counter success h-100 mb-2">
                                            <div class="row h-100">
                                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                                    <i class="bx bx-user-pin"></i>
                                                </div>
                                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                                    <label class="content-title">Membership</label>
                                                    <h2>$<?= number_format($total_plan_cost, 2); ?></h2>
                                                    <span>For 1 <?= $client->recurring_payment_type == 'month' ?: 'year'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4" style="height: 150px;">
                                        <div class="nsm-counter h-100 mb-2">
                                            <div class="row h-100">
                                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                                    <i class="bx bx-extension"></i>
                                                </div>
                                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                                    <label class="content-title">Add-ons</label>
                                                    <h2>$<?= number_format($total_addon_price, 2); ?></h2>
                                                    <span>For 1 <?= $client->recurring_payment_type == 'month' ?: 'year'; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Current Plan</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Current Plan</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?php if( in_array($client->id, exempted_company_ids()) ){ ?>
                                                    Free
                                                <?php }else{ ?>
                                                    <?php if ($client->is_trial == 1) : ?>
                                                        (Trial) <?= $plan->plan_name; ?> ($<?= number_format($plan->price, 2); ?>)
                                                    <?php else : ?>
                                                        <?= $plan->plan_name; ?> ($<?= number_format($plan->price, 2); ?>)
                                                    <?php endif; ?>
                                                <?php } ?>                                                
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Number of License</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?= $client->number_of_license; ?> <button class="nsm-button btn-sm ms-3 btn-buy-license">Buy License</button>
                                            </div>
                                            <?php if ($client->payment_method == 'offer code') : ?>
                                                <div class="col-12 col-md-6">
                                                    <label class="content-title">Offer Code Used</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <?= $offerCode->offer_code; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Billing Cycle</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                1 <?= $client->recurring_payment_type == 'month' ? 'Monthly' : 'year'; ?>
                                            </div>
                                            <?php if( $client->recurring_payment_type == 'monthly' ){ ?>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Current Billing Period</label>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 col-md-6">
                                                <?= $start_billing_period; ?> to <?= $end_billing_period; ?>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">
                                                    <?php if ($client->is_trial == 1) : ?>
                                                        <strong>Trial Ends</strong>
                                                    <?php else : ?>
                                                        <strong>Next Bill Date</strong>
                                                    <?php endif; ?>
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?php $exempted_company_ids = exempted_company_ids(); ?>
                                                <?php if( in_array($client->id, $exempted_company_ids) ){ ?>
                                                    <span><b>Included in Exempted Companies - No renewal</b></span>
                                                <?php }else{ ?>
                                                    <?= date("d-M-Y", strtotime($client->next_billing_date)); ?>
                                                <?php } ?>
                                                
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Recurring Payments</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?php if ($client->is_auto_renew == 1) : ?>
                                                    Active <button class="nsm-button btn-sm ms-3 btn-deactivate-recurring">Deactivate</button>
                                                <?php else : ?>
                                                    Inactive <button class="nsm-button btn-sm ms-3 btn-activate-recurring">Activate</button>
                                                <?php endif; ?>
                                                <label class="d-block content-subtitle">Auto renew your subscription and charge your card at the end of the billing cycle.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">First Payment</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?php
                                                if ($client->is_trial == 1) :
                                                    echo "---";
                                                else :
                                                    echo date("m/d/Y", strtotime($firstPayment->payment_date));
                                                endif;
                                                ?>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Last Payment</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?php if ($client->is_trial == 1) : ?>
                                                    ---
                                                <?php else : ?>
                                                    $<?= number_format($lastPayment->total_amount, 2); ?>
                                                    on <?= date("m/d/Y", strtotime($lastPayment->payment_date)); ?>
                                                    <button class="nsm-button btn-sm ms-3" onclick="location.href='<?= base_url('mycrm/view_payment/' . $lastPayment->id); ?>'">View</button>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-title">Primary Card</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <?php if ($primaryCard) : ?>
                                                    <?php
                                                    $card_type = strtolower($primaryCard->cc_type);
                                                    $card_type = str_replace(" ", "", $card_type);
                                                    ?>
                                                    <span class="card-type <?= $card_type; ?>"></span>
                                                    <?php
                                                    $card_number = maskCreditCardNumber($primaryCard->card_number);
                                                    echo $card_number;
                                                    ?>
                                                    <?php
                                                    $today = date("y-m-d");
                                                    $day   = date("d");
                                                    $expires = date("y-m-d", strtotime($primaryCard->expiration_year . "-" . $primaryCard->expiration_month . "-" . $day));
                                                    $expired = 'expires';
                                                    if (strtotime($expires) < strtotime($today)) :
                                                        $expired = 'expired';
                                                    endif;

                                                    ?>
                                                    <span class="<?= $expired; ?>"> (<?= $expired; ?> <?= $primaryCard->expiration_month . "/" . $primaryCard->expiration_year; ?>)</span>
                                                <?php else : ?>
                                                    ---
                                                <?php endif; ?>
                                                <button class="nsm-button btn-sm ms-3" id="btn-manage-cards">Manage Card</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-12 col-md-6">
                        <label class="fw-bold fs-5">Available Add-ons</label>
                    </div>
                    <?php if(checkRoleCanAccessModule('monthly-membership', 'write')){ ?>
                    <div class="col-12 col-md-6 text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('more/upgrades'); ?>'">
                                <i class='bx bx-fw bx-extension'></i> Add More Add-ons
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Details">Details</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Price">Price</td>
                            <?php if(checkRoleCanAccessModule('monthly-membership', 'write')){ ?>
                            <td data-name="Manage"></td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($default_plan_feature as $value) : ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-extension'></i>
                                    </div>
                                </td>
                                <td class="nsm-text-primary"><?= $value; ?></td>
                                <td>Added</td>
                                <td>0.00</td>
                                <?php if(checkRoleCanAccessModule('monthly-membership', 'write')){ ?>
                                <td></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>

                        <?php foreach ($addons as $a) : ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-extension'></i>
                                    </div>
                                </td>
                                <td class="nsm-text-primary">
                                    <?php
                                    if ($a->with_request_removal == 1) :
                                        echo $a->name . " " . '<span class="nsm-badge error">Request Removal</span>';
                                    else :
                                        echo $a->name;
                                    endif;
                                    ?>
                                </td>
                                <td>Monthly (<?= $start_billing_period; ?> to <?= $end_billing_period; ?>)</td>
                                <td>$<?= number_format($a->service_fee, 2); ?></td>
                                <?php if(checkRoleCanAccessModule('monthly-membership', 'write')){ ?>
                                <td class="text-end">
                                    <?php if ($a->with_request_removal == 1) : ?>
                                        <button class="nsm-button btn-sm error btn-cancel-addon" data-id="<?= $a->id; ?>" data-name="<?= $a->name; ?>">Cancel Request</button>
                                    <?php else : ?>
                                        <button class="nsm-button btn-sm primary btn-remove-addon" data-id="<?= $a->id; ?>" data-name="<?= $a->name; ?>">Request Remove</button>
                                    <?php endif; ?>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $(".nsm-table").nsmPagination();
        
        $(".btn-activate-recurring").on("click", function() {
            updateRecurring();
        });

        $(".btn-deactivate-recurring").on("click", function() {
            updateRecurring(false);
        });

        $(".btn-buy-license").click(function(){
            $("#modal-buy-license").modal('show');
        });

        $(".btn-pay-subscription").click(function(){
            $("#modal-pay-subscription").modal('show');
        });

        $('#btn-manage-cards').on('click', function(){
            location.href = base_url + 'cards_file/list';
        });

        $("#frm-buy-license").submit(function(e){
            e.preventDefault();
            var url = base_url + 'mycrm/_buy_plan_license';
            $(".btn-modal-buy-license").html('<span class="spinner-border spinner-border-sm m-0"></span>');

            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: $("#frm-buy-license").serialize(),
                success: function(o)
                {
                    $("#modal-buy-license").modal('hide'); 
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Payment Successful!',
                            text: "Your plan license was successfully updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Cannot process payment',
                        text: o.message
                    });
                    }

                    $("#btn-buy-license").html('Buy');
                },
                beforeSend: function(){
                    $("#btn-buy-license").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $("#frm-upgrade-subscription").submit(function(e){
            e.preventDefault();
            var url = base_url + 'mycrm/_upgrade_subscription';
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: $("#frm-upgrade-subscription").serialize(),
                success: function(o)
                {
                    $("#modal-upgrade-plan").modal('hide'); 
                    $("#btn-modal-upgrade-plan").html('Upgrade');

                    if( o.is_success == 1 ){                        
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your plan was successfully upgraded",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot upgrade plan',
                            text: o.message
                        });
                    }
                },
                beforeSend: function(){
                    $("#btn-modal-upgrade-plan").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $("#frm-pay-subscription").submit(function(e){
            e.preventDefault();
            var url = base_url + 'mycrm/_pay_subscription';
            $("#btn-modal-pay-subscription").html('<span class="spinner-border spinner-border-sm m-0"></span>');

            $.ajax({
                type: "POST",
                url: base_url + 'mycrm/_pay_subscription',
                dataType: "json",
                data: $("#frm-pay-subscription").serialize(),
                success: function(o)
                {
                    $("#btn-modal-pay-subscription").html('Pay');
                    $("#modal-upgrade-plan").modal('hide'); 

                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Subscription Payment',
                            text: "Payment successful. Your subscription plan was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot process payment',
                            text: o.message
                        });
                    }
                },
                beforeSend: function(){
                    $("#btn-modal-pay-subscription").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                }
            });
        });

        <?php if(checkRoleCanAccessModule('monthly-membership', 'write')){ ?>
        $(document).on("click", ".btn-remove-addon", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr('data-name');
            let url = "<?php echo base_url('mycrm/_request_remove_addon'); ?>";

            Swal.fire({
                title: "Remove Add-On",
                html: `Removing addon will take affect on the next billing. Would you like to proceed removing <b>${name}</b> addon?`,
                icon: 'question',
                confirmButtonText: 'Confirm',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            addon_id: id
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: "Your request for removal of addon was successfully sent.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        }
                    });
                }
            });
        });
        <?php } ?>

        $(document).on("click", ".btn-cancel-addon", function() {
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url('mycrm/_cancel_remove_addon'); ?>";

            Swal.fire({
                title: "Cancel remove add-on",
                text: "Are you sure you want to proceed cancelling your request?",
                icon: 'question',
                confirmButtonText: 'Confirm',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            addon_id: id
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: "Your request for remove addon was successfully cancelled.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        }
                    });
                }
            });
        });
    });

    function updateRecurring(activate = true) {
        let url = "<?php echo base_url('mycrm/_update_auto_recurring'); ?>";
        let title = activate ? 'Turning Auto Renewal On' : 'Turning Auto Renewal Off';
        let text = activate ? "You are about to turn-on your plan auto-renewal." : "You are about to turn-off your plan auto-renewal.";

        Swal.fire({
            title: title,
            text: text,
            icon: 'info',
            confirmButtonText: 'Confirm',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        is_active: activate ? '1' : '0'
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.is_success) {
                            let message = activate ? "Auto recurring was successfully activated" : "Auto recurring was successfully deactivated";
                            Swal.fire({
                                title: 'Recurring Payments',
                                text: message,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });

                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Cannot update setting',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>