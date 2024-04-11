<style>
    .bank-type {
        margin-top: 10px;
    }

    .title-header {
        margin-top: 20px;
    }

    .credit-cards {
        margin: 10px 0;
    }
</style>
<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <?php if (!isset($invoice)) : ?>
        <form onsubmit="submitModalForm(event, this)" id="modal-form">
        <?php else : ?>
            <form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="<?= base_url('accounting/update-transaction/invoice/' . $invoice->id) ?>">
            <?php endif; ?>
            <div id="invoiceModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">

                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row w-100">
                                <div class="col-6 d-flex align-items-center">
                                    <div class="dropdown mr-1">
                                        <a href="javascript:void(0);" class="h4 recent-transactions-button" data-bs-toggle="dropdown">
                                            <i class="bx bx-fw bx-history"></i>
                                        </a>
                                        <div class="dropdown-menu p-3" style="width: 500px">
                                            <h5 class="dropdown-header">Recent Invoices</h5>
                                            <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-invoices">
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <span class="modal-title content-title">
                                        Invoice <span><?= isset($invoice) ? '#' . str_replace($invoice_prefix, '', $invoice->invoice_number) : '' ?></span>
                                    </span>
                                </div>
                            </div>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="min-height: 100%">
                                <div class="col">
                                    <div class="row customer-details">
                                        <?php if (isset($invoice) && !is_null($invoice->linked_transacs) || isset($linkedTransac)) : ?>
                                            <div class="col-12">
                                                <button class="nsm-button open-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-left"></i></button>

                                                <div class="dropdown">
                                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">
                                                        <?php if (!isset($linkedTransac)) : ?>
                                                            <?php if (count($invoice->linked_transacs) > 1) : ?>
                                                                <?= count($invoice->linked_transacs) ?> linked transactions
                                                            <?php else : ?>
                                                                1 linked <?= $invoice->linked_transacs[0]['type'] ?>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            1 linked <?= $linkedTransac->type ?>
                                                        <?php endif; ?>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <table class="nsm-table linked-transaction-table">
                                                            <thead>
                                                                <tr class="linked-transaction-header">
                                                                    <td data-name="Type">Type</td>
                                                                    <td data-name="Date">Date</td>
                                                                    <td data-name="Amount">Amount</td>
                                                                    <td data-name="Action"></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="linked-transaction-table-body">
                                                                <?php if (!isset($linkedTransac)) : ?>
                                                                    <?php foreach ($invoice->linked_transacs as $linkedTransac) : ?>
                                                                        <tr class="linked-transaction-row">
                                                                            <td><a class="text-decoration-none open-transaction" href="#" data-id="<?= $linkedTransac['transaction']->id ?>" data-type="<?= strtolower(str_replace(' ', '-', $linkedTransac['type'])) ?>"><?= $linkedTransac['type'] ?></a></td>
                                                                            <td><?= $linkedTransac['type'] === 'Delayed Credit' ? date("m/d/Y", strtotime($linkedTransac['transaction']->delayed_credit_date)) : date("m/d/Y", strtotime($linkedTransac['transaction']->delayed_charge_date)) ?></td>
                                                                            <td>
                                                                                <?php
                                                                                $transacAmount = $linkedTransac['transaction']->total_amount;
                                                                                $transacAmount = '$' . number_format(floatval($transacAmount), 2, '.', ',');

                                                                                echo str_replace('$-', '-$', $transacAmount);
                                                                                ?>
                                                                            </td>
                                                                            <td><button type="button" class="nsm-button unlink-transaction" data-type="<?= strtolower(str_replace(' ', '-', $linkedTransac['type'])) ?>" data-id="<?= $linkedTransac['transaction']->id ?>">Remove</button></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <tr class="linked-transaction-row">
                                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="<?= $linkedTransac->transaction->id ?>" data-type="<?= strtolower(str_replace(' ', '-', $linkedTransac->type === 'Estimate' || $linkedTransac->type === 'Billexp Charge' || $linkedTransac->type === 'Time Charge' ? $linkedTransac->type : 'Delayed ' . $linkedTransac->type)) ?>"><?= $linkedTransac->type !== 'Estimate' && $linkedTransac->type !== 'Billexp Charge' && $linkedTransac->type !== 'Time Charge' ? 'Delayed ' : '' ?><?= $linkedTransac->type ?></a></td>
                                                                        <td>
                                                                            <?php switch ($linkedTransac->type) {
                                                                                case 'Estimate':
                                                                                    echo date("m/d/Y", strtotime($linkedTransac->transaction->estimate_date));
                                                                                    break;
                                                                                case 'Credit':
                                                                                    echo date("m/d/Y", strtotime($linkedTransac->transaction->delayed_credit_date));
                                                                                    break;
                                                                                case 'Charge':
                                                                                    echo date("m/d/Y", strtotime($linkedTransac->transaction->delayed_charge_date));
                                                                                    break;
                                                                                case 'Billexp Charge':
                                                                                    echo date("m/d/Y", strtotime($linkedTransac->transaction->date));
                                                                                    break;
                                                                                case 'Time Charge':
                                                                                    echo date("m/d/Y", strtotime($linkedTransac->transaction->date));
                                                                                    break;
                                                                            } ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            if ($linkedTransac->type === 'Estimate') {
                                                                                $transacAmount = $linkedTransac->transaction->grand_total;
                                                                            } else if ($linkedTransac->type === 'Billexp Charge') {
                                                                                $transacAmount = $linkedTransac->transaction->amount;
                                                                            } else if ($linkedTransac->type === 'Time Charge') {
                                                                                $price = floatval(str_replace(',', '', $linkedTransac->transaction->hourly_rate));

                                                                                $hours = substr($linkedTransac->transaction->time, 0, -3);
                                                                                $time = explode(':', $hours);
                                                                                $hr = $time[0] + ($time[1] / 60);

                                                                                $transacAmount = $hr * $price;
                                                                            } else {
                                                                                $transacAmount = $linkedTransac->transaction->total_amount;
                                                                            }
                                                                            $transacAmount = '$' . number_format(floatval($transacAmount), 2, '.', ',');

                                                                            echo str_replace('$-', '-$', $transacAmount);
                                                                            ?>
                                                                        </td>
                                                                        <td><button type="button" class="nsm-button unlink-transaction" data-type="<?= strtolower(str_replace(' ', '-', $linkedTransac->type)) ?>" data-id="<?= $linkedTransac->transaction->id ?>">Remove</button></td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <?php if (!isset($linkedTransac)) : ?>
                                                    <?php foreach ($invoice->linked_transacs as $linkedTransac) : ?>
                                                        <input type="hidden" value="<?= str_replace(' ', '_', strtolower($linkedTransac['type'])) ?>-<?= $linkedTransac['transaction']->id ?>" name="linked_transaction[]">
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <input type="hidden" value="<?= str_replace(' ', '_', strtolower($linkedTransac->type !== 'Estimate' && $linkedTransac->type !== 'Billexp Charge' && $linkedTransac->type !== 'Time Charge' ? 'Delayed ' . $linkedTransac->type : $linkedTransac->type)) ?>-<?= $linkedTransac->transaction->id ?>" name="linked_transaction[]">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12 col-md-8 grid-mb">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <label for="customer">Customer</label>
                                                    <select name="customer" id="customer" class="form-control nsm-field" required>
                                                        <?php if (isset($customer)) : ?>
                                                            <option value="<?= $customer->prof_id ?>">
                                                                <?php
                                                                echo $customer->first_name . ' ' . $customer->last_name;
                                                                ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 text-end grid-mb">
                                            <h6>
                                                <?php if (isset($invoice) && $invoice->status !== "Paid") : ?>
                                                    PAYMENT STATUS
                                                <?php else : ?>
                                                    BALANCE DUE
                                                <?php endif; ?>
                                            </h6>
                                            <h2>
                                                <span class="transaction-grand-total">
                                                    <?php if (isset($invoice)) : ?>
                                                        <?php if ($invoice->status === 'Paid') : ?>
                                                            PAID
                                                        <?php else : ?>
                                                            <?php
                                                            $amount = '$' . number_format(floatval($invoice->balance), 2, '.', ',');
                                                            $amount = str_replace('$-', '-$', $amount);
                                                            echo $amount;
                                                            ?>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        $0.00
                                                    <?php endif; ?>
                                                </span>
                                            </h2>
                                            <?php if (isset($invoice) && count($payments) > 0) : ?>
                                                <div class="btn-group dropstart float-end">
                                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <?= count($payments) ?> payment made (<span id="total-payment-amount"><?= number_format(floatval($totalPayment), 2, '.', ',') ?></span>)
                                                    </a>
                                                    <div class="dropdown-menu p-3" id="payments-dropdown">
                                                        <table class="nsm-table">
                                                            <thead>
                                                                <tr>
                                                                    <td>Date</td>
                                                                    <td>Amount applied</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($payments as $payment) : ?>
                                                                    <tr>
                                                                        <td><?= date("m/d/Y", strtotime($payment->payment_date)) ?></td>
                                                                        <td class="text-end"><?= str_replace('$-', '-$', '$' . number_format(floatval($payment->invoice_amount), 2, '.', ',')) ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php if ($is_copy) : ?>
                                            <div class="col-12">
                                                <div class="nsm-callout primary">
                                                    <button><i class='bx bx-x'></i></button>
                                                    <h6 class="mt-0">This is a copy</h6>
                                                    <span>This is a copy of a invoice. Revise as needed and save the invoice.</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12 col-md-2">
                                            <label for="job-location" style="font-size: 10px;">Job location (optional, select, or add new one)</label>
                                            <input type="text" class="form-control nsm-field mb-2" id="job-location" name="job_location" value="<?= isset($invoice) ? $invoice->job_location : '' ?>">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="job-name">Job name (optional)</label>
                                            <input type="text" class="form-control nsm-field mb-2" id="job-name" name="job_name" value="<?= isset($invoice) ? $invoice->job_name : '' ?>">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="term">Terms</label>
                                            <select name="term" id="term" class="form-control nsm-field">
                                                <?php if (isset($invoice)) : ?>
                                                    <?php if ($invoice->terms !== null && $invoice->terms !== "") : ?>
                                                        <option value="<?= $term->id ?>"><?= $term->name ?></option>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="customer-email">Customer email</label>
                                            <input type="email" name="customer_email" id="customer-email" class="form-control nsm-field mb-2" value="<?= isset($invoice) ? $invoice->customer_email : '' ?>">
                                            <div class="form-check">
                                                <input type="checkbox" name="send_later" value="1" class="form-check-input" id="send-later" <?= isset($invoice) && $invoice->send_later === "1" ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="send-later">Send later</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-12 col-md-2">
                                            <label for="location-of-sale">Location of sale</label>
                                            <input type="text" class="form-control nsm-field mb-2" id="location-of-sale" name="location_of_sale" value="<?= isset($invoice) ? $invoice->location_scale : '' ?>">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="tracking-no">Tracking no.</label>
                                            <input type="text" class="form-control nsm-field mb-2" id="tracking-no" name="tracking_no" value="<?= isset($invoice) ? $invoice->tracking_number : '' ?>">
                                        </div>

                                        <div class="col-12 col-md-2">
                                            <label for="ship-via">Ship via</label>
                                            <input type="text" class="form-control nsm-field mb-2" id="ship-via" name="ship_via" value="<?= isset($invoice) ? $invoice->ship_via : '' ?>">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="shipping-date">Shipping date</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" class="form-control nsm-field mb-2 date" id="shipping-date" name="shipping_date" value="<?= isset($invoice) && $invoice->shipping_date !== '' ? date("m/d/Y", strtotime($invoice->shipping_date)) : '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php

                                        $string = $number->invoice_number;
                                        $invoiceNumber = preg_replace_callback('/(\d+)/', function ($matches) {
                                            return str_pad($matches[1] + 1, 7, '0', STR_PAD_LEFT);
                                        }, $string);

                                        ?>
                                        <div class="col-12 col-md-2">
                                            <label for="invoice-no">Invoice # </label>
                                            <input type="text" class="form-control nsm-field mb-2" id="invoice-no" name="invoice_no" value="<?= isset($number) ? $invoiceNumber : "INV-" . str_pad(intval($number) + 1, 7, "0", STR_PAD_LEFT) ?>" disabled>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="job-no">Job # (optional)
                                                <span id="modal-popover-job-optional" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""></span>
                                                <!-- <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Field is auto-populated on create invoice from a Work Order."></span> -->
                                            </label>
                                            <input type="text" class="form-control nsm-field mb-2" id="job-no" name="job_no" value="<?= isset($invoice) ? $invoice->work_order_number : '' ?>">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="purchase-order-no">Purchase order # (optional)
                                                <span id="modal-popover-purchase-order-optional" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""></span>
                                                <!-- <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Optional if you want to display the purchase order number on invoice."></span> -->
                                            </label>
                                            <input type="text" class="form-control nsm-field mb-2" id="purchase-order-no" name="purchase_order_no" value="<?= isset($invoice) ? $invoice->po_number : '' ?>">
                                        </div>

                                        <div class="col-12 col-md-2">
                                            <label for="billing-address">Billing address</label>
                                            <textarea name="billing_address" id="billing-address" class="form-control nsm-field mb-2"><?= isset($invoice) ? str_replace("<br />", "", $invoice->billing_address) : '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-12 col-md-2">
                                            <label for="date-issued">Date issued <span class="text-danger">*</span></label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" name="date_issued" id="date-issued" class="form-control nsm-field mb-2 date" value="<?= isset($invoice) ? date("m/d/Y", strtotime($invoice->date_issued)) : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="due-date">Due date <span class="text-danger">*</span></label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" name="due_date" id="due-date" class="form-control nsm-field date" value="<?= isset($invoice) ? date("m/d/Y", strtotime($invoice->due_date)) : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control nsm-field">
                                                <option value="Draft" <?= isset($invoice) && $invoice->status === 'Draft' ? 'selected' : '' ?>>Draft</option>
                                                <option value="Submitted" <?= isset($invoice) && $invoice->status === 'Submitted' ? 'selected' : '' ?>>Submitted</option>
                                                <option value="Partially Paid" <?= isset($invoice) && $invoice->status === 'Partially Paid' ? 'selected' : '' ?>>Partially Paid</option>
                                                <option value="Paid" <?= isset($invoice) && $invoice->status === 'Paid' ? 'selected' : '' ?>>Paid</option>
                                                <option value="Due" <?= isset($invoice) && $invoice->status === 'Due' ? 'selected' : '' ?>>Due</option>
                                                <option value="Overdue" <?= isset($invoice) && $invoice->status === 'Overdue' ? 'selected' : '' ?>>Overdue</option>
                                                <option value="Approved" <?= isset($invoice) && $invoice->status === 'Approved' ? 'selected' : '' ?>>Approved</option>
                                                <option value="Declined" <?= isset($invoice) && $invoice->status === 'Declined' ? 'selected' : '' ?>>Declined</option>
                                                <option value="Schedule" <?= isset($invoice) && $invoice->status === 'Schedule' ? 'selected' : '' ?>>Schedule</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-2">
                                            <label for="shipping-to">Shipping to</label>
                                            <textarea name="shipping_to" id="shipping-to" class="form-control nsm-field mb-2"><?= isset($invoice) ? str_replace("<br />", "", $invoice->shipping_to_address) : '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row date-row">

                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-8 grid-mb">
                                            <div id="label">
                                                <label for="tags">Tags</label>
                                                <span class="float-end"><a href="#" class="text-decoration-none" id="open-tags-modal">Manage tags</a></span>
                                            </div>
                                            <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                                <?php if (isset($tags) && count($tags) > 0) : ?>
                                                    <?php foreach ($tags as $tag) : ?>
                                                        <?php
                                                        $name = $tag->name;
                                                        if ($tag->group_tag_id !== null) {
                                                            $group = $this->tags_model->getGroupById($tag->group_tag_id);
                                                            $name = $group->name . ': ' . $tag->name;
                                                        }
                                                        ?>
                                                        <option value="<?= $tag->id ?>" selected><?= $name ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 grid-mb">
                                            <table class="nsm-table" id="item-table">
                                                <thead>
                                                    <td data-name="Item">ITEM</td>
                                                    <td data-name="Type">TYPE</td>
                                                    <td data-name="Location">LOCATION</td>
                                                    <td data-name="Quantity">QUANTITY</td>
                                                    <td data-name="Price">PRICE</td>
                                                    <td data-name="Discount">DISCOUNT</td>
                                                    <td data-name="Tax">TAX (CHANGE IN %)</td>
                                                    <td data-name="Total">TOTAL</td>
                                                    <?php if (isset($invoice) && !is_null($invoice->linked_transacs) || isset($linkedTransac)) : ?>
                                                        <td data-name="Linked"></td>
                                                    <?php endif; ?>
                                                    <td data-name="Manage"></td>
                                                </thead>
                                                <tbody>
                                                    <?php if (isset($items) && count($items) > 0) : ?>
                                                        <?php foreach ($items as $item) : ?>
                                                            <?php if (!is_null($item->itemDetails)) : ?>
                                                                <?php $itemDetails = $item->itemDetails; ?>
                                                                <?php $locations = $item->locations; ?>
                                                                <tr>
                                                                    <td><?= $itemDetails->title ?><input type="hidden" name="item[]" value="<?= $item->items_id ?>"></td>
                                                                    <td><?= ucfirst($itemDetails->type) ?></td>
                                                                    <td>
                                                                        <?php if ($itemDetails->type === 'product' || $itemDetails->type === 'item') : ?>
                                                                            <select name="location[]" class="form-control nsm-field" required>
                                                                                <?php foreach ($locations as $location) : ?>
                                                                                    <option value="<?= $location['id'] ?>" <?= $item->location_id === $location['id'] ? 'selected' : '' ?>><?= $location['name'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="<?= $item->qty ?>"></td>
                                                                    <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?= number_format(floatval($item->cost), 2, '.', ',') ?>"></td>
                                                                    <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?= number_format(floatval($item->discount), 2, '.', ',') ?>"></td>
                                                                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?= number_format(floatval($item->tax), 2, '.', ',') ?>"></td>
                                                                    <td>
                                                                        <span class="row-total">
                                                                            <?php
                                                                            $rowTotal = '$' . number_format(floatval($item->total), 2, '.', ',');
                                                                            $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                            echo $rowTotal;
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <?php if (isset($invoice) && !is_null($invoice->linked_transacs) || isset($linkedTransac)) : ?>
                                                                        <td class="overflow-visible">
                                                                            <?php if (!is_null($item->linked_transaction_type) && !is_null($item->linked_transaction_id)) : ?>
                                                                                <div class="dropdown">
                                                                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                                                                    <div class="dropdown-menu">
                                                                                        <table class="nsm-table linked-transaction-table">
                                                                                            <thead>
                                                                                                <tr class="linked-transaction-header">
                                                                                                    <td data-name="Type">Type</td>
                                                                                                    <td data-name="Date">Date</td>
                                                                                                    <td data-name="Amount">Amount</td>
                                                                                                    <td data-name="Action"></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody class="linked-transaction-table-body">
                                                                                                <tr class="linked-transaction-row">
                                                                                                    <td><a class="text-decoration-none open-transaction" href="#" data-id="<?= $item->linked_transaction_id ?>" data-type="<?= str_replace('_', '-', $item->linked_transaction_type) ?>"><?= ucwords(str_replace('_', ' ', $item->linked_transaction_type)) ?></a></td>
                                                                                                    <td>
                                                                                                        <?php switch ($item->linked_transaction_type) {
                                                                                                            case 'estimate':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->estimate_date));
                                                                                                                break;
                                                                                                            case 'delayed_credit':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->delayed_credit_date));
                                                                                                                break;
                                                                                                            case 'delayed_charge':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->delayed_charge_date));
                                                                                                                break;
                                                                                                            case 'time_charge':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->date));
                                                                                                                break;
                                                                                                        } ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                        if ($item->linked_transaction_type === 'estimate') {
                                                                                                            $transacAmount = $item->linked_transac->grand_total;
                                                                                                        } else if ($item->linked_transaction_type === 'time_charge') {
                                                                                                            $price = floatval(str_replace(',', '', $item->linked_transac->hourly_rate));

                                                                                                            $hours = substr($item->linked_transac->time, 0, -3);
                                                                                                            $time = explode(':', $hours);
                                                                                                            $hr = $time[0] + ($time[1] / 60);

                                                                                                            $transacAmount = $hr * $price;
                                                                                                        } else {
                                                                                                            $transacAmount = $item->linked_transac->total_amount;
                                                                                                        }
                                                                                                        $transacAmount = '$' . number_format(floatval($transacAmount), 2, '.', ',');

                                                                                                        echo str_replace('$-', '-$', $transacAmount);
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td><button class="nsm-button unlink-transaction" data-type="<?= str_replace('_', '-', $item->linked_transaction_type) ?>" data-id="<?= $item->linked_transaction_id ?>">Remove</button></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" value="<?= $item->linked_transaction_type ?>-<?= $item->linked_transaction_id ?>" name="item_linked_transaction[]">
                                                                                <input type="hidden" value="<?= $item->linked_transaction_item_id ?>" name="transaction_item_id[]">
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    <td>
                                                                        <button type="button" class="nsm-button delete-row">
                                                                            <i class='bx bx-fw bx-trash'></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php else : ?>
                                                                <?php $packageDetails = $item->packageDetails; ?>
                                                                <?php $packageItems = $item->packageItems; ?>
                                                                <tr class="package">
                                                                    <td><?= $packageDetails->name ?><input type="hidden" name="package[]" value="<?= $packageDetails->id ?>"></td>
                                                                    <td>Package</td>
                                                                    <td></td>
                                                                    <td><input type="number" name="quantity[]" class="form-control nsm-field text-end" required value="<?= $item->qty ?>"></td>
                                                                    <td><span class="item-amount"><?= number_format(floatval($item->cost), 2, '.', ',') ?></span></td>
                                                                    <td></td>
                                                                    <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control nsm-field text-end" step=".01" value="<?= number_format(floatval($item->tax), 2, '.', ',') ?>"></td>
                                                                    <td>
                                                                        <span class="row-total">
                                                                            <?php
                                                                            $rowTotal = '$' . number_format(floatval($item->total), 2, '.', ',');
                                                                            $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                            echo $rowTotal;
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <?php if (isset($invoice) && !is_null($invoice->linked_transacs) || isset($linkedTransac)) : ?>
                                                                        <td class="overflow-visible">
                                                                            <?php if (!is_null($item->linked_transaction_type) && !is_null($item->linked_transaction_id)) : ?>
                                                                                <div class="dropdown">
                                                                                    <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                                                                    <div class="dropdown-menu">
                                                                                        <table class="nsm-table linked-transaction-table">
                                                                                            <thead>
                                                                                                <tr class="linked-transaction-header">
                                                                                                    <td data-name="Type">Type</td>
                                                                                                    <td data-name="Date">Date</td>
                                                                                                    <td data-name="Amount">Amount</td>
                                                                                                    <td data-name="Action"></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody class="linked-transaction-table-body">
                                                                                                <tr class="linked-transaction-row">
                                                                                                    <td><a class="text-decoration-none open-transaction" href="#" data-id="<?= $item->linked_transaction_id ?>" data-type="<?= str_replace('_', '-', $item->linked_transaction_type) ?>"><?= ucwords(str_replace('_', ' ', $item->linked_transaction_type)) ?></a></td>
                                                                                                    <td>
                                                                                                        <?php switch ($item->linked_transaction_type) {
                                                                                                            case 'estimate':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->estimate_date));
                                                                                                                break;
                                                                                                            case 'delayed_credit':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->delayed_credit_date));
                                                                                                                break;
                                                                                                            case 'delayed_charge':
                                                                                                                echo date("m/d/Y", strtotime($item->linked_transac->delayed_charge_date));
                                                                                                                break;
                                                                                                        } ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                        if ($item->linked_transaction_type === 'estimate') {
                                                                                                            $transacAmount = $item->linked_transac->grand_total;
                                                                                                        } else {
                                                                                                            $transacAmount = $item->linked_transac->total_amount;
                                                                                                        }
                                                                                                        $transacAmount = '$' . number_format(floatval($transacAmount), 2, '.', ',');

                                                                                                        echo str_replace('$-', '-$', $transacAmount);
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td><button class="nsm-button unlink-transaction" data-type="<?= str_replace('_', '-', $item->linked_transaction_type) ?>" data-id="<?= $item->linked_transaction_id ?>">Remove</button></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" value="<?= $item->linked_transaction_type ?>-<?= $item->linked_transaction_id ?>" name="item_linked_transaction[]">
                                                                                <input type="hidden" value="<?= $item->linked_transaction_item_id ?>" name="transaction_item_id[]">
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                    <td>
                                                                        <button type="button" class="nsm-button delete-row">
                                                                            <i class='bx bx-fw bx-trash'></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <tr class="package-items">
                                                                    <td colspan="3">
                                                                        <table class="nsm-table">
                                                                            <thead>
                                                                                <tr class="package-item-header">
                                                                                    <th>Item Name</th>
                                                                                    <th>Quantity</th>
                                                                                    <th>Pricedfd</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="package-items-table">
                                                                    <?php if (is_array($packageItems) && count($packageItems) > 0) : ?>
                                                                        <?php foreach ($packageItems as $packageItem) : ?>
                                                                            <?php $item = $this->items_model->getItemById($packageItem->item_id)[0]; ?>
                                                                            <tr class="package-item">
                                                                                <td><?= $item->title ?></td>
                                                                                <td><?= $packageItem->quantity ?></td>
                                                                                <td><?= number_format(floatval($packageItem->price), 2, '.', ',') ?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    <?php else : ?>
                                                                        <tr>
                                                                            <td colspan="3">No package items found.</td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <?php if (isset($invoice) && !is_null($invoice->linked_transacs) || isset($linkedTransac)) : ?>
                                                                        <td></td>
                                                                    <?php endif; ?>
                                                                    <td></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="10">
                                                            <div class="nsm-page-buttons page-buttons-container">
                                                                <button type="button" class="nsm-button" id="add_item">
                                                                    Add items
                                                                </button>
                                                                <button type="button" class="nsm-button" id="add_group">
                                                                    Add By Group
                                                                </button>
                                                                <button type="button" class="nsm-button" id="add_create_package">
                                                                    Add/Create Package
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Request a Deposit</h5>
                                                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <select name="deposit_request_type" id="deposit-request-type" class="form-control nsm-field">
                                                        <option value="$" <?= isset($invoice) && $invoice->deposit_request_type === '$' ? 'selected' : '' ?>>Deposit amount $</option>
                                                        <option value="%" <?= isset($invoice) && $invoice->deposit_request_type === '%' ? 'selected' : '' ?>>Percentage %</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <input type="number" class="form-control nsm-field mb-2" id="deposit-amount" name="deposit_amount" onchange="convertToDecimal(this)" value="<?= isset($invoice) ? $invoice->deposit_request : '0.00' ?>" step=".01">
                                                </div>
                                                <div class="col-12 title-header">
                                                    <h5>Payment Schedule</h5>
                                                    <span class="help help-sm help-block">Split the balance into multiple payment milestones.</span>
                                                    <p><a href="#" id="manage-payment-schedule" style="color:#02A32C;"><i class="bx bx-fw bxs-plus-square" aria-hidden="true"></i> Manage payment schedule </a></p>
                                                </div>
                                                <div class="col-12 title-header">
                                                    <h5>Accepted payment methods</h5>
                                                    <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                                                </div>
                                                <div class="col-12 col-md-4 bank-type">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="credit_card_payments" value="1" <?= isset($paymentMethods) && in_array('Credit Card', $paymentMethods) || !isset($invoice) ? 'checked' : '' ?> id="credit-card-payments">
                                                        <label for="credit-card-payments" class="form-check-label"><span>Credit Card Payments</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-11" style="margin-top:8px;">
                                                    <span class="help help-sm help-block" style="margin-bottom: 10px;">Your client can pay your invoice using credit card or bank account online. You will be notified when your client makes a payment and the money will be transferred to your bank account automatically.</span>
                                                    <div class="float-left mini-stat-img mr-4 credit-cards"><img src="<?= $url->assets ?>frontend/images/credit_cards.png" alt=""></div>
                                                </div>
                                                <div class="col-12">
                                                    <span class="help help-sm help-block">Your payment processor is not set up <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal" data-target="#modalNewCustomer">setup payment</a></span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3 bank-type">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="bank_transfer" value="1" <?= isset($paymentMethods) && in_array('Bank Transfer', $paymentMethods) || !isset($invoice) ? 'checked' : '' ?> id="bank-transfer">
                                                            <label for="bank-transfer" class="form-check-label"><span>Bank Transfer</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 bank-type">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="instapay" value="1" <?= isset($paymentMethods) && in_array('Instapay', $paymentMethods) || !isset($invoice) ? 'checked' : '' ?> id="instapay-payment">
                                                            <label for="instapay-payment" class="form-check-label"><span>Instapay</span></label>
                                                        </div>
                                                    </div>

                                                    <div class="col-3 bank-type">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="deposit" value="1" <?= isset($paymentMethods) && in_array('Deposit', $paymentMethods) || !isset($invoice) ? 'checked' : '' ?> id="deposit-payment">
                                                            <label for="deposit-payment" class="form-check-label"><span>Deposit</span></label>
                                                        </div>
                                                    </div>                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="col-3 bank-type">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="check" value="1" <?= isset($paymentMethods) && in_array('Check', $paymentMethods) || !isset($invoice) ? 'checked' : '' ?> id="check-payment">
                                                            <label for="check-payment" class="form-check-label"><span>Check</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 bank-type">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="cash" value="1" <?= isset($paymentMethods) && in_array('Cash', $paymentMethods) || !isset($invoice) ? 'checked' : '' ?> id="cash-payment">
                                                            <label for="cash-payment" class="form-check-label"><span>Cash</span></label>
                                                        </div>
                                                    </div>
                                                </div>

                                             
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <div class="col-12 col-md-6 offset-md-6">
                                                    <table class="nsm-table float-end text-end">
                                                        <tfoot>
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td>
                                                                    <span class="transaction-subtotal" style="">
                                                                        <?php if (isset($invoice)) : ?>
                                                                            <?php
                                                                            $amount = '$' . number_format(floatval($invoice->sub_total), 2, '.', ',');
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
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-4" style="text-align:right; padding-top: 5px;">Taxes</div>
                                                                        <div class="col-8">
                                                                            <select class="form-control" name="tax_rates" id="tax_rates">
                                                                                <?php foreach ($ac_tax_rates as $rates) { ?>
                                                                                    <option value="<?php echo $rates->id; ?>"><?php echo $rates->name . ' -  <span style="float:right;">' . $rates->rate . '%</span> <i> ( ' . $rates->type . ' ) </i>'; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                    <span class="transaction-taxes" style="">
                                                                        <?php if (isset($invoice)) : ?>
                                                                            <?php
                                                                            $amount = '$' . number_format(floatval($invoice->taxes), 2, '.', ',');
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
                                                                <td>
                                                                    <span class="transaction-discounts" style="">
                                                                        <?php if (isset($invoice)) : ?>
                                                                            <?php
                                                                            $amount = '$' . number_format(floatval($invoice->discount_total), 2, '.', ',');
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
                                                                <td>
                                                                    <div class="row" style="float: right;">
                                                                        <div class="col-10">
                                                                            <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control nsm-field" value="<?= isset($invoice) ? $invoice->adjustment_name : '' ?>">
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                    <input type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="<?= isset($invoice) ? number_format(floatval($invoice->adjustment_value), 2, '.', ',') : '' ?>">
                                                                </div> -->
                                                                        <div class="col-1 d-flex align-items-center" style="padding-left: 0 !important;">
                                                                            <span id="modal-help-popover-adjustment" class='bx bx-fw bx-help-circle' data-bs-trigger="hover" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="" style="margin-right: -19px;"></span>
                                                                            <!-- <span class="bx bx-fw bx-help-circle" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" data-bs-content="Optional it allows you to adjust the total amount Eg. +10 or -10." style=""></span> -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>

                                                                    <input style="float: right; width: 75px;" type="number" name="adjustment_value" id="adjustment_input_cm" step=".01" class="form-control nsm-field adjustment_input_cm_c" onchange="convertToDecimal(this)" value="<?= isset($invoice) ? number_format(floatval($invoice->adjustment_value), 2, '.', ',') : '' ?>">
                                                                    <!-- 
                                                            <span class="transaction-adjustment">
                                                                <?php if (isset($invoice)) : ?>
                                                                    <?php
                                                                    $amount = '$' . number_format(floatval($invoice->adjustment_value), 2, '.', ',');
                                                                    $amount = str_replace('$-', '-$', $amount);
                                                                    echo $amount;
                                                                    ?>
                                                                <?php else : ?>
                                                                    $0.00
                                                                <?php endif; ?>
                                                            </span>
                                                            -->
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Grand Total ($)</td>
                                                                <td>
                                                                    <span class="transaction-grand-total" style="">
                                                                        <?php if (isset($invoice)) : ?>
                                                                            <?php
                                                                            $amount = '$' . number_format(floatval($invoice->grand_total), 2, '.', ',');
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
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                        <hr />
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <h5 class="title-header">Message to Customer</h5>
                                                    <span class="help help-sm help-block">Add a message that will be displayed on the <br/> invoice.</span>
                                                    <textarea name="message_to_customer" cols="40" rows="4" class="form-control nsm-field mb-2"><?= isset($invoice) ? $invoice->message_to_customer : 'Thank you for your business.' ?></textarea>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <h5 class="title-header">Terms &amp; Conditions</h5>
                                                    <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the <br/> invoice.</span>
                                                    <textarea name="terms_and_conditions" cols="40" rows="4" class="form-control nsm-field mb-2"><?= isset($invoice) ? $invoice->terms_and_conditions : '' ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label>
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="invoice-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="#" id="show-existing-attachments" class="text-decoration-none">Show existing</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (isset($invoice) && !is_null($invoice->linked_transacs)) : ?>
                                    <div class="w-auto nsm-callout primary" style="display: none">
                                        <div class="transactions-container h-100 p-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4>Add to Invoice</h4>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-2">
                                                        <label for="">Filter by</label>
                                                        <select class="form-control nsm-field" id="transaction-type">
                                                            <option value="all" selected>All types</option>
                                                            <option value="charges">Charges</option>
                                                            <option value="credits">Credits</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <select class="form-control nsm-field" id="transaction-date">
                                                            <option value="all" selected>All dates</option>
                                                            <option value="this-month">This month</option>
                                                            <option value="last-month">Last month</option>
                                                            <option value="custom">Custom...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php foreach ($linkableTransactions as $linkableTransac) : ?>
                                                    <?php
                                                    $title = $linkableTransac['type'];
                                                    $title .= $linkableTransac['number'] !== '' ? ' #' . $linkableTransac['number'] : '';
                                                    ?>
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?= $title ?></h5>
                                                                <p class="card-subtitle"><?= $linkableTransac['formatted_date'] ?></p>
                                                                <p class="card-text"><?= $linkableTransac['balance'] ?></p>
                                                                <ul class="d-flex justify-content-around list-unstyled">
                                                                    <li><a href="#" class="add-transaction text-decoration-none" data-id="<?= $linkableTransac['id'] ?>" data-type="<?= $linkableTransac['type'] ?>"><strong>Add</strong></a></li>
                                                                    <li><a href="#" class="open-transaction text-decoration-none" data-id="<?= $linkableTransac['id'] ?>" data-type="<?= $linkableTransac['type'] ?>"><strong>Open</strong></a></li>
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

                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-12 col-md-4">
                                    <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="row h-100">
                                        <div class="col-md-12 d-flex align-items-center justify-content-center">
                                            <span><a href="#" class="text-dark text-decoration-none" id="save-and-print">Print or Preview</a></span>
                                            <span class="mx-3 divider"></span>
                                            <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('invoice')">Make Recurring</a></span>
                                            <?php if (isset($invoice)) : ?>
                                                <span class="mx-3 divider"></span>
                                                <span>
                                                    <div class="dropup">
                                                        <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#" id="copy-invoice">Copy</a>
                                                            <?php if ($invoice->voided !== "1") : ?>
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
                                <div class="col-12 col-md-4">
                                    <!-- Split dropup button -->
                                    <div class="btn-group float-md-end" role="group">
                                        <button id="saveAndCloseButton" type="button" class="nsm-button success" onclick="saveAndCloseForm(event)">
                                            Save and close
                                        </button>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-fw bx-chevron-up text-white"></i>
                                            </button>
                                            <div class="dropdown-menu">
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
            </div>
            <!--end of modal-->
            </form>
</div>

<script>
    $(document).ready(function() {
        $('#modal-help-popover-adjustment').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Optional it allows you to adjust the total amount Eg. +10 or -10.';
            }
        });

        $('#modal-popover-job-optional').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Field is auto-populated on create invoice from a Work Order.';
            }
        });

        $('#modal-popover-purchase-order-optional').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Optional if you want to display the purchase order number on invoice.';
            }
        });
    });
</script>