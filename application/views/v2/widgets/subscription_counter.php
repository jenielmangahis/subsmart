<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="thumbnail_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-income">
                        <i class="bx bx-box "></i>
                    </div>
                    <span style="color:#dc3545c9 ">Subscription</span>
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

                        <div class="form-check form-switch" style="display: flex; align-items: center;gap: 5px;padding-left: 10px;">
                            <input class="form-check-input ms-0" type="checkbox" onclick="manipulateShowGraph(this,'<?=  $id ?>')"
                                <?= $isListView ? 'checked' : '' ?> data-addon-delete-modal="open" data-id="WiZ"
                                data-name="WiZ" style="margin: 0" />
                            <span class="content-title d-block mb-1">Show Graph </span>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px); display:none" id="thumbnail_content_graph_<?php echo $id; ?>">
        <canvas id="income_subscription" class="nsm-chart" data-chart-type="sales" ></canvas>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px);" id="thumbnail_content_list<?php echo $id; ?>">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                    <label for="">Total Subscription</label>
                    <h1 style="font-size:<?php intval($subs->TOTAL_MMR) >= 1000000 ? '33px' : ''; ?>;">
                        <?php echo number_format($subs->TOTAL_MMR, 2); ?></h1>

                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class=" btn-sm m-0 me-2" href="invoice">
            <i class='bx bx-right-arrow-alt' style="color: #dc3545c9"></i>
        </a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>