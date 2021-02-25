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
                                    <h3 class="page-title" style="margin: 0 !important">Reconcile</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Account reconciliation is the process of matching transactions entered into our software against your bank or credit card statements. Simply, match transactions to your bank statement and check them off one by one.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/chart_of_accounts')?>" class="banking-tab">Chart of Accounts</a>
                                    <a href="<?php echo url('/accounting/reconcile')?>" class="banking-tab-active text-decoration-none">Reconcile</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="breadcrumb-pager m-0">
                                        <ul>
                                            <li><a href="<?= url('accounting/chart_of_accounts') ?>">Chart of Accounts</a></li>
                                            <li><a href="#">Bank Register</a></li>
                                            <li>Reconcile</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="action-bar">
                                        <ul>
                                            <li><a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a></li>
                                            <li><a href="<?=url('accounting/reconcile/view/history-by-account')?>">History by account</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-info alert-dismissible my-4" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h6 class="alert-heading">We know it takes time to get used to new stuff</h6>
                                        <hr>
                                        <span style="color:black;">Watch Stuart, our reconciliation guy, walk through the new supercharged reconciliation. Soon you'll be doing it better than Stuart. <a class="text-info" href="#">Watch Stuart's Video.</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="recon-box m-0">
                                            <h3>Which account do you want to reconcile?</h3>

                                            <div class="row">
                                                <div class="col-md-5 col-sm-5">
                                                    <div class="form-group">
                                                        <label>Account</label>
                                                        <select class="form-control" id="selectid">
                                                            <?php
                                                                $i=1;
                                                                foreach($this->chart_of_accounts_model->select() as $row)
                                                                {
                                                                ?>
                                                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                                                <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                                                                <?php
                                                                $i++;
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-7">
                                                    <div class="info-bx">
                                                        <h4><i class="fa fa-info-circle"></i> <strong>We don’t import statements for this account.</strong> You need to get it manually.</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <button id="resume" class="btn-main">Resume reconciling</button>
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
<script type="text/javascript">
$('#resume').click(function(){
    var id = document.getElementById("selectid").value;
    if(id!='')
      {
        var url = "<?php echo url('accounting/reconcile/')?>";
        location.href = url+id;
      }
})
$('#selectid').select2();
</script>