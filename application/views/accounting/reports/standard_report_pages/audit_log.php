<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    #myTabContent .action-bar ul li a:after {
        width: 0;
    }
    #myTabContent .action-bar ul li a {
    font-size: 20px;
    }
    #myTabContent .action-bar ul li {
        margin-right: 5px;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn {
        color: #6B6C72;
        border: 0;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Audit Log</h3>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="user">User</label>
                                                    <select name="user" id="user" class="form-control">
                                                        <option value="all-users">All Users</option>
                                                        <?php foreach($company_users as $companyUser) : ?>
                                                        <option value="<?=$companyUser->id?>"><?=$companyUser->FName.' '.$companyUser->LName?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="date-changed">Date changed</label>
                                                    <select name="date_changed" id="date-changed" class="form-control">
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
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="events">Events</label>
                                                    <select name="events" id="events" class="form-control">
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-logs"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" id="col-date-changed">
                                                            <label for="col-date-changed">Date changed</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" id="col-user">
                                                            <label for="col-user">User</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" id="col-event">
                                                            <label for="col-event">Event</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" id="col-history">
                                                            <label for="col-history">History</label>
                                                        </div>
                                                        <p class="m-0">Page Size</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="radio" id="page-size-25" name="page_size">
                                                            <label for="page-size-25">25</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="radio" id="page-size-50" name="page_size" checked>
                                                            <label for="page-size-50">50</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="radio" id="page-size-100" name="page_size">
                                                            <label for="page-size-100">100</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="radio" id="page-size-500" name="page_size">
                                                            <label for="page-size-500">500</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <table id="audit-logs-table" class="table table-bordered table-hover">
									<thead>
                                        <tr>
                                            <th class="date-changed">DATE CHANGED</th>
                                            <th class="user">USER</th>
                                            <th class="event">EVENT</th>
                                            <th>NAME</th>
                                            <th>DATE</th>
                                            <th>AMOUNT</th>
                                            <th class="history">HISTORY</th>
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
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000019</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000018</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Check</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000017</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Expense</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000016</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000015</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Deleted Time Charge</td>
                                            <td>Test Cust</td>
                                            <td>08/01/2021</td>
                                            <td></td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Deleted Time Charge</td>
                                            <td>Test Cust</td>
                                            <td>08/01/2021</td>
                                            <td></td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Deleted Time Charge</td>
                                            <td>Test Cust</td>
                                            <td>08/01/2021</td>
                                            <td></td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000014</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000013</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000012</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000011</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000010</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000009</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Expense</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000008</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000007</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000006</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000005</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000004</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000003</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000002</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Aug 1, 5:24 pm Philippine Standard Time</td>
                                            <td>System Administration</td>
                                            <td>Added Invoice No. INV-0000000001</td>
                                            <td>Loucelle Emperio</td>
                                            <td>08/01/2021</td>
                                            <td>$49.91</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                    </tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>