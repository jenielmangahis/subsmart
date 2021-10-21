<?php
if ($filter_type == "All transactions" || $filter_type == "All plus deposits" || $filter_type == "All invoices" || $filter_type == "All transactions"  || $filter_type == "Overdue invoices") {
    foreach ($invoices as $inv):?>
<tr>
    <td><input type="checkbox"></td>
    <td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?>
    </td>
    <td><?php echo 'Invoice'; ?>
    </td>
    <td><?php echo $inv->invoice_number; ?>
    </td>
    <td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name; ?>
    </td>
    <td><?php  echo date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->due_date)); ?>
    </td>
    <td><?php echo number_format($inv->balance, 2); ?>
    </td>
    <td><?php echo number_format($inv->total_due, 2); ?>
    </td>
    <td><?php echo $inv->INV_status; ?>
    </td>
    <td class="text-right" style="padding-right:20px;">
        <!-- <a href="">View</a> -->

        <div class="dropdown dropdown-btn">
            <?php if ($inv->INV_status == 'Paid') { ?>
            <a href="<?php echo base_url('accounting/invoice_edit/' . $inv->id) ?>"
                style="color:gray;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            &emsp; <a
                href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>"
                style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a> &emsp;
            <?php } else { ?>
            <a href="<?php echo base_url('accounting/invoice_edit/' . $inv->id) ?>"
                style="color:gray;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            &emsp;
            <!-- <a href="#" style="color:#3a96d2;" data-toggle="modal" data-target="#addreceivepaymentModal">Receive payment</a>  -->
            <a href="" style="color:#3a96d2;font-weight:bold;" class="first-option customer_receive_payment_btn"
                data-customer-id="<?=$inv->customer_id?>">Receive
                payment </a>
            &emsp;
            <?php } ?>

            <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                data-toggle="dropdown" aria-expanded="true">
                <span class="btn-label"></span>
                <span class="caret-holder">
                    <span class="caret"></span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/send/' . $inv->id) ?>">
                        <span class="fa fa-envelope-o icon"></span> Send Invoice</a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('accounting/invoice_edit/' . $inv->id) ?>">
                        <span class="fa fa-pencil-square-o icon"></span>
                        Edit
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/genview/' . $inv->id) ?>">
                        <span class="fa fa-file-text-o icon"></span>
                        View Invoice
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/genview/' . $inv->id) . "?do=payment_add" ?>">
                        <span class="fa fa-usd icon"></span>
                        Record Invoice
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('workorder/invoice_workorder/' . $inv->id) ?>"
                        data-convert-to-invoice-modal="open"
                        data-id="<?php echo $inv->id ?>"
                        data-invoice-number="<?php echo $inv->invoice_number ?>">
                        <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" class="openCloneInvoice" tabindex="-1" href="javascript:void(0)"
                        data-toggle="modal" data-target="#cloneModal"
                        data-invoice-number="<?php echo $inv->invoice_number ?>"
                        data-id="<?php echo $inv->id ?>">
                        <span class="fa fa-files-o icon"></span> Clone Invoice
                    </a>
                </li>
                <li class="share-invoice-link-btn"
                    data-invoice-id="<?=$inv->id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        <span class="fa fa-share icon" aria-hidden="true"></span>
                        Share invoice link
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" class="openDeleteInvoice" tabindex="-1" href="javascript:void(0)"
                        data-invoice-number="<?php echo $inv->invoice_number ?>"
                        data-id="<?php echo $inv->id ?>"
                        id="deleteInvoiceBtnNew">
                        <span class="fa fa-trash-o icon"></span> Delete Invoice
                    </a>
                    <!-- <a href="#" work-id="<?php //echo $workorder->id;?>"
                    id="delete_workorder"><span class="fa fa-trash-o icon"></span> Delete
                    </a> -->
                </li>
                <li role="separator" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=pdf') ?>"><span
                            class="fa fa-file-pdf-o icon"></span> Invoice PDF</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>"><span
                            class="fa fa-print icon"></span> Print Invoice</a></li>
            </ul>
        </div>

    </td>
</tr>
<?php endforeach;
}?>

