<div class="row batchUpdaterContent">
    <div class="col-lg-12">
        <div class="container-fluid mb-3 mt-3">
            <div class="row">
                <h4 class="fw-bold">Batch Customer Updater</h4>
                <p>Search and select specific customers to update.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-3">
        <div class="container-fluid mb-3">
            <div class="row">
                <div class="col-xl-3 mb-3">
                    <label class="text-muted">Customer / Business Filter</label>
                    <div class="input-group">
                        <input class="searchCustomerListInput form-control mt-2" type="text" placeholder="Search entry here..." tabindex="-1">
                        <select class="form-select displayCustomerList mt-2" tabindex="-1">
                            <option selected value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Customer Type</label>
                    <select class="form-select searchCustomerType mt-2" tabindex="-1">
                        <option value="">None</option>
                        <option value="Residential">Residential</option>
                        <option value="Commercial">Commercial</option>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Customer Group filter</label>
                    <select class="form-select searchGroup mt-2" tabindex="-1">
                        <option value="">None</option>
                        <?php
                            foreach ($customer_group as $group) {
                                echo "<option value='$group->id'>$group->title</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-1 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Sales Area filter</label>
                    <select class="form-select searchSalesArea mt-2" tabindex="-1">
                        <option value="">None</option>
                        <?php
                            foreach ($sales_area as $salesarea) {
                                echo "<option value='$salesarea->sa_id'>$salesarea->sa_name</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Rate Plan filter</label>
                    <select class="form-select searchRatePlan mt-2" tabindex="-1">
                        <option value="">None</option>
                        <?php
                            foreach ($rate_plan as $plan) {
                                echo "<option value='$plan->amount'>$plan->plan_name ($$plan->amount)</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Payment Type filter</label>
                    <select class="form-select searchPaymentType mt-2" tabindex="-1">
                        <option value="">None</option>
                        <option value="CC">Credit Card</option>
                        <option value="DC">Debit Card</option>
                        <option value="CHECK">Check</option>
                        <option value="CASH">Cash</option>
                        <option value="ACH">ACH</option>
                        <option value="VENMO">Venmo</option>
                        <option value="PP">Paypal</option>
                        <option value="SQ">Square</option>
                        <option value="WW">Warranty Work</option>
                        <option value="HOF">Home Owner Financing</option>
                        <option value="eT">e-Transfer</option>
                        <option value="Invoicing">Invoicing</option>
                        <option value="OCCP">Other Credit Card Processor</option>
                        <option value="OPT">Other Payment Type</option>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Status Filter</label>
                    <select class="form-select searchStatus mt-2" tabindex="-1">
                        <option value="">None</option>
                        <?php
                            foreach ($customer_status as $status) {
                                echo "<option value='$status->name'>$status->name</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Panel Type Filter</label>
                    <select class="form-select searchPanelType mt-2" tabindex="-1">
                        <option value="">None</option>
                        <option value="AERIONICS">AERIONICS</option>
                        <option value="AlarmNet">AlarmNet</option>
                        <option value="Alarm.com">Alarm.com</option>
                        <option value="Alula">Alula</option>
                        <option value="Bosch">Bosch</option>
                        <option value="DSC">DSC</option>
                        <option value="ELK">ELK</option>
                        <option value="FBI">FBI</option>
                        <option value="GRI">GRI</option>
                        <option value="GE">GE</option>
                        <option value="Honeywell">Honeywell</option>
                        <option value="Honeywell Touch">Honeywell Touch</option>
                        <option value="Honeywell 3000">Honeywell 3000</option>
                        <option value="Honeywell">Honeywell</option>
                        <option value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                        <option value="Honeywell Lyric">Honeywell Lyric</option>
                        <option value="IEI">IEI</option>
                        <option value="MIER">MIER</option>
                        <option value="2 GIG">2 GIG</option>
                        <option value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                        <option value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                        <option value="Qolsys">Qolsys</option>
                        <option value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                        <option value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                        <option value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Sales Rep Filter</label>
                    <select class="form-select searchSalesRep mt-2" tabindex="-1">
                        <option value="">None</option>
                        <?php
                            foreach ($salesRep as $salesReps) {
                                echo "<option value='$salesReps->id'>$salesReps->FName $salesReps->LName</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Technician Filter</label>
                    <select class="form-select searchTechnician mt-2" tabindex="-1">
                        <option value="">None</option>
                        <?php
                            foreach ($technician as $technicians) {
                                echo "<option value='$technicians->id'>$technicians->FName $technicians->LName</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Monitoring Company Filter</label>
                    <select class="form-select searchMonitoringCompany mt-2" tabindex="-1">
                        <option value="">None</option>
                        <option value="ADT">ADT</option>
                        <option value="CMS">CMS</option>
                        <option value="COPS">COPS</option>
                        <option value="FrontPoint">FrontPoint</option>
                        <option value="ProtectionOne">ProtectionOne</option>
                        <option value="Stanley">Stanley</option>
                        <option value="Guardian">Guardian</option>
                        <option value="Vector">Vector</option>
                        <option value="Central">Central</option>
                        <option value="Brinks">Brinks</option>
                        <option value="Equipment Funding">Equipment Funding</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Account Type Filter</label>
                    <select class="form-select searchAccountType mt-2" tabindex="-1">
                        <option value="">None</option>
                        <option value="In-House">In-House</option>
                        <option value="Purchase">Purchase</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Rental">Rental</option>
                        <option value="Residential">Residential</option>
                    </select>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Billing Start date Filter</label>
                    <input class="form-control billingStartDate mt-2" type="date" tabindex="-1">
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">End Start date Filter</label>
                    <input class="form-control billingEndDate mt-2" type="date" tabindex="-1">
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted">Horizontal Scroll</label>
                    <div class="input-group mt-2">
                        <button class="btn btn-dark scrollToStart" tabindex="-1"><i class="fas fa-angle-double-left"></i></button>
                        <button class="btn btn-secondary scrollToLeft" tabindex="-1"><i class="fas fa-angle-left"></i></button>
                        <button class="btn btn-secondary scrollToRight" tabindex="-1"><i class="fas fa-angle-right"></i></button>
                        <button class="btn btn-dark scrollToEnd" tabindex="-1"><i class="fas fa-angle-double-right"></i></button>
                    </div>
                </div>
                <div class="col-xl-2 mb-3 dropdownFilterWidth">
                    <label class="text-muted"></label>
                    <div class="input-group mt-2">
                        <button class="btn updateHistory" type="button" tabindex="-1" data-bs-toggle="offcanvas" data-bs-target="#updateHistorySidebar" aria-controls="updateHistorySidebar" style="border: 1px solid lightgray;"><i class="fas fa-history"></i> History</button>
                    </div>
                </div>
                <div class="col-xl-12 mb-3">
                    <div class="table-responsive tableUpdaterDiv">
                        <table class="table table-hover customerManagementTable">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Business Name</th>
                                    <th>Customer Type</th>
                                    <th>Sales Area</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip Code</th>
                                    <th>Social Security No. </th>
                                    <th>Birthdate</th>
                                    <th>Email</th>
                                    <th>Phone (M)</th>
                                    <th>Status</th>
                                    <th>Sales Rep</th>
                                    <th>Technician</th>
                                    <th>Install Date</th>
                                    <th>Monitoring Company</th>
                                    <th>Monitoring ID</th>
                                    <th>Account Type</th>
                                    <th>Abort Code/Password</th>
                                    <th>Panel Type</th>
                                    <th>System Package Type</th>
                                    <th>Warranty Type</th>
                                    <th>Communication Type</th>
                                    <th>Monthly Monitorinng Rate</th>
                                    <th>Account Cost</th>
                                    <th>Pass Thru Cost</th>
                                    <th>Rate Plan</th>
                                    <th>Billing Frequency</th>
                                    <th>Billing Day of Month</th>
                                    <th>Contract Term</th>
                                    <th>Billing Start Date</th>
                                    <th>Billing End Date</th>
                                    <th>Billing Method</th>
                                    <th>Check No.</th>
                                    <th>Routing No.</th>
                                    <th>Account No.</th>
                                    <th>Credit Card No.</th>
                                    <th>Credit Card Expiration</th>
                                    <th>MMR Profit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-xl-3 mt-5 d-none">
                    <form action="">
                        <input class="form-control form-control-sm updateID" type="text">
                        <input class="form-control form-control-sm updateCategory" type="text">
                        <input class="form-control form-control-sm updateColumn" type="text">
                        <input class="form-control form-control-sm updateValue" type="text">
                        <input class="form-control form-control-sm customerName" type="text">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="updateHistorySidebar" aria-labelledby="updateHistorySidebarLabel" style="width: 1000px;">
        <div class="offcanvas-header" style="background: #6a4a86;">
            <h5 id="updateHistorySidebarLabel" style="font-weight: bold; margin: 0; color: white;">Update History</h5>
            <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white !important;float: left;padding: 0;"><span class="float-start"><small>Close</small></span></button>
        </div>
        <div class="offcanvas-body">
            <div class="container">
                <div class="row">
                    <div class="col-12-md mb-3">
                        <span class="text-mute">Records all changes to customer information, maintains a history of previous values, and allows users to easily revert changes.</span>
                    </div>
                
                    <div class="col-xl-3 mb-3">
                        <label class="text-muted mb-1">Search Input Filter</label>
                        <div class="input-group">
                            <input class="searchpdateHistoryRecords form-control" type="text" placeholder="Search History here..." tabindex="-1">
                        </div>
                    </div>

                    <div class="col-xl-2 mb-3 dropdownFilterWidth">
                        <label class="text-muted">Column Filter</label>
                        <select class="form-select searchpdateHistoryColumn mt-1" tabindex="-1">
                            <option value="">None</option>
                            <option value="Firstname">Firstname</option>
                            <option value="Lastname">Lastname</option>
                            <option value="Business Name">Business Name</option>
                            <option value="Customer Type">Customer Type</option>
                            <option value="Sales Area">Sales Area</option>
                            <option value="Address">Address</option>
                            <option value="City">City</option>
                            <option value="State">State</option>
                            <option value="Zip Code">Zip Code</option>
                            <option value="Social Security No.">Social Security No.</option>
                            <option value="Birthdate">Birthdate</option>
                            <option value="Email">Email</option>
                            <option value="Phone (M)">Phone (M)</option>
                            <option value="Status">Status</option>
                            <option value="Sales Rep">Sales Rep</option>
                            <option value="Technician">Technician</option>
                            <option value="Install Date">Install Date</option>
                            <option value="Monitoring Company">Monitoring Company</option>
                            <option value="Monitoring ID">Monitoring ID</option>
                            <option value="Account Type">Account Type</option>
                            <option value="Abort Code/Password">Abort Code/Password</option>
                            <option value="Panel Type">Panel Type</option>
                            <option value="System Package Type">System Package Type</option>
                            <option value="Warranty Type">Warranty Type</option>
                            <option value="Communication Type">Communication Type</option>
                            <option value="Monthly Monitorinng Rate">Monthly Monitorinng Rate</option>
                            <option value="Account Cost">Account Cost</option>
                            <option value="Pass Thru Cost">Pass Thru Cost</option>
                            <option value="Rate Plan">Rate Plan</option>
                            <option value="Billing Frequency">Billing Frequency</option>
                            <option value="Billing Day of Month">Billing Day of Month</option>
                            <option value="Contract Term">Contract Term</option>
                            <option value="Billing Start Date">Billing Start Date</option>
                            <option value="Billing End Date">Billing End Date</option>
                            <option value="Billing Method">Billing Method</option>
                            <option value="Check No.">Check No.</option>
                            <option value="Routing No.">Routing No.</option>
                            <option value="Account No.">Account No.</option>
                            <option value="Credit Card No.">Credit Card No.</option>
                            <option value="Credit Card Expiration">Credit Card Expiration</option>

                        </select>
                    </div>

                    <div class="col-12-md mb-3">
                        <table class="updateHistoryTable table table-hover">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Column</th>
                                    <th>Value</th>
                                    <th>Updated By</th>
                                    <th>Date Updated</th>
                                    <th style="width: 0px;"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
    var lastOptionInAccType = "";
    var lastOptionInAccTypeCount = 0;
    var customerManagementTable;
    var updateHistoryTable;
    let horizontalScroll = 0;
    let cell_dragging = false;
    let initialValue;
    let initialSelectedOption;
    let startCell;
    let startIndex;
    let startColumnIndex;
    let lastDraggedIndex = 1;
    let valueOnText;
    let currentInputElement;
    let columnName;
    let selectedCells = [];

    customerManagementTable = $('.customerManagementTable').DataTable({
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {
            "url": "<?= base_url('customer/customerServersideLoad'); ?>",
            "type": "POST",
        },
        "language": {
            "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>"
        }
    });

    updateHistoryTable = $('.updateHistoryTable').DataTable({
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {
            "url": "<?= base_url('customer/customerUpdateHistoryServersideLoad'); ?>",
            "type": "POST",
        },
        "language": {
            "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>"
        }
    });

    $('.searchCustomerType').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(3).search(filterData).draw();
    });

    $('.searchGroup').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(39).search(filterData).draw();
    });

    $('.searchSalesArea').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(4).search(filterData).draw();
    });

    $('.searchRatePlan').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(27).search(filterData).draw();
    });

    $('.searchPaymentType').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(33).search(filterData).draw();
    });

    $('.searchStatus').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(13).search(filterData).draw();
    });

    $('.searchPanelType').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(20).search(filterData).draw();
    });

    $('.searchSalesRep').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(14).search(filterData).draw();
    });

    $('.searchTechnician').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(40).search(filterData).draw();
    });

    $('.searchMonitoringCompany').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(16).search(filterData).draw();
    });

    $('.searchAccountType').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(18).search(filterData).draw();
    });

    $('.billingStartDate').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(31).search(filterData).draw();
    });

    $('.billingEndDate').change(function(e) {
        var filterData = $(this).val();
        customerManagementTable.columns(32).search(filterData).draw();
    });

    $('.searchCustomerListInput').keyup(function(e) {
        var searchInput = $(this).val();
        customerManagementTable.search(searchInput).draw();
    });

    $('.searchpdateHistoryRecords').keyup(function(e) {
        var searchInput = $(this).val();
        updateHistoryTable.search(searchInput).draw();
    });

    $('.searchpdateHistoryColumn').change(function(e) {
        var filterData = $(this).val();
        updateHistoryTable.columns(1).search(filterData).draw();
    });
    
    // Handle click to show the drag handle and add green border
    $(document).on('click', '.customerManagementTable > tbody > tr > td', function() {
        valueOnText = $(this).closest('td').find('.updateInputValue').is('select') ? $(this).closest('td').find('.updateInputValue option:selected').text() : $(this).closest('td').find('.updateInputValue').val();
        columnName = $('.customerManagementTable th').eq($(this).closest('td').index()).text();

        $('.drag_handle').css('visibility', 'hidden');
        $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');

        $(this).find('.drag_handle').css('visibility', 'visible');
        $(this).addClass('cell_dragging');
    });

    // Hide the drag handle and reset the border
    $(document).on('click', function(e) {
        if (!$(e.target).closest('td').length) {
            // $('.drag_handle').css('visibility', 'hidden');
            // $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
        }
    });

    // Handle mouse down on the drag handle
    $(document).on('mousedown', '.drag_handle', function(e) {
        e.preventDefault();
        cell_dragging = true;
        startCell = $(this).closest('td');
        initialValue = startCell.find('input, select').val();
        initialSelectedOption = $(this).closest('td').find('.updateInputValue').find('option:selected').text();
        startIndex = startCell.parent().index();
        startColumnIndex = startCell.index();
        lastDraggedIndex = startIndex;
        startCell.addClass('cell_dragging');
    });

    // Handle mouse move (cell_dragging over cells in the same column)
    $(document).on('mousemove', '.customerManagementTable td', function(e) {
        if (cell_dragging) {
            $(this).addClass('cell_dragging_action');
            let currentColumnIndex = $(this).index();
            let currentRowIndex = $(this).parent().index();

            if (currentColumnIndex === startColumnIndex) {
                if (currentRowIndex !== lastDraggedIndex) {

                    // Dragging down
                    if (currentRowIndex > lastDraggedIndex) {
                        for (let i = lastDraggedIndex + 1; i <= currentRowIndex + 1; i++) {
                            $('.customerManagementTable tr').eq(i).find('td').eq(startColumnIndex).addClass('cell_dragging');
                        }
                    }
                    // Dragging up
                    else if (currentRowIndex < lastDraggedIndex) {
                        for (let i = lastDraggedIndex; i > currentRowIndex; i--) {
                            $('.customerManagementTable tr').eq(i + 1).find('td').eq(startColumnIndex).removeClass('cell_dragging');
                        }
                    }

                    lastDraggedIndex = currentRowIndex;
                }
            }
        }
    });

    // Handle mouse up (stop cell_dragging)
    $(document).on('mouseup', function() {
        let customerIDs = [];
        let category = "";
        let column = "";
        let billEndDates = [];
        let customerNames = [];
        let displayColumnName = "";
        let displayValueOnText = "";

        if (cell_dragging) {
            $('.customerManagementTable td.cell_dragging').each(function() {
                let customerID = $(this).find('input, select').attr('data-id');
                let customerName = $(this).find('input, select').attr('data-customername');
                customerIDs.push(customerID)
                customerNames.push(' ' + customerName);

                let billEndDate = null;
                if (column == "contract_term") {
                    let billStartDate = $('input[data-id="' + customerID + '"][data-column="bill_start_date"]').val();
                    let contractTerm = $('select[data-id="' + customerIDs[0] + '"][data-column="contract_term"]').val();
                    if (billStartDate && contractTerm) {
                        let startDate = new Date(billStartDate);
                        startDate.setMonth(startDate.getMonth() + parseInt(contractTerm));
                        billEndDate = startDate.toISOString().split('T')[0];
                    }
                } else if (column == "bill_start_date") {
                    let contractTerm = $('select[data-id="' + customerIDs[0] + '"][data-column="contract_term"]').val();
                    let billStartDate = $('input[data-id="' + customerID + '"][data-column="bill_start_date"]').val();
                    if (billStartDate && contractTerm) {
                        let startDate = new Date(billStartDate);
                        startDate.setMonth(startDate.getMonth() + parseInt(contractTerm));
                        billEndDate = startDate.toISOString().split('T')[0];
                    }
                }
                billEndDates.push(billEndDate);
            });


            Swal.fire({
                icon: "warning",
                title: "Multiple Cell Update",
                html: "Do you want to apply changes in column <strong>" + columnName + "</strong> for customers <strong>" + customerNames + "</strong>?<br><hr><strong class='text-success'>" + valueOnText + "</strong> value will apply",
                showCancelButton: true,
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    category = $('.customerManagementTable td.cell_dragging').find('input, select').attr('data-category');
                    column = $('.customerManagementTable td.cell_dragging').find('input, select').attr('data-column');

                    if (initialValue && customerIDs.length != 1) {
                        let ajaxData = {
                            id: customerIDs,
                            category: "cell_grid_update",
                            dataCategory: category,
                            column: column,
                            value: initialValue,
                            displayColumnName: columnName,
                            displayValueOnText: valueOnText,
                        };

                        if (column == "contract_term" || column == "bill_start_date") {
                            if (typeof billEndDates !== 'undefined') {
                                ajaxData.bill_end_date = billEndDates;
                            }
                        }

                        $.ajax({
                            type: "POST",
                            url: URL_ORIGIN + "/Customer/customerServersideLoadSave",
                            data: ajaxData,
                            beforeSend: function() {
                                Swal.fire({
                                    icon: "info",
                                    title: "Updating " + customerIDs.length + " Row cells",
                                    html: "Please wait while the update process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            },
                            success: function(response) {
                                $('.customerManagementTable').DataTable().draw(false); 
                                $('.updateHistoryTable').DataTable().draw(false); 
                                $('.customerManagementTable td.cell_dragging').each(function() {
                                    if (initialValue) {
                                        let selectElement = $(this).find('select');
                                        let inputElement = $(this).find('input');
                                        let inputType = inputElement.attr('type');

                                        if (inputType === 'text') {
                                            inputElement.val(initialValue);
                                            $(this).find('.textPreview').text(initialValue);
                                        } else if (inputType === 'date') {
                                            inputElement.val(initialValue);
                                            let dateParts = initialValue.split('-');
                                            let formatted = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
                                            $(this).closest('td').find('.textPreview').text(formatted);
                                        } else if (inputType === 'number') {
                                            inputElement.val(initialValue);
                                            $(this).find('.textPreview').text("$" + initialValue);
                                        }

                                        if (selectElement.length > 0) {
                                            selectElement.val(initialValue);
                                            let initialSelectedOption = selectElement.find('option:selected').text();
                                            $(this).find('.textPreview').text(initialSelectedOption);
                                        }

                                    }
                                });

                                if (column == "contract_term" || column == "bill_start_date") {
                                    customerIDs.forEach((customerID, index) => {
                                        let billEndDate = billEndDates[index];
                                        if (billEndDate) {
                                            let dateParts = billEndDate.split('-');
                                            let formattedDate = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
                                            $('input[data-id="' + customerID + '"][data-column="bill_end_date"]').val(billEndDate).change();
                                            $('input[data-id="' + customerID + '"][data-column="bill_end_date"]').closest('td').find('.textPreview').text(formattedDate);
                                        }
                                    });
                                }
                                iziToast.success({
                                    displayMode: 2,
                                    message: 'Multiple Cells updated successfully!',
                                    timeout: 3000,
                                    position: 'topCenter',
                                });
                                $('.drag_handle').css('visibility', 'hidden');
                                $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                                Swal.close();
                            },
                            error: function() {
                                iziToast.error({
                                    message: 'Unable to save changes due to network error.',
                                    timeout: 3000,
                                    position: 'topCenter',
                                });
                                $('.drag_handle').css('visibility', 'hidden');
                                $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                                Swal.close();
                            },
                        });
                    }
                } else {
                    $('.drag_handle').css('visibility', 'hidden');
                    $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                }
            });
        }
        $('.customerManagementTable td').removeClass('cell_dragging_action');
        cell_dragging = false;
    });

    // Keyboard selection for cells (up and down)
    $(document).on('keydown', function(event) {
        const currentCell = $('.customerManagementTable td.cell_dragging').last();

        if (event.shiftKey && (event.key === "ArrowDown" || event.key === "ArrowUp")) {
            event.preventDefault();

            if (!startCell) {
                startCell = currentCell;
            }

            let nextCell;
            const currentRow = currentCell.parent();
            const columnIndex = currentCell.index();

            if (event.key === "ArrowDown") {
                nextCell = currentRow.next().find('td').eq(columnIndex);
            } else if (event.key === "ArrowUp") {
                nextCell = currentRow.prev().find('td').eq(columnIndex);
            }

            if (nextCell.length) {
                nextCell.addClass('cell_dragging');
                selectedCells.push(nextCell);
            }
        }

        // Handle Ctrl + Shift + Arrow Down to select all cells below
        if (event.ctrlKey && event.shiftKey && event.key === "ArrowDown") {
            event.preventDefault();

            const columnIndex = currentCell.index();
            let currentRow = currentCell.parent();

            while (currentRow.length) {
                const cells = currentRow.find('td').eq(columnIndex);
                if (cells.length) {
                    cells.addClass('cell_dragging');
                    selectedCells.push(cells);
                }
                currentRow = currentRow.next();
            }
        }
    });

    // $(document).on('click', function(event) {
    //     if (!$(event.target).closest('.customerManagementTable td').length && !$(event.target).closest('.swal2-container').length) {
    //         $('.customerManagementTable td').removeClass('cell_dragging').find('.drag_handle').attr('style', 'visibility: hidden;');
    //     }
    // });

    // Prevent specific key combinations
    $(document).on('keydown', function(event) {
        if ((event.shiftKey && (event.key === 'ArrowLeft' || event.key === 'ArrowRight')) ||
            (event.shiftKey && event.ctrlKey && (event.key === 'ArrowLeft' || event.key === 'ArrowRight'))) {
            event.preventDefault();
        }
    });

    // Reset dragging state when Shift is released
    $(document).on('keyup', function(event) {
        let customerIDs = [];
        let category = "";
        let column = "";
        let billEndDates = [];
        let customerNames = [];
        let displayColumnName = "";
        let displayValueOnText = "";
        
        if (event.key === "Shift") {
            if ($('.cell_dragging').length > 1) {
                const firstSelectedCell = $('.customerManagementTable td.cell_dragging').first();
                const firstInputElement = firstSelectedCell.find('input, select');
                if (firstInputElement.length) {
                    initialValue = firstInputElement.val();
                }

                $('.customerManagementTable td.cell_dragging').each(function() {
                    const inputElement = $(this).find('input, select');
                    const customerID = $(this).find('input, select').attr('data-id');
                    const customerName = $(this).find('input, select').attr('data-customername');
                    customerIDs.push(customerID);
                    customerNames.push(' ' + customerName);
                    category = inputElement.attr('data-category');
                    column = inputElement.attr('data-column');

                    let billEndDate = null;
                    if (column == "contract_term") {
                        let billStartDate = $('input[data-id="' + customerID + '"][data-column="bill_start_date"]').val();
                        let contractTerm = $('select[data-id="' + customerIDs[0] + '"][data-column="contract_term"]').val();
                        if (billStartDate && contractTerm) {
                            let startDate = new Date(billStartDate);
                            startDate.setMonth(startDate.getMonth() + parseInt(contractTerm));
                            billEndDate = startDate.toISOString().split('T')[0];
                        }
                    } else if (column == "bill_start_date") {
                        let contractTerm = $('select[data-id="' + customerIDs[0] + '"][data-column="contract_term"]').val();
                        let billStartDate = $('input[data-id="' + customerID + '"][data-column="bill_start_date"]').val();
                        if (billStartDate && contractTerm) {
                            let startDate = new Date(billStartDate);
                            startDate.setMonth(startDate.getMonth() + parseInt(contractTerm));
                            billEndDate = startDate.toISOString().split('T')[0];
                        }
                    }
                    billEndDates.push(billEndDate);
                });

                Swal.fire({
                    icon: "warning",
                    title: "Multiple Cell Update",
                    html: "Do you want to apply changes in column <strong>" + columnName + "</strong> for customers <strong>" + customerNames + "</strong>?<br><hr><strong class='text-success'>" + valueOnText + "</strong> value will apply",
                    showCancelButton: true,
                    confirmButtonText: "Proceed",
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (customerIDs.length > 0) {
                            const ajaxData = {
                                id: customerIDs,
                                category: "cell_grid_update",
                                dataCategory: category,
                                column: column,
                                value: initialValue,
                                displayColumnName: columnName,
                                displayValueOnText: valueOnText,
                            };

                            if (column === "contract_term" || column === "bill_start_date") {
                                ajaxData.bill_end_date = billEndDates;
                            }

                            $.ajax({
                                type: "POST",
                                url: URL_ORIGIN + "/Customer/customerServersideLoadSave",
                                data: ajaxData,
                                beforeSend: function() {
                                    Swal.fire({
                                        icon: "info",
                                        title: "Updating " + customerIDs.length + " Row cells",
                                        html: "Please wait while the update process is running...",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        },
                                    });
                                },
                                success: function(response) {
                                    $('.customerManagementTable').DataTable().draw(false); 
                                    $('.updateHistoryTable').DataTable().draw(false); 
                                    $('.customerManagementTable td.cell_dragging').each(function() {
                                        if (initialValue) {
                                            let selectElement = $(this).find('select');
                                            let inputElement = $(this).find('input');
                                            let inputType = inputElement.attr('type');

                                            if (inputType === 'text') {
                                                inputElement.val(initialValue);
                                                $(this).find('.textPreview').text(initialValue);
                                            } else if (inputType === 'date') {
                                                inputElement.val(initialValue);
                                                let dateParts = initialValue.split('-');
                                                let formatted = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
                                                $(this).closest('td').find('.textPreview').text(formatted);
                                            } else if (inputType === 'number') {
                                                inputElement.val(initialValue);
                                                $(this).find('.textPreview').text("$" + initialValue);
                                            }

                                            if (selectElement.length > 0) {
                                                selectElement.val(initialValue);
                                                let initialSelectedOption = selectElement.find('option:selected').text();
                                                $(this).find('.textPreview').text(initialSelectedOption);
                                            }
                                        }
                                    });

                                    if (column == "contract_term" || column == "bill_start_date") {
                                        customerIDs.forEach((customerID, index) => {
                                            let billEndDate = billEndDates[index];
                                            if (billEndDate) {
                                                let dateParts = billEndDate.split('-');
                                                let formattedDate = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
                                                $('input[data-id="' + customerID + '"][data-column="bill_end_date"]').val(billEndDate).change();
                                                $('input[data-id="' + customerID + '"][data-column="bill_end_date"]').closest('td').find('.textPreview').text(formattedDate);
                                            }
                                        });
                                    }
                                    iziToast.success({
                                        displayMode: 2,
                                        message: 'Cells updated successfully!',
                                        timeout: 3000,
                                        position: 'topCenter',
                                    });
                                    $('.drag_handle').css('visibility', 'hidden');
                                    $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                                    selectedCells = [];
                                    startCell = null;
                                    Swal.close();
                                },
                                error: function() {
                                    iziToast.error({
                                        message: 'Unable to save changes due to network error.',
                                        timeout: 3000,
                                        position: 'topCenter',
                                    });
                                    $('.drag_handle').css('visibility', 'hidden');
                                    $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                                    selectedCells = [];
                                    startCell = null;
                                    Swal.close();
                                },
                            });
                        }
                    } else {
                        $('.drag_handle').css('visibility', 'hidden');
                        $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                    }
                });
            }
        }
    });

    $(document).on('input', '.creditCardExpiryInput', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        $(this).val(value);
    });

    $(document).on('keydown', '.creditCardExpiryInput', function(e) {
        let cursorPosition = this.selectionStart;
        let value = $(this).val();

        if (e.key === 'Backspace' && cursorPosition > 0) {
            e.preventDefault();

            let newValue = value.slice(0, cursorPosition - 1) + value.slice(cursorPosition);

            if (newValue.charAt(2) === '/') {
                newValue = newValue.replace('/', '');
            }

            $(this).val(newValue);
            this.setSelectionRange(cursorPosition - 1, cursorPosition - 1);
        }
    });

    $(document).on('keypress', '.creditCardExpiryInput', function(e) {
        let value = $(this).val();
        let cursorPosition = this.selectionStart;

        if (!/\d/.test(e.key)) {
            e.preventDefault();
        }

        if (cursorPosition === 2 && e.key !== 'Backspace') {
            $(this).val(value + '/');
            this.setSelectionRange(cursorPosition + 1, cursorPosition + 1);
        }
    });

    $(document).on('change', '.displayCustomerList', function() {
        const value = $(this).val();
        if (value == '500') {
            Swal.fire({
                icon: "warning",
                title: "Show All Entries",
                html: "Are you sure you want to show 500 entries?<br><small class='text-muted'>(Displaying more than 100 entries may cause slow response.)</small>",
                showCancelButton: true,
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "info",
                        title: "Showing 500 Entries",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                    customerManagementTable.page.len(value).draw().on('draw', function() {
                        Swal.close();
                    });
                } else {
                    $('.displayCustomerList').val(10).change();
                }
            });
        } else if (value == '100') {
            Swal.fire({
                icon: "info",
                title: "Showing 100 Entries",
                html: "Please wait while the process is running...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
            customerManagementTable.page.len(value).draw().on('draw', function() {
                Swal.close();
            });
        } else {
            customerManagementTable.page.len(value).draw();
        }
    });

    $(document).on('click', '.scrollToLeft', function() {
        if (horizontalScroll > 0) {
            horizontalScroll -= 300;
            $('.tableUpdaterDiv').animate({
                scrollLeft: horizontalScroll
            }, 200);
        }
    });

    $(document).on('click', '.scrollToRight', function() {
        const container = $('.tableUpdaterDiv');
        const maxScrollLeft = container[0].scrollWidth - container.outerWidth();

        if (horizontalScroll < maxScrollLeft) {
            horizontalScroll += 300;
            if (horizontalScroll > maxScrollLeft) {
                horizontalScroll = maxScrollLeft;
            }
            container.animate({
                scrollLeft: horizontalScroll
            }, 200);
        }
    });

    $(document).on('click', '.scrollToStart', function() {
        horizontalScroll = 0;
        $('.tableUpdaterDiv').animate({
            scrollLeft: horizontalScroll
        }, 200);
    });

    $(document).on('click', '.scrollToEnd', function() {
        const container = $('.tableUpdaterDiv');
        const maxScrollLeft = container[0].scrollWidth - container.outerWidth();
        horizontalScroll = maxScrollLeft;
        container.animate({
            scrollLeft: horizontalScroll
        }, 200);
    });

    $(document).on('click', '.textPreview', function() {
        $(this).hide();
        $(this).closest('td').find('.inputMode').show();
    });

    $(document).on('click', '.cancelEdit', function() {
        $(this).closest('td').find('.textPreview').show();
        $(this).closest('td').find('.inputMode').hide();
    });

    $(document).on('click', '.saveChanges', function() {
        valueOnText = $(this).closest('td').find('.updateInputValue').is('select') ? $(this).closest('td').find('.updateInputValue option:selected').text() : $(this).closest('td').find('.updateInputValue').val();
        currentInputElement = $(this).closest('td');
        const updateID = $(this).closest('td').find('.updateInputValue').attr('data-id');
        const updateCategory = $(this).closest('td').find('.updateInputValue').attr('data-category');
        const updateColumn = $(this).closest('td').find('.updateInputValue').attr('data-column');
        const updateValue = $(this).closest('td').find('.updateInputValue').val();
        const customerName = $(this).closest('td').find('.updateInputValue').attr('data-customername');

        if ($(this).closest('td').find('.updateInputValue').is('select')) {
            const option = $(this).closest('td').find('.updateInputValue').find('option:selected').text()
            $(this).closest('td').find('.textPreview').text(option);
        } else if ($(this).closest('td').find('.moneyInput').is('input[type="number"]')) {
            let moneyValue = parseFloat($(this).closest('td').find('.moneyInput').val());
            if (!isNaN(moneyValue)) {
                let formattedMoney = moneyValue.toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                });
                $(this).closest('td').find('.textPreview').text(formattedMoney);
            } else {
                $(this).closest('td').find('.textPreview').text("<small><i>Not Specified</i></small>");
            }
        } else {
            if ($(this).closest('td').find('.updateInputValue').is('input[type="date"]')) {
                let dateValue = $(this).closest('td').find('.updateInputValue').val();
                if (dateValue) {
                    let dateParts = dateValue.split('-');
                    let formattedDate = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
                    $(this).closest('td').find('.textPreview').text(formattedDate);
                } else {
                    $(this).closest('td').find('.textPreview').text("<small><i>Not Specified</i></small>");
                }
            } else {
                $(this).closest('td').find('.textPreview').text(updateValue);
            }
        }

        $('.updateID').val(updateID);
        $('.updateCategory').val(updateCategory);
        $('.updateColumn').val(updateColumn);
        $('.updateValue').val(updateValue);

        if (updateValue == "") {
            $(this).closest('td').find('.textPreview').html('<small class="text-muted"><i>Not Specified</i></small>');
        }

        saveSpecificColumnEntry(updateID, updateCategory, updateColumn, updateValue, valueOnText, columnName, customerName);
    });

    $(document).on('click', '.applyRevert', function() {
        const updateID = $(this).attr('data-id');
        const updateCategory = $(this).attr('data-category');
        const updateColumn = $(this).attr('data-column');
        const updateValue = $(this).attr('data-value');
        const valueOnText = $(this).attr('data-displayvalueontext');
        const columnName = $(this).attr('data-displaycolumnname');
        const customerName = $(this).attr('data-displaycustomername');
        saveSpecificColumnEntry(updateID, updateCategory, updateColumn, updateValue, valueOnText, columnName, customerName);
    });

    $('.paginate_button').attr('tabindex', '-1');

    $(document).on('draw.dt', function() {
        $('.paginate_button').attr('tabindex', '-1');
    });

    $(document).on('click', '.paginate_button', function() {
        $('.paginate_button').attr('tabindex', '-1');
    });

    function validateDecimal(input) {
        let value = input.value;
        let decimalIndex = value.indexOf('.');

        if (decimalIndex >= 0) {
            let decimalPart = value.substring(decimalIndex + 1);
            if (decimalPart.length > 2) {
                input.value = value.substring(0, decimalIndex + 3);
            }
        }
    }

    function saveSpecificColumnEntry(updateID, updateCategory, updateColumn, updateValue, valueOnText, columnName, customerName) {
        let billEndDate = null;
        let ajaxData = {
            id: updateID,
            category: updateCategory,
            column: updateColumn,
            value: updateValue,
            displayColumnName: columnName,
            displayValueOnText: valueOnText,
        };

        if (updateColumn == "contract_term") {
            let billStartDate = $('input[data-id="' + updateID + '"][data-column="bill_start_date"]').val();
            let contractTerm = updateValue;

            if (billStartDate) {
                let startDate = new Date(billStartDate);
                startDate.setMonth(startDate.getMonth() + parseInt(contractTerm));
                billEndDate = startDate.toISOString().split('T')[0];
                ajaxData.bill_end_date = billEndDate;
            }
        } else if (updateColumn == "bill_start_date") {
            let contractTerm = $('select[data-id="' + updateID + '"][data-column="contract_term"]').val();
            let billStartDate = updateValue;

            if (contractTerm) {
                let startDate = new Date(billStartDate);
                startDate.setMonth(startDate.getMonth() + parseInt(contractTerm));
                billEndDate = startDate.toISOString().split('T')[0];
                ajaxData.bill_end_date = billEndDate;
            }
        }

        Swal.fire({
            icon: "warning",
            title: "Cell Update",
            html: "Do you want to apply changes in column <strong>" + columnName + "</strong> for customer <strong>" + customerName + "</strong>?<br><hr><strong class='text-success'>" + valueOnText + "</strong> value will apply",
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: URL_ORIGIN + "/Customer/customerServersideLoadSave",
                    data: ajaxData,
                    beforeSend: function() {
                        Swal.fire({
                            icon: "info",
                            title: "Updating a cell",
                            html: "Please wait while the update process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function(response) {
                        $('.customerManagementTable').DataTable().draw(false); 
                        $('.updateHistoryTable').DataTable().draw(false); 
                        iziToast.success({
                            displayMode: 2,
                            message: 'Cell updated successfully!',
                            timeout: 3000,
                            position: 'topCenter',
                        });
                        currentInputElement.find('.textPreview').show();
                        currentInputElement.find('.inputMode').hide();
                        $('.drag_handle').css('visibility', 'hidden');
                        $('.customerManagementTable > tbody > tr > td').removeClass('cell_dragging');
                        if (updateColumn == "contract_term" || updateColumn == "bill_start_date") {
                            let dateParts = billEndDate.split('-');
                            let formattedDate = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
                            $('input[data-id="' + updateID + '"][data-column="bill_end_date"]').val(billEndDate).change();
                            $('input[data-id="' + updateID + '"][data-column="bill_end_date"]').closest('td').find('.textPreview').text(formattedDate);
                        }
                        Swal.close();
                    },
                    error: function() {
                        iziToast.info({
                            message: 'Retrying, please wait..',
                            timeout: 3000,
                            position: 'topCenter',
                        });
                        iziToast.error({
                            message: 'Unable to save changes due to network error.',
                            timeout: 3000,
                            position: 'topCenter',
                        });
                        setTimeout(() => {
                            saveSpecificColumnEntry(updateID, updateCategory, updateColumn, updateValue, valueOnText, columnName, customerName);
                        }, 3000);
                    },
                });
            }
        });
    }
</script>