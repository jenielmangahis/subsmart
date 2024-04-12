<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
    echo '<div class="col-12 col-lg-4">';
}
?>



<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="widget_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-sales">
                        <i class="bx bx-fw bx-receipt"></i>
                    </div>
                    <span style="color:#6a4a86 ">Sales</span>
                </div>
            </div>
        </div>
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?php echo $id; ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content"  style="  height: calc(100% - 120px);">
        <div class="row ">
        <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                    <label for="">Total Sales</label>
                    <h1>$<?php echo get_invoice_amount('total'); ?></h1>

                </div>
            </div>
          
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class=" btn-sm m-0 me-2" href="accounting/allsales">
            <i class='bx bx-right-arrow-alt' style="color: #6a4a86"></i>
        </a>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
    echo '</div>';
}
?>