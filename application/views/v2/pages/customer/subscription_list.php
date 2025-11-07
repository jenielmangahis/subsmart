<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
    .display_none {
        display: none;
    }

    table.no-footer {
        border-bottom: 0px solid #dee2e6 !important;
    }

    table thead th,
    table thead td,
    table tbody td {
        padding: 6px !important;
    }

    table>thead>tr>th {
        border-bottom: 1px solid lightgray !important;
    }

    .activeCustomerTableContainer {
        max-height: 380px;
    }

    .activeCustomerStatusContainer {
        max-height: 200px;
    }

    .accordionButton {
        background: #f9f9f9;
    }

    thead {
        background: #f9f9f9;
    }

    .nsm-profile {
        width: 40px;
        height: 40px;
    }

    .activeCustomerStatusCategory {
        background: #00000008;
        border-radius: 5px;
        outline: 1px solid #0000000f;
        padding: 5px;
        margin-top: 10px;
        padding-left: 10px;
        cursor: pointer;
    }

    .nsm-callout {
        margin-bottom: unset;
    }

    .sticky-top {
        z-index: 1;
    }

    .customerNoLabel {
        font-size: smaller;
        color: darkgray;
    }

    .activeCustomerGroupSearch {
        width: 140px !important;
    }

    .collapse, .collapsing {
        transition: none !important;
    }

    .activeCustomerFilters {
        width: 450px;
    }

    .activeCustomerManageMode {
        background: #6a4a86;
        border: 1px solid #6a4a86;
    }
</style>


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
                            Displays customers with active subscriptions, including details of those currently enrolled in ongoing service plans.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3 activeCustomerBadgeLoader">
                        <div class="text-center">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 table-responsive activeCustomerStatusContainer"></div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="float-start activeCustomerFilters">
                            <div class="input-group">
                                <input type="text" class="form-control activeCustomerGroupSearch" placeholder="Search Customer">
                                <select class="form-select activeCustomerCategoryFilter">
                                    <option value="">None</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="float-end">
                            <button class="btn btn-primary fw-bold activeCustomerManageMode"><i class="fas fa-user-cog"></i>&ensp;Manage</button>
                            <button class="btn btn-danger fw-bold activeCustomerExitManageMode display_none"><i class="fas fa-sign-out-alt"></i>&ensp;Exit Manage Mode</button>
                        </div>
                    </div>

                    <script>
                        // $(document).on('click', '.activeCustomerManageMode', function () {
                        //     $('.activeCustomerManageMode').hide();
                        //     $('.activeCustomerExitManageMode').show();
                        // });

                        $(document).on('click', '.activeCustomerManageMode', function() {
                            const content = $('.activeCustomerBatchUpdaterContent').find('.batchUpdaterContent').length;

                            $('.activeCustomerManageMode, .activeCustomerListContent, .activeCustomerFilters').hide();
                            $('.activeCustomerListContent').html("");
                            $('.activeCustomerExitManageMode, .activeCustomerBatchUpdaterContent').show();

                            if (content == 0) {
                                $.ajax({
                                    type: "POST",
                                    // data: { statusFilter: 'active_only' }, 
                                    url: `${window.origin}/Customer/toolContent/batchUpdater`,
                                    success: function(response) {
                                        $('.activeCustomerBatchUpdaterContent').append(response);
                                        $('.customerUpdaterContentLoader, .batchUpdaterTitle, .modalExitButton').remove();
                                    },
                                });
                            }
                        });

                        $(document).on('click', '.activeCustomerExitManageMode', function () {
                            $('.activeCustomerManageMode, .activeCustomerListContent, .activeCustomerFilters').show();
                            $('.activeCustomerExitManageMode, .activeCustomerBatchUpdaterContent').hide();
                            getActiveCustomers();
                        });
                    </script>




                    <div class="col-lg-12">
                        <div class="col mt-3 activeCustomerLoader">
                            <div class="text-center">
                                <div class="spinner-border text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 activeCustomerListContent display_none"></div>
                    <div class="col-lg-12 activeCustomerBatchUpdaterContent display_none">
                        <span class="customerUpdaterContentLoader">Please wait while fetching the tool content...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade activeCustomerManageModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Manage Customer</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form class="activeCustomerManageForm">
                    <div class="row">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-xnormal">Bill End</label>
                            <input type="date" class="form-control" name="bill_end" required>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label class="form-label fw-xnormal">Security Package</label>
                            <select class="form-select" name="" required>

                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label fw-xnormal">Panel Type</label>
                            <select class="form-select" name="" required>

                            </select>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-xnormal">MMR</label>
                            <input type="number" class="form-control" name="bill_end" step="any" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-xnormal">GMR</label>
                            <input type="number" class="form-control" name="bill_end" step="any" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-xnormal">Pass Thru Cost</label>
                            <input type="number" class="form-control" name="bill_end" step="any" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label fw-xnormal">Account Cost</label>
                            <input type="number" class="form-control" name="bill_end" step="any" required>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary fw-bold float-end checkEditSubmitButton"><i class="fas fa-file-import"></i>&ensp;Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <th class="text-nowrap">Bill End</th> -->
