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
<?php 

?>

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box" style="margin-top: 30px !important">
              <div class="row">
                    <div class="col-md-10">
                        <h1 class="page-title">Reconcilation Report</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a> | <a href="<?=url('accounting/reconcile')?>">Reconcile</a>
                    </div>
                </div>
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
                            <label>Statement ending date</label>
                            <select class="form-control" id="ending_date_select" name="ending_date_select">
                                <?php
                                   $i=1;
                                   foreach($this->reconcile_model->selectAll() as $row)
                                   {
                                    ?>
                                    <option value="<?=$row->id?>"><?=$row->ending_date?></option>
                                  <?php
                                  $i++;
                                  }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div id="changeme">
           <?php foreach ($rows as $row) {
            $accBalance = $this->chart_of_accounts_model->getBalance($row->chart_of_accounts_id);
            $adjustment = $row->ending_balance-(($accBalance-$row->service_charge)+$row->interest_earned);
            ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                             <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-1 form-group">
                                     <div class="dropdown">
                                       <a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a>
                                    </div>
                                 </div>
                             </div>
                             <div style="text-align: center;margin-bottom: 10px;">
                                 <div class="row">
                                     <div class="col-md-12">
                                        ADI
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <?=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)?>,Period Ending <?=$row->ending_date?>
                                     </div>
                                 </div>
                                 <div class="row">
                                 <div class="col-md-12">
                                        RCONCILATION REPORT
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        Reconciled on : <?=$row->adjustment_date?>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        Reconciled by : -
                                     </div>
                                 </div>
                            </div>
                            Any changes made to transactions after this date aren't included in this report.
                            <div class="line"></div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2">
                                    Summary
                                </div>
                                <div class="col-md-9"></div>
                                <div class="col-md-1">
                                    USD
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Statement beginning balance
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    <?=number_format($accBalance,1)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    Service Charge
                                </div>
                                <div class="col-md-9 dott"></div>
                                <div class="col-md-1">
                                    -<?=number_format($row->service_charge,1)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    Interest Earned
                                </div>
                                <div class="col-md-9 dott"></div>
                                <div class="col-md-1">
                                    <?=number_format($row->interest_earned,1)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Checks & payment cleared(0)
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    0.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Deposit & other credit cleared(0)
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    0.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    Adjustment
                                </div>
                                <div class="col-md-9 dott"></div>
                                <div class="col-md-1">
                                    <?=number_format($adjustment,1);?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Statement ending balance
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    <?=number_format($row->ending_balance,1)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11"></div>
                                <div class="col-md-1">
                                    ======
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Register balance as of <?=$row->ending_date?>
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    <?=number_format($row->ending_balance,1)?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php } ?>
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
<script type="text/javascript">
$('#account_name').on('change', function() {
 select_acc(this.value);
 getReport(this.value);
});
$(document).ready(function () {
    select_acc($('#account_name').val());
});
function select_acc(chart_of_accounts_id)
{
  var chart_of_accounts_id = chart_of_accounts_id;
  if(chart_of_accounts_id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/view/fetch_ending_date') ?>",
        method: "POST",
        data: {chart_of_accounts_id:chart_of_accounts_id},
        success:function(data)
        {
            $("#ending_date_select").html(data);
        }
    })
  }
}
function getReport(chart_of_accounts_id)
{
  var chart_of_accounts_id = chart_of_accounts_id;
  if(chart_of_accounts_id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/view/reportajax/') ?>"+chart_of_accounts_id,
        method: "POST",
        success:function(data)
        {
           $("#changeme").html(data);
        }
    })
  }
}
</script>