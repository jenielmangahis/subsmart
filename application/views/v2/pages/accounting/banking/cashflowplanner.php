<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/accounting_header'); 
?>

<!-- CSS and JS Imports -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" integrity="sha512-qc0GepkUB5ugt8LevOF/K2h2lLGIloDBcWX8yawu/5V8FXSxZLn3NVMZskeEyOhlc6RxKiEj6QpSrlAoL1D3TA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js" integrity="sha512-mDe5mwqn4f61Fafj3rll7+89g6qu7/1fURxsWbbEkTmOuMebO9jf1C3Esw95oDfBLUycDza2uxAiPa4gdw/hfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Internal CSS Styling -->
<style>
    select[readonly] {
        pointer-events: none;
        background-color: #e9ecef;
    }

    #businessLogo {
        height: auto;
        width: 65px;
    }

    #businessName {
        left: 80px;
        margin-top: 17px;
    }

    .fw-xnormal {
        font-weight: 500;
    }

    #moneyInLegend {
        background: #53b700;
        padding-left: 18px;
        border-radius: 100px;
        border: 1px solid gray;
        margin-right: 6px;
    }

    #moneyOutLegend {
        background: #05a4b5;
        padding-left: 18px;
        border-radius: 100px;
        border: 1px solid gray;
        margin-right: 6px;
    }

    #cashBalanceLegend {
        border-bottom: 2px solid #53b700;
        padding-right: 20px;
        margin-right: 6px;
    }

    #projectedLegend {
        border-bottom: 2px dotted #53b700;
        padding-right: 20px;
        margin-right: 6px;
    }

    #cashbalanceLegendInfo {
        display: none;
    }

    #sort_transaction {
        font-weight: bolder;
        font-size: 15px;
        width: 170px;
    }

    .frequency_settings {
        display: none;
    }

    table.dataTable thead th,
    table.dataTable thead td,
    table.dataTable tbody td {
        padding: 6px;
    }

    table.dataTable>thead>tr>th {
        border-bottom: 1px solid lightgray !important;
    }

    table>tbody {
        font-size: 16px;
    }

    .dataTables_length,
    .dataTables_filter,
    table thead th:nth-child(2),
    table tbody td:nth-child(2),
    table thead th:nth-child(6),
    table tbody td:nth-child(6) {
        display: none;
    }

    .customButton {
        /* padding: 6px; */
        /* margin: 0px; */
        height: 34px;
        margin-bottom: unset !important;
    }

    #loadingScreen {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        /* White background with opacity */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
        /* Ensure it's above other elements */
    }

    .loading-content {
        font-size: 15px;
        font-weight: bold;
    }

    .apexcharts-tooltip {
        top: -70px !important;
    }
</style>

