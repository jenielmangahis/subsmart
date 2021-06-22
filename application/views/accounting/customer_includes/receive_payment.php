<div id="customer_receive_payment_modal">
    <div class="customer_receive_payment_modal_content">
        <div class="customer_receive_payment_modal_header">
            <div class="tittle">
                <i class="fa fa-history" aria-hidden="true"></i> Receive Payment
            </div>
            <div class="close-btn">
                <img src="<?=base_url('assets/img/accounting/customers/close.png')?>"
                    alt="">
            </div>
        </div>
        <div class="customer_receive_payment_modal_body overflow-auto">
            <form action="" id="receive_payment_form">
                <div class="payment-field-part">
                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-5 no-padding">
                                    <div class="form-group">
                                        <div class="label">Customer</div>
                                        <select class="form-control" name="customer_id">
                                            <option></option>
                                            <?php foreach ($customers as $cus) {
    echo '<option value="'.$cus->prof_id.'">'.$cus->first_name .' '.  $cus->middle_name .' '. $cus->last_name.'</option>';
} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 no-padding">
                                    <div class="form-group">
                                        <div class="label"><br></div>
                                        <button href="#" class="find-by-invoice-no">Find by invoice no.</button>
                                        <div class="bottom-label">Don't have an invoice? <a href="">Create a new
                                                sale</a> </div>
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
                                        <input type="text" class="datepicker" name="payment_date">
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
                                        <select class="form-control" name="">
                                            <option disabled selected>Choose a payment method</option>
                                            <option value="4822">Add new</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Reference no.</div>
                                        <input type="text" class="" name="payment_date">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Deposit to</div><select class="form-control" name="">
                                            <option></option>
                                            <option value="4822">Cash on hand</option>
                                            <option value="4823">Cash</option>
                                            <option value="4823">Credit</option>
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
                                        <input type="text" class="text-right" name="amount_received">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoicing-part">
                    <div class="invoices">
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
                                                            <input type="text" class="datepicker" name="filter_from">
                                                        </div>
                                                        <div class="date-to">
                                                            <div class="label">To</div>
                                                            <input type="text" class="datepicker" name="filter_to">
                                                        </div>
                                                    </div>

                                                    <div class="checkbox-filter">
                                                        <input type="checkbox" name="overdue"> Overdue invoices only
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
                                            <a href="" class="settings"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="customer-table-part">
                            <table id="customer_invoice_table" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th class="center"><input type="checkbox" id="checkbox-all-action"></th>
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
                                    <label class="amount">$422.00</span>
                                </div>
                                <div class="amount-to-credit">
                                    <label class="label">Amount to Credit</label>
                                    <label class="amount">$0.00</label>
                                </div>
                                <button href="" class="default-button">Clear Payment</button>
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
                                                <div class="file-upload">
                                                    <button class="" type="button"
                                                        onclick="$('#customer_receive_payment_modal .file-upload-input').trigger( 'click' )">
                                                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attachments
                                                    </button> <label class="button-label" for="">Maximum size:
                                                        20MB</label>

                                                    <div class="image-upload-wrap">
                                                        <input class="file-upload-input" type='file'
                                                            onchange="readURL(this);" accept="image/*"
                                                            name="attachments" />
                                                        <div class="drag-text">
                                                            <i>Drag and drop files here or click the icon</i>
                                                        </div>
                                                    </div>
                                                    <div class="file-upload-content">
                                                        <img class="file-upload-image" src="#" alt="your image" />
                                                        <div class="image-title-wrap">
                                                            <button type="button" onclick="removeUpload()"
                                                                class="remove-image">Remove <span
                                                                    class="image-title">Uploaded File</span></button>
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
                </div>
            </form>
        </div>
        <div class="customer_receive_payment_modal_footer">
            <div class="row no-margin">
                <div class="col-md-4 no-padding">
                    <button href="#" class="left-btn">Cancel</button>
                    <button href="#" class="left-btn">Clear</button>
                </div>
                <div class="col-md-4 no-padding text-center">
                    <a href="#" class="btn-print">Print</a>
                </div>
                <div class="col-md-4 no-padding text-right">
                    <div class="right-option">
                        <div class="sub-option">
                            <ul>
                                <li><a href="">Save and close</a></li>
                                <li><a href="">Save and send</a></li>
                            </ul>
                        </div>
                        <button href="#" class="btn-save-new">Save and new</button>
                        <button href="#" class="btn-save-dropdown">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>