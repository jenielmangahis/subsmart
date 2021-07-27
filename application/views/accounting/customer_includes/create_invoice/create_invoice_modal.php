<div class="full-screen-modal">
    <div id="create_invoice_modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Estimate <span class="estimate_number"></span>
                    </div>
                    <button type="button" class="close" id="closeModalExpense" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form
                    action="<?php echo site_url()?>accounting/addSalesReceipt"
                    method="post">
                    <input type="text" style="display: none;" value="" name="recurring_selected">
                    <input type="text" style="display: none;" value="" name="current_sales_recept_number">
                    <input type="text" style="display: none;" value="" name="submit_type">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="recurring-form-part">
                                    <div class="recurring-title">Recurring Estimate</div>
                                    <div class="row no-margin">
                                        <div class="col-md-12 no-padding">
                                            <div class="row no-margin">
                                                <div class="col-md-3  no-padding">
                                                    Template name
                                                    <input type="text" class="form-control"
                                                        name="recurring-template-name">
                                                </div>
                                                <div class="col-md-9">
                                                    <div>Type</div>
                                                    <div class="recurring-type">
                                                        <select class="form-control" name="recurring-type">
                                                            <option>Schedule</option>
                                                            <option>Reminder</option>
                                                            <option>Unschedule</option>
                                                        </select>
                                                    </div>
                                                    <div class="schedule-type">
                                                        <div class="recuring-label-type">
                                                            Create
                                                        </div>
                                                        <div class="recurring-days-in-advance">
                                                            <input type="number" class="form-control"
                                                                name="recurring-days-in-advance">
                                                        </div>
                                                        <div class="recuring-label-recurring-days-in-advance">
                                                            days in advance
                                                        </div>
                                                    </div>
                                                    <div class="reminder-type" style="display: none;">
                                                        <div class="label-1">
                                                            Remind
                                                        </div>
                                                        <div class="remind-days-before">
                                                            <input type="number" class="form-control"
                                                                name="remind-days-before">
                                                        </div>
                                                        <div class="label-2">
                                                            days before the transaction date
                                                        </div>
                                                    </div>

                                                    <div class="unschedule-type" style="display: none;">
                                                        <div class="label-1">
                                                            Unscheduled transactions don’t have timetables; you use them
                                                            as needed from the Recurring Transactions list.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="customer-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3 divided">
                                            Customer
                                            <select class="form-control required" required name="customer_id"
                                                id="sel-customer2">
                                                <option></option>
                                                <?php foreach ($customers as $customer) : ?>
                                                <option
                                                    value="<?php echo $customer->prof_id; ?>"
                                                    data-text="<?php echo $customer->first_name . ' ' . $customer->last_name; ?>">
                                                    <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 divided">
                                            Email
                                            <input type="email" class="form-control required" required name="email"
                                                id="email2">
                                            <div style="margin-top:5px;"><input type="checkbox"> Send later</div>
                                        </div>

                                        <div class="col-md-3 option-part">
                                            <div class="recurring-form-part">
                                                <div class="label-1">Options</div>
                                                <div style="margin-top:5px;"><input type="checkbox"
                                                        name="recurring_option_1">
                                                    Automatically send emails</div>
                                                <div style="margin-top:5px;"><input type="checkbox"
                                                        name="recurring_option_2">
                                                    Print later</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recurring-form-part below">
                            <div class="row no-margin">
                                <div class="col-md-12 no-padding">
                                    <div class="row no-margin">
                                        <div class="col-md-1  no-padding padding-tb-10">
                                            Interval
                                            <select class="form-control" name="recurring-interval">
                                                <option>Daily</option>
                                                <option>Weekly</option>
                                                <option>Monthly</option>
                                                <option>Yearly</option>
                                            </select>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="interval-part padding-tb-10">
                                                <div class="daily">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">every</div>
                                                    <div class="daily-days">
                                                        <input type="number" class="form-control" name="daily-days"
                                                            min="0">
                                                    </div>
                                                    <div class="label-2">day(s)</div>
                                                </div>
                                                <div class="weekly" style="display: none;">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">every</div>
                                                    <div class="weekly-every">
                                                        <input type="number" class="form-control" name="weekly-every"
                                                            min="0">
                                                    </div>
                                                    <div class="label-2">week(s) on</div>
                                                    <div class="weekly-weeks-on">
                                                        <select class="form-control" name="weekly-weeks-on">
                                                            <option>Monday</option>
                                                            <option>Tuesday</option>
                                                            <option>Wednesday</option>
                                                            <option>Thursday</option>
                                                            <option>Friday</option>
                                                            <option>Saturday</option>
                                                            <option>Sunday</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="yearly" style="display: none;">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">every</div>
                                                    <div class="yearly-month">
                                                        <select class="form-control" name="yearly-month">
                                                            <option>January</option>
                                                            <option>February</option>
                                                            <option>March</option>
                                                            <option>April</option>
                                                            <option>May</option>
                                                            <option>June</option>
                                                            <option>July</option>
                                                            <option>August</option>
                                                            <option>September</option>
                                                            <option>October</option>
                                                            <option>November</option>
                                                            <option>December</option>
                                                        </select>
                                                    </div>
                                                    <div class="yearly-day">
                                                        <select class="form-control" name="yearly-day">
                                                            <option>1st</option>
                                                            <option>2nd</option>
                                                            <option>3rd</option>
                                                            <option>4th</option>
                                                            <option>5th</option>
                                                            <option>6th</option>
                                                            <option>7th</option>
                                                            <option>8th</option>
                                                            <option>9th</option>
                                                            <option>10th</option>
                                                            <option>11th</option>
                                                            <option>12th</option>
                                                            <option>13th</option>
                                                            <option>14th</option>
                                                            <option>15th</option>
                                                            <option>16th</option>
                                                            <option>17th</option>
                                                            <option>18th</option>
                                                            <option>19th</option>
                                                            <option>20th</option>
                                                            <option>21st</option>
                                                            <option>22nd</option>
                                                            <option>23rd</option>
                                                            <option>24th</option>
                                                            <option>25th</option>
                                                            <option>26th</option>
                                                            <option>27th</option>
                                                            <option>28th</option>
                                                            <option>Last</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="monthly" style="display: none;">
                                                    <div class="label" style="color:transparent;">transparent
                                                    </div>
                                                    <div class="label-1">on</div>
                                                    <div class="monthly-day-of-week">
                                                        <select class="form-control" name="monthly-week-order">
                                                            <option>Day</option>
                                                            <option>First</option>
                                                            <option>Second</option>
                                                            <option>Second</option>
                                                            <option>Third</option>
                                                            <option>Forth</option>
                                                            <option>Last</option>
                                                        </select>
                                                    </div>
                                                    <div class="monthly-day">
                                                        <select class="form-control" name="monthly-day-of-the-week">
                                                            <option>Monday</option>
                                                            <option>Tuesday</option>
                                                            <option>Wednesday</option>
                                                            <option>Thursday</option>
                                                            <option>Friday</option>
                                                            <option>Saturday</option>
                                                            <option>Sunday</option>
                                                        </select>
                                                    </div>
                                                    <div class="label-2">of every</div>
                                                    <div class="monthly-months">
                                                        <input type="number" class="form-control" name="monthly-months"
                                                            min="0">
                                                    </div>
                                                    <div class="label-3">
                                                        months
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="date-part">
                                                <div class="input-field-1">
                                                    <div class="label">Start Date</div>
                                                    <input type="text" class="datepicker" name="recurring-start-date">
                                                </div>
                                                <div class="input-field-2">
                                                    <div class="label">End</div>
                                                    <select class="form-control" name="recurring-end-type">
                                                        <option>None</option>
                                                        <option>By</option>
                                                        <option>After</option>
                                                    </select>
                                                </div>
                                                <div class="input-field-3">
                                                    <div class="by-end-date" style="display: none;">
                                                        <div class="label">End Date</div>
                                                        <input type="text" class="datepicker" name="by-end-date">
                                                    </div>
                                                    <div class="after-occurrences" style="display: none;">
                                                        <div style="visibility: hidden;">End Date</div>
                                                        <input type="text" name="after-occurrences">
                                                        <div class="label">occurrences</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row error-message-section" style="display: none;">
                            <div class="col-md-12">
                                <div class="error-message">
                                    <h3 class="title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        Something's not quite right</h3>
                                    <label for="title">Please double check your data.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="margin-bottom: 5px!important;">
                                                    <div class="label">Billing address</div>
                                                    <textarea style="height:100px;width:100%;" name="billing_address"
                                                        id="billing_address2" class="required" required></textarea>
                                                </div>
                                                <div class="ship-to-btn">+Shipping to</div>
                                                <div class="ship-to-section">
                                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                                        <div class="label">Shipping to</div>
                                                        <textarea style="height:100px;width:100%;"
                                                            name="shipping_to"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group" style="margin-bottom: 5px!important;">
                                            <div class="label">Estimate date</div>
                                            <input type="date" class="form-control" name="estimate_date">
                                        </div>
                                        <div class="ship-to-section">
                                            <div class="form-group" style="margin-bottom: 5px!important;">
                                                <div class="label">Ship via</div>
                                                <input type="text" class="form-control" name="ship_via">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px!important;">
                                            <div class="label">P.O. Number</div>
                                            <input type="text" class="form-control" name="po_number">
                                            <label class="faded-info">Not printed on form</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 remove-padding-not-ship padding-top-70">
                                        <div class="ship-to-section">
                                            <div class="form-group" style="margin-bottom: 5px!important;">
                                                <div class="label">Expiration date</div>
                                                <input type="date" class="form-control" name="expiration_date">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 5px!important;">
                                                <div class="label">Shipping date</div>
                                                <input type="date" class="form-control" name="shipping_date">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 5px!important;">
                                            <div class="label">Sales Rep</div>
                                            <input type="text" class="form-control" name="sales_rep">
                                            <label class="faded-info">Not printed on form</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-70">
                                        <div class="ship-to-section">
                                            <div class="form-group" style="margin-bottom: 5px!important;">
                                                <div class="label">Tracking no.</div>
                                                <input type="text" class="form-control" name="tracking_no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment method<br>
                                        <!-- <select class="form-control" name="payment_method" id="payment_method">
                                        <option></option>
                                        <option value="0">Add New</option>
                                        <?php foreach ($paymethods as $paymethod) { ?>
                                        <option
                                            value="<?php echo $paymethod->payment_method_id ; ?>">
                                            <?php echo $paymethod->quick_name; ?>
                                        </option>
                                        <?php } ?>
                                        </select> -->
                                        <select name="payment_method" id="payment_method"
                                            class="form-control custom-select">
                                            <option value="">Choose method</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Check">Check</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Debit Card">Debit Card</option>
                                            <option value="ACH">ACH</option>
                                            <option value="Venmo">Venmo</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Square">Square</option>
                                            <option value="Invoicing">Invoicing</option>
                                            <option value="Warranty Work">Warranty Work</option>
                                            <option value="Home Owner Financing">Home Owner Financing</option>
                                            <option value="e-Transfer">e-Transfer</option>
                                            <option value="Other Credit Card Professor">Other Credit Card Professor
                                            </option>
                                            <option value="Other Payment Type">Other Payment Type</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Reference no.
                                        <input type="text" class="form-control" name="ref_number">
                                    </div>
                                    <div class="col-md-3">
                                        Deposit to
                                        <select class="form-control" name="deposit_to">
                                            <option></option>
                                            <option value="1">Cash on hand</option>
                                            <option value="2">A</option>
                                            <option value="3">B</option>
                                            <option value="4">C</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6" align="right">
                                <div class="label-grand_total_sr_t">AMOUNT</div>
                                <h2><span id="grand_total_sr_t">0.00</span></h2><br>
                                Location of sale<br>
                                <input type="text" class="form-control required" required style="width:300px;"
                                    name="location_scale">
                            </div>
                        </div>
                        <div class="col-md-6 payment_method_information">
                            <div id="check_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Check Number</label>
                                        <input type="text" class="form-control" name="check_number" id="check_number" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="routing_number"
                                            id="routing_number" />
                                    </div>
                                    <!-- </div>
                                        <div class="row"> -->
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="account_number"
                                            id="account_number" />
                                    </div>
                                </div>
                            </div>
                            <div id="credit_card" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        Credit Card Type:<br>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Visa" <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Visa') ? 'checked' : '' ?>
                                            id="radio_credit_card">
                                            <label for="radio_credit_card"><span>Visa</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Amex" <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Amex') ? 'checked' : '' ?>
                                            id="radio_credit_cardAmex">
                                            <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                                <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Mastercard') ? 'checked' : '' ?>
                                            id="radio_credit_cardMastercard">
                                            <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input type="radio" name="card[radio_credit_card]" value="Discover" <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Discover') ? 'checked' : '' ?>
                                            id="radio_credit_cardMasterDiscover">
                                            <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="credit_number" id="credit_number"
                                            placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="credit_expiry" id="credit_expiry"
                                            placeholder="MM/YYYY" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="credit_cvc" id="credit_cvc"
                                            placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div id="invoicing" style="display:none;">

                                <!-- <input type="checkbox" id="same_as"> <b>Same as above in Monitoring Address</b> <br> -->
                                <br>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="monitored_location">Mail Address</label>
                                        <input type="text" class="form-control" name="mail-address" id="mail-address"
                                            placeholder="Monitored Location" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="mail_locality" id="mail_locality"
                                            placeholder="Enter Name" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="mail_state" id="mail_state"
                                            placeholder="Enter State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="zip">ZIP</label>
                                        <input type="text" id="mail_postcode" name="mail_postcode" class="form-control"
                                            placeholder="Enter Zip" />
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="cross_street">Cross Street</label>
                                        <input type="text" class="form-control" name="mail_cross_street"
                                            id="mail_cross_street" placeholder="Cross Street" />
                                    </div>
                                </div>
                            </div>
                            <div id="debit_card" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="debit_credit_number"
                                            id="credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="debit_credit_expiry"
                                            id="credit_expiry" placeholder="MM/YYYY" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="debit_credit_cvc" id="credit_cvc"
                                            placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div id="ach_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="ach_routing_number"
                                            id="ach_routing_number" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="ach_account_number"
                                            id="ach_account_number" />
                                    </div>
                                </div>
                            </div>
                            <div id="venmo_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="account_credentials"
                                            id="account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="account_note" id="account_note" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="confirmation" id="confirmation" />
                                    </div>
                                </div>
                            </div>
                            <div id="paypal_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="paypal_account_credentials"
                                            id="paypal_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="paypal_account_note"
                                            id="paypal_account_note" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="paypal_confirmation"
                                            id="paypal_confirmation" />
                                    </div>
                                </div>
                            </div>
                            <div id="square_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="square_account_credentials"
                                            id="square_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="square_account_note"
                                            id="square_account_note" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="square_confirmation"
                                            id="square_confirmation" />
                                    </div>
                                </div>
                            </div>
                            <div id="warranty_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="warranty_account_credentials"
                                            id="warranty_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="warranty_account_note"
                                            id="warranty_account_note" />
                                    </div>
                                </div>
                            </div>
                            <div id="home_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="home_account_credentials"
                                            id="home_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="home_account_note"
                                            id="home_account_note" />
                                    </div>
                                </div>
                            </div>
                            <div id="e_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="e_account_credentials"
                                            id="e_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="e_account_note"
                                            id="e_account_note" />
                                    </div>
                                </div>
                            </div>
                            <div id="other_credit_card" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="other_credit_number"
                                            id="other_credit_number" placeholder="0000 0000 0000 000" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="other_credit_expiry"
                                            id="other_credit_expiry" placeholder="MM/YYYY" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="other_credit_cvc"
                                            id="other_credit_cvc" placeholder="CVC" />
                                    </div>
                                </div>
                            </div>
                            <div id="other_payment_area" style="display:none;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="other_payment_account_credentials"
                                            id="other_payment_account_credentials" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="other_payment_account_note"
                                            id="other_payment_account_note" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tags">
                                    <div class="form-group">
                                        <label for="job_type">Tags</label>
                                        <a href="#" class="manage-tags float-right">Manage Tags</a>
                                        <input type="text" class="form-control" name="tags">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="white-section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="items-section">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-right">#</th>
                                                <th>PRODUCT/SERVICE</th>
                                                <th>TYPE</th>
                                                <th width="150px" class="text-right">Quantity</th>
                                                <th width="150px" class="text-right">Price</th>
                                                <th width="150px" class="text-right">Discount</th>
                                                <th width="150px" class="text-right">Tax (Change in %)</th>
                                                <th style="text-align: right;">Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item">
                                                <td class="text-right">
                                                    1
                                                </td>
                                                <td>
                                                    <input type="text" style="display: none;" name="item_ids[]">
                                                    <input type="text" class="form-control required" required=""
                                                        name="items[]" autocomplete="off">
                                                    <ul class="suggestions"></ul>
                                                </td>
                                                <td><select name="item_type[]" class="form-control">
                                                        <option value="product">Product</option>
                                                        <option value="material">Material</option>
                                                        <option value="service">Service</option>
                                                        <option value="fee">Fee</option>
                                                    </select></td>
                                                <td width="150px"><input type="number"
                                                        class="form-control required item-field-monitary" required=""
                                                        name="quantity[]" data-counter="0" value="">
                                                </td>
                                                <td width="150px"><input type="number"
                                                        class="form-control required item-field-monitary" required=""
                                                        name="price[]" data-counter="0" min="0" value="">
                                                </td>
                                                <td width="150px"><input type="number"
                                                        class="form-control required item-field-monitary" required=""
                                                        name="discount[]" data-counter="0" min="0" value="">
                                                </td>
                                                <td width="150px"><input type="text" class="form-control"
                                                        data-itemfieldtype="tax" required="" name="tax[]"
                                                        data-type="tax" data-counter="0" min="0" value="">
                                                    <input type="text" class="tax-hide" name="tax_percent[]"
                                                        value="7.5">
                                                </td>
                                                <td width="150px" style="text-align: right;"><input type="hidden"
                                                        class="form-control total_per_input" name="total[]"
                                                        data-counter="0" min="0" value="0">
                                                    $<span class="total_per_item">0</span></td>
                                                <td class="item-action">
                                                    <a href="#" class="delete-item">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="subtotal">
                                                <td class="text-right">2</td>
                                                <td class="text-right" colspan="7">$9,899.19</td>
                                                <td class="item-action">
                                                    <a href="#" class="delete-item">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="item-buttons">
                                    <button type="button" class="default-button add-lines">
                                        Add lines
                                    </button>
                                    <button type="button" class="default-button clear-all-lines">
                                        Clear all lines
                                    </button>
                                    <button type="button" class="default-button clear-all-lines">
                                        Add subtotal
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="item-totals">
                                    <div class="label">
                                        <div for="">Subtotal</div>
                                        <div class="taxable-sub">Taxable Subtotal <span>$124.00</span> </div>
                                    </div>
                                    <div class="amount">
                                        <div for="">$124.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                Message displayed on estimate<br>
                                <textarea style="height:100px;width:100%;" name="message"></textarea><br><br>
                                Message displayed on statement<br>
                                <textarea style="height:80px;width:100%;" name="message_on_statement"
                                    placeholder="If you convert an estimate into an invoice and send a statement, this will show up as the description for the invoice."></textarea>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);"
                                            accept="image/*" />
                                        <div class="drag-text">
                                            <i>Drag and drop files here or click the icon</i>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded
                                                    File</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                    type="button">Cancel</button>
                                <button class="btn btn-dark cancel-button" id="cancel_recurring" type="button"
                                    style="display: none;">Cancel</button>
                                <button class="btn btn-dark cancel-button" id="clearsalereceipt"
                                    type="button">Clear</button>

                            </div>
                            <div class="col-md-5" align="center">
                                <div class="middle-links">
                                    <div class="pint-preview-option-section">
                                        <ul>
                                            <li>
                                                <a href="#" class="print-preview">Print or Preview </a>
                                            </li>
                                            <li>
                                                <a href="#" class="print-slip">Print packing slip</a>
                                            </li>
                                        </ul>
                                        <div class="anchor-holder">
                                            <img src="<?=base_url('assets/img/accounting/customers/anchor_down.png')?>"
                                                alt="">
                                        </div>
                                    </div>
                                    <a href="" class="print-preview-option">Print or Preview</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" data-submit-type="save"
                                        type="submit">Save</button>
                                    <button type="submit" data-submit-type="save-send" class="btn btn-success"
                                        id="checkSaved" style="border-radius: 20px 0 0 20px">Save and send</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span>&nbsp;</button>
                                    <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                        <li>
                                            <button type="submit" data-submit-type="save-close" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and close</button>
                                        </li>
                                        <li>
                                            <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and new</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg"
                            style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and
                        security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>