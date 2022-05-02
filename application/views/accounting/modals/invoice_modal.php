<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($invoice)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/invoice/<?=$invoice->id?>">
<?php endif; ?>
    <div id="invoiceModal" class="modal fade modal-fluid" role="dialog">
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
                                    <h5 class="dropdown-header">Recent Invoices</h5>
                                    <table class="table table-borderless table-hover cursor-pointer" id="recent-invoices">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <h4 class="modal-title">
                                Invoice <span><?=isset($invoice) ? '#'.str_replace($invoice_prefix, '', $invoice->invoice_number) : ''?></span>
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
                                    <div class="row customer-details">
                                        <?php if(isset($invoice) && !is_null($invoice->linked_transactions)) : ?>
                                        <div class="col-md-12">
                                            <a href="#" class="float-right btn btn-transparent rounded-0 open-transactions-container" style="padding:12px 15px !important">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>

                                            <div class="dropdown">
                                                <a href="#" class="text-info" id="linked-transaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php if(count($invoice->linked_transacs) > 1) : ?>
                                                        <?=count($invoice->linked_transacs)?> linked transactions
                                                    <?php else : ?>
                                                        1 linked <?=$invoice->linked_transacs[0]['type']?>
                                                    <?php endif; ?>
                                                </a>
                                                <div class="dropdown-menu p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                                    <div class="row">
                                                        <div class="col-3"><strong>Type</strong></div>
                                                        <div class="col-3"><strong>Date</strong></div>
                                                        <div class="col-3"><strong>Amount</strong></div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                    <?php foreach($invoice->linked_transacs as $linkedTransac) : ?>
                                                    <div class="row my-1">
                                                        <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="<?=$linkedTransac['transaction']->id?>" data-type="<?=strtolower(str_replace(' ', '-', $linkedTransac['type']))?>"><?=$linkedTransac['type']?></a></div>
                                                        <div class="col-3 d-flex align-items-center"><?=$linkedTransac['type'] === 'Delayed Credit' ? date("m/d/Y", strtotime($linkedTransac['transaction']->delayed_credit_date)) : date("m/d/Y", strtotime($linkedTransac['transaction']->delayed_charge_date))?></div>
                                                        <div class="col-3 d-flex align-items-center">
                                                            <?php
                                                            $transacAmount = $linkedTransac['transaction']->total_amount;
                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                            echo str_replace('$-', '-$', $transacAmount);
                                                            ?>
                                                        </div>
                                                        <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" data-type="<?=strtolower(str_replace(' ', '-', $linkedTransac['type']))?>" data-id="<?=$linkedTransac['transaction']->id?>" style="font-size: 13px !important">Remove</button></div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                            <?php foreach($invoice->linked_transacs as $linkedTransac) : ?>
                                                <input type="hidden" value="<?=str_replace(' ', '_', strtolower($linkedTransac['type']))?>-<?=$linkedTransac['transaction']->id?>" name="linked_transaction[]">
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="customer">Customer</label>
                                                        <select name="customer" id="customer" class="form-control" required>
                                                            <?php if(isset($invoice)) : ?>
                                                                <option value="<?=$invoice->customer_id?>">
                                                                <?php
                                                                    $customer = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                                                                    echo $customer->first_name . ' ' . $customer->last_name;
                                                                ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">
                                                <?php if(isset($invoice) && $invoice->status !== "Paid") : ?>
                                                    PAYMENT STATUS
                                                <?php else : ?>
                                                    BALANCE DUE
                                                <?php endif; ?>
                                            </h6>
                                            <h2 class="text-right">
                                                <span class="transaction-grand-total">
                                                <?php if(isset($invoice)) : ?>
                                                    <?php if($invoice->status === 'Paid') : ?>
                                                        PAID
                                                    <?php else : ?>
                                                    <?php
                                                    $amount = '$'.number_format(floatval($invoice->balance), 2, '.', ',');
                                                    $amount = str_replace('$-', '-$', $amount);
                                                    echo $amount;
                                                    ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    $0.00
                                                <?php endif; ?>
                                                </span>
                                            </h2>
                                            <?php if(isset($invoice) && count($payments) > 0) : ?>
                                            <div class="btn-group dropleft d-inline-block float-right">
                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn text-info p-0">
                                                        <?=count($payments)?> payment made (<span id="total-payment-amount"><?=number_format(floatval($totalPayment), 2, '.', ',')?></span>)
                                                    </button>
                                                    <div class="dropdown-menu p-3" id="payments-dropdown" style="min-width: 275px">
                                                        <table class="table bg-white m-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Amount applied</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($payments as $payment) : ?>
                                                                    <tr>
                                                                        <td><a href="/accounting/view-transaction/unapplied-payment/<?=$payment->receive_payment->id?>" class="text-info"><?=date("m/d/Y", strtotime($payment->receive_payment->payment_date))?></a></td>
                                                                        <td class="text-right">$<?=number_format(floatval($payment->payment_amount), 2, '.', ',')?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php if($is_copy) : ?>
                                        <div class="col-md-12">
                                            <div class="alert alert-info alert-dismissible mb-4" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <h6 class="mt-0">This is a copy</h6>
                                                <span>This is a copy of a invoice. Revise as needed and save the invoice.</span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="job-location">Job location (optional, select, or add new one)</label>
                                                <input type="text" class="form-control" id="job-location" name="job_location" value="<?=isset($invoice) ? $invoice->job_location : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="job-name">Job name (optional)</label>
                                                <input type="text" class="form-control" id="job-name" name="job_name" value="<?=isset($invoice) ? $invoice->job_name : ''?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="term">Terms</label>
                                                <select name="term" id="term" class="form-control">
                                                    <?php if(isset($invoice)) : ?>
                                                        <?php if($invoice->terms !== null && $invoice->terms !== "") : ?>
                                                            <option value="<?=$term->id?>"><?=$term->name?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="customer-email">Customer email</label>
                                                <input type="email" name="customer_email" id="customer-email" class="form-control" value="<?=isset($invoice) ? $invoice->customer_email : ''?>">
                                                <div class="form-check">
                                                    <div class="checkbox checkbox-sec">
                                                        <input type="checkbox" name="send_later" value="1" class="form-check-input" id="send-later" <?=isset($invoice) && $invoice->send_later === "1" ? 'checked' : ''?>>
                                                        <label class="form-check-label" for="send-later">Send later</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="location-of-sale">Location of sale</label>
                                                <input type="text" class="form-control" id="location-of-sale" name="location_of_sale" value="<?=isset($invoice) ? $invoice->location_scale : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tracking-no">Tracking no.</label>
                                                <input type="text" class="form-control" id="tracking-no" name="tracking_no" value="<?=isset($invoice) ? $invoice->tracking_number : ''?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ship-via">Ship via</label>
                                                <input type="text" class="form-control" id="ship-via" name="ship_via" value="<?=isset($invoice) ? $invoice->ship_via : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="shipping-date">Shipping date</label>
                                                <input type="text" class="form-control date" id="shipping-date" name="shipping_date" value="<?=isset($invoice) && $invoice->shipping_date !== '' ? date("m/d/Y", strtotime($invoice->shipping_date)) : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="billing-address">Billing address</label>
                                                <textarea name="billing_address" id="billing-address" class="form-control"><?=isset($invoice) ? str_replace("<br />", "", $invoice->billing_address) : ''?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="invoice-no">Invoice #</label>
                                                <input type="text" class="form-control" id="invoice-no" name="invoice_no" value="<?=isset($invoice) ? $invoice->invoice_number : "$invoice_prefix".str_pad(intval($number) + 1, 9, "0", STR_PAD_LEFT)?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="job-no">Job # (optional) <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Field is auto-populated on create invoice from a Work Order." data-original-title="" title=""></span></label>
                                                <input type="text" class="form-control" id="job-no" name="job_no" value="<?=isset($invoice) ? $invoice->work_order_number : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="purchase-order-no">Purchase order # (optional) <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional if you want to display the purchase order number on invoice." data-original-title="" title=""></span></label>
                                                <input type="text" class="form-control" id="purchase-order-no" name="purchase_order_no" value="<?=isset($invoice) ? $invoice->po_number : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="shipping-to">Shipping to</label>
                                                <textarea name="shipping_to" id="shipping-to" class="form-control"><?=isset($invoice) ? str_replace("<br />", "", $invoice->shipping_to_address) : ''?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row date-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="date-issued">Date issued <span class="text-danger">*</span></label>
                                                <input type="text" name="date_issued" id="date-issued" class="form-control date" value="<?=isset($invoice) ? date("m/d/Y", strtotime($invoice->date_issued)) : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="due-date">Due date <span class="text-danger">*</span></label>
                                                <input type="text" name="due_date" id="due-date" class="form-control date" value="<?=isset($invoice) ? date("m/d/Y", strtotime($invoice->due_date)) : ''?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Status <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="Draft" <?=isset($invoice) && $invoice->status === 'Draft' ? 'selected' : ''?>>Draft</option>
                                                    <option value="Submitted" <?=isset($invoice) && $invoice->status === 'Submitted' ? 'selected' : ''?>>Submitted</option>
                                                    <option value="Partially Paid" <?=isset($invoice) && $invoice->status === 'Partially Paid' ? 'selected' : ''?>>Partially Paid</option>
                                                    <option value="Paid" <?=isset($invoice) && $invoice->status === 'Paid' ? 'selected' : ''?>>Paid</option>
                                                    <option value="Due" <?=isset($invoice) && $invoice->status === 'Due' ? 'selected' : ''?>>Due</option>
                                                    <option value="Overdue" <?=isset($invoice) && $invoice->status === 'Overdue' ? 'selected' : ''?>>Overdue</option>
                                                    <option value="Approved" <?=isset($invoice) && $invoice->status === 'Approved' ? 'selected' : ''?>>Approved</option>
                                                    <option value="Declined" <?=isset($invoice) && $invoice->status === 'Declined' ? 'selected' : ''?>>Declined</option>
                                                    <option value="Schedule" <?=isset($invoice) && $invoice->status === 'Schedule' ? 'selected' : ''?>>Schedule</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                                </div>
                                                <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                                    <?php if(isset($tags) && count($tags) > 0) : ?>
                                                        <?php foreach($tags as $tag) : ?>
                                                            <?php 
                                                                $name = $tag->name;
                                                                if($tag->group_tag_id !== null) {
                                                                    $group = $this->tags_model->getGroupById($tag->group_tag_id);
                                                                    $name = $group->name.': '.$tag->name;
                                                                }
                                                            ?>
                                                            <option value="<?=$tag->id?>" selected><?=$name?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice-item-table-container w-100">
                                                <div class="invoice-item-table">
                                                    <table class="table table-bordered table-hover" id="item-table">
                                                        <thead>
                                                            <th width="20%">ITEM</th>
                                                            <th>TYPE</th>
                                                            <th>LOCATION</th>
                                                            <th width="10%">QUANTITY</th>
                                                            <th width="10%">PRICE</th>
                                                            <th width="10%">DISCOUNT</th>
                                                            <th width="10%">TAX (CHANGE IN %)</th>
                                                            <th>TOTAL</th>
                                                            <?php if(isset($invoice) && !is_null($invoice->linked_transactions)) : ?>
                                                            <th widht="3%"></th>
                                                            <?php endif; ?>
                                                            <th width="3%"></th>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(isset($items) && count($items) > 0) : ?>
                                                                <?php foreach($items as $item) : ?>
                                                                    <?php if(!is_null($item->itemDetails)) : ?>
                                                                    <?php $itemDetails = $item->itemDetails;?>
                                                                    <?php $locations = $item->locations;?>
                                                                    <tr>
                                                                        <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->items_id?>"></td>
                                                                        <td><?=ucfirst($itemDetails->type)?></td>
                                                                        <td>
                                                                            <?php if($itemDetails->type === 'product' || $itemDetails->type === 'item') : ?>
                                                                            <select name="location[]" class="form-control" required>
                                                                                <?php foreach($locations as $location) : ?>
                                                                                    <option value="<?=$location['id']?>" <?=$item->location_id === $location['id'] ? 'selected' : ''?>><?=$location['name']?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td><input type="number" name="quantity[]" class="form-control text-right" required value="<?=$item->qty?>"></td>
                                                                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->cost), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
                                                                        <td>
                                                                            <span class="row-total">
                                                                                <?php
                                                                                    $rowTotal = '$'.number_format(floatval($item->total), 2, '.', ',');
                                                                                    $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                                    echo $rowTotal;
                                                                                ?>
                                                                            </span>
                                                                        </td>
                                                                        <?php if(isset($invoice) && !is_null($invoice->linked_transactions)) : ?>
                                                                        <td>
                                                                        <?php if(!is_null($item->linked_transaction_type) && !is_null($item->linked_transaction_id)) : ?>
                                                                            <div class="dropdown">
                                                                                <a href="#" class="text-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-link"></i></a>
                                                                                <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                                                                    <div class="row">
                                                                                        <div class="col-3"><strong>Type</strong></div>
                                                                                        <div class="col-3"><strong>Date</strong></div>
                                                                                        <div class="col-3"><strong>Amount</strong></div>
                                                                                        <div class="col-3"></div>
                                                                                        <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="<?=$item->linked_transaction_id?>" data-type="<?=str_replace('_', '-', $item->linked_transaction_type)?>"><?=ucwords(str_replace('_', ' ', $item->linked_transaction_type))?></a></div>
                                                                                        <div class="col-3 d-flex align-items-center"><?=$item->linked_transaction_type === 'delayed_credit' ? date("m/d/Y", strtotime($item->linked_transac->delayed_credit_date)) : date("m/d/Y", strtotime($item->linked_transac->delayed_charge_date))?></div>
                                                                                        <div class="col-3 d-flex align-items-center">
                                                                                            <?php
                                                                                            $transacAmount = $item->linked_transac->total_amount;
                                                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                            echo str_replace('$-', '-$', $transacAmount);
                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" data-type="<?=str_replace('_', '-', $item->linked_transaction_type)?>" data-id="<?=$item->linked_transaction_id?>" style="font-size: 13px !important">Remove</button></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?=$item->linked_transaction_type?>-<?=$item->linked_transaction_id?>" name="item_linked_transaction[]">
                                                                            <input type="hidden" value="<?=$item->linked_transaction_item_id?>" name="transaction_item_id[]">
                                                                        <?php endif; ?>
                                                                        </td>
                                                                        <?php endif; ?>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php else : ?>
                                                                    <?php $packageDetails = $item->packageDetails; ?>
                                                                    <?php $packageItems = $item->packageItems; ?>
                                                                    <tr class="package">
                                                                        <td><?=$packageDetails->name?><input type="hidden" name="package[]" value="<?=$packageDetails->id?>"></td>
                                                                        <td>Package</td>
                                                                        <td></td>
                                                                        <td><input type="number" name="quantity[]" class="form-control text-right" required value="<?=$item->qty?>"></td>
                                                                        <td><span class="item-amount"><?=number_format(floatval($item->cost), 2, '.', ',')?></span></td>
                                                                        <td></td>
                                                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
                                                                        <td>
                                                                            <span class="row-total">
                                                                                <?php
                                                                                    $rowTotal = '$'.number_format(floatval($item->total), 2, '.', ',');
                                                                                    $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                                    echo $rowTotal;
                                                                                ?>
                                                                            </span>
                                                                        </td>
                                                                        <?php if(isset($invoice) && !is_null($invoice->linked_transactions)) : ?>
                                                                        <td>
                                                                        <?php if(!is_null($item->linked_transaction_type) && !is_null($item->linked_transaction_id)) : ?>
                                                                            <div class="dropdown">
                                                                                <a href="#" class="text-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-link"></i></a>
                                                                                <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="linked-transaction" style="min-width: 500px; font-size: 13px">
                                                                                    <div class="row">
                                                                                        <div class="col-3"><strong>Type</strong></div>
                                                                                        <div class="col-3"><strong>Date</strong></div>
                                                                                        <div class="col-3"><strong>Amount</strong></div>
                                                                                        <div class="col-3"></div>
                                                                                        <div class="col-3 d-flex align-items-center"><a class="text-info open-transaction" href="#" data-id="<?=$item->linked_transaction_id?>" data-type="<?=str_replace('_', '-', $item->linked_transaction_type)?>"><?=ucwords(str_replace('_', ' ', $item->linked_transaction_type))?></a></div>
                                                                                        <div class="col-3 d-flex align-items-center"><?=$item->linked_transaction_type === 'delayed_credit' ? date("m/d/Y", strtotime($item->linked_transac->delayed_credit_date)) : date("m/d/Y", strtotime($item->linked_transac->delayed_charge_date))?></div>
                                                                                        <div class="col-3 d-flex align-items-center">
                                                                                            <?php
                                                                                            $transacAmount = $item->linked_transac->total_amount;
                                                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                            echo str_replace('$-', '-$', $transacAmount);
                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="col-3 d-flex align-items-center"><button class="btn btn-transparent unlink-transaction" data-type="<?=str_replace('_', '-', $item->linked_transaction_type)?>" data-id="<?=$item->linked_transaction_id?>" style="font-size: 13px !important">Remove</button></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?=$item->linked_transaction_type?>-<?=$item->linked_transaction_id?>" name="item_linked_transaction[]">
                                                                            <input type="hidden" value="<?=$item->linked_transaction_item_id?>" name="transaction_item_id[]">
                                                                        <?php endif; ?>
                                                                        </td>
                                                                        <?php endif; ?>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <a href="#" class="deleteRow"><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="package-items">
                                                                        <td colspan="3">
                                                                            <table class="table m-0 bg-white">
                                                                                <thead>
                                                                                    <tr class="package-item-header">
                                                                                        <th>Item Name</th>
                                                                                        <th>Quantity</th>
                                                                                        <th>Price</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="package-items-table">
                                                                                    <?php foreach($packageItems as $packageItem) : ?>
                                                                                        <?php $item = $this->items_model->getItemById($packageItem->item_id)[0]; ?>
                                                                                        <tr class="package-item">
                                                                                            <td><?=$item->title?></td>
                                                                                            <td><?=$packageItem->quantity?></td>
                                                                                            <td><?=number_format(floatval($packageItem->price), 2, '.', ',')?></td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <?php if(isset($invoice) && !is_null($invoice->linked_transactions)) : ?>
                                                                        <td></td>
                                                                        <?php endif; ?>
                                                                        <td></td>
                                                                    </tr>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="invoice-item-table-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a class="link-modal-open" href="#" id="add_item" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a> &emsp;
                                                            <a class="link-modal-open" href="#" id="add_group" data-target="#item_group_list"><span class="fa fa-plus-square fa-margin-right"></span>Add By Group</a> &emsp;
                                                            <a class="link-modal-open" href="#" id="add_create_package" data-target="#package_list"><span class="fa fa-plus-square fa-margin-right"></span>Add/Create Package</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Request a Deposit</h5>
                                                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <select name="deposit_request_type" id="deposit-request-type" class="form-control">
                                                            <option value="$" <?=isset($invoice) && $invoice->deposit_request_type === '$' ? 'selected' : ''?>>Deposit amount $</option>
                                                            <option value="%" <?=isset($invoice) && $invoice->deposit_request_type === '%' ? 'selected' : ''?>>Percentage %</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" id="deposit-amount" name="deposit_amount" onchange="convertToDecimal(this)" value="<?=isset($invoice) ? $invoice->deposit_request : '0.00'?>" step=".01">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5>Payment Schedule</h5>
                                                    <span class="help help-sm help-block">Split the balance into multiple payment milestones.</span>
                                                    <p><a href="#" id="manage-payment-schedule" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Manage payment schedule </a></p>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5>Accepted payment methods</h5>
                                                    <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                        <input type="checkbox" name="credit_card_payments" value="1" <?=isset($paymentMethods) && in_array('Credit Card', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="credit-card-payments">
                                                        <label for="credit-card-payments"><span>Credit Card Payments ()</span></label>
                                                    </div>
                                                    <span class="help help-sm help-block">Your client can pay your invoice using credit card or bank account online. You will be notified when your client makes a payment and the money will be transferred to your bank account automatically.</span>
                                                    <div class="float-left mini-stat-img mr-4"><img src="<?=$url->assets?>frontend/images/credit_cards.png" alt=""></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <span class="help help-sm help-block">Your payment processor is not set up <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal" data-target="#modalNewCustomer">setup payment</a></span>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                        <input type="checkbox" name="bank_transfer" value="1" <?=isset($paymentMethods) && in_array('Bank Transfer', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="bank-transfer">
                                                        <label for="bank-transfer"><span>Bank Transfer</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                        <input type="checkbox" name="instapay" value="1" <?=isset($paymentMethods) && in_array('Instapay', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="instapay-payment">
                                                        <label for="instapay-payment"><span>Instapay</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                        <input type="checkbox" name="check" value="1" <?=isset($paymentMethods) && in_array('Check', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="check-payment">
                                                        <label for="check-payment"><span>Check</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                        <input type="checkbox" name="cash" value="1" <?=isset($paymentMethods) && in_array('Cash', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="cash-payment">
                                                        <label for="cash-payment"><span>Cash</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                        <input type="checkbox" name="deposit" value="1" <?=isset($paymentMethods) && in_array('Deposit', $paymentMethods) || !isset($invoice) ? 'checked' : ''?> id="deposit-payment">
                                                        <label for="deposit-payment"><span>Deposit</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <table class="table-borderless bg-transparent float-right table text-right w-50">
                                                <tbody>
                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td class="w-25">
                                                            <span class="transaction-subtotal">
                                                            <?php if(isset($invoice)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($invoice->sub_total), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                                ?>
                                                            <?php else : ?>
                                                                $0.00
                                                            <?php endif; ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taxes</td>
                                                        <td class="w-25">
                                                            <span class="transaction-taxes">
                                                            <?php if(isset($invoice)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($invoice->taxes), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                                ?>
                                                            <?php else : ?>
                                                                $0.00
                                                            <?php endif; ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discounts</td>
                                                        <td class="w-25">
                                                            <span class="transaction-discounts">
                                                            <?php if(isset($invoice)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($invoice->discount_total), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                                ?>
                                                            <?php else : ?>
                                                                $0.00
                                                            <?php endif; ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center justify-content-end">
                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control w-50 mr-2" value="<?=isset($invoice) ? $invoice->adjustment_name : ''?>">
                                                            <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control adjustment_input_cm_c w-25 mr-2" onchange="convertToDecimal(this)" value="<?=isset($invoice) ? number_format(floatval($invoice->adjustment_value), 2, '.', ',') : ''?>">
                                                            <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="transaction-adjustment">
                                                            <?php if(isset($invoice)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($invoice->adjustment_value), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                                ?>
                                                            <?php else : ?>
                                                                $0.00
                                                            <?php endif; ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>Grand Total ($)</td>
                                                        <td class="w-25">
                                                            <span class="transaction-grand-total">
                                                            <?php if(isset($invoice)) : ?>
                                                                <?php
                                                                $amount = '$'.number_format(floatval($invoice->grand_total), 2, '.', ',');
                                                                $amount = str_replace('$-', '-$', $amount);
                                                                echo $amount;
                                                                ?>
                                                            <?php else : ?>
                                                                $0.00
                                                            <?php endif; ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Message to Customer</h5>
                                                        <span class="help help-sm help-block">Add a message that will be displayed on the invoice.</span>
                                                        <textarea name="message_to_customer" cols="40" rows="2" class="form-control"><?=isset($invoice) ? $invoice->message_to_customer : 'Thank you for your business.'?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5>Terms &amp; Conditions</h5>
                                                        <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                                                        <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control"><?=isset($invoice) ? $invoice->terms_and_conditions : ''?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="invoice-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if(isset($invoice) && !is_null($invoice->linked_transactions)) : ?>
                        <div class="col-xl-2" style="display: none">
                            <div class="transactions-container bg-white h-100" style="padding: 15px">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Invoice</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Filter by</label>
                                            <select class="form-control" id="transaction-type">
                                                <option value="all" selected>All types</option>
                                                <option value="charges">Charges</option>
                                                <option value="credits">Credits</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="transaction-date">
                                                <option value="all" selected>All dates</option>
                                                <option value="this-month">This month</option>
                                                <option value="last-month">Last month</option>
                                                <option value="custom">Custom...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php foreach($linkableTransactions as $linkableTransac) : ?>
                                    <?php
                                    $title = $linkableTransac['type'];
                                    $title .= $linkableTransac['number'] !== '' ? '#' + $linkableTransac['number'] : '';
                                    ?>
                                    <div class="col-12">
                                        <div class="card border">
                                            <div class="card-body p-0">
                                                <h5 class="card-title"><?=$title?></h5>
                                                <p class="card-subtitle"><?=$linkableTransac['formatted_date']?></p>
                                                <p class="card-text"><?=$linkableTransac['balance']?></p>
                                                <ul class="d-flex justify-content-around">
                                                    <li><a href="#" class="text-info add-transaction" data-id="<?=$linkableTransac['id']?>" data-type="<?=$linkableTransac['data_type']?>"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="text-info open-transaction" data-id="<?=$linkableTransac['id']?>" data-type="<?=$linkableTransac['data_type']?>">Open</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
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
                                    <span><a href="#" class="text-white" id="save-and-print">Print or Preview</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-white" onclick="makeRecurring('invoice')">Make Recurring</a></span>
                                    <?php if(isset($invoice)) : ?>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="javascript:void(0);" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-invoice">Copy</a>
                                                <?php if($invoice->voided !== "1") : ?>
                                                <a class="dropdown-item" href="#" id="void-invoice">Void</a>
                                                <?php endif; ?>
                                                <a class="dropdown-item" href="#" id="delete-invoice">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                    <?php endif; ?>
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
                                    <a class="dropdown-item" href="#">Save and share link</a>
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