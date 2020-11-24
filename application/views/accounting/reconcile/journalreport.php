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
                        <h1 class="page-title">Journal Report</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="<?=url('accounting/reconcile/view/summary')?>">Summary</a> | <a href="<?=url('accounting/reconcile')?>">Reconcile</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Report period</label>
                            <select class="form-control" id="date_filter" name="date_filter">
                                <option></option>
                                <option></option>
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div id="changeme">
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
                                         <a href="#" onclick = "print_this('print_section')"><i class="fa fa-print"></i></a>
                                      </div>
                                   </div>
                               </div>
                               <div id="print_section">
                                 <div style="text-align: center;margin-bottom: 10px;">
                                     <div class="row">
                                         <div class="col-md-12">
                                            ADI
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-md-12">
                                            JOURNAL
                                         </div>
                                     </div>
                                     <div class="row">
                                     <div class="col-md-12">
                                            All Dates
                                         </div>
                                     </div>
                                </div>
                                <?php
                                 if($type=='sc')
                                {
                                   $date = $rows->first_date;
                                   $memo = $rows->memo_sc;
                                   $account = $rows->expense_account;
                                   $descp = $rows->descp_sc;
                                   $amount = $rows->service_charge;
                                }
                                else
                                {
                                    $date = $rows->second_date;
                                    $memo = $rows->memo_it;
                                    $account = $rows->income_account;
                                    $descp = $rows->descp_it;
                                    $amount = $rows->interest_earned;
                                }
                                $main_account = $this->chart_of_accounts_model->getName($rows->chart_of_accounts_id);
                                $total = $amount;
                                ?>
                                <div class="row" style="margin-top:5%">
                                  <div class="col-md-12">
                                    <table id="report_table" class="table accordion" style="width:100%;cursor: pointer;">
                                      <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NUM</th>
                                        <th>NAME</th>
                                        <th>MEMO/DESCRIPTION</th>
                                        <th>ACCOUNT</th>
                                        <th>DEBIT</th>
                                        <th>CREDIT</th>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><?=$date?></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><?=$memo?></td>
                                          <td><?=$main_account?></td>
                                          <td></td>
                                          <td class="total"></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><?=$descp?></td>
                                          <td><?=$account?></td>
                                          <td><?=$amount?></td>
                                          <td></td>
                                        </tr>
                                        <?php
                                        $subtotal = 0;
                                        foreach ($subrows as $key => $value) {
                                          if($type=='sc')
                                          {
                                            $sub_account = $subrows[$key]->expense_account_sub;
                                            $sub_amount = $subrows[$key]->service_charge_sub;
                                            $sub_descp = $subrows[$key]->descp_sc_sub;
                                          }
                                          else
                                          {
                                            $sub_account = $subrows[$key]->income_account_sub;
                                            $sub_amount = $subrows[$key]->interest_earned_sub;
                                            $sub_descp = $subrows[$key]->descp_it_sub;
                                          } 
                                          $subtotal +=$sub_amount;
                                        ?>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><?=$sub_descp?></td>
                                          <td><?=$sub_account?></td>
                                          <td><?=$sub_amount?></td>
                                          <td></td>
                                        </tr>
                                        <?php
                                        }
                                        $finaltotal = $total +=$subtotal; 
                                        ?>
                                        <input type="hidden" id="finaltotal" value="<?=$finaltotal?>">
                                        <tr>
                                          <td colspan="6"></td>
                                          <td class="total"></td>
                                          <td class="total"></td>
                                        </tr>
                                        <tr><td colspan="8"><div class="line"></div></td></tr>
                                        <tr>
                                          <td colspan="6">Total</td>
                                          <td></td>
                                          <td class="total"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <!-- end card -->
                  </div>
              </div>
            </div>
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
$(document).ready(function () {
    $('.total').text($('#finaltotal').val());
    var table = $('#report_table').DataTable();
});
$('#date_filter').on('change', function() {
 //getReport(this.value);
});
function getReport(id)
{
  var id = id;
  if(id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/view/journalreportajax/') ?>"+id,
        method: "POST",
        success:function(data)
        {
           $("#changeme").html(data);
        }
    })
  }
}

    window.print_this = function(id) {
    var prtContent = document.getElementById(id);
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

    
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.print();
}
</script>