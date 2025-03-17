<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
$category = "acs_profile";
$thumbanailName = "Active Customer Groups";
$description = "Active Customer Groups categorize customers based on engagement. This card displays the total number of active customers and their associated groups.";
$icon = '<i class="fas fa-users"></i>';
?>
<style> .display_none { display: none; }</style>
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
                <select class="form-select w-100" onChange="filterThumbnail(this.value, '<?php echo $id; ?>', '<?php echo $category; ?>')">
                    <option value="all">All time</option>
                    <option value="week">Last 7 days</option>
                    <option value="two-week">Last 14 days</option>
                    <option value="month">Last 30 days</option>
                    <option value="two-month">Last 60 days</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col textData_<?php echo $id; ?> <?php echo $isListView == 1 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <strong class="text-muted text-uppercase">TOTAL CUSTOMERS</strong>
                    <h2 id="first_content_<?php echo $id; ?>" class='recent-customer-container-count'> <span class="bx bx-loader bx-spin"></span></h1>
                </div>
            </div>
            <div class="col graphData_<?php echo $id; ?> <?php echo $isListView == 0 ? 'display_none' : ''; ?>">
                <div class="text-center p-2">
                    <canvas id="NewCustomerWidgetsGraph" class="nsm-chart" data-chart-type="widgets/customer_counter" data-chart-id="<?php echo $id; ?>" style="max-height: 120px;"></canvas>
                    <strong>Total : <span style="font-size: 16px; color: #6ba77ced !important; letter-spacing: 1.5px;" id="total_customer_graph"></span></strong>
                </div>
            </div>
        </div>
        <strong class="dragHandle">⣿⣿⣿⣿</strong>
        <span class="widthResizeHandle"></span>
        <span class="heightResizeHandle"></span>
    </div>
</div>
<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
?>