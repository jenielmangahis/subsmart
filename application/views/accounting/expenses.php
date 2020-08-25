<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="expenses")?:'-active';?>" style="text-decoration: none">Expenses</a>
                        <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab">Vendors</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 0 30px 10px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Expense Transactions</h2>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <div class="dropdown" style="position: relative;display: inline;">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#print-checks-modal"  style="border-radius: 20px 0 0 20px">Print Checks</button>
                                    <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Order Checks</a></li>
                                        <li><a href="#">Pay Bills</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown" style="display: inline-block;margin-left: 10px;">
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 20px">New transaction
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#timeActivity-modal">Time Activity</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#bill-modal" id="addBill">Bill</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#expense-modal" id="addExpense">Expense</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#edit-expensesCheck" id="addCheck">Check</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#vendorCredit-modal" id="addVendorCredit">Vendor Credit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#payDown-modal">Pay down credit card</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="container-wrapper">
                            <div class="row">
                                <div class="col-md-12" style="padding: 0 30px 10px;">
                                    <div class="dropdown filter-btn">
                                        <button class="btn btn-default" type="button" data-toggle="dropdown">Filter
                                            <span class="fa fa-caret-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li style="padding: 30px 30px 30px 30px">
                                                <form action="" method="" class="">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="type">Type</label>
                                                            <select name="type" id="type" class="form-control">
                                                                <option value="">All transaction</option>
                                                                <option value="">Expenses</option>
                                                                <option value="">Bill</option>
                                                                <option value="">Bill payments</option>
                                                                <option value="">Check</option>
                                                                <option value="">Recently paid</option>
                                                                <option value="">Vendor credit</option>
                                                                <option value="">Credit Card Payment</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Status</label>
                                                            <select name="status" id="type" class="form-control">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Delivery Method</label>
                                                            <select name="status" id="type" class="form-control">
                                                                <option value="">Any</option>
                                                                <option value="">Print later</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="">Date</label>
                                                            <select name="status" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="">From</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="">To</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Payee</label>
                                                            <select name="payee" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Category</label>
                                                            <select name="category" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 12px">
                                                        <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                                        <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="display-filterDate">365 Days</span>
                                </div>
                            </div>
                            <div class="arrow-level-down">
                                <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                            </div>
                            <div class="dropdown batch-action-btn" style="display: inline-block;position: relative">
                                <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px">Batch Action
                                    <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Print Transaction</a></li>
                                    <li><a href="#">Categorized selected</a></li>
                                </ul>
                            </div>
                            <div class="icon-settings-container">
                                <i class="fa fa-print"></i>
                                <i class="fa fa-upload"></i>
                                <i class="fa fa-cog"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--DataTables-->
                                    <table id="expenses_table" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>No.</th>
                                            <th>Payee</th>
                                            <th>Category</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="expense-transactions-data-table">
                                        <?php
                                            $date = null;
                                            $type = null;
                                            $number = null;
                                            $vendors_name = null;
                                            $payee = null;
                                            $category = null;
                                            $description = null;
                                            $total = null;
                                            $category_id = null;
                                            $modal = null;
                                            $modal_id = null;
                                            $data_id = null;
                                            $delete = null;
                                            $category_list_id = null;
                                            $transaction_id = null;
                                        ?>
                                        <?php foreach ($transactions as $transaction): ?>
                                        <?php
                                        if ($transaction->type == 'Check'){
                                        // Check
                                            foreach ($checks as $check){
                                                if ($transaction->id == $check->transaction_id){
                                                    $date = date("m/d/y",strtotime($transaction->date_created));
                                                    $type = $transaction->type;
                                                    $number = $check->check_number;
                                                    $modal_id = "editCheck";
                                                    $data_id = $check->id;
                                                    $transaction_id = $check->transaction_id;
                                                    foreach ($vendors as $vendor){
                                                        if ($vendor->vendor_id == $check->vendor_id){
                                                            $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                                            $delete = 'deleteCheck';
                                                        }
                                                    }
                                                    $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $check->transaction_id));
                                                    $check_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                                                    foreach ($list_categories as $list){
                                                        if ($list->id == $check_category_id){
                                                            $category_list_id = $list->id;
                                                            $category = $list->category_name;
                                                            $category_id = $get_category->row()->id;
                                                        }
                                                    }

                                                }
                                            }
                                        }elseif ($transaction->type == 'Bill'){
//                                            Bill
                                            foreach ($bills as $bill){
                                                if ($transaction->id == $bill->transaction_id){
                                                    $date = date("m/d/y",strtotime($transaction->date_created));
                                                    $type = $transaction->type;
                                                    $number = null;
                                                    $modal_id = "editBill";
                                                    $transaction_id = $bill->transaction_id;
                                                    foreach ($vendors as $vendor){
                                                        if ($vendor->vendor_id == $bill->vendor_id){
                                                            $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                                            $data_id = $bill->id;
                                                            $delete = 'deleteBill';
                                                        }
                                                    }
                                                    $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $bill->transaction_id));
                                                    $bill_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                                                    foreach ($list_categories as $list){
                                                        if ($list->id == $bill_category_id){
                                                            $category_list_id = $list->id;
                                                            $category = $list->category_name;
                                                            $category_id = $get_category->row()->id;
                                                        }
                                                    }

                                                }
                                            }
                                        }elseif ($transaction->type == 'Expense'){
//                                            Expense
                                            foreach ($expenses as $expense){
                                                if ($transaction->id == $expense->transaction_id){
                                                    $date = date("m/d/y",strtotime($transaction->date_created));
                                                    $type = $transaction->type;
                                                    $number = null;
                                                    $modal_id = "editExpense";
                                                    $transaction_id = $expense->transaction_id;
                                                    foreach ($vendors as $vendor){
                                                        if ($vendor->vendor_id == $expense->vendor_id){
                                                            $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                                            $data_id = $expense->id;
                                                            $delete = 'deleteExpense';
                                                        }
                                                    }
                                                    $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $expense->transaction_id));
                                                    $expense_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                                                    foreach ($list_categories as $list){
                                                        if ($list->id == $expense_category_id){
                                                            $category_list_id = $list->id;
                                                            $category = $list->category_name;
                                                            $category_id = $get_category->row()->id;
                                                        }
                                                    }


                                                }
                                            }
                                        }elseif ($transaction->type == 'Vendor Credit'){
//                                            Vendor Credit
                                            foreach ($vendor_credits as $vendor_credit){
                                                if ($transaction->id == $vendor_credit->transaction_id){
                                                    $date = date("m/d/y",strtotime($transaction->date_created));
                                                    $type = $transaction->type;
                                                    $number = null;
                                                    $modal_id = "editVendorCredit";
                                                    $transaction_id = $vendor_credit->transaction_id;
                                                    foreach ($vendors as $vendor){
                                                        if ($vendor->vendor_id == $vendor_credit->vendor_id){
                                                            $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                                            $data_id = $vendor_credit->id;
                                                            $delete = 'deleteVendorCredit';
                                                        }
                                                    }
                                                    $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $vendor_credit->transaction_id));
                                                    $vc_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                                                    foreach ($list_categories as $list){
                                                        if ($list->id == $vc_category_id){
                                                            $category_list_id = $list->id;
                                                            $category = $list->category_name;
                                                            $category_id = $get_category->row()->id;
                                                        }
                                                    }
                                                }
                                            }
                                        }


                                        ?>
                                        <tr style="cursor: pointer;">
                                            <td><input type="checkbox"></td>
                                            <td data-toggle="modal" id="<?php echo $modal_id?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>"><?php echo $date;?></td>
                                            <td data-toggle="modal" id="<?php echo $modal_id?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>"><?php echo $type;?></td>
                                            <td data-toggle="modal" id="<?php echo $modal_id?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>"><?php echo $number;?></td>
                                            <td data-toggle="modal" id="<?php echo $modal_id?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>"><?php echo $vendors_name;?></td>
                                            <td data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>">
                                                <div style="display: inline-block;position: relative;width: 100%">
                                                    <select name="category" id="expenseTransCategory" data-category="" data-id="<?php echo $category_id;?>" class="form-control select2-tbl-category">
                                                        <option></option>
                                                        <option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>
                                                        <option value="<?php echo $category_list_id?>" selected><?php echo $category?></option>
                                                        <?php foreach ($list_categories as $list):?>
                                                            <?php if ($list->category_name == $category):?>
                                                                <option value="<?php echo $list->id;?>"><?php echo $list->category_name;?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <i class="fa fa-spinner fa-pulse" style="display: none;position: relative;"></i>
                                            </td>
                                            <td data-toggle="modal" id="<?php echo $modal_id?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>"><?php echo $transaction->total;?></td>
                                            <td style="text-align: right;">
                                                <a href="#" data-toggle="modal" id="<?php echo $modal_id?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>" style="margin-right: 10px;color: #0077c5;font-weight: 600;">View/Edit</a>
                                                <div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">
                                                    <span class="fa fa-caret-down" data-toggle="dropdown"></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" id="copy">Copy</a></li>
                                                        <li id="<?php echo $delete?>" data-id="<?php echo $data_id?>" data-transId="<?php echo $transaction_id?>">
                                                            <a href="#" >Delete</a>
                                                        </li>
                                                        <li><a href="#">Void</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            $date = null;
                                            $type = null;
                                            $number = null;
                                            $vendors_name = null;
                                            $payee = null;
                                            $category = null;
                                            $description = null;
                                            $total = null;
                                            $category_id = null;
                                            $modal = null;
                                            $modal_id = null;
                                            $data_id = null;
                                            $delete = null;
                                            $category_list_id = null;
                                            $transaction_id = null;
                                            ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
