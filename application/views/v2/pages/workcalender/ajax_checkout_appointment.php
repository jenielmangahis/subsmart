<style>
    .payment-gateway-item:hover {
        border-color: #6a4a86 !important;
        cursor: pointer;
    }
</style>

<?php if ($appointment) { ?>
    <?php
    $c_phone = "unknown";
    $c_email = "unknown";

    if ($appointment->customer_phone != '') {
        $a_phone = $appointment->customer_phone;
    }

    if ($appointment->customer_email != '') {
        $c_email = $appointment->customer_email;
    }

    $u_mobile = "unknown";
    $u_email  = "unknown";

    if ($appointment->user_email != '') {
        $u_mobile = $appointment->user_email;
    }

    if ($appointment->user_mobile != '') {
        $u_email = $appointment->user_mobile;
    }
    ?>

    <div class="col-12 col-md-8">
        <div class="nsm-card" id="checkout_step_1">
            <div class="nsm-card-header">
                <div class="nsm-card-title">
                    <span>Appointment Details</span>
                </div>
            </div>
            <div class="nsm-card-content">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Customer</label>
                        <label class="content-subtitle fw-bold"><?= $appointment->customer_name; ?></label>
                        <label class="content-subtitle d-block"><span class="fw-bold">Phone:</span> <?= $c_phone; ?></label>
                        <label class="content-subtitle d-block"><span class="fw-bold">Email:</span> <?= $c_email; ?></label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold d-block mb-2">Employee</label>
                        <div class="d-flex align-items-center">
                            <div class="nsm-profile me-3" style="background-image: url('<?= userProfileImage($appointment->user_id); ?>'); width: 40px;"></div>
                            <div class="w-100">
                                <label class="content-subtitle fw-bold"><?= $appointment->employee_name; ?></label>
                                <label class="content-subtitle d-block"><span class="fw-bold">Phone:</span> <?= $u_mobile; ?></label>
                                <label class="content-subtitle d-block"><span class="fw-bold">Email:</span> <?= $u_email; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Date & Time</label>
                        <label class="content-subtitle d-block"><?= date("l, F d, Y", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?></label>
                        <label class="content-subtitle d-block"><?= date("g:i A", strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time)); ?></label>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Appointment Type</label>
                        <label class="content-subtitle d-block"><?= $appointment->appointment_type; ?></label>
                    </div>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="content-title">Items</label>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <button class="nsm-button btn-sm" id="btn_add_checkout_item">Add Item</button>
                    </div>
                    <div class="col-12">
                        <form id="frm-checkout-items" method="post">
                            <input type="hidden" name="aid" value="<?= $appointment->id; ?>">
                            <table class="nsm-table" id="checkout_items_table">
                                <thead>
                                    <tr>
                                        <td data-name="Item Name">Item Name</td>
                                        <td data-name="Item Price">Item Price</td>
                                        <td data-name="Quantity">Quantity</td>
                                        <td data-name="Tax (Percentage)">Tax (Percentage)</td>
                                        <td data-name="Discount">Discount</td>
                                        <td data-name="Manage"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_items = 0;
                                    $total_tax   = 0;
                                    $total_discount = 0;
                                    ?>
                                    <?php if ($appointmentItems) { ?>
                                        <?php
                                        $row = 1;
                                        foreach ($appointmentItems as $item) {
                                            $total_items += $item->item_price * $item->qty;
                                            $total_discount += $item->discount_amount;
                                            $total_tax += ($item->item_price * $item->qty) * ($item->tax_percentage / 100);
                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="text" name="item_name[]" class="nsm-field form-control" placeholder="Item Name" value="<?= $item->item_name; ?>" required>
                                                    <input type="hidden" name="item_id[]" class="nsm-field form-control" placeholder="Item ID" value="<?= $item->item_id; ?>" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="price[]" class="nsm-field form-control item-price" placeholder="Item Price" value="<?= number_format($item->item_price, 2); ?>" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="qty[]" class="nsm-field form-control item-qty" placeholder="Quantity" value="<?= number_format($item->qty, 0); ?>" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="tax[]" class="nsm-field form-control item-tax" placeholder="Tax Percentage" value="<?= number_format($item->tax_percentage, 2); ?>" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="discount[]" class="nsm-field form-control item-discount" placeholder="Item Discount" value="<?= number_format($item->discount_amount, 2); ?>" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="nsm-button btn-sm btn-delete-item">Remove</button>
                                                </td>
                                            </tr>
                                        <?php $row++;
                                        } ?>
                                    <?php } else { ?>
                                        <tr class="nsm-table-empty">
                                            <td colspan="6">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php $total_amount = ($total_items + $total_tax) - $total_discount; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="nsm-card" id="checkout_step_2" style="display: none;">
            <div class="nsm-card-header">
                <div class="nsm-card-title">
                    <span>Select Payment Gateway</span>
                </div>
            </div>
            <div class="nsm-card-content">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-card payment-gateway-item c-cash-logo">
                            <div class="nsm-card-content h-100 d-flex align-items-center">
                                <img class="w-100" src="<?php echo $url->assets ?>img/cashpayment.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card payment-gateway-item c-converge-logo">
                            <div class="nsm-card-content h-100 d-flex align-items-center">
                                <img class="w-100" src="<?php echo $url->assets ?>img/converge-logo.png">
                            </div>
                        </div>
                    </div>
                    <?php if ($onlinePaymentAccount) { ?>
                        <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>
                            <div class="col-12 col-md-3">
                                <form id="frm-paypal-payment" method="post">
                                    <input type="hidden" name="aid" id="checkout-aid" value="<?= $appointment->id; ?>">
                                    <input type="hidden" name="total_amount" id="appointment-total-amount" value="">
                                    <input type="hidden" id="customer-firstname" value="<?= $customer->first_name; ?>">
                                    <input type="hidden" id="customer-lastname" value="<?= $customer->last_name; ?>">
                                    <input type="hidden" id="customer-email" value="<?= $customer->email; ?>">
                                    <input type="hidden" id="payment-method" name="payment_gateway" value="paypal">
                                </form>
                                <div class="nsm-card payment-gateway-item">
                                    <div class="nsm-card-content h-100 d-flex align-items-center justify-content-center" id="paypal-button-container">
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card payment-gateway-item c-paypal-logo">
                                    <div class="nsm-card-content h-100 d-flex align-items-center">
                                        <img class="w-100" src="<?php echo $url->assets ?>img/a_paypal.jpg">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-12 col-md-3">
                            <div class="nsm-card payment-gateway-item c-paypal-logo">
                                <div class="nsm-card-content h-100 d-flex align-items-center">
                                    <img class="w-100" src="<?php echo $url->assets ?>img/a_paypal.jpg">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-12 col-md-3">
                        <form id="frm-stripe-payment" method="post">
                            <input type="hidden" name="aid" id="stripe-aid" value="<?= $appointment->id; ?>">
                            <input type="hidden" id="stripe-payment-method" name="payment_gateway" value="stripe">
                            <input type="hidden" name="total_amount" id="stripe-appointment-total-amount" value="">
                        </form>
                        <div class="nsm-card payment-gateway-item c-stripe-logo">
                            <div class="nsm-card-content h-100 d-flex align-items-center">
                                <img class="w-100" src="<?php echo $url->assets ?>img/stripe-logo.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nsm-card" id="converge_payment_form" style="display: none;">
            <div class="nsm-card-header">
                <div class="nsm-card-title">
                    <span>Converge Payment</span>
                </div>
            </div>
            <div class="nsm-card-content">
                <form id="frm-converge-payment">
                    <input type="hidden" id="converge-checkout-aid" name="converge_checkout_aid" value="<?= $appointment->id; ?>">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Card Number</label>
                            <input type="text" name="card_number" id="cardnumber" class="nsm-field form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Expiration</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <select name="exp_month" id="exp_month" class="nsm-field form-select" required>
                                        <option value="" selected disabled>Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <select name="exp_year" id="exp_year" class="nsm-field form-select" required>
                                        <option value="" selected disabled>Year</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="text" maxlength="3" name="cvc" id="cvc" class="nsm-field form-control" placeholder="CVC" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Total Amount</label>
                            <input type="text" name="converge_amount_receive" id="converge-amount-received" class="nsm-field form-control" value="<?= number_format($total_amount, 2); ?>" required>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="nsm-button mb-0 btn-select-gateway" data-type="converge">Select Different Payment Gateway</button>
                            <button type="submit" class="nsm-button mb-0 primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="nsm-card" id="cash_payment_form" style="display: none;">
            <div class="nsm-card-header">
                <div class="nsm-card-title">
                    <span>Cash Payment</span>
                </div>
            </div>
            <div class="nsm-card-content">
                <form id="frm-cash-payment">
                    <input type="hidden" id="cash-checkout-aid" name="cash_checkout_aid" value="<?= $appointment->id; ?>">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Amount Received</label>
                            <input type="text" name="cash_amount_receive" id="cash-amount-received" class="nsm-field form-control" value="<?= number_format($total_amount, 2); ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Date Received</label>
                            <input type="text" name="cash_date_received" id="cash-date-received" class="nsm-field form-control datepicker" value="<?= date("m/d/Y"); ?>" required>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="nsm-button mb-0 btn-select-gateway" data-type="cash">Select Different Payment Gateway</button>
                            <button type="submit" class="nsm-button mb-0 primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="nsm-card">
            <div class="nsm-card-header">
                <div class="nsm-card-title">
                    <span>Order Summary</span>
                </div>
            </div>
            <div class="nsm-card-content">
                <div class="row h-100">
                    <div class="col-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="px-0 py-1">
                                        <label class="content-subtitle fw-bold">Items</label>
                                    </td>
                                    <td class="px-0 py-1 text-end">
                                        <label class="content-subtitle">$<span class="c-total-price"><?= number_format($total_items, 2); ?></span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">
                                        <label class="content-subtitle fw-bold">Discount</label>
                                    </td>
                                    <td class="px-0 py-1 text-end">
                                        <label class="content-subtitle">$<span class="c-total-discount"><?= number_format($total_discount, 2); ?></span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">
                                        <label class="content-subtitle fw-bold">Tax</label>
                                    </td>
                                    <td class="px-0 py-1 text-end">
                                        <label class="content-subtitle">$<span class="c-total-tax"><?= number_format($total_tax, 2); ?></span></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">
                                        <label class="content-subtitle fw-bold">Total</label>
                                    </td>
                                    <td class="px-0 py-1 text-end">
                                        <label class="content-subtitle">$<span class="c-total-amount"><?= number_format($total_amount, 2); ?></span></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-end d-flex align-items-end">
                        <button class="nsm-button primary w-100 mb-0" id="btn_checkout_payment">Proceed to Payment</button>
                        <button class="nsm-button w-100 mb-0" id="btn_checkout_back" style="display: none;">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-12">
        <div class="nsm-empty">
            <span>Appointment not found.</span>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btn_add_checkout_item").on("click", function() {
            let url = "<?php echo base_url('calendar/_load_item_list'); ?>";;

            showLoader($("#checkoout_items_container"));
            $("#checkout_add_item_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    $("#checkoout_items_container").html(result);
                }
            });
        });

        $(document).on("click", '.btn-delete-item', function() {
            let _this = $(this);
            let _tbody = $(this).closest("tbody");

            $(this).parents('tr').fadeOut("normal", function() {
                $(this).remove();
                computeCheckoutTotals();

                if (_tbody.find("tr").length == 1) {
                    _tbody.find(".nsm-table-empty").removeClass("d-none");
                }
            });
        });

        $(document).on('keypress', '.item-price', function(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else if (key < 48 || key > 57) {
                return false;
            } else {
                return true;
            }
        });

        $(document).on('keyup', '.item-price', function(event) {
            computeCheckoutTotals();
        });

        $(document).on('keypress', '.item-discount', function(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else if (key < 48 || key > 57) {
                return false;
            } else {
                return true;
            }
        });

        $(document).on('keyup', '.item-discount', function(event) {
            computeCheckoutTotals();
        });

        $(document).on('keypress', '.item-tax', function(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else if (key < 48 || key > 57) {
                return false;
            } else {
                return true;
            }
        });

        $(document).on('keyup', '.item-tax', function(event) {
            computeCheckoutTotals();
        });

        $(document).on('keypress', '.item-qty', function(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else if (key < 48 || key > 57) {
                return false;
            } else {
                return true;
            }
        });

        $(document).on('keyup', '.item-qty', function(event) {
            computeCheckoutTotals();
        });

        $("#btn_checkout_payment").on("click", function() {
            let _this = $(this);
            let _form = $("#frm-checkout-items");

            var url = "<?php echo base_url('calendar/_save_checkout_items'); ?>";
            _this.html("Please Wait");
            _this.prop("disabled", true);
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: $("#frm-checkout-items").serialize(),
                success: function(result) {
                    if (result.is_success) {
                        $("#btn_checkout_payment").fadeOut(function() {
                            $("#btn_checkout_back").fadeIn();
                        });
                        $("#checkout_step_1").fadeOut(function() {
                            $("#checkout_step_2").fadeIn();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: "Cannot proceed to payment",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.html("Proceed to Payment");
                    _this.prop("disabled", false);
                },
            });
        });

        $(".btn-select-gateway").on("click", function() {
            var payment_type = $(this).attr("data-type");
            $("#" + payment_type + "_payment_form").fadeOut(function() {
                $("#checkout_step_2").fadeIn();
            });
        });

        $(".c-converge-logo").on("click", function() {
            $("#checkout_step_2").fadeOut(function() {
                $("#converge_payment_form").fadeIn();
            });
        });

        $(".c-cash-logo").on("click", function() {
            $("#checkout_step_2").fadeOut(function() {
                $("#cash_payment_form").fadeIn();
            });
        });

        $("#btn_checkout_back").on("click", function() {
            $("#checkout_step_2").fadeOut(function() {
                $("#checkout_step_1").fadeIn();
            });
            $("#btn_checkout_back").fadeOut(function() {
                $("#btn_checkout_payment").fadeIn();
            });
            $("#cash_payment_form").hide();            
            $("#converge_payment_form").hide();            
        });

        $(document).on("submit", "#frm-cash-payment", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('calendar/_appointment_cash_checkout'); ?>";
            _this.find("button[type=submit]").html("Submitting");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Appointment was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                reloadCalendar()
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
                    $("#checkout_appointment_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("submit", "#frm-converge-payment", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('calendar/_appointment_converge_checkout'); ?>";
            _this.find("button[type=submit]").html("Submitting");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Appointment was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                reloadCalendar()
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
                    $("#checkout_appointment_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>
            // Render the PayPal button into #paypal-button-container
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    tagline: false,
                    //height:200,
                    size: 'large',
                    shape: 'rect',
                    color: 'blue'
                },
                // Set up the transaction
                createOrder: function(data, actions) {
                    return actions.order.create({
                        payer: {
                            name: {
                                given_name: $("#customer-firstname").val() + " " + $("#customer-lastname").val()
                            },
                            email_address: $("#customer-email").val(),
                        },
                        purchase_units: [{
                            amount: {
                                value: $("#appointment-total-amount").val()
                            }
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                // Finalize the transaction
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Show a success message to the buyer
                        $("#payment-method").val('paypal');
                        onlinepayment_set_appointment_paid('paypal', 'frm-paypal-payment');
                    });
                }
            }).render('#paypal-button-container');
        <?php } ?>
        //End Paypal

        //Stripe
        <?php if ($onlinePaymentAccount->stripe_publish_key != '') { ?>
            var handler = StripeCheckout.configure({
                key: '<?= $onlinePaymentAccount->stripe_publish_key; ?>',
                theme: 'night',
                image: '',
                token: function(token) {
                    $("#stripe-payment-method").val('stripe');
                    onlinepayment_set_appointment_paid('stripe', 'frm-stripe-payment');
                }
            });

            $('.c-stripe-logo').on('click', function(e) {
                var amountInCents = Math.floor($("#stripe-appointment-total-amount").val() * 100);
                var displayAmount = parseFloat(Math.floor($("#stripe-appointment-total-amount").val() * 100) / 100).toFixed(2);
                // Open Checkout with further options
                handler.open({
                    name: '<?= $company->business_name; ?>',
                    description: 'Service amount ($' + displayAmount + ')',
                    amount: amountInCents,
                });
                e.preventDefault();
            });
            // Close Checkout on page navigation
            $(window).on('popstate', function() {
                handler.close();
            });
        <?php } else { ?>
            $(".c-stripe-logo").click(function() {
                Swal.fire({
                    title: 'Cannot find your stripe credentials',
                    text: "Please set your stripe credentials via our api connectors.",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.value) {
                        location.href = base_url + "/tools/api_connectors";
                    }
                });
            });
        <?php } ?>
        //End Stripe

        computeCheckoutTotals();
    });
</script>