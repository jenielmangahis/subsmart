<table class="nsm-table" id="tbl-print-list">
    <thead>
        <tr>
            <td data-name="Invoice Number">Invoice Number</td>
            <td data-name="Job Number">Job Number</td>
            <td data-name="Date Issued">Date Issued</td>
            <td data-name="Date Due">Date Due</td>                            
            <td data-name="Customer">Customer</td>
            <td data-name="Status">Status</td>
            <td data-name="Amount" style="text-align:right;">Amount</td>
            <td data-name="Amount" style="text-align:right;">Balance</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($invoices)) :
        ?>
            <?php
            foreach ($invoices as $invoice) :

                $late_fee_amount = $invoice->late_fee;
                $current_date    = date('Y-m-d');

                switch ($invoice->status):
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
                    case "Draft":
                        $badge = "error";
                        break;
                    default:
                        $badge = "error";
                        break;
                endswitch;
            ?>
                <tr>
                    <td class="fw-bold nsm-text-primary nsm-link default show"><?= $invoice->invoice_number; ?>
                    </td>
                    <td class="nsm-text-primary nsm-link default view-job-row" data-id="<?= $invoice->job_id; ?>">
                            <?php echo $invoice->jobnumber != '' ? $invoice->jobnumber : '---';  ?>
                    </td>
                    <td><?php echo date('m/d/Y', strtotime($invoice->date_issued)); //get_format_date($invoice->date_issued) ?></td>
                    <td><?php echo date('m/d/Y', strtotime($invoice->due_date)); //get_format_date($invoice->due_date) ?></td>
                    <td class="nsm-text-primary">
                        <label class="d-block">
                        <?php 
                            if( trim($invoice->first_name != '') || trim($invoice->last_name != '') ){
                                $customer_name = $invoice->first_name . ' ' . $invoice->last_name;
                            }else{
                                $customer_name = '---';
                            }
                            
                            echo $customer_name;
                        ?>
                        </label>
                    </td>
                    <td class="nsm-text-primary">
                        <span class="status-label nsm-badge <?= $badge ?>">
                            <?php 
                                if( $invoice->status == '' ){
                                    echo 'Draft';
                                }else{
                                    echo $invoice->status;
                                }
                            ?>                                            
                        </span>
                    </td>
                    <td style="text-align:right;">$<?php echo number_format((float)$invoice->grand_total,2); ?></td>
                    <td style="text-align:right;">$<?php echo number_format((float)$invoice->balance,2); ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        <?php
        else :
        ?>
            <tr>
                <td colspan="11">
                    <div class="nsm-empty">
                        <span>No results found.</span>
                    </div>
                </td>
            </tr>
        <?php
        endif;
        ?>
    </tbody>
</table>
<div style="display:none;">
<table class="w-100" id="tbl-print-ajax">
    <thead>
        <tr>
            <td data-name="Invoice Number">Invoice Number</td>
            <td data-name="Job Number">Job Number</td>
            <td data-name="Date Issued">Date Issued</td>
            <td data-name="Date Due">Date Due</td>                            
            <td data-name="Customer">Customer</td>
            <td data-name="Status">Status</td>
            <td data-name="Amount" style="text-align:right;">Amount</td>
            <td data-name="Amount" style="text-align:right;">Balance</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($invoices)) :
        ?>
            <?php
            foreach ($invoices as $invoice) :

                $late_fee_amount = $invoice->late_fee;
                $current_date    = date('Y-m-d');

                switch ($invoice->status):
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
                    case "Draft":
                        $badge = "error";
                        break;
                    default:
                        $badge = "error";
                        break;
                endswitch;
            ?>
                <tr>
                    <td class="fw-bold nsm-text-primary nsm-link default show"><?= $invoice->invoice_number; ?>
                    </td>
                    <td class="nsm-text-primary nsm-link default view-job-row" data-id="<?= $invoice->job_id; ?>">
                            <?php echo $invoice->jobnumber != '' ? $invoice->jobnumber : '---';  ?>
                    </td>
                    <td><?php echo date('m/d/Y', strtotime($invoice->date_issued)); //get_format_date($invoice->date_issued) ?></td>
                    <td><?php echo date('m/d/Y', strtotime($invoice->due_date)); //get_format_date($invoice->due_date) ?></td>
                    <td class="nsm-text-primary">
                        <label class="d-block">
                        <?php 
                            if( trim($invoice->first_name != '') || trim($invoice->last_name != '') ){
                                $customer_name = $invoice->first_name . ' ' . $invoice->last_name;
                            }else{
                                $customer_name = '---';
                            }
                            
                            echo $customer_name;
                        ?>
                        </label>
                    </td>
                    <td class="nsm-text-primary">
                        <span class="status-label nsm-badge <?= $badge ?>">
                            <?php 
                                if( $invoice->status == '' ){
                                    echo 'Draft';
                                }else{
                                    echo $invoice->status;
                                }
                            ?>                                            
                        </span>
                    </td>
                    <td style="text-align:right;">$<?php echo number_format((float)$invoice->grand_total,2); ?></td>
                    <td style="text-align:right;">$<?php echo number_format((float)$invoice->balance,2); ?></td>                    
                </tr>
            <?php
            endforeach;
            ?>
        <?php
        else :
        ?>
            <tr>
                <td colspan="11">
                    <div class="nsm-empty">
                        <span>No results found.</span>
                    </div>
                </td>
            </tr>
        <?php
        endif;
        ?>
    </tbody>
</table>
</div>
<script>
$(function(){
    $("#tbl-print-list").nsmPagination({itemsPerPage:10});
});
</script>