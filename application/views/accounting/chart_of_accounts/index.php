<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }
    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }
    #charts_of_account_table .btn-group .btn:hover, #charts_of_account_table .btn-group .btn:focus {
        color: unset;
    }
    #charts_of_account_table .btn-group .btn {
        padding: 10px;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Chart of Accounts List</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">When you create your company file, our accounting software automatically customizes your chart of accounts based on your industry. You can add more accounts any time you need to track other types of transactions. It is very simple to add more accounts to your chart of accounts. Structuring and setting up the chart of accounts will eliminate the guesswork which in-turn can help run your business smoothly.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/chart_of_accounts')?>" class="banking-tab-active text-decoration-none">Chart of Accounts</a>
                                    <a href="<?php echo url('/accounting/reconcile')?>" class="banking-tab">Reconcile</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <a href="#" class="btn btn-secondary mr-2"
                                                aria-expanded="false" style="padding: 10px 12px !important">
                                                    Run Report
                                            </a>
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddAccount" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    Add New
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <?php echo form_open_multipart('accounting/chart_of_accounts', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-3">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Filter by name">
                                            </div>
                                            <div class="col-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="ctl">Counts toward limits</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" class="editbtn"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <p class="m-0"><input type="checkbox" checked="checked" onchange="col_type()" name="chk_type" id="chk_type"> Type</p>
                                                        <p class="m-0"><input type="checkbox" checked="checked" onchange="col_detailtype()" name="chk_detail_type" id="chk_detail_type"> Detail Type</p>
                                                        <p class="m-0"><input type="checkbox" checked="checked" onchange="col_nbalance()" name="chk_nsmart_balance" id="chk_nsmart_balance"> Nsmart Balance</p>
                                                        <p><input type="checkbox" checked="checked" onchange="col_balance()" name="chk_balance" id="chk_balance"> Balance</p>
											            <p class="m-0">Other</p>
                                                        <p class="m-0"><input type="checkbox" id="inc_inactive" value="1"> Include Inactive</p>
                                                        <p class="m-0">Rows</p>
                                                        <p class="m-0">
                                                            <select name="table_rows" id="table_rows" class="form-control">
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="150" selected>150</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="charts_of_account_table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="type">TYPE</th>
                                            <th class="detailtype">DETAIL TYPE</th>
                                            <th class="nbalance">NSMARTRAC BALANCE</th>
                                            <th class="balance">BANK BALANCE</th>
                                            <th class="text-right" width="10%">ACTION</th>
                                        </tr>
									</thead>
									<tbody id="customer_data">
									</tbody>
								</table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <!-- add account modal -->
            <div class="modal fade" id="modalAddAccount" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg w-50 m-auto" role="document">
                    <div class="modal-content">
                        <?php echo form_open_multipart('accounting/chart-of-accounts/add', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addLocationLabel">Accounts</h5>
                                <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                            </div>
                            <div class="modal-body" style="max-height: 650px;">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card p-0 m-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="account_type">Account Type</label>
                                                            <select name="account_type" id="account_type" class="form-control select2" required>
                                                                <?php foreach ($this->account_model->getAccounts() as $row): ?>
                                                                    <option value="<?php echo $row->id ?>"><?php echo $row->account_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detail_type">Detail Type</label>
                                                            <select name="detail_type" id="detail_type" class="form-control select2" onchange="showOptions(this)" required>
                                                                <?php foreach ($this->account_detail_model->getDetailTypesById(1) as $row_detail): ?>
                                                                    <option value="<?php echo $row_detail->acc_detail_id ?>" ><?php echo $row_detail->acc_detail_name ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <div class="detail-type-desc">
                                                            <?php $detail = $this->account_detail_model->getDetailTypesById(1)[0]; ?>
                                                            <?=$detail->description?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" name="name" id="name" required
                                                                placeholder="Enter Name"
                                                                autofocus/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea type="text" class="form-control" name="description" id="description"
                                                                    placeholder="Enter Description" rows="3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check(this)"/>
                                                            <label for="formClient-Status">Is sub account</label>
                                                            <select name="sub_account_type" id="sub_account_type" class="form-control select2" required disabled="disabled">
                                                                <option disabled selected>Enter parent account</option>
                                                                <?php foreach($accountsDropdown as $key => $accounts) : ?>
                                                                    <optgroup label="<?=$key?>">
                                                                        <?php foreach($accounts as $account) : ?>
                                                                            <option value="<?=$account['id']?>"><?=$account['name']?></option>
                                                                            <?php if(!empty($account['child_accounts'])) : ?>
                                                                                <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;<?='Sub-account of '.$account['name']?>">
                                                                                    <?php foreach($account['child_accounts'] as $subAcc) : ?>
                                                                                        <option value="<?=$subAcc->id?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$subAcc->name?></option>
                                                                                    <?php endforeach; ?>
                                                                                </optgroup>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <br>
                                                            <label for="choose_time">When do you want to start tracking your finances from this account in nSmarTrac?</label>
                                                            <span></span>
                                                            <select name="choose_time" id="choose_time" class="form-control select2" required onchange="showdiv(this)">
                                                                <option selected="selected" disabled="disabled">Choose one</option>
                                                                <option value="Beginning of this year">Beginning of this year</option>
                                                                <option value="Beginning of this month">Beginning of this month</option>
                                                                <option value="Today">Today</option>
                                                                <option value="Other" onclick="hidediv()">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group hide-date hide">
                                                            <label for="time_date">Date</label>
                                                            <div class="col-xs-10 date_picker">
                                                                <input type="text" class="form-control" name="time_date" id="time_date"
                                                                placeholder="Enter Date" autofocus/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group hide-div hide">
                                                            <label for="balance">Balance</label>
                                                            <input type="text" class="form-control" name="balance" id="balance" required
                                                                placeholder="Enter Balance"
                                                                autofocus/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>

                            </div>
                            <!-- end modal-body -->
                            <div class="modal-footer">
                                <div class="row w-100">
                                    <div class="col-md-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
                                    <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- end add account modal -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-edit-account"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>