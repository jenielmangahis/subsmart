<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
<style>
.row-adt-project{
    background-color: #d1b3ff !important;
}
.badge-primary{
    background-color: #007bff;
}
.badge{
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
    .cont{
        overflow-x: auto;
    }
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
    .customerTbl{
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
    .dataTables_filter, .dataTables_length{
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px !important;
    border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}

#customerDuplicateTable td {
    padding: 0.8rem 0rem;
}

#customerDuplicateTable_info { 
    display: none;
}

table.dataTable thead th, table.dataTable thead td{
    padding: 10px 18px;
    border-bottom: 1px solid lightgray !important;
}

table.dataTable.no-footer {
    border-bottom: 1px solid lightgray !important;
}

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

.mergeProfile > label > small {
    margin-left: 10px;
}

.displayHide {
    display: none; 
}

.modal-content {
    padding: unset;
}

.mergeOutputEntryWidth {
    width: 316px;
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
                <div class="row">
                     <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <!-- <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Item"> -->
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOMER_SEARCHBAR" placeholder="Search Customer...">
                        </div>
                    </div>
                    <div class="col-md-8 grid-mb text-end">
                    <button type="button" class="nsm-button dupEntryButton d-none" data-bs-toggle="modal" data-bs-target=".duplicateRemoverModal"><i class='bx bxs-duplicate'></i> Duplicate Entries <small class="text-muted dupEntryCount"></small></button>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?= url('customer/import_customer') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Import
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?= url('customer/customer_export') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Export
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Add Lead
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('customer/add_advance') ?>'">
                                <i class='bx bx-fw bx-chart'></i> New Customer
                            </button>
                            <button type="button" class="nsm-button primary" id="print-customer-list" data-bs-toggle="modal" data-bs-target="#print_customer_list_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php if (!empty($enabled_table_headers)) : ?>
                    <div class="cont">
                        <table class="customerTbl customer-list" id="customer-list" style="width:100%;">
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
<div class="modal duplicateRemoverModal" data-bs-backdrop="static" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title content-title" style="font-size: 17px;"><i class="fas fa-file-alt"></i>&nbsp;&nbsp;Manage Duplicate Entries</div>
                <i class="fas fa-times" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 mb-3 dupWizardStep1">
                        <table id="customerDuplicateTable" class="nsm-table w-100 border-0" style="border-color: #cdcdcd !important;">
                            <thead>
                                <tr>
                                    <th>CUSTOMER / COMMERCIAL</th>
                                    <th>TYPE</th>
                                    <th>ADDRESS</th>
                                    <th>LOGS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody><tr></tr></tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 mb-3 dupWizardStep2 displayHide">
                        <div class="container-fluid mb-3 mt-3">
                            <div class="row">
                                <h4 class="fw-bold">Compare and Merge</h4>
                                <p>Select specific fields to be used for the merged output entry.</p>
                            </div>
                        </div>
                        <div class="row flexWrapUnset">
                            <div class="col-lg-1 w-auto entryFields">
                                <table class="table">
                                    <tbody>
                                        <tr><td class="float-end align-middle invisible"><span>PLACEHOLDER</span></td></tr>
                                        <tr><td class="float-end align-middle"><div class="nsm-profile invisible"><span>PLACEHOLDER</span></div></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>STATUS:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>CUSTOMER TYPE:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>BUSINESS NAME:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>CUSTOMER GROUP:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>SALES AREA:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>FIRST NAME:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>MIDDLE NAME:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>LAST NAME:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>NAME PREFIX:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>SUFFIX:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>COUNTRY:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>ADDRESS:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>CITY:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>COUNTY:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>STATE:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>ZIP CODE:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>CROSS STREET:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>SUBDIVISION:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>SOCIAL SECURITY NO.:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>BIRTHDATE:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>EMAIL:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>PHONE:</strong></td></tr>
                                        <tr><td class="float-end align-middle text-muted"><strong>MOBILE:</strong></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-1 w-auto fetchingDataLoader">
                                <strong>COLLECTING DATA PLEASE WAIT...</strong>
                            </div>
                            <div class="col-lg-1 w-auto"><div class="d-flex h-100"><div class="vr"></div></div></div>
                            <div class="col-lg-2 mergeOutputEntryWidth">
                                <form id="mergeEntryForm">
                                    <table class="table table-hover destinationData">
                                        <tbody>
                                            <tr>
                                                <td class="align-middle fw-xnormal"><small class="entryDestinationLogsCount">0 activity logs</small></td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle destinationProfileData">
                                                    <div class="float-start">
                                                        <div class="nsm-profile"><span class="entryDestinationInitials">?</span></div>
                                                    </div>
                                                    <div class="mergeProfile">
                                                        <label class="nsm-link default d-block fw-bold"><span class="entryDestinationName">Customer Name</span><small class="text-muted float-end entryDestinationID">#00000</small></label>
                                                        <label class="nsm-link default content-subtitle fst-italic d-block"><span class="entryDestinationEmail">Email Address</span></label>
                                                        <input type="hidden" name="destinationCustomerID" required>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <select class="form-select fw-bold border-0" name="destinationStatus" required>
                                                        <option selected value="">—</option>
                                                        <?php foreach ($customer_status as $customer_statuses): ?>
                                                            <option value="<?php echo $customer_statuses->name ?>"><?php echo $customer_statuses->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <select class="form-select fw-bold border-0" name="destinationCustomerType" required>
                                                        <option selected value="">—</option>
                                                        <option value="Residential">Residential</option>
                                                        <option value="Commercial">Commercial</option>
                                                    </select>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationBusinessName" placeholder="—">
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <select class="form-select fw-bold border-0" name="destinationCustomerGroup" required>
                                                        <option selected value="">—</option>
                                                        <?php foreach ($customer_group as $customer_groups): ?>
                                                            <option value="<?php echo $customer_groups->id ?>"><?php echo $customer_groups->title ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <select class="form-select fw-bold border-0" name="destinationSalesArea" required>
                                                        <option selected value="">—</option>
                                                        <?php foreach ($sales_area as $sales_areas): ?>
                                                            <option value="<?php echo $sales_areas->sa_id ?>"><?php echo $sales_areas->sa_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationFirstName" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationMiddleName" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationLastName" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <select class="form-select fw-bold border-0" name="destinationNamePrefix">
                                                        <option selected value="">None</option>
                                                        <option value="Captain">Captain</option>
                                                        <option value="Cnl.">Cnl.</option>
                                                        <option value="Colonel">Colonel</option>
                                                        <option value="Dr.">Dr.</option>
                                                        <option value="Gen.">Gen.</option>
                                                        <option value="Judge">Judge</option>
                                                        <option value="Lady">Lady</option>
                                                        <option value="Lieutenant">Lieutenant</option>
                                                        <option value="Lord">Lord</option>
                                                        <option value="Lt.">Lt.</option>
                                                        <option value="Madam">Madam</option>
                                                        <option value="Major">Major</option>
                                                        <option value="Master">Master</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Mister">Mister</option>
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Maj.">Maj.</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                        <option value="Ms.">Ms.</option>
                                                        <option value="Pastor">Pastor</option>
                                                        <option value="Private">Private</option>
                                                        <option value="Prof.">Prof.</option>
                                                        <option value="Pvt.">Pvt.</option>
                                                        <option value="Rev.">Rev.</option>
                                                        <option value="Sergeant">Sergeant</option>
                                                        <option value="Sgt">Sgt</option>
                                                        <option value="Sir">Sir</option>
                                                    </select>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <select class="form-select fw-bold border-0" name="destinationSuffix">
                                                        <option selected value="">None</option>
                                                        <option value="DS">DS</option>
                                                        <option value="Esq.">Esq.</option>
                                                        <option value="II">II</option>
                                                        <option value="III">III</option>
                                                        <option value="IV.">IV.</option>
                                                        <option value="Jr.">Jr.</option>
                                                        <option value="MA">MA</option>
                                                        <option value="MBA">MBA</option>
                                                        <option value="MD">MD</option>
                                                        <option value="MS">MS</option>
                                                        <option value="PhD">PhD</option>
                                                        <option value="RN">RN</option>
                                                        <option value="Sr.">Sr.</option>
                                                    </select>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationCountry" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationAddress" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationCity" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationCounty" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationState" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationZipCode" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationCrossStreet" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationSubdivision" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationSocialSecurityNo" maxlength="11" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="date" name="destinationBirthdate" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="email" name="destinationEmail" placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationPhone" maxlength="12"  placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle padding2px">
                                                    <input class="form-control fw-bold border-0" type="text" name="destinationMobile" maxlength="12"  placeholder="—" required>
                                                    <i class="fas fa-check checkSize align-middle float-end"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="float-end">
                                        <button type="button" class="nsm-button sm backToDuplicateList"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Back</button>
                                        <button type="submit" class="nsm-button primary sm"><i class="fas fa-copy"></i>&nbsp;&nbsp;Merge</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">

    function resetOutputEntry() {
        $('.entryDestinationLogsCount').text('0 activity logs');
        $('.entryDestinationInitials').text('?');
        $('.entryDestinationName').text('Customer Name');
        $('.entryDestinationID').text('#00000');
        $('.entryDestinationEmail').text('Email Address');
        $('input[name="destinationCustomerID"]').val(null).change();
        $('select[name="destinationStatus"] option:contains("—")').prop('selected', true).change();
        $('select[name="destinationCustomerType"] option:contains("—")').prop('selected', true).change();
        $('input[name="destinationBusinessName"]').val(null).change();
        $('select[name="destinationCustomerGroup"] option:contains("—")').prop('selected', true).change();
        $('select[name="destinationSalesArea"] option:contains("—")').prop('selected', true).change();
        $('input[name="destinationFirstName"]').val(null).change();
        $('input[name="destinationMiddleName"]').val(null).change();
        $('input[name="destinationLastName"]').val(null).change();
        $('select[name="destinationNamePrefix"] option:contains("None")').prop('selected', true).change();
        $('select[name="destinationSuffix"] option:contains("None")').prop('selected', true).change();
        $('input[name="destinationCountry"]').val(null).change();
        $('input[name="destinationAddress"]').val(null).change();
        $('input[name="destinationCity"]').val(null).change();
        $('input[name="destinationCounty"]').val(null).change();
        $('input[name="destinationState"]').val(null).change();
        $('input[name="destinationZipCode"]').val(null).change();
        $('input[name="destinationCrossStreet"]').val(null).change();
        $('input[name="destinationSubdivision"]').val(null).change();
        $('input[name="destinationSocialSecurityNo"]').val(null).change();
        $('input[name="destinationBirthdate"]').val(null).change();
        $('input[name="destinationEmail"]').val(null).change();
        $('input[name="destinationPhone"]').val(null).change();
        $('input[name="destinationMobile"]').val(null).change();
    }

    $(document).on('click', '.profileData', function () {
        $('.profileData').css({'outline': '0px dashed green'});
        $(this).css({'outline': '1px dashed green'});
        // =======
        const logsCount = $(this).attr('data-logscount');
        const nameInitials = $(this).find('.entryDuplicateInitials').text();
        const name = $(this).find('.entryDuplicateName').text();
        const id = $(this).find('.entryDuplicateID').text();
        const email = $(this).find('.entryDuplicateEmail').text();
        $('.entryDestinationLogsCount').text(logsCount);
        $('.entryDestinationInitials').text(nameInitials);
        $('.entryDestinationName').text(name);
        $('.entryDestinationID').text(id);
        $('.entryDestinationEmail').text(email);
        $('input[name="destinationCustomerID"]').val(id.replace(/[#\s]/g, ''));
    });

    $(document).on('click', '.statusField', function () {
        $('.statusField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const status = $(this).find('span').text();
        if (status != "—") {
            $('select[name="destinationStatus"] option:contains("' + status + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.customerTypeField', function () {
        $('.customerTypeField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const customer_type = $(this).find('span').text();
        if (customer_type != "—") {
            $('select[name="destinationCustomerType"] option:contains("' + customer_type + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.businessNameField', function () {
        $('.businessNameField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const firstName = $(this).find('span').text();
        if (firstName != "—") {
            $('input[name="destinationBusinessName"]').val(firstName).change();
        }
    });

    $(document).on('click', '.customerGroupField', function () {
        $('.customerGroupField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const customer_group = $(this).find('span').text();
        if (customer_group != "—") {
            $('select[name="destinationCustomerGroup"] option:contains("' + customer_group + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.salesAreaField', function () {
        $('.salesAreaField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const sales_area = $(this).find('span').text();
        if (sales_area != "—") {
            $('select[name="destinationSalesArea"] option:contains("' + sales_area + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.firstNameField', function () {
        $('.firstNameField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const firstName = $(this).find('span').text();
        if (firstName != "—") {
            $('input[name="destinationFirstName"]').val(firstName).change();
        }
    });

    $(document).on('click', '.middleNameField', function () {
        $('.middleNameField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const middleName = $(this).find('span').text();
        if (middleName != "—") {
            $('input[name="destinationMiddleName"]').val(middleName).change();
        }
    });

    $(document).on('click', '.lastNameField', function () {
        $('.lastNameField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const lastName = $(this).find('span').text();
        if (lastName != "—") {
            $('input[name="destinationLastName"]').val(lastName).change();
        }
    });

    $(document).on('click', '.namePrefixField', function () {
        $('.namePrefixField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const prefix = $(this).find('span').text();
        if (prefix != "—") {
            $('select[name="destinationNamePrefix"] option:contains("' + prefix + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.suffixField', function () {
        $('.suffixField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const suffix = $(this).find('span').text();
        if (suffix != "—") {
            $('select[name="destinationNamePrefix"] option:contains("' + suffix + '")').prop('selected', true).change();
        }
    });

    $(document).on('click', '.countryField', function () {
        $('.countryField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const country = $(this).find('span').text();
        if (country != "—") {
            $('input[name="destinationCountry"]').val(country).change();
        }
    });

    $(document).on('click', '.addressField', function () {
        $('.addressField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const address = $(this).find('span').text();
        if (address != "—") {
            $('input[name="destinationAddress"]').val(address).change();
        }
    });

    $(document).on('click', '.cityField', function () {
        $('.cityField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const city = $(this).find('span').text();
        if (city != "—") {
            $('input[name="destinationCity"]').val(city).change();
        }
    });

    $(document).on('click', '.countyField', function () {
        $('.countyField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const county = $(this).find('span').text();
        if (county != "—") {
            $('input[name="destinationCounty"]').val(county).change();
        }
    });

    $(document).on('click', '.stateField', function () {
        $('.stateField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const state = $(this).find('span').text();
        if (state != "—") {
            $('input[name="destinationState"]').val(state).change();
        }
    });

    $(document).on('click', '.zipCodeField', function () {
        $('.zipCodeField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const zip = $(this).find('span').text();
        if (zip != "—") {
            $('input[name="destinationZipCode"]').val(zip).change();
        }
    });

    $(document).on('click', '.crossStreetField', function () {
        $('.crossStreetField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const crossStreet = $(this).find('span').text();
        if (crossStreet != "—") {
            $('input[name="destinationCrossStreet"]').val(crossStreet).change();
        }
    });

    $(document).on('click', '.subDivisionField', function () {
        $('.subDivisionField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const subdivision = $(this).find('span').text();
        if (subdivision != "—") {
            $('input[name="destinationSubdivision"]').val(subdivision).change();
        }
    });

    $(document).on('click', '.socialSecurityNoField', function () {
        $('.socialSecurityNoField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const socialSecurityNo = $(this).find('span').text();
        if (socialSecurityNo != "—") {
            $('input[name="destinationSocialSecurityNo"]').val(socialSecurityNo).change();
        }
    });

    $(document).on('click', '.birthDateField', function () {
        $('.birthDateField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const birthdate = $(this).find('span').text();
        if (birthdate != "—") {
            $('input[name="destinationBirthdate"]').val(birthdate).change();
        }
    });

    $(document).on('click', '.emailField', function () {
        $('.emailField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const email = $(this).find('span').text();
        if (email != "—") {
            $('input[name="destinationEmail"]').val(email).change();
        }
    });

    $(document).on('keyup change', 'input[name="destinationEmail"]', function () {
        const email = $(this).val();
        if (email != "—") {
            $('.entryDestinationEmail').text(email);
        }
    });

    $(document).on('click', '.phoneField', function () {
        $('.phoneField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const phone = $(this).find('span').text();
        if (phone != "—") {
            $('input[name="destinationPhone"]').val(phone).change();
        }
    });

    $(document).on('click', '.mobileField', function () {
        $('.mobileField').css({'color': 'black','font-weight': '500',}).find('.checkSize').css('display', 'none');
        $(this).css({'color': 'green','font-weight': 'bolder',}).find('.checkSize').css('display', 'block');
        // =======
        const mobile = $(this).find('span').text();
        if (mobile != "—") {
            $('input[name="destinationMobile"]').val(mobile).change();
        }
    });

    $('input[name="destinationSocialSecurityNo"]').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 6) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('input[name="destinationPhone"], input[name="destinationMobile"]').keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                 $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('select[name="destinationCustomerType"]').change(function (e) {
        const customerType = $(this).val();
        if (customerType == "Commercial" || customerType == "Business") {
            $('input[name="destinationBusinessName"]').attr('required', 'required').change();
        } else {
            $('input[name="destinationBusinessName"]').removeAttr('required').change();
        }
    });


    const URL_ORIGIN = window.origin;

    function loadDuplicateCustomerData(status) {
        if (status == "Initialize") {
            $.ajax({
                type: "POST",
                url: URL_ORIGIN + "/Customer/getDuplicateList/Commercial",
                success: function(response) {
                    $('#customerDuplicateTable > tbody').html(response);
                    window.customerDuplicateTable = $('#customerDuplicateTable').DataTable({
                        "ordering": false,
                        "pageLength": 25
                    });
                }
            });
            } else if (status == "Reload") {
                const currentPage = window.customerDuplicateTable.page();
                $.ajax({
                    type: "POST",
                    url: URL_ORIGIN + "/Customer/getDuplicateList/Commercial",
                    success: function(response) {
                        // Destroy the DataTable
                        window.customerDuplicateTable.clear().destroy();

                        // Reinitialize DataTable with previous configuration
                        $('#customerDuplicateTable > tbody').html(response);
                        window.customerDuplicateTable = $('#customerDuplicateTable').DataTable({
                            "ordering": false,
                            "pageLength": 25
                        });

                        // Set page to the stored index
                        window.customerDuplicateTable.page(currentPage).draw('page');
                    }
                });
            }
        } loadDuplicateCustomerData("Initialize");

    function viewEntry(entryID) {
        const left = (screen.width - 1280) / 2;
        const top = (screen.height - 720) / 2;
        window.open(URL_ORIGIN + "/customer/module/" + entryID, "Customer Dashboard", "width=" + 1280 + ", height=" + 720 + ", top=" + top + ", left=" + left);
    }

    function removeEntry(entryID, entryName, entryNumber) {
        Swal.fire({
            icon: "warning",
            title: "Remove Entry",
            html: "Are you sure you want to remove entry <strong>" + entryName + " #" + entryNumber + "</strong> ?",
            showCancelButton: true,
            confirmButtonText: "Remove",
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: URL_ORIGIN + "/Customer/ajax_delete_customer",
                data: "cid=" + entryID,
                success: function (response) {
                window.loadDuplicateCustomerData("Reload");
                Swal.fire({
                    title: "Removed Successfully!",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
                }
            });
            } 
        });
    }

    function mergeEntry(entryFName, entryLName, entryBusinessName, entryType) {
        resetOutputEntry()
        $('.dupWizardStep1').hide();
        $('.dupWizardStep2').show();

        $('.fetchingDataLoader').show();
        $('.mergeOutputEntryWidth').hide();
        $('.entryDuplicateData').hide();
        // loadingScreen
        $.ajax({
            type: "POST",
            url: URL_ORIGIN + "/Customer/getSpecificDuplicatesToMerge",
            data: {
                entryFName: entryFName,
                entryLName: entryLName,
                entryBusinessName: entryBusinessName,
                entryType: entryType
            },
            success: function(response) {
                $('.dupWizardStep2').show();
                $('.entryDuplicateData').remove();
                $('.fetchingDataLoader').hide();
                $('.mergeOutputEntryWidth').show();
                $('.entryDuplicateData').hide();
                $('.entryFields').after(response);
            }
        });
    }

    $(document).on('click', '.backToDuplicateList', function () {
        Swal.fire({
            icon: "warning",
            title: "Go back to Duplicate List",
            html: "Unsaved changes may disappear",
            showCancelButton: true,
            confirmButtonText: "Proceed, Go back to list",
        }).then((result) => {
            if (result.isConfirmed) {
                $('.dupWizardStep1').show();
                $('.dupWizardStep2').hide();
                $('.fetchingDataLoader').show();
                $('.mergeOutputEntryWidth').hide();
                $('.entryDuplicateData').hide();
            } 
        });

    });
    

    $(document).ready(function() {

        var CUSTOMER_LIST_TABLE = $('#customer-list').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            // "order": [],
            "ajax": {
                "url": "<?= base_url('customer/getCustomerLists'); ?>",
                "type": "POST"
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
            "columnDefs": [
                { 
                    "targets": [0],
                    "orderable": false,
                },
                // { 
                //     "targets": [14],
                //     "visible": false,
                //     "searchable": false,
                // }
            ]
        });

        $("#CUSTOMER_SEARCHBAR").keyup(function() {
            CUSTOMER_LIST_TABLE.search($(this).val()).draw()
        });

        $(document).on("click", ".call-item", function() {
            let phone = $(this).attr("data-id");

            window.open('tel:' + phone);
        });       

        $('#print-customer-list').on('click', function(){
            var profid = $(this).attr('data-id');
            var url = base_url + 'customer/_get_customer_lists';

            $('#print_customer_list_modal').modal('show');
            $("#print-customer-list-container").html('<span class="bx bx-loader bx-spin"></span> loading customer list...');

            setTimeout(function () {
            $.ajax({
                type: "POST",
                url: url,             
                data: {},
                success: function(o)
                {          
                    $("#print-customer-list-container").html(o);                
                }
            });
            }, 800);
        });

        $('#delete-customer').on('click', function(){
            
        });

        $(document).on('click', '.delete-customer', function(){
            var cid = $(this).attr('data-id');
            Swal.fire({            
                html: "Delete selected customer?",
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
                        data: {cid:cid},
                        dataType: 'json',
                        beforeSend: function(result) {
                            
                        },
                        success: function(result) {                                                                        
                            if(result.is_success  == 1){
                                Swal.fire({
                                    html: 'Customer record was deleted successfully',                        
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    CUSTOMER_LIST_TABLE.ajax.reload();  
                                });                                  
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: result.msg
                                });
                            }                               
                        },
                        complete : function(){
                            
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        });
    });   

    $(document).on('click', '#btn_print_customer_list', function(){
        $("#customer_table_print_ajax").printThis();
    });

    $(document).on('click', '.sms-messages', function(){

        var profid = $(this).attr('data-id');
        //var url = base_url + 'customer/_get_messages';
        var url = base_url + 'customer/_load_customer_sms_messages';

        $('#messages_modal').modal('show');
        $(".modal-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,             
             data: {profid:profid},
             success: function(o)
             {          
                $(".modal-messages-container").html(o);                
             }
          });
        }, 800);
    });

    $(document).on('click', '.send-email', function(){
        var customer_email = $(this).attr('data-email');
        var customer_eid   = $(this).attr('data-id');
        
        $('#send_email_modal').modal('show');
        $('#customer-email').val(customer_email);
        $('#customer-send-email-eid').val(customer_eid);
        $('#email-message').val('');
        $('#email-subject').val('');
    });    

    $(document).on('submit', '#frm-send-email', function(e){
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
            success: function(o)
            {          
                $("#btn_send_email").html('Send');
                if(o.is_success  == 1){
                    Swal.fire({
                        html: 'Email sent',                        
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                    $("#send_email_modal").modal('hide');                
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                    });
                }                
            },
            complete : function(){
                            
            },
            error: function(e) {
                console.log(e);
            }
        });

        $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
    });

    function loadTotalDupEntries() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("customer/getDuplicatedEntry"); ?>',
            success: function (response) {
                if (response == 0) {
                    $('.dupEntryCount').text('(' + response + ')');
                } else {
                    $('.dupEntryButton').removeClass('d-none');
                    $('.dupEntryCount').text('(' + response + ')');
                }
            }
        });
    } loadTotalDupEntries();

    
    $(document).on('submit', '#frm-send-message', function(e){
        e.preventDefault();

        var url = base_url + 'customer/_send_message';
        $(".btn-send-message").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-send-message")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
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
                }else{
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
</script>
<?php include viewPath('v2/includes/footer'); ?>