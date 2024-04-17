<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="widget_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-customer">
                        <i class="bx bx-user-circle"></i>
                    </div>
                    <span style="color:#6ba77ced ">New Customer</span>
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
    <div class="nsm-card-content" style="  height: calc(100% - 120px);">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                    <label for="">Total New Customer</label>
                    <h1 id='recent-customer-container-count'> <span class="bx bx-loader bx-spin"></span></h1>

                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class=" btn-sm m-0 me-2" href="customer">
            <i class='bx bx-right-arrow-alt' style="color: #6ba77ced"></i>
        </a>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>