<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 178px !important;
    }
    .nav-close {
        margin-top: 52% !important;
    }
	.bank-img-container img{
		width:auto !important;
	}
    .btn {
        border-radius: 0 !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    label>input {
        visibility: visible !important;
        position: inherit !important;
    }
</style>
<style>
    .fdx-entity-container-button:hover {
        border-color: #45a73c !important;
        border:  2px;
        border-style: solid;
    }

    .fdx-entity-container {
        display: flex;
        flex: 1 1 auto;
        justify-content: center;
        max-width: 98%;
    }
    .fdx-provider-logo-wrapper-small {
        width: 50px;
        height: 50px;
    }
    .fdx-entity-container-button {
        position: relative;
        margin-bottom: 12px;
        padding: 12px;
        width: 500px;
        height: 74px;
        display: flex;
        justify-content: space-around;
        border-radius: 8px;
        border: 1px solid #eaecee;
        box-sizing: border-box;
        box-shadow: 0px 1px 8px rgb(0 0 0 / 8%);
        cursor: pointer;
        background-color: transparent;
    }
    .fdx-provider-logo-container-small {
        min-width: 48px;
        min-height: 48px;
        width: 48px;
        height: 48px;
    }
    .fdx-recommended-entity-desc-container {
        height: 40px;
        display: flex;
        -moz-align-items: flex-start;
        align-items: flex-start;
        justify-content: center;
        -moz-flex-direction: column;
        flex-direction: column;
        margin: auto 100px;
        box-sizing: border-box;
        overflow: hidden;
        flex: 1 1;
    }
    .fdx-recommended-entity-name {
        width: 100%;
        height: 24px;
        font-weight: 600;
        font-size: 16px;
        padding-bottom: 4px;
        -webkit-margin-before: 0;
        margin-block-start: 0;
        -webkit-margin-after: 0;
        margin-block-end: 0;
        text-align: left;
        margin-bottom: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: inherit;
        white-space: nowrap;
        box-sizing: border-box;
    }
    .fdx-recommended-entity-desc {
        min-height: 18px;
        font-size: 12px;
        -webkit-margin-before: 0px;
        margin-block-start: 0px;
        -webkit-margin-after: 0px;
        margin-block-end: 0px;
        text-align: left;
        color: #6b6c72;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 400;
        cursor: inherit;
    }
    .fdx-provider-logo {
        width: 100%;
        height: auto;
    }
    .fdx img {
        border: 0;
    }
    .fdx img {
        background: transparent !important;
    }
    .fdx-provider-logo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<?php
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //'assets/frontend/css/workorder/main.css',
    // 'assets/css/beforeafter.css',
));
?>