<!-- <th class="text-nowrap">Security Package</th> -->
<!-- <th class="text-nowrap">Panel Type</th> -->
<!-- <th class="text-nowrap">MMR</th> -->
<!-- <th class="text-nowrap">GMR</th> -->
<!-- <th class="text-nowrap">Pass Thru Cost</th> -->
<!-- <th class="text-nowrap">Account Cost</th> -->










<!-- <div class="row g-3 mb-3">
    <div class="col-12 col-md-12">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="col-12 col-md-9 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="total_this_year"><?= $activeSubscriptions->total_records; ?></h2>
                            <span>TOTAL ACTIVE SUBSCRIPTIONS</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="col-12 col-md-9 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="total_this_year"><?= $completedSubscriptions->total_records; ?></h2>
                            <span>TOTAL ENDED SUBSCRIPTIONS</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="nsm-counter secondary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2 id="total_this_year">$<?= number_format($activeSubscriptions->total_amount_subscriptions,2,'.',','); ?></h2>
                            <span>TOTAL AMOUNT ACTIVE SUBSCRIPTIONS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-12 grid-mb text-end">
        <div class="dropdown d-inline-block">
            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                Sort by Status: <span id="dropdown_active">All</span> <i class='bx bx-fw bx-chevron-down'></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end select-filter">
                <li><a class="dropdown-item" href="javascript:void(0);" id="status_all">All</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" id="status_active">Active</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" id="status_completed">Completed</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="subscription_container"></div>
</div> -->

