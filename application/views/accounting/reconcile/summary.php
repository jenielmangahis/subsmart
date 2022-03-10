<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
    .hide-toggle::after {
        display: none;
    }
    .show>.btn-primary.dropdown-toggle {
    background-color: #32243D;
    border: 1px solid #32243D;
}
    .p-padding{
        padding-left: 10%;
    }
    .dropdown-menu[x-placement^=top] {
    margin-left: -50px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background: #32243D;
}
.loader
{
    display: none !important;
}
 .line{
width: 1000px;
height: 4px;
border-bottom: 1px solid black;
position: absolute;
}
.dott{
  border:none;
  border-top:1px dotted #000;
  color:#fff;
  background-color:#fff;
  height:1px;
  width:40%;
  margin-top:20px; 
}
</style>

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
                                    <h3 class="page-title" style="margin: 0 !important">Reconcilation Summary</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">If you are having mismatched figures and they don't tally with your bank then reconciliation will be the only option left. In order to print your reconciliation summary report, you first need to create one.</span>
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
                                            <li>Reconciliation summary</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="action-bar">
                                        <ul>
                                            <li><a href="<?=url('accounting/reconcile')?>">Reconcile</a></li>
                                            <li><a href="<?=url('accounting/reconcile/view/history-by-account')?>">History by account</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h6>ADI</h6>
                                    <h6>RECONCILIATION SUMMARY</h6>
                                </div>
                                <div class="col-md-12">
                                    <div class="action-bar">
                                        <ul>
                                            <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                            <li><a href="<?=url('accounting/reconcile/view/export_csv')?>"><i class="fa fa-download"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <table id="summary_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
                                    <thead>
                                        <tr>
                                            <th>ACCOUNT</th>
                                            <th>TYPE</th>
                                            <th>STATEMENT ENDING DATE</th>
                                            <th>RECONCILED ON</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($rows as $row) : ?>
                                    <tr>
                                        <td><?=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)?></td>
                                        <td><?=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)?></td>
                                        <td><?=$row->ending_date?></td>
                                        <td><?=$row->adjustment_date?></td>
                                    </tr>
                                    <?php endforeach; ?>
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
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
$('#summary_table').DataTable({
    searching: false,
    lengthChange: false
});
</script>