<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper" style="">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div class="card">
                <!-- <h3 style="font-family: Sarabun, sans-serif">&nbsp;Bank and Credit Cards</h3> -->
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Bank and Credit Cards</h3>
                    </div>
                    <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:28px;margin-top:13px;">
                        When you connect an account, accounting will automatically downloads and categorizes bank and credit card transactions for you. It enters the details so you don't have to enter transactions manually.  All you have to do is approve the work.
                    </div>
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-4">
                        <!-- <h2>Bank and Credit Cards</h2> -->

                        <!-- <div class="row"> -->
                            <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="link_bank")?:'-active';?>" style="text-decoration: none">Banking</a>
                                <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                                <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                                <a href="<?php echo url('/accounting/tags')?>" class="banking-tab">Tags</a>
                            </div>
                        <!-- </div> -->

                    </div>
                    <div class="col-md-4" style="position: relative;display: inline-block;vertical-align: text-bottom;">

                    </div>
                    <div class="col-md-4" style="text-align: right">
                        <div style="float: right;position: relative;display: inline-block; margin-left: 10px">
                            <a href="<?= base_url('accounting/bank_connect') ?>">
                                <button class="btn btn-primary"><i class="fa fa-plus fa-sm" style="margin-left:10px;"></i> Add account</button>
                            </a>
                        </div>
                        <div class="dropdown dropdown-btn text-center" style="float: right;position: relative;display: inline-block; margin-left: 10px">
                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                <span class="btn-label"><span class="fa fa-cogs"></span> Actions <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                <li role="presentation">
                                    <a href="<?= base_url('accounting/import_transactions') ?>" class="editJobTypeBtn editItemBtn">
                                        <span class="fa fa-upload"></span> Import Bank Transactions
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="<?= base_url('accounting/manage_connection'); ?>" class="editJobTypeBtn editItemBtn">
                                        <span class="fa fa-upload"></span> Manage Connections
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('accounting/bank_register') ?>" class="editItemBtn">
                                        <span class="fa fa-bank"></span> Go to Bank Register
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="editItemBtn">
                                        <span class="fa fa-print"></span> Print
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('accounting/banking_export'); ?>" class="editItemBtn">
                                        <span class="fa fa-download"></span> Export to Excel
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="editItemBtn">
                                        <span class="fa fa-cogs"></span> Settings

                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('accounting/test_payment') ?>" >
                                        <span class="fa fa-bank"></span> Test Payment
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                            </ul>
                        </div>

                        <div class="dropdown dropdown-btn text-center" style="float: right;position: relative;display: inline-block; margin-left: 10px">
                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                <span class="btn-label"><i class="fa fa-credit-card"></i> Accounts <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                    <?php if($accounts->stripe_publish_key !== NULL): ?>
                                        <li>
                                            <div class="card">
                                                <div class="col-sm-12">
                                                    <div class="fdx-entity-container click-paypal">
                                                        <div class="fdx-provider-logo-container">
                                                            <div class="fdx-provider-logo-wrapper">
                                                                <img style="width: 50px;" class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" title="Stripe" alt="Stripe">
                                                            </div>
                                                        </div>
                                                        <div class="fdx-recommended-entity-desc-container">
                                                            <label class="fdx-recommended-entity-name" title="Stripe">Stripe Corporate Credit Card</label>
                                                            <label class="fdx-recommended-entity-desc">stripe.com</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php if($accounts->paypal_client_id !== NULL): ?>
                                    <li>
                                        <div class="card">
                                            <div class="col-sm-12">
                                                <div class="fdx-entity-container click-paypal">
                                                    <div class="fdx-provider-logo-container">
                                                        <div class="fdx-provider-logo-wrapper">
                                                            <img style="width: 50px;" class="fdx-provider-logo" src="<?php echo base_url('assets/img/accounting/paypal.png') ?>" title="Paypal" alt="Paypal">
                                                        </div>
                                                    </div>
                                                    <div class="fdx-recommended-entity-desc-container">
                                                        <label class="fdx-recommended-entity-name" title="Paypal">Paypal</label>
                                                        <label class="fdx-recommended-entity-desc">It's popular in your area</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <li role="separator" class="divider"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- <br> -->
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <div class="banking-tab-container">
                            <div class="rb-01">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item banking-sub-active">
                                        <a class="nav-link active banking-sub-tab" data-toggle="tab" href="#forReview">For Review</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link banking-sub-tab" data-toggle="tab" href="#reviewed">Reviewed</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link banking-sub-tab" data-toggle="tab" href="#excluded">Excluded</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="forReview" style="background: #ffffff; padding: 10px">
                                <table id="forReview_table" class="table responsive table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class=""></th>
                                            <th>Date</th>
                                            <th >Description</th>
                                            <th >Payee</th>
                                            <th>Amount</th>
                                            <th>Assign To</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; foreach ($banking_payments as $payment) : ?>
                                            <tr class="accordion" data-bankingId="<?= $payment->id ?>" data-toggle="collapse" href="#multiCollapseExample1">
                                                <td></td>
                                                <td ><?=date_format(date_create($payment->date_paid), "m/d/Y"); ?></td>
                                                <td ><?= $payment->description ?></td>
                                                <td ><?= $payment->payee ?></td>
                                                <td >$<?= $payment->amount ?></td>
                                                <td ><?= $payment->assign_to ?></td>
                                                <td ><button type="button" class="btn btn-default btn-sm" id="exportCustomers"><span class="fa fa-plus"></span> Add</button></td>
                                            </tr>
                                            <tr class="accordion_content">
                                                <td colspan="7">
                                                    <div class="row" style="padding-left: 45px;">
                                                        <div class="col-md-12 form-group">
                                                            <input type="radio" name="method<?=$count?>" class="payment_method" value="C" checked>
                                                            <strong >Categorize</strong> &nbsp;&nbsp;

                                                            <input type="radio" name="method<?=$count?>" class="payment_method" value="FM" >
                                                            <strong >Find Match</strong> &nbsp;&nbsp;

                                                            <input type="radio" name="method<?=$count?>"  class="payment_method" value="RaT" >
                                                            <strong >Record as Transfer</strong> &nbsp;&nbsp;

                                                            <input type="radio" name="method<?=$count?>" class="payment_method" value="RaCCP">
                                                            <strong >Record as credit card payment</strong> &nbsp;&nbsp;
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div id="categorize">
                                                                <form method="post" id="stripe_form" class="row">
                                                                    <div class="col-md-3">
                                                                        <label for="">Vendor/Customer</label><br>
                                                                        <select name="customer" id="" class="form_select vendor-customer">
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="">Category</label><br>
                                                                        <select name="customer" id="" class="form_select category">
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="">Customer/project</label><br>
                                                                        <select name="customer" id="" class="form_select customers">
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <br><br>
                                                                        <input type="checkbox" name="method" class="" value="CC" id="is_billable">
                                                                        <label for="is_billable">Billable</label>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="">Tags</label><br>
                                                                        <select name="customer" id="" class="form_select tags_select">
                                                                            <option value="0">None</option>
                                                                            <option value="PT5M">5 minutes before</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6"></div>
                                                                    <div class="col-md-6">
                                                                        <label for="">Memo</label><br>
                                                                        <input type="text" name="id" class="form-control" id="jobid" >
                                                                        <br>
                                                                    </div>
                                                                    <div class="col-md-6"></div>
                                                                    <div class="col-md-12">
                                                                        <strong>Bank Detail</strong> <small>Test Debit Card</small>
                                                                    </div>
                                                                    <br><br>
                                                                    <div class="col-md-12">
                                                                        <a href="javascript:void;" id="add_field" style="color:#58bc4f;font-size: 14px;"><span class="fa fa-file"></span> Add Attachment</a>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <a href="javascript:void;" id="add_field" style="color:#58bc4f;font-size: 14px;"><span class="fa fa-gavel"></span> Create Rule</a>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <a href="javascript:void;" id="add_field" style="color:#58bc4f;font-size: 14px;"><span class="fa fa-remove"></span> Exclude</a>
                                                                    </div>

                                                                    <div class="col-md-12 modal-footer">
                                                                        <button type="button" class="btn btn-default splitTransBtn">Split</button>
                                                                        <button type="submit" class="btn btn-success " id="">Add</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $count++ ; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="reviewed" style="background: #ffffff; padding: 10px">
                                <table id="reviewed_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class=""></th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Payee</th>
                                        <th>Amount</th>
                                        <th>Assign To</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php //foreach ($banking_payments as $payment) : ?>
                                        <tr>
                                            <td></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                    <?php //endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="excluded" style="background: #ffffff; padding: 10px">
                                <table id="exluded_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class=""></th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Payee</th>
                                        <th>Amount</th>
                                        <th>Assign To</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php //foreach ($banking_payments as $payment) : ?>
                                        <tr>
                                            <td></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                    <?php //endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

