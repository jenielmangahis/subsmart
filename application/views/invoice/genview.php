<?php

defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php include viewPath('includes/header'); ?>

    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/invoice'); ?>

        <div wrapper__section>
            <?php include viewPath('includes/notifications'); ?>
            <?php if (!empty($invoice)) : ?>
                <div class="custom__div">
                    <div class="card">
                        <div class="container-fluid" style="font-size:16px;">
                            <div class="row">
                                <div class="col-sm-12 pb-10">
                                    <h1>Invoice# <?php echo $invoice->invoice_number ?></h1>
                                </div>
                                <div class="row col-xl-12" data-id="invoices">
                                    <div class="col-xl-2 margin-bottom margin-top">
                                        <div style="padding-top: 6px;">
                                            <a class="a-hunderline" href="<?php echo base_url('invoice') ?>"><span class="fa fa-angle-left fa-size-md"></span>Return to Invoices</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 margin-bottom margin-top text-right pr-0">
                                        <input type="hidden" id="autoOpenModalRP" value="<?php echo $record_payment ?>">
                                        <input type="hidden" id="recordPaymentInvoiceId" value="<?php echo $invoice->id ?>">
                                        <?php if(strtolower($invoice->status) === 'paid') : ?>
                                        <a class="btn btn-primary margin-right-sec" href="<?php echo base_url('invoice/send/'. $invoice->id) ?>"><span class="fa fa-paper-plane-o fa-margin-right"></span> Send Invoice</a>
                                        <?php elseif(strtolower($invoice->status) === 'due') : ?>
                                            <a class="btn btn-primary margin-right-sec" class="link-modal-open openPayNow" href="javascript:void(0)" data-toggle="modal" data-target="#modalPayNow" data-id="<?php echo $invoice->id ?>" data-invoice-number="<?php echo $invoice->invoice_number ?>"><span class="fa fa-usd fa-margin-right"></span> Pay Now</a>
                                            <a class="btn btn-primary margin-right-sec" class="link-modal-open recordPaymentBtn" href="javascript:void(0)" data-toggle="modal" data-target="#modalRecordPayment" data-id="<?php echo $invoice->id ?>"><span class="fa fa-usd fa-margin-right"></span> Record Payment</a>
                                        <?php else : ?>
                                            <a class="btn btn-primary margin-right-sec" href="<?php echo base_url('invoice/send/'. $invoice->id) ?>"><span class="fa fa-paper-plane-o fa-margin-right"></span> Send Invoice</a>
                                            <a class="btn btn-primary margin-right-sec" href="<?php echo base_url('invoice/send/'. $invoice->id .'?scheduled=1') ?>"><span class="fa fa-calendar fa-margin-right"></span>
                                                Schedule
                                            </a>
                                            <a class="btn btn-primary margin-right-sec" class="link-modal-open recordPaymentBtn" href="javascript:void(0)" data-toggle="modal" data-target="#modalRecordPayment" data-id="<?php echo $invoice->id ?>"><span class="fa fa-usd fa-margin-right"></span> Record Payment</a>
                                            <a class="btn btn-primary margin-right-sec" class="link-modal-open openPayNow" href="javascript:void(0)" data-toggle="modal" data-target="#modalPayNow" data-id="<?php echo $invoice->id ?>" data-invoice-number="<?php echo $invoice->invoice_number ?>"><span class="fa fa-usd fa-margin-right"></span> Pay Now</a>
                                        <?php endif; ?>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a class="btn btn-sec" href="<?php echo base_url('invoice/edit/'. $invoice->id) ?>"><span class="fa fa-edit"></span> Edit</a>
                                            <a class="btn btn-sec" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>" target="_blank"><span class="fa fa-file-pdf-o fa-margin-right"></span> PDF</a>
                                            <a class="btn btn-sec" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>" target="_blank"><span class="fa fa-print fa-margin-right"></span> Print</a>
                                        </div>
                                        <div class="dropdown dropdown-btn dropdown-inline margin-left-sec">
                                            <button class="btn btn-sec btn-regular dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                <span class="btn-label">More</span><span class="caret-holder"><span class="caret"></span></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                <?php if(strtolower($invoice->status) === 'due') : ?>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/send/'. $invoice->id) ?>"><span class="fa fa-envelope-o icon"></span> Send Reminder</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/send/'. $invoice->id) ?>"><span class="fa fa-envelope-o icon"></span> Resend Invoice</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-share-modal="open" data-invoice-id="297845" data-url="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>" data-invoice-custom-number="INV-000500"><span class="fa fa-link icon"></span> Share Invoice Link</a></li>
                                                <?php elseif(strtolower($invoice->status) === 'paid') : ?>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/send/'. $invoice->id) ?>"><span class="fa fa-envelope-o icon"></span> Resend Invoice</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/send/'. $invoice->id) ?>"><span class="fa fa-envelope-o icon"></span> Send Receipt</a></li>
                                                <?php else: ?>
                                                <li role="presentation"><a role="menuitem" class="openMarkAsSent" tabindex="-1"  href="javascript:void(0)" data-toggle="modal" data-target="#markAsSent" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>"><span class="fa fa-check-square-o icon"></span> Mark as Sent</a></li>
                                                <?php endif; ?>    
                                                <li role="presentation"><a role="menuitem" class="openConvertToWorkOrder" tabindex="-1"  href="javascript:void(0)" data-toggle="modal" data-target="#convertToWorkOrder" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>"><span class="fa fa-file-text-o icon"></span> Convert to Work Order</a></li>
                                                <li role="presentation"><a role="menuitem" class="openCloneInvoice" tabindex="-1" href="javascript:void(0)" data-toggle="modal" data-target="#cloneModal" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>"><span class="fa fa-files-o icon"></span> Clone Invoice</a></li>
                                                <li role="presentation"><a role="menuitem" class="openDeleteInvoice" tabindex="-1" href="javascript:void(0)" data-toggle="modal" data-target="#cancelModal" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>"><span class="fa fa-trash-o icon"></span> Delete Invoice</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="invoice-paper" id="presenter-paper">
                                        <div class="presenter-paper-sm" id="presenter-paper-sm"></div>
                                        <div class="ribbon ribbon-<?php echo strtolower($invoice->status) ?>"><span><?php echo $invoice->status ?></span></div>
                                        <div class="invoice-print" style="background: #ffffff; padding: 10px;">
                                            <table class="table-print" style="width: 100%; margin-bottom: 10px;">
                                                <tbody>
                                                    <tr>
                                                        <td id="presenter-col-left" class="presenter-col-left" style="width: 50%" valign="top">
                                                            <div style="margin-bottom: 20px;">
                                                                <!-- <img class="invoice-print-logo" style="max-width: 230px; max-height: 200px;" src="<?php echo base_url() .'uploads/'. (($setting) ? $setting->logo : '') ?>"> -->
                                                                <img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" />
                                                            </div>
                                                            
                                                            <div id="presenter-from">
                                                                <b>FROM:</b>
                                                                <br>
                                                                <b><?php echo ($setting) ? $setting->check_payable_to : $user->FName . ' ' . $user->LName ?></b><br>
                                                                <?php echo strtolower($user->address) ?><br>
                                                                Email: <?php echo strtolower($user->email) ?><br>
                                                                
                                                                <table>
                                                                    <tbody><tr>
                                                                        <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                                                        <td>
                                                                            <?php echo strtolower($user->phone) ?><br><br><br>                          
                                                                        </td>
                                                                    </tr>
                                                                </tbody></table>

                                                                <br>
                                                            </div>

                                                        </td>
                                                        <td id="presenter-col-right" class="presenter-col-right" style="width: 50%; text-align: right;" valign="top">
                                                            <div id="presenter-title-container" class="presenter-title-container" style="margin-top: 10px; margin-bottom: 20px;">
                                                                <span class="presenter-title" style="font-size: 30pt;">INVOICE</span><br>
                                                                <span># <?php echo $invoice->invoice_number ?></span>
                                                            </div>
                                                            <div id="presenter-summary" class="presenter-summary">
                                                                <table style="width: 100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="text-align: right;">Date Issued:</td>
                                                                            <td style="width: 180px; text-align: right;" class="text-right">
                                                                                <?php echo get_format_date($invoice->date_issued) ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;">Date Due:</td>
                                                                            <td style="width: 180px; text-align: right;" class="text-right">
                                                                            <?php echo ($invoice->due_date > date('Y-m-d')) ? get_format_date($invoice->due_date) : "Due on Receipt" ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;">Type:</td>
                                                                            <td style="width: 180px; text-align: right;" class="text-right"><?php echo $invoice->invoice_type ?></td>
                                                                        </tr>
                                                                                                    <tr>
                                                                            <td style="text-align: right;">Work Order#:</td>
                                                                            <td style="width: 180px; text-align: right;" class="text-right"><?php echo $invoice->work_order_number ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;">Check Payable To:</td>
                                                                            <td style="width: 180px; text-align: right;" class="text-right"><?php echo $user->FName . ' ' . $user->LName ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;"><b>Balance Due:</b></td>
                                                                            <td style="width: 180px; text-align: right;" class="text-right"><b>$0.00</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table-print" style="width: 100%">
                                                <tbody>
                                                    <tr>
                                                    <td style="width: 50%" valign="top">
                                                        <b>TO:</b><br>
                                                        <b><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></b>
                                                        <span class="middot">·</span>
                                                        <a href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>">view</a><br>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->suite_unit ?>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->street_address ?><br>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->city . ',' ?>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->state . ',' ?>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->postal_code?><br>
                                                         <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="vertical-align: top;" valign="top">Phone:&nbsp;</td>
                                                                    <td>
                                                                        <?php echo get_customer_by_id($invoice->customer_id)->mobile?><br>
                                                                        <?php echo get_customer_by_id($invoice->customer_id)->phone?><br>                        
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td style="width: 50%" valign="top">
                                                        <b>JOB LOCATION:</b><br>
                                                        <b><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></b><br>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->suite_unit ?>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->street_address ?><br>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->city . ',' ?>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->state . ',' ?>
                                                        <?php echo get_customer_by_id($invoice->customer_id)->postal_code?><br>
                                                        Phone:&nbsp; <?php echo get_customer_by_id($invoice->customer_id)->phone?>                
                                                    </td>
                                                </tr>
                                            </tbody></table>

                                            <br>

                                            <b>JOB:</b>
                                            <br>
                                                <?php echo $invoice->job_name ?><br>
                                                
                                            <br>
                                            <div class="table-items-container">
                                                <?php $total_tax = 0; ?>
                                                <?php if (false) : ?>
                                                <table class="table-print table-items" style="width: 100%; border-collapse: collapse;">
                                                    <thead>
                                                        <tr>
                                                            <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
                                                            <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Materials</th>
                                                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;" class="<?php echo ($setting && $setting->invoice_template["item_qty"]) ? 'hide-th': ''?>">Qty</th>
                                                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;" class="<?php echo ($setting && $setting->invoice_template["item_price"]) ? 'hide-th': ''?>">Price</th>
                                                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;" class="<?php echo ($setting && $setting->invoice_template["item_discount"]) ? 'hide-th': ''?>">Discount</th>
                                                            <th style="background: #f4f4f4; text-align: right; padding: 5px 0;" class="<?php echo ($setting && $setting->invoice_template["item_tax"]) ? 'hide-th': ''?>">Tax</th>
                                                            <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="<?php echo ($setting && $setting->invoice_template["item_total"]) ? 'hide-th text-right': 'text-right'?>">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($invoice->invoice_items as $key => $value ) : ?>
                                                        <tr class="table-items__tr">
                                                            <td style="width:30px; text-align:center;" valign="top">
                                                                <?php echo intval($key) + 1 ?>
                                                            </td>
                                                            <td valign="top">
                                                                <?php echo $value['item'] ?>
                                                            </td>
                                                            <td style="width: 50px; text-align: right;" class="<?php echo ($setting && $setting->invoice_template["item_qty"]) ? 'hide-th': ''?>" valign="top">
                                                                <?php echo $value['quantity'] ?>                    
                                                            </td>
                                                            <td style="width: 80px; text-align: right;" class="<?php echo ($setting && $setting->invoice_template["item_price"]) ? 'hide-th': ''?>" valign="top">
                                                                $<?php echo number_format($value['price'], 2, '.', ',') ?>                    
                                                            </td>
                                                            <td style="width: 80px; text-align: right;" class="<?php echo ($setting && $setting->invoice_template["item_discount"]) ? 'hide-th': ''?>" valign="top">
                                                                $0.00                    
                                                            </td>
                                                            <td style="width: 80px; text-align: right;" class="<?php echo ($setting && $setting->invoice_template["item_tax"]) ? 'hide-th': ''?>" valign="top">
                                                                $<?php echo number_format($value['tax'], 2, '.', ',') ?> <br>(7.5%) 
                                                                <?php $total_tax += floatval($value['tax']); ?>                   
                                                            </td>
                                                            <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right;" class="<?php echo ($setting && $setting->invoice_template["item_total"]) ? 'hide-th': ''?>" valign="top">
                                                                $<?php echo number_format($value['total'], 2, '.', ',') ?>                    
                                                            </td>
                                                        </tr>
                                                        <tr class="table-items__tr-last">
                                                            <td></td>
                                                            <td colspan="6"></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?php endif; ?>
                                                <table class="table-print table-totals" style="width: 100%; margin-top: 10px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 50%; text-align: right;"></td>
                                                            <td>
                                                                <table style="width: 100%; border-collapse: collapse;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="padding: 8px 0; text-align: right;" class="text-right">Subtotal (without tax)</td>
                                                                            <td style="padding: 8px 8px 8px 0; text-align: right;" class="text-right">$<?php echo (false) ? number_format(floatval($invoice->invoice_totals['sub_total'] - $total_tax), 2, '.', ',') : '' ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 8px 0; text-align: right;" class="text-right">Taxes</td>
                                                                            <td style="padding: 8px 8px 8px 0; text-align: right;" class="text-right">$<?php echo number_format($total_tax, 2, '.', ',') ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>Grand Total ($)</b></td>
                                                                            <td style="width: 120px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$<?php echo (false) ? number_format($invoice->invoice_totals['grand_total'], 2, '.', ',') : '' ?></b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 50%; text-align: right;"></td>
                                                            <td>
                                                                <table style="width: 100%; border-collapse: collapse;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="padding: 4px 0; text-align: right;" class="text-right"><b>Balance Due</b></td>
                                                                            <td style="width: 120px; padding: 4px 8px 4px 0; text-align: right;" class="text-right"><b>$0.00</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <br>
                                            <p>
                                                <b>Accepted payment methods</b><br>
                                                <?php echo ($invoice->accept_credit_card) ? "Credit Card," : '' ?> 
                                                <?php echo ($invoice->accept_check) ? "Check" : '' ?>
                                                <?php echo ($invoice->accept_cash) ? "Cash" : '' ?>
                                                <?php echo ($invoice->accept_direct_deposit) ? "Direct Deposit" : '' ?>    
                                            </p>

                                                <p>
                                                Accepting Mobile Payments
                                            </p>
                                            
                                                <p>
                                                <b>Message</b><br>
                                                <?php echo ($invoice->message_to_customer)?>  
                                            </p>
                                            <br>
                                            <hr style="border-color:#eaeaea;">
                                            <p style="color:#888;">
                                                Business powered by nSmarTrac
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-1 col-md-5">
                                    <div class="panel-info margin-bottom">
                                        <div class="weight-medium margin-bottom-sec">Payments Received</div>
                                        <p class="text-ter">No payments have been recorded</p>
                                    </div>

                                    <div class="panel-info">
                                        <div class="weight-medium margin-bottom-sec">Log</div>
                                        <div class="row margin-bottom-sec">
                                            <div class="col-xl-5">16-Apr-2020 16:56</div>
                                            <div class="col-xl-7">
                                                Invoice draft &nbsp;
                                                <span class="text-ter">by Alarm Direct</span>
                                                <div class="text-ter">(created by pro)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="margin-top">
                            <a class="a-hunderline" href="<?php echo base_url('invoice') ?>"><span
                                        class="fa fa-angle-left fa-size-md"></span>Return to Invoices</a>
                        </div>
                        
                        <!-- Modal Record Payment -->
                        <div class="modal in" id="modalRecordPayment" tabindex="-1" role="dialog">
                            <div class="modal-dialog record-payment-modal" role="document">
                                <div class="modal-content">
                                    <?php echo form_open('invoice/save_payment_record', ['class' => 'form-validate require-validation', 'id' => 'payment_form', 'autocomplete' => 'off']); ?>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Record Payment</h4>
                                        </div>
                                        <div class="modal-body">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Record Payment</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Pay Now -->
                        <div class="modal in" id="modalPayNow" tabindex="-1" role="dialog">
                            <div class="modal-dialog pay-now-modal" role="document">
                                <div class="modal-content">
                                <?php echo form_open('invoice/stripePost', ['class' => 'form-validate require-validation', 'id' => 'payment_form', 'autocomplete' => 'off']); ?>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Pay Now</h4>
                                    </div>
                                    <div class="modal-body">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Pay Now</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="modal in" id="markAsSent" data-mark-as-sent-modal="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" style="max-width:600px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Mark as Sent</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="validation-error" style="display: none;"></div>
                                        <form name="mark-as-sent-modal-form">
                                            <p>
                                                You are going to mark as sent the <b>Invoice# <span id='markAsSentId'></span></b>
                                            </p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        <a href="#" id="markAsSentBtn">
                                            <button class="btn btn-primary" type="button" data-mark-as-sent-modal="submit">Mark as Sent</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal in" id="convertToWorkOrder" tabindex="-1" role="dialog">
                            <div class="modal-dialog" style="max-width:600px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Convert Invoice To Work Order</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="validation-error" style="display: none;"></div>
                                        <form name="convert-to-work-order-modal-form">
                                            <p>
                                                You are going create a new work order based on <b>Invoice# <span id='workOrderInvoiceId'"></span></b>.<br>
                                                The invoice items (e.g. materials, labour) will be copied to this work order.<br>
                                                You can always edit/delete work order items as you need.
                                            </p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="button" data-convert-to-work-order-modal="submit">Convert To Work Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal in" id="cloneModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" style="max-width:600px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Clone Invoice</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="validation-error" style="display: none;"></div>
                                        <form name="clone-modal-form">
                                            <p>
                                                You are going create a new invoice based on Invoice# <span id='cloneInvoiceId'></span>.<br>
                                                The new invoice will contain the same items (e.g. materials, labour) and you
                                                will be able to edit and remove the invoice items as you need.
                                            </p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        <a href="#" id="cloneInvoiceBtn">
                                            <button class="btn btn-primary" type="button" data-clone-modal="submit">Clone Invoice</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal in" id="cancelModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" style="max-width:600px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Delete Invoice</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="validation-error" style="display: none;"></div>
                                        <form name="cancel-modal-form">
                                            <p>
                                                Are you sure you want to delete the <span class="bold">Invoice# <span id='deleteInvoiceId'></span></span>?
                                            </p>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                        <a href="#" id="deleteInvoiceBtn">
                                            <button class="btn btn-primary" type="button" data-cancel-modal="submit">Yes, Delete Invoice</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>


<?php include viewPath('includes/footer'); ?>
