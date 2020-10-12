<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-4">
                        <h2>Audit Log</h2>
                    </div>
                </div>
                <div class="row align-items-center filter-logs" style="padding:20px; background: #ffffff;">
                    <div class="col-md-12">
                        <div class="dropdown" style="margin-top: 20px">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px 20px 20px 20px">Filter
                                <span class="fa fa-caret-down"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li style="padding: 30px 30px 30px 30px">
                                    <form action="" method="" class="">
                                        <div class="" style="max-width: 200px">
                                            <label for="type">User</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="">All User</option>
                                                <option value="">Jerry Tiu</option>
                                            </select>
                                        </div>
                                        <div class="">
                                            <div style="position: relative; display: inline-block;">
                                                <label for="">Date</label>
                                                <select name="status" id="type" class="form-control" style="width: 100%">
                                                    <option value="">All statuses</option>
                                                    <option value="">Open</option>
                                                    <option value="">Overdue</option>
                                                    <option value="">Paid</option>
                                                </select>
                                            </div>
                                            <div style="position:relative; display: inline-block;float: right;margin-left: 10px">
                                                <label for="">From</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div style="position:relative; display: inline-block;float: right;margin-left: 10px">
                                                <label for="">To</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="events_filter">Events</label>
                                            <input type="radio" id="events_filter" class="" style="position: relative;display: block;margin-bottom: 8px">
                                            <input type="radio" id="events_filter" class="" style="position: relative;display: block;">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Sign in/sign out</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Budgets</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Recurring templates</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Settings</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Reconciliations</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Transactions</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Lists</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Time events</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Statements</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Sales customizations</label>
                                                </div>
                                                <div style="margin-left: 12px">
                                                    <input type="checkbox">
                                                    <label for="">Data exchange</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                            <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                 <span class="print-settings">
                                    <a href=""><i class="fa fa-print fa-lg"></i></a>
                                    <a href=""><i class="fa fa-cog fa-lg"></i></a>
                                 </span>
                            </div>
                        </div>
                        <table id="auditLog-tbl" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                            <thead>
                            <tr>
                                <th>Date Changed</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>History</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Jul 10, 2:42 pm </td>
                                <td>Nik Estrada</td>
                                <td>Added Deposit No. INTEREST</td>
                                <td></td>
                                <td>07/09/2020</td>
                                <td>$10.00</td>
                                <td><a href="">View</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // DataTable JS
    $(document).ready(function() {
        $('#auditLog-tbl').DataTable({
            "paging": false,
            "filter":false
        });
    } );
</script>



