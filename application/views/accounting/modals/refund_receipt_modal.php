<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($receipt)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/refund-receipt/<?=$receipt->id?>">
<?php endif; ?>
    <div id="refundReceiptModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-history fa-lg"></i>
                                </a>
                                <div class="dropdown-menu" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Refund Receipts</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-refund-receipts">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Refund Receipt <span></span>
                            </h4>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="customer">Customer</label>
                                                        <select name="customer" id="customer" class="form-control" required>
                                                            <?php if(isset($receipt)) : ?>
                                                                <option value="<?=$receipt->customer_id?>">
                                                                <?php
                                                                    $customer = $this->accounting_customers_model->get_by_id($receipt->customer_id);
                                                                    echo $customer->first_name . ' ' . $customer->last_name;
                                                                ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email (Separate emails with a comma)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                AMOUNT
                                            </h6>
                                            <h2 class="text-right">
                                                <span class="transaction-total-amount">$0.00</span>
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="billing-address">Billing address</label>
                                                <textarea name="billing_address" id="billing-address" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="refund-receipt-date">Refund Receipt date</label>
                                                        <input type="text" name="refund_receipt_date" id="refund-receipt-date" class="form-control date" <?=isset($receipt) ? "value='$receipt->refund_receipt_date'" : ''?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="purchase-order-no">P.O. Number</label>
                                                        <input type="text" class="form-control" name="purchase_order_no" id="purchase-order-no">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="sales-rep">Sales Rep</label>
                                                        <input type="text" class="form-control" name="sales_rep" id="sales-rep">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                                </div>
                                                <select name="tags[]" id="tags" class="form-control" multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_method">Payment method</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <?php if(isset($receipt)) : ?>
                                                        <option value="<?=$receipt->payment_method?>"><?=$this->accounting_payment_methods_model->getById($receipt->payment_method)->name?></option>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="deposit_to">Deposit to</label>
                                                <select name="deposit_to_account" id="deposit_to" class="form-control" required>
                                                    <?php if(isset($receipt)) : ?>
                                                        <option value="<?=$receipt->deposit_to?>"><?=$this->chart_of_accounts_model->getName($receipt->deposit_to)?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="refund-receipt-item-table-container w-100">
                                                <div class="refund-receipt-item-table">
                                                    <table class="table table-bordered table-hover" id="refund-receipt-item-table">
                                                        <thead>
                                                            <th width="20%">NAME</th>
                                                            <th>TYPE</th>
                                                            <th width="10%">QUANTITY</th>
                                                            <th width="10%">PRICE</th>
                                                            <th width="10%">DISCOUNT</th>
                                                            <th width="10%">TAX (CHANGE IN %)</th>
                                                            <th>TOTAL</th>
                                                            <th width="3%"></th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                                <div class="refund-receipt-item-table-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a class="link-modal-open" href="#" id="add_another_items" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message_refund">Message displayed on refund receipt</label>
                                                        <textarea name="message_refund" id="message_refund" class="form-control"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_refund) : ''?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message_statement">Message displayed on statement</label>
                                                        <textarea name="message_statement" id="message_statement" class="form-control"><?=isset($receipt) ? str_replace("<br />", "", $receipt->message_statement) : ''?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="expense-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="#" id="show-existing-attachments" class="text-info">Show existing</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <table class="table-borderless bg-transparent float-right table text-right w-50">
                                                <tbody>
                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td class="w-25"><span class="credit-memo-subtotal">$0.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taxes</td>
                                                        <td class="w-25"><span class="credit-memo-taxes">$0.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center justify-content-end">
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control w-50 mr-2">
                                                            <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control adjustment_input_cm_c w-25 mr-2">
                                                            <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                        </td>
                                                        <td class="w-25"><span class="adjustment-total-value">$0.00</span></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>Grand Total ($)</td>
                                                        <td class="w-25">$0.00</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-white">Print or Preview</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-white" onclick="makeRecurring('sales_receipt')">Make Recurring</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
                                    <a class="dropdown-item" href="#" onclick="saveAndSendForm(event)">Save and send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>