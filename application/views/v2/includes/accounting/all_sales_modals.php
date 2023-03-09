
<div class="modal fade nsm-modal" id="update-status-modal" tabindex="-1" aria-labelledby="update_status_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="update_status_modal_label">Update estimate status</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="update-estimate-status-form">
                <div class="modal-body">
                    <div class="row grid-mb">
                        <div class="col-12">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select nsm-field" required>
                                <option value="Draft">Draft</option>
                                <option value="Submitted">Submitted</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Declined By Customer">Declined By Customer</option>
                                <option value="Lost">Lost</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-sm-6">
                            <button type="button" class="nsm-button m-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="nsm-button success float-end m-0">OK</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_all_sales_transactions_modal" tabindex="-1" aria-labelledby="print_all_sales_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_all_sales_transactions_modal_label">Print All Sales Transactions List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <?php foreach($headers as $header) : ?>
                            <?php if($header !== 'Attachments') : ?>
                            <td data-name="<?=$header?>"><?=strtoupper($header)?></td>
                            <?php else : ?>
                            <td class="table-icon text-center" data-name="<?=$header?>"><i class="bx bx-paperclip"></i></td>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                            <?php foreach($transactions as $transaction) : ?>
                                <?php switch($type) {
                                case 'estimates' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['expiration_date']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['accepted_date']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'invoices' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['aging']?></td>
                                    <td><?=$transaction['balance']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'sales-receipts' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['method']?></td>
                                    <td><?=$transaction['source']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'credit-memos' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'unbilled-income' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['charges']?></td>
                                    <td><?=$transaction['time']?></td>
                                    <td><?=$transaction['expenses']?></td>
                                    <td><?=$transaction['credits']?></td>
                                    <td><?=$transaction['unbilled_amount']?></td>
                                </tr>
                                <?php break;
                                case 'recently-paid' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['method']?></td>
                                    <td><?=$transaction['source']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['aging']?></td>
                                    <td><?=$transaction['balance']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['latest_payment']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'money-received' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                default : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['method']?></td>
                                    <td><?=$transaction['source']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['aging']?></td>
                                    <td><?=$transaction['balance']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                } ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="19">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_all_sales_transactions">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_customer_transactions_modal" tabindex="-1" aria-labelledby="print_preview_customer_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_customer_transactions_modal_label">Print customers List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="all_sales_transactions_table_print">
                    <thead>
                        <tr>
                            <?php foreach($headers as $header) : ?>
                            <?php if($header !== 'Attachments') : ?>
                            <td data-name="<?=$header?>"><?=strtoupper($header)?></td>
                            <?php else : ?>
                            <td class="table-icon text-center" data-name="<?=$header?>"><i class="bx bx-paperclip"></i></td>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                            <?php foreach($transactions as $transaction) : ?>
                                <?php switch($type) {
                                case 'estimates' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['expiration_date']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['accepted_date']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'invoices' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['aging']?></td>
                                    <td><?=$transaction['balance']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'sales-receipts' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['method']?></td>
                                    <td><?=$transaction['source']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'credit-memos' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'unbilled-income' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['charges']?></td>
                                    <td><?=$transaction['time']?></td>
                                    <td><?=$transaction['expenses']?></td>
                                    <td><?=$transaction['credits']?></td>
                                    <td><?=$transaction['unbilled_amount']?></td>
                                </tr>
                                <?php break;
                                case 'recently-paid' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['method']?></td>
                                    <td><?=$transaction['source']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['aging']?></td>
                                    <td><?=$transaction['balance']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['latest_payment']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                case 'money-received' : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                default : ?>
                                <tr>
                                    <td><?=$transaction['date']?></td>
                                    <td><?=$transaction['type']?></td>
                                    <td><?=$transaction['no']?></td>
                                    <td><?=$transaction['customer']?></td>
                                    <td><?=$transaction['method']?></td>
                                    <td><?=$transaction['source']?></td>
                                    <td><?=$transaction['memo']?></td>
                                    <td><?=$transaction['due_date']?></td>
                                    <td><?=$transaction['aging']?></td>
                                    <td><?=$transaction['balance']?></td>
                                    <td><?=$transaction['total']?></td>
                                    <td><?=$transaction['last_delivered']?></td>
                                    <td><?=$transaction['email']?></td>
                                    <td><?=$transaction['attachments']?></td>
                                    <td><?=$transaction['status']?></td>
                                    <td><?=$transaction['po_number']?></td>
                                    <td><?=$transaction['sales_rep']?></td>
                                </tr>
                                <?php break;
                                } ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="19">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="send-transaction-email" tabindex="-1" aria-hidden="true">
    <form id="send-transaction-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Send email for </span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 grid-mb">
                            <label for="email-to">To</label>
                            <input type="text" name="email_to" id="email-to" class="form-control nsm-field" value="<?=$customer->email?>">
                        </div>
                        <div class="col-12 grid-mb">
                            <label for="email-subject">Subject</label>
                            <input type="text" name="email_subject" id="email-subject" class="form-control nsm-field">
                        </div>
                        <div class="col-12 grid-mb">
                            <label for="email-message">Message</label>
                            <textarea name="email_message" id="email-message" class="form-control nsm-field" style="height: 160px;">Dear <?=in_array($customer->business_name, ['', null]) ?  $customer->first_name.' '.$customer->last_name : $customer->business_name?>,

Please review the sales receipt below.
We appreciate it very much.

Thanks for your business!
<?=$company->business_name?>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary" id="send-email">Send</button>
                </div>
            </div>
        </div>
    </form>
</div>