</div>
<?php include viewPath('includes/footer_accounting'); ?>


<div class="modal fade" id="split_transaction_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Split Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Downloaded transaction</strong><br>
                        <p >Beach</p>
                    </div>
                    <div class="col-md-3">
                        <label for="">Payee</label><br>
                        <select name="customer" id="" class="form_select vendor-customer">
                            <option value=""></option>
                        </select>

                    </div>
                </div>

                <div class="row">
                    <br><br>
                    <div class="col-md-12">
                        <table id="split_transaction_table" class="table  table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th >Description</th>
                                    <th >Customer</th>
                                    <th>Billable</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="split_transaction_items">
                                <tr>
                                    <td>
                                        <select name="customer" id="" class="form_select category">
                                            <option value=""></option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="id" class="form-control" id="jobid" >
                                    </td>
                                    <td>
                                        <select name="customer" id="" class="form_select customers">
                                            <option value=""></option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="method" class="" value="CC" id="is_billable">
                                    </td>
                                    <td>
                                        <input type="number" name="id" class="form-control" id="jobid" >
                                    </td>
                                    <td>
                                        <span class="fa fa-trash remove_item" ></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default btn-sm" id="add_field"><span class="fa fa-plus"></span> Add Line</button>
                    </div>
                    <div class="col-md-12">
                        <label for="">Memo</label><br>
                        <textarea name="message" cols="40" style="width: 100%;" rows="3" id="note_txt" class="input"></textarea>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <a href="javascript:void;" id="add_field" style="color:#58bc4f;font-size: 14px;"><span class="fa fa-file"></span> Add Attachment</a>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm">Apply and Accept</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addAccountModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Connect an account</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container modal-container accounts-list">
                        <div class="header-modal"><h3>Let's get a picture of your profits</h3></div>
                        <div class="sub-header-modal"><span>Connect your bank or credit card to bring in your transactions.</span></div>
                        <div class="body-modal">
                            <input type="text" class="form-control" placeholder="Enter your bank name or URL" style=" margin: 40px 0 50px 0;">
                            <div class=""><span>Here are some of the most popular ones</span></div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/citibank.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/chase-logo.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/bank-of-america.png') ?>" alt="">

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/Wells_Fargo.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/co-1200.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/us-bank-logo-vector.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container clk-paypal">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/pncbank_pms_c.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
							<div class="row justify-content-md-center align-items-center">
								<div class="col-sm-3">
                                    <div class="bank-img-container clk-stripe">
                                        <img class="banks-img w-auto" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="container modal-container paypal-container" style="display:none">
						<form id="save-paypal-account">
							<div class="row justify-content-md-center align-items-center pt-3">
								<div class="col-md-5 col-sm-6 col-xs-12">
									<h5 class="close-paypal-container text-right text-secondary" style="cursor:pointer;"><i class="fa fa-times fa-lg"></i></h5>
									<p class="text-center"><img class="banks-img img-fluid mx-auto" style="width:125px" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt=""></p>
									
									<div class="header-modal text-center"><h3>Add PayPal Credentials</h3></div>
									<div class="form-group pt-3">
										<label for="paypal_email">PayPal Email</label>
										<input type="text" class="form-control" name="paypal_email" id="paypal_email" required="" placeholder="Enter Your PayPal Email" autofocus="">
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center align-items-center pb-5">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<button type="submit" name="save" class="btn btn-success btn-block">Save</button>
								</div>
							</div>
						</form>
                    </div>
					<div class="container modal-container stripe-container" style="display:none">
						<form id="save-stripe-account">
							<div class="row justify-content-md-center align-items-center pt-3">
								<div class="col-md-5 col-sm-6 col-xs-12">
									<h5 class="close-stripe-container text-right text-secondary" style="cursor:pointer;"><i class="fa fa-times fa-lg"></i></h5>
									<p class="text-center"><img class="banks-img img-fluid mx-auto" style="width:150px" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" alt=""></p>
									
									<div class="header-modal text-center"><h3>Add Stripe Credentials</h3></div>
									<div class="form-group pt-3">
										<label for="stripe_email">Stripe Email</label>
										<input type="text" class="form-control" name="stripe_email" id="stripe_email" required="" placeholder="Enter Your Stripe Email" autofocus="">
									</div>
									<div class="form-group">
										<label for="publish_key">Stripe Publish Key</label>
										<input type="text" class="form-control" name="publish_key" id="publish_key" required="" placeholder="Enter Your Publish Key" autofocus="">
									</div>
									<div class="form-group">
										<label for="secret_key">Stripe Secret Key</label>
										<input type="text" class="form-control" name="secret_key" id="secret_key" required="" placeholder="Enter Your Secret Key" autofocus="">
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center align-items-center pb-5">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<button type="submit" name="save" class="btn btn-success btn-block">Save</button>
								</div>
							</div>
						</form>
                    </div>
                </div>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>

