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
                                         <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cog"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            Change coloumns<br/>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_date()" name="chk_date" id="chk_date"> Date</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_type()" name="chk_type" id="chk_type">Type</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_num()" name="chk_num" id="chk_num"> Number</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_name()" name="chk_name" id="chk_name"> Name</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_memo()" name="chk_memo" id="chk_memo"> Memo</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_account()" name="chk_account" id="chk_account"> Account</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_debit()" name="chk_debit" id="chk_debit"> Debit</p>
                                            <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_credit()" name="chk_credit" id="chk_credit"> Credit</p>
                                            <br/>
                                        </div>
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
                                        <th class="date">DATE</th>
                                        <th class="type">TRANSACTION TYPE</th>
                                        <th class="num">NUM</th>
                                        <th class="name">NAME</th>
                                        <th class="memo">MEMO/DESCRIPTION</th>
                                        <th class="account">ACCOUNT</th>
                                        <th class="debit">DEBIT</th>
                                        <th class="credit">CREDIT</th>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="date"><?=$date?></td>
                                          <td class="type"></td>
                                          <td class="num"></td>
                                          <td class="name"></td>
                                          <td class="memo"><?=$memo?></td>
                                          <td class="account"><?=$main_account?></td>
                                          <td class="debit"></td>
                                          <td class="total credit"></td>
                                        </tr>
                                        <tr>
                                          <td class="date"></td>
                                          <td class="type"></td>
                                          <td class="num"></td>
                                          <td class="name"></td>
                                          <td class="memo"><?=$descp?></td>
                                          <td class="account"><?=$account?></td>
                                          <td class="debit"><?=$amount?></td>
                                          <td class="credit"></td>
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
                                          <td class="date"></td>
                                          <td class="type"></td>
                                          <td class="num"></td>
                                          <td class="name"></td>
                                          <td class="memo"><?=$sub_descp?></td>
                                          <td class="account"><?=$sub_account?></td>
                                          <td class="debit"><?=$sub_amount?></td>
                                          <td class="credit"></td>
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


function col_date()
{
    if($('#chk_date').attr('checked'))
    {
        $('#chk_date').removeAttr('checked');
        $('.date').css('display','none');

    }
    else
    {
        $('#chk_date').attr('checked',"checked");
        $('.date').css('display','');
    }
}
function col_type()
{
    if($('#chk_type').attr('checked'))
    {
        $('#chk_type').removeAttr('checked');
        $('.type').css('display','none');

    }
    else
    {
        $('#chk_type').attr('checked',"checked");
        $('.type').css('display','');
    }
}
function col_num()
{
    if($('#chk_num').attr('checked'))
    {
        $('#chk_num').removeAttr('checked');
        $('.num').css('display','none');

    }
    else
    {
        $('#chk_num').attr('checked',"checked");
        $('.num').css('display','');
    }
}
function col_name()
{
    if($('#chk_name').attr('checked'))
    {
        $('#chk_name').removeAttr('checked');
        $('.name').css('display','none');

    }
    else
    {
        $('#chk_name').attr('checked',"checked");
        $('.name').css('display','');
    }
}
function col_memo()
{
    if($('#chk_memo').attr('checked'))
    {
        $('#chk_memo').removeAttr('checked');
        $('.memo').css('display','none');

    }
    else
    {
        $('#chk_memo').attr('checked',"checked");
        $('.memo').css('display','');
    }
}
function col_account()
{
    if($('#chk_account').attr('checked'))
    {
        $('#chk_account').removeAttr('checked');
        $('.account').css('display','none');

    }
    else
    {
        $('#chk_account').attr('checked',"checked");
        $('.account').css('display','');
    }
}
function col_debit()
{
    if($('#chk_debit').attr('checked'))
    {
        $('#chk_debit').removeAttr('checked');
        $('.debit').css('display','none');

    }
    else
    {
        $('#chk_debit').attr('checked',"checked");
        $('.debit').css('display','');
    }
}
function col_credit()
{
    if($('#chk_credit').attr('checked'))
    {
        $('#chk_credit').removeAttr('checked');
        $('.credit').css('display','none');

    }
    else
    {
        $('#chk_credit').attr('checked',"checked");
        $('.credit').css('display','');
    }
}
</script>