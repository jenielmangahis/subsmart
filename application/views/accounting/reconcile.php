<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
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
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-2">
                        <h1 class="page-title">Reconcile</h1>
                    </div>
                    <div class="col-md-3">
                        <h4>Cash on hand</h4>
                    </div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->service_charge?>.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->interest_earned?>.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->ending_balance-111111?>.00</h4></div>
                    <div class="col-sm-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown show">
                            <a href="<?php echo url('accounting/reconcile/edit/')?><?=$rows[0]->id?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    Edit Info
                            </a>
                             <a href="#" class="btn btn-primary"
                                   aria-expanded="false">
                                    Save for later
                              </a>
                              <a class="btn btn-primary hide-toggle dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-chevron-down"></i>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Finish Now</a>
                                <a class="dropdown-item" href="#">Save for later</a>
                                <a class="dropdown-item" href="#">Close without saving</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">Statement ending date:</div>
                    <div class="col-md-3">July 10, 2020</div>
                    <div class="col-md-1 hide-col">1PAYMENT</div>
                    <div class="col-md-1 hide-col">1DEPOSIT</div>
                    <div class="col-md-1 hide-col">DIFFERENCE</div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <p>
                      <button class="btn btn-primary ex-button" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-chevron-down"></i>
                      </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">
                       <p style="color: #ffff"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                         <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4"><h3>$<?=$rows[0]->ending_balance?>.00</h3></div>
                                    <div class="col-md-1"><h4>-</h4></div>
                                    <div class="col-md-4"><h3>$111,111.00</h3></div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-4">STATEMENT ENDING BALANCE</div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">CLEARED BALANCE</div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3"><h4>$111,111.00</h4></div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5"><h4>$<?=$rows[0]->service_charge?>.00</h4></div>
                                            <div class="col-md-2"><h4>+</h4></div>
                                            <div class="col-md-5"><h4>$<?=$rows[0]->interest_earned?>.00</h4></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">BEGINNING BALANCE</div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5">1 PAYMENT</div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-5">1 DEPOSIT</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12"><h3>$<?=$rows[0]->ending_balance-111111?>.00</h3></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">DIFFERENCE</div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
           
             <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2"><a href="">Show me around</a></div>
                            </div>
                             <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <ul class="nav nav-pills nav-fill" style="border: 5;">
                                      <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="payments()">Payments</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="deposites()">Deposites</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link active" href="#" onclick="displayall()">All</a>
                                      </li>
                                    </ul>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-1 form-group">
                                     <div class="dropdown">
                                       <a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a>
                                       <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cog"></i>
                                       </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        Edit Columns<br/>
                                        <p class="p-padding"><input type="checkbox" name="chk_type" id="chk_type" checked="checked" onchange="col_type()"> Type</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_refno" id="chk_refno" checked="checked" onchange="col_refno()"> Ref. no</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_account" id="chk_account" checked="checked" onchange="col_account()"> Account</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_payee" id="chk_payee" checked="checked" onchange="col_payee()"> Payee</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_memo" id="chk_memo" checked="checked" onchange="col_memo()"> Memo</p>
                                        <!-- <p class="p-padding"><input type="checkbox" name="chk_status" id="chk_status" checked="checked" onchange="col_status()"> Banking Status</p> -->
                                        <br/>
                                        Display Density
                                        <p class="p-padding"><input type="radio" name="" id=""> Regular</p>
                                        <p class="p-padding"><input type="radio" name="" id=""> Compact</p>
                                        <p class="p-padding"><input type="radio" name="" id=""> Ultra compact</p>
                                      </div>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-7">
                                    <section class="filter-wrp">
                                        <div class="container">
                                            <div class="filter-box dropdown">
                                                <a href="javascript:void(0);" class="dropopenbx"><i class="fa fa-filter"></i></a>

                                                <div class="dropdown-menu">
                                                    <div class="inner-filter-list">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Find</label>
                                                                    <input type="search" id="find" size="20" maxlength="524288" minlength="0" class="form-control" placeholder="Memo, Ref. no, $amt, >$amt, <$amt" aria-controls="reconcile_table">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Cleared status</label>
                                                                    <select id="cleardrop" name="cleardrop" class="form-control">
                                                                        <option>All</option>
                                                                        <option>Cleared</option>
                                                                        <option>Not Cleared</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Transaction type</label>
                                                                    <select class="form-control">
                                                                        <option>All</option>
                                                                        <option>Bill</option>
                                                                        <option>Bill Payment</option>
                                                                        <option>CC Bill Payment</option>
                                                                        <option>Cash Expense</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Payee</label>
                                                                    <select class="form-control">
                                                                        <option>All</option>
                                                                        <option>Cleared</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <select id="dropdate" name="dropdate" class="form-control" onchange="myfunc();">
                                                                        <option>All</option>
                                                                        <option>Custome Date</option>
                                                                        <option>Statement Ending Date</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>From</label>
                                                                    <div class="col-xs-10 date_picker">
                                                                    <input type="text" id="from_date" name="from_date" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>To</label>
                                                                    <div class="col-xs-10 date_picker">
                                                                    <input type="text" id="to_date" name="to_date" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="btn-group">
                                                            <a href="#" class="btn-main">Reset</a>
                                                            <a href="#" id="apply-btn" class="btn-main apply-btn">Apply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                 </div>
                                 <div class="col-md-3"><a href="#"><i class="fa fa-close"></i>Statment ending date</a></div>
                                 <div class="col-md-2"><a href="#">Clear All / View All</a></div>
                             </div>
                            <table id="reconcile_table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th class="type">TYPE</th>
                                    <th class="refno">REF. NO</th>
                                    <th class="account">ACCOUNT</th>
                                    <th class="payee">PAYEE</th>
                                    <th class="memo">MEMO</th>
                                    <!-- <th class="status">status</th> -->
                                    <th>PAYMENT(USD)</th>
                                    <th>DEPOSIT(USD)</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                            <?php
                              $i=1;
                              foreach($rows as $row)
                              {
                                echo "<tr style='display:none'><td id='ending_date' style='display:none'>".$row->ending_date."</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                echo "<tr id='payments'>";
                                echo "<td contenteditable='true'>".$row->first_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' contenteditable='true'>SVCCHRG</td>";
                                echo "<td class='account'>".$row->expense_account."</td>";
                                echo "<td class='payee' contenteditable='true'>";
                                    echo "<select class='form-control select2'>";
                                    echo "<option value=' disabled selected>Payee</option>";
                                    echo "<option value='1'>Option 1</option>";
                                    echo "<option value='2'>Option 2</option>";
                                    echo "<option value='2'>Option 3</option>";
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td class='memo' contenteditable='true'>Service Charges</td>";
                                /*echo  "<td class='status'></td>";*/
                                echo  "<td contenteditable='true'>".$row->service_charge."</td>";
                                echo  "<td></td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                                echo "<tr id='deposites'>";
                                echo "<td contenteditable='true'>".$row->second_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' contenteditable='true'>INTEREST</td>";
                                echo "<td class='account'>".$row->income_account."</td>";
                                echo "<td class='payee' contenteditable='true'>";
                                    echo "<select class='form-control select2'>";
                                    echo "<option value=' disabled selected>Payee</option>";
                                    echo "<option value='1'>Option 1</option>";
                                    echo "<option value='2'>Option 2</option>";
                                    echo "<option value='2'>Option 3</option>";
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td class='memo' contenteditable='true'>Interest Earned</td>";
                                /*echo  "<td class='status'></td>";*/
                                echo  "<td contenteditable='true'></td>";
                                echo  "<td>".$row->interest_earned."</td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                              $i++;
                              }
                               ?>
                                </tbody>
                            </table>
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
<script>
    function convertDate(inputFormat) {
      function pad(s) { return (s < 10) ? '0' + s : s; }
      var d = new Date(inputFormat)
      return [pad(d.getDate()), pad(d.getMonth()), d.getFullYear()].join('.')
    }
    $(document).ready(function() {
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
        $('.select2').select2();
        $('#from_date').attr("disabled", "disabled" );
        $('#to_date').attr("disabled", "disabled" );
    } );

    var table = $('#reconcile_table').DataTable({sDom: 'lrtip'});
    /*$('#find').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );*/

    $('#apply-btn').on( 'click', function () {
        var find = $('#find').val();
        if(find!='')
        {
            table.search( find ).draw();
        }
        var selectBox = document.getElementById("cleardrop");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue == 'Not Cleared')
        {
            $("#tbody").hide();
        }
        else
        {
            $("#tbody").show();
        }
        var selectBox1 = document.getElementById("dropdate");
        var selectedValue1 = selectBox1.options[selectBox1.selectedIndex].value;
       if(selectedValue1 == 'Custome Date')
       {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var temp_date = from_date.split(".");
        var temp_date2 = to_date.split(".");
        var xxx = "";
        for (var d = new Date(temp_date[2],temp_date[1],temp_date[0]); d <= new Date(temp_date2[2],temp_date2[1],temp_date2[0]); d.setDate(d.getDate() + 1)) {
            if(xxx == '')
            {
                xxx =convertDate(d);
            }
            else
            {
                xxx = xxx+'|'+convertDate(d);
            }
        }
        table.search('"'+xxx+'"',true,false).draw();
       }
       else if (selectedValue1 == 'Statement Ending Date')
       {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        table.search( to_date ).draw();
       }
    });

    function myfunc() {
    var selectBox = document.getElementById("dropdate");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
       if(selectedValue == 'Custome Date')
       {
        $('#from_date'). removeAttr("disabled","disabled");
        $('#to_date'). removeAttr("disabled","disabled");
        $('#from_date').val(null);
        $('#to_date').val(null);
       }
       else if (selectedValue == 'Statement Ending Date')
       {
        $('#from_date'). removeAttr("disabled","disabled");
        $('#to_date'). removeAttr("disabled","disabled");
        $('#from_date').val(null);
        var ending_date = $("#ending_date").text();
        $('#to_date').val(ending_date);
        /*var temp_date = ending_date.split(".");
        var new_date = temp_date[2]+'-'+temp_date[1]+'-'+temp_date[0];*/
       }
       else
       {
        $('#from_date').attr("disabled", "disabled" );
        $('#to_date').attr("disabled", "disabled" );
       }
   }

   /* $(".ex-button").click(function() {
        $('.ex-button').html('<i class="fa fa-chevron-up"></i>');
        $('.hide-col').css('color','#dddddd');
    });
    $(".ex-button").click(function() {
    if($( ".collapse" ).hasClass( "show" ))
    {
        $('.ex-button').html('<i class="fa fa-chevron-down"></i>');
        $('.hide-col').css('color','black');
    }
    });*/

    function payments()
    {
        $("#deposites").hide();
        $("#payments").show();
    }
    function deposites()
    {
        $("#deposites").show();
        $("#payments").hide();
    }
    function displayall()
    {
        $("#deposites").show();
        $("#payments").show();
    }
</script>

<!-- filter -->
<script type="text/javascript">
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
function col_refno()
{
    if($('#chk_refno').attr('checked'))
    {
        $('#chk_refno').removeAttr('checked');
        $('.refno').css('display','none');

    }
    else
    {
        $('#chk_refno').attr('checked',"checked");
        $('.refno').css('display','');
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
function col_payee()
{
    if($('#chk_payee').attr('checked'))
    {
        $('#chk_payee').removeAttr('checked');
        $('.payee').css('display','none');

    }
    else
    {
        $('#chk_payee').attr('checked',"checked");
        $('.payee').css('display','');
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
function col_status()
{
    if($('#chk_status').attr('checked'))
    {
        $('#chk_status').removeAttr('checked');
        $('.status').css('display','none');

    }
    else
    {
        $('#chk_status').attr('checked',"checked");
        $('.status').css('display','');
    }
}    

$('.dropopenbx').on('click', function(){
  $('.dropdown-menu').toggleClass('dropopn');
});
</script>