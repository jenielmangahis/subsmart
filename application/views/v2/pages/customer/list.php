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
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
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
                            A great process of managing interactions with existing as well as past and
                            potential customers is to have one powerful platform that can provide an
                            immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and
                            more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
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
                </div>
                <div class="row mt-5">
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
                    <button type="button" class="nsm-button batchUpdaterButton"><i class="fas fa-wrench text-muted"></i>&nbsp;&nbsp;Batch Updater Tool</button>
                    <button type="button" class="nsm-button dupEntryButton"><i class="fas fa-copy text-muted"></i>&nbsp;&nbsp;Manage Duplicated Entries&nbsp;<small class="text-muted dupEntryCount"></small></button>
                    <?php } ?>
                        <div class="nsm-page-buttons primary page-button-container">
                            <div class="dropdown d-inline-block">
                                <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown" style="width:122px;">
                                    <span>More Action <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <?php if( checkRoleCanAccessModule('customers', 'write') ){ ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= url('customer/import_customer') ?>"><i class='bx bx-fw bx-chart'></i> Import</a>
                                    </li>
                                    <?php } ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= url('customer/export_customer') ?>"><i class='bx bx-fw bx-file'></i> Export</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" id="print-customer-list" href="javascript:void(0)"><i class='bx bx-fw bx-printer'></i> Print</a>
                                    </li>
                                    <?php if( checkRoleCanAccessModule('customers', 'write') ){ ?>
                                    <li>
                                        <a class="dropdown-item" id="favorite-customer-list" href="javascript:void(0)"><i class='bx bx-fw bxs-heart'></i> Favorite Customers</a>
                                    </li>
                                    <?php } ?>
                                </ul>     
                            </div>
                            <?php if( checkRoleCanAccessModule('customers', 'write') ){ ?>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('customer/add_advance') ?>'">
                                <i class='bx bx-fw bxs-user-plus'></i> New Customer
                            </button>
                            <?php } ?>
                            <?php if( checkRoleCanAccessModule('customers', 'delete') ){ ?>
                            <button type="button" class="nsm-button primary" id="archived-customer-list">
                                <i class='bx bx-fw bx-trash'></i> Manage Archived
                            </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($enabled_table_headers)) : ?>
                    <div class="cont">
                        <table class="customerTbl customer-list table table-hover w-100 mb-3" id="customer-list">
                            <thead>
                                <tr>
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
                                    <?php if (in_array('plan_type', $enabled_table_headers)) : ?><th data-name="Plan Type">Plan Type</th><?php endif; ?>
                                    <?php if (in_array('rate_plan', $enabled_table_headers)) : ?><th data-name="Rate Plan">Rate Plan</th><?php endif; ?>
                                    <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?><th data-name="<?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> "><?= $companyId == 58 ? 'Proposed Payment' : 'Subscription Amount'   ?> </th><?php endif; ?>
                                    <?php if (in_array('job_amount', $enabled_table_headers)) : ?><th data-name="<?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount' ?>"><?= $companyId == 58 ? 'Proposed Solar' : 'Job Amount'   ?></th><?php endif; ?>
                                    <?php if (in_array('phone', $enabled_table_headers)) : ?><th data-name="Phone">Phone</th><?php endif; ?>
                                    <?php if (in_array('status', $enabled_table_headers)) : ?><th data-name="Status">Status</th><?php endif; ?>
                                    <th data-name="Manage"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($profiles)) :
                                ?>
                                    <?php
                                    foreach ($profiles as $customer) :
                                        switch (strtoupper($customer->status)):
                                            case "INSTALLED":
                                                $badge = "success";
                                                break;
                                            case "CANCELLED":
                                                $badge = "error";
                                                break;
                                            case "COLLECTIONS":
                                                $badge = "secondary";
                                                break;
                                            case "CHARGED BACK":
                                                $badge = "primary";
                                                break;
                                            default:
                                                $badge = "";
                                                break;
                                        endswitch;
                                    ?>
                                        <?php if (in_array('name', $enabled_table_headers)) : ?>
                                            <td>
                                                <div class="nsm-profile">
                                                    <?php if ($customer->customer_type === 'Business'): ?>
                                                        <span>
                                                        <?php 
                                                            $parts = explode(' ', strtoupper(trim($customer->business_name)));
                                                            echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                                        ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span><?= ucwords($customer->first_name[0]) . ucwords($customer->last_name[0]) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="nsm-text-primary">
                                                <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('/customer/module/' . $customer->prof_id); ?>'">
                                                    <?php if ($customer->customer_type === 'Business'): ?>
                                                        <?= $customer->business_name ?>
                                                    <?php else: ?>
                                                        <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                    <?php endif; ?>
                                                </label>
                                                <label class="nsm-link default content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (in_array('industry', $enabled_table_headers)) : ?>
                                            <td>
                                                <?php 
                                                    if( $customer->industry_type_id > 0 ){
                                                        echo $customer->industry_type;
                                                    }else{
                                                        echo 'Not Specified';                                                    
                                                    }
                                                ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (in_array('city', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->city; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('state', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->state; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('source', $enabled_table_headers)) : ?>
                                            <td><?= $customer->lead_source != "" ? $customer->lead_source : 'n/a'; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('added', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->entered_by; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('sales_rep', $enabled_table_headers)) : ?>
                                            <td><?php print_r( get_sales_rep_name($customer->fk_sales_rep_office)); ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('tech', $enabled_table_headers)) : ?>
                                            <?php $techician = !empty($customer->technician) ?  get_employee_name($customer->technician)->FName : 'Not Assigned'; ?>
                                            <td><?= $techician; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('plan_type', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->system_type; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('rate_plan', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->rate_plan; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                            <td>$<?= $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',') ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('subscription_amount', $enabled_table_headers)) : ?>
                                            <td>$<?= $companyId == 58 ? number_format(floatval($customer->proposed_solar), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',') ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('phone', $enabled_table_headers)) : ?>
                                            <td><?php echo $customer->phone_m; ?></td>
                                        <?php endif; ?>
                                        <?php if (in_array('status', $enabled_table_headers)) : ?>
                                            <td><span class="nsm-badge <?= $badge ?>"><?= $customer->status != null ? $customer->status : 'Pending'; ?></span></td>
                                        <?php endif; ?>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('customer/preview_/' . $customer->prof_id); ?>">Preview</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('customer/add_advance/' . $customer->prof_id); ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="mailto:<?= $customer->email; ?>">Email</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item call-item" href="javascript:void(0);" data-id="<?= $customer->phone_m; ?>">Call</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('invoice/add/'); ?>">Invoice</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('customer/module/' . $customer->prof_id); ?>">Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?= base_url('job/new_job1/'); ?>">Schedule</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item btn-messages" href="javascript:void(0);" data-id="<?= $customer->prof_id; ?>">Message</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                <?php
                                else :
                                ?>
                                    <tr>
                                        <td colspan="14">
                                            <div class="nsm-empty">
                                                <span>No results found.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="cont">
                        <table class="customerTbl " id="customer-list" style="width:100%">
                            <thead>
                                <tr>
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
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade nsm-modal fade" id="modal-archived-customers" aria-labelledby="modal-archived-customers-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-event-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Manage Archived Customers</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="customer-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-favorite-customers" aria-labelledby="modal-favorite-customers-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="quick-add-event-form">   
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Manage Favorite Customers</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="customer-favorite-list-container" style="max-height: 800px; overflow: auto;"></div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade duplicateRemoverModal" aria-modal="true"  role="dialog">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body"><span class="duplicateManagementContentLoader">Please wait while fetching duplicates...</span></div>
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
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
    const URL_ORIGIN = window.origin;

    $(document).ready(function () {
        var CUSTOMER_LIST_TABLE = $('#customer-list').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "cache": true,
            "stateSave": true,
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
                title: 'Restore Customer Data',
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
                                title: 'Success',
                                text: 'Customer data was successfully restored.',
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
                    title: "Favorite Customer",
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
                                        html: 'Customer record was updated successfully',
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
                title: 'Customers',
                html: `Delete selected customer <b>${name}</b>?`,
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
                                title: 'Save Successful!',
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

        $('#archived-customer-list').on('click', function(){
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

        $('#favorite-customer-list').on('click', function(){
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
                                icon: 'success',
                                title: 'Success',
                                text: 'Customer data was successfully updated.',
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