<div class="full-screen-modal">
    <!--Modal for file upload-->
    <div id="fileUpload" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0;">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title" style="text-align: center;font-size: 46px;">Bring your info into nSmartrac</h1>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="modal-container box-bank-container" style="width: 100%">
                                <div class="centered-container">
                                    <img src="<?php echo base_url('assets/img/accounting/Artboard_230-512.png') ?>" alt="">
                                </div>
                                <div style="margin-top: 70px;">
                                    <h4 style="margin: 20px 20px 30px 20px; ">Get your info from your bank</h4>
                                    <ol>
                                        <li>Open a new tab and sign in to your bank.</li>
                                        <li>Download transactions: CSV, QFX, QBO, OFX or TXT format only.</li>
                                        <li>Close the tab and return to nSmartrac.</li>
                                    </ol>
                                </div>
                                <div>
                                    <h5 style="margin: 20px 20px 30px 20px;">Select a file to upload</h5>
                                    <form style="margin: 20px 20px 30px 20px;">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2" style="padding-top: 250px;"><h1 class="modal-title" style="text-align: center;font-size: 46px;">OR</h1></div>
                        <div class="col-sm-5">
                            <div class="modal-container box-bank-container" style="width: 100%">
                                <div class="centered-container">
                                    <img src="<?php echo base_url('assets/img/accounting/bank-security-system-621346.png') ?>" alt="">
                                </div>
                                <div style="margin-top: 70px;">
                                    <h4 style="margin: 20px 20px 30px 20px; ">Securely connect your bank</h4>
                                    <ol>
                                        <li>More secure. No need to share files with bank data.</li>
                                        <li>No work. Transactions come in from your bank automatically.</li>
                                    </ol>
                                </div>
                                <div style="display: flex;justify-content: center;margin-top: 70px">
                                    <button class="btn btn-success" style="border-radius: 20px 20px 20px 20px;">Connect</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer-upload-file">
                    <button class="btn btn-dark" style="float: left;border-radius: 20px 20px 20px 20px;">Cancel</button>
                    <button class="btn btn-success" style="float: right;border-radius: 20px 20px 20px 20px">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal for Take a tour -->
