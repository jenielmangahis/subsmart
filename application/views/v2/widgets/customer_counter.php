<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="thumbnail_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="summary-report-header-sub ">
                        <div class="icon-summary-customer">
                            <i class="bx bx-user-circle"></i>
                        </div>
                        <a role="button" class=" btn-sm m-0 me-2" href="customer" style="color:#6ba77ced !important ">
                            Customer Groups
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
                <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item" href="#" onclick="removeThumbnail('<?php echo $id; ?>');">Remove
                            Thumbnail</a></li>

                    <li>

                        <div class="form-check form-switch"
                            style="display: flex; align-items: center;gap: 5px;padding-left: 10px;">
                            <input class="form-check-input ms-0" type="checkbox"
                                onclick="manipulateShowGraph(this,'<?php echo $id; ?>')"
                                <?php echo $isListView ? 'checked' : ''; ?> data-addon-delete-modal="open" data-id="WiZ"
                                data-name="WiZ" style="margin: 0" />
                            <span class="content-title d-block mb-1">Show Graph </span>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mb-2">
        <select class="nsm-field form-select" style='width: 55%;
    border: none;' onChange="filterThumbnail(this.value, '<?php echo $id; ?>', 'acs_profile')">
            <option value="all">All time</option>
            <option value="week">Last 7 days </option>
            <option value="two-week">last 14 days</option>
            <option value="month">last 30 days </option>
            <option value="two-month">last 60 days </option>
        </select>
    </div>
    <div class="nsm-card-content" style=" position:'relative'; display: <?php echo $isListView ? 'block' : 'none'; ?>"
        id="thumbnail_content_graph_<?php echo $id; ?>">
        <h1 id='NewCustomerGraphLoader'> <span class="bx bx-loader bx-spin"></span></h1>
        <canvas id="NewCustomerWidgetsGraph" class="nsm-chart" data-chart-type="sales"></canvas>
        <h5 style="text-align: right;
    margin-top: -32px;
    font-size: 14px;
    font-weight: bold;
    margin-right: 15px;">Total : <span style="font-size: 16px;
    color: #6ba77ced !important;
    letter-spacing: 1.5px;" id="total_customer_graph"></span></h5>
    </div>

    <div class="nsm-card-content"
        style="  height: calc(100% - 120px);  display: <?php echo $isListView ? 'none' : 'block'; ?>"
        id="thumbnail_content_list<?php echo $id; ?>">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                    <label for="">Total Customer</label>
                    <h1 id="first_content_<?php echo $id; ?>" class='recent-customer-container-count'> <span
                            class="bx bx-loader bx-spin"></span></h1>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>