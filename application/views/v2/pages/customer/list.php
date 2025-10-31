<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
    .row-adt-project {
    background-color: #d1b3ff !important;
    }

    .badge-primary {
        background-color: #007bff;
    }

    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        margin-top: 9px;
    }

    /* Disabled: Unable to see context menu when only few items showing  */
    /* .cont {
        overflow-x: auto;
    } */

    .customerTbl>thead {
        color: #888888;
        font-weight: bold;
        font-size: 14px;
    }

    .customerTbl td {
        padding: 0.8rem 0.5rem;
    }

    .customerTbl>tbody td {
        border-bottom: 1px solid #e8e8e8;
    }

    .customerTbl td .bx {
        color: #888888;
    }

    .customerTbl>tbody>tr:hover {
        background-color: #f7f7f7;
    }

    .customerTbl {
        width: 100%;
        font-size: 15px;
    }

    .customerTbl>tfoot td {
        padding: 0.8rem 0 0 0;
    }

    .customerTbl .table-icon {
        width: 1%;
    }

    table {
        width: 100% !important;
    }

    .dataTables_filter,
    .dataTables_length {
        display: none;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px !important;
        border-bottom: 1px solid lightgray;
    }

    table.dataTable.no-footer {
        border-bottom: 0px solid #111;
        margin-bottom: 10px;
    }

    #customerDuplicateTable td,
    #commercialDuplicateTable td {
        padding: 0.8rem 0rem;
    }

    #customerDuplicateTable_info,
    #commercialDuplicateTable_info {
        display: none;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid lightgray !important;
    }

    /* table.dataTable.no-footer {
        border-bottom: 1px solid lightgray !important;
    } */

    .customCheckbox {
        width: 20px;
        height: 20px;
    }

    .flexWrapUnset {
        flex-wrap: unset;
    }

    .scrollable-content {
        overflow-x: auto;
        white-space: nowrap;
    }

    .fieldColumn {
        width: 170px;
        vertical-align: middle;
    }

    .mergeProfile {
        margin-left: 50px;
    }

    .fw-xnormal {
        font-weight: 500;
        cursor: pointer;
    }

    .checkSize {
        font-size: 21px;
        margin-left: 10px;
        display: none;
    }

    .padding2px {
        padding: 1.75px !important;
    }

    .mergeProfile>label>small {
        margin-left: 10px;
    }

    .displayHide {
        display: none;
    }

    .modal-content {
        padding: unset;
    }

    .mergeOutputEntryWidth {
        width: 400px;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #6a4a86;
        border-radius: 50px;
        font-weight: bold;
    }

    #customerDuplicateTable>tbody>tr>td,
    #commercialDuplicateTable>tbody>tr>td {
        vertical-align: middle;
    }

    #customerDuplicateTable>thead>tr>th,
    #commercialDuplicateTable>thead>tr>th {
        color: gray;
    }

    #customerDuplicateTable>tbody>tr:hover {
        cursor: pointer;
    }

    .removeDuplicatedEntry2:focus,
    .removeDuplicatedEntry2:active:focus,
    .removeDuplicatedEntry2.active:focus {
        outline: none;
        box-shadow: none;
    }

    #customer-list .nsm-badge {
        font-size: 14px;
    }

    .select-filter-card {
        cursor: pointer
    }

    .customerManagementTable th:nth-child(1),
    .customerManagementTable th:nth-child(2),
    .customerManagementTable td:nth-child(1),
    .customerManagementTable td:nth-child(2) {
        position: sticky;
        left: 0;
        background: white;
        z-index: 3;
    }

    .customerManagementTable th:nth-child(2),
    .customerManagementTable td:nth-child(2) {
        left: 80px;
    }

    .customerManagementTable th {
        z-index: 4;
    }

    .tableUpdaterDiv {
        width: max-content;
        max-width: 100%;
        /* height: 550px; */
        overflow: auto;
        position: relative;

    }

    .actionButton,
    .textPreview {
        cursor: pointer;
    }

    .customerManagementTable, .updateHistoryTable {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .customerManagementTable>tbody>tr>td, .updateHistoryTable>tbody>tr>td {
        position: relative;
    }

    .textPreview:hover {
        color: red;
        font-weight: bolder;
    }

    .customerManagementTable th,
    .customerManagementTable td,
    .updateHistoryTable th,
    .updateHistoryTable td {
        border: 1px solid lightgray;
        padding: 8px !important;
        text-align: left !important;
        text-wrap: nowrap;
    }

    .customerManagementTable th, .updateHistoryTable th {
        background-color: #f2f2f2 !important;
    }

    .customerManagementTable~.dataTables_info {
        display: none;
    }

    .customerManagementTable~.dataTables_paginate, .updateHistoryTable~.dataTables_paginate {
        /* position: fixed; */
        /* float: left !important; */
        margin-bottom: 35px;
    }

    .customerManagementTable {
        vertical-align: middle;
    }

    .searchpdateHistoryRecords {
        width: 30% !important;
    }

    .customerProfileBanner {
        font-family: sans-serif;
        margin: 0;
    }

    .dropdownFilterWidth {
        width: max-content;
    }

    .searchCustomerListInput {
        width: 60% !important;
    }

    .applyRevert {
        background: #6a4a86;
        color: white;
    }

    .applyRevert:hover {
        border: 1px solid black;
        color: white;
    }

    .custom-loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #d3d3d3;
        z-index: 9999;
    }

    .custom-loader p {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .drag_handle {
        position: absolute;
        width: 10px;
        height: 10px;
        bottom: 0;
        right: 0;
        background-color: green;
        cursor: pointer;
        visibility: hidden;
    }

    .cell_dragging {
        border: 2px solid green !important;
    }

    .cell_dragging_action {
        cursor: grabbing;
    }

    .default_cell {
        border: 1px solid lightgray;
    }

    .table > :not(:last-child) > :last-child > * {
        border-bottom: 1px solid #dee2e6;
    }
    .dropdown-menu {
        overflow: hidden;
        overflow-y: auto;
        max-height: calc(100vh - 500px);
    }
    #customer-list td:nth-child(1) {  
      vertical-align:middle;
    }
    #customer-list_wrapper{
        overflow:auto;
    }
    .nsm-callout {
        margin-bottom: unset;
    }
