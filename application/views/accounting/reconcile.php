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
</style>
<?php 
$accBalance = $this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id);
?>
    <!-- Popup -->
    <div class="modal fade" id="popup-opn" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>Reconciliation saved for later.</h4>
                            <p>You can upload statements to this reconcilation to find it when you come back later.</p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton" onclick="openSideNav3()">Upload statement</a>
                        <a href="#" class="btn-main">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Popup -->

    <!-- Close Popup -->
    <div class="modal fade" id="popup-cls" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>We'll remove all of your changes</h4>
                            <p>If you close without saving your work, we reset all the transactions to their original state when you opened this reconciliation session. We also remove the statement info that you entered.</p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton" onclick="closedelete(<?=$rows[0]->id?>)">Close without saving</a>
                        <a href="#" class="btn-main">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Close Popup -->

    <!-- Finish Popup -->
    <div class="modal fade" id="popup-finish" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>You reconciled this account</h4>
                            <p>To see a report of this reconcilation, click <a href= "<?=url('accounting/reconcile/view/report/'.$rows[0]->chart_of_accounts_id.'')?>">view reconilation report<a>.Otherwise, you're done!</p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton">Attach statement</a>
                        <a href="#" class="btn-main">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Finish Popup -->

    <!-- Hold Popup -->
    <div class="modal fade" id="popup-hold" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>Hold on! Your difference isn't $0.00 yet.</h4>
                            <p>You aren't ready to reconcile yet because your transactions in QuickBooks don't match your statement. When they match, you'll have a difference of $0.00. Help me find the problem</p>
                            <p>If you'd still like to proceed, confirm the following below, and then click Add adjustment and finish.</p>
                            <p>
                                <label>Adjustment Date*</label>
                                <div class="row">
                                    <div class="col-xs-1 date_picker">
                                        <input type="text" required="required" id="adjustment_date" name="adjustment_date" class="form-control">
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton" onclick="openFinishpop(<?=$rows[0]->id?>)">Add adjustment and finish</a>
                        <a href="#" class="btn-main">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hold Popup -->


    <!-- Add Custom Tax Sidebar -->
    <div id="overlay-cus-tx" class=""></div>
    <div id="side-menu-cus-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Statement attachments - Cash on hand</h4>
            <a id="close-menu-cus-tx" class="menuCloseButton" onclick="closeSideNav3()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        
        <?php echo form_open_multipart('accounting/reconcile/do_upload/'.$rows[0]->chart_of_accounts_id);?>
        <div class="mainMenu nav">
            <div class="file-upload-block">
                <div class="upload-btn-wrapper">
                    <button class="btn">
                        <i class="fa fa-cloud-upload"></i>
                        <h6>Drag and drop files here or <span>browse to upload</span></h6>
                    </button>
                    <input type="file" name="userfile" />
                </div>
            </div>
        </div>

        <div class="save-act">
            <button class="btn-cmn">Cancel</button>
            <button type="submit" class="savebtn">Done</button>
        </div>
    </div>
    <!-- End Add Custom Tax Sidebar -->

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
                        <h4><?=$this->chart_of_accounts_model->getName($rows[0]->chart_of_accounts_id)?></h4>
                    </div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->service_charge?>.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->interest_earned?>.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?>.00</h4></div>
                    <div class="diff" style="display: none;"><?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?></div>
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
                                <a class="dropdown-item" href="#" data-toggle="modal"  onclick="getDiff()" >Finish Now</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#popup-opn">Save for later</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#popup-cls">Close without saving</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">Statement ending date:</div>
                    <div class="col-md-3"><?=date("d.m.Y", strtotime($rows[0]->ending_date));?></div>
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
                                    <div class="col-md-4"><h3>$<?=($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned?>.00</h3></div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-4">STATEMENT ENDING BALANCE</div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">CLEARED BALANCE</div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3"><h4>$<?=$accBalance?>.00</h4></div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5"><h4>$<?=$rows[0]->service_charge?></h4></div>
                                            <div class="col-md-2"><h4>+</h4></div>
                                            <div class="col-md-5"><h4>$<?=$rows[0]->interest_earned?></h4></div>
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
                                    <div class="col-md-12"><h3>$<?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?>.00</h3></div>
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
                                                                    <select id="transaction_type" class="form-control">
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
                                                                    <select name='payee_drop' class='form-control select2'>
                                                                        <option value='' disabled selected>All</option>
                                                                        <?php
                                                                        foreach($this->AccountingVendors_model->select() as $ro)
                                                                        {
                                                                            echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                                                        }
                                                                        ?>
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
                                                                    <input type="text" id="from_date" name="from_date" class="form-control disableFuturedate">
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
                                                            <a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applybtn()">Apply</a>
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
                             <?php
                             foreach($rows as $row)
                              {
                                echo "<input id='ending_date' type='hidden' value='".date("d.m.Y", strtotime($rows[0]->ending_date))."'/>";
                              }
                             ?>
                             <div class="row" id="filtername" style="margin-bottom: 20px">
                                 
                             </div>
                            <table id="reconcile_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
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
                              $o=1;
                              foreach($rows as $row)
                              {
                                echo "<tr id='payments' onclick='trClick(".$o.")'>";
                                echo "<td contenteditable='true'>".$row->first_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' contenteditable='true'>SVCCHRG</td>";
                                echo "<td class='account'>".$row->expense_account."</td>";
                                echo "<td name='payee' class='payee' contenteditable='true'>";
                                    echo "<select name='payee' class='form-control select2'>";
                                    echo "<option value='' disabled selected>Payee</option>";
                                    foreach($this->AccountingVendors_model->select() as $ro)
                                    {
                                        echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                    }
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td class='memo' contenteditable='true'>Service Charges</td>";
                                /*echo  "<td class='status'></td>";*/
                                echo  "<td contenteditable='true'>".$row->service_charge."</td>";
                                echo  "<td></td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><input type='text' name='' placeholder='07/01/2020' class='form-control'></td>";
                                echo "<td>Check</td>";
                                echo "<td><input type='text' name='' placeholder='SVCCHRD' class='form-control'></td>";
                                echo "<td><select class='form-control'>
                                        <option>Bank Charges</option>
                                    </select></td>";
                                echo "<td><input type='text' name='' placeholder='Service Charge' class='form-control'></td>";
                                echo "<td><input type='text' name='' placeholder='20.00' class='form-control'></td>";
                                echo "<td>Payment</td>";                                
                                echo "<td></td>";                                
                                echo "<td><i class='fa fa-times' onclick='crossClick(".$o.")'></i></td>";    
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><a href='#' class='btn-ed'>Cancel</a></td>";
                                echo "<td><a href='#' class='btn-ed'>Edit</a></td>";
                                echo "<td><a href='#' class='btn-ed savebt'>Save</a></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                $o++;
                                echo "<tr id='deposites' onclick='trClick(".$o.")'>";
                                echo "<td contenteditable='true'>".$row->second_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' contenteditable='true'>INTEREST</td>";
                                echo "<td class='account'>".$row->income_account."</td>";
                                echo "<td class='payee' contenteditable='true'>";
                                    echo "<select name='payee' class='form-control select2'>";
                                    echo "<option value='' disabled selected>Payee</option>";
                                    foreach($this->AccountingVendors_model->select() as $ro)
                                    {
                                        echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                    }
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td class='memo' contenteditable='true'>Interest Earned</td>";
                                /*echo  "<td class='status'></td>";*/
                                echo  "<td contenteditable='true'></td>";
                                echo  "<td>".$row->interest_earned."</td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><input type='text' name='' placeholder='07/01/2020' class='form-control'></td>";
                                echo "<td>Check</td>";
                                echo "<td><input type='text' name='' placeholder='SVCCHRD' class='form-control'></td>";
                                echo "<td><select class='form-control'>
                                        <option>Bank Charges</option>
                                    </select></td>";
                                echo "<td><input type='text' name='' placeholder='Service Charge' class='form-control'></td>";
                                echo "<td><input type='text' name='' placeholder='20.00' class='form-control'></td>";
                                echo "<td>Payment</td>";                                
                                echo "<td>Payment</td>";                                
                                echo "<td><i class='fa fa-times' onclick='crossClick(".$o.")'></i></td>";    
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><a href='#' class='btn-ed'>Cancel</a></td>";
                                echo "<td><a href='#' class='btn-ed'>Edit</a></td>";
                                echo "<td><a href='#' class='btn-ed savebt'>Save</a></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                              $i++;
                              $o++;
                              }
                               ?>
                                </tbody>
                            </table>
                            <div id="textContent"></div>
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

    //$('#apply-btn').on( 'click', function () {
    function applybtn(){
        var filtername = document.getElementById('filtername').innerHTML;
        var find = $('#find').val();
        if(find!='')
        {
            table.search( find ).draw();
            if(filtername.includes("findtag")  == false)
            {
            var findtag ="<button type='button' id='findTag' class='btn btn-info' onclick='removeTag(this)' style='margin-right: 20px'>"+find+"<i class='fa fa-close'></i></button>";
            document.getElementById('filtername').innerHTML+=findtag;
            }
        }
        else
        {
            table.search( '' ).columns().search( '' ).draw();
        }
        var selectBox = document.getElementById("cleardrop");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue == 'Not Cleared')
        {
            $("#tbody").hide();
            let ele = document.getElementById('textContent');
            ele.innerHTML = "There are no transactions showing for this account in this time period. If you're filtering transactions, they may be hiding.";
            if(filtername.includes("clear_drop") == false)
            {
            var cleardroptag ="<button type='button' id='clear_drop' class='btn btn-success' onclick='removeCleardrop(this)' style='margin-right: 20px'>"+selectedValue+"<i class='fa fa-close'></i></button>";
            document.getElementById('filtername').innerHTML+=cleardroptag;
            }
        }
        else if(selectedValue == 'Cleared')
        {
            $("#tbody").show();
            let ele = document.getElementById('textContent');
            ele.innerHTML = "";

            if(filtername.includes("clear_drop") == false)
            {
            var cleardroptag ="<button type='button' id='clear_drop' class='btn btn-success' onclick='removeCleardrop(this)' style='margin-right: 20px'>"+selectedValue+"<i class='fa fa-close'></i></button>";
            document.getElementById('filtername').innerHTML+=cleardroptag;
            }
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
        table.search(xxx,true,false).draw();

        if(filtername.includes("drop_date") == false)
        {
        var dropdate ="<button type='button' id='drop_date' class='btn btn-warning' onclick='removeDropdate(this)' style='margin-right: 20px'>"+selectedValue1+"<i class='fa fa-close'></i></button>";
        document.getElementById('filtername').innerHTML+=dropdate;
        }
       }
       else if (selectedValue1 == 'Statement Ending Date')
       {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        //table.search( to_date ).draw();
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
        table.search(xxx,true,false).draw();

        if(filtername.includes("drop_date") == false)
        {
        var dropdate ="<button type='button' id='drop_date' class='btn btn-warning' onclick='removeDropdate(this)' style='margin-right: 20px'>"+selectedValue1+"<i class='fa fa-close'></i></button>";
        document.getElementById('filtername').innerHTML+=dropdate;
        }
       }
       else if(selectedValue1 == 'All')
       {
        //table.search( '' ).columns().search( '' ).draw();
       }
       var selectBox2 = document.getElementById("transaction_type");
       var selectedValue2 = selectBox2.options[selectBox2.selectedIndex].value;
       if(selectedValue2 == 'Bill' | selectedValue2 == 'Bill Payment' | selectedValue2 == 'CC Bill Payment' | selectedValue2 == 'Cash Expense')
       {
         $("#tbody").hide();
          let ele = document.getElementById('textContent');
          ele.innerHTML = "There are no transactions showing for this account in this time period. If you're filtering transactions, they may be hiding.";

          if(filtername.includes("tran_type") == false)
         {
          var trantype ="<button type='button' id='tran_type' class='btn btn-danger' onclick='removeTranstype(this)' style='margin-right: 20px'>"+selectedValue2+"<i class='fa fa-close'></i></button>";
          document.getElementById('filtername').innerHTML+=trantype;
         }
       }
       else
       {
         $("#tbody").show();
         let ele = document.getElementById('textContent');
          ele.innerHTML = "";
       }
    //});
    }

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
        $('#from_date').val(null);
        var ending_date = $("#ending_date").val();
        $('#to_date').val(ending_date);
        $('#to_date'). attr("disabled","disabled");
        $('.disableFuturedate').datepicker().datepicker('setEndDate',ending_date);
        /*var temp_date = ending_date.split(".");
        var new_date = temp_date[2]+'-'+temp_date[1]+'-'+temp_date[0];*/
        /*$('.disableFuturedate').datepicker({
            onSelect: function() {
              maxDate: '0'
            };
          }).on('changeDate', function (ev) {
             $(this).datepicker('hide');
          });*/
       }
       else
       {

        $('#from_date').val(null);
        $('#to_date').val(null);
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
<script type="text/javascript">
    function trClick(o)
    {
        $(".tr_class_"+o).show();
    }
    function crossClick(o)
    {
        $(".tr_class_"+o).hide();
    }
    function removeTag(val)
    {
        val.remove();
        $('#find').val('');
        applybtn();
    }
    function removeCleardrop(val)
    {
        val.remove();
        document.getElementById("cleardrop").selectedIndex = 0;
        applybtn();
    }
    function removeDropdate(val)
    {
        val.remove();
        document.getElementById("dropdate").selectedIndex = 0;
        applybtn();
    }
    function removeTranstype(val)
    {
        val.remove();
        document.getElementById("transaction_type").selectedIndex = 0;
        applybtn();
    }
</script>
<script type="text/javascript">
function openSideNav3() {
     
    jQuery("#side-menu-cus-tx").addClass("open-side-nav");
    jQuery("#overlay-cus-tx").addClass("overlay");
}

function closeSideNav3() {
   
    jQuery("#side-menu-cus-tx").removeClass("open-side-nav");
    jQuery("#overlay-cus-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
function closedelete(val) {
  var id = val;
  if(id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/delete/reconcile') ?>",
        method: "POST",
        data: {id:id},
        success:function(data)
        {
            sweetAlert(
                            'Deleted!',
                            'Reconcile has been deleted.',
                            'success'
                        );
            location.href="<?php echo url('accounting/reconcile') ?>";
        }
    })
  }
}
</script>
<script type="text/javascript">
    function getDiff()
    {
        var diff = $('.diff').text();
        if(diff == 0)
        {
            $("#popup-hold").modal('hide');
            $("#popup-finish").modal('show');
        }
        else
        {
            $("#popup-finish").modal('hide');
            $("#popup-hold").modal('show');
        }
    }

    function openFinishpop(id)
    {
        $("#popup-hold").modal('hide');
        $("#popup-finish").modal('show');
        var id = id;
        var adjustment_date = $("#adjustment_date").val();
        if(adjustment_date!='')
        {
            $.ajax({
            url:"<?php echo url('accounting/reconcile/updatesingle/adjustment_date') ?>",
            method: "POST",
            data: {id:id,adjustment_date:adjustment_date},
            success:function(data)
            {
            }
        })
            $.ajax({
            url:"<?php echo url('accounting/reconcile/delete/reconcile') ?>",
            method: "POST",
            data: {id:id},
            success:function(data)
            {
                sweetAlert(
                            'Deleted!',
                            'Reconcile has been deleted.',
                            'success'
                        );
            }
        })
        }
    }

    $("#adjustment_date").click(function() {
        var minDate = $('#ending_date').val();
        $(this).datepicker().datepicker('setEndDate',minDate)
    });
</script>