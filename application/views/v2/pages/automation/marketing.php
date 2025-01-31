<?php include viewPath('v2/includes/header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>css/automation/automation.css">

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/automation_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Auto-message your clients with special offers
                        </div>
                    </div>
                    <!-- Card Group -->
                    <?php
                        $cards = getMarketingTemplate();
                        foreach ($cards as $card) : ?>
                            <div class="col-3 mb-3">
                                <div class="nsm-card primary cursor-pointer marketing-item" style="overflow: visible !important;"
                                    data-title="<?php echo htmlspecialchars($card['title']); ?>"
                                    data-type="marketing"
                                    data-onclick="<?php echo htmlspecialchars($card['onclick']); ?>">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-text text-muted">
                                            <span><?php echo $card['title']; ?></span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <h5><?php echo $card['description']; ?></h5>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/automation/add_automation_modal'); ?>
<?php include viewPath('v2/includes/automation/add_email_modal'); ?>
<?php include viewPath('v2/includes/automation/preview_sms_modal'); ?>
<?php include viewPath('v2/includes/automation/add_sms_modal'); ?>
<?php include viewPath('v2/pages/automation/js/automation'); ?>
<?php include viewPath('v2/includes/footer'); ?>