<?php
if ($this->session->userdata('usertimezone') == null) {
    $_SESSION['usertimezone'] = json_decode(get_cookie('logged'))->usertimezone;
    $_SESSION['offset_zone'] = json_decode(get_cookie('logged'))->offset_zone;
    if ($this->session->userdata('usertimezone') == null) {
        $_SESSION['usertimezone'] = "UTC";
        $_SESSION['offset_zone'] = "GMT";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>nSmarTrac</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/accounting/accounting-modal-forms.css")?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/main.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/media.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/general-style.css") ?>">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/boxicons.min.css") ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap.min.css") ?>" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= base_url("assets/css/v2/google-font.css") ?>" rel="stylesheet">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/sweetalert2.min.css") ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url("assets/plugins/select2/dist/css/select2.min.css") ?>" />
    <!-- Datepicker -->
    <link rel="stylesheet"
        href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-tagsinput.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap-datetimepicker.min.css") ?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <!-- Multi select -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/multiple-select.min.css") ?>">

    <!-- Switchery -->
    <link rel="stylesheet" href="<?= base_url("assets/plugins/switchery/switchery.min.css") ?>">

    <!-- Dropzone -->
    <link rel="stylesheet" href="<?=base_url("assets/plugins/dropzone/dist/dropzone.css")?>">

    
    <!-- added  -->
    <!--Morris Chart CSS -->
    <link rel="stylesheet"
        href="<?php echo $url->assets ?>plugins/morris.js/morris.css">

    <!-- <link href="<?php echo $url->assets ?>dashboard/css/style.css"
        rel="stylesheet" type="text/css"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <!--<script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
    <!-- <link href="<?php echo $url->assets ?>libs/jcanvas/global.css"
    rel="stylesheet"> -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <link
        href="<?php echo $url->assets ?>css/jquery.dataTables.min.css"
        rel="stylesheet" type="text/css"> -->

    <script src="<?php echo $url->assets ?>push_notification/push.js"></script>
    <script
        src="<?php echo $url->assets ?>push_notification/serviceWorker.min.js">
    </script>

<script src="<?php echo $url->assets ?>frontend/js/report/main.js"></script>

    <!-- taxes page -->
    <link
        href="<?php echo $url->assets ?>dashboard/css/responsive.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url->assets ?>dashboard/css/slick.min.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url->assets ?>dashboard/css/slick-theme.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- taxes page -->
    <!--    Clock CSS-->
    <link href="<?php echo $url->assets ?>css/timesheet/clock.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url->assets ?>css/notification/notification.css"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons" type="text/css">
    <!--    ICONS CSS-->
    <link href="<?php echo $url->assets ?>css/icons/icon.navbar.css"
        rel="stylesheet" type="text/css">


    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <?php
    if ($this->uri->segment(2) != "tracklocation" && $this->uri->segment(1) != "trac360") {
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU" async></script>';
    }
    ?>

    <!-- Jquery JS -->
    <!-- <script src="<?= base_url("assets/js/v2/jquery-3.6.0.min.js") ?>"></script> -->
    <!-- <script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script> -->
    <script>
        var base_url = '<?= base_url() ?>';
        var surveyBaseUrl = '<?= base_url() ?>';
    </script>

    <!-- newly added script/link -->
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/font-awesome/css/font-awesome.min.css">
    <?php echo put_header_assets(); ?>
        
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script>
    <style>
        .nsm-nav-items #clockOut i{
            color: "green";
        }
    </style>
    
</head>


<body>
    