<!--    <input type="hidden" id="site_url" value="--><?php //echo site_url(); ?><!--">-->
    <!-- page wrapper end -->
    <!-- Modal for Print Checks-->
    <div class="full-screen-modal">
        <div id="print-checks-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">Print Checks</div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="" id="" class="form-control">
                                    <option selected>Cash on hand</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <span style="font-weight: bold">Balance</span>
                                <span>$111,111.00</span>
                            </div>
                            <div class="col-md-2">
                                <span style="font-weight: bold">0 checked selected</span>
                                <span>$0.00</span>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-default" style="float: right;border-radius: 36px">Add check</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="action-bar">
                                <span class="batchAction">
                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                    <button class="btn btn-default remove-button">Remove from list</button>
                                </span>
                                <div class="select-sort">
                                    <select name="" id="" class="form-control">
                                        <option value="">Sort by Payee</option>
                                        <option value="">Sort by Order created</option>
                                        <option value="">Sort by Date/Payee</option>
                                        <option value="">Sort by Date/Order created</option>
                                    </select>
                                </div>
                                <div class="select-sort">
                                    <select name="" id="" class="form-control">
                                        <option value="">Show all checks</option>
                                        <option value="">Show regular checks</option>
                                        <option value="">Show bill payment checks</option>
                                    </select>
                                </div>
                                <div class="labeled-input">
                                    <div><label for="">Starting check no.</label></div>
                                    <div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="labeled-input">
                                    <div><label for="">On first page print</label></div>
                                    <div>
                                        <select name="" id="" class="form-control">
                                            <option value="">1 checks</option>
                                            <option value="">2 checks</option>
                                            <option value="">3 checks</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <span class="print-settings">
                                <a href=""><i class="fa fa-print fa-lg"></i></a>
                                <a href=""><i class="fa fa-cog fa-lg"></i></a>
                            </span>
                        </div>
<!--                        DataTables-->
                        <table id="printChecktbl" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                            <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Payee</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer-print">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-3" style="text-align: center;">
                                <a href="#" class="footer-links">Print setup</a>
                            </div>
                            <div class="col-md-3" style="text-align: center;">
                                <a href="#" class="footer-links">Order checks</a>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success print-button">Preview and print</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--end of modal-->
<!--    Add/Edit Checks Modal-->
    <div class="full-screen-modal">
        <div id="edit-expensesCheck" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Check #<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeCheckModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body" style="margin-bottom: 100px">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option></option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Bank Account</label>
                                <select name="bank_id" id="bank_account" class="form-control select2-account">
                                    <option></option>
                                    <option value="1">Cash on hand</option>
                                    <option value="2">Corporate Account(XXXXXX 5850)</option>
                                    <option value="3">Corporate Account(XXXXXX 5850)Te</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$113,101.00</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-check">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="mailing_address" id="check_mailing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Check no.</label>
                                    <input type="text" name="check_num" id="check_number" class="form-control" value="1">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="print_later" id="print_later" value="1">
                                    <label for="">Print later</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" id="permit_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="table-container">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-check">
                                <tr id="tableLine">
                                    <td></td>
                                    <td><span id="line-counter">1</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <input type="hidden" id="prevent_process" value="true">
                                            <select name="category[]" id="" class="form-control checkCategory select2-check-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control checkDescription" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr id="tableLine">
                                    <td></td>
                                    <td><span id="line-counter">2</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <input type="hidden" id="prevent_process" value="true">
                                            <select name="category[]" id="" class="form-control checkCategory select2-check-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control checkDescription" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <span style="margin-right: 200px;font-size: 17px">Total</span>
                                $<span id="total-amount-check">0.00</span>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                <button class="btn btn-dark cancel-button" type="reset">Revert</button>
                            </div>
                            <div class="col-md-5">
                                <div class="middle-links">
                                    <a href="">Print check</a>
                                </div>
                                <div class="middle-links">
                                    <a href="">Order checks</a>
                                </div>
                                <div class="middle-links">
                                    <a href="">Make recurring</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">More</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Time Activity modal-->
    <div class="full-screen-modal">
        <div id="timeActivity-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Time Activity
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/timeActivity" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                   <table class="form-inline-group">
                                       <tr>
                                           <td><label for="">Date</label></td>
                                           <td>
                                               <input type="date" name="date" class="form-inline" style="width: 45%">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Name</label></td>
                                           <td>
                                               <input type="text" name="name" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Customer</label></td>
                                           <td>
                                               <input type="text" name="customer" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Service</label></td>
                                           <td>
                                               <select name="service" id="" class="form-inline">
                                                   <option disabled selected>Chose the service worked on</option>
                                                   <option>Credit</option>
                                                   <option>Discount</option>
                                                   <option>Hours</option>
                                                   <option>Installation</option>
                                                   <option>Labor</option>
                                                   <option>Material</option>
                                               </select>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td></td>
                                           <td>
                                               <input type="checkbox"  id="billable" value="1" >
                                               <span>Billable (/hr)</span>
                                               <input type="hidden" class="form-control" name="billable" id="hideTextBox" style="display: inline-block; width: 60px;height: 36px">
                                               <div style="display: none;" id="hideTaxable">
                                                   <input type="checkbox" name="taxable">
                                                   <span>Taxable</span>
                                               </div>
                                           </td>
                                       </tr>
                                   </table>
                            </div>
                            <div class="col-md-5">
                                <table class="form-inline-group">
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="checkbox" name="start_end_times" id="start_end_times" value="1">
                                            <span>Enter Start and End Times</span>
                                        </td>
                                    </tr>
                                    <tr id="timeRow">
                                        <td><label for="">Time</label></td>
                                        <td>
                                            <input type="time" name="time" class="form-inline" id="time" placeholder="hh:mm" style="width: 35%">

                                        </td>
                                    </tr>
                                    <tr id="startEndRow" style="display: none;">
                                        <td><label for="">Time</label></td>
                                        <td>
                                            <div>
                                                <input type="time" name="start_time" class="form-control"  style="width: 25%;display: inline-block;margin-bottom: 10px">
                                                <span>Start time</span>
                                            </div>
                                            <div>
                                                <input type="time" name="end_time" class="form-control" style="width: 25%;display: inline-block;margin-bottom: 10px">
                                                <span>End time</span>
                                            </div>
                                            <div >
                                                <input type="time" name="break" class="form-control" style="width: 30%;display: inline-block;" placeholder="hh:mm">
                                                <span>Break</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Description</label></td>
                                        <td>
                                            <textarea name="description" id="" cols="60" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    <div class="modal-footer-activity">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-default btn-transparent">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <div style="right: 0;float: right;">
                                    <button class="btn btn-default btn-transparent" type="submit" style="display: inline-block">Save</button>
                                    <div class="dropdown" style="display: inline-block">
                                        <button type="button" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                        <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="#">Save and close</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--end of modal-->
