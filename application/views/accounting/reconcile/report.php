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
echo $rows[0]->chart_of_accounts_id;die();
$accBalance = $this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id);
?>

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
           
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2"><a href=""></a></div>
                            </div>
                             <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-1 form-group">
                                     <div class="dropdown">
                                       <a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a>
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
                                            </div>
                                        </div>
                                    </section>
                                 </div>
                             </div>
                             <?php
                             foreach($rows as $row)
                              {
                                echo "<input id='ending_date' type='hidden' value='".date("d.m.Y", strtotime($rows[0]->ending_date))."'/>";
                              }
                             ?>
                            <table id="reconcile_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
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