<?php
if ($filter_type == "All transactions" || $filter_type == "All plus deposits"  || $filter_type == "Open estimates") {
    foreach ($estimates as $estimate) { ?>
<tr id="estimates_rows">
    <td><input type="checkbox"></td>
    <td>
            <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($estimate->estimate_date)) ?>
    </td>
    <td>
        <?php echo 'Estimate'; ?>
    </td>
    <td>
        <a class="a-default" href="#">
            <?php echo $estimate->estimate_number; ?>
        </a>
    </td>
    <td>
        <div><a href="#"><?php echo $estimate->job_name; ?></a>
        </div>
        <a
            href="<?php echo base_url('customer/view/' . $estimate->customer_id) ?>">
            <?php echo get_customer_by_id($estimate->customer_id)->first_name .' '. get_customer_by_id($estimate->customer_id)->last_name ?>
        </a>
    </td>
    <td>
        <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($estimate->expiry_date)); ?>
    </td>
    <td>
        <?php if (is_serialized($estimate->estimate_eqpt_cost)) { ?>
        $<?php echo number_format(unserialize($estimate->estimate_eqpt_cost)['eqpt_cost'], 2); ?>
        <?php } ?>
    </td>
    <td><?php echo number_format($estimate->grand_total, 2); ?>
    </td>
    <td>

        <?php
                                                if ($estimate->is_mail_open == 1) {
                                                    echo "<i class='fa fa-eye'></i>  ";
                                                }
                                                echo $estimate->status;
                                            ?>

    </td>
    <td class="text-right" style="padding-right:20px;">
        <div class="dropdown dropdown-btn">
            <a role="menuitem" tabindex="-1"
                href="<?php echo base_url('estimate/view/' . $estimate->id) ?>"
                style="color:#3a96d2;font-weight:bold;">Create invoice</a> &emsp;

            <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                data-toggle="dropdown" aria-expanded="true">
                <span class="btn-label"></span>
                <span class="caret-holder">
                    <span class="caret"></span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                <li role="presentation">
                    <a role="menuitem" target="_new"
                        href="<?php echo base_url('estimate/print/' . $estimate->id) ?>"
                        class="">
                        <span class="fa fa-print icon"></span> Print</a>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="#" class="sendESTemail"
                        data-id="<?= $estimate->id; ?>"
                        est-num="<?= $estimate->estimate_number ?>"
                        est-status="<?= $estimate->status ?>"
                        est-email="<?= $estimate->email ?>"
                        est-cust="<?php echo get_customer_by_id($estimate->customer_id)->first_name .' '. get_customer_by_id($estimate->customer_id)->last_name ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Send</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="#" class="estchangestatus"
                        data-id="<?= $estimate->id; ?>"
                        est-num="<?= $estimate->estimate_number ?>"
                        est-status="<?= $estimate->status ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Update status</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $estimate->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Copy</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            </ul>
        </div>
        <!-- <div class="dropdown dropdown-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/view/' . $estimate->id) ?>"><span
            class="fa fa-file-text-o icon"></span> View Estimate</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1"
                href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span
                    class="fa fa-pencil-square-o icon"></span> Edit</a>
        </li>
        <li role="separator" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal"
                data-target="#modalCloneWorkorder"
                data-id="<?php echo $estimate->id ?>"
                data-name="WO-00433"><span class="fa fa-files-o icon clone-workorder">

                </span> Clone Estimate</a>
        </li>
        <li role="presentation"><a role="menuitem" tabindex="-1"
                href="<?php echo base_url('invoice') ?>"
                data-convert-to-invoice-modal="open" data-id="161983" data-name="WO-00433"><span
                    class="fa fa-money icon"></span> Convert to
                Invoice</a>
        </li>
        <li role="presentation">
            <a role="menuitem"
                href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>"
                class="">
                <span class="fa fa-file-pdf-o icon"></span> View PDF</a>
        </li>
        <li role="presentation">
            <a role="menuitem" target="_new"
                href="<?php echo base_url('estimate/print/' . $estimate->id) ?>"
                class="">
                <span class="fa fa-print icon"></span> Print</a>
        </li>
        <li role="presentation">
            <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                data-id="<?= $estimate->id; ?>">
                <span class="fa fa-envelope-open-o icon"></span> Send to Customer</a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li role="presentation">
            <a role="menuitem"
                href="<?php echo base_url('estimate/delete/' . $estimate->id) ?>>"
                onclick="return confirm('Do you really want to delete this item ?')" data-delete-modal="open"><span
                    class="fa fa-trash-o icon"></span> Delete</a>
        </li>
        </ul>
        </div> -->
    </td>
</tr>
<?php }
}?>

