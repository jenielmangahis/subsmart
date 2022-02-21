<style type="text/css">
    div[role="wrapper"] .navbar-side .nav-header {
        background-color: #32243d;
        padding: 20px;
        margin-bottom: 0px;
        color: #45a73c;
        /*border-bottom: 1px solid #ccc;*/
    }

    div[role="wrapper"] .navbar-side {
        background-color: #32243d;
    }

    ul.nav li.active {
        background: #45a73c;
        background: -moz-linear-gradient(top, #45a73c 0%, #67ce5e 100%);
        background: -webkit-linear-gradient(top, #45a73c 0%, #67ce5e 100%);
        background: linear-gradient(to bottom, #45a73c 0%, #67ce5e 100%);
    }

    div[role="wrapper"] .navbar-side .nav li>a {
        color: #fff !important;
        padding: 15px 15px;
        text-align: left;
    }

    .acct-btn-add {
        border-radius: 20px;
        width: 90%;
        color: #fff;
        border: solid 2px white;
    }

    .acct-btn-add:hover {
        border: solid 2px #adff2f;
        color: #adff2f;
    }

    #sidebar {
        z-index: 999;
    }

    /* svg#svg-sprite-menu-close {
     position: relative;
     bottom: 114px;
   } */
</style>
<nav id="sidebar" class="navbar-side d-none d-md-block">
    <ul class="nav sidebar-accounting">
        <span class="nav-close">
            <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg"
                transform="scale(1, -1)" width="20px" height="100%">
                <path
                    d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z">
                </path>
            </svg>
        </span>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;"><img
                src="<?= getCompanyBusinessProfileImage(); ?>"
                class="company-logo" /></li>
        <li class="nav-header" style="padding-top: 0px;margin-top: 0px;">ACCOUNTING</li>

        <li class="" style="margin-top:20px;margin-bottom: 20px;">
            <button class="btn btn-tranparent acct-btn-add mx-auto" type="button" data-toggle="modal"
                data-target="#new-popup"><i class="fa fa-plus" style="margin-right: 20px;"></i>New</button>
        </li>


        <li
            class="submenus <?= $this->uri->segment(2) == 'banking' ? "active" : "";  ?>">
            <a
                href="<?= base_url('accounting/banking') ?>"><span
                    class="fa fa-tachometer"></span>Dashboard</a>
        </li>
        <li
            class="submenus dropright <?= $this->uri->segment(2) == 'link_bank' || $this->uri->segment(2) == 'bank_register' ? "active" : "";  ?>">
            <a href="#menu11111" onclick="dropdownAccounting(this)" class="dropdown-toggle"><i
                    class="fa fa-university pr-3"></i>Banking</a>
            <ul class="collapse list-unstyled" id="menu11111">
                <li> <a
                        href="<?= base_url('accounting/link_bank') ?>">Link
                        Bank</a></li>
                <li> <a
                        href="<?= base_url('accounting/rules') ?>">Rules</a>
                </li>
                <li> <a
                        href="<?= base_url('accounting/receipts') ?>">Receipts</a>
                </li>
                <li> <a
                        href="<?= base_url('accounting/tags') ?>">Tags</a>
                </li>
            </ul>
        </li>

        <?php  for ($x=0;$x<count($menu_name);$x++) { ?>
        <?php  if (count($menu_name[$x][1]) > 0) { ?>
        <li class="submenus dropright">
            <a href="#menu<?php echo $x; ?>"
                onclick="dropdownAccounting(this)" class="dropdown-toggle"><i
                    class="fa <?php echo $menu_icon[$x]; ?> pr-3"></i><?php echo $menu_name[$x][0]; ?></a>
            <ul class="collapse list-unstyled"
                id="menu<?php echo $x; ?>">
                <?php  for ($y=0;$y<count($menu_name[$x][1]);$y++) { ?>
                <li>
                    <a
                        href="<?php echo url($menu_link[$x][1][$y]); ?>"><?php echo $menu_name[$x][1][$y]; ?></a>
                </li>
                <?php  } ?>
            </ul>
        </li>
        <?php  } else { ?>
        <li class="submenus">
            <a href="<?php echo url($menu_link[$x][0]); ?>"><i
                    class="fa <?php echo $menu_icon[$x]; ?> pr-3"></i><?php echo $menu_name[$x][0]; ?></a>
        </li>
        <?php  } ?>
        <?php  } ?>
    </ul>
</nav>

<!-- New Popup -->
<div id="new-popup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content add-new-data-block">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="new-listing">
                        <h4>CUSTOMERS</h4>

                        <ul id="accounting_customers">
                            <li><a href="<?php echo base_url('accounting/addnewInvoice') ?>">Invoice</a>
                            <li><a href="#" class="ajax-modal" data-view="receive_payment_modal" data-toggle="modal" data-target="#receivePaymentModal">Receive Payment</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#newJobModal">Estimate</a></li>
                            <li><a href="#" class="ajax-modal" data-view="credit_memo_modal" data-toggle="modal" data-target="#creditMemoModal">Credit memo</a></li>
                            <li><a href="#" class="ajax-modal" data-view="sales_receipt_modal" data-toggle="modal" data-target="#salesReceiptModal">Sales receipt</a></li>
                            <li><a href="#" class="ajax-modal" data-view="refund_receipt_modal" data-toggle="modal" data-target="#refundReceiptModal">Refund receipt</a></li>
                            <li><a href="#" class="ajax-modal" data-view="delayed_credit_modal" data-toggle="modal" data-target="#delayedCreditModal">Delayed credit</a></li>
                            <li><a href="#" class="ajax-modal" data-view="delayed_charge_modal" data-toggle="modal" data-target="#delayedChargeModal">Delayed charge</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="new-listing">
                        <h4>Vendors</h4>

                        <ul id="accounting_vendors">
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
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="new-listing">
                        <h4>Employees</h4>

                        <ul id="accounting_employees">
                            <li><a href="#" class="ajax-modal" data-view="payroll_modal" data-toggle="modal" data-target="#payrollModal">Payroll</a></li>
                            <li><a href="#" class="ajax-modal" data-view="single_time_activity_modal" data-toggle="modal" data-target="#singleTimeModal">Single time activity</a></li>
                            <li><a href="#" class="ajax-modal" data-view="weekly_timesheet_modal" data-toggle="modal" data-target="#weeklyTimesheetModal">Weekly timesheet</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="new-listing">
                        <h4>Other</h4>

                        <ul id="accounting_order">
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

            <div class="pop-footer">
                <a href="#">Show Less</a>
            </div>
        </div>
    </div>
</div>

<?php if(!isset($disable_accounting_modals)){ ?>
<?php include viewPath('accounting/estimate_one_modal'); ?>
<?php include viewPath('accounting/customer_invoice_modal'); ?>
<?php include viewPath('accounting/customer_receive_payment_modal');?>
<?php include viewPath('accounting/customer_estimate_modal'); ?>
<?php include viewPath('accounting/customer_credit_memo_modal');?>
<?php include viewPath('accounting/customer_sales_receipt_modal'); ?>
<?php include viewPath('accounting/customer_includes/refund_receipt/refund_receipt'); ?>
<?php include viewPath('accounting/customer_includes/delayed_credit/delayed_credit_modal'); ?>
<?php //include viewPath('accounting/customer_delayed_credit_modal');?>
<?php include viewPath('accounting/customer_delayed_charge_modal'); ?>

<!-- vendors -->
<?php include viewPath('accounting/vendor_vendor_credit_modal'); ?>
<?php include viewPath('accounting/vendor_credit_card_modal'); ?>
<?php include viewPath('accounting/vendor_print_checks_modal'); ?>
<?php //include viewPath('accounting/customer_includes/receive_payment/receive_payment_modal');?>
<?php include viewPath('accounting/customer_includes/create_charge/create_charge'); ?>
<?php include viewPath('accounting/customer_includes/create_invoice/create_invoice_modal'); ?>
<?php include viewPath('accounting/add_new_term');?>
<?php include viewPath('accounting/invoices_page_includes/invoice_viewer_modal');?>
<?php include viewPath('accounting/all_sales_includes/send_reminder_by_batch_modal'); ?>
<?php } ?>