<!--    Bill modal-->
    <div class="full-screen-modal">
        <div id="bill-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Bill
                        </div>
                        <button type="button" class="close" id="closeBillModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="billForm">
						<div class="modal-body" style="margin-bottom: 100px">
							<div class="row">
								<div class="col-md-3">
									<label for="">Vendor</label>
									<input type="hidden" name="bill_id" id="billID">
									<input type="hidden" name="transaction_id" id="billTransId" class="transaction_id">
                                    <input type="hidden" id="billType" class="expenseType" value="Bill">
									<select name="vendor_id" id="billVendorID" class="form-control select2-vendor">
										<option></option>
										<option disabled>&plus;&nbsp;Add new</option>
										<?php foreach ($vendors as $vendor):?>
											<option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-9" style="text-align: right">
									<div>Balance Due</div>
									<div><h1 id="h1_amount-bill">$0.00</h1></div>
								</div>
							</div>
							<div class="row" style="margin-top: 20px;width: 80%;">
								<div class="col-md-3">
									<label for="">Mailing address</label>
									<textarea name="mailing_address" id="billMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
								</div>
								<div class="col-md-3">
									<label for="">Terms</label>
									<select name="terms" id="billTerms" class="form-control select2-bill-terms">
										<option></option>
										<option>Due on receipt</option>
										<option>Net 15</option>
										<option>Net 30</option>
										<option>Net 60</option>
									</select>
								</div>
								<div class="col-md-2">
									<label for="">Bill date</label>
									<input type="date" name="bill_date" id="billDate" class="form-control">
								</div>
								<div class="col-md-2">
									<label for="">Due date</label>
									<input type="date" name="due_date" id="billDueDate" class="form-control">
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Bill no.</label>
										<input type="text" name="bill_num" id="billNumber" class="form-control" value="">
									</div>
									<div class="form-group">
										<label for="">Permit no.</label>
										<input type="text" name="permit_num" id="billPermitNumber" class="form-control">
									</div>
								</div>
							</div>
							<div class="table-container">
                                <div class="table-loader">
                                    <p class="loading-text">Loading records</p>
                                </div>
								<!--                        DataTables-->
								<table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
									<thead>
									<tr>
										<th></th>
										<th>#</th>
										<th>CATEGORY</th>
										<th>DESCRIPTION</th>
										<th>AMOUNT</th>
										<th></th>
									</tr>
									</thead>
									<tbody id="line-container-bill">
									<tr id="tableLine-bill">
										<td></td>
										<td><span id="line-counter-bill">1</span></td>
										<td>
											<div id="" style="display:none;">
												<select name="category[]" id="" class="form-control billCategory select2-bill-category">
													<option></option>
													<?php foreach ($list_categories as $list): ?>
														<option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</td>
										<td><input type="text" name="description[]" class="form-control billDescription" id="tbl-input-bill" style="display: none;"></td>
										<td><input type="text" name="amount[]" class="form-control billAmount" id="tbl-input-bill" style="display: none;"></td>
										<td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
									</tr>
									<tr id="tableLine-bill">
										<td></td>
										<td><span id="line-counter-bill">2</span></td>
										<td>
											<div id="" style="display:none;">
												<select name="category[]" id="" class="form-control billCategory select2-bill-category">
													<option></option>
													<?php foreach ($list_categories as $list): ?>
														<option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</td>
										<td><input type="text" name="description[]" class="form-control billDescription" id="tbl-input-bill" style="display: none;"></td>
										<td><input type="text" name="amount[]" class="form-control billAmount" id="tbl-input-bill" style="display: none;"></td>
										<td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
									</tr>
									</tbody>
								</table>
							</div>
							<div class="addAndRemoveRow">
								<div class="total-amount-container">
                                    <span style="margin-right: 200px;font-size: 17px">Total</span>
									$<span id="total-amount-bill">0.00</span>
								</div>
								<button type="button" class="add-remove-line" id="add-four-line-bill">Add lines</button>
								<button type="button" class="add-remove-line" id="clear-all-line-bill">Clear all lines</button>
							</div>
							<div class="form-group">
								<label for="">Memo</label>
								<textarea name="memo" id="billMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
							</div>
							<div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                        <span>Maximum size: 20MB</span>
                                        <div id="billAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                                            <div class="dz-message" style="margin: 20px;border">
                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="padding-top: 30px;">
                                        <div class="file-container-list" id="file-list-bill"></div>
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="show-existing-file">
                                    <a href="#" id="showExistingFile">Show existing file</a>
                                </div>
                            </div>
                            <div class="privacy">
                                <a href="#">Privacy</a>
                            </div>
						</div>
						<div class="modal-footer-check">
							<div class="row">
								<div class="col-md-5">
									<button class="btn btn-dark cancel-button" id="closeBillModal" type="button">Cancel</button>
								</div>
								<div class="col-md-2" style="text-align: center;">
									<div>
										<a href="#" style="color: #ffffff;">Make recurring</a>
									</div>
								</div>
								<div class="col-md-5">
									<div class="dropdown" style="float: right;display: inline-block;position: relative;">
										<button type="button" class="btn btn-success" data-dismiss="modal" id="billSaved" style="border-radius: 20px 0 0 20px">Save and schedule payment</button>
										<button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
											<span class="fa fa-caret-down"></span></button>
										<ul class="dropdown-menu dropdown-menu-right" role="menu">
											<li><a href="#">Save and new</a></li>
											<li><a href="#">Save and close</a></li>
										</ul>
									</div>
									<div class="" style="display: inline-block;float: right;margin-right: 10px;">
										<button class="btn btn-transparent" id="billSaved" data-dismiss="modal" type="button">Save</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
