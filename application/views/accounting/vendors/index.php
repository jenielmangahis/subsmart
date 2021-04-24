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
    .btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }
    .btn-transparent {
        color: #6B6C72 !important;
    }
    .btn-transparent:focus {
        border-color: #6B6C72 !important;
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
                                    <h3 class="page-title" style="margin: 0 !important">Vendors</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Vendors are people or companies that you owe money to or subcontractors that work for you.  You can use the vendors tab to add and track them.  Here's how.  Select Expenses, then Vendors.  Select New Vendor.  Complete the fields in the Vendor Information window.  Select Save and close.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab" style="text-decoration: none">Expenses</a>
                                    <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="vendors")?:'-active';?>">Vendors</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <!-- <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6> -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#new-vendor-modal" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    New vendor
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import vendors</a>
                                                </div>
                                            </div>
                                            <div class="btn-group float-right mr-2">
                                                <a href="javascript:void(0);" class="btn btn-transparent d-flex align-items-center justify-content-center">
                                                    Prepare 1099s
                                                </a>
                                                <button type="button" class="btn btn-transparent dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Pay bills</a>
                                                    <a class="dropdown-item" href="#">Order checks</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="tableContainer moneyBar">
                                        <div class="unpaid-bar-container">
                                            <div class="unpaid-bar-header">
                                                Unpaid 365 days
                                            </div>
                                            <div class="overdue-bar">
                                                <div class="overdue-bar-header">
                                                    <h4>0</h4>
                                                    <span>OPEN BILLS</span>
                                                </div>
                                                <div class="openbills-bar">
                                                    <div class="openbills-bar-header">
                                                        <h4>0</h4>
                                                        <span>OVERDUE</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="paid-bar-container">
                                            <div class="paid-header">
                                                Paid
                                            </div>
                                            <div class="paid-bar">
                                                <div class="paid-bar-header">
                                                    <h4>39</h4>
                                                    <span>PAID LAST 30 DAYS</span>
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
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3 d-flex align-items-end justify-content-center">
                                                <div class="arrow-level-down m-0">
                                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                                </div>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-transparent" type="button" id="statusDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Batch actions&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                                        <a href="#" class="dropdown-item">Email</a>
                                                        <a href="#" class="dropdown-item">Make inactive</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Find a vendor on company">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                                <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <p class="m-0"><input type="checkbox"> Address</p>
                                                        <p class="m-0"><input type="checkbox"> Attachments</p>
                                                        <p class="m-0"><input type="checkbox" checked> Phone</p>
                                                        <p class="m-0"><input type="checkbox" checked> Email</p>
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
                                <table id="vendors-table" class="table table-bordered table-hover" style="width:100%">
									<thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>Vendor/Company</th>
                                            <th class="">Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th class="text-center"><i class="fa fa-paperclip"></i></th>
                                            <th>Open Balance</th>
                                            <th class="text-right">Action</th>
                                        </tr>
									</thead>
									<tbody class="cursor-pointer"></tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <!--    Add vendor modal-->
            <div id="new-vendor-modal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg m-auto">
                    <!-- Modal content-->
                    <form action="/accounting/vendors/add" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="modal-content max-width">
                        <div class="modal-header" style="border-bottom: 0">
                            <div class="modal-title">Vendor Information</div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 56px">
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 106px">
                                            <label for="">First name</label>
                                            <input type="text" name="f_name" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 106px">
                                            <label for="">Middle name</label>
                                            <input type="text" name="m_name" class="form-control">
                                        </div>
                                        <div class="form-ib" style="width: 106px">
                                            <label for="">Last name</label>
                                            <input type="text" name="l_name" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 56px">
                                            <label for="">Suffix</label>
                                            <input type="text" name="suffix" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib">
                                            <label for="">Company</label>
                                            <input type="text" name="company" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib">
                                            <label for="" style="margin-right: 10px">Print on check as </label>
                                            <input type="checkbox" value="1" name="to_display"><span style="margin-left: 10px">Use display name</span>
                                            <input type="text" name="display_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib">
                                            <label for="" style="margin-right: 10px">Address</label>
                                            <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                            <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required></textarea>
                                            <input name="city" type="text" class="form-control address-form" placeholder="City/Town" required>
                                            <input name="state" type="text" class="form-control address-form" placeholder="State/Province" required>
                                            <input name="zip" type="text" class="form-control address-form" placeholder="ZIP Code" required>
                                            <input name="country" type="text" class="form-control address-form" placeholder="Country" required>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib">
                                            <label for="">Notes</label>
                                            <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib">
                                            <label for="" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                            <span>Maximum size: 20MB</span>
                                            <form action="/file-upload" class="dropzone" style="height: 50px;border:1px dashed grey;">
                                                <div class="fallback">
                                                    <input name="attachFiles" type="file" multiple />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <h4>Get custom fields with Advanced</h4>
                                        <p>Custom fields let you add more detailed info about your customers and transactions.
                                            Sort, track, and report info that's important to you.
                                        </p>
                                        <a href="#" style="color: #0b97c4;">Learn more</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-ib-group">
                                        <div class="form-ib">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Separate multiple emails with commas" required>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 129px">
                                            <label for="">Phone</label>
                                            <input type="text" name="phone" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 129px">
                                            <label for="">Mobile</label>
                                            <input type="text" name="mobile" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 129px">
                                            <label for="">Fax</label>
                                            <input type="text" name="fax" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <!--<div class="form-ib" style="width: 126px;">
                                            <label for="">Other</label>
                                            <input type="text" class="form-control">
                                        </div>-->
                                        <div class="form-ib">
                                            <label for="">Website</label>
                                            <input type="text" name="website" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 126px;">
                                            <label for="">Billing rate (/hr)</label>
                                            <input type="text" name="billing_rate" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 265px;">
                                            <label for="">Terms</label>
                                            <select class="form-control" name="terms" required>
                                            <option value="1">Due on Receipt</option>
                                            <option value="2">Net 15</option>
                                            <option value="3">Net 30</option>
                                            <option value="4">Net 60</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 147px">
                                            <label for="">Opening balance</label>
                                            <input type="text" name="opening_balance" class="form-control" required>
                                        </div>
                                        <div class="form-ib" style="width: 190px">
                                            <label for="">as of</label>
                                            <input type="date" name="opening_balance_as_of_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 70%">
                                            <label for="">Account no.</label>
                                            <input type="text" name="account_number" class="form-control" placeholder="Appears in the memo of all payment" required>
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 50%">
                                            <label for="">Business ID No.</label>
                                            <input type="text" name="business_number" class="form-control" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-ib-group">
                                        <div class="form-ib" style="width: 60%">
                                            <label for="">Default expense account</label>
                                            <input type="text" name="default_expense_amount" class="form-control" placeholder="Choose Account" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-md-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
                                <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
    <!--    end of modal-->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-modal"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>