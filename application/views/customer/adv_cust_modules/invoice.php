<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="invoices module ui-state-default" data-id="<?= $id ?>"  id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Invoice</h6>
        <div class="row">            
            <!-- updated on 10-11-2016 end -->
            <div class="balance" style="width:97%;height: 50px;">

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered" style="font-size: 12px !important;">

                    <tbody>
                    <tr>

                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Total Invoiced
                        </td>

                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Received
                        </td>

                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Outstanding
                        </td>
                        <td width="25%" valign="top" height="15" align="center" class="gridheader">
                            Past Due
                        </td>
                    </tr>
                    <tr class="gridrow">
                        <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                        <td valign="top" height="15" align="center">
                            <span id="Total_Invoice">$<?= get_customer_invoice_amount('year', $cus_id); ?></span>
                        </td>
                        <td valign="top" height="15" align="center">
                            <span id="received_total">$<?= get_customer_invoice_amount('paid', $cus_id); ?></span>
                        </td>
                        <td valign="top" height="15" align="center">
                            <span id="Total_Outstanding">$<?= get_customer_invoice_amount('pending', $cus_id); ?></span>
                        </td>
                        <td valign="top" height="15" align="center">
                            <span id="Past_Due">$0</span>
                        </td>
                        <!-- updated on 10-11-2016 end -->
                    </tr>
                    </tbody>
                </table>                
            </div>
            <div class="invoice-list" style="max-height:90px; overflow-y: scroll;">
                <table class="table table-bordered table-striped" width="100%" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
                    <thead>
                        <tr>
                            <td data-name="Invoice Number">Invoice Number</td>
                            <td data-name="Date Issued">Date Issued</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($cust_invoices as $invoice) :
                        switch ($invoice->INV_status):
                            case "Partially Paid":
                                $badge = "secondary";
                                break;
                            case "Paid":
                                $badge = "success";
                                break;
                            case "Due":
                                $badge = "secondary";
                                break;
                            case "Overdue":
                                $badge = "error";
                                break;
                            case "Submitted":
                                $badge = "success";
                                break;
                            case "Approved":
                                $badge = "success";
                                break;
                            case "Declined":
                                $badge = "error";
                                break;
                            case "Scheduled":
                                $badge = "primary";
                                break;
                            default:
                                $badge = "";
                                break;
                        endswitch;
                    ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?php echo $invoice->invoice_number ?></td>
                            <td><?php echo get_format_date($invoice->date_issued) ?></td>
                            <td><span class="nsm-badge <?= $badge ?>"><?php echo $invoice->INV_status ?></span></td>
                            <td>$<?php echo ($invoice->grand_total); ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?= base_url('invoice/send/'.$invoice->id); ?>" target="_blank" style="display: inline-block;color:#ffffff;">Email Invoice</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="invoicetext" style="margin-left:0px; margin-top:6px;">
                <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                <a class="btn btn-sm btn-primary" onclick="window.open('<?= base_url('invoice/add?cus_id='.$cus_id); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');" href="javascript:void(0);" style="display: inline-block;color:#ffffff;">Create Invoice</a>
                <a class="btn btn-sm btn-primary" href="<?= base_url('customer/invoice_list/'.$cus_id); ?>" target="_blank" style="display: inline-block;color:#ffffff;">All Invoices</a>
                <!-- updated on 10-11-2016 start (fixed invoice permission issue) -->
                
            </div>
            <!--Updated by akshay 05-06-2017 s-->
        </div>
    </div>
</div>