<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>
<style>
    .plus_text{
        background-color: #6ba77c33;
        color: #198754;
        padding: 6px;
        border-radius: 20px;
        font-size: 12px;
    }
    .subscription-text{
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: center;
        margin-bottom: 5px
    }
    .subscription-text h1{
        margin: 0 !important;
    }
</style>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="thumbnail_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="summary-report-header-sub ">
                    <div class="icon-summary-income">
                        <i class="bx bx-box "></i>
                        </div>
                        <a role="button" class=" btn-sm m-0 me-2" href="invoice" style="color:#dc3545c9 !important ">
                            Subscription
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-thumbnail">

                    <li><a class="dropdown-item" href="#" onclick="removeThumbnail('<?php echo $id; ?>');">Remove
                            Thumbnail</a></li>
                    <li>

                        <div class="form-check form-switch"
                            style="display: flex; align-items: center;gap: 5px;padding-left: 10px;">
                            <input class="form-check-input ms-0" type="checkbox"
                                onclick="manipulateShowGraph(this,'<?php echo $id; ?>')" <?php echo $isListView ? 'checked' : ''; ?>
                                data-addon-delete-modal="open" data-id="WiZ" data-name="WiZ" style="margin: 0" />
                            <span class="content-title d-block mb-1">Show Graph </span>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mb-2">
        <select class="nsm-field form-select filterSubscriptionDate" data-id='<?php echo $id; ?>' onChange="filterSubscription()" style='width: 55%;
    border: none;' >
            <option value="all">All time</option>
            <option value="week">Last 7 days </option>
            <option value="two-week">last 14 days</option>
            <option value="month">last 30 days </option>
            <option value="two-month">last 60 days </option>
        </select>
    </div>
    <div  id="filter-subscription-status">
    <select class="nsm-field form-select filterSubscriptionStatus" style="width: 90%;border: none;" onChange="filterSubscription()">
            <option value="">All Status</option>
            <option value="Active w/RAR">Active w/RAR</option>
            <option value="Active w/RQR">Active w/RQR</option>
            <option value="Active w/RMR">Active w/RMR</option>
            <option value="Active w/RYR">Active w/RYR</option>
            <option value="Inactive w/RMM">Inactive w/RMM</option>
        </select>
    </div>
    <div class="nsm-card-content"
        style="  height: calc(100% - 120px); display: <?php echo $isListView ? 'block' : 'none'; ?>"
        id="thumbnail_content_graph_<?php echo $id; ?>">
        <h1 id='IncomeSubscriptioneGraphLoader'> <span class="bx bx-loader bx-spin"></span></h1>

        <canvas id="income_subscription" style="max-height:100%;" class="nsm-chart" data-chart-type="sales"></canvas>
    </div>
    <div class="nsm-card-content"
        style="  height: calc(100% - 120px);  display: <?php echo $isListView ? 'none' : 'block'; ?>"
        id="thumbnail_content_list<?php echo $id; ?>">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body mt-5">
                    <label for="">Total Subscription Revenue</label>
                    <div class="subscription-text">
                        <h1 id="first_content_<?php echo $id; ?>" >$
                            <?php echo number_format($subs->total_amount_subscriptions, 2); ?> 
                        </h1>
                            <span class="plus_text plus_text_content" data-bs-toggle="popover" data-bs-html="true" title="Details" data-item="<?php echo $subsContent; ?>">
                                <?php     
                                    echo '+ $'.number_format($subs->total_current_amount_subscriptions, 2);
                                
                                ?>
                            </span>
                    </div>
                   

                    <label for="">Subscribers</label>
                    <div class="subscription-text">
                        <h1 id="second_content_<?php echo $id; ?>" >
                            <?php echo number_format($subs->total_active_subscription, 0); ?>
                        </h1>
                        <span class="plus_text"> + <?= number_format($subs->total_current_active_subscription, 0); ?>
                        </span>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>