<div class="centered-modal">
    <div id="takeAtour" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="header">
                        <h3>Keep your books organized all year</h3>
                        <p>Check out these resources to learn how</p>
                    </div>
                    <div class="take-a-tour-box">
                        <div class="tat-container">
                            <i class="fa fa-laptop fa-5x"></i>
                        </div>
                        <h4>Get on overview</h4>
                        <p>Watch a quick video</p>
                    </div>
                    <div class="take-a-tour-box" style="margin-left: 20px">
                        <div class="tat-container">
                            <i class="fa fa-map-signs fa-5x"></i>
                        </div>
                        <h4>Take a guide tour</h4>
                        <p>Step-by-step guidance</p>
                    </div>
                    <div class="path"></div>
                    <div class="help-link-container">
                        <div class="more-info">Tips & Resource</div>
                        <a href="" class="helpLink">How to import transactions automatically from bank</a>
                        <a href="" class="helpLink">How to enter, edit, delete expenses</a>
                        <a href="" class="helpLink">When and why to enter an expense vs. a bill</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<style>
    .accordion_content {
        display: none;
    }

    tr.accordion {
        display: table-row;
    }

    .payment_method{
        -webkit-appearance: none;
        -moz-appearance: none;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        border: 2px solid #2ca01c;
        transition: 0.2s all linear;
        margin-right: 5px;
        position: relative;
        top: 4px;
    }

    .payment_method:checked {
        border: 6px solid #2ca01c;
        outline: unset !important /* I added this one for Edge (chromium) support */
    }

    .full-screen-modal .modal .modal-dialog {
        width: 100%;
        height: 100%;
        margin: auto !important;
    }