<input type="hidden" id="siteurl"
            value="<?php echo url(); ?>">
    <div class="nsm-container">
        <div class="nsm-sidebar-bg general-transition" style="min-height: 100%;"></div>
        <div class="nsm-sidebar general-transition">
            <div class="nsm-sidebar-logo">
                <a href="javascript:void(0);" class="sidebar-toggler">
                    <i class='bx bx-fw bx-menu-alt-left'></i>
                </a>
                <a class="nsm-logo-link" href="<?= base_url("dashboard") ?>">
                    <img class="nsm-logo" src="<?= base_url("assets/images/v2/logo.png") ?>">
                </a>
            </div>

            <ul class="nsm-sidebar-menu">
                <li>
                    <button type="button" class="nsm-button primary w-100" style="margin: 0" data-bs-toggle="dropdown">
                        <i class="bx bx-fw bx-plus"></i> New
                    </button>
                    <div class="dropdown-menu p-3" id="new-popup">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h5>CUSTOMERS</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="ajax-modal" data-view="invoice_modal" data-toggle="modal" data-target="#invoiceModal">Invoice</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="receive_payment_modal" data-toggle="modal" data-target="#receivePaymentModal">Receive payment</a></li>
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#new_estimate_modal">Estimate</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="credit_memo_modal" data-toggle="modal" data-target="#creditMemoModal">Credit memo</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="sales_receipt_modal" data-toggle="modal" data-target="#salesReceiptModal">Sales receipt</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="refund_receipt_modal" data-toggle="modal" data-target="#refundReceiptModal">Refund receipt</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="delayed_credit_modal" data-toggle="modal" data-target="#delayedCreditModal">Delayed credit</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="delayed_charge_modal" data-toggle="modal" data-target="#delayedChargeModal">Delayed charge</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>VENDORS</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="ajax-modal" data-view="expense_modal" data-toggle="modal" data-target="#expenseModal">Expense</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="check_modal" data-toggle="modal" data-target="#checkModal">Check</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="bill_modal" data-toggle="modal" data-target="#billModal">Bill</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="pay_bills_modal" data-toggle="modal" data-target="#payBillsModal">Pay bills</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="purchase_order_modal" data-toggle="modal" data-target="#purchaseOrderModal">Purchase order</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="vendor_credit_modal" data-toggle="modal" data-target="#vendorCreditModal">Vendor credit</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="credit_card_credit_modal" data-toggle="modal" data-target="#creditCardCreditModal">Credit card credit</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="print_checks_modal" data-toggle="modal" data-target="#printChecksModal">Print checks</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>EMPLOYEES</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="ajax-modal" data-view="payroll_modal" data-toggle="modal" data-target="#payrollModal">Payroll</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="single_time_activity_modal" data-toggle="modal" data-target="#singleTimeModal">Single time activity</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="weekly_timesheet_modal" data-toggle="modal" data-target="#weeklyTimesheetModal">Weekly timesheet</a></li>
                                    <!-- <li><a href="#" class="ajax-modal" data-view="print_checks_setup_modal" data-toggle="modal" data-target="#printSetupModal">Print checks setup</a></li> -->
                                </ul>
                            </div>
                            <div class="col-12 col-md-3">
                                <h5>OTHER</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="ajax-modal" data-view="bank_deposit_modal" data-toggle="modal" data-target="#depositModal">Bank deposit</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="transfer_modal" data-toggle="modal" data-target="#transferModal">Transfer</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="journal_entry_modal" data-toggle="modal" data-target="#journalEntryModal">Journal entry</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="statement_modal" data-toggle="modal" data-target="#statementModal">Statement</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="inventory_qty_modal" data-toggle="modal" data-target="#inventoryModal">Inventory qty adjustment</a></li>
                                    <li><a href="#" class="ajax-modal" data-view="pay_down_credit_card_modal" data-toggle="modal" data-target="#payDownCreditModal">Pay down credit card</a></li>
                                    <li><a href="<?php echo base_url('accounting/apply-for-capital') ?>">Apply for Capital</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="<?=$page->title === 'Dashboard' ? 'selected' : ''?>">
                    <a href="/accounting/banking">
                        <i class='bx bx-fw bx-tachometer'></i> Dashboard 
                    </a>
                </li>
                <li class="<?=$page->parent === 'Banking' ? 'selected active' : ''?>">
                    <a href="#">
                        <i class='bx bx-fw bx-buildings'></i> Banking
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?=$page->title === 'Link Bank' ? 'selected' : ''?>">
                            <a href="/accounting/link_bank">
                                Link Bank
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Rules' ? 'selected' : ''?>">
                            <a href="/accounting/rules">
                                Rules
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Receipts' ? 'selected' : ''?>">
                            <a href="/accounting/receipts">
                                Receipts
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Tags' ? 'selected' : ''?>">
                            <a href="/accounting/tags">
                                Tags
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?=$page->title === 'Cashflow' ? 'selected' : ''?>">
                    <a href="/accounting/cashflowplanner">
                        <i class='bx bx-fw bx-notepad'></i> Cashflow
                    </a>
                </li>
                <li class="<?=$page->parent === 'Expenses' ? 'selected active' : ''?>">
                    <a href="#">
                        <i class='bx bx-fw bx-book-content'></i> Expenses
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?=$page->title === 'Expenses' ? 'selected' : ''?>">
                            <a href="/accounting/expenses">
                                Expenses
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Vendors' ? 'selected' : ''?>">
                            <a href="/accounting/vendors">
                                Vendors
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?=$page->parent === 'Sales' ? 'selected active' : ''?>">
                    <a href="#">
                        <i class='bx bx-fw bx-line-chart'></i> Sales
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?=$page->title === 'Sales Overview' ? 'selected' : ''?>">
                            <a href="/accounting/sales-overview">
                                <i class='bx bx-fw bx-line-chart'></i> Overview
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Sales Transactions' ? 'selected' : ''?>">
                            <a href="/accounting/all-sales">
                                <i class='bx bx-fw bx-file'></i> All Sales
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Estimates' ? 'selected' : ''?>">
                            <a href="/accounting/newEstimateList">
                                <i class='bx bx-fw bx-chart'></i> Estimates
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Credit Notes' ? 'selected' : ''?>">
                            <a href="/accounting/credit-notes">
                                <i class='bx bx-fw bx-note'></i> Credit Notes
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Customers' ? 'selected' : ''?>">
                            <a href="/accounting/customers">
                                <i class='bx bx-fw bx-group'></i> Customers
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Deposits' ? 'selected' : ''?>">
                            <a href="/accounting/deposits">
                                <i class='bx bx-fw bx-file'></i> Deposits
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Work Order' ? 'selected' : ''?>">
                            <a href="/accounting/workorder">
                                <i class='bx bx-fw bx-task'></i> Work Order
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Invoice' ? 'selected' : ''?>">
                            <a href="/accounting/invoices">
                                <i class='bx bx-fw bx-receipt'></i> Invoice
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Jobs' ? 'selected' : ''?>">
                            <a href="/accounting/jobs">
                                <i class='bx bx-fw bx-message-square-error'></i> Jobs
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Products and Services' ? 'selected' : ''?>">
                            <a href="/accounting/products-and-services">
                                <i class='bx bx-fw bx-box'></i> Products and Services
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?=$page->parent === 'Payroll' ? 'selected active' : ''?>">
                    <a href="#">
                        <i class='bx bx-fw bx-bar-chart-square'></i> Payroll
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?=$page->title === 'Payroll Overview' ? 'selected' : ''?>">
                            <a href="/accounting/payroll-overview">
                                <i class='bx bx-fw bx-line-chart'></i> Overview
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Employees' ? 'selected' : ''?>">
                            <a href="/accounting/employees">
                                <i class='bx bx-fw bx-user-pin'></i> Employees
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Contractors' ? 'selected' : ''?>">
                            <a href="/accounting/contractors">
                                <i class='bx bx-fw bx-group'></i> Contractors
                            </a>
                        </li>
                        <li class="<?=$page->title === "Workers' Comp" ? 'selected' : ''?>">
                            <a href="/accounting/workers-comp">
                                <i class='bx bx-fw bx-group'></i> Workers' Comp
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?=$page->parent === 'Reports' ? 'selected' : ''?>">
                    <a href="/accounting/reports">
                        <i class='bx bx-fw bx-chart'></i> Reports
                    </a>
                </li>
                <li class="<?=$page->parent === 'Taxes' ? 'selected active' : ''?>">
                    <a href="#">
                        <i class='bx bx-fw bx-receipt'></i> Taxes
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?=$page->title === 'Sales Tax' ? 'selected' : ''?>">
                            <a href="/accounting/salesTax">
                                Sales Tax
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Payroll Tax' ? 'selected' : ''?>">
                            <a href="/accounting/payrollTax">
                                Payroll Tax
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?=$page->parent === 'Accounting' ? 'selected active' : ''?>">
                    <a href="#">
                        <i class='bx bx-fw bx-calculator'></i> Accounting
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?=$page->title === 'Chart of Accounts' ? 'selected' : ''?>">
                            <a href="/accounting/chart-of-accounts">
                                Chart of Accounts
                            </a>
                        </li>
                        <li class="<?=$page->title === 'Reconcile' || $page->title === 'Reconciliation Summary' || $page->title === 'History by account' ? 'selected' : ''?>">
                            <a href="/accounting/reconcile">
                                Reconcile
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="nsm-back-to-main-dashboard" style="padding: 2em; margin-top: 10px; position: unset;">
                <a href="<?=base_url("dashboard")?>">
                    <i class='bx bx-fw bx-arrow-back'></i> Go to main Dashboard
                </a>
            </div>
        </div>
        <div class="nsm-main general-transition">
            <div class="nsm-nav">
                <div class="nsm-nav-menu">
                    <a href="javascript:void(0);" class="sidebar-toggler">
                        <i class='bx bx-fw bx-menu-alt-left'></i>
                    </a>
                </div>
                <div class="nsm-page-title">
                    <h4><?= $page->title ?></h4>
                    <?php
                    if ($page->title == 'Dashboard') :
                    ?>
                        <span>Welcome <?php echo getLoggedName(); ?>!</span>
                    <?php
                    else :
                    ?>
                        <?= $page->message; ?>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="nsm-nav-items">
                    <ul>
                        <li>
                            <?php
                            $clock_btn = 'clockIn';
                            $user_id = logged('id');
                            $user_clock_in = getClockInSession();
                            $attendance_id = 0;
                            $analog_active = '';
                            foreach ($user_clock_in as $in) {
                                if ($in->user_id == $user_id && $in->status == 1) {
                                    $clock_btn = 'clockOut';
                                    $attendance_id = $in->id;
                                    $analog_active = 'clock-active';
                                }
                                if ($in->user_id == $user_id && $in->status == 0) {
                                    $clock_btn = 'clockIn';
                                    $attendance_id = $in->id;
                                }
                            }
                            //Employee display shift status
                            $clock_in = '-';
                            $clock_out = '-';
                            $shift_duration = '-';
                            $lunch_time = '00:00:00';
                            $lunch_in = 0;
                            $lunch_out = 0;
                            $latest_lunch_in = 0;
                            $attendances = getEmployeeAttendance();
                            foreach ($attendances as $attn) {
                                $attendance_id = $attn->id;
                                break;
                            }
                            $ts_logs_h = getEmployeeLogs($attendance_id);

                            $attn_id = null;
                            $minutes = 0;
                            //                        $expected_endbreak = null;
                            $shift_end = 0;
                            $overtime_status = 1;
                            // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
                            // $getTimeZone = json_decode($ipInfo);

                            try {
                                $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));
                            } catch (Exception $e) {
                                header("Location: " . base_url() . "/logout");
                            }

                            $checkin_date_time = "";
                            $attendance_status = 0;
                            $overtime_status_acknowledgement = 0;
                            foreach ($attendances as $attn) {
                                $attn_id = $attn->id;
                                if ($attn->overtime_status == 1) {
                                    $overtime_status = 2;
                                } else {
                                    $overtime_status = 1;
                                }

                                $overtime_status_acknowledgement = $attn->overtime_status;


                                foreach ($ts_logs_h as $log) {
                                    if ($log->attendance_id == $attn->id && $attn->status == 1) {
                                        if ($log->action == 'Check in') {
                                            $checkin_date_time = $log->date_created;
                                            $date_created = $log->date_created;
                                            $attendance_status = 1;
                                            $date_created = $log->date_created;
                                            date_default_timezone_set('UTC');
                                            $datetime_defaultTimeZone = new DateTime($date_created);
                                            $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                            $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                            $clock_in = date('h:i A', strtotime($userZone_date_created));
                                            $shift_end = strtotime($log->date_created);
                                            $hours = floor($attn->break_duration / 60);
                                            $minutes = floor($attn->break_duration % 60);
                                            $seconds = $attn->break_duration - (int) $attn->break_duration;
                                            $seconds = round($seconds * 60);
                                            $lunch_time = str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
                                            $analog_active = 'clock-active';
                                        }
                                        if ($log->action == 'Break in') {
                                            $analog_active = 'clock-break';

                                            if ($attn->break_duration > 0) {
                                                $lunch_in = strtotime($log->date_created) - (floor($attn->break_duration * 60));
                                                $latest_lunch_in = strtotime($userZone_date_created);
                                            } else {
                                                $lunch_in = strtotime($log->date_created);
                                                $latest_lunch_in = 0;
                                            }
                                        }
                                        if ($log->action == 'Break out') {
                                            if ($attn->status == 1) {
                                                $analog_active = 'clock-active';
                                                $lunch_time = convertDecimal_to_Time($attn->break_duration, "lunch");
                                            }
                                        }
                                    } elseif ($log->attendance_id == $attn->id && $attn->status == 0) {
                                        $lunch_time = convertDecimal_to_Time($attn->break_duration, "lunch");
                                        $shift_duration = convertDecimal_to_Time($attn->shift_duration + $attn->overtime, "shift diration");
                                        // var_dump($attendance_id);
                                        if ($log->action == "Check in") {
                                            $date_created = $log->date_created;
                                            date_default_timezone_set('UTC');
                                            $datetime_defaultTimeZone = new DateTime($date_created);
                                            $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                            $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                            $clock_in = date('h:i A', strtotime($userZone_date_created));
                                        } elseif ($log->action == "Check out") {
                                            $date_created = $log->date_created;
                                            date_default_timezone_set('UTC');
                                            $datetime_defaultTimeZone = new DateTime($date_created);
                                            $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                            $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                            $clock_out = date('h:i A', strtotime($userZone_date_created));
                                        }
                                    }
                                }
                            }
                            $ts_settings = getEmpTSsettings();
                            $schedule = getEmpSched();
                            $expected_shift = 0;
                            $expected_endshift = 0;
                            $sched_notify = 1;
                            $over_notify = 1;
                            $start = 0;
                            $time_difference = 0;
                            $notification = getNotification($user_id);
                            foreach ($ts_settings as $setting) {
                                foreach ($schedule as $sched) {
                                    if ($setting->id == $sched->schedule_id) {
                                        if ($setting->timezone == null) {
                                            $tz = date_default_timezone_get();
                                        } else {
                                            $tz = $this->session->userdata('usertimezone');
                                        }
                                        $timestamp = time();
                                        $dt = new DateTime("now", new DateTimeZone($tz));
                                        $dt->setTimestamp($timestamp);
                                        if ($sched->start_date == $dt->format('Y-m-d')) {
                                            $expected_shift = strtotime($sched->start_date . " " . $sched->start_time);
                                            $expected_endshift = strtotime($sched->start_date . " " . $sched->end_time);
                                            $start = $sched->start_date;
                                            //                                        Time Difference from server time to employee's set timezone
                                            $time_difference = $dt->format('H') - date('H');
                                        }
                                        foreach ($notification as $u_notify) {
                                            if ($u_notify->user_id == $sched->user_id) {
                                                if ($u_notify->title == 'Your shift will begin soon.' && date('m-d-Y', strtotime($u_notify->date_created)) == $start) {
                                                    $sched_notify = 0;
                                                }
                                            }
                                            if ($u_notify->title == 'Your shift will end soon.' && date('m-d-Y', strtotime($u_notify->date_created)) == $start) {
                                                $over_notify = 0;
                                            }
                                        }
                                    }
                                }
                            }
                            if (empty($expected_shift) && $shift_end > 0 && empty($expected_endshift)) {
                                $shift_end += (28800); /* Clock-in time plus 8 hours */;
                            } else {
                                $shift_end = null;
                            }
                            if ($analog_active == null) {
                                $shift_end = 0;
                                $overtime_status = 2;
                                $expected_endshift = 0;
                            }

                            ?>
                            <input type="hidden" id="clockedin_date_time" value="<?= $checkin_date_time ?>">
                            <input type="hidden" id="attendance_status" value="<?= $attendance_status ?>">
                            <input type="hidden" id="overtime_status_acknowledgement" value="<?= $overtime_status_acknowledgement ?>">
                            <input type="hidden" id="break_duration_for_auto_out" value="<?= $break_duration_for_auto_out ?>">
                            <input type="hidden" id="lunchStartTime" value="<?php echo $lunch_in; ?>" data-value="<?php echo date('h:i A', $lunch_in) ?>">
                            <input type="hidden" id="latestLunchTime" value="<?php echo $latest_lunch_in; ?>" data-value="<?php echo date('h:i A', $latest_lunch_in) ?>">
                            <input type="hidden" id="clock-status" value="<?php echo ($analog_active == 'clock-break') ? 1 : 0; ?>">
                            <input type="hidden" id="attendanceId" value="<?php echo $attn_id; ?>">
                            <input type="hidden" id="employeeShiftStart" value="<?php echo (!empty($expected_shift)) ? $expected_shift : 0; ?>">
                            <input type="hidden" id="employeePingStart" value="<?php echo $sched_notify; ?>">
                            <input type="hidden" id="employeePingEnd" value="<?php echo $over_notify; ?>">
                            <input type="hidden" id="employeeOvertime" value="<?php echo $expected_endshift; ?>">
                            <input type="hidden" id="timeDifference" value="<?php echo $time_difference; ?>">
                            <input type="hidden" id="unScheduledShift" value="<?php echo $shift_end; ?>" data-value="<?php echo date('h:i A', $shift_end) ?>">
                            <input type="hidden" id="autoClockOut" value="<?php echo $overtime_status; ?>">
                            <div class="dropdown dropdown-hover d-flex Btn" id="<?php echo $clock_btn ?>" data-allow-module="<?= $_SESSION['alert_class'] ?>">
                                <a href="#" class="dropdown-toggle">
                                    <i class='bx bx-fw bx-time-five cBtn'></i>
                                </a>
                                <div class="dropdown-menu dropdown-list">
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Clock in</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $clock_in; ?></h6>
                                    </div>
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Clock out</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $clock_out ?></h6>
                                    </div>
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Lunch</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $lunch_time; ?></h6>
                                    </div>
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Shift Duration</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $shift_duration; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-task'></i></a>
                                <div class="dropdown-menu dropdown-list nsm-nav-dropdown">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold">Tasks</h6>
                                    </div>
                                    <div id="task_container">
                                        <?php
                                        $newtasks = getTasks();

                                        if (count($newtasks) > 0) :
                                            foreach ($newtasks as $task) :
                                        ?>
                                                <div class="list-item" onclick="location.href='<?php echo base_url('taskhub/view/' . $task->task_id); ?>'">
                                                    <span class="content-title"><?php echo $task->subject; ?></span>
                                                    <span class="content-subtitle">
                                                        <?php
                                                        $date_created = date_create($task->date_created);
                                                        echo date_format($date_created, "F d, Y h:i:s");
                                                        ?>
                                                    </span>
                                                </div>
                                            <?php
                                            endforeach;
                                        else :
                                            ?>
                                            <div class="text-center py-3">
                                                <span class="content-subtitle">No tasks for now.</span>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item text-center" onclick="location.href='<?php echo base_url('taskhub') ?>'">
                                        <span class="content-subtitle">View All</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-bell'></i></a>
                                <div class="dropdown-menu dropdown-list nsm-nav-dropdown">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold">Notifications</h6>
                                    </div>
                                    <div id="notifications_container">
                                        <div class="text-center py-3">
                                            <span class="content-subtitle">No notifications for now.</span>
                                        </div>
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item text-center" onclick="location.href='<?php echo site_url(); ?>timesheet/notification'">
                                        <span class="content-subtitle">View All</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="bx bx-fw bx-cog"></i></a>
                                <div class="dropdown-menu dropdown-list nsm-nav-dropdown" style="width: max-content; padding: 1.5em">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="list-header">
                                                <h6 class="dropdown-header fw-bold">YOUR COMPANY</h6>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Account and settings</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Manage users</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Custom form styles</span>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/chart-of-accounts'); ?>'">
                                                <span class="content-title">Chart of accounts</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Payroll settings</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">nSmarTrac labs</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="list-header">
                                                <h6 class="dropdown-header fw-bold">LISTS</h6>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/lists'); ?>'">
                                                <span class="content-title">All lists</span>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/products-and-services'); ?>'">
                                                <span class="content-title">Products and services</span>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/recurring-transactions'); ?>'">
                                                <span class="content-title">Recurring transactions</span>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/attachments'); ?>'">
                                                <span class="content-title">Attachments</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Custom fields</span>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/tags'); ?>'">
                                                <span class="content-title">Tags</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 border-end">
                                            <div class="list-header">
                                                <h6 class="dropdown-header fw-bold">TOOLS</h6>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Import data</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Import desktop data</span>
                                            </div>
                                            <div class="list-item" onclick="location.href='<?=base_url('accounting/reconcile'); ?>'">
                                                <span class="content-title">Reconcile</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Budgeting</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Audit log</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">SmartLook</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Resolution center</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="list-header">
                                                <h6 class="dropdown-header fw-bold">PROFILE</h6>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Feedback</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Refer a friend</span>
                                            </div>
                                            <div class="list-item">
                                                <span class="content-title">Privacy</span>
                                            </div>
                                            <!-- <div class="list-item">
                                                <span class="content-title">Switch company</span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <?php
                                    $image = userProfilePicture(logged('id'));
                                    if (is_null($image)) {
                                    ?>
                                        <div class="profile-img" style="background-image: url('')">
                                            <span><?php echo getLoggedNameInitials(logged('id')); ?></span>
                                        <?php
                                    } else {
                                        ?>
                                            <div class="profile-img" style="background-image: url('<?php echo $image; ?>')">
                                            <?php
                                        }
                                            ?>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-list">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold"><?php echo getLoggedFullName(logged('id')); ?></h6>
                                    </div>
                                    <div class="list-item main-nav-item" id="<?php echo $clock_btn ?>">
                                        Clock In/Clock Out
                                    </div>
                                    <div class="list-item main-nav-item position-relative">
                                        Tasks <span class="nsm-badge badge-circle error">1</span>
                                    </div>
                                    <div class="list-item main-nav-item position-relative">
                                        Notifications <span class="nsm-badge badge-circle error">1</span>
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('profile') ?>'">
                                        Public Profile
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url() ?>'">
                                        nSmart Home
                                    </div>
                                    <div class="list-item">
                                        Join Our Community
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('activity_logs') ?>'">
                                        Activity Logs
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo base_url('settings/email_templates') ?>'">
                                        Settings
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('/logout') ?>'">
                                        Logout
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nsm-content-container">
                <div class="nsm-content">
                    <div class="modal fade nsm-modal fade" id="new_estimate_modal" tabindex="-1" aria-labelledby="new_estimate_modal_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title content-title" id="new_estimate_modal_label">New Estimate</span>
                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center gy-3">
                                        <div class="col-12">
                                            <label class="content-title">What type of estimate you want to create</label>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle d-block mb-2">Create a regular estimate with items</label>
                                            <button type="button" class="nsm-button w-50 primary" id="standard-estimate">Standard Estimate</button>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle d-block mb-2">Customers can select all or only certain options</label>
                                            <button type="button" class="nsm-button w-50 primary" id="options-estimate">Options Estimate</button>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle d-block mb-2">Customers can select both Bundle Packages to<br>obtain an overall discount</label>
                                            <button type="button" class="nsm-button w-50 primary" id="bundle-estimate">Bundle Estimate</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nsm-fab-container">
                        <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
                            <i class="bx bx-plus"></i>
                        </div>
                        <ul class="nsm-fab-options">
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <span class="nsm-fab-label">Add Invoice</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-money"></i>
                                </div>
                                <span class="nsm-fab-label">Receive Payment</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-book-content"></i>
                                </div>
                                <span class="nsm-fab-label">Add Expense</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-book-content"></i>
                                </div>
                                <span class="nsm-fab-label">Add Check</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <span class="nsm-fab-label">Add Bill</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-money"></i>
                                </div>
                                <span class="nsm-fab-label">Pay bills</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-time"></i>
                                </div>
                                <span class="nsm-fab-label">Single time activity</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-file"></i>
                                </div>
                                <span class="nsm-fab-label">Bank Deposit</span>
                            </li>
                            <li>
                                <div class="nsm-fab-icon">
                                    <i class="bx bx-transfer"></i>
                                </div>
                                <span class="nsm-fab-label">Transfer</span>
                            </li>
                        </ul>
                    </div>
                    
    <script type="text/javascript">
        var user_id = <?= $user_id ?> ;

        var
            current_user_company_id = <?=logged('company_id')?> ;
        var all_notifications_html = '';
        var notification_badge_value = 0;
        var notification_html_holder_ctr = 0;

        function countChar(val) {
            var len = val.value.length;
            if (len >= 300) {
                val.value = val.value.substring(0, 300);
            } else {
                $('#charNum').text(300 - len);
            }
        };

        function bell_acknowledged() {

            // console.log("solod");
            $('#notifyBadge').hide();
            if (notification_badge_value > 0) {
                notification_badge_value = 0;
                $.ajax({
                    url: baseURL + '/timesheet/notif_user_acknowledge',
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log("Bell Acknowledged");
                    }
                });
            }


        }
        let notificationClockInOut = (function() {
            return function() {
                $.ajax({
                    url: baseURL + "Timesheet/getCount_NotificationsAll",
                    type: "POST",
                    dataType: "json",
                    data: {
                        notifycount: notification_badge_value
                    },
                    success: function(data) {
                        // console.log(data);
                        if (notification_badge_value != data.badgeCount) {
                            notification_badge_value = data.badgeCount;
                            // $('#notifyBadge').html(notification_badge_value);
                            // $('#nfcount').html(data.notifyCount);
                            // $('#notifyBadge').show();
                            // $('#autoNotifications').html(data.autoNotifications);
                            notification_viewer();
                            // console.log(data.notifyCount);
                        }
                        if (data.notifyCount < 1) {
                            $('#autoNotifications').html("<div>No new notification</div>");
                        }
                        // setTimeout(notificationClockInOut, 5000);
                    }
                });
            }
        })();

        let notification_viewer = (function() {
            return function() {
                $.ajax({
                    url: baseURL + "/Timesheet/getNotificationsAll",
                    type: "POST",
                    dataType: "json",
                    data: {
                        badgeCount: notification_badge_value
                    },
                    success: function(data) {
                        // alert(data.badgeCount);
                        if (data.notifyCount > 0) {
                            $('#notifyBadge').html(data.badgeCount);
                            $('#nfcount').html(data.notifyCount);
                            $('#autoNotifications').html(data.autoNotifications);
                            notification_badge_value = data.badgeCount;
                            if (data.badgeCount > 0) {
                                // alert(data.badgeCount);
                                $('#notifyBadge').show();
                            } else {
                                $('#notifyBadge').hide();
                            }
                        }




                        // console.log(data.notifyCount+0);
                        // setTimeout(notificationClockInOut, 5000);
                    }
                });
            }
        })();

        $(document).ready(function() {
            var TimeStamp = null;
            notification_viewer();
            // notificationClockInOut();
        });

        async function notificationRing() {
            const audio = new Audio();
            audio.src = baseURL + '/assets/css/notification/notification_tone2.mp3';
            audio.muted = false;
            try {
                await audio.play();
            } catch (err) {
                // console.log('error');
            }
        }

        Pusher.logToConsole = true;

        var pusher = new Pusher('f3c73bc6ff54c5404cc8', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('nsmarttrac');
        channel.bind('my-event', function(data) {

            console.log(data.user_id);
            if (data.notif_action_made == "over8less9") {
                if (data.user_id == user_id) {
                    notificationRing();
                    Push.Permission.GRANTED;
                    Push.create("Hey! " + data.FName, {
                        body: "It's time for you to clock out. Do you still need more time?",
                        icon: data.profile_img,
                        timeout: 20000,
                        onClick: function() {
                            window.focus();
                            this.close();
                        }
                    });
                }
            } else {

                if (data.user_id != user_id && data.company_id == current_user_company_id) {
                    notificationRing();
                    // console.log("posk");

                    // console.log(data.profile_img);
                    Push.Permission.GRANTED; // 'granted'
                    Push.create(data.FName + " " + data.LName, {
                        body: data.content_notification,
                        icon: data.profile_img,
                        timeout: 20000,
                        onClick: function() {
                            window.focus();
                            this.close();
                        }
                    });
                }
                if (data.notif_action_made != "Lunchin" && data.notif_action_made != "Lunchout" && data
                    .company_id == current_user_company_id) {
                    notification_badge_value++;
                    $('#notifyBadge').html(notification_badge_value);
                    $('#notifyBadge').show();
                    var current_notifs = $('#autoNotifications').html();
                    $('#autoNotifications').html(data.html + current_notifs);
                }
                if (data.notif_action_made == "autoclockout") {
                    if (data.user_id == user_id) {
                        notificationRing();
                        Push.Permission.GRANTED;
                        Push.create("Hey! " + data.FName + " you have been auto clocked out.", {
                            body: "We haven't heard from you since the last time clock notification.",
                            icon: data.profile_img,
                            timeout: 20000,
                            onClick: function() {
                                window.focus();
                                this.close();
                            }
                        });
                    }
                }
            }

        });
        $(document).ready(function() {
            // var timeZoneFormatted = new Date().toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
            var offset = new Date().getTimezoneOffset();
            var offset_zone = (offset / 60) * (-1);
            if (offset_zone >= 0) {
                offset_zone = "+" + offset_zone;
            }
            $.ajax({
                url: "<?= base_url() ?>/timesheet/timezonesetter",
                type: "POST",
                dataType: "json",
                data: {
                    usertimezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
                    offset_zone: "GMT" + offset_zone
                },
                success: function(data) {}
            });




        });
    </script>