<div class="container-fluid page-content g-0">
    <div class="row ">
        <div class="col-md-12 mb-3">
            <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
        </div>
        <div class="col-md-12 mb-3">
            <div class="nsm-page-subnav">
                <ul>
                    <li class="active" onclick="location.href='#'">
                        <a class="nsm-page-link" href="<?php echo base_url('/accounting/cashflowplanner') ?>">
                            <span>Planner</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="nsm-callout primary">
                <button><i class="bx bx-x"></i></button>
                The Cash Flow planner is an interactive tool that forecasts your cash flow, the money going in and out of your business. It looks at your financial history to forecast future money in and money out events. You can also add and adjust future events to see how certain changes affect your cash flow.
            </div>
        </div>
        <div class="col-md-12 mb-5">
            <div class="position-relative">
                <img id="businessLogo" class="position-absolute" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                <h2 id="businessName" class="fw-bold position-absolute"><?php echo $companyInfo->business_name; ?></h2>
            </div>
        </div>
        <div class="col-md-12 mt-5 mb-3">
            <div class="float-start">
                <span class="fw-xnormal">Today's Balance</span></br>
                <h1 class="fw-bold todays_balance">$0.00</h1>
                <select class="form-select form-select graph_month_span">
                    <option value="12_month">12 months</option>
                    <option value="6_month">6 months</option>
                    <option value="3_month">3 months</option>
                    <option value="this_month">This month</option>
                </select>
            </div>
            <div class="float-end">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="graph" id="moneyInOut_ID" checked>
                    <label class="nsm-button btn btn-outline-secondary" for="moneyInOut_ID"><i class="fa fa-bar-chart" aria-hidden="true"></i> Money In/Out</label>
                    <!--  -->
                    <input type="radio" class="btn-check" name="graph" id="cashbalance_ID">
                    <label class="nsm-button btn btn-outline-secondary" for="cashbalance_ID"><i class="fa fa-line-chart" aria-hidden="true"></i> Cash Balance</label>
                </div>
                <span id="moneyInOutLegendInfo">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="moneyInLegend"></span> Money In</label></div>
                        <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="moneyOutLegend"></span> Money Out</label></div>
                    </div>
                </span>
                <span id="cashbalanceLegendInfo">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="cashBalanceLegend"></span>Cash Balance</label></div>
                        <div class="col-auto"><label class="col-form-label fw-xnormal"><span id="projectedLegend"></span>Projected</label></div>
                    </div>
                </span>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div id="chart"></div>
        </div>
        <div class="col-md-12 mb-3">
            <hr>
        </div>
        <div class="col-md-12 mb-1">
            <div class="float-start">
                <div class="input-group flex-nowrap">
                    <input id="table_search" class="form-control mt-0 w-100" type="text" placeholder="Search...">
                    <select id="sort_transaction" class="form-select">
                        <option value="">All</option>
                        <option value="money_in">Money In</option>
                        <option value="money_out">Money Out</option>
                        <!-- <option value="paid_invoice">Invoice</option> -->
                    </select>
                </div>
            </div>
            <div class="float-end">
                <div class="dropdown">
                    <button id="dropdownMenuButton1" class="nsm-button dropdown-toggle" data-bs-toggle="dropdown">Download Report <i class='bx bxs-down-arrow' ></i></button>
                    <button class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#addCashFlowItem_modal">Add Item</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item exportToPDF" href="#">Export to PDF</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Export to CSV</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <table id="cashflowplanner_table" class="table table-bordered table-hover table-sm w-100">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th class="d-non">ID</th>
                        <th>DESCRIPTION</th>
                        <th>AMOUNT</th>
                        <th>TYPE</th>
                        <th>TRANSACTION</th>
                        <th style="width: 0px;"></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Adding Item -->
    <div class="modal" id="addCashFlowItem_modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Add Item</span>
                    <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer; font-weight: bolder;"></i>
                </div>
                <div class="modal-body">
                    <form id="addCashFlowItem_form">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="mb-1 fw-xnormal">Date</label>
                                <input name="date" class="form-control mt-0" type="date" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-1 fw-xnormal">Description</label>
                                <input name="description" class="form-control mt-0" type="text" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="mb-1 fw-xnormal">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text fw-bold">$</span></div>
                                    <input name="amount" class="form-control mt-0" type="number" inputmode="numeric" step="any" required>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="mb-1 fw-xnormal">Type</label>
                                <select name="type" class="form-control form-control" required readonly>
                                    <option value="planned">Planned</option>
                                    <option value="invoiced">Invoiced</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="mb-1 fw-xnormal">Transaction</label>
                                <select name="transaction" class="form-select form-select" required>
                                    <option selected disabled value>Select Transaction...</option>
                                    <option value="money_in">Money In</option>
                                    <option value="money_out">Money Out</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="mb-1 fw-xnormal">Frequency</label>
                                <select name="frequency" class="form-select form-select" required>
                                    <option selected value="one_time">One-Time Only</option>
                                    <!-- <option value="repeating">Repeating</option> -->
                                </select>
                            </div>
                            <div class="col-md-12 mb-3 frequency_settings">
                                <label class="mb-1 fst-italic">Frequency Settings</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        test
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-end">
                                    <button type="submit" class="nsm-button primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Item -->
    <div class="modal" id="updateCashFlowItem_modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Update Item <small class="itemDescription text-muted fw-normal"></small></span>
                    <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer; font-weight: bolder;"></i>
                </div>
                <div class="modal-body">
                    <div id="loadingScreen" class="loading-screen">
                        <div class="loading-content">
                            Please wait, fetching data from the server..
                        </div>
                    </div>
                    <form id="updateCashFlowItem_form">
                        <div class="row">
                            <input name="id" class="form-control mt-0" type="hidden">
                            <div class="col-md-3 mb-3">
                                <label class="mb-1 fw-xnormal">Date</label>
                                <input name="date" class="form-control mt-0" type="date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-1 fw-xnormal">Description</label>
                                <input name="description" class="form-control mt-0" type="text" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="mb-1 fw-xnormal">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text fw-bold">$</span></div>
                                    <input name="amount" class="form-control mt-0" type="number" inputmode="numeric" step="any" required>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3 forCashflowPlannedOnly">
                                <label class="mb-1 fw-xnormal">Type</label>
                                <select name="type" class="form-control form-control" required readonly>
                                    <option selected value="planned">Planned</option>
                                    <option value="invoiced">Invoiced</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3 forCashflowPlannedOnly">
                                <label class="mb-1 fw-xnormal">Transaction</label>
                                <select name="transaction" class="form-select form-select" required>
                                    <option selected value="money_in">Money In</option>
                                    <option value="money_out">Money Out</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3 forCashflowPlannedOnly">
                                <label class="mb-1 fw-xnormal">Frequency</label>
                                <select name="frequency" class="form-select form-select" required>
                                    <option selected value="one_time">One-Time Only</option>
                                    <!-- <option value="repeating">Repeating</option> -->
                                </select>
                            </div>
                            <div class="col-md-12 mb-3 frequency_settings">
                                <label class="mb-1 fst-italic">Frequency Settings</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        test
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3 forInvoicedOnly">
                                <label class="mb-1 fw-xnormal">DUE DATE</label><br>
                                <label class="mb-1 fw-bold dueDateLabel"></label>
                            </div>
                            <div class="col-md-2 mb-3 forInvoicedOnly">
                                <label class="mb-1 fw-xnormal">DUE AMOUNT</label><br>
                                <label class="mb-1 fw-bold dueAmountLabel"></label>
                            </div>
                            <div class="col-md-2 mb-3 forInvoicedOnly">
                                <label class="mb-1 fw-xnormal">REF NUMBER</label><br>
                                <label class="mb-1 fw-bold refNumberLabel"></label>
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-end">
                                    <button type="button" class="nsm-button removeItem border-0" data-id="0">Remove</button>
                                    <button type="submit" class="nsm-button primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
    var BASE_URL = window.location.origin;

    // DataTable Configuration ===============
    const cashflowplanner_table = $('#cashflowplanner_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
            "url": "<?php echo base_url('/accounting/cashflowplanner_crud/read'); ?>",
            "type": "POST",
        },
        "language": {
            "infoFiltered": "",
        },
        // "order": [[0, 'desc'] ],
    });

    $('#table_search').keyup(function() {
        cashflowplanner_table.search($(this).val()).draw();
    });

    $('#sort_transaction').change(function() {
        cashflowplanner_table.search($(this).val()).draw();
    });
    // DataTable Configuration ===============

    // Custom Function ===============
    function formDisabler(selector, state) {
        const element = $(selector);
        const submitButton = element.find('button[type="submit"]');
        element.find("input, button").prop('disabled', state);

        if (state) {
            element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true).html('Processing...');
        } else {
            element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    function formatCurrency(value) {
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
        return formatter.format(value);
    }

    function getItemData(id, type) {
        $('#updateCashFlowItem_modal').modal('show');
        $('#loadingScreen').show();
        $('.removeItem').attr('data-id', id);

        if (type == 'planned') {
            $('.itemDescription').text('(Planned Cash flow item)');
            $('.forCashflowPlannedOnly').show();
            $('.forInvoicedOnly').hide();
            $.ajax({
                url: "/accounting/cashflowplanner_crud/get_cashflowiteminfo",
                method: "POST",
                data: "id=" + id,
                success: function(response) {
                    const jsonReponse = JSON.parse(response);
                    const updateForm = $('#updateCashFlowItem_form');
                    $('#loadingScreen').hide();
                    updateForm.find('input[name="id"]').val(jsonReponse[0].id);
                    updateForm.find('input[name="date"]').val(jsonReponse[0].date);
                    updateForm.find('input[name="description"]').val(jsonReponse[0].description);
                    updateForm.find('input[name="amount"]').val(jsonReponse[0].amount);
                    updateForm.find('select[name="type"]').val(jsonReponse[0].type);
                    updateForm.find('select[name="transaction"]').val(jsonReponse[0].transaction);
                    updateForm.find('select[name="frequency"]').val(jsonReponse[0].frequency);
                },
            });
        } else if (type == 'projected') {
            $('.itemDescription').text('(Planned Cash flow item)');
            $('.forCashflowPlannedOnly').show();
            $('.forInvoicedOnly').hide();
            $.ajax({
                url: "/accounting/cashflowplanner_crud/get_cashflowiteminfo",
                method: "POST",
                data: "id=" + id,
                success: function(response) {
                    const jsonReponse = JSON.parse(response);
                    const updateForm = $('#updateCashFlowItem_form');
                    $('#loadingScreen').hide();
                    updateForm.find('input[name="id"]').val(jsonReponse[0].id);
                    updateForm.find('input[name="date"]').val(jsonReponse[0].date);
                    updateForm.find('input[name="description"]').val(jsonReponse[0].description);
                    updateForm.find('input[name="amount"]').val(jsonReponse[0].amount);
                    updateForm.find('select[name="type"]').val('planned');
                    updateForm.find('select[name="transaction"]').val(jsonReponse[0].transaction);
                    updateForm.find('select[name="frequency"]').val(jsonReponse[0].frequency);
                },
            });
        } else {
            $('.itemDescription').text('(Paid Invoiced)');
            $('.forCashflowPlannedOnly').hide();
            $('.forInvoicedOnly').show();
            $.ajax({
                url: "/accounting/cashflowplanner_crud/get_cashflowiteminfo",
                method: "POST",
                data: "id=" + id,
                success: function(response) {
                    const jsonReponse = JSON.parse(response);
                    const updateForm = $('#updateCashFlowItem_form');
                    $('#loadingScreen').hide();
                    updateForm.find('input[name="date"]').val(jsonReponse[0].date);
                    updateForm.find('input[name="description"]').val(jsonReponse[0].description);
                    updateForm.find('input[name="amount"]').val(jsonReponse[0].amount);
                    $('.dueDateLabel').text(jsonReponse[0].invoice_due_date);
                    $('.dueAmountLabel').text(formatCurrency(jsonReponse[0].amount));
                    $('.refNumberLabel').text(jsonReponse[0].invoice_ref_number);
                },
            });
        }
    }

    function getBalance() {
        $.ajax({
            url: "/accounting/cashflowplanner_crud/get_balance",
            method: "POST",
            success: function(response) {
                $('.todays_balance').text(formatCurrency(response));
            },
        });
    }

    function getProjectionData() {
        $.ajax({
            url: "/accounting/cashflowplanner_crud/get_projection_data",
            method: "POST",
        });
    }

    function getGraphData(type) {
        switch (type) {
            case "bar_12_month":
                $.ajax({
                    url: "/accounting/cashflowplanner_crud/get_12month_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [{
                                    offsetX: 60,
                                    x: month[9], // Index for "Feb"
                                    x2: month[11], // Index for "Feb"
                                    borderColor: 'darkgreen',
                                    strokeDashArray: 8,
                                    label: {
                                        offsetX: 135,
                                        orientation: 'horizontal',
                                        borderColor: '#53b700',
                                        style: {
                                            color: '#fff',
                                            background: '#53b700',
                                        },
                                        text: 'PROJECTION',
                                    },
                                }, ],
                            },

                        });
                    },
                });
                break;
            case "bar_6_month":
                $.ajax({
                    url: "/accounting/cashflowplanner_crud/get_6month_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [{
                                    offsetX: 130,
                                    x: month[3], // Index for "Feb"
                                    x2: month[5], // Index for "Feb"
                                    borderColor: 'darkgreen',
                                    strokeDashArray: 8,
                                    label: {
                                        offsetX: 200,
                                        orientation: 'horizontal',
                                        borderColor: '#53b700',
                                        style: {
                                            color: '#fff',
                                            background: '#53b700',
                                        },
                                        text: 'PROJECTION',
                                    },
                                }, ],
                            },
                        });
                    },
                });
                break;
            case "bar_3_month":
                $.ajax({
                    url: "/accounting/cashflowplanner_crud/get_3month_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [{
                                    offsetX: 285,
                                    x: month[1], // Index for "Feb"
                                    x2: month[2], // Index for "Feb"
                                    borderColor: 'darkgreen',
                                    strokeDashArray: 8,
                                    label: {
                                        offsetX: 370,
                                        orientation: 'horizontal',
                                        borderColor: '#53b700',
                                        style: {
                                            color: '#fff',
                                            background: '#53b700',
                                        },
                                        text: 'PROJECTION',
                                    },
                                }, ],
                            },
                        });
                    },
                });
                break;
            case "bar_this_month":
                $.ajax({
                    url: "/accounting/cashflowplanner_crud/get_thismonth_bargraph",
                    method: "POST",
                    success: function(response) {
                        const data = JSON.parse(response);
                        const month = data['month_name'];
                        const moneyIn = data['moneyin'];
                        const moneyOut = data['moneyout'];
                        chart.updateSeries([{
                                name: 'Money in',
                                data: moneyIn,
                            },
                            {
                                name: 'Money out',
                                data: moneyOut,
                            },
                        ]);

                        chart.updateOptions({
                            xaxis: {
                                categories: month,
                            },
                            annotations: {
                                xaxis: [],
                            },
                        });
                    },
                });
                break;
        }
    }

    function updateAllData() {
        getBalance();
        getProjectionData();
        cashflowplanner_table.draw();

        if ($('input[name="graph"]').prop("checked") === true) {
            if ($(".graph_month_span").val() == "12_month") {
                getGraphData("bar_12_month");
            } else if ($(".graph_month_span").val() == "6_month") {
                getGraphData("bar_6_month");
            } else if ($(".graph_month_span").val() == "3_month") {
                getGraphData("bar_3_month");
            } else {
                getGraphData("bar_this_month");
            }
        } else {
            
        }

    }
    updateAllData();

    
    // console.log('ADI SMART HOME CashFlow Planner'.split(' ').join('_'));

    $(".exportToPDF").click(function(event) {
        event.preventDefault();
        const businessname = "<?php echo $companyInfo->business_name; ?>".toUpperCase().split(' ').join('_');
        const filename = businessname + " CashFlow Planner".split(' ').join('_');
        const filePath = BASE_URL + "/assets/pdf/accounting/" + filename + ".pdf";
        const link = $("<a>", {
            href: filePath,
            download: filename + ".pdf",
        });

        $.ajax({
            url: "<?php echo base_url('/accounting/cashflowplanner_crud/generate_pdf_report') ?>",
            method: "POST",
            success: function(response) {
                setTimeout(() => {
                    $("body").append(link);
                    link[0].click();
                    link.remove();
                }, 500);
            },
        });
    });

    $(".graph_month_span").change(function(e) {
        if ($('input[name="graph"]').prop("checked") === true) {
            if ($(this).val() == "12_month") {
                getGraphData("bar_12_month");
            } else if ($(this).val() == "6_month") {
                getGraphData("bar_6_month");
            } else if ($(this).val() == "3_month") {
                getGraphData("bar_3_month");
            } else {
                getGraphData("bar_this_month");
            }
        } else { 

        }
    });

    $('input[name="graph"]').click(function (e) { 
        if ($('input[name="graph"]').prop("checked") === true) {
            if ($(".graph_month_span").val() == "12_month") {
            getGraphData("bar_12_month");
            } else if ($(".graph_month_span").val() == "6_month") {
                getGraphData("bar_6_month");
            } else if ($(".graph_month_span").val() == "3_month") {
                getGraphData("bar_3_month");
            } else {
                getGraphData("bar_this_month");
            }
        } else {
          
        }
    });
    // Custom Function ===============

    // Show/Hide Manipulation ===============
    $('#moneyInOut_ID').click(function(e) {
        $('#moneyInOutLegendInfo').show();
        $('#cashbalanceLegendInfo').hide();
    });

    $('#cashbalance_ID').click(function(e) {
        $('#moneyInOutLegendInfo').hide();
        $('#cashbalanceLegendInfo').show();
    });

    $('select[name="frequency"]').change(function(e) {
        e.preventDefault();
        const value = $(this).val();
        if (value == "one_time") {
            $('.frequency_settings').hide();
        } else {
            $('.frequency_settings').show();
        }
    });
    // Show/Hide Manipulation ===============

    // Form Submit Action ===============
    $('#addCashFlowItem_form').submit(function(e) {
        const form = $(this);
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('/accounting/cashflowplanner_crud/insert') ?>",
            method: "POST",
            data: form.serialize(),
            beforeSend: function() {
                formDisabler(form, true);
            },
            success: function(response) {
                console.log(response);
                formDisabler(form, false);
                $('#addCashFlowItem_modal').modal('hide');
                form.find('input[type="text"], input[type="number"]').val(null);
                form.find('select').prop('selectedIndex', 0);
                updateAllData();
                Swal.fire({
                    title: "Success!",
                    text: "Item was added successfully.",
                    icon: "success"
                });
            },
        });
    });

    $('#updateCashFlowItem_form').submit(function(e) {
        const form = $(this);
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('/accounting/cashflowplanner_crud/update') ?>",
            method: "POST",
            data: form.serialize(),
            beforeSend: function() {
                formDisabler(form, true);
            },
            success: function(response) {
                formDisabler(form, false);
                $('#updateCashFlowItem_modal').modal('hide');
                updateAllData();
                Swal.fire({
                    title: "Success!",
                    text: "Item was updated successfully.",
                    icon: "success"
                });
            },
        });
    });

    $('.removeItem').click(function(e) {
        Swal.fire({
            title: "Delete Item",
            text: "Are you sure you want to delete this item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $('#updateCashFlowItem_modal').modal('hide');
                $.ajax({
                    url: "/accounting/cashflowplanner_crud/delete",
                    method: "POST",
                    data: "id=" + $('.removeItem').attr('data-id'),
                    success: function(response) {
                        getProjectionData();
                        updateAllData();
                        Swal.fire({
                            title: "Success!",
                            text: "Item was removed successfully.",
                            icon: "success"
                        });
                    },
                });
            }
        });
    });
    // Form Submit Action ===============

    // Chart Configuration ===============
    var options = {
        series: [{
                name: 'Money in',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
            {
                name: 'Money out',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            },
        ],
        plotOptions: {
            bar: {
                columnWidth: '50%',
                borderRadius: 5,
            }
        },
        fill: {
            colors: ['#53b700', '#05a4b5'],
        },
        chart: {
            type: 'bar',
            height: 300
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 5,
            colors: ['#FFF', '#FFF']
        },
        tooltip: {
            shared: true,
            intersect: false,
            custom: function({series,seriesIndex,dataPointIndex,w}) {
                let moneyInValue = (series[0][dataPointIndex]) ? formatCurrency(series[0][dataPointIndex]) : "$0.00";
                let moneyOutValue = (series[1][dataPointIndex]) ? formatCurrency(series[1][dataPointIndex]) : "$0.00";
                let netChange = formatCurrency(series[0][dataPointIndex] - series[1][dataPointIndex]);
                const customTooltip = '<div class="row" style="border-radius: 5px; padding: 10px; width: 230px;"> <div class="col-md-12 mt-1"> <h5 class="fw-bold">' + w.globals.labels[dataPointIndex] + '</h5> </div> <div class="col-md-12 mb-1"> <span style="background: #53b700; padding-left: 7px; margin-right: 6px;"></span> <label>Money In:</label>&nbsp;&nbsp;<span class="fw-xnormal">' + moneyInValue + '</span> </div> <div class="col-md-12"> <span style="background: #05a4b5; padding-left: 7px; margin-right: 6px;"></span> <label>Money Out:</label>&nbsp;&nbsp;<span class="fw-xnormal">' + moneyOutValue + '</span> </div> <div class="col-md-12"> <hr style="margin: 5px;"> </div> <div class="col-md-12"><label>Net Change</label>&nbsp;&nbsp;<span class="fw-xnormal">' + netChange + '</span> </div> </div>';
                return customTooltip;
            }

        },
        legend: {
            show: false,
        },
        xaxis: {
            categories: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        },
        // annotations: {
        //     xaxis: [
        //         {
        //             x: '2024-01', // Index for "Feb"
        //             x2: '2024-03', // Index for "Feb"
        //             borderColor: '#FF5733',
        //             label: {
        //                 borderColor: '#FF5733',
        //                 style: {
        //                     color: '#fff',
        //                     background: '#FF5733',
        //                 },
        //                 text: 'Prediction',
        //             },
        //         },
        //     ],
        // },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    // Chart Configuration ===============
</script>