</style>
<script>

    window.onload = function() { // same as window.addEventListener('load', (event) => {
        $.ajax({
            type: "GET",
            url: "<?= base_url() ?>api/fetchVendors",
            success: function(data) {
                console.log(data);
                var template_data = data.vendors;
                var toAppend = '';
                $.each(template_data,function(i,o){
                    toAppend += '<option value='+o.vendor_id+'>'+o.vendor_name+'</option>';
                });
                $('.vendor-customer').append(toAppend);
            }
        });

        $.ajax({
            type: "GET",
            url: "<?= base_url() ?>api/fetchCustomers",
            success: function(data) {
                console.log(data);
                var template_data = data.customers;
                var toAppendCust = '';
                $.each(template_data,function(i,o){
                    toAppendCust += '<option value='+o.prof_id+'>'+o.first_name + ' ' + o.last_name +'</option>';
                });
                $('.customers').append(toAppendCust);
            }
        });

        $.ajax({
            type: "GET",
            url: "<?= base_url() ?>api/fetchCategories",
            success: function(data) {
                console.log(data);
                var template_data = data.categories;
                var toAppendCust = '';
                $.each(template_data,function(i,o){
                    toAppendCust += '<option value='+o.id+'>'+o.name+'</option>';
                });
                $('.category').append(toAppendCust);
            }
        });
    };

    $('.splitTransBtn').click(function(){
        $('#split_transaction_modal').modal('show');
    });


    $(function(){
        $(".vendor-customer").select2({
            placeholder: "Select Payee"
        });
        $(".category").select2({
            placeholder: "Select Category"
        });
        $(".customers").select2({
            placeholder: "Sales Customer/project"
        });
        $(".tags_select").select2({
            placeholder: "Select Tag"
        });
    });


    // DataTable JS
    $(document).ready(function() {
        $("body").delegate("#add_field", "click", function(){
            //$('#split_transaction_items').append($('#item').html());
            var tableBody = $('#split_transaction_table').find("tbody"),
                $trLast = tableBody.find("tr:last"),
                $trNew = $trLast.clone();

            $trLast.after($trNew);
        });

        $("body").delegate(".remove_item", "click", function(){
            $(this).parent().parent().remove();
        });

        $('tr.accordion').click(function(){
            $('.accordion_content').css('display', 'none');
            $(this).nextUntil('tr.accordion').css('display', function(i,v){
                return this.style.display === 'table-row' ? 'none' : 'table-row';
            });
        });


        $('#forReview_table').DataTable({
            "paging": true,
            "filter":true,
            "searching": true,
            "lengthChange": true,
            "pageLength": 10,
            "order": [],
        });

        $('#reviewed_table').DataTable({
            "paging": true,
            "filter":true,
            "searching": true,
            "lengthChange": true,
            "pageLength": 10,
            "order": [],
        });

        $('#exluded_table').DataTable({
            "paging": true,
            "filter":true,
            "searching": true,
            "lengthChange": true,
            "pageLength": 10,
            "order": [],
        });
    } );
    $(document).ready(function() {
        $('#reviewedTable').DataTable({
            "paging": false,
            "filter":false
        });
    } );
    $('.banking-sub-tab').click(function(){
        $(this).parent().addClass('banking-sub-active').siblings().removeClass('banking-sub-active')
    });
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    // Expand row table
    $(document).ready(function () {

    });
</script>