<!--    end of modal-->
<!--    Expense modal-->
    <div class="full-screen-modal">
        <div id="expense-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Expense
                        </div>
                        <button type="button" class="close" id="closeModalExpense"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="expenseForm">
                    <div class="modal-body" style="margin-bottom: 100px">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <input type="hidden" id="expenseTransId" class="transaction_id">
                                <input type="hidden" id="expenseId">
                                <input type="hidden" id="exType" class="" value="Expense" data-id="">
                                <select name="vendor_id" id="expenseVendorId" class="form-control select2-payee" required>
                                    <option value=""></option>
                                    <option disabled>&plus;&nbsp;Add new</option>
                                    <?php foreach ($vendors as $vendor):?>
                                        <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                                <select name="payment_account" id="expensePaymentAccount" class="form-control select2-account" required>
                                    <option>Cash on hand</option>
                                    <option value="1">Cash on hand:Cash on hand</option>
                                    <option value="2">Corporate Account (XXXXXX 5850)</option>
                                    <option value="3">Corporate Account (XXXXXX 5850)Te</option>
                                    <option >Investment Asset</option>
                                    <option >Payroll Refunds</option>
                                    <option >Uncategorized Asset</option>
                                    <option >Undeposited Funds</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$133,101.00</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-expense">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;width: 80%;">
                            <div class="col-md-3">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" id="expensePaymentDate" class="form-control" required>
                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3">
                                <label for="">Payment method</label>
                                <select name="payment_method" id="expensePaymentMethod" class="form-control select2-method" required>
                                    <option value=""></option>
                                    <option>Cash</option>
                                    <option>Check</option>
                                    <option>Credit Card</option>
                                </select>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ref no.</label>
                                    <input type="text" name="ref_num" id="expenseRefNumber" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-expense">
                                <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">1</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">2</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <span style="margin-right: 200px;font-size: 17px">Total</span>
                                $<span id="total-amount-expense">0.00</span>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line-expense">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line-expense">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="expenseAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                                        <div class="dz-message" style="margin: 20px;border">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-expense"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" id="closeModalExpense" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <div>
                                    <a href="#" style="color: #ffffff;">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                                    <button type="button" data-dismiss="modal" id="expenseSaved" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                                <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                                    <button class="btn btn-transparent" data-dismiss="modal" id="expenseSaved" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Vendor Credit modal-->
    <div class="full-screen-modal">
        <div id="vendorCredit-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Vendor Credit
                        </div>
                        <button type="button" class="close" id="closeModalVC"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="formVendorCredit">
                    <div class="modal-body" style="margin-bottom: 100px">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Vendor</label>
                                <input type="hidden" id="vendorCreditId" class="">
                                <input type="hidden" id="vcTransId" class="transaction_id">
                                <input type="hidden" id="vcType" class="" value="Vendor Credit">
                                <select name="vendor_id" id="vcVendorId" class="form-control select2-vendor-credit" required>
                                    <option></option>
                                    <option disabled>&plus;&nbsp;Add new</option>
                                    <?php foreach ($vendors as $vendor):?>
                                        <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-9" style="text-align: right">
                                <div>CREDIT AMOUNT</div>
                                <div><h1 id="h1_amount-vc">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;width: 80%;">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="mailing_address" id="vcMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;" required></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" id="vcPaymentDate" class="form-control" required>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ref no.</label>
                                    <input type="text" name="ref_num" id="vcRefNumber" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" id="vcPermitNumber" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;position: relative">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-vendorCredit">
                                <tr id="tableLine-vendorCredit">
                                    <td></td>
                                    <td><span id="line-counter-vendorCredit">1</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <select name="category[]" id="" class="form-control vcCategory select2-vc-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control vcDescription" id="" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control vcAmount" id="" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-vendorCredit"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr id="tableLine-vendorCredit">
                                    <td></td>
                                    <td><span id="line-counter-vendorCredit">2</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <select name="category[]" id="" class="form-control vcCategory select2-vc-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control vcDescription" id="" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control vcAmount" id="" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-vendorCredit"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <span style="margin-right: 200px;font-size: 17px">Total</span>
                                $<span id="total-amount-vc">0.00</span>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line-vendorCredit">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line-vendorCredit">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="memo" id="vcMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="vcAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                                        <div class="dz-message" style="margin: 20px;border">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-vc"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile" class="">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" id="closeModalVC" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <div>
                                    <a href="#" style="color: #ffffff;">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;">
                                    <button type="button" class="btn btn-success" id="vcSaved" data-dismiss="modal" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Paydown credit card modal-->
    <div class="full-screen-modal">
        <div id="payDown-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Pay down credit card
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/payDown" method="post">
                    <div class="modal-body">
                        <div class="row" style="margin-left: 20px;">
                            <div class="col-md-6">
                                <div class="header-form">
                                    Record payments made to your balance
                                </div>
                                <div class="form-group">
                                    <label for="">Which credit card did you pay?</label>
                                    <select name="credit_card_id" id="" class="form-control select2-credit-card" required>
                                        <option value=""></option>
                                        <option value=""><a href="#">&plus; Add new</a></option>
                                        <option value="1">Sample credit card</option>
                                        <option value="2">Sample credit card 2</option>
                                    </select>
                                </div>
                                <div class="form-group inline">
                                    <label for="">How much did you pay?</label>
                                    <input type="text" name="amount" class="form-control" id="amountSelector" placeholder="Enter the amount" required>
                                </div>
                                <div class="form-group inline">
                                    <label for="">Date of payment</label>
                                    <input type="date" name="date_payment" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">What did you use to make this payment?</label>
                                    <select name="payment_account" id="" class="form-control select2-bank-account" required>
                                        <option value="" disabled selected>Select bank account</option>
                                        <option value=""><a href="#">&plus; Add new</a></option>
                                        <option value="1">Cash on hand</option>
                                        <option value="2">Cash on hand:Cash on hand</option>
                                        <option value="3">Corporate Account (XXXXXX 5850)</option>
                                        <option value="4">Corporate Account (XXXXXX 5850)Te</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="showHiddenOption">
                                    <span style="margin-left: 8px;vertical-align: 3px;">I made a payment with a check</span>
                                </div>
                                <div class="form-group" id="hiddenOption" style="display: none;">
                                    <label for="checkNumber">Check no.</label>
                                    <input type="number" name="check_num" class="form-control" id="checkNumber" style="height:36px!important;width: 80px;display: inline-block;">
                                    <input type="checkbox" id="printLater">
                                    <span>Print Later</span>
                                </div>
                                <div class="form-group">
                                    <a href="#" id="memoAttachPromt"><i class="fa fa-caret-right" style="color: #333333;"></i> Memo and attachments</a>
                                </div>
                                <div class="memoAttachContainer" style="display: none">
                                    <div class="form-group">
                                        <label for="">Memo</label>
                                        <textarea name="" id="" cols="30" rows="5" class="form-control" style="width: 400px;height: auto!important;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                        <span>Maximum size: 20MB</span>
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                        <a href="#" style="color: #0b97c4;margin: 0 auto;">Show existing</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right: 20px">
                                <div style="float: right;">
                                    <div class="amount-title">Total paid</div>
                                    <div class="amount-data"><h2>$0.00</h2></div>
                                </div>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;display: inline-block;">
                                    <button type="submit" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and close</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and new</a></li>
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                                <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                                    <button class="btn btn-transparent" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--        Add Categories modal-->
        <div class="modal" id="addNewCategories">
            <div class="modal-dialog" data-backdrop="false">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Account</h4>
                        <button type="button" id="closedAddCategory" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="" id="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Account Type</label>
                                    <select name="type" id="addCategoryType" class="form-control">
                                        <option>Account receivable (A/R)</option>
                                        <option>Other current assets</option>
                                        <option>Bank</option>
                                        <option>Fixed assets</option>
                                        <option>Other assets</option>
                                        <option>Account payable (A/P)</option>
                                        <option>Credit card</option>
                                        <option>Other account liabilities</option>
                                        <option>Long term liabilities</option>
                                        <option>Equity</option>
                                        <option>Income</option>
                                        <option>Other income</option>
                                        <option>Costs of goods sold</option>
                                        <option>Expenses</option>
                                        <option>Other expenses</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""><span style="color: red;">*</span>Detail Type</label>
                                    <select name="detail_type" id="selectDetailType" class="form-control">
                                        <option>Advertising/Promotional</option>
                                        <option>Auto</option>
                                        <option>Bad Debts</option>
                                        <option>Bank Charges</option>
                                        <option>Charitable Contributions</option>
                                        <option>Cost & Labor</option>
                                        <option>Dues & subscription</option>
                                        <option>Entertainment</option>
                                        <option>Entertainment Meals</option>
                                        <option>Equipment Rental</option>
                                        <option>Finance costs</option>
                                        <option>Insurance</option>
                                        <option>Interest Paid</option>
                                        <option>Legal & Professional fees</option>
                                        <option>Office/General Administrative Expenses</option>
                                        <option>Other Business Expenses</option>
                                        <option>Other Miscellaneous Service Cost</option>
                                        <option>Payroll Expenses</option>
                                        <option>Promotional Meals</option>
                                        <option>Rent or Lease of Buildings</option>
                                        <option>Repair & Maintenance</option>
                                        <option>Shipping,Freight & Delivery</option>
                                        <option>Supplies & Materials</option>
                                        <option>Taxes Paid</option>
                                        <option>Travel</option>
                                        <option>Travel Meals</option>
                                        <option>Unapplied Cash Bill Payment Expenses</option>
                                        <option>Utilities</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="detailTypeDesc">
                                        Use <b>Advertising/Promotional</b> to track money spent promoting your company.
                                        <p>
                                            You may want different accounts of this type to track different promotional efforts (Yellow Pages, newspaper, radio, flyers, events, and so on).
                                        </p>
                                        <p>
                                            If the promotion effort is a meal, use <b>Promotional meals</b> instead.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><span style="color:red;">*</span>Name</label>
                                    <input type="text" name="name" id="addCategoryName" class="form-control" value="Advertising/Promotional">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text"name="description" id="addCategoryDesc" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="checkBoxSubAccount">&nbsp;<span>Is sub-account</span>
                                    <select name="sub-account" id="selectSubAccount" class="form-control" disabled>
                                        <option>Enter parent account</option>
                                        <option>Cash on hand</option>
                                        <option>Corporate Account (XXXXXX 5850)</option>
                                        <option>Corporate Account (XXXXXX 5850)te</option>
                                        <option>Advertising/Promotional</option>
                                        <option>Auto</option>
                                        <option>Bad Debts</option>
                                        <option>Bank Charges</option>
                                        <option>Charitable Contributions</option>
                                        <option>Cost & Labor</option>
                                        <option>Dues & subscription</option>
                                        <option>Entertainment</option>
                                        <option>Entertainment Meals</option>
                                        <option>Equipment Rental</option>
                                        <option>Finance costs</option>
                                        <option>Insurance</option>
                                        <option>Interest Paid</option>
                                        <option>Legal & Professional fees</option>
                                        <option>Office/General Administrative Expenses</option>
                                        <option>Other Business Expenses</option>
                                        <option>Other Miscellaneous Service Cost</option>
                                        <option>Payroll Expenses</option>
                                        <option>Promotional Meals</option>
                                        <option>Rent or Lease of Buildings</option>
                                        <option>Repair & Maintenance</option>
                                        <option>Shipping,Freight & Deleviry</option>
                                        <option>Supplies & Materials</option>
                                        <option>Taxes Paid</option>
                                        <option>Travel</option>
                                        <option>Travel Meals</option>
                                        <option>Unapplied Cash Bill Payment Expenses</option>
                                        <option>Utilities</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer-addcategories">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" id="closedAddCategory" class="btn btn-tranparent" data-dismiss="modal" style="border: 1px solid #333333;float: left">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <div class="dropdown" style="float: right">
                                    <button type="button" class="btn btn-success"  data-dismiss="modal" id="addCategorySaved" data-toggle="modal" data-target="#pay-bills-modal" style="border-radius: 20px 0 0 20px">Save & Close</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Save & New</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<!--    end of modal-->
