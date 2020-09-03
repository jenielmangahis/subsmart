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
<?php 
$accBalance = $this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id);
?>

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    
                </div>
            </div>
            <!-- end row -->
           
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
                             <div style="text-align: center;">
                                 <div class="row">
                                     <div class="col-md-12">
                                        ADI
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        <?=$this->chart_of_accounts_model->getName($rows[0]->chart_of_accounts_id)?>,Period Ending <?=$rows[0]->ending_date?>
                                     </div>
                                 </div>
                                 <div class="row">
                                 <div class="col-md-12">
                                        RCONCILATION REPORT
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                        Reconciled on : -
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
                            <div class="row">
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
                                    <?=$accBalance?>.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    Service Charge
                                </div>
                                <div class="col-md-9 dott"></div>
                                <div class="col-md-1">
                                    -<?=$rows[0]->service_charge?>.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    Interest Earned
                                </div>
                                <div class="col-md-9 dott"></div>
                                <div class="col-md-1">
                                    <?=$rows[0]->interest_earned?>.00
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
                                    <?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?>.00
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Statement ending balance
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    <?=$rows[0]->ending_balance?>.00
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
                                    Register balance as of <?=$rows[0]->ending_date?>
                                </div>
                                <div class="col-md-8 dott"></div>
                                <div class="col-md-1">
                                    <?=$rows[0]->ending_balance?>.00
                                </div>
                            </div>
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