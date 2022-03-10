<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .loader
{
    display: none !important;
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
                                    <h3 class="page-title" style="margin: 0 !important">History by account</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">When you open your chart of accounts, you'll see a long list of accounts. These are known as account histories. Each account has its own account history.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/chart-of-accounts')?>" class="banking-tab">Chart of Accounts</a>
                                    <a href="<?php echo url('/accounting/reconcile')?>" class="banking-tab-active text-decoration-none">Reconcile</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="breadcrumb-pager m-0">
                                        <ul>
                                            <li><a href="<?= url('accounting/chart-of-accounts') ?>">Chart of Accounts</a></li>
                                            <li><a href="#">Bank Register</a></li>
                                            <li>History by account</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="action-bar">
                                        <ul>
                                            <li><a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a></li>
                                            <li><a href="<?=url('accounting/reconcile')?>">Reconcile</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="recon-box m-0">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="account">Account</label>
                                                        <select name="account" id="account" class="form-control">
                                                            <?php foreach($this->chart_of_accounts_model->select() as $row) : ?>
                                                                <option value="<?=$row->id?>"><?=$row->name?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="report_period">Report period</label>
                                                        <select name="report_period" id="report_period" class="form-control">
                                                                <option value="all-dates">All Dates</option>
                                                                <option value="365-days">Since 365 Days Ago</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="history_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
                                                        <thead>
                                                            <tr>
                                                                <th>STATEMENT ENDING DATE</th>
                                                                <th>RECONCILED ON</th>
                                                                <th>ENDING BALANCE</th>
                                                                <th>CHANGES</th>
                                                                <th>AUTO ADJUSTMENT</th>
                                                                <th>STATEMENTS</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<?php include viewPath('includes/footer_accounting'); ?>
<script>
$('#account, #report_period').select2();
$('#history_table').DataTable({
    language: {
        emptyTable: "<p class='my-3 text-center'>Each time you reconcile this account, the reconciliation report is saved here. If you're ready to reconcile now, click the Reconcile tab.</p>"
    },
    searching: false,
    lengthChange: false
});
</script>