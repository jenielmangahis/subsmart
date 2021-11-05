<?php
if ($invoices!=null) {
    foreach ($invoices as $invoice) {
        ?>
<tr>
    <td>
        <div class="form-check">
            <div class="checkbox checkbox-sec ">
                <input type="checkbox" name="checkbox[]" value="<?=$invoice->id?>" class="select-one"
                    id="invoice_id_<?php echo $invoice->id ?>"
                    data-status="<?=$invoice->INV_status?>"
                    data-customer-id="<?=$invoice->customer_id?>"
                    data-invoice-id="<?=$invoice->id?>"
                    data-company-id="<?=$invoice->company_id?>"
                    data-invoice-number="<?=$invoice->invoice_number?>">
                <label
                    for="invoice_id_<?php echo $invoice->id ?>"><span></span></label>
            </div>
        </div>
    </td>
    <td>
        <div class="tooltip_"><a href="#" alt="Reccuring Invoice"><i class="fa fa-refresh"
                    aria-hidden="true"></i></a><span class="tooltiptext">Reccuring Invoice</span></div>
    </td>

    <td>
        <div class="table-nowrap">
            <label for=""><?php echo get_format_date($invoice->date_issued) ?></label>
        </div>
    </td>
    <td>
        <label for="invoice_id_<?php echo $invoice->id ?>">
            <a class="a-default" href="#" id="inv_number_details"
                inv-no="<?php echo $invoice->invoice_number ?>"
                data-id="<?php echo $invoice->id ?>"><?php echo $invoice->invoice_number ?> </a>
        </label>
    </td>
    <td>
        <div class="table-nowrap">
            <p class="mb-0"> <label for=""><?php echo $invoice->first_name.' '. $invoice->last_name; ?></label>
            </p>
            <label
                for="customer_id_<?php echo $invoice->customer_id ?>">
                <a
                    href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>"><?php echo $invoice->job_name ?></a>
            </label>
        </div>
    </td>
    <td>
        <div class="table-nowrap">
            <label for="">$<?php echo number_format($invoice->grand_total, 2); ?>
            </label>
        </div>
    </td>
    <td>
        <div class="table-nowrap">
            <label><?php echo $invoice->INV_status ?></label>
        </div>
    </td>
    <td class="text-right">
        <div class="dropdown dropdown-btn open">
            <?php if ($invoice->INV_status == 'Paid') { ?>
            <a href="<?php echo base_url('accounting/invoice_edit/' . $invoice->id) ?>"
                style="color:gray;"><i class="fa fa-pencil" aria-hidden="true"></i></a> &emsp; <a
                href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>"
                style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a> &emsp;
            <?php } else { ?>
            <a href="<?php echo base_url('accounting/invoice_edit/' . $invoice->id) ?>"
                style="color:gray;"><i class="fa fa-pencil" aria-hidden="true"></i></a> &emsp;
            <a href="" style="color:#3a96d2;font-weight:bold;" class="first-option customer_receive_payment_btn"
                data-customer-id="<?=$invoice->customer_id?>">Receive
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
                        href="<?php echo base_url('invoice/send/' . $invoice->id) ?>">
                        <span class="fa fa-envelope-o icon"></span> Send Invoice</a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('accounting/invoice_edit/' . $invoice->id) ?>">
                        <span class="fa fa-pencil-square-o icon"></span>
                        Edit
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">
                        <span class="fa fa-file-text-o icon"></span>
                        View Invoice
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/genview/' . $invoice->id) . "?do=payment_add" ?>">
                        <span class="fa fa-usd icon"></span>
                        Record Invoice
                    </a>
                </li>
                <li role="presentation">
                    <!-- <a role="menuitem" class="openConvertToWorkOrder" tabindex="-1"
                                            href="javascript:void(0)" data-toggle="modal"
                                            data-target="#convertToWorkOrder"
                                            data-invoice-number="<?php echo $invoice->invoice_number ?>"
                    data-id="<?php echo $invoice->id ?>">
                    <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                    </a> -->
                    <a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('workorder/invoice_workorder/' . $invoice->id) ?>"
                        data-convert-to-invoice-modal="open"
                        data-id="<?php echo $invoice->id ?>"
                        data-invoice-number="<?php echo $invoice->invoice_number ?>">
                        <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" class="openCloneInvoice" tabindex="-1" href="javascript:void(0)"
                        data-toggle="modal" data-target="#cloneModal"
                        data-invoice-number="<?php echo $invoice->invoice_number ?>"
                        data-id="<?php echo $invoice->id ?>">
                        <span class="fa fa-files-o icon"></span> Clone Invoice
                    </a>
                </li>
                <li class="share-invoice-link-btn"
                    data-invoice-id="<?=$invoice->id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        <span class="fa fa-share icon" aria-hidden="true"></span>
                        Share invoice link
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" class="openDeleteInvoice" tabindex="-1" href="javascript:void(0)"
                        data-invoice-number="<?php echo $invoice->invoice_number ?>"
                        data-id="<?php echo $invoice->id ?>"
                        id="deleteInvoiceBtnNew">
                        <span class="fa fa-trash-o icon"></span> Delete Invoice
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>"><span
                            class="fa fa-file-pdf-o icon"></span> Invoice PDF</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1"
                        href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>"><span
                            class="fa fa-print icon"></span> Print Invoice</a></li>
            </ul>
        </div>
    </td>
</tr>
<?php
    }
}
