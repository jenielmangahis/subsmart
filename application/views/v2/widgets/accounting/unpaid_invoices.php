<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Top 5 Unpaid Invoices</span>
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
            <?php if (is_array($upcomingInvoice) && count($upcomingInvoice) > 0): ?>
                <?php foreach($upcomingInvoice as $invoice): ?>
                    <?php 
                        $invoiceAvatar = userProfilePicture($invoice->user_id);
                        $invoiceInitial = getLoggedNameInitials($invoice->user_id);
                    ?>
                    <div class="widget-item">
                        <?php if (is_null($invoiceAvatar)): ?>
                            <div class="nsm-profile"><span><?= $invoiceInitial; ?></span></div>
                        <?php else: ?>
                            <div class="nsm-profile" style="background-image: url('<?= $invoiceAvatar; ?>');"></div>
                        <?php endif; ?>

                        <div class="content">
                            <div class="details">
                                <span class="content-title"><?= $invoice->invoice_number; ?></span>
                                <span class="content-subtitle d-block"><?= $invoice->first_name . ' ' . $invoice->last_name; ?></span>
                            </div>
                            <div style="padding-top: 5px;">
                                <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">
                                    $<?= number_format($invoice->balance, 2); ?>
                                </span>
                                <span class="content-subtitle d-block">balance</span>
                            </div>
                            <div class="controls">
                                <span class="nsm-badge success">
                                    <?= $invoice->status; ?>
                                </span>
                                <span class="content-subtitle d-block">
                                    <?= $invoice->due_date ? get_format_date($invoice->due_date) : ""; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="nsm-empty">
                    <i class='bx bx-meh-blank'></i>
                    <span>Unpaid Invoices is empty.</span>
                </div>
            <?php endif; ?>

            <!-- <div class="widget-item">
                <div class="nsm-profile" style="background-image: url();">
                    <span>MC</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Maria Clara</span>
                        <span class="content-subtitle d-block">INV-0002</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge success">Due date in 3 day</span>
                        <span class="content-subtitle mt-1 d-block fw-bold">$800.00</span>
                    </div>
                </div>
            </div>
            <div class="widget-item">
                <div class="nsm-profile" style="background-image: url();">
                    <span>MC</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Chrisostomo Ibarra</span>
                        <span class="content-subtitle d-block">INV-0003</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge success">Due date in 5 day</span>
                        <span class="content-subtitle d-block mt-1 fw-bold">$1000.00</span>
                    </div>
                </div>
            </div>
            <div class="widget-item">
                <div class="nsm-profile" style="background-image: url();">
                    <span>MV</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Micheal Victor</span>
                        <span class="content-subtitle d-block">INV-0004</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge success">Due date in 6 day</span>
                        <span class="content-subtitle mt-1 d-block fw-bold">$1000.00</span>
                    </div>
                </div>
            </div>
            <div class="widget-item">
                <div class="nsm-profile" style="background-image: url();">
                    <span>RF</span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title">Robert Fox</span>
                        <span class="content-subtitle d-block">INV-0005</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge success">Due date in 7 day</span>
                        <span class="content-subtitle mt-1 d-block fw-bold">$1000.00</span>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>