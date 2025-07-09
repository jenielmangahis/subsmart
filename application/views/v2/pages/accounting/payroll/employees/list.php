<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/employees_modals'); ?>
<?php include viewPath('v2/includes/accounting/modal_forms/payroll_modal'); ?>
<style>
    table.dataTable thead th, 
    table.dataTable thead td {
        padding: 10px 10px !important;
        border-bottom: 1px solid #e8e8e8 !important;
    }

    table.dataTable.no-footer {
        border-bottom: unset !important;
    }

    .dataTables_length,
    .dataTables_filter {
        display: none;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Here you will get a detailed summary of pay rate, payment method and the status of each of your employee. With this report, you will be able to forecast a better budget for future weeks.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="nsm-field nsm-search form-control mb-2 w-25" id="search_field" placeholder="Search Employee...">
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="d-inline-block me-2">
                            <select id="status_filter" class="form-select w-auto">
                                <option value="">All Employees</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="d-inline-block me-2">
                            <select id="pay_method_filter" class="form-select w-auto">
                                <option value="">All Pay Method</option>
                                <option value="direct-deposit">Direct deposit</option>
                                <option value="paper-check">Check</option>
                                <option value="Missing">Missing</option>
                            </select>
                        </div>
                        <div class="d-inline-block me-2">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>More actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="run-payroll">Run payroll</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="bonus-only">Bonus only</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="commission-only">Commission only</a></li>
                            </ul>
                        </div>
                        <div class="d-inline-block me-2">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add_employee_modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add an employee
                            </button>
                        </div>
                        <!-- <div class="d-inline-block">
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Show columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHidePayRate" name="col_chk" class="form-check-input">
                                    <label for="showHidePayRate" class="form-check-label">Pay rate</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHidePayMethod" name="col_chk" class="form-check-input">
                                    <label for="showHidePayMethod" class="form-check-label">Pay method</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHideStatus" name="col_chk" class="form-check-input">
                                    <label for="showHideStatus" class="form-check-label">Status</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHideEmailAddress" name="col_chk" class="form-check-input">
                                    <label for="showHideEmailAddress" class="form-check-label">Email address</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHidePhoneNum" name="col_chk" class="form-check-input">
                                    <label for="showHidePhoneNum" class="form-check-label">Phone number</label>
                                </div>
                                <div class="form-check form-switch nsm-switch">
                                    <label for="privacy" class="form-check-label">Privacy </label>
                                    <input type="checkbox" name="privacy" id="privacy" class="form-check-input">
                                </div>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="employeeTable" class="nsm-table w-100">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>PAY SCALE</th>
                                        <th>PAY METHOD</th>
                                        <th>STATUS</th>
                                        <th>EMAIL</th>
                                        <th>PHONE NO.</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>

<script>
    // DataTable Configuration ===============
    var employee_table = $('#employeeTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
            "url": "<?php echo base_url('accounting_controllers/employees/getEmployeeServerside/'); ?>",
            "type": "POST",
        },
        "language": {
            "infoFiltered": "",
        },
        // "order": [[0, 'desc'] ],
    });

    $(document).on('keyup', '#search_field', function() {
        employee_table.search($(this).val()).draw();
    });

    $(document).on('change', '#status_filter', function() {
        employee_table.column(6).search($(this).val()).draw();
    });

    $(document).on('change', '#pay_method_filter', function() {
        employee_table.column(3).search($(this).val()).draw();
    });

    function showHideColumn(id) {
        alert(id);
    }

    $('input[name="col_chk"]').change(function (e) { 
        const checkbox = $(this);
        const checkboxID = $(this).attr('id');
        switch (checkboxID) {
            case 'showHidePayRate':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(2), #employeeTable td:nth-child(2)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(2), #employeeTable td:nth-child(2)').hide();
                }
                break;
            case 'showHidePayMethod':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(3), #employeeTable td:nth-child(3)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(3), #employeeTable td:nth-child(3)').hide();
                }
                break;
            case 'showHideStatus':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(4), #employeeTable td:nth-child(4)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(4), #employeeTable td:nth-child(4)').hide();
                }
                break;
            case 'showHideEmailAddress':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(5), #employeeTable td:nth-child(5)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(5), #employeeTable td:nth-child(5)').hide();
                }
                break;
            case 'showHidePhoneNum':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(6), #employeeTable td:nth-child(6)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(6), #employeeTable td:nth-child(6)').hide();
                }
                break;
        }
    });

</script>