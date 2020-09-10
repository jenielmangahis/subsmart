<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
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
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box" style="margin-top: 30px !important">
              <div class="row">
                    <div class="col-md-9">
                      <h1 class="page-title">History by account</h1>
                    </div>
                    <div class="col-md-3">
                       <a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a> | <a href="<?=url('accounting/reconcile')?>">Reconcile</a> 
                    </div>
                </div>
            </div>
            <!-- end row -->
           
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                             <div class="row align-items-center">
                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <label>Account</label>
                                        <select class="form-control" id="account_name" name="account_name">
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
                                <div class="col-md-5 col-sm-5">
                                    <div class="form-group">
                                        <label>Report period</label>
                                        <select class="form-control" id="report_period" name="report_period">
                                            <option>Since 365 Days Ago</option>
                                            <option>All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="history_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
                              <thead>
                                <tr>
                                    <th>STATEMENT ENDING DATE</th>
                                    <th>RECONCILED ON</th>
                                    <th>ENDING BALANCE</th>
                                    <th>AUTO ADJUSTMENT</th>
                                    <th>STATEMENT</th>
                                    <th>ACTION</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php $i=0;?>
                                <?php foreach($rows as $row){?>
                                <tr>
                                  <td><?=$row->ending_date?></td>
                                  <td><?=$row->adjustment_date?></td>
                                  <td><?=$row->ending_balance?></td>
                                  <td>0.00</td>
                                  <td><a href="#">Attach</a></td>
                                  <td>
                                    <div class="dropdown show">
                                      <a class="dropdown-toggle" href="<?=url('accounting/reconcile/view/report/').$row->chart_of_accounts_id?>" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <a href="<?=url('accounting/reconcile/view/report/').$row->chart_of_accounts_id?>">View Report</a>
                                      </a>

                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" href="<?=url('accounting/reconcile/view/report_print/').$row->chart_of_accounts_id?>" >Print</a>
                                      </div> 
                                    </div>
                                  </td>
                                </tr>
                                <?php $i++;?>
                                <?php } ?>
                              </tbody>
                            </table>
                            <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>