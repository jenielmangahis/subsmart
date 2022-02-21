<div id="customer_receive_payment_modal">
    <div class="customer_receive_payment_modal_content">
        <form action="#" method="POST" id="receive_payment_form">
            <input type="text" name="invoice_count" style="display: none;">
            <input type="text" name="submit_option" style="display: none;">
            <input type="text" name="receive_payment_id" style="display:none;">
            <div class="customer_receive_payment_modal_header">
                <div class="tittle">
                    <i class="fa fa-history" aria-hidden="true"></i> Receive Payment <span></span>
                </div>
                <div class="close-btn">
                    <img src="<?=base_url('assets/img/accounting/customers/close.png')?>"
                        alt="" style="width: 100px;">
                </div>
            </div>
            <div class="customer_receive_payment_modal_body overflow-auto">

                <div class="payment-field-part">
                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-5 no-padding">
                                    <div class="form-group">
                                        <div class="label">Customer</div>
                                        <select class="form-control required" name="customer_id" required>
                                            <option></option>
                                            <?php $customers= $this->accounting_customers_model->getAllByCompany();
                                            if ($customers != null) {
                                                foreach ($customers as $cus) {
                                                    echo '<option value="'.$cus->prof_id.'">'.$cus->first_name .' '.  $cus->middle_name .' '. $cus->last_name.'</option>';
                                                }
                                            }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 no-padding">
                                    <div class="find-by-invoice-no-section">
                                        <div class="form-group">
                                            <div class="label"><br></div>
                                            <button href="#" class="find-by-invoice-no">Find by invoice no.</button>
                                            <div class="bottom-label">Don't have an invoice? <a href="">Create a new
                                                    sale</a> </div>
                                        </div>
                                        <div class="find-by-invoice-no-panel">
                                            <img src="<?=base_url("assets/img/accounting/customers/anchor.png")?>"
                                                class="filter-panel-anchor" alt="">
                                            <label for="find-by-invoice-no"> Invoice no.</label>
                                            <input type="text" name="find-by-invoice-no"
                                                placeholder="Find by invoice no.">
                                            <label class="error">Invoice not found.</label>
                                            <div class="buttons">
                                                <button href=""
                                                    class="default-button float-left cancel-btn">Cancel</button>
                                                <button href=""
                                                    class="success-button float-right find-btn">Find</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-12 no-padding">
                                    <div class="total-receive-payment">
                                        <div class="label">AMOUNT RECEIVED</div>
                                        <div class="amount">$3,740.68</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 0!important;">
                                        <div class="label">Payment date</div>
                                        <input type="text" class="datepicker required" name="payment_date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Payment method</div>
                                        <select class="form-control required" id="payment_method" name="payment_method"
                                            required>
                                            <option value="" disabled selected>Choose a payment method</option>
                                            <?php 
                                            foreach($payment_methods as $option){
                                                echo '<option value="'.$option->name.'">'.$option->name.'</option>';
                                            }
                                            ?>
                                            <!-- <option value="Cash">Cash</option>
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
                                            <option value="Other Payment Type">Other Payment Type</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Reference no.</div>
                                        <input type="text" class="required" name="ref_no" required>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Deposit to</div><select class="form-control required"
                                            name="deposite_to" required>
                                            <option value="" disabled selected></option>
                                            <?php 
                                            foreach($deposits_to as $option){
                                                echo '<option value="'.$option->id.'">'.$option->name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-4 no-padding">

                                </div>
                                <div class="col-md-4 no-padding">

                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label text-right">Amount received</div>
                                        <input type="text" class="text-right required" name="amount_received" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6">
                            <div class="payment_method_information">
                                <div id="check_area" style="display:none;">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="job_type">Check Number</label>
                                            <input type="text" class="form-control" name="check_number"
                                                id="check_number" />
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
                                                <input type="radio" name="card[radio_credit_card]" value="Discover"
                                                    <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Discover') ? 'checked' : '' ?>
                                                id="radio_credit_cardMasterDiscover">
                                                <label
                                                    for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="job_type">Credit Card Number</label>
                                            <input type="text" class="form-control" name="credit_number"
                                                id="credit_number" placeholder="0000 0000 0000 000" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="job_type">Credit Card Expiration</label>
                                            <input type="text" class="form-control" name="credit_expiry"
                                                id="credit_expiry" placeholder="MM/YYYY" />
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
                                            <input type="text" class="form-control" name="mail-address"
                                                id="mail-address" placeholder="Monitored Location" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="mail_locality"
                                                id="mail_locality" placeholder="Enter Name" />
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
                                            <input type="text" id="mail_postcode" name="mail_postcode"
                                                class="form-control" placeholder="Enter Zip" />
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
                                            <input type="text" class="form-control" name="debit_credit_cvc"
                                                id="credit_cvc" placeholder="CVC" />
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
                                            <input type="text" class="form-control" name="account_note"
                                                id="account_note" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="job_type">Confirmation</label>
                                            <input type="text" class="form-control" name="confirmation"
                                                id="confirmation" />
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
                                            <input type="text" class="form-control"
                                                name="other_payment_account_credentials"
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
                        </div>
                    </div>
                </div>
                <div class="invoicing-part">
                    <div class="invoices">
                        <div class="outstanding-transactions">
                            <div class="title">Outstanding Transactions</div>
                            <div class="filter">
                                <div class="row no-margin">
                                    <div class="col-md-6 no-padding">
                                        <div class="row no-margin">
                                            <div class="col-md-5 no-padding">
                                                <div class="form-group">
                                                    <input type="text" class="" name="invoice_number"
                                                        placeholder="Find invoice no.">
                                                </div>
                                            </div>
                                            <div class="col-md-5 no-padding">
                                                <div class="form-group">
                                                    <button href="#" class="find-by-invoice-no">
                                                        Filter
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="filter-panel">
                                                        <img src="<?=base_url("/assets/img/accounting/customers/anchor.png")?>"
                                                            class="filter-panel-anchor" alt="">
                                                        <div class="date-filter">
                                                            <div class="date-from">
                                                                <div class="label">Invoice from</div>
                                                                <input type="text" class="datepicker"
                                                                    name="filter_date_from">
                                                            </div>
                                                            <div class="date-to">
                                                                <div class="label">To</div>
                                                                <input type="text" class="datepicker"
                                                                    name="filter_date_to">
                                                            </div>
                                                        </div>

                                                        <div class="checkbox-filter">
                                                            <input type="checkbox" name="filter_overdue"> Overdue
                                                            invoices
                                                            only
                                                        </div>
                                                        <div class="buttons">
                                                            <button href=""
                                                                class="default-button float-left cancel-btn">Cancel</button>
                                                            <button href=""
                                                                class="success-button float-right apply-btn">Apply</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 no-padding">
                                        <div class="row no-margin">
                                            <div class="col-md-12 no-padding text-right">
                                                <a href="" class="settings"><i class="fa fa-cog"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="customer-table-part">
                                <table id="customer_invoice_table" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <input type="checkbox" name="checkbox-all-action"
                                                    id="checkbox-all-action">
                                            </th>
                                            <th>DESCRIPTION</th>
                                            <th>DUE DATE</th>
                                            <th class="text-right">ORIGINAL AMOUNT</th>
                                            <th class="text-right">OPEN BALANCE</th>
                                            <th class="text-right">PAYMENT</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <!-- <tr>
											<td><input type="checkbox"></td>
											<td>John Meyer</td>
											<td>1234567890</td>
											<td>$32</td>
											<td><a href="">View</a></td>
										</tr> -->
                                        <?php $counter =0;
                            foreach ($customers as $cus) :
                                $receive_payment=$this->accounting_invoices_model->getCustomers_receive_payment($cus->prof_id);
                                $amount =0.00;
                                $first_option ="Create invoice";
                                foreach ($receive_payment as $payment) {
                                    $amount += $payment->amount;
                                    $first_option = "Receive rayment";
                                }
                                 ?>
                                        <tr>
                                            <td class="center" style="width: 0;"><input type="checkbox"
                                                    name="checkbox<?=$counter?>">
                                            </td>
                                            <td><?php echo $cus->first_name .' '.  $cus->middle_name .' '. $cus->last_name ?>
                                            </td>
                                            <td>
                                            </td>
                                            <td class="text-right"><?php echo "$".number_format($amount, 2);?>
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="" name="">
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $counter++; endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="total-amount text-right">
                                    <div class="amount-to-apply">
                                        <label class="label">Amount to Apply</label>
                                        <label class="amount">$422.00</label>
                                    </div>
                                    <div class="amount-to-credit">
                                        <label class="label">Amount to Credit</label>
                                        <label class="amount">$0.00</label>
                                    </div>
                                    <button type="button" class="default-button clear-payment">Clear Payment</button>
                                </div>
                            </div>
                        </div>
                        <div class="proof-part">
                            <div class="row no-margin">
                                <div class="col-md-6 no-padding">
                                    <div class="row no-margin">
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group" style="margin-bottom: 5px!important;">
                                                <div class="label">Memo</div>
                                                <textarea name="memo"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-margin">
                                        <div class="col-md-12 no-padding">
                                            <div class="attachement-file-section">
                                                <div class="label">
                                                    <i class="fa fa-paperclip" aria-hidden="true"></i> Attachement
                                                </div>
                                                <button type="button" class="attachment-btn">
                                                    <i class="fa fa-upload" aria-hidden="true"></i> Upload
                                                </button>
                                                <input type="file" class="form-control" name="attachment-file" multiple>
                                                <div class="attachement-viewer">
                                                </div>
                                                <input type="text" name="attachement-filenames" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="customer_receive_payment_modal_footer">
                <div class="row no-margin">
                    <div class="col-md-4 no-padding">
                        <button href="#" class="left-btn close-btn">Cancel</button>
                        <button href="#" class="left-btn clear-btn">Clear</button>
                    </div>
                    <div class="col-md-4 no-padding text-center center-options">
                        <button type="submit" data-action="print" class="btn-print">Print</button>
                        <button type="button" class="btn-more">More</button>
                        <div class="more-sub-option">
                            <ul>
                                <li data-option-type="void">
                                    Void
                                </li>
                                <li data-option-type="delete">
                                    Delete
                                </li>
                                <li data-option-type="transaction-journal">
                                    Transactionjournal
                                </li>
                                <li data-option-type="audit-history">
                                    AuditHistory
                                </li>
                            </ul>
                            <div class="more-anchor">
                                <img src="<?=base_url("assets/img/accounting/customers/anchor_down.png")?>"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 no-padding text-right">
                        <div class="right-option">
                            <div class="sub-option">
                                <ul>
                                    <li><button type="submit" data-action="save" data-submit-type="save-close">Save and
                                            close</button></li>
                                    <li><button type="submit" data-action="save" data-submit-type="save-send">Save and
                                            send</button></li>
                                </ul>
                            </div>
                            <button type="submit" class="btn-save-new" data-action="save"
                                data-submit-type="save-new">Save and new</button>
                            <button href="#" class="btn-save-dropdown">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>&nbsp;
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="loader-modal" style="display: none;">
    <div class="loader-modal-content">
        <img src="<?=base_url("assets/img/accounting/customers/loader.gif")?>"
            alt="">
    </div>
</div>