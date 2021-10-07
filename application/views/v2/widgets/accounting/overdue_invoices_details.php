<div class="nsm-widget-table">
    <?php
    if ($invoices) :
        foreach ($invoices as $invoice) :
    ?>
            <div class="widget-item">
                <?php
                $image = userProfilePicture($invoice->fk_user_id);
                if (is_null($image)) {
                ?>
                    <div class="nsm-profile">
                        <span><?php echo getLoggedNameInitials($invoice->fk_user_id); ?></span>
                    </div>
                <?php
                } else {
                ?>
                    <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
                <?php
                }
                ?>
                <div class="content">
                    <div class="details">
                        <span class="content-title"><?= $invoice->invoice_number ?></span>
                        <span class="content-subtitle d-block"><?= $invoice->first_name . ' ' . $invoice->last_name ?></span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge error">Draft</span>
                        <span class="content-subtitle d-block mt-1 fw-bold nsm-text-error">$<?= number_format($invoice->total_due, 2, '.', ',') ?></span>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
    else :
        ?>
        <div class="nsm-empty">
            <i class='bx bx-meh-blank'></i>
            <span>Overdue Invoice list is empty.</span>
        </div>
    <?php
    endif;
    ?>
</div>