<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
.widget-tile-unpaid-invoice-row:hover{
    cursor: pointer;
}
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Unpaid Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="nsm-widget-table">
            <table class="nsm-table" id="dashboard_unpaid_invoices">
                <thead style="display:none;">
                    <tr>
                        <td data-name="UnpaidInvoicesProfile" style="width:59%;"></td>                        
                        <td data-name="UnpaidInvoicesBalance">Balance</td>
                        <td data-name="UnpaidInvoicesDueDate" style="text-align:right;">Due Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($upcomingInvoice as $invoice){ ?>
                        <?php 
                            $invoiceAvatar = userProfilePicture($invoice->user_id);
                            $invoiceInitial = getLoggedNameInitials($invoice->user_id);

                            $statusBadgeColor = "";
                            switch ($invoice->status) {
                                case "Partially Paid":
                                    $statusBadgeColor = "secondary";
                                    break;
                                case "Paid":
                                    $statusBadgeColor = "success";
                                    break;
                                case "Due":
                                    $statusBadgeColor = "secondary";
                                    break;
                                case "Overdue":
                                    $statusBadgeColor = "error";
                                    break;
                                case "Submitted":
                                    $statusBadgeColor = "success";
                                    break;
                                case "Approved":
                                    $statusBadgeColor = "success";
                                    break;
                                case "Declined":
                                    $statusBadgeColor = "error";
                                    break;
                                case "Scheduled":
                                    $statusBadgeColor = "primary";
                                    break;
                                default:
                                    $statusBadgeColor = "";
                                    break;
                            }

                            $datetime1 = new DateTime(date("Y-m-d",strtotime($invoice->date_updated)));
                            $datetime2 = new DateTime(date("Y-m-d"));
                            $difference = $datetime1->diff($datetime2);

                            $show_no_movement_notice = 0;
                            if( $difference->d >= 14 && ($invoice->status != 'Paid') ){
                                $show_no_movement_notice = 1;
                            }
                        ?>
                    <tr>
                        <td>
                            <div class="widget-item widget-tile-unpaid-invoice-row" data-id="<?= $invoice->id; ?>">                                
                                <div class="content">
                                    <div class="details" style="width:98% !important;">
                                        <span class="content-title"><?= $invoice->invoice_number ?></span>  
                                        <span class="content-subtitle d-block" style="margin-top:7px;"><i class='bx bxs-user-circle' style="font-size: 14px;position: relative;top: 2px;"></i> <?= $invoice->first_name . ' ' . $invoice->last_name; ?></span> 
                                        <?php if( $show_no_movement_notice == 1 ){  ?>
                                            <a style="text-decoration:none;margin-top:5px;" href="<?= base_url('invoice/invoice_edit/'.$invoice->id) ?>"><span class="nsm-badge badge-error">Last update was <b><?= $difference->d . ' days ago' ?></b> - Needs update</span></a>
                                        <?php } ?>                                     
                                    </div>                            
                                </div>
                            </div>
                        </td>                        
                        <td>
                            <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$<?= number_format($invoice->grand_total, 2); ?></span>
                            <span class="content-subtitle d-block">Total Due</span>
                        </td>
                        <td style="text-align:right;">
                            <span class="nsm-badge <?= $statusBadgeColor; ?>"><?= $invoice->status; ?></span>
                            <span class="content-subtitle d-block mt-2">
                                <?= $invoice->due_date ? get_format_date($invoice->due_date) : '---' ; ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#dashboard_unpaid_invoices").nsmPagination({itemsPerPage:5});
    resizeSidebar();

    $('.widget-tile-unpaid-invoice-row').on('click', function(){
        var invoice_id = $(this).attr('data-id');
        location.href  = base_url + 'invoice/genview/' + invoice_id;
    });
});
</script>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>