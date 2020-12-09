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
width: 970px;
height: 4px;
border-bottom: 1px solid black;
position: absolute;
margin-left: -10px;
margin-top: 6px;
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
                        <h1 class="page-title">Audit history</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a> | <a href="<?=url('accounting/reconcile')?>">Reconcile</a>
                    </div>
                </div>
            </div>
            <!-- end row -->

              <div class="row">
                  <div class="col-xl-12">
                      <div class="card">
                          
                              <!-- Audit -->
                              <section class="audit-wrp">
                                <div class="container">
                                  <div class="audit-heading">
                                    <h5>Lorem ipsum dolor sit amet, <a href="#">Check No. 12347 ID:2560</a><a href="#"><i class="fa fa-print"></i></a></h5>
                                  </div>
                                  <!--Accordion wrapper-->
                                  <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card -->
                                   
                                    <?php
                                    $count=1;
                                    foreach ($rows as $row) {
                                      if($type=='sc')
                                      {
                                        $amount = $row->service_charge;
                                      }
                                      else
                                      {
                                        $amount = $row->interest_earned;
                                      }
                                    ?>
                                      <!-- Card header -->
                                      <div class="card-header" role="tab" id="headingOne<?=$count?>">
                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?=$count?>" aria-expanded="true"
                                          aria-controls="collapseOne<?=$count?>">
                                          <h5 class="mb-0">
                                             <i class="fa fa-sort-down"></i><?=date('M j, Y H:i A', strtotime($row->created_at))?>:<span><?=$row->action?> by Nik Estrada</span>
                                          </h5>
                                        </a>
                                      </div>

                                      <!-- Card body -->
                                      <div id="collapseOne<?=$count?>" class="collapse show" role="tabpanel" aria-labelledby="headingOne<?=$count?>" data-parent="#accordionEx">
                                        <div class="card">
                                          <div class="table-dt">
                                            <div class="row">
                                              <div class="col-md-4">
                                                <table class="table">
                                                  <tbody>
                                                    <tr>
                                                      <td>Type:</td>
                                                      <td>Check</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Date:</td>
                                                      <td><?=$row->ending_date?></td>
                                                    </tr>
                                                    <tr>
                                                      <td>Amount:</td>
                                                      <td><?=$amount?></td>
                                                    </tr>
                                                    <tr>
                                                      <td>Check Printed:</td>
                                                      <td>Not Printed</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Memo:</td>
                                                      <td><?=$row->memo_sc?></td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                              <div class="col-md-3">
                                                <table class="table">
                                                  <tbody>
                                                    <tr>
                                                      <td>Num:<td>
                                                      <td><?=$row->checkno?></td>
                                                    </tr>
                                                    <tr>
                                                      <td>Nume:</td>
                                                      <td></td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="table-block">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>CUstomer:</th>
                                                    <th>Deseription:</th>
                                                    <th>Clr</th>
                                                    <th>Match Status</th>
                                                    <th>Account</th>
                                                    <th>Amount</th>
                                                  </tr>
                                              </thead>
                                                <tbody>
                                                <tr>
                                                   <td>0</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?=$row->descp_sc?></td>
                                                    <td></td>
                                                    <td><?=$row->expense_account?></td>
                                                    <td>-<?=$row->service_charge?></td>
                                                </tr>
                                                <tr>
                                                  <td>1</td>
                                                  <td></td>
                                                  <td><?=$row->descp_it?></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td><?=$row->income_account?></td>
                                                  <td><?=$row->interest_earned?></td>
                                                </tr>
                                                <?php
                                                if($type=='sc'){
                                                ?>
                                                 <?php 
                                                 $i=2;
                                                if(!empty($this->reconcile_model->select_service_history($row->id,$row->chart_of_accounts_id)))
                                                {
                                                foreach($this->reconcile_model->select_service_history($row->id,$row->chart_of_accounts_id) as $subrow)
                                                  {
                                                  ?>
                                                  <tr>
                                                  <td><?=$i?></td>
                                                  <td></td>
                                                  <td><?=$subrow->descp_sc_sub?></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td><?=$subrow->expense_account_sub?></td>
                                                  <td><?=$subrow->service_charge_sub?></td>
                                                </tr>
                                                  <?php
                                                  $i++;
                                                  }
                                                }
                                                ?>
                                                <?php
                                                }else{
                                                  ?>
                                                  <?php 
                                                   $i=2;
                                                  if(!empty($this->reconcile_model->select_interest_history($row->id,$row->chart_of_accounts_id)))
                                                  {
                                                  foreach($this->reconcile_model->select_interest_history($row->id,$row->chart_of_accounts_id) as $subrow)
                                                    {
                                                    ?>
                                                    <tr>
                                                    <td><?=$i?></td>
                                                    <td></td>
                                                    <td><?=$subrow->descp_it_sub?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?=$subrow->income_account_sub?></td>
                                                    <td><?=$subrow->interest_earned_sub?></td>
                                                  </tr>
                                                    <?php
                                                    $i++;
                                                    }
                                                  }
                                                  ?>
                                                  <?php
                                                }
                                                ?>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>

                                      <?php
                                      $count++;
                                      }
                                      ?>
                              </section>
                              <!-- End Audit -->
                          
                        </div>
                  </div>
              </div>

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
$(document).ready(function () {
    var table = $('#report_table').DataTable();
});
</script>