<!--    Show Existing File modal-->
    <div class="modal-right-side">
        <div class="modal right fade" id="showExistingModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Existing Files</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="modal-existing-file-container">

                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer" style="justify-content: flex-start;">
                        <button type="button" class="btn btn-transparent" data-dismiss="modal" style="color:black">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
<!--    end of modal-->
        <div style="display: none">
            <div id="detailDescAdvertise" >
                Use <b>Advertising/Promotional</b> to track money spent promoting your company.
                <p>
                    You may want different accounts of this type to track different promotional efforts (Yellow Pages, newspaper, radio, flayers, events, and so on).
                </p>
                <p>
                    If the promotion effort is a meal, use <b>Promotional meals</b> instead.
                </p>
            </div>
            <div id="detailDescAuto">
                Use <b>Auto</b> to track costs associated with vehicles.
                <p>
                    You may want different accounts of this type to track gasoline, repairs, and maintenance.
                </p>
                <p>
                    If your business owns a car or truck, you may want to track its
                    value as a Fixed Asset, in addition to tracking its expenses.
                </p>
            </div>
            <div id="detailDescBadDebt">
                Use <b>Bad debt</b> to track debt you have written off.
            </div>
            <div id="detailDescBankCharges">
                Use <b>Bank charges</b> for any fees you pay to financial institutions.
            </div>
            <div id="detailDescCharitable">
                Use <b>Charitable contributions</b> to track gifts to charity.
            </div>
            <div id="detailDescCostOfLabor">
                Use <b>Cost of labor</b> to track the cost of paying employees to produce products or supply services.
                <p>It includes all employment costs, including food and transportation, if applicable.</p>
                <p>This account is also available as a Cost of Goods Sold (COGS) account.</p>
            </div>
            <div id="detailDescDueSubscription">
                Use <b>Dues & subscriptions</b> to track dues & subscriptions related to running your business.
                <p>
                    You may want different accounts of this type for professional dues,
                    fees for licenses that can’t be transferred, magazines, newspapers,
                    industry publications, or service subscriptions.
                </p>
            </div>
            <div id="detailDescEntertainment">
                Use <b>Entertainment</b> to track events to entertain employees.
                <p>
                    If the event is a meal, use <b>Entertainment meals</b>, instead.
                </p>
            </div>
            <div id="detailDescEntertainmentMeals">
                Use <b>Entertainment meals</b> to track how much you spend on dining with your employees to promote morale.
                <p>If you dine with a customer to promote your business, use a <b>Promotional meals</b> account, instead.</p>
                <p>Be sure to include who you ate with and the purpose of the meal when you enter the transaction.</p>
            </div>
            <div id="detailDescEquipmentRental">
                Use <b>Equipment rental</b> to track the cost of renting equipment to produce products or services.
                <p>This account is also available as a Cost of Goods (COGS) account.</p>
                <p>If you purchase equipment, use a Fixed Asset account type called <b>Machinery and equipment</b>.</p>
            </div>
            <div id="detailDescFinance"></div>
            <div id="detailDescInsurance">
                Use <b>Insurance</b> to track insurance payments.
                <p>  You may want different accounts of this type for different
                    types of insurance (auto, general liability, and so on).</p>
            </div>
            <div id="detailDescInterestPaid">
                Use <b>Interest paid</b> for all types of interest you pay,
                including mortgage interest, finance charges on credit cards, or interest on loans.
            </div>
            <div id="detailDescLegalProfFee">
                Use <b>Legal & professional fee</b>s to track money to pay to professionals to help you run your business.
                <p>
                    You may want different accounts of this type for payments to your accountant,
                    lawyer, or other consultants.
                </p>
            </div>
            <div id="detailDescGeneralAdmin">
                Use <b>Office/general administrative expenses</b> to track all types of general or office-related expenses.
            </div>
            <div id="detailDescOtherBusiness"></div>
            <div id="detailDescMisService">
                Use <b>Other miscellaneous service cost</b> to track costs related to providing services that don’t fall into another Expense type.
                <p>This account is also available as a Cost of Goods Sold (COGS) account.</p>
            </div>
            <div id="detailDescPayrollExpenses">
                Use <b>Payroll expenses</b> to track payroll expenses. You may want different accounts of this type for things like:
                <ul>
                    <li>Compensation of officers</li>
                    <li>Guaranteed payments</li>
                    <li>Workers compensation</li>
                    <li>Salaries and wages</li>
                    <li>Payroll taxes</li>
                </ul>
            </div>
            <div id="detailDescPromotionalMeals">
                Use <b>Promotional meals</b> to track how much you spend dining with a customer to promote your business.
                <p>Be sure to include who you ate with and the purpose of the meal when you enter the transaction.</p>
            </div>
            <div id="detailDescRentLease">
                Use <b>Rent or lease of buildings</b> to track rent payments you make.
            </div>
            <div id="detailDescRepairMaintain">
                Use <b>Repair & maintenance</b> to track any repairs and periodic maintenance fees.
                <p>
                    You may want different accounts of this type to track different
                    types repair & maintenance expenses (auto, equipment, landscape, and so on).
                </p>
            </div>
            <div id="detailDescShipping">
                Use <b>Shipping, freight & delivery</b> to track the cost of shipping products to customers or distributors.
                <p>
                    You might use this type of account for incidental shipping expenses,
                    and the Cost of Goods Sold type of Shipping, freight & delivery account for direct costs.
                </p>
                <p>This account is also available as a Cost of Goods Sold account.</p>
            </div>
            <div id="detailDescSupplies">
                Use <b>Supplies & materials</b> to track the cost of raw goods and parts used or consumed when producing a product or providing a service.
                <p>This account is also available as a Cost of Goods Sold (COGS) account.</p>
            </div>
            <div id="detailDescTaxesPaid">
                Use <b>Taxes paid</b> to track taxes you pay.
                <p>
                    You may want different accounts of this type for payments
                    to different tax agencies (sales tax, state tax, federal tax).
                </p>
            </div>
            <div id="detailDescTravel">
                Use <b>Travel</b> to track travel costs.
                <p>For food you eat while traveling, use Travel meals, instead.</p>
            </div>
            <div id="detailDescTravelMeals">
                Use <b>Travel meals</b> to track how much you spend on food while traveling.
                <p>If you dine with a customer to promote your business, use a Promotional meals account, instead.</p>
                <p>If you dine with your employees to promote morale, use Entertainment meals, instead.</p>
            </div>
            <div id="detailDescUnapplied">
                <b>Unapplied Cash Bill Payment Expense</b> reports the <b>Cash Basis</b> expense
                from vendor payment checks you’ve sent but not yet applied to vendor bills.
                In general, you would never use this directly on a purchase or sale transaction.
                See IRS Publication 538.
            </div>
            <div id="detailDescUtilities">
                Use <b>Utilities</b> to track utility payments.
                <p>
                    You may want different accounts of this type to track different types
                    of utility payments (gas and electric, telephone, water, and so on).
                </p>
            </div>
        </div>
