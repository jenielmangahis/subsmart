<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-user">User</label>
                                        <select class="nsm-field form-select" name="filter_user" id="filter-user">
                                            <option value="all-users">All Users</option>
                                            <?php foreach($company_users as $companyUser) : ?>
                                            <option value="<?=$companyUser->id?>"><?=$companyUser->FName.' '.$companyUser->LName?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-date-changed">Date Changed</label>
                                        <select class="nsm-field form-select" name="filter_date_changed" id="filter-date-changed">
                                            <option value="custom">Custom</option>
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="this-week">This Week</option>
                                            <option value="this-month" selected>This Month</option>
                                            <option value="this-quarter">This Quarter</option>
                                            <option value="this-year">This Year</option>
                                            <option value="last-week">Last Week</option>
                                            <option value="last-month">Last Month</option>
                                            <option value="last-quarter">Last Quarter</option>
                                            <option value="last-year">Last Year</option>
                                            <option value="last-seven-years">Last Seven Years</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-events">Events</label>
                                        <select class="nsm-field form-select" name="filter_events" id="filter-events">
                                            <option value="all-events" selected>All events</option>
                                            <option value="all-transactions">All transactions</option>
                                            <option value="budgets">Budgets</option>
                                            <option value="date-exchange">Date exchange</option>
                                            <option value="deleted-voided-transactions">Deleted/Voided transactions</option>
                                            <option value="lists">Lists</option>
                                            <option value="permissions-changes">Permissions changes</option>
                                            <option value="reconciliations">Reconciliations</option>
                                            <option value="recurring-templates">Recurring templates</option>
                                            <option value="revalued-currencies">Revalued currencies</option>
                                            <option value="sales-customizations">Sales customizations</option>
                                            <option value="settings">Settings</option>
                                            <option value="sign-in-sign-out">Sign in/sign out</option>
                                            <option value="statements">Statements</option>
                                            <option value="time-events">Time events</option>
                                        </select>
                                    </div>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" id="col-date-changed" class="form-check-input">
                                    <label for="col-date-changed" class="form-check-label">Date changed</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" id="col-user" class="form-check-input">
                                    <label for="col-user" class="form-check-label">User</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" id="col-event" class="form-check-input">
                                    <label for="col-event" class="form-check-label">Event</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" id="col-history" class="form-check-input">
                                    <label for="col-history" class="form-check-label">History</label>
                                </div>
                                <p class="m-0">Page Size</p>
                                <div class="form-check">
                                    <input type="checkbox" id="size-25" class="form-check-input">
                                    <label for="size-25" class="form-check-label">25</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" id="size-50" class="form-check-input">
                                    <label for="size-50" class="form-check-label">50</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="size-100" class="form-check-input">
                                    <label for="size-100" class="form-check-label">100</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="size-500" class="form-check-input">
                                    <label for="size-500" class="form-check-label">500</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Date Changed">DATE CHANGED</td>
                            <td data-name="User">USER</td>
                            <td data-name="Event">EVENT</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="History">HISTORY</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000020</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000019</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000018</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Check</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000017</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Expense</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000016</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000015</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Deleted Time Charge</td>
                            <td>Test Cust</td>
                            <td>08/01/2021</td>
                            <td></td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Deleted Time Charge</td>
                            <td>Test Cust</td>
                            <td>08/01/2021</td>
                            <td></td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Deleted Time Charge</td>
                            <td>Test Cust</td>
                            <td>08/01/2021</td>
                            <td></td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000014</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000013</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000012</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000011</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000010</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000009</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Expense</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000008</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000007</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000006</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000005</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000004</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000003</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000002</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                        <tr>
                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                            <td>System Administration</td>
                            <td>Added Invoice No. INV-0000000001</td>
                            <td>Loucelle Emperio</td>
                            <td>08/01/2021</td>
                            <td>$49.91</td>
                            <td class="fw-bold nsm-text-primary nsm-link default">View</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>