<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
.widget-tile-paid-invoices:hover{
    cursor:pointer;
}
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Paid Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>">
                See Reports
            </a>
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
        <div class="row mb-4 mt-2">
            <div class="col-4">
                <select class="nsm-field form-select" name="filter_date" id="tech-leader-board-filter-date">                                                
                    <option value="today">Today</option>                        
                    <option value="custom">Custom</option>
                    <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                    <option value="this-month">This month</option>
                    <option value="this-quarter">This quarter</option>
                    <option value="this-year" selected="">This year</option>
                </select>
            </div>
            <div class="col-4">
                <input type="date" id="tech-leaderboard-filter-from" class="nsm-field form-control date" value="<?= date("Y-01-01"); ?>" />
            </div>
            <div class="col-4">
                <input type="date" id="tech-leaderboard-filter-to" class="nsm-field form-control date" value="<?= date("Y-12-31"); ?>" required>
            </div>
        </div>   
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="nsm-counter primary mb-2 widget-tile-paid-invoices">
                    <div class="row">
                        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                            <i class='bx bx-dollar-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2>$<?= number_format((float)$total_amount_invoice->total, 2, '.', ','); ?></h2>
                            <span>Total Amount Paid Invoices</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="nsm-counter primary mb-2 widget-tile-paid-invoices">
                    <div class="row">
                        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                            <i class='bx bx-box'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2><?= $total_invoice_paid->total; ?></h2>
                            <span>Total Paid invoices</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
$(function(){
    $('.widget-tile-paid-invoices').on('click', function(){
        location.href = base_url + 'invoice/tab/5';
    });
});
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>