<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <section class="taxs-wrp">
                                <div class="taxs-tabs">
                                    <div class="container-fluid">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tax3">Chart of Accounts</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tax4">Reconcile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="tax3">
                                        
                                    </div>
                                    <div class="tab-pane active" id="tax4">
                                        <div class="recon-wrpper">
                                            <div class="container-fluid">
                                                <div class="breadcrumb-pager">
                                                    <ul>
                                                        <li><a href="#">Chart of Accounts</a></li>
                                                        <li><a href="#">Bank Register</a></li>
                                                        <li>Reconcile</li>
                                                    </ul>
                                                </div>

                                                <div class="recon-head">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-5">
                                                            <div class="left-taxs">
                                                                <h1>Reconcile</h1>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-7">
                                                            <div class="action-bar">
                                                                <ul>
                                                                    <li><a data-toggle="tab" href="#tax-history">Summary</a></li>
                                                                    <li><a href="#">History by account</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="recon-box">
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
                                                                        <option value="<?=$row->id?>"><?=$row->name?></option>
                                                                      <?php
                                                                      $i++;
                                                                      }
                                                                       ?>
                                                                </select>
                                                                <?php /* echo $this->reconcile_model->checkexist()*/ ?>
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
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
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
</script>