<?php
if ($filter_type == "All transactions" || $filter_type == "All plus deposits"  || $filter_type == "Money received" ) {
    foreach ($sales_receipts as $salesReceipts) { ?>
<tr id="sales_receipt_rows">
    <td><input type="checkbox"></td>
    <td>
            <?php echo  date('m/d/Y', strtotime($salesReceipts->sales_receipt_date)) ?>
    </td>
    <td>
        <?php echo 'Sales Receipt'; ?>
    </td>
    <td>
        <a class="a-default" href="#">
            <?php echo $salesReceipts->id; ?>
        </a>
    </td>
    <td>
        <a
            href="<?php echo base_url('customer/view/' . $salesReceipts->customer_id) ?>">
            <?php echo get_customer_by_id($salesReceipts->customer_id)->first_name .' '. get_customer_by_id($salesReceipts->customer_id)->last_name ?>
        </a>
    </td>
    <td>
        <!-- na -->
    </td>
    <td>
        <!-- na -->
    </td>
    <td><?php echo number_format($salesReceipts->grand_total, 2); ?>
    </td>
    <td>
        <?php
                                                echo "Paid"; ?>
    </td>
    <td class="text-right" style="padding-right:20px;">
        <div class="dropdown dropdown-btn">
            <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>"
                style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

            <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                data-toggle="dropdown" aria-expanded="true">
                <span class="btn-label"></span>
                <span class="caret-holder">
                    <span class="caret"></span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                <li role="presentation">
                    <a role="menuitem" href="#" class="sendESTemail_sr"
                        data-id="<?= $salesReceipts->id; ?>"
                        sr-num="<?= $salesReceipts->id ?>"
                        est-email="<?= $salesReceipts->email ?>"
                        est-cust="<?php echo get_customer_by_id($salesReceipts->customer_id)->first_name .' '. get_customer_by_id($salesReceipts->customer_id)->last_name ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Send</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" target="_new"
                        href="<?php echo base_url('accounting/printSalesReceipt/' . $salesReceipts->id) ?>"
                        class="">
                        <span class="fa fa-print icon"></span> Print packing slip</a>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $salesReceipts->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> View/Edit</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $salesReceipts->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Copy</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="#" class="btn-send-customer"
                        data-id="<?= $salesReceipts->id; ?>"
                        data-toggle="modal" data-target="#sr_delete">
                        <span class="fa fa-envelope-open-o icon"></span> Delete</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $salesReceipts->id; ?>"
                        data-toggle="modal" data-target="#sr_void">
                        <span class="fa fa-envelope-open-o icon"></span> Void</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            </ul>
        </div>
    </td>
</tr>
<?php }
} //print_r($sales_receipts);?>

<?php
if ($filter_type == "All transactions" || $filter_type == "All plus deposits"  || $filter_type == "Credit memos") {
    foreach ($credit_memo as $credit) { ?>
<tr>
    <td><input type="checkbox"></td>
    <td>
            <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($credit->credit_memo_date)) ?>
    </td>
    <td>
        <?php echo 'Credit Memo'; ?>
    </td>
    <td>
        <a class="a-default" href="#">
            <?php echo $credit->id; ?>
        </a>
    </td>
    <td>
        <a
            href="<?php echo base_url('customer/view/' . $credit->customer_id) ?>">
            <?php echo get_customer_by_id($credit->customer_id)->first_name .' '. get_customer_by_id($credit->customer_id)->last_name ?>
        </a>
    </td>
    <td>
        <!-- na -->
    </td>
    <td>
        <!-- na -->
    </td>
    <td><?php echo number_format($credit->grand_total, 2); ?>
    </td>
    <td>
        <?php
                                                //echo "Paid";
                                            ?>
    </td>
    <td class="text-right" style="padding-right:20px;">
        <div class="dropdown dropdown-btn">
            <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>"
                style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

            <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                data-toggle="dropdown" aria-expanded="true">
                <span class="btn-label"></span>
                <span class="caret-holder">
                    <span class="caret"></span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                <li role="presentation">
                    <a role="menuitem" href="#" class="sendESTemail_cm"
                        data-id="<?= $credit->id; ?>"
                        sr-num="<?= $credit->id ?>"
                        est-email="<?= $credit->email ?>"
                        est-cust="<?php echo get_customer_by_id($salesReceipts->customer_id)->first_name .' '. get_customer_by_id($credit->customer_id)->last_name ?>"
                        data-id="<?= $credit->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Send</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $credit->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Copy</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $credit->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Delete</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $credit->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Void</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            </ul>
        </div>
    </td>
</tr>
<?php }
}
 //print_r($credit memo);?>

<?php
if ($filter_type == "All transactions"  || $filter_type == "All plus deposits" || $filter_type == "Statements") {
    foreach ($statements as $statement) { ?>
<tr>
    <td><input type="checkbox"></td>
    <td>
            <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($statement->credit_memo_date)) ?>
    </td>
    <td>
        <?php echo 'Statements'; ?>
    </td>
    <td>
        <a class="a-default" href="#">
            <?php echo $statement->id; ?>
        </a>
    </td>
    <td>
        <a
            href="<?php echo base_url('customer/view/' . $statement->customer_id) ?>">
            <?php echo get_customer_by_id($statement->customer_id)->first_name .' '. get_customer_by_id($statement->customer_id)->last_name ?>
        </a>
    </td>
    <td>
        <!-- na -->
    </td>
    <td>
        <!-- na -->
    </td>
    <td><?php echo number_format($statement->balance, 2); ?>
    </td>
    <td>
        <?php
                                                //echo "Paid";
                                            ?>
    </td>
    <td class="text-right" style="padding-right:20px;">
        <div class="dropdown dropdown-btn">
            <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>"
                style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

            <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                data-toggle="dropdown" aria-expanded="true">
                <span class="btn-label"></span>
                <span class="caret-holder">
                    <span class="caret"></span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                <li role="presentation">
                    <a role="menuitem" href="javascript:void(0);" class="btn-send-customer"
                        data-id="<?= $statement->id; ?>">
                        <span class="fa fa-envelope-open-o icon"></span> Send</a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
            </ul>
        </div>
    </td>
</tr>
<?php }
}//print_r($sales_receipts);?>

