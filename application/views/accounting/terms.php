<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    #terms_table .btn-group .btn:hover, #terms_table .btn-group .btn:focus {
        color: unset;
    }
    #terms_table .btn-group .btn {
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
                                    <h3 class="page-title" style="margin: 0 !important">Terms</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Every freelancer or small business owner has been there. You complete a project, send out the invoice, and get back nothing but silence. Maybe your invoice is sitting forgotten in your client's inbox. Or, perhaps, they've chosen to skip out on paying you for your work. Fortunately, carefully crafting your invoice wording for immediate payment can help you separate the former from the latter. You can do that here.</span>
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
                                            <a href="#" data-toggle="modal" data-target="#payment_term_modal" class="btn btn-success" style="padding: 10px 20px !important">
                                                New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <input type="text" name="search" id="search" class="form-control w-50" placeholder="Filter by name">
                                </div>
                                <div class="col-md-6">
                                    <div class="action-bar h-100 d-flex align-items-center">
                                        <ul class="ml-auto">
                                            <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                            <li>
                                                <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                    <p class="p-padding m-0">Other</p>
                                                    <p class="p-padding m-0"><input type="checkbox" id="inc_inactive" value="1"> Include Inactive</p>
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
                                <table id="terms_table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th width="80%">NAME</th>
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

    <div class="modal fade" id="payment_term_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Term</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form id="payment-term-form" action="/accounting/terms/add" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type" id="type1" value="1" checked>
                                                <label class="form-check-label" for="type1">
                                                    Due in fixed number of days
                                                </label>
                                            </div>
                                            <div class="form-group row m-0">
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="net_due_days" name="net_due_days">
                                                </div>
                                                <div class="col-sm-9 d-flex align-items-center pl-0">
                                                    <label for="net_due_days">days</label>
                                                </div>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type" id="type2" value="2">
                                                <label class="form-check-label" for="type2">
                                                    Due by certain day of the month
                                                </label>
                                            </div>
                                            <div class="form-group row m-0">
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="day_of_month_due" name="day_of_month_due" disabled>
                                                </div>
                                                <div class="col-sm-9 d-flex align-items-center pl-0">
                                                    <label for="day_of_month_due">day of month</label>
                                                </div>
                                            </div>
                                            <div class="form-group row m-0">
                                                <div class="col-sm-12">
                                                    <p>Due the next month if issued within</p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="minimum_days_to_pay" name="minimum_days_to_pay" disabled>
                                                </div>
                                                <div class="col-sm-9 d-flex align-items-center pl-0">
                                                    <label for="minimum_days_to_pay">days of due date</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-rounded border float-right">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inactive_term" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Are you sure you want to make <b><span class="term-name"></span></b> inactive?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">No</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="active_term" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Are you sure you want to make <b><span class="term-name"></span></b> active?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">No</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_accounting'); ?>