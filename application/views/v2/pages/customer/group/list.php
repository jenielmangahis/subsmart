<?php include viewPath('v2/includes/header'); ?>
<style>
    .customerGroupContainer {
        max-height: 200px;
    }

    .customerGroupStatusCategory {
        background: #00000008;
        border-radius: 5px;
        outline: 1px solid #0000000f;
        padding: 5px;
        margin-top: 10px;
        padding-left: 10px;
    }

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

    .customerGroupTableContainer {
        height: 380px;
    }

    .newGroupButton {
        background: #6a4a86;
        border: 1px solid #6a4a86;
    }
    
    .customerGroupDropdownOption {
        position: absolute;
        top: 0px;
        right: 0px;
    }
</style>


<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/group_add') ?>'">
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
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Displays groups of customers organized by shared characteristics, such as retail, wholesale, or employee classifications.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <input type="text" class="form-control customerGroupSearch" placeholder="Search Customer">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <button id="btn-create-customer-group" class="btn btn-primary fw-bold newGroupButton float-end"><i class="fas fa-plus"></i>&ensp;New Group</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col mt-3 customerGroupLoader">
                            <div class="text-center">
                                <div class="spinner-border text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 customerGroupListContent display_none"></div>
                </div>





















                <!-- <div class="row">

                    <div class="col-6 grid-mb">
                        <form action="<?php echo base_url('customer/group') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>   
                    </div>                  
                    <?php if( checkRoleCanAccessModule('customer-groups', 'write') ){ ?>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-create-customer-group">
                                <i class='bx bx-fw bx-group'></i> Add New
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Title">Title</td>
                            <td data-name="Description">Description</td>
                            <td data-name="Count" style="width:10%;">Number of Customer</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customerGroups)) : ?>
                            <?php foreach ($customerGroups as $customerGroup) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-chart'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $customerGroup->title ?></td>
                                    <td><?= $customerGroup->description; ?></td>
                                    <td style="text-align:center;"><?= countCustomerByGroup($customerGroup->id); ?></td>
                                    <td>
                                        <?php if( checkRoleCanAccessModule('customer-groups', 'write') || checkRoleCanAccessModule('customer-groups', 'delete') ){ ?>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if( checkRoleCanAccessModule('customer-groups', 'write') ){ ?>
                                                        <li><a class="dropdown-item edit-item" data-id="<?= $customerGroup->id; ?>" data-name="<?= $customerGroup->title; ?>" data-description="<?= $customerGroup->description; ?>" href="javascript:void(0);">Edit</a></li>
                                                    <?php } ?>
                                                    <?php if( checkRoleCanAccessModule('customer-groups', 'delete') ){ ?>
                                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-name="<?= $customerGroup->title; ?>" data-id="<?= $customerGroup->id; ?>">Delete</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table> -->
            </div>
            
            <!-- Create Customer Group -->
            <div class="modal fade nsm-modal fade" id="modal-create-customer-group" tabindex="-1" aria-labelledby="modal-create-customer-group_label" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <form id="frm-create-customer-group" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Add New</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                        <input type="text" name="group_name" id="group-name" class="nsm-field form-control" value="" placeholder="" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                                        <textarea name="group_description" id="group-description" class="form-control"></textarea>                                        
                                    </div>
                                </div>
                            </div> 
                            </div>
                            <div class="modal-footer">                    
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-save-customer-group">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Customer Group -->
            <div class="modal fade nsm-modal fade" id="modal-edit-customer-group" tabindex="-1" aria-labelledby="modal-edit-customer-group_label" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <form id="frm-update-customer-group" method="POST">
                        <input type="hidden" name="gid" id="gid" value="" />
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Edit</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                        <input type="text" name="group_name" id="edit-group-name" class="nsm-field form-control" value="" placeholder="" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                                        <textarea name="group_description" id="edit-group-description" class="form-control"></textarea>                                        
                                    </div>
                                </div>
                            </div> 
                            </div>
                            <div class="modal-footer">                    
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-update-customer-group">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function getCommercialCustomers() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/Customer/getActiveCustomerListByFilter`,
            data: {
                status: "all",
                type: "all",
            },
            beforeSend: function() {
                $('.customerGroupListContent').hide();
                $('.customerGroupLoader').fadeIn('fast');
            },
            success: function(response) {
                const data = JSON.parse(response);
                let html = "";

                if (data.length != 0) {
                    const grouped = {};
                    let loopCount = 0;

                    data.forEach((cust) => {
                        let groupName = cust.customer_group ? cust.customer_group.trim() : "Unassigned";
                        if (groupName === "") groupName = "Unassigned";

                        const groupId = cust.customer_group_id ? cust.customer_group_id : 0;

                        if (!grouped[groupName]) {
                            grouped[groupName] = {
                                id: groupId,
                                customers: []
                            };
                        }

                        grouped[groupName].customers.push(cust);
                    });

                    const sortedKeys = Object.keys(grouped).sort((a, b) => a.localeCompare(b));

                    sortedKeys.forEach((key) => {
                        loopCount += 1;
                        const groupId = grouped[key].id;
                        const group = grouped[key].customers.sort((a, b) => a.name.localeCompare(b.name));
                        const collapseId = `group${loopCount}Collapse`;

                        let rows = group.map(cust => {
                            const customer_no = cust.customer_no ? cust.customer_no : "Not Specified";
                            const name = cust.name ? cust.name : "Not Specified";
                            const initials = name && name !== "Not Specified"
                                ? name
                                    .split(" ")
                                    .filter(w => w.trim() !== "")
                                    .map(w => w[0].toUpperCase())
                                    .slice(0, 2)
                                    .join("")
                                : "N/A";
                            const email = cust.email ? cust.email : "no@email.com";
                            const address = cust.address ? cust.address : "Not Specified";
                            const source = cust.source ? cust.source : "Not Specified";
                            const sales_rep = cust.sales_rep_name ? cust.sales_rep_name : "Not Specified";
                            const tech_rep = cust.tech_rep_name ? cust.tech_rep_name : "Not Specified";
                            const package = cust.service_package ? cust.service_package : "Not Specified";
                            const bill_mmr = cust.bill_mmr ? Number(cust.bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" }) : "$0.00";
                            const phone_m = cust.phone_m ? cust.phone_m : "Not Specified";
                            const status = cust.status ? cust.status : "Not Specified";

                            return `
                                <tr>
                                    <td class="text-nowrap">
                                        <div class="d-flex">
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
                                    <td class="text-nowrap">${address}</td>
                                    <td class="text-nowrap">${source}</td>
                                    <td class="text-nowrap">${sales_rep}</td>
                                    <td class="text-nowrap">${tech_rep}</td>
                                    <td class="text-nowrap">${package}</td>
                                    <td class="text-nowrap">${bill_mmr}</td>
                                    <td class="text-nowrap">${phone_m}</td>
                                    <td class="text-nowrap">${status}</td>
                                    <td style="width: 0;" class="p-0">
                                        <div class='dropdown'>
                                            <button class='btn dropdown-toggle text-muted' type='button' id='customerGroupButtonDropdown' data-bs-toggle='dropdown' aria-expanded='false'><i class='fas fa-ellipsis-v'></i></button>
                                            <ul class='dropdown-menu' aria-labelledby='customerGroupButtonDropdown'>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/module/${cust.id}">Dashboard</a></li>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/preview_/${cust.id}">View</a></li>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/add_advance/${cust.id}">Edit</a></li>
                                                <li><a class="dropdown-item" href="${window.origin}/job/new_job1?cus_id=${cust.id}">Schedule</a></li>
                                                <li><a class="dropdown-item favorite-customer" href="javascript:void(0);" data-favorite="0" data-name="${name}" data-id="${cust.id}">Add to Favorites</a></li>
                                                <li><a class="dropdown-item delete-customer" href="javascript:void(0);" data-name="${name}" data-id="${cust.id}" >Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>   
                            `;
                        }).join("");

                        html += `
                            <div class="customerGroupAccordion border rounded mb-2 position-relative">
                                <button class="btn w-100 text-start accordionButton text-muted" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                                    <strong>${key}&ensp;<span class="group${loopCount}Count">(${group.length})</span></strong>
                                </button>
                                <div class='dropdown position-absolute customerGroupDropdownOption'>
                                    <button class='btn dropdown-toggle text-muted' type='button' id='customerGroupButtonDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fas fa-ellipsis-v'></i>
                                    </button>
                                    <ul class='dropdown-menu' aria-labelledby='customerGroupButtonDropdown'>
                                        <li><a class="dropdown-item edit-item" href="javascript:void(0);" data-name="${key}" data-description="" data-id="${groupId}">Edit</a></li>
                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-name="${key}" data-id="${groupId}">Delete</a></li>
                                    </ul>
                                </div>
                                <div class="collapse" id="${collapseId}">
                                    <div class="border-top position-relative">
                                        <div class="table-responsive customerGroupTableContainer">
                                            <table class="table table-bordered table-hover mb-0 align-middle">
                                                <thead class="sticky-top">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Source</th>
                                                        <th>Sales Rep</th>
                                                        <th>Tech</th>
                                                        <th>Package</th>
                                                        <th>MMR</th>
                                                        <th>Phone No.</th>
                                                        <th>Status</th>
                                                        <th class="w-0"></th>
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
                        <div class="customerGroupAccordion border rounded mb-2">
                            <button class="btn w-100 text-start accordionButton text-muted" type="button">
                                <span>No Customers Found</span>
                            </button>
                            <div class="collapse"></div>
                        </div>
                    `;
                }

                $(".customerGroupListContent").html(html);
                setTimeout(() => {
                    $('.customerGroupListContent').fadeIn('fast');
                    $('.customerGroupLoader').hide(); 
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

    // function getCustomerGroupBadge() {
    //     $.ajax({
    //         type: "POST",
    //         url: `${window.origin}/dashboard/thumbnailWidgetRequest`,
    //         data: {
    //             category: "customer_groups",
    //             dateFrom: "1970-01-01",
    //             dateTo: "<?php echo date('Y-m-d'); ?>",
    //             filter3: "all_status",
    //         },
    //         beforeSend: function() {
    //             $('.customerGroupContainer').hide();
    //             $('.customerGroupBadgeLoader').fadeIn('fast');
    //         },
    //         success: function(response) {
    //             const data = JSON.parse(response).GRAPH;
    //             console.log(data);
    //             let html = "";

    //             const colorMap = {
    //                 "ADT Solar Pro": { bg: "#FFD70010", border: "#FFD70020" },
    //                 "Alarm.com": { bg: "#FFCC0010", border: "#FFCC0020" },
    //                 "Alarm.com & DVR": { bg: "#FFC00010", border: "#FFC00020" },
    //                 "AlarmNet": { bg: "#007BFF10", border: "#007BFF20" }, 
    //                 "AlarmNet & PERS": { bg: "#3399FF10", border: "#3399FF20" },
    //                 "DVR": { bg: "#8A2BE210", border: "#8A2BE220" },
    //                 "Landline": { bg: "#80808010", border: "#80808020" },
    //                 "Landline & Pers": { bg: "#A9A9A910", border: "#A9A9A920" },
    //                 "Pers": { bg: "#32CD3210", border: "#32CD3220" },
                    
    //                 "Commercial": { bg: "#00CED110", border: "#00CED120" },
    //                 "Residential": { bg: "#FF69B410", border: "#FF69B420" },
    //                 "Enterprise": { bg: "#9932CC10", border: "#9932CC20" }, 
    //                 "Unknown": { bg: "#0000000a", border: "#0000000f" },
    //             };


    //             if (data.length != 0) {
    //                 Object.entries(data).forEach(([key, value]) => {
    //                     const lowerKey = key.toLowerCase();
    //                     let matchedColor = colorMap["Unknown"];

    //                     for (const groupName in colorMap) {
    //                         if (lowerKey.includes(groupName.toLowerCase())) {
    //                             matchedColor = colorMap[groupName];
    //                             break;
    //                         }
    //                     }

    //                     html += `
    //                         <div class="col-lg-1">
    //                             <div class="customerGroupStatusCategory" style="background:${matchedColor.bg}; border:1px solid ${matchedColor.border};">
    //                                 <small class="text-uppercase customerGroupStatusName">${key}</small>
    //                                 <h5 class="customerGroupStatusCount">${value}</h5>
    //                             </div>
    //                         </div>
    //                     `;
    //                 });
    //             } else {
    //                 html += `
    //                     <div class="col-lg-1">
    //                         <div class="customerGroupStatusCategory">
    //                             <small class="text-uppercase customerGroupStatusName">No Status Found</small>
    //                             <h5 class="customerGroupStatusCount">0</h5>
    //                         </div>
    //                     </div>
    //                 `;
    //             }

    //             $('.customerGroupContainer').html(html);
    //             $('.customerGroupContainer').fadeIn('fast');
    //             $('.customerGroupBadgeLoader').hide();
    //         },
    //         error: function() {
    //             $('.customerGroupContainer').fadeIn('fast');
    //             $('.customerGroupBadgeLoader').hide();
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Network Error!",
    //                 html: "An unexpected error occurred. Please try again!",
    //                 showConfirmButton: true,
    //                 confirmButtonText: "Okay",
    //             });
    //         },
    //     });
    // }

    $('.customerGroupSearch').on('input', function () {
        const query = $(this).val().trim().toLowerCase();

        if (!query) {
            $('.customerGroupAccordion').fadeIn('fast');
            $('.customerGroupAccordion tbody tr').fadeIn('fast');
            return;
        }

        $('.customerGroupAccordion').each(function () {
            const accordion = $(this);
            const rows = accordion.find('tbody tr');
            let hasMatch = false;

            rows.each(function () {
                const rowText = $(this).text().toLowerCase();
                const match = rowText.includes(query);

                $(this).toggle(match);
                if (match) hasMatch = true;
            });

            accordion.toggle(hasMatch);
        });
    });

    $(function () {
        getCommercialCustomers();
        // getCustomerGroupBadge();
    });







































    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $('#btn-create-customer-group').on('click', function(){
            $('#modal-create-customer-group').modal('show');
        });

        $(document).on('click', '.edit-item', function(){
            var gid = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var description = $(this).attr('data-description');

            $('#gid').val(gid);
            $('#edit-group-name').val(name);
            $('#edit-group-description').val(description);

            $('#modal-edit-customer-group').modal('show');
        });

        $('#frm-create-customer-group').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer/_create_customer_group",
                dataType: 'json',
                data: $('#frm-create-customer-group').serialize(),
                success: function(data) {    
                    $('#btn-save-customer-group').html('Save');                   
                    if (data.is_success) {
                        $('#modal-create-customer-group').modal('hide');
                        Swal.fire({
                            title: "Customer Group",
                            text: "Customer group was successfully created.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                               location.reload(); 
                            //}
                        });                    
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                    getCommercialCustomers();
                },
                beforeSend: function() {
                    $('#btn-save-customer-group').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-update-customer-group').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customers/_update_customer_group",
                dataType: 'json',
                data: $('#frm-update-customer-group').serialize(),
                success: function(data) {    
                    $('#btn-update-customer-group').html('Save');                   
                    if (data.is_success) {
                        $('#modal-edit-customer-group').modal('hide');
                        Swal.fire({
                            title: "Customer Group",
                            text: "Customer group was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                               location.reload(); 
                            //}
                        });                    
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                    getCommercialCustomers();
                },
                beforeSend: function() {
                    $('#btn-update-customer-group').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        /*$("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");
            _form.submit();
        }, 1000));*/  
        
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            Swal.fire({
                title: 'Customer Group',
                html: `Are you sure you want to delete customer group <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customers/_delete_customer_group",
                        data: {id: id},
                        dataType:'json',
                        success: function(data) {
                            if( data.is_success ){
                                Swal.fire({
                                    title: "Customer Group",
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    
                                });
                            }
                            getCommercialCustomers();
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>