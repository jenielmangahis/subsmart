<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
$category = "subscription";
$thumbanailName = "Subscription";
$description = "Subscription tracks recurring customer plans. This card displays the total number and amount of active subscriptions.";
$icon = '<i class="fas fa-file-invoice-dollar"></i>';
?>
<style> .display_none { display: none; }</style>
<style>
    .plus_text {
        background-color: #6ba77c33;
        color: #198754;
        padding: 6px;
        border-radius: 20px;
        font-size: 12px;
    }

    .subscription-text {
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: center;
        margin-bottom: 5px
    }

    .subscription-text h1 {
        margin: 0 !important;
    }
</style>
<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="#" style="color:#6a4a86 !important">
                        <?php echo $icon; ?>&nbsp;&nbsp;<?php echo $thumbanailName; ?>
                    </a>
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="removeThumbnail('<?php echo $id; ?>');">Remove Thumbnail</a>
                            </li>
                            <li>
                                <div class="form-check form-switch" style="display: flex; align-items: center;gap: 5px; padding-left: 10px;">
                                    <input class="form-check-input ms-0" type="checkbox" onclick="manipulateShowGraph(this,'<?php echo $id; ?>')" <?php echo $isListView ? 'checked' : ''; ?> data-addon-delete-modal="open" data-id="WiZ" data-name="WiZ" style="margin: 0" />
                                    <span class="content-title d-block mb-1">Show Graph</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <span><?php echo $description; ?></span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <select class="form-select filterSubscriptionDate" data-id='<?php echo $id; ?>' onChange="filterSubscription()">
                        <option value="all">All time</option>
                        <option value="week">Last 7 days </option>
                        <option value="two-week">last 14 days</option>
                        <option value="month">last 30 days </option>
                        <option value="two-month">last 60 days </option>
                        <option value="this-year">This Year </option>
                    </select>
                    <select class="form-select filterSubscriptionStatus" onChange="filterSubscription()">
                        <option value="">All Status</option>
                        <option value="Active w/RAR">Active w/RAR</option>
                        <option value="Active w/RQR">Active w/RQR</option>
                        <option value="Active w/RMR">Active w/RMR</option>
                        <option value="Active w/RYR">Active w/RYR</option>
                        <option value="Inactive w/RMM">Inactive w/RMM</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col textData_<?php echo $id; ?> <?php echo $isListView == 1 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">TOTAL SUBSCRIPTION REVENUE</strong>
                    <h2 id="first_content_<?php echo $id; ?>">$<?php echo number_format($subs->total_amount_subscriptions, 2); ?></h2>
                    <span class="plus_text plus_text_content" data-bs-toggle="popover" data-bs-html="true" title="Details" data-item="<?php echo $subsContent; ?>"><?php echo '+ $'.number_format($subs->total_current_amount_subscriptions, 2); ?></span>
                </div>
            </div>
            <div class="col textData_<?php echo $id; ?> <?php echo $isListView == 1 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">SUBSCRIBERS</strong>
                    <h2 id="second_content_<?php echo $id; ?>" ><?php echo number_format($subs->total_active_subscription, 0); ?></h2>
                    <span class="plus_text"> + <?php echo number_format($subs->total_current_active_subscription, 0); ?></span>
                </div>
            </div>
            <div class="col graphData_<?php echo $id; ?> <?php echo $isListView == 0 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <canvas id="income_subscription" class="nsm-chart" data-chart-type="sales" style="max-height: 120px;"></canvas>
                </div>
            </div>
        </div>
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popoverTriggerList = document.querySelectorAll('.plus_text');
        const content = $('.plus_text_content').attr('data-item');

        popoverTriggerList.forEach(function (popoverTriggerEl) {
            // Initialize the popover without data-bs-content
            const popover = new bootstrap.Popover(popoverTriggerEl, {
                html: true,
                title: 'Details',
                content: function () {
                    return content;
                },
                placement: 'top',
                trigger: 'hover' 
            });
        });
    });
</script>
<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
?>