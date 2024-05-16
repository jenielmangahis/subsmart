<div class="nsm-widget-table">
    <?php if ($invoices): ?>
        <?php foreach ($invoices as $invoice) : ?>
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
            <a class="widget-item" style="text-decoration: none; color: inherit; cursor: pointer;" target="_blank" href="/invoice/genview/<?= $invoice->id; ?>">
                <?php $initials = ucwords($invoice->first_name[0]).ucwords($invoice->last_name[0]); ?>
                <div class="nsm-profile"><span><?= $initials; ?></span></div>
                <div class="content">
                    <div class="details">
                        <span class="content-title"><?= formatInvoiceNumber($invoice->invoice_number); ?></span>
                        <span class="content-subtitle d-block"><?= $invoice->first_name . ' ' . $invoice->last_name; ?></span>
                    </div>
                    <div style="padding-top: 5px;">
                        <span class="content-subtitle nsm-text-error fw-bold" style="font-size:12px;">
                            $<?= number_format($invoice->balance, 2); ?>
                        </span>
                        <span class="content-subtitle d-block">total due</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge <?= $statusBadgeColor; ?>">
                            <?= $invoice->status; ?>
                        </span>
                        <span class="content-subtitle d-block">
                            <?= $invoice->due_date ? get_format_date($invoice->due_date) : ""; ?>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach;?>
    <?php else: ?>
        <div class="nsm-empty">
            <i class='bx bx-meh-blank'></i>
            <span>Overdue Invoice list is empty.</span>
        </div>
    <?php endif; ?>
</div>