<?php 
if ($filter_type == "All transactions" || $filter_type == "All plus deposits"  || $filter_type == "Money received") {
    foreach ($rpayments as $rpayment) { ?>
<tr>
    <td><input type="checkbox"></td>
    <td>
            <?php echo  date('m/d/Y', strtotime($rpayment->payment_date)) ?>
        
    </td>
    <td>
        <?php echo 'Payment'; ?>
    </td>
    <td>
        <a class="a-default" href="#">
            <?php echo $rpayment->id; ?>
        </a>
    </td>
    <td>
        <a
            href="<?php echo base_url('customer/view/' . $rpayment->customer_id) ?>">
            <?php echo get_customer_by_id($rpayment->customer_id)->first_name .' '. get_customer_by_id($rpayment->customer_id)->last_name ?>
        </a>
    </td>
    <td>
        <!-- na -->
    </td>
    <td>
        <!-- na -->
    </td>
    <td><?php echo number_format($rpayment->amount, 2); ?>
    </td>
    <td>
        <?php
                                                //echo "Paid";
                                            ?>
    </td>
    <td class="text-right" style="padding-right:20px;">
        <!-- <div class="dropdown dropdown-btn">
                                                    <a href="<?php //echo base_url('invoice/preview/'. $inv->id . '?format=print')?>"
        style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

        <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;" data-toggle="dropdown"
            aria-expanded="true">
            <span class="btn-label"></span>
            <span class="caret-holder">
                <span class="caret"></span>
            </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
            <li role="presentation">
                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="">
                    <span class="fa fa-envelope-open-o icon"></span> Send</a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
        </ul>
        </div> -->
    </td>
</tr>
<?php }
} //print_r($sales_receipts);?>

<?php 
if ($filter_type == "All transactions" || $filter_type == "All plus deposits"  || $filter_type == "Money received") {
    foreach ($checks as $check) { ?>
<tr>
    <td><input type="checkbox"></td>
    <td>
            <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($check->payment_date)) ?>
    </td>
    <td>
        <?php echo 'Check'; ?>
    </td>
    <td>
        <a class="a-default" href="#">
            <?php echo $check->id; ?>
        </a>
    </td>
    <td>
        <!-- <a href="<?php //echo base_url('customer/view/' . $rpayment->customer_id)?>">
        -->
        <?php
                                                        // if($check->payee_id == 'customer'){
                                                        //     echo get_customer_by_id($check->payee_id)->first_name .' '. get_customer_by_id($check->payee_id)->last_name;
                                                        // }
                                                        // elseif($check->payee_id == 'vendor')
                                                        // {

                                                        // }
                                                        // else{

                                                        // }

                                                        switch ($check->payee_type) {
                                                            case 'vendor':
                                                                $vendor = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                                                // echo $vendor->display_name;
                                                                print_r('test'.$vendor);
                                                            break;
                                                            case 'customer':
                                                                $customer = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
                                                                echo $customer->first_name . ' ' . $customer->last_name;
                                                            break;
                                                            case 'employee':
                                                                $employee = $this->users_model->getUser($check->payee_id);
                                                                echo $employee->FName . ' ' . $employee->LName;
                                                            break;
                                                        } ?>
        <!-- </a> -->
    </td>
    <td>
        <!-- na -->
    </td>
    <td>
        <!-- na -->
    </td>
    <td><?php echo number_format($check->total_amount, 2); ?>
    </td>
    <td>
        <?php
                                                //echo "Paid";
                                            ?>
    </td>
    <td class="text-right" style="padding-right:20px;">
        <!-- <div class="dropdown dropdown-btn">
                                                    <a href="<?php //echo base_url('invoice/preview/'. $inv->id . '?format=print')?>"
        style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

        <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;" data-toggle="dropdown"
            aria-expanded="true">
            <span class="btn-label"></span>
            <span class="caret-holder">
                <span class="caret"></span>
            </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
            <li role="presentation">
                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="">
                    <span class="fa fa-envelope-open-o icon"></span> Send</a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
        </ul>
        </div> -->
    </td>
</tr>
<?php }
} //print_r($sales_receipts);
