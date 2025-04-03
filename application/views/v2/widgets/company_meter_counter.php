<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
$category = "company_meter";
$thumbanailName = "$companyName->business_name Meter";
$description = "Company Meter tracks overall business activity. This card displays key company metrics to measure performance.";
$icon = '<i class="fas fa-tachometer-alt"></i>';
?>
<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="thumbnail_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="summary-report-header-sub ">
                        <div class="icon-summary-sales">
                            <i class="bx bx-bar-chart-square"></i>
                        </div>
                        <a role="button" class=" btn-sm m-0 me-2" href="plaid_accounts"
                            style="color:#6a4a86 !important ">
                            <span style="color:#6a4a86; " id='company_meter_title'><?php echo $companyName->business_name; ?>
                            Meter</span>
                        </a>
                    </div>

                </div>

            </div>
        </div>
        
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeThumbnail('<?php echo $id; ?>');">Remove
                            Thumbnail</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px);">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                    <label for="" id="plaid_label">Plaid Accounts</label>
               
                    <div id="plaid-accounts-thumbnail">
                  
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
// if (!is_null($dynamic_load) && $dynamic_load == true) {
// }
?>
