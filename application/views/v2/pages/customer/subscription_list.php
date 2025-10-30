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
        height: 380px;
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
                    <div class="col-lg-3 mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control activeCustomerGroupSearch" placeholder="Search Customer">
                            <select class="form-select activeCustomerCategoryFilter">
                                <option value="">None</option>
                            </select>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</div>

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
                        const group = grouped[key].sort((a, b) => a.name.localeCompare(b.name));
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
                            const type = cust.type ? cust.type : "Not Specified";
                            const status = cust.status ? cust.status : "Not Specified";
                            const address = cust.address ? cust.address : "Not Specified";
                            const email = cust.email ? cust.email : "no@email.com";
                            const bill_start = cust.bill_start ? new Date(cust.bill_start).toLocaleDateString("en-US", { month: "2-digit", day: "2-digit", year: "numeric" }) : "Not Specified";
                            const bill_end = cust.bill_end ? new Date(cust.bill_end).toLocaleDateString("en-US", { month: "2-digit", day: "2-digit", year: "numeric" }) : "Not Specified";
                            const bill_mmr = cust.bill_mmr ? Number(cust.bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" }) : Number(cust.alarm_bill_mmr).toLocaleString("en-US", { style: "currency", currency: "USD" });

                            

                            return `
                                <tr>
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
                                    <td class="text-nowrap">${type}</td>
                                    <td class="text-nowrap">${status}</td>
                                    <td class="text-nowrap">${address}</td>
                                    <td class="text-nowrap">${bill_start}</td>
                                    <td class="text-nowrap">${bill_end}</td>
                                    <td class="text-nowrap">${bill_mmr}</td>
                                    <td style="width: 0;" class="p-0">
                                        <div class='dropdown'>
                                            <button class='btn dropdown-toggle text-muted' type='button' id='activeCustomerButtonDropdown' data-bs-toggle='dropdown' aria-expanded='false'><i class='fas fa-ellipsis-v'></i></button>
                                            <ul class='dropdown-menu' aria-labelledby='activeCustomerButtonDropdown'>
                                                <li><a class="dropdown-item" href="${window.origin}/customer/subscription/${cust.id}">View</a></li>
                                                <li><a class="dropdown-item view-payment-item" href="javascript:void(0);" data-customer-id="${cust.id}" data-billing-id="">Payment History</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>   
                            `;
                        }).join("");

                        html += `
                            <div class="activeCustomerGroupAccordion border rounded mb-2">
                                <button class="btn w-100 text-start accordionButton text-muted" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                                    <strong>${key}&ensp;<span class="group${loopCount}Count">(${group.length})</span></strong>
                                </button>
                                <div class="collapse" id="${collapseId}">
                                    <div class="border-top position-relative">
                                        <div class="table-responsive activeCustomerTableContainer">
                                            <table class="table table-bordered table-hover mb-0 align-middle">
                                                <thead class="sticky-top">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th>Address</th>
                                                        <th>Bill Start</th>
                                                        <th>Bill End</th>
                                                        <th>MMR</th>
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
                            <div class="col-lg-1">
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