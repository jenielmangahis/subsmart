<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Overdue Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('accounting/invoices'); ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="nsm-widget-table">
            <table class="nsm-table" id="nsm-table-overdue-invoices">
                <thead style="display:none;">
                    <tr>            
                        <td data-name="EstimateNumber">Estimate Number</td>
                        <td data-name="TotalDue"></td>                            
                        <td data-name="Status"></td>                     
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($currentOverdueInvoices)) { ?>
                        <?php foreach ($currentOverdueInvoices as $invoice) { ?>
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
                            ?>
                            <?php $initials = ucwords($invoice->first_name[0]).ucwords($invoice->last_name[0]); ?>
                            <tr >                    
                                <td class="widget-tile-upcoming-estimate-row" data-id="<?= $invoice->id; ?>">
                                    <div class="nsm-profile" style="width: 40px "><span><?= $initials; ?></span></div>
                                </td>                                    
                                <td>
                                    <div class="details">
                                        <span class="content-title"><?= formatInvoiceNumber($invoice->invoice_number); ?></span>
                                        <span class="content-subtitle d-block"><?= $invoice->first_name . ' ' . $invoice->last_name; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="content-subtitle nsm-text-error fw-bold" style="font-size:12px;">
                                        $<?= number_format($invoice->balance, 2); ?>
                                    </span>
                                    <span class="content-subtitle d-block">total due</span>
                                </td>
                                <td style="width:25%;text-align:right;">
                                    <div class="controls">
                                        <span class="nsm-badge <?= $statusBadgeColor; ?>">
                                            <?= $invoice->status; ?>
                                        </span>
                                        <span class="content-subtitle d-block">
                                            <?= $invoice->due_date ? get_format_date($invoice->due_date) : ""; ?>
                                        </span>
                                    </div>
                                </td>  
                            </tr>
                        <?php } ?>
                    <?php }else { ?>
                        <tr>
                            <td colspan="4">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>

<script>
$(function(){
    $("#nsm-table-overdue-invoices").nsmPagination({itemsPerPage:5}); 
    $('.widget-tile-upcoming-estimate-row').on('click', function(){
        var invoice_id = $(this).attr('data-id');
        location.href  = base_url + 'invoice/genview/' + invoice_id;
    });  
});
</script>