<!--        end of modal-->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //select2 initialization
    $('.select2-sub-account').select2({
        placeholder: 'Enter parent account',
        allowClear: true
    });
    $('.select2-payee').select2({
        placeholder: 'Who did you pay?',
        allowClear: true
    });
    $('.select2-account').select2({
        placeholder: 'Select an account',
        allowClear: true
    });
    $('.select2-bill-terms').select2({
        placeholder: 'Choose a terms',
        allowClear: true
    });
    $('.select2-method').select2({
        placeholder: 'What did you pay with?',
        allowClear: true
    });
    $('.select2-credit-card').select2({
        placeholder: 'Select credit card',
        allowClear: true
    });
    $('.select2-bank-account').select2({
        placeholder: 'Select bank account',
        allowClear: true
    });
    $('.select2-vendor').select2({
        placeholder: 'Choose a vendor',
        allowClear: true
    });
    $('.select2-tbl-category').select2({
        placeholder: 'Select a category',
        allowClear: true,
        width: 'resolve',
        ajax:{
            url:'/accounting/getExpensesCategories',
            type:"GET",
            dataType:"json",
            delay:250,
            data:function (params) {
                    var query = {
                        search: params.term
                    };
                return query;
            },
            processResults:function (response) {
                return{results:response};
            },
            cache:true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        templateResult: function (d) {
            var subtext = d.subtext;
            if(subtext == undefined){subtext=''}
            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
        }
    });
    $('.select2-vendor-credit').select2({
        placeholder: 'Choose a vendor',
        allowClear: true
    });
    // $('.select2-vc-category').select2({
    //     placeholder: 'Choose a category',
    //     allowClear: true
    // });
    // $('.select2-check-category').select2({
    //     placeholder: 'Choose a category',
    //     allowClear: true
    // });
    // $('.select2-bill-category').select2({
    //     placeholder: 'Choose a category',
    //     allowClear: true
    // });
    // $('.select2-expense-category').select2({
    //     placeholder: 'Choose a category',
    //     allowClear: true
    // });

    // DataTable JS
    $(document).ready(function() {
        $('#expenses_table').DataTable({
            "paging": false,
            "filter":false
        });
    } );
    $(document).ready(function() {
        $('#printChecktbl').DataTable({
            "paging": false,
            "filter":false
        });
        $('#expensesCheckTable').DataTable({
            "paging": false,
            "filter":false,
            "info":false,
            "sort": false

        });
    } );
    // Add & Remove line in dataTable Check modal
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line").click(function() {
                var id = $('#line-container-check > tr').length;
                var transaction_id = $('#checktransID').val();
                for (var x = 1;x <= 4;x++){
                    id++;
                    $('#line-container-check').append($('#tableLine').last().clone());
                    $('td > .categories_id').last().val(null);
                    $('td > #category-preview-check').last().html(null);
                    $('td > div > #description-id-check').last().val(null);
                    $('td > #description-preview-check').last().html(null);
                    $('td > #amount-preview-check').last().html(null);
                    $('td > div > #amount-id-check').last().val(0);
                    $('.select2-check-category').select2({
                        placeholder: 'Choose a category',
                        allowClear: true,
                        width:'resolve',
                        ajax:{
                            url:'/accounting/getExpensesCategories',
                            type:"GET",
                            dataType:"json",
                            delay:250,
                            data:function (params) {
                                return{
                                    q: params.name,
                                    transaction_id:transaction_id
                                }
                            },
                            processResults:function (response) {
                                return{results:response};
                            },
                            cache:true
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                        templateResult: function (d) {
                            var subtext = d.subtext;
                            if(subtext == undefined){subtext=''}
                            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                        }
                    });
                    $('.select2-check-category').last().next().next().remove();
                }
                $('#line-container-check > tr').each(function (index) {
                    $(this).children('td').children('#line-counter').text(index+1);
                });
            });
        });
            // Clear Lines
        $('#clear-all-line').click(function (e) {
            var num = $('#line-container-check > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                $('#line-container-check > #tableLine').slice(2).remove();
                $(".select2-check-category").select2('destroy');
            }
        });
        //Delete Line
        $(document).on("click","#delete-line-row",function (e) {
            var count = $('#line-container-check > tr').length;
            if (count > 2){
                $(this).closest('tr').remove();
                $(this).children(".select2-check-category").select2('destroy');
                $('#line-container-check > tr').each(function (index) {
                    $(this).children('td').children('#line-counter').text(index+1);
                });
            }else{
                e.preventDefault();
            }

        });
        //Table input text show
        $('#tableLine').find('td:last').on('click', function (e) {
            console.log('last');
            e.preventDefault();
            e.stopPropagation();
        });
        $(document).on('click','#tableLine td:not(:last-child)',function () {
            var transaction_id = $('#checktransID').val();
            if ($(this).parent('tr').children('td').children('div').children('#prevent_process').val() == 'true'){
                $('.select2-check-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true,
                    width:'resolve',
                    ajax:{
                        url:'/accounting/getExpensesCategories',
                        type:"GET",
                        dataType:"json",
                        delay:250,
                        data:function (params) {
                            return{
                                q: params.name,
                                transaction_id:transaction_id
                            }
                        },
                        processResults:function (response) {
                            return{results:response};
                        },
                        cache:true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (d) {
                        var subtext = d.subtext;
                        if(subtext == undefined){subtext=''}
                        return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                    }
                });
                $('.select2-check-category').last().next().next().remove();
                // $('#tableLine > td >input').hide();
                $('#tableLine > td > div').hide();
                $('#tableLine > td > #category-preview-check').show();
                $('#tableLine > td > #description-preview-check').show();
                $('#tableLine > td > #amount-preview-check').show();
                $('#tableLine > td > div > #prevent_process').val('true');
                $(this).parent('tr').children('td').children('div').show();
                $(this).parent('tr').children('td').children('#description-preview-check').hide();
                $(this).parent('tr').children('td').children('#amount-preview-check').hide();
                $(this).parent('tr').children('td').children('#category-preview-check').hide();
                $(this).parent('tr').children('td').children('div').children('#prevent_process').val('false');

                if ($(this).parent('tr').next().length == 0){
                    $('#line-container-check').append($('#tableLine').last().clone());
                    var count = $('#line-container-check > tr').length;
                    $(this).parent('tr').next().children('td').children('#line-counter').html(count);
                    $(this).parent('tr').next().children('td').children('#category-preview-check').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#description-id-check').val(null);
                    $(this).parent('tr').next().children('td').children('#description-preview-check').html(null);
                    $(this).parent('tr').next().children('td').children('#amount-preview-check').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#amount-id-check').val(0);
                    $(this).parent('tr').next().children('td').children('.categories_id').val(null);
                }
            }

        });

        $(document).on('change','.select2-check-category',function () {
            $(this).parent('div').prev("span#category-preview-check").text($(this).find(":selected").text());
        });
        $(document).on('change','.checkDescription',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });
        $(document).on('change','.checkAmount',function () {
           $(this).parent('div').prev('span').text($(this).val());
        });

        $(document).on('keyup','.checkAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.checkAmount').each(function () {
                var num = $(this).val().replace(',','');
                total += parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
                $('#total-amount-check').text(total.toFixed(2));
                $('#h1_amount-check').text('$'+total.toFixed(2));
            }else{
                $('#total-amount-check').text(total.toFixed(2));
                $('#h1_amount-check').text('$'+total.toFixed(2));
            }

        });

    });

    // Bill modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-bill").click(function() {
                var id = $('#line-container-bill > tr').length;
                var transaction_id = $('#billTransId').val();
                for (var x = 1;x <= 4;x++){
                    id++;
                    $('#line-container-bill').append($('#tableLine-bill').last().clone());
                    $('td > .categories_id').last().val(null);
                    $('td > #category-preview-bill').last().html(null);
                    $('td > div > #description-id-bill').last().val(null);
                    $('td > #description-preview-bill').last().html(null);
                    $('td > #amount-preview-bill').last().html(null);
                    $('td > div > #amount-id-bill').last().val(0);
                    $('.select2-bill-category').select2({
                        placeholder: 'Choose a category',
                        allowClear: true,
                        width:'resolve',
                        ajax:{
                            url:'/accounting/getExpensesCategories',
                            type:"GET",
                            dataType:"json",
                            delay:250,
                            data:function (params) {
                                return{
                                    q: params.name,
                                    transaction_id:transaction_id
                                }
                            },
                            processResults:function (response) {
                                return{results:response};
                            },
                            cache:true
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                        templateResult: function (d) {
                            var subtext = d.subtext;
                            if(subtext == undefined){subtext=''}
                            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                        }
                    });
                    $('.select2-bill-category').last().next().next().remove();
                }
                $('#line-container-bill > tr').each(function (index) {
                    $(this).children('td').children('#line-counter-bill').text(index+1);
                });
            });
        });
        // Clear Lines
        $('#clear-all-line-bill').click(function (e) {
            var num = $('#line-container-bill > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                $('#line-container-bill > #tableLine-bill').slice(2).remove();
                $(".select2-bill-category").select2('destroy');
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-bill",function (e) {
            var count = $('#line-container-bill > tr').length;
            if (count > 2){
                $(this).closest('tr').remove();
                $(this).children(".select2-bill-category").select2('destroy');
                $('#line-container-bill > tr').each(function (index) {
                    $(this).children('td').children('#line-counter-bill').text(index+1);
                });
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-bill td:not(:last-child)",function () {
            var transaction_id = $('#billTransId').val();
            if ($(this).parent('tr').children('td').children('div').children('#prevent_process').val() == 'true'){
                $('.select2-bill-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true,
                    width:'resolve',
                    ajax:{
                        url:'/accounting/getExpensesCategories',
                        type:"GET",
                        dataType:"json",
                        delay:250,
                        data:function (params) {
                            return{
                                q: params.name,
                                transaction_id:transaction_id
                            }
                        },
                        processResults:function (response) {
                            return{results:response};
                        },
                        cache:true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (d) {
                        var subtext = d.subtext;
                        if(subtext == undefined){subtext=''}
                        return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                    }
                });
                $('.select2-bill-category').last().next().next().remove();

                // $('#tableLine-bill > td >input').hide();
                $('#tableLine-bill > td > div').hide();
                $('#tableLine-bill > td > #category-preview-bill').show();
                $('#tableLine-bill > td > #description-preview-bill').show();
                $('#tableLine-bill > td > #amount-preview-bill').show();
                $('#tableLine-bill >td > div > #prevent_process').val('true');
                $(this).parent('tr').children('td').children('div').show();
                $(this).parent('tr').children('td').children('#description-preview-bill').hide();
                $(this).parent('tr').children('td').children('#amount-preview-bill').hide();
                $(this).parent('tr').children('td').children('#category-preview-bill').hide();
                $(this).parent('tr').children('td').children('div').children('#prevent_process').val('false');

                if ($(this).parent('tr').next().length == 0){
                    $('#line-container-bill').append($('#tableLine-bill').last().clone());
                    var count = $('#line-container-bill > tr').length;
                    $(this).parent('tr').next().children('td').children('#line-counter-bill').html(count);
                    $(this).parent('tr').next().children('td').children('#category-preview-bill').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#description-id-bill').val(null);
                    $(this).parent('tr').next().children('td').children('#description-preview-bill').html(null);
                    $(this).parent('tr').next().children('td').children('#amount-preview-bill').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#amount-id-bill').val(0);
                    $(this).parent('tr').next().children('td').children('.categories_id').val(null);
                }
            }
        });
        $(document).on('change','.select2-bill-category',function () {
            $(this).parent('div').prev("span#category-preview-bill").text($(this).find(":selected").text());
        });
        $(document).on('change','.billDescription',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });
        $(document).on('change','.billAmount',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });

        $(document).on('keyup','.billAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.billAmount').each(function () {
                var num = $(this).val().replace(',','');
                total += parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-bill').text(total.toFixed(2));
                $('#h1_amount-bill').text('$'+total.toFixed(2));
            }

        });

    });
    // Expense modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-expense").click(function() {
                var id = $('#line-container-expense > tr').length;
                var transaction_id = $('#expenseTransId').val();
                for (var x = 1;x <= 4;x++){
                    id++;
                    $('#line-container-expense').append($('#tableLine-expense').last().clone());
                    $('td > #category-preview-expense').last().html(null);
                    $('td > .categories_id').last().val(null);
                    $('td > div > #description-id-expense').last().val(null);
                    $('td > #description-preview-expense').last().html(null);
                    $('td > #amount-preview-expense').last().html(null);
                    $('td > div > #amount-id-expense').last().val(0);
                    $('.select2-expense-category').select2({
                        placeholder: 'Choose a category',
                        allowClear: true,
                        width:'resolve',
                        ajax:{
                            url:'/accounting/getExpensesCategories',
                            type:"GET",
                            dataType:"json",
                            delay:250,
                            data:function (params) {
                                return{
                                    q: params.name,
                                    transaction_id:transaction_id
                                }
                            },
                            processResults:function (response) {
                                return{results:response};
                            },
                            cache:true
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                        templateResult: function (d) {
                            var subtext = d.subtext;
                            if(subtext == undefined){subtext=''}
                            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                        }
                    });
                    $('.select2-expense-category').last().next().next().remove();
                }
                $('#line-container-expense > tr').each(function (index) {
                    $(this).children('td').children('#line-counter-expense').text(index+1);
                });
            });
        });
        // Clear Lines
        $('#clear-all-line-expense').click(function (e) {
            var num = $('#line-container-expense > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                $('#line-container-expense > #tableLine-expense').slice(2).remove();
                $(".select2-expense-category").select2('destroy');
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-expense",function (e) {
            var count = $('#line-container-expense > tr').length;
            if (count > 2){
                $(this).closest('tr').remove();
                $(this).children(".select2-expense-category").select2('destroy');
                $('#line-container-expense > tr').each(function (index) {
                    $(this).children('td').children('#line-counter-expense').text(index+1);
                });
            }else{
                e.preventDefault();
            }

        });

        //Table input text show

        $(document).on("click","#tableLine-expense td:not(:last-child)",function () {
            var transaction_id = $('#expenseTransId').val();
            if ($(this).parent('tr').children('td').children('div').children('#prevent_process').val() == 'true'){
                $('.select2-expense-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true,
                    width:'resolve',
                    ajax:{
                        url:'/accounting/getExpensesCategories',
                        type:"GET",
                        dataType:"json",
                        delay:250,
                        data:function (params) {
                            return{
                                q: params.name,
                                transaction_id:transaction_id
                            }
                        },
                        processResults:function (response) {
                            return{results:response};
                        },
                        cache:true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (d) {
                        var subtext = d.subtext;
                        if(subtext == undefined){subtext=''}
                        return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                    }
                });
                $('.select2-expense-category').last().next().next().remove();
                // $('#tableLine-expense > td >input').hide();
                $('#tableLine-expense > td >div').hide();
                $('#tableLine-expense > td > #category-preview-expense').show();
                $('#tableLine-expense > td > #description-preview-expense').show();
                $('#tableLine-expense > td > #amount-preview-expense').show();
                $('#tableLine-expense >td > div > #prevent_process').val('true');
                $(this).parent('tr').children('td').children('div').show();
                $(this).parent('tr').children('td').children('#description-preview-expense').hide();
                $(this).parent('tr').children('td').children('#amount-preview-expense').hide();
                $(this).parent('tr').children('td').children('#category-preview-expense').hide();
                $(this).parent('tr').children('td').children('div').children('#prevent_process').val('false');

                if ($(this).parent('tr').next().length == 0){
                    $('#line-container-expense').append($('#tableLine-expense').last().clone());
                    var count = $('#line-container-expense > tr').length;
                    $(this).parent('tr').next().children('td').children('#line-counter-expense').html(count);
                    $(this).parent('tr').next().children('td').children('#category-preview-expense').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#description-id-expense').val(null);
                    $(this).parent('tr').next().children('td').children('#description-preview-expense').html(null);
                    $(this).parent('tr').next().children('td').children('#amount-preview-expense').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#amount-id-expense').val(0);
                    $(this).parent('tr').next().children('td').children('.categories_id').val(null);
                }
            }
        });
        $(document).on('change','.select2-expense-category',function () {
            $(this).parent('div').prev("span#category-preview-expense").text($(this).find(":selected").text());
        });
        $(document).on('change','.expenseDescription',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });
        $(document).on('change','.expenseAmount',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });

        $(document).on('keyup','.expenseAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.expenseAmount').each(function () {
                var num = $(this).val().replace(',','');
                total += parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-expense').text(total.toFixed(2));
                $('#h1_amount-expense').text('$'+total.toFixed(2));
            }

        });


    });
    // Vendor Credit modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-vendorCredit").click(function() {
                var id = $('#line-container-vendorCredit > tr').length;
                var transaction_id = $('#vcTransId').val();
                for (var x = 1;x <= 4;x++){
                    id++;
                    $('#line-container-vendorCredit').append($('#tableLine-vendorCredit').last().clone());
                    $('td > #category-preview-vc').last().html('');
                    $('td > .categories_id').last().val(null);
                    $('td > div > #description-id-vc').last().val('');
                    $('td > #description-preview-vc').last().html('');
                    $('td > #amount-preview-vc').last().html('');
                    $('td > div > #amount-id-vc').last().val(0);
                    $('.select2-vc-category').select2({
                        placeholder: 'Choose a category',
                        allowClear: true,
                        width:'resolve',
                        ajax:{
                            url:'/accounting/getExpensesCategories',
                            type:"GET",
                            dataType:"json",
                            delay:250,
                            data:function (params) {
                                return{
                                    q: params.name,
                                    transaction_id:transaction_id
                                }
                            },
                            processResults:function (response) {
                                return{results:response};
                            },
                            cache:true
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                        templateResult: function (d) {
                            var subtext = d.subtext;
                            if(subtext == undefined){subtext=''}
                            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                        }
                    });
                    $('.select2-vc-category').last().next().next().remove();
                }
                $('#line-container-vendorCredit > tr').each(function (index) {
                    $(this).children('td').children('#line-counter-vendorCredit').text(index+1);
                });
            });
        });
        // Clear Lines
        $('#clear-all-line-vendorCredit').click(function (e) {
            var num = $('#line-container-vendorCredit > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                $('#line-container-vendorCredit > #tableLine-vendorCredit').slice(2).remove();
                $(".select2-vc-category").select2('destroy');
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-vendorCredit",function (e) {
            var count = $('#line-container-vendorCredit > tr').length;
            if (count > 2){
                $(this).closest('tr').remove();
                $(this).children(".select2-vc-category").select2('destroy');
                $('#line-container-vendorCredit > #tableLine-vendorCredit').each(function (index) {
                    $(this).children('td').children('#line-counter-vendorCredit').text(index+1);
                });
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-vendorCredit td:not(:last-child)",function (e) {
            var transaction_id = $('#vcTransId').val();
            if ($(this).parent('tr').children('td').children('div').children('#prevent_process').val() == 'true'){
                $('.select2-vc-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true,
                    width:'resolve',
                    ajax:{
                        url:'/accounting/getExpensesCategories',
                        type:"GET",
                        dataType:"json",
                        delay:250,
                        data:function (params) {
                            return{
                                q: params.name,
                                transaction_id:transaction_id
                            }
                        },
                        processResults:function (response) {
                            return{results:response};
                        },
                        cache:true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (d) {
                        var subtext = d.subtext;
                        if(subtext == undefined){subtext=''}
                        return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                    }
                });
                $('.select2-vc-category').last().next().next().remove();
                // $('#tableLine-vendorCredit > td >input').hide();
                $('#tableLine-vendorCredit > td >div').hide();
                $('#tableLine-vendorCredit > td > #category-preview-vc').show();
                $('#tableLine-vendorCredit > td > #description-preview-vc').show();
                $('#tableLine-vendorCredit > td > #amount-preview-vc').show();
                $('#tableLine-vendorCredit > td > div > #prevent_process').val('true');
                $(this).parent('tr').children('td').children('div').show();
                $(this).parent('tr').children('td').children('#description-preview-vc').hide();
                $(this).parent('tr').children('td').children('#amount-preview-vc').hide();
                $(this).parent('tr').children('td').children('#category-preview-vc').hide();
                $(this).parent('tr').children('td').children('div').children('#prevent_process').val('false');

                if ($(this).parent('tr').next().length == 0){
                    $('#line-container-vendorCredit').append($('#tableLine-vendorCredit').last().clone());
                    var count = $('#line-container-vendorCredit > tr').length;
                    $(this).parent('tr').next().children('td').children('#line-counter-vendorCredit').html(count);
                    $(this).parent('tr').next().children('td').children('#category-preview-vc').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#description-id-vc').val(null);
                    $(this).parent('tr').next().children('td').children('#description-preview-vc').html(null);
                    $(this).parent('tr').next().children('td').children('#amount-preview-vc').html(null);
                    $(this).parent('tr').next().children('td').children('div').children('#amount-id-vc').val(0);
                    $(this).parent('tr').next().children('td').children('.categories_id').val(null);
                    console.log($(this).parent('tr').children('td').children('.categories_id').val());
                }
            }
        });
        $(document).on('change','.select2-vc-category',function () {
            $(this).parent('div').prev("span#category-preview-vc").text($(this).find(":selected").text());
        });
        $(document).on('change','.vcDescription',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });
        $(document).on('change','.vcAmount',function () {
            $(this).parent('div').prev('span').text($(this).val());
        });

        $(document).on('keyup','.vcAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.vcAmount').each(function () {
                var num = $(this).val();
                total = total + parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-vc').text(total.toFixed(2));
                $('#h1_amount-vc').text('$'+total.toFixed(2));
            }

        });
    });

    //Pay Down
    $(document).ready(function () {
       $('#showHiddenOption').click(function () {
          $('#hiddenOption').toggle(this.checked);
       });
       $('#printLater').click(function () {
          $('#checkNumber').prop("disabled",this.checked);
       });

        $("#amountSelector").change(function () {
            if (!$.isNumeric($(this).val()))
                $(this).val('0').trigger('change');
            $(this).val(parseFloat($(this).val(),10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        });
    });
    //Billable Toggle
    $('#billable').click(function () {
       $('#hideTaxable').toggle(this.checked);
        if($('#hideTextBox').attr('type') == 'hidden'){
            $('#hideTextBox').attr('type','text');
        }else{
            $('#hideTextBox').attr('type','hidden');
        }
    });
    //Start and End time toggle
    $('#start_end_times').click(function () {
       $('#startEndRow').toggle(this.checked);
       if($('#timeRow').css('display')=='none'){
           $('#timeRow').css('display','');
       }else{
           $('#timeRow').css('display','none');
       }
    });

    //Memo and Attachmennt promt
    $('#memoAttachPromt').click(function () {
        $('.memoAttachContainer').toggle(this.checked);
        var $target = $('.modal');
        $target.animate({scrollTop: $target.height()}, 1000);
    });
</script>