</style>
<style>
    .commercialCustomerGroupContainer {
        max-height: 200px;
    }

    .commercialCustomerStatusCategory {
        background: #00000008;
        border-radius: 5px;
        outline: 1px solid #0000000f;
        padding: 5px;
        margin-top: 10px;
        padding-left: 10px;
        cursor: pointer;
    }
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <?php if(checkRoleCanAccessModule('customers', 'write')){ ?>
    <ul class="nsm-fab-options">        
        <li onclick="location.href='<?php echo url('customer/add_advance') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add Customer</span>
        </li>
        <li id="btn-mobile-favorites">
            <div class="nsm-fab-icon">
                <i class='bx bx-heart-circle'></i>                
            </div>
            <span class="nsm-fab-label">Favorites</span>
        </li> 
        <li class="btn-export-list">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export List</span>
        </li>
        <li id="btn-mobile-archived">
            <div class="nsm-fab-icon">
                <i class='bx bx-archive'></i>
            </div>
            <span class="nsm-fab-label">Archived</span>
        </li>                    
    </ul>
    <?php } ?>      
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Displays and manage interactions with your current, past, and potential customers through one platform designed to deliver instant responses to their needs.
                        </div>
                    </div>
                </div>
                <div class="row mb-3 table-responsive commercialCustomerGroupContainer"></div>
                <div class="row">
                    <div class="col mt-3 commercialCustomerBadgeLoader">
                        <div class="text-center">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row g-3 mb-3">
                    <?php 
                      $colorClasses = ['primary', 'success', 'error', 'secondary'];
                      $index = 0;
                    foreach($statusCounts as $status => $count){?>
                    <div class="col-6 col-md-3 col-lg-2 select-filter-card" data-value="<?php echo $status; ?>">
                        <div class="nsm-counter <?php echo $colorClasses[$index % 4]; ?> h-100 mb-2 " id="estimates">
                            <div class="row h-100 w-auto">
                                
                                <div class=" w-100 col-md-8 text-start d-flex align-items-center  justify-content-between">
                                <span><i class="bx bx-receipt"></i> <?php 
                                if($status == 'Design Team/Engineering Stamps')
                                {
                                  echo 'Design/Eng Stamps';
                                }
                                elseif($status == 'Loan Documents to be Executed')
                                {
                                    echo 'Loan Docs to be Executed';
                                }else{
                                   echo $status; 
                                }
                                ?></span>
                                <h2 id="total_this_year"><?php echo $count ?></h2>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $index++;}; ?>
                </div> -->
                <div class="row">
                     <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <!-- <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Item"> -->
                            <input type="text" class="nsm-field nsm-search form-control mb-2" style="display:inline-block;width:80%;" id="CUSTOMER_SEARCHBAR" placeholder="Search Customer">
                            <a href="javascript:void(0);" id="btn-reset-customer-list" class="nsm-button primary">Reset</a>
                        </div>
                    </div>
                    <div class="col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by : <span id="filter-selected">All Status</span></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                 <li><a class="dropdown-item"data-value="" href="#">All Status</a></li>
                                 <?php  foreach($statusCounts as $status => $count){?>
                                <li><a class="dropdown-item" data-value="<?= $status ?>" href="#"><?= $status ?></a></li>
                              
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if( checkRoleCanAccessModule('customers', 'write') ){ ?>                                
                        <button type="button" class="nsm-button dupEntryButton"><i class="fas fa-copy text-muted"></i>&nbsp;&nbsp;Manage Duplicate Entries&nbsp;<small class="text-muted dupEntryCount"></small></button>
                        <?php } ?>
                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                With Selected <small id="num-checked" class="text-muted"></small> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-favorites" href="javascript:void(0);" data-action="delete">Add to Favorites</a></li>       
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="nsm-page-buttons primary page-button-container">                            
                            <?php if( checkRoleCanAccessModule('customers', 'write') ){ ?>
                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="btn-new-customer"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Customer</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                              
                                    <li><a class="dropdown-item batchUpdaterButton" href="javascript:void(0);">Batch Updater Tool</a></li>        
                                    <li><a class="dropdown-item" id="archived-customer-list" href="javascript:void(0);">Archived</a></li>        
                                    <li><a class="dropdown-item" id="favorite-customer-list" href="javascript:void(0);">Favorites</a></li> 
                                     <li><div class="dropdown-divider"></div></li> 
                                    <li><a class="dropdown-item" id="btn-export-customer" href="javascript:void(0);">Export</a></li>                               
                                    <li><a class="dropdown-item" id="btn-import-customer" href="javascript:void(0);">Import</a></li>                               
                                    <li><a class="dropdown-item" id="print-customer-list" href="javascript:void(0);">Print</a></li>                               
                                </ul>
                            </div>
                            <?php } ?>
                        </div>                        
                    </div>
                </div>
                <?php if (!empty($enabled_table_headers)) : ?>
                    <div class="cont">
                        <form id="frm-with-selected">
                        <table class="customerTbl customer-list table table-hover w-100 mb-3" id="customer-list">
                            <thead>
                                <tr>
                                    <th class="table-icon text-center sorting_disabled">
                                        <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                    </th>
                                    <th class="table-icon"></th>
                                    <?php if (in_array('name', $enabled_table_headers)) : ?><th data-name="Name">Name</th><?php endif; ?>
                                    <?php if (in_array('email', $enabled_table_headers)) : ?><th data-name="Name">Email</th><?php endif; ?>
                                    <?php if (in_array('industry', $enabled_table_headers)) : ?><th data-name="Name">Industry</th><?php endif; ?>
                                    <?php if (in_array('city', $enabled_table_headers)) : ?><th data-name="City">City</th><?php endif; ?>
                                    <?php if (in_array('state', $enabled_table_headers)) : ?><th data-name="State">State</th><?php endif; ?>
                                    <?php if (in_array('source', $enabled_table_headers)) : ?><th data-name="Source">Source</th><?php endif; ?>
                                    <?php if (in_array('added', $enabled_table_headers)) : ?><th data-name="Added">Added</th><?php endif; ?>
                                    <?php if (in_array('sales_rep', $enabled_table_headers)) : ?><th data-name="Sales Rep">Sales Rep</th><?php endif; ?>
                                    <?php if (in_array('tech', $enabled_table_headers)) : ?><th data-name="Tech">Tech</th><?php endif; ?>
                                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?><th data-name="Plan Type">Service Package</th><?php endif; ?>
                                    <?php if (in_array('rate_plan', $enabled_table_headers)) : ?><th data-name="Rate Plan">Rate Plan</th><?php endif; ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><th data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> "><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> </th><?php endif; ?>
                                    <?php if (in_array('job_amount', $enabled_table_headers)) : ?><th data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount' ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></th><?php endif; ?>
                                    <?php if (in_array('phone', $enabled_table_headers)) : ?><th data-name="Phone">Phone</th><?php endif; ?>
                                    <?php if (in_array('status', $enabled_table_headers)) : ?><th data-name="Status">Status</th><?php endif; ?>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="cont">
                        <form id="frm-with-selected">
                        <table class="customerTbl " id="customer-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-icon text-center sorting_disabled">
                                        <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                    </th>
                                    <th class="table-icon"></th>
                                    <th data-name="Name">Name   </th>
                                    <?php if($companyId == 1): ?>
                                    <th data-name="Name">Industry</th>
                                    <?php endif; ?>
                                    <th data-name="City">City</th>
                                    <th data-name="State">State</th>
                                    <th data-name="Source">Source</th>
                                    <th data-name="Added">Added</th>
                                    <th data-name="Sales Rep">Sales Rep</th>
                                    <th data-name="<?= $companyId == 58 ? 'Mentor' : 'Tech'   ?>"><?= $companyId == 58 ? 'Mentor' : 'Tech'   ?></th>
                                    <th data-name="Plan Type">Plan Type</th>
                                    <th data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?>"><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'; ?></th>
                                    <th data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></th>
                                    <th data-name="Phone">Phone</th>
                                    <th data-name="Status">Status</th>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade nsm-modal fade" id="modal-archived-customers" aria-labelledby="modal-archived-customers-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Archived Customers</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="customer-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-favorite-customers" aria-labelledby="modal-favorite-customers-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Manage Favorite Customers</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="customer-favorite-list-container" style="max-height: 800px; overflow: auto;"></div>
        </div>
    </div>
</div>

<div class="modal fade duplicateRemoverModal" aria-modal="true"  role="dialog">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body"><span class="duplicateManagementContentLoader">Please wait while fetching the tool content...</span></div>
        </div>
    </div>
</div>
<div class="modal fade batchUpdaterModal" aria-modal="true"  role="dialog">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body"><span class="customerUpdaterContentLoader">Please wait while fetching the tool content...</span></div>
        </div>
    </div>
</div>

<div class="modal updateHistoryModal" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title content-title" style="font-size: 17px;"><i class="fas fa-history"></i>&nbsp;&nbsp;Update History</div>
                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body pt-2"></div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
    function getCustomerGroupBadge() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/dashboard/thumbnailWidgetRequest`,
            //url: base_url + `dashboard/thumbnailWidgetRequest`,
            data: {
                category: "customer_groups",
                dateFrom: "1970-01-01",
                dateTo: "<?php echo date('Y-m-d'); ?>",
                // filter3: "all_status",
                // filter4: "commercial",
            },
            beforeSend: function() {
                $('.commercialCustomerGroupContainer').hide();
                $('.commercialCustomerBadgeLoader').show();
            },
            success: function(response) {
                const data = JSON.parse(response).GRAPH;
                let html = "";

                const colorMap = {
                    "ADT Solar Pro": { bg: "#FFD70010", border: "#FFD70020" },
                    "Alarm.com": { bg: "#FFCC0010", border: "#FFCC0020" },
                    "Alarm.com & DVR": { bg: "#FFC00010", border: "#FFC00020" },
                    "AlarmNet": { bg: "#007BFF10", border: "#007BFF20" }, 
                    "AlarmNet & PERS": { bg: "#3399FF10", border: "#3399FF20" },
                    "DVR": { bg: "#8A2BE210", border: "#8A2BE220" },
                    "Landline": { bg: "#80808010", border: "#80808020" },
                    "Landline & Pers": { bg: "#A9A9A910", border: "#A9A9A920" },
                    "Pers": { bg: "#32CD3210", border: "#32CD3220" },
                    
                    "Commercial": { bg: "#00CED110", border: "#00CED120" },
                    "Residential": { bg: "#FF69B410", border: "#FF69B420" },
                    "Enterprise": { bg: "#9932CC10", border: "#9932CC20" }, 
                    "Unknown": { bg: "#0000000a", border: "#0000000f" },
                };


                if (data.length != 0) {
                    Object.entries(data).forEach(([key, value]) => {
                        const lowerKey = key.toLowerCase();
                        let matchedColor = colorMap["Unknown"];

                        for (const groupName in colorMap) {
                            if (lowerKey.includes(groupName.toLowerCase())) {
                                matchedColor = colorMap[groupName];
                                break;
                            }
                        }

                        html += `
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center">
                                <div class="commercialCustomerStatusCategory" style="background:${matchedColor.bg}; border:1px solid ${matchedColor.border};">
                                    <small class="text-uppercase commercialCustomerStatusName">${key}</small>
                                    <h5 class="commercialCustomerStatusCount">${value}</h5>
                                </div>
                            </div>
                        `;

                        $('.commercialCustomerCategoryFilter').append(`<option value="${key}">${key}</option>`);
                    });
                } else {
                    html += `
                        <div class="col-lg-1">
                            <div class="commercialCustomerStatusCategory">
                                <small class="text-uppercase commercialCustomerStatusName">No Status Found</small>
                                <h5 class="commercialCustomerStatusCount">0</h5>
                            </div>
                        </div>
                    `;
                }

                $('.commercialCustomerGroupContainer').html(html);
                setTimeout(() => {
                    $('.commercialCustomerGroupContainer').show();
                    $('.commercialCustomerBadgeLoader').hide(); 
                }, 500);
            },
            error: function() {
                $('.commercialCustomerGroupContainer').show();
                $('.commercialCustomerBadgeLoader').hide();
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "An unexpected error occurred. Please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    }

    $(function () {
        // getCommercialCustomers();
        getCustomerGroupBadge();
    });






































    const URL_ORIGIN = window.origin;

    $(document).ready(function () {
        var CUSTOMER_LIST_TABLE = $('#customer-list').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            //"cache": true, //Cache save
            //"stateSave": true, //Cache save
            // "order": [],
            "pageLength": 10,
            "ajax": {
                "url": "<?= base_url('customer/getCustomerLists'); ?>",
                "type": "POST",
                "data": function(d) {
                    // Include custom parameters for filtering
                    d.filter_status = $('#filter-selected').text().trim(); // Get filter value from UI element
                },
                "dataSrc": function(json) {
                    csv_data = json.data;
                    return json.data;
                }
            },
            "bDestroy": true,
            "language": {
                "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>"
            },
            // Load data from an Ajax source
            // "createdRow": function( row, data, dataIndex){
            //     //console.log(data);
            //     if( data[14] ==  'yes'){
            //         $(row).addClass('row-adt-project');
            //         /*$(row).attr('title', 'ADT Solar Data');
            //         $(row).attr('data-toggle', 'tooltip');
            //         $(row).attr('data-placement', 'top');*/
            //     }
            // },            
            //Set column definition initialisation properties
            "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                },
                // { 
                //     "targets": [14],
                //     "visible": false,
                //     "searchable": false,
                // }
            ]
        }).on('init', function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('filter')) {
                const filter = urlParams.get('filter').replace(/_/g, ' ');
                setTimeout(() => {
                    $(`a[data-value="${filter}"]`).click();
                }, 100);
            }
        });

        $("#CUSTOMER_SEARCHBAR").keyup(function() {
            CUSTOMER_LIST_TABLE.search($(this).val()).draw()
        });

        $(document).on('change', '#select-all', function(){
            $('.row-select:checkbox').prop('checked', this.checked);  
            let total= $('#customer-list input[name="customers[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('#customer-list input[name="customers[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('click', '#with-selected-favorites', function(){
            let total= $('#customer-list input[name="customers[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Add to Favorites',
                    html: `Are you sure you want to add selected rows to the list?`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + "customers/_with_selected_add_to_favorites",
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Add to Favorites',
                                        text: "Customer records updated successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            CUSTOMER_LIST_TABLE.ajax.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }     
        });

        $(document).on('click', '#with-selected-delete', function(){
            let total= $('#customer-list input[name="customers[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Customers',
                    html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'customers/_archive_selected_customers',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Customers',
                                        text: "Customer records deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            CUSTOMER_LIST_TABLE.ajax.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        });

        $('#btn-reset-customer-list').on('click', function(){
            CUSTOMER_LIST_TABLE.state.clear(); 
            location.reload();
        });

        // Remove bug css on DataTable Serverside
        $('#customer-list').removeClass('dataTable');

        $(document).on("click", ".call-item", function() {
            let phone = $(this).attr("data-id");

            window.open('tel:' + phone);
        });

        $('.select-filter .dropdown-item').on('click', function(e) {
            e.preventDefault();
            var filterValue = $(this).attr('data-value');
            var filterText = $(this).text();

            $('#filter-selected').text(filterText);

            CUSTOMER_LIST_TABLE.ajax.reload();
        });

        $('.select-filter-card').on('click', function(e) {
            e.preventDefault();
            var filterValue = $(this).attr('data-value');
            //console.log('filterValue', filterValue)
            $('#filter-selected').text(filterValue);

            CUSTOMER_LIST_TABLE.ajax.reload();
        });

        $('#print-customer-list').on('click', function() {
            var url = base_url + 'customer/_get_customer_lists';

            $('#print_customer_list_modal').modal('show');
            $("#print-customer-list-container").html('<span class="bx bx-loader bx-spin"></span> loading customer list...');

            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {},
                    success: function(o) {
                        $("#print-customer-list-container").html(o);
                    }
                });
            }, 800);
        });

        $(document).on('click', '.btn-restore-customer', function(){
            var cid = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            Swal.fire({
                title: 'Restore Customer',
                html: `Proceed with restoring customer data <b>${name}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {                    
                    $.ajax({
                        type: "POST",
                        url: base_url + "customer/_restore_archived",
                        data: {cid:cid},
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                $('#modal-archived-customers').modal('hide');
                                Swal.fire({
                                icon: 'success',
                                title: 'Restore Customer',
                                text: 'Customer record was successfully restored.',
                                }).then((result) => {
                                    CUSTOMER_LIST_TABLE.ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.favorite-customer', function(){
            var cid = $(this).attr('data-id');
            var cname = $(this).attr('data-name');
            var is_favorite = $(this).attr('data-favorite');

            if( is_favorite == 1 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Customer is already in favorite list.'
                });
            }else{
                Swal.fire({
                    title: "Add to Favorites",
                    html: `Do you want to add to <b>${cname}</b> to the list?`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        var url = base_url + "customer/_add_to_favorites";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                cid: cid
                            },
                            dataType: 'json',
                            beforeSend: function(result) {

                            },
                            success: function(result) {
                                if (result.is_success == 1) {
                                    Swal.fire({
                                        title: "Add to Favorites",
                                        text: "Customer record updated successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        CUSTOMER_LIST_TABLE.ajax.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        html: result.msg
                                    });
                                }
                            },
                            complete: function() {

                            },
                            error: function(e) {
                                console.log(e);
                            }
                        });
                    }
                });
            }            
        });

        $(document).on('click', '.delete-customer', function() {
            var cid = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Customer',
                html: `Delete selected customer <b>${name}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    var url = base_url + "customer/_delete_customer";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            cid: cid
                        },
                        dataType: 'json',
                        beforeSend: function(result) {

                        },
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Delete Customer',
                                    html: 'Customer record was deleted successfully',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    CUSTOMER_LIST_TABLE.ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: result.msg
                                });
                            }
                        },
                        complete: function() {

                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        });

        $(document).on('click', '#btn_print_customer_list', function() {
            $("#customer_table_print_ajax").printThis();
        });

        $(document).on('click', '.sms-messages', function() {

            var profid = $(this).attr('data-id');
            //var url = base_url + 'customer/_get_messages';
            var url = base_url + 'customer/_load_customer_sms_messages';

            $('#messages_modal').modal('show');
            $(".modal-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        profid: profid
                    },
                    success: function(o) {
                        $(".modal-messages-container").html(o);
                    }
                });
            }, 800);
        });

        $(document).on('click', '.send-email', function() {
            var customer_email = $(this).attr('data-email');
            var customer_eid = $(this).attr('data-id');

            $('#send_email_modal').modal('show');
            $('#customer-email').val(customer_email);
            $('#customer-send-email-eid').val(customer_eid);
            $('#email-message').val('');
            $('#email-subject').val('');
        });

        $(document).on('submit', '#frm-send-email', function(e) {
            e.preventDefault();

            var url = base_url + 'customer/_send_email';
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: $('#frm-send-email').serialize(),
                beforeSend: function(data) {
                    $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(o) {
                    $("#btn_send_email").html('Send');
                    if (o.is_success == 1) {
                        Swal.fire({
                            html: 'Email sent',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {

                        });
                        $("#send_email_modal").modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                        });
                    }
                },
                complete: function() {

                },
                error: function(e) {
                    console.log(e);
                }
            });

            $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
        });

        $(document).on('submit', '#frm-send-message', function(e) {
            e.preventDefault();

            var url = base_url + 'customer/_send_message';
            $(".btn-send-message").html('<span class="bx bx-loader bx-spin"></span>');

            var formData = new FormData($("#frm-send-message")[0]);

            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    success: function(o) {
                        if (o.is_success == 1) {
                            $("#messages_modal").modal("hide");
                            Swal.fire({
                                title: 'Send Message',
                                text: "Customer message was successfully sent",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {

                                //}
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                            });
                        }

                        $(".btn-send-message").html('Send');
                    }
                });
            }, 800);
        });

        $(document).on('click', '.batchUpdaterButton', function() {
            const content = $('.batchUpdaterModal').find('.batchUpdaterContent').length;
            $('.batchUpdaterModal').modal('show');
            if (content == 0) {
                $.ajax({
                    type: "POST",
                    url: URL_ORIGIN + "/Customer/toolContent/batchUpdater",
                    success: function(response) {
                        $('.batchUpdaterModal').find('.modal-body').append(response);
                        $('.customerUpdaterContentLoader').remove();
                    },
                });
            }
        });

        $(document).on('click', '.dupEntryButton', function() {
            const content = $('.duplicateRemoverModal').find('.duplicateManagementContent').length;
            $('.duplicateRemoverModal').modal('show');
            if (content == 0) {
                $.ajax({
                    type: "POST",
                    url: URL_ORIGIN + "/Customer/toolContent/duplicateManagement",
                    success: function(response) {
                        $('.duplicateRemoverModal').find('.modal-body').append(response);
                    },
                });
            }
        });

        $('#btn-new-customer').on('click', function(){
            location.href = base_url + 'customer/add_advance';
        });

        $('#btn-export-customer, .btn-export-list').on('click', function(){
            location.href = base_url + 'customer/export_customer';
        });

        $('#btn-import-customer').on('click', function(){
            location.href = base_url + 'customer/import_customer';
        });

        $('#archived-customer-list, #btn-mobile-archived').on('click', function(){
            $('#modal-archived-customers').modal('show');
            $.ajax({
                type: "POST",
                url: base_url + "customer/_archived_list",  
                success: function(html) {    
                    $('#customer-archived-list-container').html(html);                          
                },
                beforeSend: function() {
                    $('#customer-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#favorite-customer-list, #btn-mobile-favorites').on('click', function(){
            $('#modal-favorite-customers').modal('show');
            $.ajax({
                type: "POST",
                url: base_url + "customer/_favorite_list",  
                success: function(html) {    
                    $('#customer-favorite-list-container').html(html);                          
                },
                beforeSend: function() {
                    $('#customer-favorite-list-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on('click', '.btn-remove-favorite-customer', function(){
        var cid = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        Swal.fire({
                title: 'Remove from Favorites',
                html: `Do you wish to remove from favorites customer <b>${name}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {                    
                    $.ajax({
                        type: "POST",
                        url: base_url + "customer/_remove_favorite",
                        data: {cid:cid},
                        dataType:'json',
                        success: function(result) {     
                            $('#modal-favorite-customers').modal('hide');                       
                            if( result.is_success == 1 ) {
                                $('#modal-archived-customers').modal('hide');
                                Swal.fire({
                                title: 'Remove from Favorites',
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Customer record was successfully updated.',
                                }).then((result) => {
                                    CUSTOMER_LIST_TABLE.ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.send-esign', function(){
            var prof_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            $('#customer-esign').val(prof_id);
            $('#modal-send-esign-customer-name').text(name);
            $('#modal-send-esign').modal('show');

            $.ajax({
                type: "POST",
                url: base_url + "customer/_send_esign_form",
                data: {prof_id:prof_id},
                beforeSend: function(data) {
                    $("#customer-send-esign").html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(html) {
                    $("#customer-send-esign").html(html);
                },
                complete: function() {

                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $(document).on('click', '#btn-customer-send-esign-template', function(){
            var prof_id = $('#customer-esign').val();
            var esign_template_id = $('#modal-send-esign #customer-send-esign-template').val();
            var url = base_url + `eSign_v2/templatePrepare?id=${esign_template_id}&job_id=0&customer_id=${prof_id}`;

            window.open(
                url,
                '_blank'
            );

            $('#modal-send-esign').modal('hide');
        });

        $(document).on('click', '#btn-empty-archives', function(){        
            let total_records = $('#archived-customers input[name="customers[]"]').length;        
            if( total_records > 0 ){
                Swal.fire({
                    title: 'Empty Archived',
                    html: `Are you sure you want to <b>permanently delete</b> <b>${total_records}</b> archived customers? <br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'customers/_delete_all_archived_customers',
                            dataType: 'json',
                            data: $('#frm-archive-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-customers').modal('hide');
                                    Swal.fire({
                                        title: 'Empty Archived',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            //location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }else{
                Swal.fire({                
                    icon: 'error',
                    title: 'Error',              
                    html: 'Archived is empty',
                });
            }        
        });

        $(document).on('click', '#with-selected-restore', function(){
            let total= $('#archived-customers input[name="customers[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Restore Customers',
                    html: `Are you sure you want to restore selected rows?`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'customers/_restore_selected_customers',
                            dataType: 'json',
                            data: $('#frm-archive-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-customers').modal('hide');
                                    Swal.fire({
                                        title: 'Restore Customers',
                                        text: "Data restored successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        });

        $(document).on('click', '#with-selected-perma-delete', function(){
            let total= $('#archived-customers input[name="customers[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Customers',
                    html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'customers/_permanently_delete_selected_customers',
                            dataType: 'json',
                            data: $('#frm-archive-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-customers').modal('hide');
                                    Swal.fire({
                                        title: 'Delete Customers',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            //location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        });

        $(document).on('click', '.btn-permanently-delete-customer', function(){
            let customer_id   = $(this).attr('data-id');
            let customer_name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Customer',
                html: `Are you sure you want to <b>permanently delete</b> customer <b>${customer_name}</b>? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'customers/_permanently_delete_archived_customer',
                        data: {
                            customer_id: customer_id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            $('#modal-archived-customers').modal('hide');
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Customer',
                                    html: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });
    });

    function loadTotalDupEntries() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("customer/getDuplicatedEntry"); ?>',
            success: function(response) {
                if (response == 0) {
                    $('.dupEntryCount').text('(' + response + ')');
                } else {
                    $('.dupEntryButton').removeClass('d-none');
                    $('.dupEntryCount').text('(' + response + ')');
                }
            }
        });
    }
    loadTotalDupEntries();
</script>
<?php include viewPath('v2/includes/footer'); ?>