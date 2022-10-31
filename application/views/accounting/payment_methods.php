<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    #payment_methods .btn-group .btn:hover, #payment_methods .btn-group .btn:focus {
        color: unset;
    }
    #payment_methods .btn-group .btn {
        padding: 10px;
    }
    #myTabContent .action-bar ul li a:after {
        width: 0;
    }
    #myTabContent .action-bar ul li a {
    font-size: 20px;
    }
    #myTabContent .action-bar ul li {
        margin-right: 5px;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn {
        color: #6B6C72;
        border: 0;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn:hover {
        background: transparent;
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
                                    <h3 class="page-title" style="margin: 0 !important">Payment Methods</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">The many methods of payment are Ach, Cash, Check, Credit, and payment-in-kind (or bartering). These methods are used in basic transactions; for example, one may pay for a product or services with cash, a credit card, or theoretically even by trading another person for other trade services for the equivalent value.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center pb-3">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <a href="#" class="btn btn-secondary mr-2" style="padding: 10px 12px !important">
                                                Run Report
                                            </a>
                                            <a href="#" id="new-payment-method" class="btn btn-success" style="padding: 10px 20px !important">
                                                New
                                            </a>
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
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <input type="text" name="search" id="search" class="form-control w-50" placeholder="Filter by name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-payment-methods"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="p-padding m-0">Columns</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" onchange="col(this)" name="col_credit" id="col_credit">
                                                            <label for="col_credit">Credit Card</label>
                                                        </div>
                                                        <p class="p-padding m-0">Other</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" name="inc_inactive" id="inc_inactive" value="1">
                                                            <label for="inc_inactive">Include Inactive</label>
                                                        </div>
                                                        <p class="p-padding m-0">Rows</p>
                                                        <p class="p-padding m-0">
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
                                <table id="payment_methods" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th width="70%">NAME</th>
                                            <th class="credit-card">CREDIT CARD</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
									</thead>
									<tbody></tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>
<?php include viewPath('includes/footer_accounting'); ?>