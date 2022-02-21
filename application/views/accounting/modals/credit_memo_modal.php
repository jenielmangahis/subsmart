<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($creditMemo)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/credit-memo/<?=$creditMemo->id?>">
<?php endif; ?>
    <div id="creditMemoModal" class="modal fade modal-fluid" role="dialog">
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
                                    <h5 class="dropdown-header">Recent Credit Memos</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-credit-memos">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Credit Memo <span></span>
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
                                                            <?php if(isset($creditMemo)) : ?>
                                                                <option value="<?=$creditMemo->customer_id?>">
                                                                <?php
                                                                    $customer = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
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
                                                        <div class="form-check">
                                                            <input type="checkbox" name="send-later" value="1" class="form-check-input" id="send-later">
                                                            <label class="form-check-label" for="send-later">Send later</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                AMOUNT TO REFUND
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="credit_memo_date">Credit Memo Date</label>
                                                <input type="text" name="credit_memo_date" id="credit_memo_date" class="form-control" <?=isset($creditMemo) ? "value='$creditMemo->credit_memo_date'" : ''?>>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="purchase-order-no">P.O. Number</label>
                                                <input type="text" class="form-control" name="purchase_order_no" id="purchase-order-no">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sales-rep">Sales Rep</label>
                                                <input type="text" name="sales_rep" id="sales-rep" class="form-control">
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
                                        <div class="col-md-12">
                                            <div class="credit-memo-item-table-container w-100">
                                                <div class="credit-memo-item-table">
                                                    <table class="table table-bordered table-hover" id="credit-memo-item-table">
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
                                                <div class="credit-memo-item-table-footer">
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
                                                        <label for="memo">Message displayed on credit memo</label>
                                                        <textarea name="memo" id="memo" class="form-control"><?=isset($creditMemo) ? str_replace("<br />", "", $creditMemo->message_credit_memo) : ''?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="memo">Message displayed on statement</label>
                                                        <textarea name="memo" id="memo" class="form-control"><?=isset($creditMemo) ? str_replace("<br />", "", $creditMemo->message_on_statement) : ''?></textarea>
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
                                    <span><a href="#" class="text-white" onclick="makeRecurring('credit_memo')">Make Recurring</a></span>
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