<script type="text/javascript">
    function getActiveCustomers() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/Customer/getActiveCustomerListByFilter`,
            data: {
                status: "active",
                type: "all",
            },
            beforeSend: function() {
                $('.activeCustomerListContent').hide();
                $('.activeCustomerLoader').show();
            },
            success: function(response) {
                const data = JSON.parse(response);
                let html = "";
                let loopCount = 0;

                if (data.length != 0) {
                    const grouped = {};
                    data.forEach((cust) => {
                        let firstChar = cust.name.charAt(0).toUpperCase();
                        if (!/^[A-Z]$/.test(firstChar)) firstChar = "#";
                        if (!grouped[firstChar]) grouped[firstChar] = [];
                        grouped[firstChar].push(cust);
                    });

                    const sortedKeys = Object.keys(grouped).sort((a, b) => {
                        if (a === "#") return 1;
                        if (b === "#") return -1;
                        return a.localeCompare(b);
                    });

                    sortedKeys.forEach((key) => {
                        loopCount += 1;
                        const group = grouped[key].sort((a, b) => {
                            const monitorA = parseInt(a.monitor_id) || 0;
                            const monitorB = parseInt(b.monitor_id) || 0;

                            if (monitorA !== monitorB) {
                                return monitorA - monitorB;
                            }

                            return a.name.localeCompare(b.name);
                        });
                        const collapseId = `group${loopCount}Collapse`;

                        let rows = group.map(cust => {
                            const is_verified = (cust.is_verified == 1) ? "checked" : "";
                            const customer_no = cust.customer_no ? cust.customer_no : "Not Specified";
                            const customer_group = cust.customer_group ? cust.customer_group : "Not Specified";
                            const name = cust.name ? cust.name : "Not Specified";
                            const initials = name && name !== "Not Specified"
                                ? name
                                    .split(" ")
                                    .filter(w => w.trim() !== "")
                                    .map(w => w[0].toUpperCase())
                                    .slice(0, 2)
                                    .join("")
                                : "N/A";
                            const type = cust.type ? cust.type : "Not Specified";
                            const status = cust.status ? cust.status : "Not Specified";
                            const address = cust.address ? cust.address : "Not Specified";
                            const email = cust.email ? cust.email : "no@email.com";
                            const bill_start = cust.bill_start ? new Date(cust.bill_start).toLocaleDateString("en-US", { month: "2-digit", day: "2-digit", year: "numeric" }) : "Not Specified";
                            const bill_end = cust.bill_end ? new Date(cust.bill_end).toLocaleDateString("en-US", { month: "2-digit", day: "2-digit", year: "numeric" }) : "Not Specified";
                            const bill_mmr = cust.bill_mmr ? Number(cust.bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" }) : Number(cust.alarm_bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" });
                            const monitor_id = cust.monitor_id ? cust.monitor_id : "—";
                            const payment_method = cust.payment_method ? cust.payment_method : "—";
                            const service_package = cust.service_package ? cust.service_package : "—";
                            const panel_type = cust.panel_type ? cust.panel_type : "—";
                            const alarm_bill_mmr = cust.alarm_bill_mmr ? Number(cust.alarm_bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" }) : Number(cust.alarm_bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" });
                            const pass_thru_cost = cust.pass_thru_cost ? Number(cust.pass_thru_cost).toLocaleString("en-US", { style: "currency", currency: "USD" }) : Number(cust.pass_thru_cost).toLocaleString("en-US", { style: "currency", currency: "USD" });
                            const account_cost = cust.account_cost ? Number(cust.account_cost).toLocaleString("en-US", { style: "currency", currency: "USD" }) : Number(cust.account_cost).toLocaleString("en-US", { style: "currency", currency: "USD" });
                            const net_profit = (parseFloat(cust.alarm_bill_mmr) || 0)
                                             - (parseFloat(cust.account_cost) || 0)
                                             - (parseFloat(cust.pass_thru_cost) || 0);
                            const net_profit_formatted = Number(net_profit).toLocaleString("en-US", { style: "currency", currency: "USD" });


                            return `
                                <tr>
                                    <td class="text-nowrap"><input class="form-check-input verifyActiveCustomer" style="width: 16px; height: 16px;" customer_id="${cust.id}" type="checkbox" ${is_verified}></td>
                                    <td class="text-nowrap">
                                        <div class="d-flex cursor-pointer" onclick="window.location.href = '${window.origin}/customer/module/${cust.id}'">
                                            <div class="nsm-profile">
                                            <span>${initials}</span>
                                        </div>
                                        <div>
                                            <span class="mx-2">${name}&ensp;<small class="customerNoLabel">${customer_no}</small></span>
                                            <br>
                                            <small class="mx-2 text-muted">${email}</small>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">${monitor_id}</td>
                                    <td class="text-nowrap">${type}</td>
                                    <td class="text-nowrap">${status}</td>
                                    <td class="text-nowrap">${address}</td>
                                    <td class="text-nowrap">${payment_method}</td>
                                    <td class="text-nowrap">${bill_start}</td>
                                    <td class="text-nowrap">${bill_end}</td>
                                    <td class="text-nowrap">${service_package}</td>
                                    <td class="text-nowrap">${panel_type}</td>
                                    <td class="text-nowrap">${bill_mmr}</td>
                                    <td class="text-nowrap">${alarm_bill_mmr}</td>
                                    <td class="text-nowrap">${pass_thru_cost}</td>
                                    <td class="text-nowrap">${account_cost}</td>
                                    <td class="text-nowrap">${net_profit_formatted}</td>
                                    <td style="width: 0;" class="p-0">
                                        <div class='dropdown'>
                                            <button class='btn dropdown-toggle text-muted' type='button' id='activeCustomerButtonDropdown' data-bs-toggle='dropdown' aria-expanded='false'><i class='fas fa-ellipsis-v'></i></button>
                                            <ul class='dropdown-menu' aria-labelledby='activeCustomerButtonDropdown'>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/subscription/${cust.id}">View</a></li>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/add_advance/${cust.id}">Edit</a></li>
                                                <li class="d-none"><a class="dropdown-item activeCustomerManage" href="javascript:void(0);" customer_id="${cust.id}">Manage</a></li>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/module/${cust.id}">Dashboard</a></li>
                                                <li><a class="dropdown-item view-payment-item" href="javascript:void(0);" data-customer-id="${cust.id}" data-billing-id="">Payment History</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="d-none">${customer_group}</td>
                                </tr>   
                            `;
                        }).join("");

                        html += `
                            <div class="activeCustomerGroupAccordion border rounded mb-2">
                                <button class="btn w-100 text-start accordionButton text-muted" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                                    <strong>${key}&ensp;<span class="group${loopCount}Count">(${group.length})</span></strong>
                                </button>
                                <div class="collapse show" id="${collapseId}">
                                    <div class="border-top position-relative">
                                        <div class="table-responsive activeCustomerTableContainer">
                                            <table class="table table-bordered table-hover mb-0 align-middle">
                                                <thead class="sticky-top">
                                                    <tr>
                                                        <th class="text-nowrap"><i class="fas fa-user-check text-success"></i></th>
                                                        <th class="text-nowrap">Name</th>
                                                        <th class="text-nowrap">Monitoring ID</th>
                                                        <th class="text-nowrap">Type</th>
                                                        <th class="text-nowrap">Status</th>
                                                        <th class="text-nowrap">Address</th>
                                                        <th class="text-nowrap">Payment Method</th>
                                                        <th class="text-nowrap">Bill Start</th>
                                                        <th class="text-nowrap">Bill End</th>
                                                        <th class="text-nowrap">Security Package</th>
                                                        <th class="text-nowrap">Panel Type</th>
                                                        <th class="text-nowrap">MMR</th>
                                                        <th class="text-nowrap">GMR</th>
                                                        <th class="text-nowrap">Pass Thru Cost</th>
                                                        <th class="text-nowrap">Account Cost</th>
                                                        <th class="text-nowrap">Net Profit</th>
                                                        <th class="text-nowrap" class="w-0"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ${rows}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                } else {
                    html += `
                            <div class="activeCustomerGroupAccordion border rounded mb-2">
                                <button class="btn w-100 text-start accordionButton text-muted" type="button">
                                    <span>No Customers Found</span>
                                </button>
                                <div class="collapse"></div>
                            </div>
                        `;
                }

                $(".activeCustomerListContent").html(html);
                setTimeout(() => {
                    $('.activeCustomerListContent').show();
                    $('.activeCustomerLoader').hide(); 
                }, 500);
            },
            error: function() {
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

    function getStatusBadge() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/dashboard/thumbnailWidgetRequest`,
            data: {
                category: "customer_status",
                dateFrom: "1970-01-01",
                dateTo: "<?php echo date('Y-m-d'); ?>",
                filter3: "active_only",
            },
            beforeSend: function() {
                $('.activeCustomerStatusContainer').hide();
                $('.activeCustomerBadgeLoader').show();
            },
            success: function(response) {
                const data = JSON.parse(response);
                let html = "";

                const colorMap = {
                    active: { bg: "#00ff0010", border: "#00ff0020" },
                    inactive: { bg: "#80808010", border: "#80808020" },
                    cancelled: { bg: "#ff000014", border: "#ff000020" },
                    collection: { bg: "#ffa50010", border: "#ffa50020" },
                    funded: { bg: "#0080ff10", border: "#0080ff20" },
                    lead: { bg: "#9932cc10", border: "#9932cc20" },
                    new: { bg: "#00ced110", border: "#00ced120" },
                    proposal: { bg: "#ff69b410", border: "#ff69b420" },
                    default: { bg: "#0000000a", border: "#0000000f" },
                };

                if (data.length != 0) {
                    Object.entries(data).forEach(([key, value]) => {
                        const lowerKey = key.toLowerCase();

                        let matchedColor = colorMap.default;
                        for (const keyword in colorMap) {
                            if (lowerKey.includes(keyword)) {
                                matchedColor = colorMap[keyword];
                                break;
                            }
                        }

                        html += `
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center">
                                <div class="activeCustomerStatusCategory" style="background:${matchedColor.bg}; border:1px solid ${matchedColor.border};">
                                    <small class="text-uppercase activeCustomerStatusName">${key}</small>
                                    <h5 class="activeCusomterStatusCount">${value}</h5>
                                </div>
                            </div>
                        `;

                        $('.activeCustomerCategoryFilter').append(`<option value="${key}">${key}</option>`);
                    });
                } else {
                    html += `
                            <div class="col-lg-1">
                                <div class="activeCustomerStatusCategory">
                                    <small class="text-uppercase activeCustomerStatusName">No Status Found</small>
                                    <h5 class="activeCusomterStatusCount">0</h5>
                                </div>
                            </div>
                        `;
                }

                $('.activeCustomerStatusContainer').html(html);
                setTimeout(() => {
                    $('.activeCustomerStatusContainer').show();
                    $('.activeCustomerBadgeLoader').hide();
                }, 500);
            },
            error: function() {
                $('.activeCustomerStatusContainer').show();
                $('.activeCustomerBadgeLoader').hide();
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

    function getCustomerGroupBadge() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/dashboard/thumbnailWidgetRequest`,
            data: {
                category: "customer_groups",
                dateFrom: "1970-01-01",
                dateTo: "<?php echo date('Y-m-d'); ?>",
                filter3: "active_only",
                // filter4: "commercial",
            },
            beforeSend: function() { },
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
                        if (key == "Alarm.com" || key == "AlarmNet") {
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
                                    <div class="activeCustomerStatusCategory" style="background:${matchedColor.bg}; border:1px solid ${matchedColor.border};">
                                        <small class="text-uppercase activeCustomerStatusName">${key}</small>
                                        <h5 class="activeCustomerStatusCount">${value}</h5>
                                    </div>
                                </div>
                            `;

                            $('.activeCustomerCategoryFilter').append(`<option value="${key}">${key}</option>`);
                        }
                    });
                } else {
                    html += `
                        <div class="col-lg-1">
                            <div class="activeCustomerStatusCategory">
                                <small class="text-uppercase activeCustomerStatusName">No Status Found</small>
                                <h5 class="activeCustomerStatusCount">0</h5>
                            </div>
                        </div>
                    `;
                }

                setTimeout(() => {
                    $('.activeCustomerStatusContainer').append(html);
                }, 500);
            },
            error: function() {
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

    $(document).on('input change', '.activeCustomerGroupSearch, .activeCustomerCategoryFilter', function () {
        const searchQuery = $('.activeCustomerGroupSearch').val().trim().toLowerCase();
        const selectedCategory = $('.activeCustomerCategoryFilter').val();

        if (!searchQuery && !selectedCategory) {
            $('.activeCustomerGroupAccordion').show();
            $('.activeCustomerGroupAccordion tbody tr').show();
            return;
        }

        $('.activeCustomerGroupAccordion').each(function () {
            const accordion = $(this);
            const rows = accordion.find('tbody tr');
            let hasMatch = false;

            rows.each(function () {
                const rowText = $(this).text().toLowerCase();
                const matchText = !searchQuery || rowText.includes(searchQuery);
                const matchCategory = !selectedCategory || rowText.includes(selectedCategory.toLowerCase());
                const match = matchText && matchCategory;

                $(this).toggle(match);
                if (match) hasMatch = true;
            });

            accordion.toggle(hasMatch);
        });
    });

    $(document).on('click', '.activeCustomerStatusCategory', function () {
        const value = $(this).find('.activeCustomerStatusName').text();
        $('.activeCustomerCategoryFilter').val(value).change();
    });

    $(function () {
        getActiveCustomers();
        getStatusBadge();
        getCustomerGroupBadge()
    });

    $(document).on('change', '.verifyActiveCustomer', function () {
        const state = $(this).prop('checked');
        const customer_id = $(this).attr('customer_id');

        $.ajax({
            type: "POST",
            url: `${window.origin}/Customer/verifyCustomer`,
            data: {
                customer_id: `${customer_id}`,
                state: `${state}`
            },
            beforeSend: function() {},
            success: function(response) {
                // const data = JSON.parse(response)[0];
            },
            error: function() {}
        });
    });

    $(document).on('click', '.activeCustomerManage', function () {
        $('.activeCustomerManageModal').modal('show');
    });

    // $(document).on('click', '.dropdown-menu', function (e) {
    //     e.stopPropagation();
    // });


    // $(document).ready(function() {
    //     showSubscriptions('all');

    //     $("#status_all").on("click", function() {
    //         showSubscriptions('all');

    //         $("#dropdown_active").text("Active");
    //     });

    //     $("#status_active").on("click", function() {
    //         showSubscriptions('active');

    //         $("#dropdown_active").text("Active");
    //     });

    //     $("#status_completed").on("click", function() {
    //         showSubscriptions("completed");

    //         $("#dropdown_active").text("Completed");
    //     });

    //     $("#status_biller").on("click", function() {
    //         showSubscriptions("biller_errors");

    //         $("#dropdown_active").text("Biller Errors");
    //     });

    //     $(document).on("click", ".view-payment-item", function() {
    //         let customer_id = $(this).attr("data-customer-id");
    //         let billing_id = $(this).attr("data-billing-id");
    //         let url = "<?php echo base_url(); ?>customer/_load_subscription_payment_history";
    //         showLoader($("#payment_history_container"));
    //         $("#payment_history_modal").modal('show');

    //         $.ajax({
    //             type: 'POST',
    //             url: url,
    //             data: {
    //                 customer_id: customer_id,
    //                 billing_id: billing_id
    //             },
    //             success: function(result) {
    //                 $("#payment_history_container").html(result);
    //             },
    //         });
    //     });

    //     $(document).on("click", ".fix-item", function() {
    //         let billing_id = $(this).attr("data-id");
    //         let url = "<?php echo base_url(); ?>customer/_load_billing_credit_card_details";

    //         $("#bid").val(billing_id);
    //         showLoader($("#card_details"));
    //         $("#edit_cc_modal").modal('show');

    //         $.ajax({
    //             type: 'POST',
    //             url: url,
    //             data: {
    //                 billing_id: billing_id
    //             },
    //             success: function(result) {
    //                 $("#card_details").html(result);
    //             },
    //         });
    //     });

    //     $("#update_cc_form").on("submit", function(e) {
    //         let _this = $(this);
    //         e.preventDefault();

    //         var url = "<?php echo base_url(); ?>customer/_update_billing_credit_card_details";
    //         _this.find("button[type=submit]").html("Updating");
    //         _this.find("button[type=submit]").prop("disabled", true);

    //         $.ajax({
    //             type: 'POST',
    //             url: url,
    //             dataType: "json",
    //             data: $("#update_cc_form").serialize(),
    //             success: function(result) {
    //                 if(result.is_success == 1){
    //                     $("#edit_cc_modal").modal('show');
                        
    //                     Swal.fire({
    //                         title: 'Update Successful!',
    //                         text: "Your billing credit card info was successfully updated.",
    //                         icon: 'success',
    //                         showCancelButton: false,
    //                         confirmButtonText: 'Okay'
    //                     }).then((result) => {
    //                         if (result.value) {
    //                             showSubscriptions("biller_errors");
    //                         }
    //                     });
    //                 }
    //                 else{
    //                     Swal.fire({
    //                         title: 'Cannot update billing',
    //                         text: result.msg,
    //                         icon: 'error',
    //                         showCancelButton: false,
    //                         confirmButtonText: 'Okay'
    //                     });
    //                 }
                    
    //                 _this.find("button[type=submit]").html("Update");
    //                 _this.find("button[type=submit]").prop("disabled", false);
    //             },
    //         });
    //     });
    // });

    // function showSubscriptions(status = "active") {
    //     switch (status) {
    //         case "completed":
    //             url = "<?php echo base_url(); ?>customer/_load_completed_subscriptions";
    //             break;
    //         case "biller_errors":
    //             url = "<?php echo base_url(); ?>customer/_load_billing_error_subscriptions";
    //             break;
    //             case "active":
    //             url = "<?php echo base_url(); ?>customer/_load_active_subscriptions";
    //             break;
    //         default:
    //             url = "<?php echo base_url(); ?>customer/_load_all_subscriptions";
    //     }

    //     showLoader($("#subscription_container"));
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         success: function(result) {
    //             $("#subscription_container").html(result);
    //             $(".nsm-table").nsmPagination();
    //         },
    //     });
    // }
</script>
<?php include viewPath('v2/includes/footer'); ?>