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
                    <div class="col-md-1 hide-col"><h4>$20.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$10.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$-91,101.00</h4></div>
                    <div class="col-sm-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown show">
                            <a href="#" class="btn btn-primary"
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
                                    <div class="col-md-4"><h3>$20,000.00</h3></div>
                                    <div class="col-md-1"><h4>-</h4></div>
                                    <div class="col-md-4"><h3>$111,101.00</h3></div>
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
                                            <div class="col-md-5"><h4>$20.00</h4></div>
                                            <div class="col-md-2"><h4>+</h4></div>
                                            <div class="col-md-5"><h4>$10.00</h4></div>
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
                                    <div class="col-md-12"><h3>$-91,101.00</h3></div>
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
                                       <a href="" ><i class="fa fa-print"></i></a>
                                       <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cog"></i>
                                       </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        Edit Columns<br/>
                                        <p class="p-padding"><input type="checkbox" name="chk_type" id="chk_type"> Type</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_detail_type" id="chk_detail_type"> Ref. no</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_nsmart_balance" id="chk_nsmart_balance"> Account</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_balance" id="chk_balance"> Payee</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_balance" id="chk_balance"> Memo</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_balance" id="chk_balance"> Banking Status</p>
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
                                     <div class="dropdown">
                                       <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-filter"></i>
                                       </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                         <table style="width:100%">
                                            <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <label for="find">Find</label>
                                                    <input id="find" autocomplete="on" size="20" maxlength="524288" minlength="0" type="text" name="freeText" placeholder="Memo, Ref. no, $amt, >$amt, <$amt">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="cleared_status">Cleared status</label>
                                                    <select name="cleared_status" id="cleared_status" class="form-control select2" required>
                                                        <option value="">All</option>
                                                        <option value="">Cleared</option>
                                                        <option value="">Not cleared</option>
                                                    </select>
                                                </td>
                                                 <td>
                                                    <label for="transaction_type">Transaction type</label>
                                                    <select name="transaction_type" id="transaction_type" class="form-control select2" required>
                                                        <option value="">All</option>
                                                        <option value="">Cleared</option>
                                                        <option value="">Not cleared</option>
                                                    </select>
                                                </td>
                                                 <td>
                                                    <label for="payee">Payee</label>
                                                    <select name="payee" id="payee" class="form-control select2" required>
                                                        <option value="">All</option>
                                                        <option value="">Cleared</option>
                                                        <option value="">Not cleared</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="date">Date</label>
                                                    <select name="date" id="date" class="form-control select2" required>
                                                        <option value="">All</option>
                                                        <option value="">Cleared</option>
                                                        <option value="">Not cleared</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <label for="name">From</label>
                                                    <div class="col-xs-10 date_picker">
                                                        <input type="text" id="from" class="form-control" name="from" placeholder="">
                                                  </div>
                                                </td>
                                                <td>
                                                    <label for="name">To</label>
                                                    <div class="col-xs-10 date_picker">
                                                        <input type="text" id="to" class="form-control" name="to" placeholder="">
                                                  </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button type="submit" class="btn btn-flat btn-primary">Reset</button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-flat btn-primary">Cancel</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3"><a href="#"><i class="fa fa-close"></i>Statment ending date</a></div>
                                 <div class="col-md-2"><a href="#">Clear All / View All</a></div>
                             </div>
                            <table id="charts_of_account_table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>TYPE</th>
                                    <th>REF. NO</th>
                                    <th>ACCOUNT</th>
                                    <th>PAYEE</th>
                                    <th>MEMO</th>
                                    <th>PAYMENT(USD)</th>
                                    <th>DEPOSIT(USD)</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                              $i=1;
                              foreach($this->reconcile_model->select() as $row)
                              {
                                echo "<tr id='payments'>";
                                echo "<td contenteditable='true'>".$row->first_date."</td>";
                                echo "<td>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td contenteditable='true'>SVCCHRG</td>";
                                echo "<td>".$row->expense_account."</td>";
                                echo "<td contenteditable='true'>";
                                    echo "<select class='form-control select2'>";
                                    echo "<option value=' disabled selected>Payee</option>";
                                    echo "<option value='1'>Option 1</option>";
                                    echo "<option value='2'>Option 2</option>";
                                    echo "<option value='2'>Option 3</option>";
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td contenteditable='true'>Service Charges</td>";
                                echo  "<td contenteditable='true'>".$row->service_charge."</td>";
                                echo  "<td></td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                                echo "<tr id='deposites'>";
                                echo "<td contenteditable='true'>".$row->second_date."</td>";
                                echo "<td>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td contenteditable='true'>INTEREST</td>";
                                echo "<td>".$row->income_account."</td>";
                                echo "<td contenteditable='true'>";
                                    echo "<select class='form-control select2'>";
                                    echo "<option value=' disabled selected>Payee</option>";
                                    echo "<option value='1'>Option 1</option>";
                                    echo "<option value='2'>Option 2</option>";
                                    echo "<option value='2'>Option 3</option>";
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td contenteditable='true'>Interest Earned</td>";
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
    $(document).ready(function() {
        $('#charts_of_account_table').DataTable();
    } );

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


    $(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
        $('.select2').select2()
    });

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